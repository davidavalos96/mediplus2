<?php 
/**
 * V_plan_terapeutico Page Controller
 * @category  Controller
 */
class V_plan_terapeuticoController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "v_plan_terapeutico";
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
		$fields = array("prestacion", 
			"NOMBAPEPRO", 
			"cant_sesiones");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				v_plan_terapeutico.prestacion LIKE ? OR 
				v_plan_terapeutico.NOMBAPEPRO LIKE ? OR 
				v_plan_terapeutico.paciente LIKE ? OR 
				v_plan_terapeutico.cant_sesiones LIKE ? OR 
				v_plan_terapeutico.fecha_finalizacion LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "v_plan_terapeutico/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("v_plan_terapeutico.prestacion", ORDER_TYPE);
		}
		$db->where("fecha_finalizacion >NOW()");
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
		$page_title = $this->view->page_title = "V Plan Terapeutico";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$view_name = (is_ajax() ? "v_plan_terapeutico/ajax-list.php" : "v_plan_terapeutico/list.php");
		$this->render_view($view_name, $data);
	}
// No View Function Generated Because No Field is Defined as the Primary Key on the Database Table
}
