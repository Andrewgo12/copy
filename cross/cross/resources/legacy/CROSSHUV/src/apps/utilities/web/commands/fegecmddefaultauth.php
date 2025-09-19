<?php


/**
* @Copyright 2004 FullEngine
*
* Comando de Inicial de la tabla $tabla
* @author Ingravity 0.0.8
* @date 14-dic-2004
* @location Cali - Colombia
*/

require_once "Web/WebRequest.class.php";

Class FeGeCmdDefaultAuth {

	function execute() {
		extract($_REQUEST);

		settype($objService, "object");
		settype($objManager, "object");
		settype($rcUser, "array");
		settype($rcData, "array");
		settype($sbPassword, "string");
		settype($sbPasswordconfirm, "string");
		settype($sbPasswordold, "string");

		$rcUser = Application :: getUserParam();
		$objService = Application :: loadServices("Profiles");
		$objManager = $objService->loadManager("AuthManager");
		$rcData = $objManager->getByIdAuth($rcUser["username"]);
		

		//SI limpia el $_REQUEST
		if ($clean_table) {
			
			$_REQUEST["auth__stylcodigos"] = $rcData[0]["stylcodigos"];
			$_REQUEST["auth__langcodigos"] = $rcData[0]["langcodigos"];
			unset ($_REQUEST["clean_table"]);
		}
		$objService->close();

		if ($clean_pass) {

			unset ($_REQUEST["clean_pass"]);
			unset ($_REQUEST["auth__authuserpass_old"]);
			unset ($_REQUEST["auth__authuserpass"]);
			unset ($_REQUEST["auth__authuserpass_confirm"]);

		}

		//se carga el $_REQUEST
		if (!$_REQUEST["auth__authusernams"]) {

			$_REQUEST["auth__authusernams"] = $rcData[0]["authusernams"];
			$_REQUEST["auth__authrealname"] = $rcData[0]["authrealname"];
			$_REQUEST["auth__authrealape1"] = $rcData[0]["authrealape1"];
			$_REQUEST["auth__authrealape2"] = $rcData[0]["authrealape2"];
			$_REQUEST["auth__authemail"] = $rcData[0]["authemail"];
			$_REQUEST["auth__stylcodigos"] = $rcData[0]["stylcodigos"];
			$_REQUEST["auth__langcodigos"] = $rcData[0]["langcodigos"];
		}

		return "success";
	}
}
?>