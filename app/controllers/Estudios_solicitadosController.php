<?php 
/**
 * Estudios_solicitados Page Controller
 * @category  Controller
 */
class Estudios_solicitadosController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "estudios_solicitados";
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
		$fields = array("estudios_solicitados.id", 
			"estudios_solicitados.fecha", 
			"tipo_estudio.descripcion AS tipo_estudio_descripcion", 
			"estudios_solicitados.archivo");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				estudios_solicitados.id LIKE ? OR 
				estudios_solicitados.fecha LIKE ? OR 
				estudios_solicitados.tipo_estudio LIKE ? OR 
				tipo_estudio.descripcion LIKE ? OR 
				estudios_solicitados.archivo LIKE ? OR 
				estudios_solicitados.paciente LIKE ? OR 
				tipo_estudio.id LIKE ? OR 
				estudios_solicitados.date_deleted LIKE ? OR 
				estudios_solicitados.is_deleted LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "estudios_solicitados/search.php";
		}
		$db->join("tipo_estudio", "estudios_solicitados.tipo_estudio = tipo_estudio.id", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("estudios_solicitados.id", ORDER_TYPE);
		}
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		if(!empty($request->estudios_solicitados_fecha)){
			$vals = explode("-to-", str_replace(" ", "", $request->estudios_solicitados_fecha));
			$startdate = $vals[0];
			$enddate = $vals[1];
			$db->where("estudios_solicitados.fecha BETWEEN '$startdate' AND '$enddate'");
		}
		if(!empty($request->estudios_solicitados_tipo_estudio)){
			$val = $request->estudios_solicitados_tipo_estudio;
			$db->where("estudios_solicitados.tipo_estudio", $val , "=");
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
		$page_title = $this->view->page_title = "Estudios Solicitados";
		$this->render_view("estudios_solicitados/list.php", $data); //render the full page
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
		$fields = array("estudios_solicitados.id", 
			"estudios_solicitados.fecha", 
			"estudios_solicitados.tipo_estudio", 
			"estudios_solicitados.archivo", 
			"estudios_solicitados.paciente", 
			"tipo_estudio.id AS tipo_estudio_id", 
			"tipo_estudio.descripcion AS tipo_estudio_descripcion");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("estudios_solicitados.id", $rec_id);; //select record based on primary key
		}
		$db->join("tipo_estudio", "estudios_solicitados.tipo_estudio = tipo_estudio.id", "INNER ");  
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
		return $this->render_view("estudios_solicitados/view.php", $record);
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
			$fields = $this->fields = array("fecha","tipo_estudio","archivo","paciente");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'fecha' => 'required',
				'tipo_estudio' => 'required',
				'archivo' => 'required',
				'paciente' => 'required',
			);
			$this->sanitize_array = array(
				'fecha' => 'sanitize_string',
				'tipo_estudio' => 'sanitize_string',
				'archivo' => 'sanitize_string',
				'paciente' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("El registro se agrego correctamente", "success");
					return	$this->redirect("historiaclinica/edit/".ID_PACIENTE."");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Agregar nuevo";
		$this->render_view("estudios_solicitados/add.php");
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
		$fields = $this->fields = array("id","fecha","tipo_estudio","archivo","paciente");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'fecha' => 'required',
				'tipo_estudio' => 'required',
				'archivo' => 'required',
				'paciente' => 'required',
			);
			$this->sanitize_array = array(
				'fecha' => 'sanitize_string',
				'tipo_estudio' => 'sanitize_string',
				'archivo' => 'sanitize_string',
				'paciente' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("estudios_solicitados.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("El registro se actualizo correctamente", "success");
					return $this->redirect("historiaclinica/edit/".ID_PACIENTE."");
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
						return	$this->redirect("historiaclinica/edit/".ID_PACIENTE."");
					}
				}
			}
		}
		$db->where("estudios_solicitados.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Editar";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("estudios_solicitados/edit.php", $data);
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
		$db->where("estudios_solicitados.id", $arr_rec_id, "in");
		$modeldata = array(
			"is_deleted" => "1",
			"date_deleted" => datetime_now()
		);
		$bool = $db->update($tablename, $modeldata);
		if($bool){
			$this->set_flash_msg("El registro se borro con exito", "success");
		}
		else{
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("historiaclinica/edit/".ID_PACIENTE."");
	}
}
