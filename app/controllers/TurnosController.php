<?php 
/**
 * Turnos Page Controller
 * @category  Controller
 */
class TurnosController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "turnos";
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
		$fields = array("ID", 
			"IDPROFESIONAL", 
			"IDPACIENTE", 
			"IDESPECIALIDAD", 
			"FECHATURNO", 
			"HSTURNO", 
			"ESTADOTURNO", 
			"TIPOTURNO", 
			"OBSERVACION", 
			"IDCONSULTORIO", 
			"DURACION", 
			"auxiliar", 
			"CANTSESIONES");
		$pagination = $this->get_pagination(9999999); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				turnos.ID LIKE ? OR 
				turnos.IDPROFESIONAL LIKE ? OR 
				turnos.IDPACIENTE LIKE ? OR 
				turnos.IDESPECIALIDAD LIKE ? OR 
				turnos.FECHATURNO LIKE ? OR 
				turnos.HSTURNO LIKE ? OR 
				turnos.ESTADOTURNO LIKE ? OR 
				turnos.TIPOTURNO LIKE ? OR 
				turnos.OBSERVACION LIKE ? OR 
				turnos.IDCONSULTORIO LIKE ? OR 
				turnos.DURACION LIKE ? OR 
				turnos.auxiliar LIKE ? OR 
				turnos.CANTSESIONES LIKE ? OR 
				turnos.date_deleted LIKE ? OR 
				turnos.is_deleted LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "turnos/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("turnos.ID", ORDER_TYPE);
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
		$page_title = $this->view->page_title = "Turnos";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$view_name = (is_ajax() ? "turnos/ajax-list.php" : "turnos/list.php");
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
		$fields = array("turnos.ID", 
			"turnos.IDPROFESIONAL", 
			"turnos.IDPACIENTE", 
			"turnos.IDESPECIALIDAD", 
			"turnos.FECHATURNO", 
			"turnos.HSTURNO", 
			"turnos.ESTADOTURNO", 
			"turnos.TIPOTURNO", 
			"turnos.OBSERVACION", 
			"turnos.IDCONSULTORIO", 
			"turnos.DURACION", 
			"turnos.auxiliar", 
			"turnos.CANTSESIONES", 
			"especialidades.CODIGO AS especialidades_CODIGO", 
			"especialidades.DESCRIPCION AS especialidades_DESCRIPCION", 
			"especialidades.ABREVIACION AS especialidades_ABREVIACION", 
			"estadoturno.idEstadoTurno AS estadoturno_idEstadoTurno", 
			"estadoturno.descripcion AS estadoturno_descripcion", 
			"estadoturno.cantSesiones AS estadoturno_cantSesiones", 
			"estadoturno.COLOR AS estadoturno_COLOR", 
			"v_profesionales.ID AS v_profesionales_ID", 
			"v_profesionales.NRODOCPRO AS v_profesionales_NRODOCPRO", 
			"v_profesionales.NOMBAPEPRO AS v_profesionales_NOMBAPEPRO", 
			"v_paciente.idPaciente AS v_paciente_idPaciente", 
			"v_paciente.NUMDOCPAC AS v_paciente_NUMDOCPAC", 
			"v_paciente.NOMBAPEPAC AS v_paciente_NOMBAPEPAC", 
			"estadoturno.idEstadoTurno AS estadoturno_idEstadoTurno", 
			"estadoturno.descripcion AS estadoturno_descripcion", 
			"estadoturno.cantSesiones AS estadoturno_cantSesiones", 
			"estadoturno.COLOR AS estadoturno_COLOR", 
			"estadoturno.date_deleted AS estadoturno_date_deleted", 
			"estadoturno.is_deleted AS estadoturno_is_deleted", 
			"consultorio.CODIGO AS consultorio_CODIGO", 
			"consultorio.DESCRIPCION AS consultorio_DESCRIPCION", 
			"consultorio.date_deleted AS consultorio_date_deleted", 
			"consultorio.is_deleted AS consultorio_is_deleted", 
			"especialidades.CODIGO AS especialidades_CODIGO", 
			"especialidades.DESCRIPCION AS especialidades_DESCRIPCION", 
			"especialidades.ABREVIACION AS especialidades_ABREVIACION", 
			"especialidades.date_deleted AS especialidades_date_deleted", 
			"especialidades.is_deleted AS especialidades_is_deleted");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("turnos.ID", $rec_id);; //select record based on primary key
		}
		$db->join("especialidades", "turnos.IDESPECIALIDAD = especialidades.CODIGO", "INNER ");  
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
		return $this->render_view("turnos/view.php", $record);
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
			$fields = $this->fields = array("IDPROFESIONAL","IDPACIENTE","IDESPECIALIDAD","FECHATURNO","HSTURNO","IDCONSULTORIO","TIPOTURNO","ESTADOTURNO","CANTSESIONES","DURACION","OBSERVACION");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'IDPROFESIONAL' => 'required',
				'IDPACIENTE' => 'required',
				'IDESPECIALIDAD' => 'required',
				'FECHATURNO' => 'required',
				'HSTURNO' => 'required',
				'IDCONSULTORIO' => 'required',
				'TIPOTURNO' => 'required',
				'ESTADOTURNO' => 'required',
				'CANTSESIONES' => 'required|numeric',
				'DURACION' => 'required',
				'OBSERVACION' => 'required',
			);
			$this->sanitize_array = array(
				'IDPROFESIONAL' => 'sanitize_string',
				'IDPACIENTE' => 'sanitize_string',
				'IDESPECIALIDAD' => 'sanitize_string',
				'FECHATURNO' => 'sanitize_string',
				'HSTURNO' => 'sanitize_string',
				'IDCONSULTORIO' => 'sanitize_string',
				'TIPOTURNO' => 'sanitize_string',
				'ESTADOTURNO' => 'sanitize_string',
				'CANTSESIONES' => 'sanitize_string',
				'DURACION' => 'sanitize_string',
				'OBSERVACION' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Grabar agregado exitosamente", "success");
					return	$this->redirect("turnos");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Agregar nuevo";
		$this->render_view("turnos/add.php");
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
		$fields = $this->fields = array("ID","IDPROFESIONAL","IDPACIENTE","IDESPECIALIDAD","FECHATURNO","HSTURNO","IDCONSULTORIO","TIPOTURNO","ESTADOTURNO","CANTSESIONES","DURACION","OBSERVACION");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'IDPROFESIONAL' => 'required',
				'IDPACIENTE' => 'required',
				'IDESPECIALIDAD' => 'required',
				'FECHATURNO' => 'required',
				'HSTURNO' => 'required',
				'IDCONSULTORIO' => 'required',
				'TIPOTURNO' => 'required',
				'ESTADOTURNO' => 'required',
				'CANTSESIONES' => 'required|numeric',
				'DURACION' => 'required',
				'OBSERVACION' => 'required',
			);
			$this->sanitize_array = array(
				'IDPROFESIONAL' => 'sanitize_string',
				'IDPACIENTE' => 'sanitize_string',
				'IDESPECIALIDAD' => 'sanitize_string',
				'FECHATURNO' => 'sanitize_string',
				'HSTURNO' => 'sanitize_string',
				'IDCONSULTORIO' => 'sanitize_string',
				'TIPOTURNO' => 'sanitize_string',
				'ESTADOTURNO' => 'sanitize_string',
				'CANTSESIONES' => 'sanitize_string',
				'DURACION' => 'sanitize_string',
				'OBSERVACION' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("turnos.ID", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Registro actualizado con éxito", "success");
					return $this->redirect("turnos");
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
						return	$this->redirect("turnos");
					}
				}
			}
		}
		$db->where("turnos.ID", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Editar";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("turnos/edit.php", $data);
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
		$fields = $this->fields = array("ID","IDPROFESIONAL","IDPACIENTE","IDESPECIALIDAD","FECHATURNO","HSTURNO","IDCONSULTORIO","TIPOTURNO","ESTADOTURNO","CANTSESIONES","DURACION","OBSERVACION");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
				'IDPROFESIONAL' => 'required',
				'IDPACIENTE' => 'required',
				'IDESPECIALIDAD' => 'required',
				'FECHATURNO' => 'required',
				'HSTURNO' => 'required',
				'IDCONSULTORIO' => 'required',
				'TIPOTURNO' => 'required',
				'ESTADOTURNO' => 'required',
				'CANTSESIONES' => 'required|numeric',
				'DURACION' => 'required',
				'OBSERVACION' => 'required',
			);
			$this->sanitize_array = array(
				'IDPROFESIONAL' => 'sanitize_string',
				'IDPACIENTE' => 'sanitize_string',
				'IDESPECIALIDAD' => 'sanitize_string',
				'FECHATURNO' => 'sanitize_string',
				'HSTURNO' => 'sanitize_string',
				'IDCONSULTORIO' => 'sanitize_string',
				'TIPOTURNO' => 'sanitize_string',
				'ESTADOTURNO' => 'sanitize_string',
				'CANTSESIONES' => 'sanitize_string',
				'DURACION' => 'sanitize_string',
				'OBSERVACION' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("turnos.ID", $rec_id);;
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
		$db->where("turnos.ID", $arr_rec_id, "in");
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
		return	$this->redirect("turnos");
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
		$fields = array("turnos.ID", 
			"turnos.FECHATURNO", 
			"turnos.HSTURNO", 
			"SEC_TO_TIME(TIME_TO_SEC(HSTURNO)+TIME_TO_SEC(DURACION)) AS HSSALIDA", 
			"(SELECT IFNULL(DESCRIPCION,'Sin Definir') FROM CONSULTORIO WHERE CONSULTORIO.CODIGO=turnos.IDCONSULTORIO) AS CONSULTORIO", 
			"turnos.CANTSESIONES", 
			"pacientes.idPaciente AS pacientes_idPaciente", 
			"pacientes.NOMBAPEPAC AS pacientes_NOMBAPEPAC", 
			"profesionales.NOMBAPEPRO AS profesionales_NOMBAPEPRO", 
			"especialidades.DESCRIPCION AS especialidades_DESCRIPCION", 
			"especialidades.ABREVIACION AS especialidades_ABREVIACION", 
			"estadoturno.descripcion AS estadoturno_descripcion", 
			"estadoturno.cantSesiones AS estadoturno_cantSesiones", 
			"estadoturno.COLOR AS estadoturno_COLOR");
		$pagination = $this->get_pagination(150); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				turnos.ID LIKE ? OR 
				turnos.IDPROFESIONAL LIKE ? OR 
				turnos.IDPACIENTE LIKE ? OR 
				turnos.IDESPECIALIDAD LIKE ? OR 
				turnos.FECHATURNO LIKE ? OR 
				turnos.HSTURNO LIKE ? OR 
				turnos.ESTADOTURNO LIKE ? OR 
				turnos.TIPOTURNO LIKE ? OR 
				turnos.OBSERVACION LIKE ? OR 
				turnos.IDCONSULTORIO LIKE ? OR 
				turnos.DURACION LIKE ? OR 
				turnos.auxiliar LIKE ? OR 
				turnos.HSSALIDA LIKE ? OR 
				turnos.CONSULTORIO LIKE ? OR 
				turnos.CANTSESIONES LIKE ? OR 
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
				profesionales.ID LIKE ? OR 
				profesionales.FECHAALTA LIKE ? OR 
				profesionales.FECHABAJA LIKE ? OR 
				profesionales.TIPODOCPRO LIKE ? OR 
				profesionales.NRODOCPRO LIKE ? OR 
				profesionales.FECHANACPRO LIKE ? OR 
				profesionales.NOMBAPEPRO LIKE ? OR 
				profesionales.DOMICILIO LIKE ? OR 
				profesionales.BARRIO LIKE ? OR 
				profesionales.LOCALIDAD LIKE ? OR 
				profesionales.TELPARTPRO LIKE ? OR 
				profesionales.TELCELPRO LIKE ? OR 
				profesionales.EMAIL LIKE ? OR 
				profesionales.NROMATRICULA LIKE ? OR 
				profesionales.FECHAVTOMAT LIKE ? OR 
				profesionales.NRORNP LIKE ? OR 
				profesionales.FECHAVTORNP LIKE ? OR 
				profesionales.EXEINGRESOSBRUTOS LIKE ? OR 
				profesionales.POLIZA LIKE ? OR 
				profesionales.HORALUN LIKE ? OR 
				profesionales.HORAMAR LIKE ? OR 
				profesionales.HORAMIE LIKE ? OR 
				profesionales.HORAJUE LIKE ? OR 
				profesionales.HORAVIE LIKE ? OR 
				profesionales.HORASAB LIKE ? OR 
				profesionales.CONVENIOS LIKE ? OR 
				profesionales.ESPECIALIDAD1 LIKE ? OR 
				profesionales.ESPECIALIDAD2 LIKE ? OR 
				profesionales.ESPECIALIDAD3 LIKE ? OR 
				especialidades.CODIGO LIKE ? OR 
				especialidades.DESCRIPCION LIKE ? OR 
				especialidades.ABREVIACION LIKE ? OR 
				estadoturno.idEstadoTurno LIKE ? OR 
				estadoturno.descripcion LIKE ? OR 
				estadoturno.cantSesiones LIKE ? OR 
				estadoturno.COLOR LIKE ? OR 
				turnos.date_deleted LIKE ? OR 
				turnos.is_deleted LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "turnos/search.php";
		}
		$db->join("pacientes", "turnos.IDPACIENTE = pacientes.idPaciente", "INNER");
		$db->join("profesionales", "turnos.IDPROFESIONAL = profesionales.ID", "INNER");
		$db->join("especialidades", "turnos.IDESPECIALIDAD = especialidades.CODIGO", "INNER");
		$db->join("estadoturno", "turnos.ESTADOTURNO = estadoturno.idEstadoTurno", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("FECHATURNO", "ASC");
		}
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		if(!empty($request->turnos_IDPACIENTE)){
			$val = $request->turnos_IDPACIENTE;
			$db->where("turnos.IDPACIENTE", $val , "=");
		}
		if(!empty($request->turnos_IDPROFESIONAL)){
			$val = $request->turnos_IDPROFESIONAL;
			$db->where("turnos.IDPROFESIONAL", $val , "=");
		}
		if(!empty($request->turnos_FECHATURNO)){
			$vals = explode("-to-", str_replace(" ", "", $request->turnos_FECHATURNO));
			$startdate = $vals[0];
			$enddate = $vals[1];
			$db->where("turnos.FECHATURNO BETWEEN '$startdate' AND '$enddate'");
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
		$page_title = $this->view->page_title = "Turnos";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$view_name = (is_ajax() ? "turnos/ajax-lista.php" : "turnos/lista.php");
		$this->render_view($view_name, $data);
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
		$fields = array("ID", 
			"IDPROFESIONAL", 
			"IDPACIENTE", 
			"IDESPECIALIDAD", 
			"FECHATURNO", 
			"HSTURNO", 
			"ESTADOTURNO", 
			"TIPOTURNO", 
			"OBSERVACION", 
			"IDCONSULTORIO", 
			"DURACION", 
			"auxiliar", 
			"CANTSESIONES");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				turnos.ID LIKE ? OR 
				turnos.IDPROFESIONAL LIKE ? OR 
				turnos.IDPACIENTE LIKE ? OR 
				turnos.IDESPECIALIDAD LIKE ? OR 
				turnos.FECHATURNO LIKE ? OR 
				turnos.HSTURNO LIKE ? OR 
				turnos.ESTADOTURNO LIKE ? OR 
				turnos.TIPOTURNO LIKE ? OR 
				turnos.OBSERVACION LIKE ? OR 
				turnos.IDCONSULTORIO LIKE ? OR 
				turnos.DURACION LIKE ? OR 
				turnos.auxiliar LIKE ? OR 
				turnos.CANTSESIONES LIKE ? OR 
				turnos.date_deleted LIKE ? OR 
				turnos.is_deleted LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "turnos/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("turnos.ID", ORDER_TYPE);
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
		$page_title = $this->view->page_title = "Turnos";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("turnos/configuracion.php", $data); //render the full page
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function turnos_del_dia_gral($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("turnos.ID", 
			"turnos.HSTURNO", 
			"v_paciente.NOMBAPEPAC AS v_paciente_NOMBAPEPAC", 
			"v_profesionales.NOMBAPEPRO AS v_profesionales_NOMBAPEPRO", 
			"turnos.ESTADOTURNO", 
			"estadoturno.descripcion AS estadoturno_descripcion", 
			"turnos.IDCONSULTORIO", 
			"consultorio.DESCRIPCION AS consultorio_DESCRIPCION", 
			"turnos.CANTSESIONES");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				turnos.ID LIKE ? OR 
				turnos.FECHATURNO LIKE ? OR 
				turnos.HSTURNO LIKE ? OR 
				turnos.IDPROFESIONAL LIKE ? OR 
				turnos.IDPACIENTE LIKE ? OR 
				turnos.IDESPECIALIDAD LIKE ? OR 
				turnos.TIPOTURNO LIKE ? OR 
				turnos.OBSERVACION LIKE ? OR 
				v_paciente.NOMBAPEPAC LIKE ? OR 
				v_profesionales.NOMBAPEPRO LIKE ? OR 
				turnos.ESTADOTURNO LIKE ? OR 
				estadoturno.descripcion LIKE ? OR 
				turnos.IDCONSULTORIO LIKE ? OR 
				consultorio.DESCRIPCION LIKE ? OR 
				turnos.DURACION LIKE ? OR 
				turnos.auxiliar LIKE ? OR 
				turnos.CANTSESIONES LIKE ? OR 
				turnos.date_deleted LIKE ? OR 
				turnos.is_deleted LIKE ? OR 
				v_profesionales.ID LIKE ? OR 
				v_profesionales.NRODOCPRO LIKE ? OR 
				v_paciente.idPaciente LIKE ? OR 
				v_paciente.NUMDOCPAC LIKE ? OR 
				estadoturno.idEstadoTurno LIKE ? OR 
				estadoturno.cantSesiones LIKE ? OR 
				estadoturno.COLOR LIKE ? OR 
				estadoturno.date_deleted LIKE ? OR 
				estadoturno.is_deleted LIKE ? OR 
				consultorio.CODIGO LIKE ? OR 
				consultorio.date_deleted LIKE ? OR 
				consultorio.is_deleted LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "turnos/search.php";
		}
		$db->join("v_profesionales", "turnos.IDPROFESIONAL = v_profesionales.ID", "INNER");
		$db->join("v_paciente", "turnos.IDPACIENTE = v_paciente.idPaciente", "INNER");
		$db->join("estadoturno", "turnos.ESTADOTURNO = estadoturno.idEstadoTurno", "INNER");
		$db->join("consultorio", "turnos.IDCONSULTORIO = consultorio.CODIGO", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("turnos.ID", ORDER_TYPE);
		}
		$db->where("FECHATURNO= DATE(NOW())");
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
		$page_title = $this->view->page_title = "Lista de turnos del dia ".strval(format_date(date_now(),'d-m-Y'))."";
		$this->view->report_filename = $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "landscape";
		$this->view->report_hidden_fields = array('CANTSESIONES');
		$view_name = (is_ajax() ? "turnos/ajax-turnos_del_dia_gral.php" : "turnos/turnos_del_dia_gral.php");
		$this->render_view($view_name, $data);
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function cronograma_pacientes($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("turnos.ID", 
			"turnos.IDPACIENTE", 
			"especialidades.DESCRIPCION AS especialidades_DESCRIPCION", 
			"turnos.HSTURNO", 
			"WEEKDAY(FECHATURNO) +1 AS dia", 
			"especialidades.ABREVIACION AS especialidades_ABREVIACION", 
			"SEC_TO_TIME(TIME_TO_SEC(HSTURNO)+TIME_TO_SEC(DURACION)) AS HORASALIDA");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				turnos.IDPACIENTE LIKE ?
			)";
			$search_params = array(
				"%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "turnos/search.php";
		}
		$db->join("especialidades", "turnos.IDESPECIALIDAD = especialidades.CODIGO", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("HSTURNO", "ASC");
			$db->orderBy("dia", "ASC");
		}
		$db->where(" FECHATURNO BETWEEN FIRST_DAY_OF_WEEK(NOW()) AND DATE_ADD(FIRST_DAY_OF_WEEK(NOW()),INTERVAL 7 DAY)");
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
		$page_title = $this->view->page_title = "Cronograma de Horarios";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "landscape";
		$this->render_view("turnos/cronograma_pacientes.php", $data); //render the full page
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function agendapaciente($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("ID", 
			"IDCONSULTORIO");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				turnos.ID LIKE ? OR 
				turnos.IDPROFESIONAL LIKE ? OR 
				turnos.IDPACIENTE LIKE ? OR 
				turnos.IDESPECIALIDAD LIKE ? OR 
				turnos.FECHATURNO LIKE ? OR 
				turnos.HSTURNO LIKE ? OR 
				turnos.ESTADOTURNO LIKE ? OR 
				turnos.TIPOTURNO LIKE ? OR 
				turnos.OBSERVACION LIKE ? OR 
				turnos.IDCONSULTORIO LIKE ? OR 
				turnos.DURACION LIKE ? OR 
				turnos.auxiliar LIKE ? OR 
				turnos.CANTSESIONES LIKE ? OR 
				turnos.date_deleted LIKE ? OR 
				turnos.is_deleted LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "turnos/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("turnos.ID", ORDER_TYPE);
		}
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		if(!empty($request->turnos_IDPACIENTE)){
			$val = $request->turnos_IDPACIENTE;
			$db->where("turnos.IDPACIENTE", $val , "=");
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
		$page_title = $this->view->page_title = "Turnos";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("turnos/agendapaciente.php", $data); //render the full page
	}
}
