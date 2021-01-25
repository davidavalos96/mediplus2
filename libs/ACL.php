<?php
/**
 * Page Access Control
 * @category  RBAC Helper
 */
defined('ROOT') or exit('No direct script access allowed');
class ACL
{
	

	/**
	 * Array of user roles and page access 
	 * Use "*" to grant all access right to particular user role
	 * @var array
	 */
	public static $role_pages = array(
			'administrator' =>
						array(
							'barrios' => array('list','view','add','edit', 'editfield','delete','import_data'),
							'cobertura' => array('list','view','add','edit', 'editfield','delete','import_data'),
							'docpaciente' => array('list','view','add','edit', 'editfield','delete','import_data'),
							'grupofamiliar' => array('list','view','add','edit', 'editfield','delete','import_data'),
							'localidades' => array('list','view','add','edit', 'editfield','delete','import_data'),
							'medicostratantes' => array('list','view','add','edit', 'editfield','delete','import_data'),
							'pacientes' => array('list','view','add','edit', 'editfield','delete','import_data','editarpaciente','configuracion'),
							'plancobertura' => array('list','view','add','edit', 'editfield','delete','import_data'),
							'provincias' => array('list','view','add','edit', 'editfield','delete','import_data'),
							'tipo_doc_paciente' => array('list','view','add','edit', 'editfield','delete','import_data'),
							'usuarios' => array('list','view','add','edit', 'editfield','delete','import_data','userregister','accountedit','accountview'),
							'estadoturno' => array('list','view','add','edit', 'editfield','delete'),
							'tipoturno' => array('list','view','add','edit', 'editfield','delete'),
							'profesionales' => array('list','view','add','edit', 'editfield','delete','list','view','add','edit', 'editfield','delete','editar','configuracion'),
							'especialidadesprofesional' => array('list','view','add','edit', 'editfield','delete'),
							'especialidades' => array('list','view','add','edit', 'editfield','delete'),
							'horariosprofesionales' => array('list','view','add','edit', 'editfield','delete'),
							'turnos' => array('list','view','add','edit', 'editfield','delete','list','view','add','edit', 'editfield','delete','lista','configuracion','turnos_del_dia_gral','cronograma_pacientes','agendapaciente'),
							'consultorio' => array('list','view','add','edit', 'editfield','delete'),
							'estrategiaterapeutica' => array('list','view','add','edit', 'editfield','delete'),
							'vigencia_valores' => array('list','view','add','edit', 'editfield','delete'),
							'detatratamiento' => array('list','view','add','edit', 'editfield','delete'),
							'sesiones_tratamiento' => array('list','view','add','edit', 'editfield','delete','lista'),
							'tratamientos' => array('list','view','add','edit', 'editfield','delete','formeditar','cronograma_horario'),
							'v_profesionales_especialidad' => array('list','view'),
							'configuracion' => array('list','view','add','edit', 'editfield','delete'),
							'dias' => array('list','view','add','edit', 'editfield','delete'),
							'historiaclinica' => array('list','view','add','edit', 'editfield','delete','configuracion'),
							'tipo_evolucion' => array('list','view','add','edit', 'editfield','delete','editar'),
							'v_tratamientos' => array('list','view'),
							'v_profesionales_tratamiento' => array('list','view'),
							'deta_evolucion' => array('list','view','add','edit', 'editfield','delete'),
							'informesoc' => array('list','view','add','edit', 'editfield','delete'),
							'item_evolucion' => array('list','view','add','edit', 'editfield','delete'),
							'tipo_informesoc' => array('list','view','add','edit', 'editfield','delete'),
							'v_items_consulta' => array('list','view'),
							'evoluciones' => array('list','view','add','edit', 'editfield','delete','list','view','add','edit', 'editfield','delete','editar','reporte','agregar_evolucion_terapeuta'),
							'v_tipoevolucion_tratamiento' => array('list','view'),
							'v_plan_terapeutico' => array('list','view','list','view'),
							'estudios_solicitados' => array('list','view','add','edit', 'editfield','delete'),
							'tipo_estudio' => array('list','view','add','edit', 'editfield','delete'),
							'indicacion_medica' => array('list','view','add','edit', 'editfield','delete'),
							'via_comunicacion' => array('list','view','add','edit', 'editfield','delete'),
							'firmas' => array('list','view','add','edit', 'editfield','delete'),
							'tipo_firmas' => array('list','view','add','edit', 'editfield','delete'),
							'v_firma' => array('list','view'),
							'tipo_indicacion' => array('list','view','add','edit', 'editfield','delete'),
							'v_profesionales' => array('list','view'),
							'detaliquidacioncobertura' => array('list','view','add','edit', 'editfield','delete'),
							'liquidacioncobertura' => array('list','view','add','edit', 'editfield','delete'),
							'v_paciente' => array('list','view'),
							'estado_curso' => array('list','view','add','edit', 'editfield','delete'),
							'informes' => array('list','view','add','edit', 'editfield','delete'),
							'v_horarios_paciente' => array('list','view'),
							'documentacion_profesional' => array('list','view','add','edit', 'editfield','delete'),
							'tipodocprofesional' => array('list','view','add','edit', 'editfield','delete'),
							'horarios_paciente' => array('list','view','add','edit', 'editfield','delete'),
							'terapias_por_tratamiento' => array('list','view')
						),
		
			'user' =>
						array(
							'pacientes' => array('editarpaciente','configuracion'),
							'usuarios' => array('userregister','accountedit','accountview'),
							'profesionales' => array('editar','configuracion'),
							'turnos' => array('lista','configuracion','turnos_del_dia_gral','cronograma_pacientes','agendapaciente'),
							'sesiones_tratamiento' => array('lista'),
							'tratamientos' => array('formeditar','cronograma_horario'),
							'historiaclinica' => array('list','edit', 'editfield','configuracion'),
							'tipo_evolucion' => array('editar'),
							'evoluciones' => array('list','view','add','edit', 'editfield','delete','editar','reporte','agregar_evolucion_terapeuta')
						),
		
			'terapeuta' =>
						array(
							'turnos' => array('turnos_del_dia_gral','cronograma_pacientes','agendapaciente'),
							'tratamientos' => array('cronograma_horario'),
							'historiaclinica' => array('list','edit', 'editfield'),
							'deta_evolucion' => array('list','edit', 'editfield'),
							'evoluciones' => array('list','view','add','edit', 'editfield','delete','editar','reporte','agregar_evolucion_terapeuta')
						),
		
			'recepcion' =>
						array(
							'turnos' => array('turnos_del_dia_gral','cronograma_pacientes','agendapaciente'),
							'tratamientos' => array('cronograma_horario'),
							'evoluciones' => array('agregar_evolucion_terapeuta')
						),
		
			'administracion' =>
						array(
							'barrios' => array('list','view','add','edit', 'editfield','delete','import_data'),
							'cobertura' => array('list','view','add','edit', 'editfield','delete','import_data'),
							'docpaciente' => array('list','view','add','edit', 'editfield','delete','import_data'),
							'grupofamiliar' => array('list','view','add','edit', 'editfield','delete','import_data'),
							'localidades' => array('list','view','add','edit', 'editfield','delete','import_data'),
							'medicostratantes' => array('list','view','add','edit', 'editfield','delete','import_data'),
							'pacientes' => array('list','view','add','edit', 'editfield','delete','editarpaciente','configuracion','import_data'),
							'plancobertura' => array('list','view','add','edit', 'editfield','delete','import_data'),
							'provincias' => array('list','view','add','edit', 'editfield','delete','import_data'),
							'tipo_doc_paciente' => array('list','view','add','edit', 'editfield','delete','import_data'),
							'usuarios' => array('list','view','userregister','accountedit','accountview','add','edit', 'editfield','delete','import_data'),
							'estadoturno' => array('list','view','add','edit', 'editfield','delete','import_data'),
							'tipoturno' => array('list','view','add','edit', 'editfield','delete','import_data'),
							'profesionales' => array('list','view','add','edit', 'editfield','delete','editar','configuracion','import_data'),
							'especialidadesprofesional' => array('list','view','add','edit', 'editfield','delete','import_data'),
							'especialidades' => array('list','view','add','edit', 'editfield','delete','import_data'),
							'horariosprofesionales' => array('list','view','add','edit', 'editfield','delete','import_data'),
							'turnos' => array('list','view','add','edit', 'editfield','delete','lista','configuracion','import_data','turnos_del_dia_gral','cronograma_pacientes','agendapaciente'),
							'consultorio' => array('list','view','add','edit', 'editfield','delete','import_data'),
							'estrategiaterapeutica' => array('list','view','add','edit', 'editfield','delete','import_data'),
							'vigencia_valores' => array('list','view','add','edit', 'editfield','delete','import_data'),
							'detatratamiento' => array('list','view','add','edit', 'editfield','delete','import_data'),
							'sesiones_tratamiento' => array('list','view','add','edit', 'editfield','delete','lista','import_data'),
							'tratamientos' => array('list','view','add','edit', 'editfield','delete','formeditar','import_data','cronograma_horario'),
							'v_profesionales_especialidad' => array('list','view'),
							'configuracion' => array('list','view','add','edit', 'editfield','delete','import_data'),
							'dias' => array('list','view','add','edit', 'editfield','delete','import_data'),
							'historiaclinica' => array('list','view','add','edit', 'editfield','delete','configuracion','import_data'),
							'tipo_evolucion' => array('list','view','add','edit', 'editfield','delete','editar','import_data'),
							'v_tratamientos' => array('list','view'),
							'v_profesionales_tratamiento' => array('list','view'),
							'deta_evolucion' => array('list','view','add','edit', 'editfield','delete','import_data'),
							'informesoc' => array('list','view','add','edit', 'editfield','delete','import_data'),
							'item_evolucion' => array('list','view','add','edit', 'editfield','delete','import_data'),
							'tipo_informesoc' => array('list','view','add','edit', 'editfield','delete','import_data'),
							'v_items_consulta' => array('list','view'),
							'evoluciones' => array('list','view','add','edit', 'editfield','delete','editar','reporte','import_data','agregar_evolucion_terapeuta'),
							'v_tipoevolucion_tratamiento' => array('list','view'),
							'v_plan_terapeutico' => array('list','view'),
							'estudios_solicitados' => array('list','view','add','edit', 'editfield','delete','import_data'),
							'tipo_estudio' => array('list','view','add','edit', 'editfield','delete','import_data'),
							'indicacion_medica' => array('list','view','add','edit', 'editfield','delete','import_data'),
							'via_comunicacion' => array('list','view','add','edit', 'editfield','delete','import_data'),
							'firmas' => array('list','view','add','edit', 'editfield','delete','import_data'),
							'tipo_firmas' => array('list','view','add','edit', 'editfield','delete','import_data'),
							'v_firma' => array('list','view'),
							'tipo_indicacion' => array('list','view','add','edit', 'editfield','delete','import_data'),
							'v_profesionales' => array('list','view'),
							'detaliquidacioncobertura' => array('list','view','add','edit', 'editfield','delete','import_data'),
							'liquidacioncobertura' => array('list','view','add','edit', 'editfield','delete','import_data'),
							'v_paciente' => array('list','view'),
							'estado_curso' => array('list','view','add','edit', 'editfield','delete'),
							'informes' => array('list','view','add','edit', 'editfield','delete'),
							'v_horarios_paciente' => array('list','view'),
							'documentacion_profesional' => array('list','view','add','edit', 'editfield','delete'),
							'tipodocprofesional' => array('list','view','add','edit', 'editfield','delete'),
							'horarios_paciente' => array('list','view','add','edit', 'editfield','delete'),
							'terapias_por_tratamiento' => array('list','view')
						),
		
			'medico' =>
						array(
							'evoluciones' => array('agregar_evolucion_terapeuta')
						)
		);

