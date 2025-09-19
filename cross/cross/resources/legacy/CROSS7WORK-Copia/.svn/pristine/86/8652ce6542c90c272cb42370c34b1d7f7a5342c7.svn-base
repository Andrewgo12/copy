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

Class FePrCmdShowByIdProfiles {

	function execute() {
		extract($_REQUEST);
		
		if (($profiles__profcodigos != NULL) && ($profiles__profcodigos != "") && ($profiles__applcodigos != NULL) && ($profiles__applcodigos != "")) {
			$profiles_manager = Application::getDomainController('ProfilesManager');
			$profiles_data = $profiles_manager->getByIdProfiles($profiles__profcodigos, $profiles__applcodigos);
			$_REQUEST["profiles__profcodigos"] = $profiles_data[0]["profcodigos"];
			$_REQUEST["profiles__applcodigos"] = $profiles_data[0]["applcodigos"];
			$_REQUEST["profiles__profnombres"] = $profiles_data[0]["profnombres"];
			$_REQUEST["profiles__profdescrips"] = $profiles_data[0]["profdescrips"];

		} else {

			$_REQUEST["profiles__profcodigos"] = WebSession :: getProperty("profiles__profcodigos");
			$_REQUEST["profiles__applcodigos"] = WebSession :: getProperty("profiles__applcodigos");
			$_REQUEST["profiles__profnombres"] = WebSession :: getProperty("profiles__profnombres");
			$_REQUEST["profiles__profdescrips"] = WebSession :: getProperty("profiles__profdescrips");
		}

		WebSession :: unsetProperty("profiles__profcodigos");
		WebSession :: unsetProperty("profiles__applcodigos");
		WebSession :: unsetProperty("profiles__profnombres");
		WebSession :: unsetProperty("profiles__profdescrips");
		
		return "success";
	}
}
?>