<?php 
/**
 * Sesiones_tratamiento Page Controller
 * @category  Controller
 */
class Sesiones_tratamientoController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "sesiones_tratamiento";
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
		$fields = array("sesiones_tratamiento.codSesion", 
			"dias.nombre AS dias_nombre", 
			"sesiones_tratamiento.desde", 
			"sesiones_tratamiento.hasta", 
			"sesiones_tratamiento.cantSesiones", 
			"sesiones_tratamiento.consultorio");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				sesiones_tratamiento.codSesion LIKE ? OR 
				sesiones_tratamiento.tratamiento LIKE ? OR 
				sesiones_tratamiento.dia LIKE ? OR 
				dias.nombre LIKE ? OR 
				sesiones_tratamiento.desde LIKE ? OR 
				sesiones_tratamiento.hasta LIKE ? OR 
				sesiones_tratamiento.cantSesiones LIKE ? OR 
				sesiones_tratamiento.consultorio LIKE ? OR 
				dias.codDia LIKE ? OR 
				sesiones_tratamiento.date_deleted LIKE ? OR 
				sesiones_tratamiento.is_deleted LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "sesiones_tratamiento/search.php";
		}
		$db->join("dias", "sesiones_tratamiento.dia = dias.codDia", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("sesiones_tratamiento.codSesion", ORDER_TYPE);
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
		$page_title = $this->view->page_title = "Sesiones Tratamiento";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$view_name = (is_ajax() ? "sesiones_tratamiento/ajax-list.php" : "sesiones_tratamiento/list.php");
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
		$fields = array("sesiones_tratamiento.codSesion", 
			"sesiones_tratamiento.tratamiento", 
			"sesiones_tratamiento.dia", 
			"sesiones_tratamiento.desde", 
			"sesiones_tratamiento.hasta", 
			"sesiones_tratamiento.cantSesiones", 
			"dias.codDia AS dias_codDia", 
			"dias.nombre AS dias_nombre", 
			"dias.codDia AS dias_codDia", 
			"dias.nombre AS dias_nombre", 
			"sesiones_tratamiento.consultorio");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("sesiones_tratamiento.codSesion", $rec_id);; //select record based on primary key
		}
		$db->join("dias", "sesiones_tratamiento.dia = dias.codDia", "INNER ");  
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
		return $this->render_view("sesiones_tratamiento/view.php", $record);
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
			$fields = $this->fields = array("tratamiento","dia","desde","hasta","cantSesiones","consultorio");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'tratamiento' => 'required|numeric',
				'dia' => 'required|numeric',
				'desde' => 'required',
				'hasta' => 'required',
				'cantSesiones' => 'required|numeric',
				'consultorio' => 'required',
			);
			$this->sanitize_array = array(
				'tratamiento' => 'sanitize_string',
				'dia' => 'sanitize_string',
				'desde' => 'sanitize_string',
				'hasta' => 'sanitize_string',
				'cantSesiones' => 'sanitize_string',
				'consultorio' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Grabar agregado exitosamente", "success");
					return	$this->redirect("sesiones_tratamiento");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Agregar nuevo";
		$this->render_view("sesiones_tratamiento/add.php");
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
		$fields = $this->fields = array("codSesion","tratamiento","dia","desde","hasta","cantSesiones","consultorio");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'tratamiento' => 'required|numeric',
				'dia' => 'required|numeric',
				'desde' => 'required',
				'hasta' => 'required',
				'cantSesiones' => 'required|numeric',
				'consultorio' => 'required',
			);
			$this->sanitize_array = array(
				'tratamiento' => 'sanitize_string',
				'dia' => 'sanitize_string',
				'desde' => 'sanitize_string',
				'hasta' => 'sanitize_string',
				'cantSesiones' => 'sanitize_string',
				'consultorio' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("sesiones_tratamiento.codSesion", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Registro actualizado con éxito", "success");
					return $this->redirect("sesiones_tratamiento");
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
						return	$this->redirect("sesiones_tratamiento");
					}
				}
			}
		}
		$db->where("sesiones_tratamiento.codSesion", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Editar";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("sesiones_tratamiento/edit.php", $data);
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
		$fields = $this->fields = array("codSesion","tratamiento","dia","desde","hasta","cantSesiones","consultorio");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
				'tratamiento' => 'required|numeric',
				'dia' => 'required|numeric',
				'desde' => 'required',
				'hasta' => 'required',
				'cantSesiones' => 'required|numeric',
				'consultorio' => 'required',
			);
			$this->sanitize_array = array(
				'tratamiento' => 'sanitize_string',
				'dia' => 'sanitize_string',
				'desde' => 'sanitize_string',
				'hasta' => 'sanitize_string',
				'cantSesiones' => 'sanitize_string',
				'consultorio' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("sesiones_tratamiento.codSesion", $rec_id);;
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
		$db->where("sesiones_tratamiento.codSesion", $arr_rec_id, "in");
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
		return	$this->redirect("sesiones_tratamiento");
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function lista($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("sesiones_tratamiento.codSesion", 
			"dias.nombre AS dias_nombre", 
			"sesiones_tratamiento.desde", 
			"sesiones_tratamiento.hasta", 
			"sesiones_tratamiento.cantSesiones", 
			"sesiones_tratamiento.consultorio");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				sesiones_tratamiento.codSesion LIKE ? OR 
				sesiones_tratamiento.tratamiento LIKE ? OR 
				sesiones_tratamiento.dia LIKE ? OR 
				dias.nombre LIKE ? OR 
				sesiones_tratamiento.desde LIKE ? OR 
				sesiones_tratamiento.hasta LIKE ? OR 
				sesiones_tratamiento.cantSesiones LIKE ? OR 
				dias.codDia LIKE ? OR 
				sesiones_tratamiento.date_deleted LIKE ? OR 
				sesiones_tratamiento.is_deleted LIKE ? OR 
				sesiones_tratamiento.consultorio LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "sesiones_tratamiento/search.php";
		}
		$db->join("dias", "sesiones_tratamiento.dia = dias.codDia", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("sesiones_tratamiento.codSesion", ORDER_TYPE);
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
		$page_title = $this->view->page_title = "Sesiones Tratamiento";
		$this->render_view("sesiones_tratamiento/lista.php", $data); //render the full page
	}
}
