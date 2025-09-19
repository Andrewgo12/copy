<?php
#!/bin/sh

$Application_constant = array (
        1 => array( //Constantes para profiles
            'DEFAULT_APP' => '1',
            'DEFAULT_STYLE' => '1',
            'DEFAULT_LANG' => 'es',
            'DEFAULT_PROF' => '2', //Perfil por defecto para WS
            'DEFAULT_SCHEMA' => '3', //Esquema por defecto para los WS
            'DB_NULL' => 'NULL', //Null para las bases de datos
            "REG_INACT" => "I", //Indicador de registros inactivos
            "REG_ACTIVE" => "A", //Indicador de registros activos
            "SCHEMA_PROFILE" => 1, //Indica el esquema del profiles
            'URL_HELP' => '../../../../public/manual_CROSS/index.html', //Url de las ayudas
            'PROFILES_APP' => '2', //Indica el c�digo de la aplicaci�n del profiles
            'PROFILES_PROF' => '1', //Indica el c�digo del perfil del profiles
            'ADMIN_USER' => 'Admin', //Indica el nombre del usuario administrador
            'WEB_USER' => 'webuser', //Indica el nombre del usuario administrador
            "MAXLENGTH_TEXTAREA" => 10000, //tama�o maxino del los text area
            "MODULES" => array("cross300"=>array("application.constant.data"),
            				   "customers"=>array("application.constant.data"),
            				   "general"=>array("application.constant.data","application.params.data"),
            				   "human_resources"=>array("application.constant.data"),
            				   "storage"=>array("application.constant.data"),
            				   "workflow"=>array("application.constant.data"), //arreglo con lo modulos de la aplicacion y los archivos que deben modificarse al actualizar un esquema
            				   "schedule"=>array("application.constant.data"),
        					   "encuestas"=>array("application.constant.data"),
        					   "products"=>array("application.constant.data"),), //arreglo con lo modulos de la aplicacion y los archivos que deben modificarse al actualizar un esquema
			"SUFIJO_SCHEMA"=>"schema",
        	"SUFIJO_USER"=>"USER",//prefijo para los usuarios creados por sincronizacion de campanhas
			"TABLES_TEMPLATE_PATH"=>dirname(dirname(__FILE__))."/data/dbscripts/templates/tablas.sql",
			"DATA_TEMPLATE_PATH"=>dirname(dirname(__FILE__))."/data/dbscripts/templates/Ldata.sql",
			"CONSTRAINTS_TEMPLATE_PATH"=>dirname(dirname(__FILE__))."/data/dbscripts/templates/constraint.sql",
        	'PROFILES_LEADER' => '5', //Indica el c�digo del perfil del profiles
        	'PROFILES_AGENT' => '6', //Indica el c�digo del perfil del profiles
        	'PERMISIONS'=>array("5"=>array("FeGeCmdDefaultAuth","FeGeCmdUpdatePassAuth","FeCrCmdDefaultAdminTareas",
        								   "FeCrCmdDefaultFichaOrd","FeCrCmdDefaultRepoTiemposEjec","FeCrCmdDefaultListadoOrden",
        								   "FeCrCmdDefaultEstadoTickets","FeCrCmdDefaultConsolidado","FeCrCmdDefaultDetallado",
          								   "FeCrCmdDefaultActuareq"),
          						"6"=>array("FeGeCmdDefaultAuth","FeGeCmdUpdatePassAuth","FeCrCmdDefaultAdminTareas",
          						"FeCrCmdDefaultListadoOrden",)),
        ),
);

$path = dirname(__FILE__)."/application.constant.data";
$fd = fopen($path,"w");
if($fd){
    fwrite($fd, serialize($Application_constant));
    fclose($fd);
}else{
    die("[PROFILES] constant file ERROR\n");
}
die("[PROFILES] constant file OK\n");
?>