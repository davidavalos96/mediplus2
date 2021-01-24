<?php 
/**
 * Pacientes Page Controller
 * @category  Controller
 */
class PacientesController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "pacientes";
		$this->soft_delete = true;
		$this->delete_field_name =$this->tablename.".is_deleted"; 
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
		$fields = array("pacientes.idPaciente", 
			"pacientes.NOMBAPEPAC", 
			"pacientes.NUMDOCPAC", 
			"cobertura.NOMBCOBERTURA AS cobertura_NOMBCOBERTURA", 
			"pacientes.PLANOBRASOC", 
			"pacientes.NROAFILIADO");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				pacientes.idPaciente LIKE ? OR 
				pacientes.FECHANACPAC LIKE ? OR 
				pacientes.FECHACERTVTO LIKE ? OR 
				pacientes.NOMBAPEPAC LIKE ? OR 
				pacientes.NUMDOCPAC LIKE ? OR 
				pacientes.COORDINADOR LIKE ? OR 
				cobertura.NOMBCOBERTURA LIKE ? OR 
				pacientes.PLANOBRASOC LIKE ? OR 
				pacientes.NROAFILIADO LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "pacientes/search.php";
		}
		$db->join("cobertura", "pacientes.COBERTURA = cobertura.CODCOBERTURA", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("pacientes.idPaciente", ORDER_TYPE);
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
		$page_title = $this->view->page_title = "Listado de Pacientes";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$view_name = (is_ajax() ? "pacientes/ajax-list.php" : "pacientes/list.php");
		$this->render_view($view_name, $data);
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
		$fields = array("pacientes.idPaciente", 
			"pacientes.NOMBAPEPAC", 
			"pacientes.FECHANACPAC", 
			"pacientes.NUMDOCPAC", 
			"pacientes.DOMICILIO", 
			"pacientes.barrio", 
			"pacientes.LOCALIDAD", 
			"pacientes.FECHACERTVTO", 
			"pacientes.COORDINADOR", 
			"pacientes.COBERTURA", 
			"pacientes.PLANOBRASOC", 
			"pacientes.NROAFILIADO", 
			"pacientes.TELEFONO", 
			"pacientes.EMAIL", 
			"pacientes.DIAGNOSTICO", 
			"pacientes.MEDICODERIV", 
			"pacientes.ESTADOPACIENTE", 
			"cobertura.CODCOBERTURA AS cobertura_CODCOBERTURA", 
			"cobertura.TIPODOCUMENTO AS cobertura_TIPODOCUMENTO", 
			"cobertura.NRODOCUMENTO AS cobertura_NRODOCUMENTO", 
			"cobertura.NOMBCOBERTURA AS cobertura_NOMBCOBERTURA", 
			"cobertura.CONTACTO AS cobertura_CONTACTO", 
			"cobertura.DOMICILIO AS cobertura_DOMICILIO", 
			"cobertura.LOCALIDAD AS cobertura_LOCALIDAD", 
			"cobertura.CODPOSTAL AS cobertura_CODPOSTAL", 
			"cobertura.PROVINCIA AS cobertura_PROVINCIA", 
			"cobertura.TELEFONO AS cobertura_TELEFONO", 
			"cobertura.EMAIL AS cobertura_EMAIL", 
			"cobertura.CONPLANILLA AS cobertura_CONPLANILLA", 
			"cobertura.OBSERVAC AS cobertura_OBSERVAC", 
			"cobertura.CONTACTO2 AS cobertura_CONTACTO2", 
			"cobertura.CONTACTO3 AS cobertura_CONTACTO3", 
			"cobertura.TELEFONO2 AS cobertura_TELEFONO2", 
			"cobertura.TELEFONO3 AS cobertura_TELEFONO3", 
			"cobertura.TELEFONOEMERG AS cobertura_TELEFONOEMERG", 
			"cobertura.EMERGENCIA AS cobertura_EMERGENCIA", 
			"pacientes.date_deleted", 
			"pacientes.is_deleted");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("pacientes.idPaciente", $rec_id);; //select record based on primary key
		}
		$db->join("cobertura", "pacientes.COBERTURA = cobertura.CODCOBERTURA", "INNER ");  
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
		return $this->render_view("pacientes/view.php", $record);
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
			$fields = $this->fields = array("NUMDOCPAC","FECHANACPAC","FECHACERTVTO","NOMBAPEPAC","COORDINADOR","COBERTURA","PLANOBRASOC","NROAFILIADO","DOMICILIO","barrio","LOCALIDAD","TELEFONO","EMAIL","MEDICODERIV","DIAGNOSTICO");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'NUMDOCPAC' => 'required|numeric',
				'FECHANACPAC' => 'required',
				'FECHACERTVTO' => 'required',
				'NOMBAPEPAC' => 'required',
				'COORDINADOR' => 'required',
				'COBERTURA' => 'required',
				'PLANOBRASOC' => 'required',
				'NROAFILIADO' => 'required',
				'DOMICILIO' => 'required',
				'barrio' => 'required',
				'LOCALIDAD' => 'required',
				'TELEFONO' => 'required',
				'EMAIL' => 'required|valid_email',
				'MEDICODERIV' => 'required',
				'DIAGNOSTICO' => 'required',
			);
			$this->sanitize_array = array(
				'NUMDOCPAC' => 'sanitize_string',
				'FECHANACPAC' => 'sanitize_string',
				'FECHACERTVTO' => 'sanitize_string',
				'NOMBAPEPAC' => 'sanitize_string',
				'COORDINADOR' => 'sanitize_string',
				'COBERTURA' => 'sanitize_string',
				'PLANOBRASOC' => 'sanitize_string',
				'NROAFILIADO' => 'sanitize_string',
				'DOMICILIO' => 'sanitize_string',
				'barrio' => 'sanitize_string',
				'LOCALIDAD' => 'sanitize_string',
				'TELEFONO' => 'sanitize_string',
				'EMAIL' => 'sanitize_string',
				'MEDICODERIV' => 'sanitize_string',
				'DIAGNOSTICO' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			//Check if Duplicate Record Already Exit In The Database
			$db->where("NUMDOCPAC", $modeldata['NUMDOCPAC']);
			if($db->has($tablename)){
				$this->view->page_error[] = $modeldata['NUMDOCPAC']." ¡Ya existe!";
			} 
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Grabar agregado exitosamente", "success");
					return	$this->redirect("pacientes");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Agregar nuevo";
		$this->render_view("pacientes/add.php");
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
		$fields = $this->fields = array("idPaciente","NUMDOCPAC","FECHANACPAC","FECHACERTVTO","NOMBAPEPAC","COORDINADOR","COBERTURA","PLANOBRASOC","NROAFILIADO","DOMICILIO","barrio","LOCALIDAD","TELEFONO","EMAIL","MEDICODERIV","DIAGNOSTICO");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'NUMDOCPAC' => 'required|numeric',
				'FECHANACPAC' => 'required',
				'FECHACERTVTO' => 'required',
				'NOMBAPEPAC' => 'required',
				'COORDINADOR' => 'required',
				'COBERTURA' => 'required',
				'PLANOBRASOC' => 'required',
				'NROAFILIADO' => 'required',
				'DOMICILIO' => 'required',
				'barrio' => 'required',
				'LOCALIDAD' => 'required',
				'TELEFONO' => 'required',
				'EMAIL' => 'required|valid_email',
				'MEDICODERIV' => 'required',
				'DIAGNOSTICO' => 'required',
			);
			$this->sanitize_array = array(
				'NUMDOCPAC' => 'sanitize_string',
				'FECHANACPAC' => 'sanitize_string',
				'FECHACERTVTO' => 'sanitize_string',
				'NOMBAPEPAC' => 'sanitize_string',
				'COORDINADOR' => 'sanitize_string',
				'COBERTURA' => 'sanitize_string',
				'PLANOBRASOC' => 'sanitize_string',
				'NROAFILIADO' => 'sanitize_string',
				'DOMICILIO' => 'sanitize_string',
				'barrio' => 'sanitize_string',
				'LOCALIDAD' => 'sanitize_string',
				'TELEFONO' => 'sanitize_string',
				'EMAIL' => 'sanitize_string',
				'MEDICODERIV' => 'sanitize_string',
				'DIAGNOSTICO' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			//Check if Duplicate Record Already Exit In The Database
			if(isset($modeldata['NUMDOCPAC'])){
				$db->where("NUMDOCPAC", $modeldata['NUMDOCPAC'])->where("idPaciente", $rec_id, "!=");
				if($db->has($tablename)){
					$this->view->page_error[] = $modeldata['NUMDOCPAC']." ¡Ya existe!";
				}
			} 
			if($this->validated()){
				$db->where("pacientes.idPaciente", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Registro actualizado con éxito", "success");
					return $this->redirect("pacientes");
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
						return	$this->redirect("pacientes");
					}
				}
			}
		}
		$db->where("pacientes.idPaciente", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Editar";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("pacientes/edit.php", $data);
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
		$fields = $this->fields = array("idPaciente","NUMDOCPAC","FECHANACPAC","FECHACERTVTO","NOMBAPEPAC","COORDINADOR","COBERTURA","PLANOBRASOC","NROAFILIADO","DOMICILIO","barrio","LOCALIDAD","TELEFONO","EMAIL","MEDICODERIV","DIAGNOSTICO");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
				'NUMDOCPAC' => 'required|numeric',
				'FECHANACPAC' => 'required',
				'FECHACERTVTO' => 'required',
				'NOMBAPEPAC' => 'required',
				'COORDINADOR' => 'required',
				'COBERTURA' => 'required',
				'PLANOBRASOC' => 'required',
				'NROAFILIADO' => 'required',
				'DOMICILIO' => 'required',
				'barrio' => 'required',
				'LOCALIDAD' => 'required',
				'TELEFONO' => 'required',
				'EMAIL' => 'required|valid_email',
				'MEDICODERIV' => 'required',
				'DIAGNOSTICO' => 'required',
			);
			$this->sanitize_array = array(
				'NUMDOCPAC' => 'sanitize_string',
				'FECHANACPAC' => 'sanitize_string',
				'FECHACERTVTO' => 'sanitize_string',
				'NOMBAPEPAC' => 'sanitize_string',
				'COORDINADOR' => 'sanitize_string',
				'COBERTURA' => 'sanitize_string',
				'PLANOBRASOC' => 'sanitize_string',
				'NROAFILIADO' => 'sanitize_string',
				'DOMICILIO' => 'sanitize_string',
				'barrio' => 'sanitize_string',
				'LOCALIDAD' => 'sanitize_string',
				'TELEFONO' => 'sanitize_string',
				'EMAIL' => 'sanitize_string',
				'MEDICODERIV' => 'sanitize_string',
				'DIAGNOSTICO' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			//Check if Duplicate Record Already Exit In The Database
			if(isset($modeldata['NUMDOCPAC'])){
				$db->where("NUMDOCPAC", $modeldata['NUMDOCPAC'])->where("idPaciente", $rec_id, "!=");
				if($db->has($tablename)){
					$this->view->page_error[] = $modeldata['NUMDOCPAC']." ¡Ya existe!";
				}
			} 
			if($this->validated()){
				$db->where("pacientes.idPaciente", $rec_id);;
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
		$db->where("pacientes.idPaciente", $arr_rec_id, "in");
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
		return	$this->redirect("pacientes");
	}
	/**
     * Update table record with formdata
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function editarpaciente($rec_id = null, $formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("idPaciente","NUMDOCPAC","FECHANACPAC","FECHACERTVTO","NOMBAPEPAC","COORDINADOR","COBERTURA","PLANOBRASOC","NROAFILIADO","DOMICILIO","barrio","LOCALIDAD","TELEFONO","EMAIL","DIAGNOSTICO","MEDICODERIV");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'NUMDOCPAC' => 'required|numeric',
				'FECHANACPAC' => 'required',
				'FECHACERTVTO' => 'required',
				'NOMBAPEPAC' => 'required',
				'COORDINADOR' => 'required',
				'COBERTURA' => 'required',
				'PLANOBRASOC' => 'required',
				'NROAFILIADO' => 'required',
				'DOMICILIO' => 'required',
				'barrio' => 'required',
				'LOCALIDAD' => 'required',
				'TELEFONO' => 'required',
				'EMAIL' => 'required|valid_email',
				'DIAGNOSTICO' => 'required',
				'MEDICODERIV' => 'required',
			);
			$this->sanitize_array = array(
				'NUMDOCPAC' => 'sanitize_string',
				'FECHANACPAC' => 'sanitize_string',
				'FECHACERTVTO' => 'sanitize_string',
				'NOMBAPEPAC' => 'sanitize_string',
				'COORDINADOR' => 'sanitize_string',
				'COBERTURA' => 'sanitize_string',
				'PLANOBRASOC' => 'sanitize_string',
				'NROAFILIADO' => 'sanitize_string',
				'DOMICILIO' => 'sanitize_string',
				'barrio' => 'sanitize_string',
				'LOCALIDAD' => 'sanitize_string',
				'TELEFONO' => 'sanitize_string',
				'EMAIL' => 'sanitize_string',
				'DIAGNOSTICO' => 'sanitize_string',
				'MEDICODERIV' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("pacientes.idPaciente", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Registro actualizado con éxito", "success");
					return $this->redirect("pacientes");
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
						return	$this->redirect("pacientes");
					}
				}
			}
		}
		$db->where("pacientes.idPaciente", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Editar";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("pacientes/editarpaciente.php", $data);
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function configuracion($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("idPaciente", 
			"NUMDOCPAC", 
			"FECHANACPAC", 
			"FECHACERTVTO", 
			"NOMBAPEPAC", 
			"COORDINADOR", 
			"COBERTURA", 
			"PLANOBRASOC", 
			"NROAFILIADO", 
			"DOMICILIO", 
			"barrio", 
			"LOCALIDAD", 
			"TELEFONO", 
			"EMAIL", 
			"DIAGNOSTICO", 
			"MEDICODERIV", 
			"ESTADOPACIENTE");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				pacientes.idPaciente LIKE ? OR 
				pacientes.NUMDOCPAC LIKE ? OR 
				pacientes.FECHANACPAC LIKE ? OR 
				pacientes.FECHACERTVTO LIKE ? OR 
				pacientes.NOMBAPEPAC LIKE ? OR 
				pacientes.COORDINADOR LIKE ? OR 
				pacientes.COBERTURA LIKE ? OR 
				pacientes.PLANOBRASOC LIKE ? OR 
				pacientes.NROAFILIADO LIKE ? OR 
				pacientes.DOMICILIO LIKE ? OR 
				pacientes.barrio LIKE ? OR 
				pacientes.LOCALIDAD LIKE ? OR 
				pacientes.TELEFONO LIKE ? OR 
				pacientes.EMAIL LIKE ? OR 
				pacientes.DIAGNOSTICO LIKE ? OR 
				pacientes.MEDICODERIV LIKE ? OR 
				pacientes.ESTADOPACIENTE LIKE ? OR 
				pacientes.date_deleted LIKE ? OR 
				pacientes.is_deleted LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "pacientes/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("pacientes.idPaciente", ORDER_TYPE);
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
		$page_title = $this->view->page_title = "Pacientes";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("pacientes/configuracion.php", $data); //render the full page
	}
}
