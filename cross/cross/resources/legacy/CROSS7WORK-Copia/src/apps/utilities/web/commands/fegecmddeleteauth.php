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

Class FeGeCmdDeleteAuth {

	function execute() {
		extract($_REQUEST);

		if (($auth__authusernams != NULL) && ($auth__authusernams != "")) {
			$profilesServices = Application :: loadServices("Profiles");
			$auth_manager = $profilesServices->loadManager("AuthManager");
			$message = $auth_manager->deleteAuth($auth__authusernams);
			WebRequest :: setProperty('cod_message', $message);
			$profilesServices->close();
			return "success";
		} else {
			WebRequest :: setProperty('cod_message', $message = 0);
			return "fail";
		}
	}

}

?>	
