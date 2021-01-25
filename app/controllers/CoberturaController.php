<?php 
/**
 * Cobertura Page Controller
 * @category  Controller
 */
class CoberturaController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "cobertura";
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
		$fields = array("CODCOBERTURA", 
			"TIPODOCUMENTO", 
			"NRODOCUMENTO", 
			"NOMBCOBERTURA", 
			"DOMICILIO", 
			"TELEFONO");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				cobertura.CODCOBERTURA LIKE ? OR 
				cobertura.TIPODOCUMENTO LIKE ? OR 
				cobertura.NRODOCUMENTO LIKE ? OR 
				cobertura.NOMBCOBERTURA LIKE ? OR 
				cobertura.CONTACTO LIKE ? OR 
				cobertura.DOMICILIO LIKE ? OR 
				cobertura.LOCALIDAD LIKE ? OR 
				cobertura.CODPOSTAL LIKE ? OR 
				cobertura.PROVINCIA LIKE ? OR 
				cobertura.TELEFONO LIKE ? OR 
				cobertura.EMAIL LIKE ? OR 
				cobertura.CONPLANILLA LIKE ? OR 
				cobertura.OBSERVAC LIKE ? OR 
				cobertura.CONTACTO2 LIKE ? OR 
				cobertura.CONTACTO3 LIKE ? OR 
				cobertura.TELEFONO2 LIKE ? OR 
				cobertura.TELEFONO3 LIKE ? OR 
				cobertura.TELEFONOEMERG LIKE ? OR 
				cobertura.EMERGENCIA LIKE ? OR 
				cobertura.date_deleted LIKE ? OR 
				cobertura.is_deleted LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "cobertura/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("cobertura.CODCOBERTURA", ORDER_TYPE);
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
		$page_title = $this->view->page_title = "Listado de Obra Sociales";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->view->report_hidden_fields = array('TIPODOCUMENTO');
		$this->view->report_links = false;
		$this->view->report_list_sequence = false;
		$view_name = (is_ajax() ? "cobertura/ajax-list.php" : "cobertura/list.php");
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
		$fields = array("CODCOBERTURA", 
			"TIPODOCUMENTO", 
			"NRODOCUMENTO", 
			"NOMBCOBERTURA", 
			"CONTACTO", 
			"DOMICILIO", 
			"LOCALIDAD", 
			"CODPOSTAL", 
			"PROVINCIA", 
			"TELEFONO", 
			"EMAIL", 
			"CONPLANILLA", 
			"OBSERVAC", 
			"CONTACTO2", 
			"CONTACTO3", 
			"TELEFONO2", 
			"TELEFONO3", 
			"TELEFONOEMERG", 
			"EMERGENCIA");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("cobertura.CODCOBERTURA", $rec_id);; //select record based on primary key
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
		return $this->render_view("cobertura/view.php", $record);
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
			$fields = $this->fields = array("TIPODOCUMENTO","NRODOCUMENTO","CONTACTO","NOMBCOBERTURA","DOMICILIO","LOCALIDAD","PROVINCIA","CODPOSTAL","TELEFONO","EMAIL","EMERGENCIA","TELEFONOEMERG","OBSERVAC");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'TIPODOCUMENTO' => 'required',
				'NRODOCUMENTO' => 'required|numeric',
				'CONTACTO' => 'required',
				'NOMBCOBERTURA' => 'required',
				'DOMICILIO' => 'required',
				'LOCALIDAD' => 'required',
				'PROVINCIA' => 'required',
				'CODPOSTAL' => 'required',
				'TELEFONO' => 'required',
				'EMAIL' => 'required|valid_email',
				'EMERGENCIA' => 'required',
				'TELEFONOEMERG' => 'required',
			);
			$this->sanitize_array = array(
				'TIPODOCUMENTO' => 'sanitize_string',
				'NRODOCUMENTO' => 'sanitize_string',
				'CONTACTO' => 'sanitize_string',
				'NOMBCOBERTURA' => 'sanitize_string',
				'DOMICILIO' => 'sanitize_string',
				'LOCALIDAD' => 'sanitize_string',
				'PROVINCIA' => 'sanitize_string',
				'CODPOSTAL' => 'sanitize_string',
				'TELEFONO' => 'sanitize_string',
				'EMAIL' => 'sanitize_string',
				'EMERGENCIA' => 'sanitize_string',
				'TELEFONOEMERG' => 'sanitize_string',
				'OBSERVAC' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Grabar agregado exitosamente", "success");
					return	$this->redirect("cobertura");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Agregar nuevo";
		$this->render_view("cobertura/add.php");
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
		$fields = $this->fields = array("CODCOBERTURA","TIPODOCUMENTO","NRODOCUMENTO","CONTACTO","NOMBCOBERTURA","DOMICILIO","LOCALIDAD","PROVINCIA","CODPOSTAL","TELEFONO","EMAIL","EMERGENCIA","TELEFONOEMERG","OBSERVAC");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'TIPODOCUMENTO' => 'required',
				'NRODOCUMENTO' => 'required|numeric',
				'CONTACTO' => 'required',
				'NOMBCOBERTURA' => 'required',
				'DOMICILIO' => 'required',
				'LOCALIDAD' => 'required',
				'PROVINCIA' => 'required',
				'CODPOSTAL' => 'required',
				'TELEFONO' => 'required',
				'EMAIL' => 'required|valid_email',
				'EMERGENCIA' => 'required',
				'TELEFONOEMERG' => 'required',
			);
			$this->sanitize_array = array(
				'TIPODOCUMENTO' => 'sanitize_string',
				'NRODOCUMENTO' => 'sanitize_string',
				'CONTACTO' => 'sanitize_string',
				'NOMBCOBERTURA' => 'sanitize_string',
				'DOMICILIO' => 'sanitize_string',
				'LOCALIDAD' => 'sanitize_string',
				'PROVINCIA' => 'sanitize_string',
				'CODPOSTAL' => 'sanitize_string',
				'TELEFONO' => 'sanitize_string',
				'EMAIL' => 'sanitize_string',
				'EMERGENCIA' => 'sanitize_string',
				'TELEFONOEMERG' => 'sanitize_string',
				'OBSERVAC' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("cobertura.CODCOBERTURA", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Registro actualizado con éxito", "success");
					return $this->redirect("cobertura");
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
						return	$this->redirect("cobertura");
					}
				}
			}
		}
		$db->where("cobertura.CODCOBERTURA", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Editar";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("cobertura/edit.php", $data);
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
		$db->where("cobertura.CODCOBERTURA", $arr_rec_id, "in");
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
		return	$this->redirect("cobertura");
	}
}
