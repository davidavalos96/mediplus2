<?php 
/**
 * Usuarios Page Controller
 * @category  Controller
 */
class UsuariosController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "usuarios";
		$this->soft_delete = true;
		$this->delete_field_name = "is_deleted";
		$this->delete_field_value = "1";
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function index($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("idUSUARIO", 
			"USUARIO", 
			"EMAIL", 
			"user_role_id", 
			"profesional");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				usuarios.idUSUARIO LIKE ? OR 
				usuarios.NOMBRE LIKE ? OR 
				usuarios.CLAVE LIKE ? OR 
				usuarios.USUARIO LIKE ? OR 
				usuarios.EMAIL LIKE ? OR 
				usuarios.user_role_id LIKE ? OR 
				usuarios.profesional LIKE ? OR 
				usuarios.paciente LIKE ? OR 
				usuarios.date_deleted LIKE ? OR 
				usuarios.is_deleted LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "usuarios/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("usuarios.idUSUARIO", ORDER_TYPE);
		}
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$tc = $db->withTotalCount();
		$records = $db->get($tablename, $pagination, $fields);
		$records_count = count($records);
		$total_records = intval($tc->totalCount);
		$page_limit = $pagination[1];
		$total_pages = ceil($total_records / $page_limit);
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = $records_count;
		$data->total_records = $total_records;
		$data->total_page = $total_pages;
		if($db->getLastError()){
			$this->set_page_error();
		}
		$page_title = $this->view->page_title = "Usuarios";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("usuarios/list.php", $data); //render the full page
	}
	/**
     * View record detail 
	 * @param $rec_id (select record by table primary key) 
     * @param $value value (select record by value of field name(rec_id))
     * @return BaseView
     */
	function view($rec_id = null, $value = null){
		$request = $this->request;
		$db = $this->GetModel();
		$rec_id = $this->rec_id = urldecode($rec_id);
		$tablename = $this->tablename;
		$fields = array("idUSUARIO", 
			"USUARIO", 
			"EMAIL", 
			"user_role_id", 
			"profesional", 
			"paciente");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("usuarios.idUSUARIO", $rec_id);; //select record based on primary key
		}
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = "Ver";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		}
		else{
			if($db->getLastError()){
				$this->set_page_error();
			}
			else{
				$this->set_page_error("Registro no encontrado");
			}
		}
		return $this->render_view("usuarios/view.php", $record);
	}
	/**
     * Insert new record to the database table
	 * @param $formdata array() from $_POST
     * @return BaseView
     */
	function add($formdata = null){
		if($formdata){
			$db = $this->GetModel();
			$tablename = $this->tablename;
			$request = $this->request;
			//fillable fields
			$fields = $this->fields = array("NOMBRE","CLAVE","USUARIO","EMAIL","user_role_id","profesional","paciente");
			$postdata = $this->format_request_data($formdata);
			$cpassword = $postdata['confirm_password'];
			$password = $postdata['NOMBRE'];
			if($cpassword != $password){
				$this->view->page_error[] = "La confirmación de su contraseña no es consistente";
			}
			$this->rules_array = array(
				'NOMBRE' => 'required',
				'CLAVE' => 'required',
				'USUARIO' => 'required',
				'EMAIL' => 'required|valid_email',
				'user_role_id' => 'required',
				'profesional' => 'required|numeric',
				'paciente' => 'required|numeric',
			);
			$this->sanitize_array = array(
				'USUARIO' => 'sanitize_string',
				'EMAIL' => 'sanitize_string',
				'user_role_id' => 'sanitize_string',
				'profesional' => 'sanitize_string',
				'paciente' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$password_text = $modeldata['NOMBRE'];
			//update modeldata with the password hash
			$modeldata['NOMBRE'] = $this->modeldata['NOMBRE'] = password_hash($password_text , PASSWORD_DEFAULT);
			//Check if Duplicate Record Already Exit In The Database
			$db->where("USUARIO", $modeldata['USUARIO']);
			if($db->has($tablename)){
				$this->view->page_error[] = $modeldata['USUARIO']." ¡Ya existe!";
			}
			//Check if Duplicate Record Already Exit In The Database
			$db->where("EMAIL", $modeldata['EMAIL']);
			if($db->has($tablename)){
				$this->view->page_error[] = $modeldata['EMAIL']." ¡Ya existe!";
			} 
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Grabar agregado exitosamente", "success");
					return	$this->redirect("usuarios");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Agregar nuevo";
		$this->render_view("usuarios/add.php");
	}
	/**
     * Update table record with formdata
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function edit($rec_id = null, $formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("idUSUARIO","USUARIO","user_role_id","profesional","paciente");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'USUARIO' => 'required',
				'user_role_id' => 'required',
				'profesional' => 'required|numeric',
				'paciente' => 'required|numeric',
			);
			$this->sanitize_array = array(
				'USUARIO' => 'sanitize_string',
				'user_role_id' => 'sanitize_string',
				'profesional' => 'sanitize_string',
				'paciente' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			//Check if Duplicate Record Already Exit In The Database
			if(isset($modeldata['USUARIO'])){
				$db->where("USUARIO", $modeldata['USUARIO'])->where("idUSUARIO", $rec_id, "!=");
				if($db->has($tablename)){
					$this->view->page_error[] = $modeldata['USUARIO']." ¡Ya existe!";
				}
			} 
			if($this->validated()){
				$db->where("usuarios.idUSUARIO", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Registro actualizado con éxito", "success");
					return $this->redirect("usuarios");
				}
				else{
					if($db->getLastError()){
						$this->set_page_error();
					}
					elseif(!$numRows){
						//not an error, but no record was updated
						$page_error = "No hay registro actualizado";
						$this->set_page_error($page_error);
						$this->set_flash_msg($page_error, "warning");
						return	$this->redirect("usuarios");
					}
				}
			}
		}
		$db->where("usuarios.idUSUARIO", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Editar";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("usuarios/edit.php", $data);
	}
	/**
     * Update single field
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function editfield($rec_id = null, $formdata = null){
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		//editable fields
		$fields = $this->fields = array("idUSUARIO","USUARIO","user_role_id","profesional","paciente");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
				'USUARIO' => 'required',
				'user_role_id' => 'required',
				'profesional' => 'required|numeric',
				'paciente' => 'required|numeric',
			);
			$this->sanitize_array = array(
				'USUARIO' => 'sanitize_string',
				'user_role_id' => 'sanitize_string',
				'profesional' => 'sanitize_string',
				'paciente' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			//Check if Duplicate Record Already Exit In The Database
			if(isset($modeldata['USUARIO'])){
				$db->where("USUARIO", $modeldata['USUARIO'])->where("idUSUARIO", $rec_id, "!=");
				if($db->has($tablename)){
					$this->view->page_error[] = $modeldata['USUARIO']." ¡Ya existe!";
				}
			} 
			if($this->validated()){
				$db->where("usuarios.idUSUARIO", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount();
				if($bool && $numRows){
					return render_json(
						array(
							'num_rows' =>$numRows,
							'rec_id' =>$rec_id,
						)
					);
				}
				else{
					if($db->getLastError()){
						$page_error = $db->getLastError();
					}
					elseif(!$numRows){
						$page_error = "No hay registro actualizado";
					}
					render_error($page_error);
				}
			}
			else{
				render_error($this->view->page_error);
			}
		}
		return null;
	}
	/**
     * Update record field as deleted
	 * Support multi delete by separating record id by comma.
     * @return BaseView
     */
	function delete($rec_id = null){
		Csrf::cross_check();
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$this->rec_id = $rec_id;
		//form multiple delete, split record id separated by comma into array
		$arr_rec_id = array_map('trim', explode(",", $rec_id));
		$db->where("usuarios.idUSUARIO", $arr_rec_id, "in");
		$modeldata = array(
			"is_deleted" => "1",
			"date_deleted" => datetime_now()
		);
		$bool = $db->update($tablename, $modeldata);
		if($bool){
			$this->set_flash_msg("Grabar eliminado con éxito", "success");
		}
		else{
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("usuarios");
	}
}
