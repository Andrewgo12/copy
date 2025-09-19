<?php
/*
 // you can define the commando extending the WebCommand
 require_once "Web/WebCommand.php";
 class DefaultCommand extends WebCommand {
 }
 // really... is not neccesary extend the WebCommand
 */
require_once "Web/WebRequest.class.php";
class FeCrCmdUpdateTipoorden {
	function execute() {

		settype($objServiceice,"object");
		settype($nuMessage,"integer");
		extract($_REQUEST);
		if (($tipoorden__tiorcodigos != NULL) && ($tipoorden__tiorcodigos != "")
		&& ($tipoorden__tiornombres != NULL) && ($tipoorden__tiornombres != "")) {
			$objService = Application :: loadServices("Data_type");
			//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
			if ($objService->formatPrimaryKey($tipoorden__tiorcodigos) == false) {
				WebRequest :: setProperty('cod_message', $nuMessage = 4);
				return "fail";
			}
			if(($tipoorden__tiorpeson != NULL && $tipoorden__tiorpeson != "") && ($objService->isInteger($tipoorden__tiorpeson) == false)){
				WebRequest :: setProperty('cod_message', $nuMessage = 4);
				return "fail";
			}
			//Hace la validacion de campos numericos y formateo de campos cadena
			$tipoorden__tiornombres = $objService->formatString($tipoorden__tiornombres);
			$tipoorden__tiordescrips = $objService->formatString($tipoorden__tiordescrips);
			$tipoorden_manager = Application :: getDomainController('TipoordenManager');
			$nuMessage = $tipoorden_manager->updateTipoorden($tipoorden__tiorcodigos,
			$tipoorden__tiornombres, $tipoorden__tiordescrips, $tipoorden__tioractivos,$tipoorden__tiorpeson);
			WebRequest :: setProperty('cod_message', $nuMessage);
			return "success";
		} else {
			WebRequest :: setProperty('cod_message', $nuMessage = 0);
			return "fail";
		}
	}
}
?>