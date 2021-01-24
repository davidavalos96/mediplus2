<?php
/**
 * Menu Items
 * All Project Menu
 * @category  Menu List
 */

class Menu{
	
	
			public static $navbarsideleft = array(
		array(
			'path' => 'home', 
			'label' => 'Home', 
			'icon' => ''
		),
		
		array(
			'path' => 'liquidacioncobertura', 
			'label' => 'ADMINISTRACION', 
			'icon' => '<i class="fa fa-cubes "></i>','submenu' => array(
		array(
			'path' => 'menu6/Index', 
			'label' => 'Compras', 
			'icon' => '<i class="fa fa-folder-open "></i>'
		),
		
		array(
			'path' => 'menu6', 
			'label' => 'Cobranzas', 
			'icon' => '<i class="fa fa-usd "></i>'
		),
		
		array(
			'path' => 'menu6', 
			'label' => 'Clientes de Facturación', 
			'icon' => '<i class="fa fa-group "></i>'
		),
		
		array(
			'path' => 'menu6', 
			'label' => 'Facturación', 
			'icon' => '<i class="fa fa-balance-scale "></i>'
		),
		
		array(
			'path' => 'liquidacioncobertura', 
			'label' => 'Liquidación de Obras Sociales', 
			'icon' => '<i class="fa fa-institution "></i>'
		),
		
		array(
			'path' => 'menu6', 
			'label' => 'Liquidacion del Profesional', 
			'icon' => '<i class="fa fa-user-plus "></i>'
		)
	)
		),
		
		array(
			'path' => 'historiaclinica', 
			'label' => 'GESTION DE PACIENTES', 
			'icon' => '<i class="fa fa-group "></i>','submenu' => array(
		array(
			'path' => 'pacientes', 
			'label' => 'DATOS PERSONALES', 
			'icon' => '<i class="fa fa-list "></i>'
		),
		
		array(
			'path' => 'historiaclinica', 
			'label' => 'HISTORIA CLINICA', 
			'icon' => '<i class="fa fa-archive "></i>'
		)
	)
		),
		
		array(
			'path' => 'profesionales', 
			'label' => 'PROFESIONALES', 
			'icon' => '<i class="fa fa-user-md "></i>','submenu' => array(
		array(
			'path' => 'profesionales', 
			'label' => 'DATOS PERSONALES', 
			'icon' => '<i class="fa fa-user-md "></i>'
		)
	)
		),
		
		array(
			'path' => 'estrategiaterapeutica', 
			'label' => 'TRATAMIENTOS', 
			'icon' => '<i class="fa fa-book "></i>','submenu' => array(
		array(
			'path' => 'estrategiaterapeutica', 
			'label' => 'ESTRATEGIAS TERAPEUTICAS', 
			'icon' => '<i class="fa fa-list "></i>'
		),
		
		array(
			'path' => 'tratamientos', 
			'label' => 'TRATAMIENTOS POR PACIENTE', 
			'icon' => '<i class="fa fa-group "></i>'
		)
	)
		),
		
		array(
			'path' => 'cobertura', 
			'label' => 'COBERTURAS', 
			'icon' => '<i class="fa fa-institution "></i>'
		),
		
		array(
			'path' => 'usuarios', 
			'label' => 'USUARIOS', 
			'icon' => '<i class="fa fa-list-alt "></i>'
		),
		
		array(
			'path' => 'home', 
			'label' => 'REPORTES', 
			'icon' => '<i class="fa fa-bar-chart "></i>','submenu' => array(
		array(
			'path' => 'menu14', 
			'label' => 'AUTORIZACIONES', 
			'icon' => '','submenu' => array(
		array(
			'path' => 'menu14', 
			'label' => 'CAMBIO DE PAÑALES', 
			'icon' => '<i class="fa fa-file "></i>'
		),
		
		array(
			'path' => 'menu14', 
			'label' => 'USO DE IMAGEN', 
			'icon' => '<i class="fa fa-picture-o "></i>'
		)
	)
		),
		
		array(
			'path' => 'menu14', 
			'label' => 'PLANILLA DE ASISTENCIA', 
			'icon' => ''
		),
		
		array(
			'path' => 'menu14', 
			'label' => 'EVOLUCIONES POR ESP', 
			'icon' => '<i class="fa fa-book "></i>'
		),
		
		array(
			'path' => 'menu14', 
			'label' => 'PACIENTES C/ COORDINADOR', 
			'icon' => '<i class="fa fa-user "></i>'
		),
		
		array(
			'path' => 'home', 
			'label' => 'CRONOGRAMA DE HORARIO', 
			'icon' => '<i class="fa fa-clock-o "></i>','submenu' => array(
		array(
			'path' => 'tratamientos/cronograma_horario', 
			'label' => 'HORARIO PACIENTE', 
			'icon' => ''
		),
		
		array(
			'path' => '/', 
			'label' => 'HORARIO CONSULTORIO', 
			'icon' => ''
		),
		
		array(
			'path' => '/', 
			'label' => 'HORARIO PROFESIONAL', 
			'icon' => ''
		)
	)
		)
	)
		),
		
		array(
			'path' => 'turnos', 
			'label' => 'TURNOS', 
			'icon' => '<i class="fa fa-archive "></i>','submenu' => array(
		array(
			'path' => 'turnos/lista', 
			'label' => 'AGENDA DEL PROFESIONAL', 
			'icon' => ''
		),
		
		array(
			'path' => 'turnos/agendapaciente', 
			'label' => 'AGENDA DEL PACIENTE', 
			'icon' => ''
		),
		
		array(
			'path' => 'turnos/turnos_del_dia_gral', 
			'label' => 'TURNOS DEL DIA', 
			'icon' => ''
		),
		
		array(
			'path' => 'turnos/cronograma_pacientes', 
			'label' => 'Cronograma Pacientes', 
			'icon' => ''
		)
	)
		),
		
		array(
			'path' => 'configuracion', 
			'label' => 'CONFIGURACIONES', 
			'icon' => '<i class="fa fa-cogs "></i>','submenu' => array(
		array(
			'path' => 'pacientes/configuracion', 
			'label' => 'PACIENTES', 
			'icon' => '<i class="fa fa-user "></i>'
		),
		
		array(
			'path' => 'profesionales/configuracion', 
			'label' => 'PROFESIONALES', 
			'icon' => '<i class="fa fa-group "></i>'
		),
		
		array(
			'path' => 'historiaclinica/configuracion', 
			'label' => 'HISTORIA CLINICA', 
			'icon' => '<i class="fa fa-archive "></i>'
		),
		
		array(
			'path' => 'turnos/configuracion', 
			'label' => 'TURNOS', 
			'icon' => '<i class="fa fa-folder-open "></i>'
		)
	)
		),
		
		array(
			'path' => 'horarios_paciente', 
			'label' => 'Horarios Paciente', 
			'icon' => ''
		),
		
		array(
			'path' => 'terapias_por_tratamiento', 
			'label' => 'Terapias Por Tratamiento', 
			'icon' => ''
		)
	);
		
	
	
