<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdAddTipoexamen {
	function execute() {
		
		settype($objService,"object");
		settype($nuMessage,"integer");
		extract($_REQUEST);
		if (($tipoexamen__tiexcodigos != NULL) && ($tipoexamen__tiexcodigos != "") 
		&& ($tipoexamen__tiexnombres != NULL) && ($tipoexamen__tiexnombres != "")) {
			$objService = Application :: loadServices("Data_type");
			//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
			if ($objService->formatPrimaryKey($tipoexamen__tiexcodigos) == false) {
				WebRequest :: setProperty('cod_message', $nuMessage = 4);
				return "fail";
			}
			
			//Hace la validacion de campos numericos y formateo de campos cadena
			$tipoexamen__tiexnombres = $objService->formatString($tipoexamen__tiexnombres);
			$tipoexamen__tiexdescrips = $objService->formatString($tipoexamen__tiexdescrips);
			$tipoexamen_manager = Application :: getDomainController('TipoexamenManager');
			$nuMessage = $tipoexamen_manager->addTipoexamen($tipoexamen__tiexcodigos, 
			$tipoexamen__tiexnombres, $tipoexamen__tiexdescrips, $tipoexamen__tiexactivos);
			WebRequest :: setProperty('cod_message', $nuMessage);
			return "success";
		} else {
			WebRequest :: setProperty('cod_message', $nuMessage = 0);
			return "fail";
		}
	}
}
?>