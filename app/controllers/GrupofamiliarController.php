<?php 
/**
 * Grupofamiliar Page Controller
 * @category  Controller
 */
class GrupofamiliarController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "grupofamiliar";
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
		$fields = array("CODGRUPOFAM", 
			"PACIENTE", 
			"NOMBREMADRE", 
			"DIRECCIONMADRE", 
			"LOCALIDADMADRE", 
			"EMAILMADRE", 
			"NOMBREPADRE", 
			"DIRECCIONPADRE", 
			"LOCALIDADPADRE", 
			"CPPADRE", 
			"CPMADRE", 
			"TELFIJOMADRE", 
			"TELFIJOPADRE", 
			"TELCELMADRE", 
			"TELCELPADRE", 
			"TELLABORALPADRE", 
			"TELLABORALMADRE", 
			"PROVINCIAMADRE", 
			"PROVINCIAPADRE", 
			"EMAILPADRE");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				grupofamiliar.CODGRUPOFAM LIKE ? OR 
				grupofamiliar.PACIENTE LIKE ? OR 
				grupofamiliar.NOMBREMADRE LIKE ? OR 
				grupofamiliar.DIRECCIONMADRE LIKE ? OR 
				grupofamiliar.LOCALIDADMADRE LIKE ? OR 
				grupofamiliar.EMAILMADRE LIKE ? OR 
				grupofamiliar.NOMBREPADRE LIKE ? OR 
				grupofamiliar.DIRECCIONPADRE LIKE ? OR 
				grupofamiliar.LOCALIDADPADRE LIKE ? OR 
				grupofamiliar.CPPADRE LIKE ? OR 
				grupofamiliar.CPMADRE LIKE ? OR 
				grupofamiliar.TELFIJOMADRE LIKE ? OR 
				grupofamiliar.TELFIJOPADRE LIKE ? OR 
				grupofamiliar.TELCELMADRE LIKE ? OR 
				grupofamiliar.TELCELPADRE LIKE ? OR 
				grupofamiliar.TELLABORALPADRE LIKE ? OR 
				grupofamiliar.TELLABORALMADRE LIKE ? OR 
				grupofamiliar.PROVINCIAMADRE LIKE ? OR 
				grupofamiliar.PROVINCIAPADRE LIKE ? OR 
				grupofamiliar.EMAILPADRE LIKE ? OR 
				grupofamiliar.date_deleted LIKE ? OR 
				grupofamiliar.is_deleted LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "grupofamiliar/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("grupofamiliar.CODGRUPOFAM", ORDER_TYPE);
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
		$page_title = $this->view->page_title = "Grupofamiliar";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("grupofamiliar/list.php", $data); //render the full page
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
		$fields = array("CODGRUPOFAM", 
			"PACIENTE", 
			"NOMBREMADRE", 
			"DIRECCIONMADRE", 
			"LOCALIDADMADRE", 
			"EMAILMADRE", 
			"NOMBREPADRE", 
			"DIRECCIONPADRE", 
			"LOCALIDADPADRE", 
			"CPPADRE", 
			"CPMADRE", 
			"TELFIJOMADRE", 
			"TELFIJOPADRE", 
			"TELCELMADRE", 
			"TELCELPADRE", 
			"TELLABORALPADRE", 
			"TELLABORALMADRE", 
			"PROVINCIAMADRE", 
			"PROVINCIAPADRE", 
			"EMAILPADRE");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("grupofamiliar.CODGRUPOFAM", $rec_id);; //select record based on primary key
		}
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
		return $this->render_view("grupofamiliar/view.php", $record);
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
			$fields = $this->fields = array("NOMBREMADRE","DIRECCIONMADRE","LOCALIDADMADRE","PROVINCIAMADRE","CPMADRE","TELFIJOMADRE","TELCELMADRE","TELLABORALMADRE","EMAILMADRE","NOMBREPADRE","DIRECCIONPADRE","LOCALIDADPADRE","PROVINCIAPADRE","CPPADRE","TELFIJOPADRE","TELCELPADRE","TELLABORALPADRE","EMAILPADRE");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'NOMBREMADRE' => 'required',
				'DIRECCIONMADRE' => 'required',
				'LOCALIDADMADRE' => 'required',
				'PROVINCIAMADRE' => 'required',
				'CPMADRE' => 'required|numeric',
				'TELFIJOMADRE' => 'required',
				'TELCELMADRE' => 'required',
				'TELLABORALMADRE' => 'required',
				'EMAILMADRE' => 'required|valid_email',
				'NOMBREPADRE' => 'required',
				'DIRECCIONPADRE' => 'required',
				'LOCALIDADPADRE' => 'required',
				'PROVINCIAPADRE' => 'required',
				'CPPADRE' => 'required|numeric',
				'TELFIJOPADRE' => 'required',
				'TELCELPADRE' => 'required',
				'TELLABORALPADRE' => 'required',
				'EMAILPADRE' => 'required|valid_email',
			);
			$this->sanitize_array = array(
				'NOMBREMADRE' => 'sanitize_string',
				'DIRECCIONMADRE' => 'sanitize_string',
				'LOCALIDADMADRE' => 'sanitize_string',
				'PROVINCIAMADRE' => 'sanitize_string',
				'CPMADRE' => 'sanitize_string',
				'TELFIJOMADRE' => 'sanitize_string',
				'TELCELMADRE' => 'sanitize_string',
				'TELLABORALMADRE' => 'sanitize_string',
				'EMAILMADRE' => 'sanitize_string',
				'NOMBREPADRE' => 'sanitize_string',
				'DIRECCIONPADRE' => 'sanitize_string',
				'LOCALIDADPADRE' => 'sanitize_string',
				'PROVINCIAPADRE' => 'sanitize_string',
				'CPPADRE' => 'sanitize_string',
				'TELFIJOPADRE' => 'sanitize_string',
				'TELCELPADRE' => 'sanitize_string',
				'TELLABORALPADRE' => 'sanitize_string',
				'EMAILPADRE' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Grabar agregado exitosamente", "success");
					return	$this->redirect("grupofamiliar");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Agregar nuevo";
		$this->render_view("grupofamiliar/add.php");
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
		$fields = $this->fields = array("CODGRUPOFAM","NOMBREMADRE","DIRECCIONMADRE","LOCALIDADMADRE","PROVINCIAMADRE","CPMADRE","TELFIJOMADRE","TELCELMADRE","TELLABORALMADRE","EMAILMADRE","NOMBREPADRE","DIRECCIONPADRE","LOCALIDADPADRE","PROVINCIAPADRE","CPPADRE","TELFIJOPADRE","TELCELPADRE","TELLABORALPADRE","EMAILPADRE");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'NOMBREMADRE' => 'required',
				'DIRECCIONMADRE' => 'required',
				'LOCALIDADMADRE' => 'required',
				'PROVINCIAMADRE' => 'required',
				'CPMADRE' => 'required|numeric',
				'TELFIJOMADRE' => 'required',
				'TELCELMADRE' => 'required',
				'TELLABORALMADRE' => 'required',
				'EMAILMADRE' => 'required|valid_email',
				'NOMBREPADRE' => 'required',
				'DIRECCIONPADRE' => 'required',
				'LOCALIDADPADRE' => 'required',
				'PROVINCIAPADRE' => 'required',
				'CPPADRE' => 'required|numeric',
				'TELFIJOPADRE' => 'required',
				'TELCELPADRE' => 'required',
				'TELLABORALPADRE' => 'required',
				'EMAILPADRE' => 'required|valid_email',
			);
			$this->sanitize_array = array(
				'NOMBREMADRE' => 'sanitize_string',
				'DIRECCIONMADRE' => 'sanitize_string',
				'LOCALIDADMADRE' => 'sanitize_string',
				'PROVINCIAMADRE' => 'sanitize_string',
				'CPMADRE' => 'sanitize_string',
				'TELFIJOMADRE' => 'sanitize_string',
				'TELCELMADRE' => 'sanitize_string',
				'TELLABORALMADRE' => 'sanitize_string',
				'EMAILMADRE' => 'sanitize_string',
				'NOMBREPADRE' => 'sanitize_string',
				'DIRECCIONPADRE' => 'sanitize_string',
				'LOCALIDADPADRE' => 'sanitize_string',
				'PROVINCIAPADRE' => 'sanitize_string',
				'CPPADRE' => 'sanitize_string',
				'TELFIJOPADRE' => 'sanitize_string',
				'TELCELPADRE' => 'sanitize_string',
				'TELLABORALPADRE' => 'sanitize_string',
				'EMAILPADRE' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("grupofamiliar.CODGRUPOFAM", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Registro actualizado con éxito", "success");
					return $this->redirect("grupofamiliar");
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
						return	$this->redirect("grupofamiliar");
					}
				}
			}
		}
		$db->where("grupofamiliar.CODGRUPOFAM", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Editar";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("grupofamiliar/edit.php", $data);
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
		$fields = $this->fields = array("CODGRUPOFAM","NOMBREMADRE","DIRECCIONMADRE","LOCALIDADMADRE","PROVINCIAMADRE","CPMADRE","TELFIJOMADRE","TELCELMADRE","TELLABORALMADRE","EMAILMADRE","NOMBREPADRE","DIRECCIONPADRE","LOCALIDADPADRE","PROVINCIAPADRE","CPPADRE","TELFIJOPADRE","TELCELPADRE","TELLABORALPADRE","EMAILPADRE");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
				'NOMBREMADRE' => 'required',
				'DIRECCIONMADRE' => 'required',
				'LOCALIDADMADRE' => 'required',
				'PROVINCIAMADRE' => 'required',
				'CPMADRE' => 'required|numeric',
				'TELFIJOMADRE' => 'required',
				'TELCELMADRE' => 'required',
				'TELLABORALMADRE' => 'required',
				'EMAILMADRE' => 'required|valid_email',
				'NOMBREPADRE' => 'required',
				'DIRECCIONPADRE' => 'required',
				'LOCALIDADPADRE' => 'required',
				'PROVINCIAPADRE' => 'required',
				'CPPADRE' => 'required|numeric',
				'TELFIJOPADRE' => 'required',
				'TELCELPADRE' => 'required',
				'TELLABORALPADRE' => 'required',
				'EMAILPADRE' => 'required|valid_email',
			);
			$this->sanitize_array = array(
				'NOMBREMADRE' => 'sanitize_string',
				'DIRECCIONMADRE' => 'sanitize_string',
				'LOCALIDADMADRE' => 'sanitize_string',
				'PROVINCIAMADRE' => 'sanitize_string',
				'CPMADRE' => 'sanitize_string',
				'TELFIJOMADRE' => 'sanitize_string',
				'TELCELMADRE' => 'sanitize_string',
				'TELLABORALMADRE' => 'sanitize_string',
				'EMAILMADRE' => 'sanitize_string',
				'NOMBREPADRE' => 'sanitize_string',
				'DIRECCIONPADRE' => 'sanitize_string',
				'LOCALIDADPADRE' => 'sanitize_string',
				'PROVINCIAPADRE' => 'sanitize_string',
				'CPPADRE' => 'sanitize_string',
				'TELFIJOPADRE' => 'sanitize_string',
				'TELCELPADRE' => 'sanitize_string',
				'TELLABORALPADRE' => 'sanitize_string',
				'EMAILPADRE' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("grupofamiliar.CODGRUPOFAM", $rec_id);;
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
		$db->where("grupofamiliar.CODGRUPOFAM", $arr_rec_id, "in");
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
		return	$this->redirect("grupofamiliar");
	}
}
