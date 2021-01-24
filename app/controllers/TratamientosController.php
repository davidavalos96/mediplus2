<?php 
/**
 * Tratamientos Page Controller
 * @category  Controller
 */
class TratamientosController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "tratamientos";
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
		$fields = array("tratamientos.codTratamiento", 
			"tratamientos.fecha_inicio", 
			"tratamientos.fecha_finalizacion", 
			"pacientes.NUMDOCPAC AS pacientes_NUMDOCPAC", 
			"pacientes.NOMBAPEPAC AS pacientes_NOMBAPEPAC", 
			"estrategiaterapeutica.descripcion AS estrategiaterapeutica_descripcion");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				tratamientos.codTratamiento LIKE ? OR 
				tratamientos.fecha_inicio LIKE ? OR 
				tratamientos.fecha_finalizacion LIKE ? OR 
				tratamientos.estrategiaTerapeutica LIKE ? OR 
				tratamientos.paciente LIKE ? OR 
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
				estrategiaterapeutica.id LIKE ? OR 
				estrategiaterapeutica.descripcion LIKE ? OR 
				estrategiaterapeutica.modalidad LIKE ? OR 
				estrategiaterapeutica.cantSemanas LIKE ? OR 
				tratamientos.date_deleted LIKE ? OR 
				tratamientos.is_deleted LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "tratamientos/search.php";
		}
		$db->join("pacientes", "tratamientos.paciente = pacientes.idPaciente", "INNER");
		$db->join("estrategiaterapeutica", "tratamientos.estrategiaTerapeutica = estrategiaterapeutica.id", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("tratamientos.codTratamiento", ORDER_TYPE);
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
		if(	!empty($records)){
			foreach($records as &$record){
				$record['fecha_inicio'] = format_date($record['fecha_inicio'],'d-m-Y');
$record['fecha_finalizacion'] = format_date($record['fecha_finalizacion'],'d-m-Y');
			}
		}
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = $records_count;
		$data->total_records = $total_records;
		$data->total_page = $total_pages;
		if($db->getLastError()){
			$this->set_page_error();
		}
		$page_title = $this->view->page_title = "Tratamientos";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$view_name = (is_ajax() ? "tratamientos/ajax-list.php" : "tratamientos/list.php");
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
		$fields = array("tratamientos.codTratamiento", 
			"tratamientos.fecha_finalizacion", 
			"tratamientos.fecha_inicio", 
			"tratamientos.estrategiaTerapeutica", 
			"tratamientos.paciente", 
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
			"estrategiaterapeutica.id AS estrategiaterapeutica_id", 
			"estrategiaterapeutica.descripcion AS estrategiaterapeutica_descripcion", 
			"estrategiaterapeutica.modalidad AS estrategiaterapeutica_modalidad", 
			"estrategiaterapeutica.cantSemanas AS estrategiaterapeutica_cantSemanas");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("tratamientos.codTratamiento", $rec_id);; //select record based on primary key
		}
		$db->join("pacientes", "tratamientos.paciente = pacientes.idPaciente", "INNER ");
		$db->join("estrategiaterapeutica", "tratamientos.estrategiaTerapeutica = estrategiaterapeutica.id", "INNER ");  
		$record = $db->getOne($tablename, $fields );
		if($record){
			$record['fecha_finalizacion'] = format_date($record['fecha_finalizacion'],'d-m-Y');
$record['fecha_inicio'] = format_date($record['fecha_inicio'],'d-m-Y');
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
		return $this->render_view("tratamientos/view.php", $record);
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
			$fields = $this->fields = array("fecha_inicio","fecha_finalizacion","estrategiaTerapeutica","paciente");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'fecha_inicio' => 'required',
				'fecha_finalizacion' => 'required',
				'estrategiaTerapeutica' => 'required',
				'paciente' => 'required',
			);
			$this->sanitize_array = array(
				'fecha_inicio' => 'sanitize_string',
				'fecha_finalizacion' => 'sanitize_string',
				'estrategiaTerapeutica' => 'sanitize_string',
				'paciente' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Grabar agregado exitosamente", "success");
					return	$this->redirect("tratamientos");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Agregar nuevo";
		$this->render_view("tratamientos/add.php");
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
		$fields = $this->fields = array("codTratamiento","fecha_inicio","fecha_finalizacion","estrategiaTerapeutica","paciente");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'fecha_inicio' => 'required',
				'fecha_finalizacion' => 'required',
				'estrategiaTerapeutica' => 'required',
				'paciente' => 'required',
			);
			$this->sanitize_array = array(
				'fecha_inicio' => 'sanitize_string',
				'fecha_finalizacion' => 'sanitize_string',
				'estrategiaTerapeutica' => 'sanitize_string',
				'paciente' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("tratamientos.codTratamiento", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Registro actualizado con éxito", "success");
					return $this->redirect("tratamientos");
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
						return	$this->redirect("tratamientos");
					}
				}
			}
		}
		$db->where("tratamientos.codTratamiento", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Editar";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("tratamientos/edit.php", $data);
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
		$db->where("tratamientos.codTratamiento", $arr_rec_id, "in");
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
		return	$this->redirect("tratamientos");
	}
	/**
     * Update table record with formdata
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function formeditar($rec_id = null, $formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("codTratamiento","fecha_finalizacion","fecha_inicio","estrategiaTerapeutica","paciente");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'fecha_finalizacion' => 'required',
				'fecha_inicio' => 'required',
				'estrategiaTerapeutica' => 'required',
				'paciente' => 'required',
			);
			$this->sanitize_array = array(
				'fecha_finalizacion' => 'sanitize_string',
				'fecha_inicio' => 'sanitize_string',
				'estrategiaTerapeutica' => 'sanitize_string',
				'paciente' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("tratamientos.codTratamiento", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Registro actualizado con éxito", "success");
					return $this->redirect("tratamientos");
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
						return	$this->redirect("tratamientos");
					}
				}
			}
		}
		$db->where("tratamientos.codTratamiento", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Editar";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("tratamientos/formeditar.php", $data);
	}
	/**
     * Insert new record to the database table
	 * @param $formdata array() from $_POST
     * @return BaseView
     */
	function cronograma_horario($formdata = null){
		if($formdata){
			$db = $this->GetModel();
			$tablename = $this->tablename;
			$request = $this->request;
			//fillable fields
			$fields = $this->fields = array("paciente");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'paciente' => 'required',
			);
			$this->sanitize_array = array(
				'paciente' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("El registro se agrego correctamente", "success");
					return	$this->redirect("tratamientos");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Agregar nuevo";
		$this->render_view("tratamientos/cronograma_horario.php");
	}
}
