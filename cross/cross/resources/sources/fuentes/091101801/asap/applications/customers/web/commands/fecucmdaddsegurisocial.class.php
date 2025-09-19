<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdAddSegurisocial {
	function execute() {
		
		settype($objService,"object");
		settype($nuMessage,"integer");
		extract($_REQUEST);
		if (($segurisocial__sesocodigos != NULL) && ($segurisocial__sesocodigos != "") 
		&& ($segurisocial__sesonombres != NULL) && ($segurisocial__sesonombres != "")) {
			$objService = Application :: loadServices("Data_type");
			//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
			if ($objService->formatPrimaryKey($segurisocial__sesocodigos) == false) {
				WebRequest :: setProperty('cod_message', $nuMessage = 4);
				return "fail";
			}
			
			//Hace la validacion de campos numericos y formateo de campos cadena
			$segurisocial__sesonombres = $objService->formatString($segurisocial__sesonombres);
			$segurisocial__sesodescrips = $objService->formatString($segurisocial__sesodescrips);
			$segurisocial_manager = Application :: getDomainController('SegurisocialManager');
			$nuMessage = $segurisocial_manager->addSegurisocial($segurisocial__sesocodigos, 
			$segurisocial__sesonombres, $segurisocial__sesodescrips, $segurisocial__sesoactivos);
			WebRequest :: setProperty('cod_message', $nuMessage);
			return "success";
		} else {
			WebRequest :: setProperty('cod_message', $nuMessage = 0);
			return "fail";
		}
	}
}
?>