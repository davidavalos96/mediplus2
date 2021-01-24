<?php 
/**
 * Horariosprofesionales Page Controller
 * @category  Controller
 */
class HorariosprofesionalesController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "horariosprofesionales";
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
		$fields = array("horariosprofesionales.IDHORARIO", 
			"dias.nombre AS dias_nombre", 
			"horariosprofesionales.DESDE", 
			"horariosprofesionales.HASTA", 
			"horariosprofesionales.duracion");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				horariosprofesionales.IDHORARIO LIKE ? OR 
				horariosprofesionales.DIA LIKE ? OR 
				dias.nombre LIKE ? OR 
				horariosprofesionales.PROFESIONAL LIKE ? OR 
				horariosprofesionales.DESDE LIKE ? OR 
				horariosprofesionales.HASTA LIKE ? OR 
				horariosprofesionales.date_deleted LIKE ? OR 
				horariosprofesionales.is_deleted LIKE ? OR 
				dias.codDia LIKE ? OR 
				dias.date_deleted LIKE ? OR 
				dias.is_deleted LIKE ? OR 
				horariosprofesionales.duracion LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "horariosprofesionales/search.php";
		}
		$db->join("dias", "horariosprofesionales.DIA = dias.codDia", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("DIA", "ASC");
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
		$page_title = $this->view->page_title = "Horariosprofesionales";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("horariosprofesionales/list.php", $data); //render the full page
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
		$fields = array("horariosprofesionales.IDHORARIO", 
			"horariosprofesionales.DIA", 
			"horariosprofesionales.PROFESIONAL", 
			"horariosprofesionales.DESDE", 
			"horariosprofesionales.HASTA", 
			"dias.codDia AS dias_codDia", 
			"dias.nombre AS dias_nombre", 
			"dias.date_deleted AS dias_date_deleted", 
			"dias.is_deleted AS dias_is_deleted", 
			"horariosprofesionales.duracion");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("horariosprofesionales.IDHORARIO", $rec_id);; //select record based on primary key
		}
		$db->join("dias", "horariosprofesionales.DIA = dias.codDia", "INNER ");  
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
		return $this->render_view("horariosprofesionales/view.php", $record);
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
			$fields = $this->fields = array("DIA","PROFESIONAL","DESDE","HASTA","duracion");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'DIA' => 'required|numeric',
				'PROFESIONAL' => 'required|numeric',
				'DESDE' => 'required',
				'HASTA' => 'required',
				'duracion' => 'required|numeric',
			);
			$this->sanitize_array = array(
				'DIA' => 'sanitize_string',
				'PROFESIONAL' => 'sanitize_string',
				'DESDE' => 'sanitize_string',
				'HASTA' => 'sanitize_string',
				'duracion' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Grabar agregado exitosamente", "success");
					return	$this->redirect("horariosprofesionales");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Agregar nuevo";
		$this->render_view("horariosprofesionales/add.php");
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
		$fields = $this->fields = array("IDHORARIO","DIA","PROFESIONAL","DESDE","HASTA","duracion");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'DIA' => 'required|numeric',
				'PROFESIONAL' => 'required|numeric',
				'DESDE' => 'required',
				'HASTA' => 'required',
				'duracion' => 'required|numeric',
			);
			$this->sanitize_array = array(
				'DIA' => 'sanitize_string',
				'PROFESIONAL' => 'sanitize_string',
				'DESDE' => 'sanitize_string',
				'HASTA' => 'sanitize_string',
				'duracion' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("horariosprofesionales.IDHORARIO", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Registro actualizado con éxito", "success");
					return $this->redirect("horariosprofesionales");
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
						return	$this->redirect("horariosprofesionales");
					}
				}
			}
		}
		$db->where("horariosprofesionales.IDHORARIO", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Editar";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("horariosprofesionales/edit.php", $data);
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
		$fields = $this->fields = array("IDHORARIO","DIA","PROFESIONAL","DESDE","HASTA","duracion");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
				'DIA' => 'required|numeric',
				'PROFESIONAL' => 'required|numeric',
				'DESDE' => 'required',
				'HASTA' => 'required',
				'duracion' => 'required|numeric',
			);
			$this->sanitize_array = array(
				'DIA' => 'sanitize_string',
				'PROFESIONAL' => 'sanitize_string',
				'DESDE' => 'sanitize_string',
				'HASTA' => 'sanitize_string',
				'duracion' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("horariosprofesionales.IDHORARIO", $rec_id);;
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
		$db->where("horariosprofesionales.IDHORARIO", $arr_rec_id, "in");
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
		return	$this->redirect("horariosprofesionales");
	}
}
