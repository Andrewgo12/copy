<?php
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeCrCmdUpdateMediorecepcion {

	function execute() {
		extract($_REQUEST);

		if (($mediorecepcion__merecodigos != NULL) && ($mediorecepcion__merecodigos != "") 
		&& ($mediorecepcion__merenombres != NULL) && ($mediorecepcion__merenombres != "")) {
			$objServ = Application :: loadServices("Data_type");
			//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria

			if ($objServ->formatPrimaryKey($mediorecepcion__merecodigos) == false) {
				WebRequest :: setProperty('cod_message', $message = 4);
				return "fail";
			}

			//Hace la validacion de campos numericos y formateo de campos cadena
			$mediorecepcion__merenombres = $objServ->formatString($mediorecepcion__merenombres);
			$mediorecepcion__mereescrips = $objServ->formatString($mediorecepcion__mereescrips);

			$mediorecepcion_manager = Application :: getDomainController('MediorecepcionManager');
			$message = $mediorecepcion_manager->updateMediorecepcion($mediorecepcion__merecodigos, 
			$mediorecepcion__merenombres, $mediorecepcion__mereescrips, 
			$mediorecepcion__mereactivos);
			WebRequest :: setProperty('cod_message', $message);
			return "success";
		} else {
			WebRequest :: setProperty('cod_message', $message = 0);
			return "fail";
		}
	}

}
?>