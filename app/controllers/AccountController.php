<?php 
/**
 * Account Page Controller
 * @category  Controller
 */
class AccountController extends SecureController{
	function __construct(){
		parent::__construct(); 
		$this->tablename = "usuarios";
		$this->soft_delete = true;
		$this->delete_field_name = "is_deleted";
		$this->delete_field_value = "1";
	}
	/**
		* Index Action
		* @return null
		*/
	function index(){
		$db = $this->GetModel();
		$rec_id = $this->rec_id = USER_ID; //get current user id from session
		$db->where ("idUSUARIO", $rec_id);
		$tablename = $this->tablename;
		$fields = array("idUSUARIO", 
			"USUARIO", 
			"EMAIL", 
			"user_role_id", 
			"profesional", 
			"paciente");
		$user = $db->getOne($tablename , $fields);
		if(!empty($user)){
			$page_title = $this->view->page_title = "Mi cuenta";
			$this->render_view("account/view.php", $user);
		}
		else{
			$this->set_page_error();
			$this->render_view("account/view.php");
		}
	}
	/**
     * Update user account record with formdata
	 * @param $formdata array() from $_POST
     * @return array
     */
	function edit($formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$rec_id = $this->rec_id = USER_ID;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("idUSUARIO","USUARIO","user_role_id","profesional","paciente");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'USUARIO' => 'required',
				'user_role_id' => 'required',
				'profesional' => 'required|numeric',
				'paciente' => 'required|numeric',
			);
			$this->sanitize_array = array(
				'USUARIO' => 'sanitize_string',
				'user_role_id' => 'sanitize_string',
				'profesional' => 'sanitize_string',
				'paciente' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			//Check if Duplicate Record Already Exit In The Database
			if(isset($modeldata['USUARIO'])){
				$db->where("USUARIO", $modeldata['USUARIO'])->where("idUSUARIO", $rec_id, "!=");
				if($db->has($tablename)){
					$this->view->page_error[] = $modeldata['USUARIO']." ¡Ya existe!";
				}
			} 
			if($this->validated()){
				$db->where("usuarios.idUSUARIO", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Registro actualizado con éxito", "success");
					$db->where ("idUSUARIO", $rec_id);
					$user = $db->getOne($tablename , "*");
					set_session("user_data", $user);// update session with new user data
					return $this->redirect("account");
				}
				else{
					if($db->getLastError()){
						$this->set_page_error();
					}
					elseif(!$numRows){
						//not an error, but no record was updated
						$this->set_flash_msg("No hay registro actualizado", "warning");
						return	$this->redirect("account");
					}
				}
			}
		}
		$db->where("usuarios.idUSUARIO", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Mi cuenta";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("account/edit.php", $data);
	}
	/**
     * Change account email
     * @return BaseView
     */
	function change_email($formdata = null){
		if($formdata){
			$email = trim($formdata['EMAIL']);
			$db = $this->GetModel();
			$rec_id = $this->rec_id = USER_ID; //get current user id from session
			$tablename = $this->tablename;
			$db->where ("idUSUARIO", $rec_id);
			$result = $db->update($tablename, array('EMAIL' => $email ));
			if($result){
				$this->set_flash_msg("La dirección de correo electrónico cambió con éxito", "success");
				$this->redirect("account");
			}
			else{
				$this->set_page_error("Correo electrónico no cambiado");
			}
		}
		return $this->render_view("account/change_email.php");
	}
}
