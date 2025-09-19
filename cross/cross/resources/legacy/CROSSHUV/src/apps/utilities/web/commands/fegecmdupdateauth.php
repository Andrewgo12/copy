<?php

/**
* @Copyright 2004 FullEngine
*
* Comando de modificar a la tabla $tabla
* @author Ingravity 0.0.8
* @date 14-dic-2004
* @location Cali - Colombia
*/

require_once "Web/WebRequest.class.php";

Class FeGeCmdUpdateAuth {

	function execute() {
		extract($_REQUEST);
		settype($objService, "object");
		settype($objManager, "object");
		settype($sbResult, "string");
		settype($nuMessage, "integer");

		if (($auth__authusernams != NULL) && ($auth__authusernams != "") 
		&& ($auth__stylcodigos != NULL) && ($auth__stylcodigos != "") 
		&& ($auth__langcodigos != NULL) && ($auth__langcodigos != "")) {

			$objService = Application :: loadServices("Profiles");
			$objManager = $objService->loadManager("AuthManager");

			$sbResult = $objManager->updateUserEnvironment($auth__authusernams, $auth__stylcodigos, $auth__langcodigos);

			//se cierra la coneccion con el modulo
			$objService->close();

			if ($sbResult) {
				WebRequest :: setProperty('cod_message', $nuMessage = 61);
				return "success";
			} else {
				WebRequest :: setProperty('cod_message', $nuMessage = 100);
				return "fail";
			}
		} else {
			WebRequest :: setProperty('cod_message', $nuMessage = 0);
			return "fail";
		}
	}
}
?>