<?php
/*
 // you can define the commando extending the WebCommand
 require_once "Web/WebCommand.php";
 class DefaultCommand extends WebCommand {
 }
 // really... is not neccesary extend the WebCommand
 */
require_once "Web/WebRequest.class.php";
class FeCuCmdUpdateCondiusuario {
	function execute() {

		settype($objServiceice,"object");
		settype($nuMessage,"integer");
		extract($_REQUEST);
		if (($condiusuario__couscodigos != NULL) && ($condiusuario__couscodigos != "")
		&& ($condiusuario__cousnombres != NULL) && ($condiusuario__cousnombres != "")) {
			$objService = Application :: loadServices("Data_type");
			//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
			if ($objService->formatPrimaryKey($condiusuario__couscodigos) == false) {
				WebRequest :: setProperty('cod_message', $nuMessage = 4);
				return "fail";
			}
			//Hace la validacion de campos numericos y formateo de campos cadena
			$condiusuario__cousnombres = $objService->formatString($condiusuario__cousnombres);
			$condiusuario__cousdescrips = $objService->formatString($condiusuario__cousdescrips);
			$condiusuario_manager = Application :: getDomainController('CondiusuarioManager');
			$nuMessage = $condiusuario_manager->updateCondiusuario($condiusuario__couscodigos,
			$condiusuario__cousnombres, $condiusuario__cousdescrips, $condiusuario__cousactivos);
			WebRequest :: setProperty('cod_message', $nuMessage);
			return "success";
		} else {
			WebRequest :: setProperty('cod_message', $nuMessage = 0);
			return "fail";
		}
	}
}
?>