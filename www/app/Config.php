<?php
/**
 * Base para cargar las demás vistas
 */ 
define('BASE_URL', 'http://'.$_SERVER["SERVER_NAME"].'/prueba/www/');
/**
 * Controlador por default
 */ 
define('DEFAULT_CONTROLLER', 'index');
/**
 * Layout por default
 */ 
define('DEFAULT_LAYOUT', 'default'); // Está será la plantilla seleccionada
/**
 * Nombre del site
 */ 
define('APP_NOMBRE', 'Framework');
/**
 * Nombre del site
 */ 
define('APP_ABREVIADO', 'Version 1.0');
/**
 * Nombre del site
 */ 
define('APP_SUBNOMBRE', '@Goyox');
/**
 * CopyRight de nuestro site
 */ 
define('APP_COMPANY', '@Goyox');
/**
 * Define Formato de fecha POSTGRES
 */ 
define('FORMAT_FECHA_PG', 'dd/mm/yyyy');
/**
 * Define Formato de fecha
 */ 
define('FORMAT_FECHA', 'd/m/Y');
/**
 * Define Formato de Hora
 */ 
define('FORMAT_HORA', 'hh:mm:ss');
/**
 * Debug Activo / Inactivo
 */ 
define('DEBUG', True);
/**
 * Nombre del logo
 */
define('NOMBRE_LOGO', "default");
/**
 * Nombre del TEMA
 */
define('NOMBRE_TEMA', "Yeti");
/**
 * Módulos javascript's
 */ 
define('ruta_lib' , BASE_URL . 'libs/');

define("LIBRERIAS", serialize(
        Array(
            "nprogress" => '<link href="'.ruta_lib.'nprogress/nprogress.css" rel="stylesheet" type="text/css"/>'
            . '<script src="'.ruta_lib.'nprogress/nprogress.js"></script>',
            "datatables" => '<link href="'.ruta_lib.'DataTables/css/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />'
            . '<script src="'.ruta_lib.'DataTables/js/jquery.dataTables.min.js"></script>'
            . '<script src="'.ruta_lib.'DataTables/js/dataTables.bootstrap.js"></script>',
            "openlayers" => '<script src="'.ruta_lib.'OpenLayers-2.13.1/OpenLayers.js"></script>',
            "bootstrap-typeahead" => '<script src="'.ruta_lib.'bootstrap-typeahead/bootstrap-typeahead.js"></script>',
            "highcharts" => '<script src="'.ruta_lib.'Highcharts/highcharts.js"></script>'
            . '<script src="'.ruta_lib.'Highcharts/themes/grid-light.js"></script>'
            . '<script src="'.ruta_lib.'Highcharts/modules/drilldown.js"></script>'
            . '<!--<script src="'.ruta_lib.'Highcharts/modules/exporting.js"></script>-->'
            )
        )
    );
define("MODULOS_LIBRERIAS", serialize(
        Array(
            "index"=>Array("nprogress","highcharts","datatables"),
            "ordenvuelos"=>Array("nprogress","datatables"),
            "usuarios"=>Array("nprogress","datatables"),
            "roles"=>Array("nprogress","datatables"),
            "permisos"=>Array("nprogress","datatables"),
            "formularios"=>Array("nprogress","datatables"),
            "paginasinicio"=>Array("nprogress","datatables"),
            "mantenimientos"=>Array("nprogress","datatables"),
            "criteriodisponibilidadsistemas"=>Array("nprogress","datatables"),
            "criteriomantenimientos"=>Array("nprogress","datatables"),
            "personal"=>Array("nprogress","datatables","bootstrap-typeahead"),
            "clasificacionaereonauticas"=>Array("nprogress","datatables"),
            "cefas"=>Array("nprogress","datatables"),
            "parentescos"=>Array("nprogress","datatables"),
            "tipoausencias"=>Array("nprogress","datatables"),
            "grados"=>Array("nprogress","datatables"),
            "estadociviles"=>Array("nprogress","datatables"),
            "ascensos"=>Array("nprogress","datatables"),
            "cursos"=>Array("nprogress","datatables"),
            "academias"=>Array("nprogress","datatables"),
            "postgrados"=>Array("nprogress","datatables"),
            "religiones"=>Array("nprogress","datatables"),
            "referencias"=>Array("nprogress","datatables"),
            "medicos"=>Array("nprogress","datatables"),
            "evaluadores"=>Array("nprogress","datatables"),
            "sanciones"=>Array("nprogress","datatables"),
            "tiposanciones"=>Array("nprogress","datatables"),
            "factoresevaluaciones"=>Array("nprogress","datatables"),
            "categoriafactores"=>Array("nprogress","datatables"),
            "motivoevaluciones"=>Array("nprogress","datatables"),
            "referenciamedicas"=>Array("nprogress","datatables"),
            "cargos"=>Array("nprogress","datatables"),
            "ausencias"=>Array("nprogress","datatables"),
            "sistemas"=>Array("nprogress","datatables"),
            "tiposistemas"=>Array("nprogress","datatables"),
            "estaciones"=>Array("nprogress","datatables"),
            "unidades"=>Array("nprogress","datatables"),
            "grupos"=>Array("nprogress","datatables"),
            "planentrenamientos"=>Array("nprogress","datatables"),
            "misiones"=>Array("nprogress","datatables"),
            "localidades"=>Array("nprogress","datatables"),
            "instituciones"=>Array("nprogress","datatables"),
            "auditorias"=>Array("nprogress","datatables"),
            "configuraciones"=>Array("nprogress"),
            "denegado"=>Array("nprogress"),
            "construccion"=>Array("nprogress"),
            "contrasena"=>Array("nprogress"),
            "armamentos"=>Array("nprogress","datatables"),
            "tipocargas"=>Array("nprogress","datatables"),
            "despegues"=>Array("nprogress","datatables"),
            "aterrizajes"=>Array("nprogress","datatables"),
            "sensores"=>Array("nprogress","datatables"),
            "condicionesopcinales"=>Array("nprogress","datatables"),
            "ordenado"=>Array("nprogress","datatables"),
            "simbolomision"=>Array("nprogress","datatables"),
            "apoyo"=>Array("nprogress","datatables"),
            "funciones"=>Array("nprogress","datatables"),
            "condicionvuelo"=>Array("nprogress","datatables"),
            "carga"=>Array("nprogress","datatables"),
            "codigosmisiones"=>Array("nprogress","datatables"),
            "certificados"=>Array("nprogress","datatables")
            )
        )
    );

/**
 * Parametros para la conexión a base de datos
 */
define('DB_DRIVER', 'pgsql');
define('DB_HOST', 'localhost');
define('DB_USER', 'postgres');
define('DB_PASS', 'postgres');
define('DB_NAME', 'prueba');
define('DB_PORT', '5432');
define('DB_PREFIX', '');

define('DB_PG_CONNECTION', 'pgsql://'.DB_USER.':'.DB_PASS.'@'.DB_HOST.'/'.DB_NAME);

?>
