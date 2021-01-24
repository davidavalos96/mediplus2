<?php 
/**
 * V_horarios_paciente Page Controller
 * @category  Controller
 */
class V_horarios_pacienteController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "v_horarios_paciente";
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
		$fields = array("tratamiento", 
			"dia", 
			"desde", 
			"hasta", 
			"cantSesiones", 
			"consultorio", 
			"paciente", 
			"codSesion", 
			"prestacion");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				v_horarios_paciente.tratamiento LIKE ? OR 
				v_horarios_paciente.dia LIKE ? OR 
				v_horarios_paciente.desde LIKE ? OR 
				v_horarios_paciente.hasta LIKE ? OR 
				v_horarios_paciente.cantSesiones LIKE ? OR 
				v_horarios_paciente.consultorio LIKE ? OR 
				v_horarios_paciente.paciente LIKE ? OR 
				v_horarios_paciente.codSesion LIKE ? OR 
				v_horarios_paciente.prestacion LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "v_horarios_paciente/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("v_horarios_paciente.tratamiento", ORDER_TYPE);
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
		$page_title = $this->view->page_title = "V Horarios Paciente";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("v_horarios_paciente/list.php", $data); //render the full page
	}
// No View Function Generated Because No Field is Defined as the Primary Key on the Database Table
}
