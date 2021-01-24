<?php 
/**
 * Historiaclinica Page Controller
 * @category  Controller
 */
class HistoriaclinicaController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "historiaclinica";
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
		$fields = array("historiaclinica.id", 
			"pacientes.NUMDOCPAC AS pacientes_NUMDOCPAC", 
			"pacientes.FECHANACPAC AS pacientes_FECHANACPAC", 
			"pacientes.NOMBAPEPAC AS pacientes_NOMBAPEPAC", 
			"historiaclinica.ultima_modif", 
			"historiaclinica.usuario");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				historiaclinica.id LIKE ? OR 
				historiaclinica.paciente LIKE ? OR 
				pacientes.idPaciente LIKE ? OR 
				pacientes.NUMDOCPAC LIKE ? OR 
				pacientes.FECHANACPAC LIKE ? OR 
				pacientes.FECHACERTVTO LIKE ? OR 
				pacientes.NOMBAPEPAC LIKE ? OR 
				historiaclinica.ultima_modif LIKE ? OR 
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
				historiaclinica.usuario LIKE ? OR 
				historiaclinica.date_deleted LIKE ? OR 
				historiaclinica.is_deleted LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "historiaclinica/search.php";
		}
		$db->join("pacientes", "historiaclinica.paciente = pacientes.idPaciente", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("historiaclinica.id", ORDER_TYPE);
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
		$page_title = $this->view->page_title = "Historiaclinica";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("historiaclinica/list.php", $data); //render the full page
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
		$fields = array("historiaclinica.id", 
			"historiaclinica.paciente", 
			"historiaclinica.ultima_modif", 
			"pacientes.idPaciente AS pacientes_idPaciente", 
			"pacientes.NUMDOCPAC AS pacientes_NUMDOCPAC", 
			"pacientes.FECHANACPAC AS pacientes_FECHANACPAC", 
			"pacientes.FECHACERTVTO AS pacientes_FECHACERTVTO", 
			"pacientes.NOMBAPEPAC AS pacientes_NOMBAPEPAC", 
			"pacientes.COORDINADOR AS pacientes_COORDINADOR", 
			"pacientes.COBERTURA AS pacientes_COBERTURA", 
			"pacientes.PLANOBRASOC AS pacientes_PLANOBRASOC", 
			"pacientes.NROAFILIADO AS pacientes_NROAFILIADO", 
			"pacientes.DOMICILIO AS pacientes_DOMICILIO", 
			"pacientes.barrio AS pacientes_barrio", 
			"pacientes.LOCALIDAD AS pacientes_LOCALIDAD", 
			"pacientes.TELEFONO AS pacientes_TELEFONO", 
			"pacientes.EMAIL AS pacientes_EMAIL", 
			"pacientes.DIAGNOSTICO AS pacientes_DIAGNOSTICO", 
			"pacientes.MEDICODERIV AS pacientes_MEDICODERIV", 
			"pacientes.ESTADOPACIENTE AS pacientes_ESTADOPACIENTE", 
			"historiaclinica.usuario");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("historiaclinica.id", $rec_id);; //select record based on primary key
		}
		$db->join("pacientes", "historiaclinica.paciente = pacientes.idPaciente", "INNER ");  
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
		return $this->render_view("historiaclinica/view.php", $record);
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
			$fields = $this->fields = array("paciente","ultima_modif","usuario");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'paciente' => 'required',
				'ultima_modif' => 'required',
				'usuario' => 'required|numeric',
			);
			$this->sanitize_array = array(
				'paciente' => 'sanitize_string',
				'ultima_modif' => 'sanitize_string',
				'usuario' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Grabar agregado exitosamente", "success");
					return	$this->redirect("historiaclinica");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Agregar nuevo";
		$this->render_view("historiaclinica/add.php");
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
		$fields = $this->fields = array("id","paciente","ultima_modif","usuario");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'paciente' => 'required',
				'ultima_modif' => 'required',
				'usuario' => 'required|numeric',
			);
			$this->sanitize_array = array(
				'paciente' => 'sanitize_string',
				'ultima_modif' => 'sanitize_string',
				'usuario' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("historiaclinica.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Registro actualizado con éxito", "success");
					return $this->redirect("historiaclinica");
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
						return	$this->redirect("historiaclinica");
					}
				}
			}
		}
		$db->where("historiaclinica.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Editar";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("historiaclinica/edit.php", $data);
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
		$fields = $this->fields = array("id","paciente","ultima_modif","usuario");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
				'paciente' => 'required',
				'ultima_modif' => 'required',
				'usuario' => 'required|numeric',
			);
			$this->sanitize_array = array(
				'paciente' => 'sanitize_string',
				'ultima_modif' => 'sanitize_string',
				'usuario' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("historiaclinica.id", $rec_id);;
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
		$db->where("historiaclinica.id", $arr_rec_id, "in");
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
		return	$this->redirect("historiaclinica");
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
		$fields = array("id", 
			"paciente", 
			"ultima_modif", 
			"usuario");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				historiaclinica.id LIKE ? OR 
				historiaclinica.paciente LIKE ? OR 
				historiaclinica.ultima_modif LIKE ? OR 
				historiaclinica.usuario LIKE ? OR 
				historiaclinica.date_deleted LIKE ? OR 
				historiaclinica.is_deleted LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "historiaclinica/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("historiaclinica.id", ORDER_TYPE);
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
		$page_title = $this->view->page_title = "Historiaclinica";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("historiaclinica/configuracion.php", $data); //render the full page
	}
}
