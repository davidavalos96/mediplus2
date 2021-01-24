<?php 
/**
 * Detatratamiento Page Controller
 * @category  Controller
 */
class DetatratamientoController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "detatratamiento";
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
		$fields = array("detatratamiento.codDetaTratamiento", 
			"especialidades.DESCRIPCION AS especialidades_DESCRIPCION", 
			"v_profesionales.NOMBAPEPRO AS v_profesionales_NOMBAPEPRO", 
			"detatratamiento.honorarios");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				detatratamiento.codDetaTratamiento LIKE ? OR 
				detatratamiento.tratamiento LIKE ? OR 
				detatratamiento.prestacion LIKE ? OR 
				especialidades.DESCRIPCION LIKE ? OR 
				detatratamiento.profesional LIKE ? OR 
				v_profesionales.NOMBAPEPRO LIKE ? OR 
				detatratamiento.honorarios LIKE ? OR 
				detatratamiento.date_deleted LIKE ? OR 
				detatratamiento.is_deleted LIKE ? OR 
				v_profesionales.ID LIKE ? OR 
				v_profesionales.NRODOCPRO LIKE ? OR 
				especialidades.CODIGO LIKE ? OR 
				especialidades.ABREVIACION LIKE ? OR 
				especialidades.date_deleted LIKE ? OR 
				especialidades.is_deleted LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "detatratamiento/search.php";
		}
		$db->join("v_profesionales", "detatratamiento.profesional = v_profesionales.ID", "INNER");
		$db->join("especialidades", "detatratamiento.prestacion = especialidades.CODIGO", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("detatratamiento.codDetaTratamiento", ORDER_TYPE);
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
		$page_title = $this->view->page_title = "Detalle del Tratamiento";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$view_name = (is_ajax() ? "detatratamiento/ajax-list.php" : "detatratamiento/list.php");
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
		$fields = array("detatratamiento.codDetaTratamiento", 
			"detatratamiento.tratamiento", 
			"detatratamiento.prestacion", 
			"detatratamiento.profesional", 
			"detatratamiento.honorarios", 
			"v_profesionales.ID AS v_profesionales_ID", 
			"v_profesionales.NRODOCPRO AS v_profesionales_NRODOCPRO", 
			"v_profesionales.NOMBAPEPRO AS v_profesionales_NOMBAPEPRO", 
			"especialidades.CODIGO AS especialidades_CODIGO", 
			"especialidades.DESCRIPCION AS especialidades_DESCRIPCION", 
			"especialidades.ABREVIACION AS especialidades_ABREVIACION", 
			"especialidades.date_deleted AS especialidades_date_deleted", 
			"especialidades.is_deleted AS especialidades_is_deleted");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("detatratamiento.codDetaTratamiento", $rec_id);; //select record based on primary key
		}
		$db->join("v_profesionales", "detatratamiento.profesional = v_profesionales.ID", "INNER ");
		$db->join("especialidades", "detatratamiento.prestacion = especialidades.CODIGO", "INNER ");  
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
		return $this->render_view("detatratamiento/view.php", $record);
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
			$fields = $this->fields = array("tratamiento","prestacion","profesional","honorarios");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'tratamiento' => 'required',
				'prestacion' => 'required',
				'profesional' => 'required',
				'honorarios' => 'required|numeric',
			);
			$this->sanitize_array = array(
				'tratamiento' => 'sanitize_string',
				'prestacion' => 'sanitize_string',
				'profesional' => 'sanitize_string',
				'honorarios' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Prestación guardada exitosamente.", "success");
					return	$this->redirect("detatratamiento");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Agregar nuevo";
		$this->render_view("detatratamiento/add.php");
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
		$fields = $this->fields = array("codDetaTratamiento","tratamiento","prestacion","profesional","honorarios");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'tratamiento' => 'required',
				'prestacion' => 'required',
				'profesional' => 'required',
				'honorarios' => 'required|numeric',
			);
			$this->sanitize_array = array(
				'tratamiento' => 'sanitize_string',
				'prestacion' => 'sanitize_string',
				'profesional' => 'sanitize_string',
				'honorarios' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("detatratamiento.codDetaTratamiento", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Registro actualizado con éxito", "success");
					return $this->redirect("detatratamiento");
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
						return	$this->redirect("detatratamiento");
					}
				}
			}
		}
		$db->where("detatratamiento.codDetaTratamiento", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Editar";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("detatratamiento/edit.php", $data);
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
		$db->where("detatratamiento.codDetaTratamiento", $arr_rec_id, "in");
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
		return	$this->redirect("detatratamiento");
	}
}
