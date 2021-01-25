<?php 

/**
 * SharedController Controller
 * @category  Controller / Model
 */
class SharedController extends BaseController{
	
	/**
     * cobertura_LOCALIDAD_option_list Model Action
     * @return array
     */
	function cobertura_LOCALIDAD_option_list($lookup_PROVINCIA){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,localidad AS label FROM localidades WHERE provincia= ? ORDER BY localidad ASC" ;
		$queryparams = array($lookup_PROVINCIA);
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * cobertura_PROVINCIA_option_list Model Action
     * @return array
     */
	function cobertura_PROVINCIA_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,provincia AS label FROM provincias ORDER BY provincia ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * docpaciente_TIPODOCUMENTO_option_list Model Action
     * @return array
     */
	function docpaciente_TIPODOCUMENTO_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT CODTIPODOCUMENTO AS value,descripcion AS label FROM tipo_doc_paciente ORDER BY descripcion ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * docpaciente_PACIENTE_default_value Model Action
     * @return Value
     */
	function docpaciente_PACIENTE_default_value(){
		$db = $this->GetModel();
		$sqltext = "SELECT ?" ;
		$queryparams = array($_SESSION['idPaciente']);
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * grupofamiliar_LOCALIDADMADRE_option_list Model Action
     * @return array
     */
	function grupofamiliar_LOCALIDADMADRE_option_list($lookup_PROVINCIAMADRE){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,localidad AS label FROM localidades WHERE provincia= ? ORDER BY localidad ASC" ;
		$queryparams = array($lookup_PROVINCIAMADRE);
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * grupofamiliar_LOCALIDADPADRE_option_list Model Action
     * @return array
     */
	function grupofamiliar_LOCALIDADPADRE_option_list($lookup_PROVINCIAPADRE){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,localidad AS label FROM localidades WHERE provincia= ? ORDER BY localidad ASC" ;
		$queryparams = array($lookup_PROVINCIAPADRE);
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * grupofamiliar_PROVINCIAMADRE_option_list Model Action
     * @return array
     */
	function grupofamiliar_PROVINCIAMADRE_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,provincia AS label FROM provincias ORDER BY provincia ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * grupofamiliar_PROVINCIAPADRE_option_list Model Action
     * @return array
     */
	function grupofamiliar_PROVINCIAPADRE_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,provincia AS label FROM provincias ORDER BY provincia ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * pacientes_barrio_option_list Model Action
     * @return array
     */
	function pacientes_barrio_option_list($lookup_LOCALIDAD){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT CODBARRIO AS value,NOMBRE AS label FROM barrios WHERE LOCALIDAD= ? ORDER BY LOCALIDAD ASC" ;
		$queryparams = array($lookup_LOCALIDAD);
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * pacientes_LOCALIDAD_option_list Model Action
     * @return array
     */
	function pacientes_LOCALIDAD_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,localidad AS label FROM localidades WHERE provincia =6 ORDER BY localidad ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * pacientes_COORDINADOR_option_list Model Action
     * @return array
     */
	function pacientes_COORDINADOR_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT ID AS value,NOMBAPEPRO AS label FROM profesionales ORDER BY NOMBAPEPRO ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * pacientes_COBERTURA_option_list Model Action
     * @return array
     */
	function pacientes_COBERTURA_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT CODCOBERTURA AS value,NOMBCOBERTURA AS label FROM cobertura ORDER BY NOMBCOBERTURA ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * pacientes_NUMDOCPAC_value_exist Model Action
     * @return array
     */
	function pacientes_NUMDOCPAC_value_exist($val){
		$db = $this->GetModel();
		$db->where("NUMDOCPAC", $val);
		$exist = $db->has("pacientes");
		return $exist;
	}

	/**
     * pacientes_barrio_option_list_2 Model Action
     * @return array
     */
	function pacientes_barrio_option_list_2($lookup_LOCALIDAD){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT CODBARRIO AS value,NOMBRE AS label FROM barrios WHERE LOCALIDAD= ? ORDER BY NOMBRE ASC" ;
		$queryparams = array($lookup_LOCALIDAD);
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * usuarios_USUARIO_value_exist Model Action
     * @return array
     */
	function usuarios_USUARIO_value_exist($val){
		$db = $this->GetModel();
		$db->where("USUARIO", $val);
		$exist = $db->has("usuarios");
		return $exist;
	}

	/**
     * usuarios_EMAIL_value_exist Model Action
     * @return array
     */
	function usuarios_EMAIL_value_exist($val){
		$db = $this->GetModel();
		$db->where("EMAIL", $val);
		$exist = $db->has("usuarios");
		return $exist;
	}

	/**
     * profesionales_BARRIO_option_list Model Action
     * @return array
     */
	function profesionales_BARRIO_option_list($lookup_LOCALIDAD){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT CODBARRIO AS value,NOMBRE AS label FROM barrios WHERE LOCALIDAD= ? ORDER BY NOMBRE ASC" ;
		$queryparams = array($lookup_LOCALIDAD);
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * profesionales_LOCALIDAD_option_list Model Action
     * @return array
     */
	function profesionales_LOCALIDAD_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,localidad AS label FROM localidades WHERE provincia=6 ORDER BY localidad ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * especialidadesprofesional_ESPECIALIDAD_option_list Model Action
     * @return array
     */
	function especialidadesprofesional_ESPECIALIDAD_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT CODIGO AS value,DESCRIPCION AS label FROM especialidades ORDER BY DESCRIPCION ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * turnos_IDPROFESIONAL_option_list Model Action
     * @return array
     */
	function turnos_IDPROFESIONAL_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT ID AS value,NOMBAPEPRO AS label FROM profesionales ORDER BY NOMBAPEPRO ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * turnos_IDPACIENTE_option_list Model Action
     * @return array
     */
	function turnos_IDPACIENTE_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT idPaciente AS value,NOMBAPEPAC AS label FROM pacientes ORDER BY NOMBAPEPAC ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * turnos_IDESPECIALIDAD_option_list Model Action
     * @return array
     */
	function turnos_IDESPECIALIDAD_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT CODIGO AS value,DESCRIPCION AS label FROM especialidades ORDER BY DESCRIPCION ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * turnos_ESTADOTURNO_option_list Model Action
     * @return array
     */
	function turnos_ESTADOTURNO_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT idEstadoTurno AS value,descripcion AS label FROM estadoturno ORDER BY idEstadoTurno ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * turnos_TIPOTURNO_option_list Model Action
     * @return array
     */
	function turnos_TIPOTURNO_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT CODIGO AS value,DESCRIPCION AS label FROM tipoturno ORDER BY DESCRIPCION ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * turnos_IDCONSULTORIO_option_list Model Action
     * @return array
     */
	function turnos_IDCONSULTORIO_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT CODIGO AS value,DESCRIPCION AS label FROM consultorio ORDER BY DESCRIPCION ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * vigencia_valores_estrategia_default_value Model Action
     * @return Value
     */
	function vigencia_valores_estrategia_default_value(){
		$db = $this->GetModel();
		$sqltext = "SELECT ?" ;
		$queryparams = array(get_cookie('idEstrategia'));
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * detatratamiento_prestacion_option_list Model Action
     * @return array
     */
	function detatratamiento_prestacion_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT CODIGO AS value,DESCRIPCION AS label FROM especialidades ORDER BY DESCRIPCION ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * detatratamiento_profesional_option_list Model Action
     * @return array
     */
	function detatratamiento_profesional_option_list($lookup_prestacion){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,NOMBAPEPRO AS label FROM v_profesionales_especialidad WHERE codEspecialidad= ? ORDER BY NOMBAPEPRO ASC" ;
		$queryparams = array($lookup_prestacion);
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * sesiones_tratamiento_consultorio_option_list Model Action
     * @return array
     */
	function sesiones_tratamiento_consultorio_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT CODIGO AS value,DESCRIPCION AS label FROM consultorio ORDER BY DESCRIPCION ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * tratamientos_estrategiaTerapeutica_option_list Model Action
     * @return array
     */
	function tratamientos_estrategiaTerapeutica_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,descripcion AS label FROM estrategiaterapeutica ORDER BY descripcion ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * tratamientos_paciente_option_list Model Action
     * @return array
     */
	function tratamientos_paciente_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT idPaciente AS value,NOMBAPEPAC AS label FROM pacientes ORDER BY NOMBAPEPAC ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * tratamientos_paciente_option_list_2 Model Action
     * @return array
     */
	function tratamientos_paciente_option_list_2(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT NOMBAPEPAC AS value,NOMBAPEPAC AS label FROM pacientes ORDER BY NOMBAPEPAC ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * tipo_evolucion_especialidad_option_list Model Action
     * @return array
     */
	function tipo_evolucion_especialidad_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT CODIGO AS value,DESCRIPCION AS label FROM especialidades ORDER BY DESCRIPCION ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * deta_evolucion_item_option_list Model Action
     * @return array
     */
	function deta_evolucion_item_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,descripcion AS label FROM item_evolucion ORDER BY descripcion ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * informesoc_tipo_informe_option_list Model Action
     * @return array
     */
	function informesoc_tipo_informe_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,tipo_informe AS label FROM tipo_informesoc ORDER BY tipo_informe ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * evoluciones_pacientes_COORDINADOR_option_list Model Action
     * @return array
     */
	function evoluciones_pacientes_COORDINADOR_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT ID AS value,NOMBAPEPRO AS label FROM profesionales ORDER BY NOMBAPEPRO ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * evoluciones_pacientes_COBERTURA_option_list Model Action
     * @return array
     */
	function evoluciones_pacientes_COBERTURA_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT CODCOBERTURA AS value,NOMBCOBERTURA AS label FROM cobertura ORDER BY NOMBCOBERTURA ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * evoluciones_pacientes_barrio_option_list Model Action
     * @return array
     */
	function evoluciones_pacientes_barrio_option_list($lookup_LOCALIDAD){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT CODBARRIO AS value,NOMBRE AS label FROM barrios WHERE LOCALIDAD= ? ORDER BY LOCALIDAD ASC" ;
		$queryparams = array($lookup_LOCALIDAD);
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * evoluciones_pacientes_LOCALIDAD_option_list Model Action
     * @return array
     */
	function evoluciones_pacientes_LOCALIDAD_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,localidad AS label FROM localidades WHERE provincia =6 ORDER BY localidad ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * evoluciones_via_comunicacion_option_list Model Action
     * @return array
     */
	function evoluciones_via_comunicacion_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,descripcion AS label FROM via_comunicacion ORDER BY descripcion ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * evoluciones_firma_option_list Model Action
     * @return array
     */
	function evoluciones_firma_option_list($lookup_profesional){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,descripcion AS label FROM v_firma WHERE profesional= ? ORDER BY descripcion ASC" ;
		$queryparams = array($lookup_profesional);
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * evoluciones_tratamiento_option_list Model Action
     * @return array
     */
	function evoluciones_tratamiento_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT codTratamiento AS value,descripcion AS label FROM v_tratamientos WHERE paciente= ? ORDER BY descripcion ASC"  ;
		$queryparams = array(ID_PACIENTE);
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * evoluciones_tipo_evolucion_option_list Model Action
     * @return array
     */
	function evoluciones_tipo_evolucion_option_list($lookup_tratamiento){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,descripcion AS label FROM v_tipoevolucion_tratamiento WHERE tratamiento= ? ORDER BY descripcion ASC" ;
		$queryparams = array($lookup_tratamiento);
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * evoluciones_profesional_option_list Model Action
     * @return array
     */
	function evoluciones_profesional_option_list($lookup_tratamiento){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT ID AS value,NOMBAPEPRO AS label FROM v_profesionales_tratamiento WHERE tratamiento= ? ORDER BY NOMBAPEPRO ASC" ;
		$queryparams = array($lookup_tratamiento);
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * evoluciones_profesional_option_list_2 Model Action
     * @return array
     */
	function evoluciones_profesional_option_list_2($lookup_tratamiento){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT ID AS value,NOMBAPEPRO AS label FROM v_profesionales_tratamiento WHERE tratamiento= ? AND ID=? ORDER BY NOMBAPEPRO ASC"  ;
		$queryparams = array($lookup_tratamiento,ID_PROFESIONAL);
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * evoluciones_via_comunicacion_option_list_2 Model Action
     * @return array
     */
	function evoluciones_via_comunicacion_option_list_2($lookup_profesional){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,descripcion AS label FROM v_firma WHERE profesional= ? ORDER BY descripcion ASC"  ;
		$queryparams = array($lookup_profesional);
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * estudios_solicitados_tipo_estudio_option_list Model Action
     * @return array
     */
	function estudios_solicitados_tipo_estudio_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,id AS label FROM tipo_estudio ORDER BY id ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * indicacion_medica_indicacion_option_list Model Action
     * @return array
     */
	function indicacion_medica_indicacion_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,descripcion AS label FROM tipo_indicacion ORDER BY descripcion ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * firmas_tipo_firma_option_list Model Action
     * @return array
     */
	function firmas_tipo_firma_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,descripcion AS label FROM tipo_firmas ORDER BY descripcion ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * horarios_paciente_desde_option_list Model Action
     * @return array
     */
	function horarios_paciente_desde_option_list($lookup_tratamiento){
		$db = $this->GetModel();
		$sqltext = "SELECT DISTINCT turnos.ID as value ,turnos.HSTURNO as label FROM turnos,detatratamiento WHERE detatratamiento.codDetaTratamiento=? AND turnos.IDPROFESIONAL=detatratamiento.profesional and  turnos.dia=?  AND (fechaturno BETWEEN FIRST_DAY_OF_WEEK(NOW()) AND ultimoDiaSemana(NOW()))  " ;
		$queryparams = array($lookup_tratamiento,$lookup_dia);
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * horarios_paciente_dia_option_list Model Action
     * @return array
     */
	function horarios_paciente_dia_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT codDia AS value,nombre AS label FROM dias ORDER BY nombre ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * turnos_turnosIDPACIENTE_option_list Model Action
     * @return array
     */
	function turnos_turnosIDPACIENTE_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT idPaciente AS value,NOMBAPEPAC AS label FROM pacientes ORDER BY NOMBAPEPAC ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * turnos_turnosIDPROFESIONAL_option_list Model Action
     * @return array
     */
	function turnos_turnosIDPROFESIONAL_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT ID AS value,NOMBAPEPRO AS label FROM profesionales ORDER BY NOMBAPEPRO ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * evoluciones_evolucionestipo_evolucion_option_list Model Action
     * @return array
     */
	function evoluciones_evolucionestipo_evolucion_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,descripcion AS label FROM v_tipoevolucion_tratamiento ORDER BY descripcion ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * estudios_solicitados_estudios_solicitadostipo_estudio_option_list Model Action
     * @return array
     */
	function estudios_solicitados_estudios_solicitadostipo_estudio_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,descripcion AS label FROM tipo_estudio ORDER BY descripcion ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * indicacion_medica_indicacion_medicaindicacion_option_list Model Action
     * @return array
     */
	function indicacion_medica_indicacion_medicaindicacion_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT ti.id AS 'value', ti.descripcion AS 'label' FROM tipo_indicacion AS ti";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * getcount_pacientes Model Action
     * @return Value
     */
	function getcount_pacientes(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM pacientes WHERE is_deleted IS NULL";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_tratamientos Model Action
     * @return Value
     */
	function getcount_tratamientos(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM tratamientos WHERE is_deleted IS NULL";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_pacientes_2 Model Action
     * @return Value
     */
	function getcount_pacientes_2(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM grupofamiliar WHERE is_deleted IS NULL";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_facturas Model Action
     * @return Value
     */
	function getcount_facturas(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM localidades";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

}
