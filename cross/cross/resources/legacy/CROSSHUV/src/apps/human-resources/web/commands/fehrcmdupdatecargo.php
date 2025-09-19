<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeHrCmdUpdateCargo {
	function execute() {
		extract($_REQUEST);
		if (($cargo__cargcodigos != NULL) && ($cargo__cargcodigos != "")
		 && ($cargo__cargnombres != NULL) && ($cargo__cargnombres != "")) {
			$objServ = Application :: loadServices("Data_type");
			//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
			if ($objServ->formatPrimaryKey($cargo__cargcodigos) == false) {
				WebRequest :: setProperty('cod_message', $message = 4);
				return "fail";
			}
			//Hace la validacion de campos numericos y formateo de campos cadena
			$cargo__cargnombres = $objServ->formatString($cargo__cargnombres);
			$cargo__cargdescrips = $objServ->formatString($cargo__cargdescrips);
			$cargo__cargactivas = $objServ->formatString($cargo__cargactivas);
			$cargo_manager = Application :: getDomainController('CargoManager');
			$message = $cargo_manager->updateCargo($cargo__cargcodigos, $cargo__cargnombres,
			 $cargo__cargdescrips, $cargo__cargactivas);
			WebRequest :: setProperty('cod_message', $message);
			return "success";
		} else {
			WebRequest :: setProperty('cod_message', $message = 0);
			return "fail";
		}
	}
}
?>