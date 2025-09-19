<?php 

/**
* @Copyright 2004 FullEngine
*
* Comando de consultar todos a la tabla $tabla
* @author Ingravity 0.0.8
* @date 14-dic-2004
* @location Cali - Colombia
*/

require_once "Web/WebRequest.class.php";

Class FePrCmdShowListAuth {

	function execute() {
		extract($_REQUEST);

		if (!WebSession :: issetProperty("auth__authusernams"))
			WebSession :: setProperty("auth__authusernams", $auth__authusernams);

		if (!WebSession :: issetProperty("auth__authuserpasss"))
			WebSession :: setProperty("auth__authuserpasss", $auth__authuserpasss);

		if (!WebSession :: issetProperty("auth__authrealname"))
			WebSession :: setProperty("auth__authrealname", $auth__authrealname);

		if (!WebSession :: issetProperty("auth__authrealape1"))
			WebSession :: setProperty("auth__authrealape1", $auth__authrealape1);

		if (!WebSession :: issetProperty("auth__authrealape2"))
			WebSession :: setProperty("auth__authrealape2", $auth__authrealape2);

		if (!WebSession :: issetProperty("auth__authemail"))
			WebSession :: setProperty("auth__authemail", $auth__authemail);

		if (!WebSession :: issetProperty("auth__applcodigos"))
			WebSession :: setProperty("auth__applcodigos", $auth__applcodigos);

		if (!WebSession :: issetProperty("auth__stylcodigos"))
			WebSession :: setProperty("auth__stylcodigos", $auth__stylcodigos);

		if (!WebSession :: issetProperty("auth__langcodigos"))
			WebSession :: setProperty("auth__langcodigos", $auth__langcodigos);

		if (!WebSession :: issetProperty("auth__profcodigos"))
			WebSession :: setProperty("auth__profcodigos", $auth__profcodigos);

		if (!WebSession :: issetProperty("auth__authestados"))
			WebSession :: setProperty("auth__authestados", $auth__authestados);

		return "success";
	}

}

?>	
