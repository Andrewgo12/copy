<?php 

/**
* @Copyright 2004 FullEngine
*
* Comando de Eliminar a la tabla $tabla
* @author Ingravity 0.0.8
* @date 14-dic-2004
* @location Cali - Colombia
*/

require_once "Web/WebRequest.class.php";

Class FePrCmdDeleteProfiles {

	function execute() {
		extract($_REQUEST);

		if (($profiles__profcodigos != NULL) && ($profiles__profcodigos != "") && ($profiles__applcodigos != NULL) && ($profiles__applcodigos != "")) {
              $profiles_manager = Application::getDomainController('ProfilesManager'); 
			$message = $profiles_manager->deleteProfiles($profiles__profcodigos, $profiles__applcodigos);
			if($message == 3){
				//Elimina el xml 
				$xmlProfileManager = Application::getDomainController('XmlProfileManager');
				$xmlProfileManager->unsetXmlProfile($profiles__profcodigos);
			}
			WebRequest :: setProperty('cod_message', $message);
			return "success";
		} else {
			WebRequest :: setProperty('cod_message', $message = 0);
			return "fail";
		}
	}
}
?>