<?php 
/**
 * Profesionales Page Controller
 * @category  Controller
 */
class ProfesionalesController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "profesionales";
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
		$fields = array("profesionales.ID", 
			"profesionales.NRODOCPRO", 
			"profesionales.NOMBAPEPRO", 
			"profesionales.DOMICILIO", 
			"profesionales.TELCELPRO", 
			"localidades.localidad AS localidades_localidad");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				profesionales.ID LIKE ? OR 
				profesionales.FECHABAJA LIKE ? OR 
				profesionales.TIPODOCPRO LIKE ? OR 
				profesionales.NRODOCPRO LIKE ? OR 
				profesionales.FECHAALTA LIKE ? OR 
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
				localidades.id LIKE ? OR 
				localidades.provincia LIKE ? OR 
				localidades.localidad LIKE ? OR 
				profesionales.date_deleted LIKE ? OR 
				profesionales.is_deleted LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "profesionales/search.php";
		}
		$db->join("localidades", "profesionales.LOCALIDAD = localidades.id", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("profesionales.ID", ORDER_TYPE);
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
		$page_title = $this->view->page_title = "Profesionales";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$view_name = (is_ajax() ? "profesionales/ajax-list.php" : "profesionales/list.php");
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
		$fields = array("profesionales.ID", 
			"profesionales.FECHAALTA", 
			"profesionales.FECHABAJA", 
			"profesionales.TIPODOCPRO", 
			"profesionales.NRODOCPRO", 
			"profesionales.FECHANACPRO", 
			"profesionales.NOMBAPEPRO", 
			"profesionales.DOMICILIO", 
			"profesionales.BARRIO", 
			"profesionales.LOCALIDAD", 
			"profesionales.TELPARTPRO", 
			"profesionales.TELCELPRO", 
			"profesionales.EMAIL", 
			"profesionales.NROMATRICULA", 
			"profesionales.FECHAVTOMAT", 
			"profesionales.NRORNP", 
			"profesionales.FECHAVTORNP", 
			"profesionales.EXEINGRESOSBRUTOS", 
			"profesionales.POLIZA", 
			"profesionales.HORALUN", 
			"profesionales.HORAMAR", 
			"profesionales.HORAMIE", 
			"profesionales.HORAJUE", 
			"profesionales.HORAVIE", 
			"profesionales.HORASAB", 
			"profesionales.CONVENIOS", 
			"profesionales.ESPECIALIDAD1", 
			"profesionales.ESPECIALIDAD2", 
			"profesionales.ESPECIALIDAD3", 
			"localidades.id AS localidades_id", 
			"localidades.provincia AS localidades_provincia", 
			"localidades.localidad AS localidades_localidad");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("profesionales.ID", $rec_id);; //select record based on primary key
		}
		$db->join("localidades", "profesionales.LOCALIDAD = localidades.id", "INNER ");  
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
		return $this->render_view("profesionales/view.php", $record);
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
			$fields = $this->fields = array("FECHAALTA","FECHABAJA","FECHANACPRO","TIPODOCPRO","NRODOCPRO","NOMBAPEPRO","DOMICILIO","BARRIO","LOCALIDAD","TELPARTPRO","TELCELPRO","EMAIL","NROMATRICULA","FECHAVTOMAT","NRORNP","FECHAVTORNP","EXEINGRESOSBRUTOS","POLIZA");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'FECHAALTA' => 'required',
				'FECHANACPRO' => 'required',
				'TIPODOCPRO' => 'required',
				'NRODOCPRO' => 'required',
				'NOMBAPEPRO' => 'required',
				'DOMICILIO' => 'required',
				'BARRIO' => 'required',
				'LOCALIDAD' => 'required',
				'TELPARTPRO' => 'required',
				'TELCELPRO' => 'required',
				'EMAIL' => 'required|valid_email',
				'NROMATRICULA' => 'required',
				'FECHAVTOMAT' => 'required',
				'NRORNP' => 'required',
				'FECHAVTORNP' => 'required',
				'EXEINGRESOSBRUTOS' => 'required',
				'POLIZA' => 'required',
			);
			$this->sanitize_array = array(
				'FECHAALTA' => 'sanitize_string',
				'FECHABAJA' => 'sanitize_string',
				'FECHANACPRO' => 'sanitize_string',
				'TIPODOCPRO' => 'sanitize_string',
				'NRODOCPRO' => 'sanitize_string',
				'NOMBAPEPRO' => 'sanitize_string',
				'DOMICILIO' => 'sanitize_string',
				'BARRIO' => 'sanitize_string',
				'LOCALIDAD' => 'sanitize_string',
				'TELPARTPRO' => 'sanitize_string',
				'TELCELPRO' => 'sanitize_string',
				'EMAIL' => 'sanitize_string',
				'NROMATRICULA' => 'sanitize_string',
				'FECHAVTOMAT' => 'sanitize_string',
				'NRORNP' => 'sanitize_string',
				'FECHAVTORNP' => 'sanitize_string',
				'EXEINGRESOSBRUTOS' => 'sanitize_string',
				'POLIZA' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Grabar agregado exitosamente", "success");
					return	$this->redirect("profesionales");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Agregar nuevo";
		$this->render_view("profesionales/add.php");
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
		$fields = $this->fields = array("ID","FECHAALTA","FECHABAJA","FECHANACPRO","TIPODOCPRO","NRODOCPRO","NOMBAPEPRO","DOMICILIO","BARRIO","LOCALIDAD","TELPARTPRO","TELCELPRO","EMAIL","NROMATRICULA","FECHAVTOMAT","NRORNP","FECHAVTORNP","EXEINGRESOSBRUTOS","POLIZA");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'FECHAALTA' => 'required',
				'FECHANACPRO' => 'required',
				'TIPODOCPRO' => 'required',
				'NRODOCPRO' => 'required',
				'NOMBAPEPRO' => 'required',
				'DOMICILIO' => 'required',
				'BARRIO' => 'required',
				'LOCALIDAD' => 'required',
				'TELPARTPRO' => 'required',
				'TELCELPRO' => 'required',
				'EMAIL' => 'required|valid_email',
				'NROMATRICULA' => 'required',
				'FECHAVTOMAT' => 'required',
				'NRORNP' => 'required',
				'FECHAVTORNP' => 'required',
				'EXEINGRESOSBRUTOS' => 'required',
				'POLIZA' => 'required',
			);
			$this->sanitize_array = array(
				'FECHAALTA' => 'sanitize_string',
				'FECHABAJA' => 'sanitize_string',
				'FECHANACPRO' => 'sanitize_string',
				'TIPODOCPRO' => 'sanitize_string',
				'NRODOCPRO' => 'sanitize_string',
				'NOMBAPEPRO' => 'sanitize_string',
				'DOMICILIO' => 'sanitize_string',
				'BARRIO' => 'sanitize_string',
				'LOCALIDAD' => 'sanitize_string',
				'TELPARTPRO' => 'sanitize_string',
				'TELCELPRO' => 'sanitize_string',
				'EMAIL' => 'sanitize_string',
				'NROMATRICULA' => 'sanitize_string',
				'FECHAVTOMAT' => 'sanitize_string',
				'NRORNP' => 'sanitize_string',
				'FECHAVTORNP' => 'sanitize_string',
				'EXEINGRESOSBRUTOS' => 'sanitize_string',
				'POLIZA' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("profesionales.ID", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Registro actualizado con éxito", "success");
					return $this->redirect("profesionales");
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
						return	$this->redirect("profesionales");
					}
				}
			}
		}
		$db->where("profesionales.ID", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Editar";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("profesionales/edit.php", $data);
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
		$fields = $this->fields = array("ID","FECHAALTA","FECHABAJA","FECHANACPRO","TIPODOCPRO","NRODOCPRO","NOMBAPEPRO","DOMICILIO","BARRIO","LOCALIDAD","TELPARTPRO","TELCELPRO","EMAIL","NROMATRICULA","FECHAVTOMAT","NRORNP","FECHAVTORNP","EXEINGRESOSBRUTOS","POLIZA");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
				'FECHAALTA' => 'required',
				'FECHANACPRO' => 'required',
				'TIPODOCPRO' => 'required',
				'NRODOCPRO' => 'required',
				'NOMBAPEPRO' => 'required',
				'DOMICILIO' => 'required',
				'BARRIO' => 'required',
				'LOCALIDAD' => 'required',
				'TELPARTPRO' => 'required',
				'TELCELPRO' => 'required',
				'EMAIL' => 'required|valid_email',
				'NROMATRICULA' => 'required',
				'FECHAVTOMAT' => 'required',
				'NRORNP' => 'required',
				'FECHAVTORNP' => 'required',
				'EXEINGRESOSBRUTOS' => 'required',
				'POLIZA' => 'required',
			);
			$this->sanitize_array = array(
				'FECHAALTA' => 'sanitize_string',
				'FECHABAJA' => 'sanitize_string',
				'FECHANACPRO' => 'sanitize_string',
				'TIPODOCPRO' => 'sanitize_string',
				'NRODOCPRO' => 'sanitize_string',
				'NOMBAPEPRO' => 'sanitize_string',
				'DOMICILIO' => 'sanitize_string',
				'BARRIO' => 'sanitize_string',
				'LOCALIDAD' => 'sanitize_string',
				'TELPARTPRO' => 'sanitize_string',
				'TELCELPRO' => 'sanitize_string',
				'EMAIL' => 'sanitize_string',
				'NROMATRICULA' => 'sanitize_string',
				'FECHAVTOMAT' => 'sanitize_string',
				'NRORNP' => 'sanitize_string',
				'FECHAVTORNP' => 'sanitize_string',
				'EXEINGRESOSBRUTOS' => 'sanitize_string',
				'POLIZA' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("profesionales.ID", $rec_id);;
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
		$db->where("profesionales.ID", $arr_rec_id, "in");
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
		return	$this->redirect("profesionales");
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
		$fields = $this->fields = array("ID","FECHAALTA","FECHABAJA","TIPODOCPRO","NRODOCPRO","FECHANACPRO","NOMBAPEPRO","DOMICILIO","BARRIO","LOCALIDAD","TELPARTPRO","TELCELPRO","EMAIL","NROMATRICULA","FECHAVTOMAT","NRORNP","FECHAVTORNP","EXEINGRESOSBRUTOS","POLIZA");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'FECHAALTA' => 'required',
				'FECHABAJA' => 'required',
				'TIPODOCPRO' => 'required',
				'NRODOCPRO' => 'required',
				'FECHANACPRO' => 'required',
				'NOMBAPEPRO' => 'required',
				'DOMICILIO' => 'required',
				'LOCALIDAD' => 'required',
				'TELPARTPRO' => 'required',
				'TELCELPRO' => 'required',
				'EMAIL' => 'required|valid_email',
				'NROMATRICULA' => 'required',
				'FECHAVTOMAT' => 'required',
				'NRORNP' => 'required',
				'FECHAVTORNP' => 'required',
				'EXEINGRESOSBRUTOS' => 'required',
				'POLIZA' => 'required',
			);
			$this->sanitize_array = array(
				'FECHAALTA' => 'sanitize_string',
				'FECHABAJA' => 'sanitize_string',
				'TIPODOCPRO' => 'sanitize_string',
				'NRODOCPRO' => 'sanitize_string',
				'FECHANACPRO' => 'sanitize_string',
				'NOMBAPEPRO' => 'sanitize_string',
				'DOMICILIO' => 'sanitize_string',
				'BARRIO' => 'sanitize_string',
				'LOCALIDAD' => 'sanitize_string',
				'TELPARTPRO' => 'sanitize_string',
				'TELCELPRO' => 'sanitize_string',
				'EMAIL' => 'sanitize_string',
				'NROMATRICULA' => 'sanitize_string',
				'FECHAVTOMAT' => 'sanitize_string',
				'NRORNP' => 'sanitize_string',
				'FECHAVTORNP' => 'sanitize_string',
				'EXEINGRESOSBRUTOS' => 'sanitize_string',
				'POLIZA' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("profesionales.ID", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Registro actualizado con éxito", "success");
					return $this->redirect("profesionales");
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
						return	$this->redirect("profesionales");
					}
				}
			}
		}
		$db->where("profesionales.ID", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Editar";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("profesionales/editar.php", $data);
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
			"FECHAALTA", 
			"FECHABAJA", 
			"TIPODOCPRO", 
			"NRODOCPRO", 
			"FECHANACPRO", 
			"NOMBAPEPRO", 
			"DOMICILIO", 
			"BARRIO", 
			"LOCALIDAD", 
			"TELPARTPRO", 
			"TELCELPRO", 
			"EMAIL", 
			"NROMATRICULA", 
			"FECHAVTOMAT", 
			"NRORNP", 
			"FECHAVTORNP", 
			"EXEINGRESOSBRUTOS", 
			"POLIZA", 
			"HORALUN", 
			"HORAMAR", 
			"HORAMIE", 
			"HORAJUE", 
			"HORAVIE", 
			"HORASAB", 
			"CONVENIOS", 
			"ESPECIALIDAD1", 
			"ESPECIALIDAD2", 
			"ESPECIALIDAD3");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
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
				profesionales.date_deleted LIKE ? OR 
				profesionales.is_deleted LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "profesionales/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("profesionales.ID", ORDER_TYPE);
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
		$page_title = $this->view->page_title = "Profesionales";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("profesionales/configuracion.php", $data); //render the full page
	}
}
