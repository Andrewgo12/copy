<?php

/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeHrCmdAddEstadoorgani {
	function execute() {
		extract($_REQUEST);
		if (($estadoorgani__esorcodigos != NULL) && ($estadoorgani__esorcodigos != "")
		 && ($estadoorgani__esornombres != NULL) && ($estadoorgani__esornombres != "")) {
			$objServ = Application :: loadServices("Data_type");
			//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
			if ($objServ->formatPrimaryKey($estadoorgani__esorcodigos) == false) {
				WebRequest :: setProperty('cod_message', $message = 4);
				return "fail";
			}
			//Hace la validacion de campos numericos y formateo de campos cadena
			$estadoorgani__esornombres = $objServ->formatString($estadoorgani__esornombres);
			$estadoorgani__esordescrips = $objServ->formatString($estadoorgani__esordescrips);
			$estadoorgani_manager = Application :: getDomainController('EstadoorganiManager');
			$message = $estadoorgani_manager->addEstadoorgani($estadoorgani__esorcodigos, $estadoorgani__esornombres, $estadoorgani__esordescrips, $estadoorgani__esoractivas);
			WebRequest :: setProperty('cod_message', $message);
			return "success";
		} else {
			WebRequest :: setProperty('cod_message', $message = 0);
			return "fail";
		}
	}
}
?>