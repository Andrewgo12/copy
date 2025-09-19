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

Class FeGeCmdUpdatePassAuth {

	function execute() {
		extract($_REQUEST);

		settype($objService, "object");
		settype($objProfileService, "object");
		settype($objManager, "object");
		settype($rcData, "array");
		settype($sbResult, "string");
		settype($nuMessage, "integer");

		if (($auth__authusernams != NULL) && ($auth__authusernams != "") 
		&& ($auth__authuserpass_old != NULL) && ($auth__authuserpass_old != "") 
		&& ($auth__authuserpass != NULL) && ($auth__authuserpass != "") 
		&& ($auth__authuserpass_confirm != NULL) && ($auth__authuserpass_confirm != "")) {

			
			$objService = Application :: loadServices("Data_type");

			//Hace la valizacion del tama�o min 4 caracteres
			if (strlen($auth__authuserpass) < 4) {
				WebRequest :: setProperty('cod_message', $nuMessage = 42);
				return "fail";
			}
			//Valida que pass solo sea [A-Z][a-z][0-9][.,_]
			if ($objService->basePrimary($auth__authuserpass) == false) {
				WebRequest :: setProperty('cod_message', $nuMessage = 43);
				return "fail";
			}

			if ($auth__authuserpass !== $auth__authuserpass_confirm) {
				WebRequest :: setProperty('cod_message', $nuMessage = 59);
				return "fail";
			}
			
			$objProfileService = Application :: loadServices("Profiles");
			$objManager = $objProfileService->loadManager("AuthManager");
			$rcData = $objManager->getByIdAuth($auth__authusernams);
			
			//se valida que la contrasenha anterior sea correcta
			if ($rcData[0]["authuserpasss"] !== $auth__authuserpass_old) {
				WebRequest :: setProperty('cod_message', $nuMessage = 60);
				//se cierra la coneccion con el modulo
				$objProfileService->close();
				return "fail";
			}
			$sbResult = $objManager->updateAuthPassword($auth__authusernams, $auth__authuserpass);
			
			//se cierra la coneccion con el modulo
			$objProfileService->close();

			if ($sbResult) {
				WebRequest :: setProperty('cod_message', $nuMessage = 61);
				unset ($_REQUEST["auth__authuserpass_old"]);
				unset ($_REQUEST["auth__authuserpass"]);
				unset ($_REQUEST["auth__authuserpass_confirm"]);
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