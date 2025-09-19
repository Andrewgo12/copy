<?php
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeCrCmdAddEvento {

	function execute() {
		extract($_REQUEST);

		if (($evento__tiorcodigos != NULL) && ($evento__tiorcodigos != "") 
		&& ($evento__evennombres != NULL) && ($evento__evennombres != "") 
		&& ($evento__evencodigos != NULL) && ($evento__evencodigos != "")) {
			$objServ = Application :: loadServices("Data_type");
			//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria

			if ($objServ->formatPrimaryKey($evento__tiorcodigos) == false) {
				WebRequest :: setProperty('cod_message', $message = 4);
				return "fail";
			}
			if ($objServ->formatPrimaryKey($evento__evencodigos) == false) {
				WebRequest :: setProperty('cod_message', $message = 4);
				return "fail";
			}

			//Hace la validacion de campos numericos y formateo de campos cadena
			$evento__evennombres = $objServ->formatString($evento__evennombres);
			$evento__evendescrips = $objServ->formatString($evento__evendescrips);

			$evento_manager = Application :: getDomainController('EventoManager');
			$message = $evento_manager->addEvento($evento__tiorcodigos, 
			$evento__evencodigos, $evento__evennombres, 
			$evento__evendescrips, $evento__evenactivos);
			WebRequest :: setProperty('cod_message', $message);
			return "success";
		} else {
			WebRequest :: setProperty('cod_message', $message = 0);
			return "fail";
		}
	}

}
?>