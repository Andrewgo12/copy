<?php

/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeWFCmdAddEstadoacta {
	function execute() {
		extract($_REQUEST);
		if (($estadoacta__esaccodigos != NULL) && ($estadoacta__esaccodigos != "") && ($estadoacta__esacnombres != NULL) && ($estadoacta__esacnombres != "")) {
			$objServ = Application :: loadServices("Data_type");
			//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
			if ($objServ->formatPrimaryKey($estadoacta__esaccodigos) == false) {
				WebRequest :: setProperty('cod_message', $message = 4);
				return "fail";
			}
			//Hace la validacion de campos numericos y formateo de campos cadena
			$estadoacta__esacnombres = $objServ->formatString($estadoacta__esacnombres);
			$estadoacta__esacdescrips = $objServ->formatString($estadoacta__esacdescrips);
			$estadoacta_manager = Application :: getDomainController('EstadoactaManager');
			$message = $estadoacta_manager->addEstadoacta($estadoacta__esaccodigos, $estadoacta__esacnombres, $estadoacta__esacdescrips, $estadoacta__esacactivas);
			WebRequest :: setProperty('cod_message', $message);
			return "success";
		} else {
			WebRequest :: setProperty('cod_message', $message = 0);
			return "fail";
		}
	}
}
?>	

