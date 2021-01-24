<?php 
/**
 * Evoluciones Page Controller
 * @category  Controller
 */
class EvolucionesController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "evoluciones";
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
		$fields = array("evoluciones.id", 
			"evoluciones.fecha", 
			"evoluciones.usuario", 
			"tipo_evolucion.id AS tipo_evolucion_id", 
			"tipo_evolucion.descripcion AS tipo_evolucion_descripcion", 
			"tipo_evolucion.especialidad AS tipo_evolucion_especialidad", 
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
			"v_profesionales.ID AS v_profesionales_ID", 
			"v_profesionales.NRODOCPRO AS v_profesionales_NRODOCPRO", 
			"v_profesionales.NOMBAPEPRO AS v_profesionales_NOMBAPEPRO");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				evoluciones.id LIKE ? OR 
				evoluciones.fecha LIKE ? OR 
				evoluciones.tratamiento LIKE ? OR 
				evoluciones.tipo_evolucion LIKE ? OR 
				evoluciones.profesional LIKE ? OR 
				evoluciones.paciente LIKE ? OR 
				evoluciones.evolucion LIKE ? OR 
				evoluciones.usuario LIKE ? OR 
				evoluciones.via_comunicacion LIKE ? OR 
				evoluciones.otra_via LIKE ? OR 
				evoluciones.firma LIKE ? OR 
				tipo_evolucion.id LIKE ? OR 
				tipo_evolucion.descripcion LIKE ? OR 
				tipo_evolucion.especialidad LIKE ? OR 
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
				v_profesionales.ID LIKE ? OR 
				v_profesionales.NRODOCPRO LIKE ? OR 
				v_profesionales.NOMBAPEPRO LIKE ? OR 
				evoluciones.date_deleted LIKE ? OR 
				evoluciones.is_deleted LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "evoluciones/search.php";
		}
		$db->join("tipo_evolucion", "evoluciones.tipo_evolucion = tipo_evolucion.id", "INNER");
		$db->join("pacientes", "evoluciones.paciente = pacientes.idPaciente", "INNER");
		$db->join("v_profesionales", "evoluciones.profesional = v_profesionales.ID", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("evoluciones.id", ORDER_TYPE);
		}
		$allowed_roles = array ('administrator', 'user');
		if(!in_array(strtolower(USER_ROLE), $allowed_roles)){
		$db->where("evoluciones.usuario", get_active_user('idUSUARIO') );
		}
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		if(!empty($request->evoluciones_fecha)){
			$vals = explode("-to-", str_replace(" ", "", $request->evoluciones_fecha));
			$startdate = $vals[0];
			$enddate = $vals[1];
			$db->where("evoluciones.fecha BETWEEN '$startdate' AND '$enddate'");
		}
		if(!empty($request->evoluciones_tipo_evolucion)){
			$val = $request->evoluciones_tipo_evolucion;
			$db->where("evoluciones.tipo_evolucion", $val , "=");
		}
		$tc = $db->withTotalCount();
		$records = $db->get($tablename, $pagination, $fields);
		$records_count = count($records);
		$total_records = intval($tc->totalCount);
		$page_limit = $pagination[1];
		$total_pages = ceil($total_records / $page_limit);
		if(	!empty($records)){
			foreach($records as &$record){
				$record['fecha'] = format_date($record['fecha'],'d-m-Y');
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
		$page_title = $this->view->page_title = "Evoluciones";
		$view_name = (is_ajax() ? "evoluciones/ajax-list.php" : "evoluciones/list.php");
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
		$fields = array("evoluciones.id", 
			"evoluciones.fecha", 
			"evoluciones.evolucion", 
			"evoluciones.usuario", 
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
			"evoluciones.via_comunicacion", 
			"evoluciones.otra_via", 
			"evoluciones.firma", 
			"tipo_evolucion.id AS tipo_evolucion_id", 
			"tipo_evolucion.descripcion AS tipo_evolucion_descripcion", 
			"tipo_evolucion.especialidad AS tipo_evolucion_especialidad", 
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
			"v_profesionales.ID AS v_profesionales_ID", 
			"v_profesionales.NRODOCPRO AS v_profesionales_NRODOCPRO", 
			"v_profesionales.NOMBAPEPRO AS v_profesionales_NOMBAPEPRO");
		$allowed_roles = array ('administrator', 'user');
		if(!in_array(strtolower(USER_ROLE), $allowed_roles)){
		$db->where("evoluciones.usuario", get_active_user('idUSUARIO') );
		}
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("evoluciones.id", $rec_id);; //select record based on primary key
		}
		$db->join("tipo_evolucion", "evoluciones.tipo_evolucion = tipo_evolucion.id", "INNER ");
		$db->join("pacientes", "evoluciones.paciente = pacientes.idPaciente", "INNER ");
		$db->join("v_profesionales", "evoluciones.profesional = v_profesionales.ID", "INNER ");  
		$record = $db->getOne($tablename, $fields );
		if($record){
			$record['fecha'] = format_date($record['fecha'],'d-m-Y');
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
		return $this->render_view("evoluciones/view.php", $record);
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
			$fields = $this->fields = array("fecha","tratamiento","tipo_evolucion","profesional","evolucion","via_comunicacion","otra_via","firma","usuario","paciente");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'fecha' => 'required',
				'tratamiento' => 'required',
				'tipo_evolucion' => 'required',
				'profesional' => 'required',
				'evolucion' => 'required',
				'via_comunicacion' => 'required',
				'firma' => 'required',
				'usuario' => 'required',
				'paciente' => 'required',
			);
			$this->sanitize_array = array(
				'fecha' => 'sanitize_string',
				'tratamiento' => 'sanitize_string',
				'tipo_evolucion' => 'sanitize_string',
				'profesional' => 'sanitize_string',
				'evolucion' => 'sanitize_string',
				'via_comunicacion' => 'sanitize_string',
				'otra_via' => 'sanitize_string',
				'firma' => 'sanitize_string',
				'usuario' => 'sanitize_string',
				'paciente' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("El registro se agrego correctamente", "success");
					return	$this->redirect("evoluciones/edit/$rec_id");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Agregar nuevo";
		$this->render_view("evoluciones/add.php");
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
		$fields = $this->fields = array("id","fecha","tratamiento","tipo_evolucion","profesional","evolucion","via_comunicacion","otra_via","firma","usuario","paciente");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'fecha' => 'required',
				'tratamiento' => 'required',
				'tipo_evolucion' => 'required',
				'profesional' => 'required',
				'evolucion' => 'required',
				'via_comunicacion' => 'required',
				'firma' => 'required',
				'usuario' => 'required',
				'paciente' => 'required',
			);
			$this->sanitize_array = array(
				'fecha' => 'sanitize_string',
				'tratamiento' => 'sanitize_string',
				'tipo_evolucion' => 'sanitize_string',
				'profesional' => 'sanitize_string',
				'evolucion' => 'sanitize_string',
				'via_comunicacion' => 'sanitize_string',
				'otra_via' => 'sanitize_string',
				'firma' => 'sanitize_string',
				'usuario' => 'sanitize_string',
				'paciente' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
		$db->where("evoluciones.usuario", get_active_user('idUSUARIO') );
				$db->where("evoluciones.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("El registro se actualizo correctamente", "success");
					return $this->redirect("evoluciones");
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
						return	$this->redirect("evoluciones");
					}
				}
			}
		}
		$db->where("evoluciones.usuario", get_active_user('idUSUARIO') );$db->where("evoluciones.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Editar";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("evoluciones/edit.php", $data);
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
		$db->where("evoluciones.id", $arr_rec_id, "in");
		$db->where("evoluciones.usuario", get_active_user('idUSUARIO') );
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
		return	$this->redirect("evoluciones");
	}
	/**
     * Update table record with formdata
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function editar($rec_id = null, $formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("id","fecha","tratamiento","tipo_evolucion","profesional","evolucion","usuario");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'fecha' => 'required',
				'tratamiento' => 'required',
				'tipo_evolucion' => 'required',
				'profesional' => 'required',
				'evolucion' => 'required',
				'usuario' => 'required',
			);
			$this->sanitize_array = array(
				'fecha' => 'sanitize_string',
				'tratamiento' => 'sanitize_string',
				'tipo_evolucion' => 'sanitize_string',
				'profesional' => 'sanitize_string',
				'usuario' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
		$db->where("evoluciones.usuario", get_active_user('idUSUARIO') );
				$db->where("evoluciones.id", $rec_id);;
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
		$db->where("evoluciones.usuario", get_active_user('idUSUARIO') );$db->where("evoluciones.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Editar";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("evoluciones/editar.php", $data);
	}
	/**
     * View record detail 
	 * @param $rec_id (select record by table primary key) 
     * @param $value value (select record by value of field name(rec_id))
     * @return BaseView
     */
	function reporte($rec_id = null, $value = null){
		$request = $this->request;
		$db = $this->GetModel();
		$rec_id = $this->rec_id = urldecode($rec_id);
		$tablename = $this->tablename;
		$fields = array("evoluciones.id", 
			"evoluciones.fecha", 
			"evoluciones.evolucion", 
			"evoluciones.usuario", 
			"evoluciones.otra_via", 
			"tipo_evolucion.descripcion AS tipo_evolucion_descripcion", 
			"v_profesionales_tratamiento.NRODOCPRO AS v_profesionales_tratamiento_NRODOCPRO", 
			"v_profesionales_tratamiento.NOMBAPEPRO AS v_profesionales_tratamiento_NOMBAPEPRO", 
			"pacientes.NUMDOCPAC AS pacientes_NUMDOCPAC", 
			"pacientes.FECHANACPAC AS pacientes_FECHANACPAC", 
			"pacientes.NOMBAPEPAC AS pacientes_NOMBAPEPAC", 
			"pacientes.NROAFILIADO AS pacientes_NROAFILIADO", 
			"via_comunicacion.descripcion AS via_comunicacion_descripcion", 
			"v_firma.id AS v_firma_id", 
			"v_firma.foto AS v_firma_foto");
		$allowed_roles = array ('administrator', 'user');
		if(!in_array(strtolower(USER_ROLE), $allowed_roles)){
		$db->where("evoluciones.usuario", get_active_user('idUSUARIO') );
		}
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("evoluciones.id", $rec_id);; //select record based on primary key
		}
		$db->join("tipo_evolucion", "evoluciones.tipo_evolucion = tipo_evolucion.id", "INNER ");
		$db->join("v_profesionales_tratamiento", "evoluciones.profesional = v_profesionales_tratamiento.ID", "INNER ");
		$db->join("pacientes", "evoluciones.paciente = pacientes.idPaciente", "INNER ");
		$db->join("via_comunicacion", "evoluciones.via_comunicacion = via_comunicacion.id", "INNER ");
		$db->join("v_firma", "evoluciones.firma = v_firma.id", "INNER ");  
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = " ";
		$this->view->report_filename = "Reporte de Evoluciones";
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
		return $this->render_view("evoluciones/reporte.php", $record);
	}
}
