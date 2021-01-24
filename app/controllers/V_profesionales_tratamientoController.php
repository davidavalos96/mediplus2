<?php 
/**
 * V_profesionales_tratamiento Page Controller
 * @category  Controller
 */
class V_profesionales_tratamientoController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "v_profesionales_tratamiento";
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
		$fields = array("ID", 
			"NRODOCPRO", 
			"FECHANACPRO", 
			"NOMBAPEPRO", 
			"tratamiento", 
			"codPrestacion", 
			"profesional", 
			"prestacion", 
			"ABREVIACION");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				v_profesionales_tratamiento.ID LIKE ? OR 
				v_profesionales_tratamiento.NRODOCPRO LIKE ? OR 
				v_profesionales_tratamiento.FECHANACPRO LIKE ? OR 
				v_profesionales_tratamiento.NOMBAPEPRO LIKE ? OR 
				v_profesionales_tratamiento.tratamiento LIKE ? OR 
				v_profesionales_tratamiento.codPrestacion LIKE ? OR 
				v_profesionales_tratamiento.profesional LIKE ? OR 
				v_profesionales_tratamiento.prestacion LIKE ? OR 
				v_profesionales_tratamiento.ABREVIACION LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "v_profesionales_tratamiento/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("v_profesionales_tratamiento.ID", ORDER_TYPE);
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
		$page_title = $this->view->page_title = "V Profesionales Tratamiento";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("v_profesionales_tratamiento/list.php", $data); //render the full page
	}
// No View Function Generated Because No Field is Defined as the Primary Key on the Database Table
}