			public static $TIPODOCUMENTO = array(
		array(
			"value" => "CUIT", 
			"label" => "CUIT", 
		),);
		
			public static $user_role_id = array(
		array(
			"value" => "Administrator", 
			"label" => "Administrator", 
		),
		array(
			"value" => "User", 
			"label" => "User", 
		),
		array(
			"value" => "Terapeuta", 
			"label" => "Terapeuta", 
		),
		array(
			"value" => "Recepcion", 
			"label" => "Recepcion", 
		),
		array(
			"value" => "Administracion", 
			"label" => "Administracion", 
		),);
		
			public static $TIPODOCPRO = array(
		array(
			"value" => "DNI", 
			"label" => "DNI", 
		),
		array(
			"value" => "CUIT", 
			"label" => "CUIT", 
		),);
		
			public static $TIPODOCPRO2 = array(
		array(
			"value" => "CUIT", 
			"label" => "CUIT", 
		),
		array(
			"value" => "DNI", 
			"label" => "DNI", 
		),);
		
			public static $modalidad = array(
		array(
			"value" => "MODULO", 
			"label" => "MODULO", 
		),
		array(
			"value" => "SESION", 
			"label" => "SESION", 
		),);
		
			public static $activo = array(
		array(
			"value" => "SI", 
			"label" => "Si", 
		),
		array(
			"value" => "NO", 
			"label" => "No", 
		),);
		
			public static $periodo = array(
		array(
			"value" => "MENSUAL", 
			"label" => "MENSUAL", 
		),
		array(
			"value" => "BIMESTRAL", 
			"label" => "BIMESTRAL", 
		),
		array(
			"value" => "TRIMESTRAL", 
			"label" => "TRIMESTRAL", 
		),
		array(
			"value" => "CUATRIMESTRE", 
			"label" => "CUATRIMESTRE", 
		),
		array(
			"value" => "ANUAL", 
			"label" => "ANUAL", 
		),);
		
			public static $seleccionar = array(
		array(
			"value" => "SI", 
			"label" => "SI", 
		),
		array(
			"value" => "NO", 
			"label" => "NO", 
		),);
		
}