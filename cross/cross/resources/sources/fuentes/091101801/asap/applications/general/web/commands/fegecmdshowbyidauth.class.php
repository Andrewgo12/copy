<?php 

/**
* @Copyright 2004 FullEngine
*
* Comando de consultar a la tabla $tabla
* @author Ingravity 0.0.8
* @date 14-dic-2004
* @location Cali - Colombia
*/

require_once "Web/WebRequest.class.php";

Class FeGeCmdShowByIdAuth {

	function execute() {
		extract($_REQUEST);

		if (($auth__authusernams != NULL) && ($auth__authusernams != "")) {
			//Carga el servicio de profiles
			$profilesServece = Application :: loadServices("Profiles");
			$auth_manager = $profilesServece->loadManager("AuthManager");
			//$auth_manager = Application :: getDomainController('AuthManager');
			$auth_data = $auth_manager->getByIdAuth($auth__authusernams);
			$profilesServece->close();
			$_REQUEST["auth__authusernams"] = $auth_data[0]["authusernams"];
			$_REQUEST["auth__authuserpasss"] = $auth_data[0]["authuserpasss"];
			$_REQUEST["auth__authrealname"] = $auth_data[0]["authrealname"];
			$_REQUEST["auth__authrealape1"] = $auth_data[0]["authrealape1"];
			$_REQUEST["auth__authrealape2"] = $auth_data[0]["authrealape2"];
			$_REQUEST["auth__authemail"] = $auth_data[0]["authemail"];
			$_REQUEST["auth__applcodigos"] = $auth_data[0]["applcodigos"];
			$_REQUEST["auth__stylcodigos"] = $auth_data[0]["stylcodigos"];
			$_REQUEST["auth__langcodigos"] = $auth_data[0]["langcodigos"];
			$_REQUEST["auth__profcodigos"] = $auth_data[0]["profcodigos"];
			$_REQUEST["auth__authestados"] = $auth_data[0]["authestados"];
		} else {
			$_REQUEST["auth__authusernams"] = WebSession :: getProperty("auth__authusernams");
			$_REQUEST["auth__authuserpasss"] = WebSession :: getProperty("auth__authuserpasss");
			$_REQUEST["auth__authrealname"] = WebSession :: getProperty("auth__authrealname");
			$_REQUEST["auth__authrealape1"] = WebSession :: getProperty("auth__authrealape1");
			$_REQUEST["auth__authrealape2"] = WebSession :: getProperty("auth__authrealape2");
			$_REQUEST["auth__authemail"] = WebSession :: getProperty("auth__authemail");
			$_REQUEST["auth__applcodigos"] = WebSession :: getProperty("auth__applcodigos");
			$_REQUEST["auth__stylcodigos"] = WebSession :: getProperty("auth__stylcodigos");
			$_REQUEST["auth__langcodigos"] = WebSession :: getProperty("auth__langcodigos");
			$_REQUEST["auth__profcodigos"] = WebSession :: getProperty("auth__profcodigos");
			$_REQUEST["auth__authestados"] = WebSession :: getProperty("auth__authestados");
		}

		WebSession :: unsetProperty("auth__authusernams");
		WebSession :: unsetProperty("auth__authuserpasss");
		WebSession :: unsetProperty("auth__authrealname");
		WebSession :: unsetProperty("auth__authrealape1");
		WebSession :: unsetProperty("auth__authrealape2");
		WebSession :: unsetProperty("auth__authemail");
		WebSession :: unsetProperty("auth__applcodigos");
		WebSession :: unsetProperty("auth__stylcodigos");
		WebSession :: unsetProperty("auth__langcodigos");
		WebSession :: unsetProperty("auth__profcodigos");
		WebSession :: unsetProperty("auth__authestados");
		return "success";
	}

}

?>	