	/**
	 * Current user role name
	 * @var string
	 */
	public static $user_role = null;

	/**
	 * pages to Exclude From Access Validation Check
	 * @var array
	 */
	public static $exclude_page_check = array("", "index", "home", "account", "info", "masterdetail");

	/**
	 * Init page properties
	 */
	public function __construct()
	{	
		if(!empty(USER_ROLE)){
			self::$user_role = USER_ROLE;
		}
	}

	/**
	 * Check page path against user role permissions
	 * if user has access return AUTHORIZED
	 * if user has NO access return UNAUTHORIZED
	 * if user has NO role return NO_ROLE
	 * @return string
	 */
	public static function GetPageAccess($path)
	{
		$rp = self::$role_pages;
		if ($rp == "*") {
			return AUTHORIZED; // Grant access to any user
		} else {
			$path = strtolower(trim($path, '/'));

			$arr_path = explode("/", $path);
			$page = strtolower($arr_path[0]);

			//If user is accessing excluded access contrl pages
			if (in_array($page, self::$exclude_page_check)) {
				return AUTHORIZED;
			}

			$user_role = strtolower(USER_ROLE); // Get user defined role from session value
			if (array_key_exists($user_role, $rp)) {
				$action = (!empty($arr_path[1]) ? $arr_path[1] : "list");
				if ($action == "index") {
					$action = "list";
				}
				//Check if user have access to all pages or user have access to all page actions
				if ($rp[$user_role] == "*" || (!empty($rp[$user_role][$page]) && $rp[$user_role][$page] == "*")) {
					return AUTHORIZED;
				} else {
					if (!empty($rp[$user_role][$page]) && in_array($action, $rp[$user_role][$page])) {
						return AUTHORIZED;
					}
				}
				return FORBIDDEN;
			} else {
				//User does not have any role.
				return NOROLE;
			}
		}
	}

	/**
	 * Check if user role has access to a page
	 * @return Bool
	 */
	public static function is_allowed($path)
	{
		return (self::GetPageAccess($path) == AUTHORIZED);
	}

}
