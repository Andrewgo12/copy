<?php
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeCrCmdAddCausa {

	function execute() {
		extract($_REQUEST);

		if (($causa__tiorcodigos != NULL) && ($causa__tiorcodigos != "") 
		&& ($causa__evencodigos != NULL) && ($causa__evencodigos != "") 
		&& ($causa__causnombres != NULL) && ($causa__causnombres != "") 
		&& ($causa__causcodigos != NULL) && ($causa__causcodigos != "")) {
			$objServ = Application :: loadServices("Data_type");
			//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria

			if ($objServ->formatPrimaryKey($causa__tiorcodigos) == false) {
				WebRequest :: setProperty('cod_message', $message = 4);
				return "fail";
			}
			if ($objServ->formatPrimaryKey($causa__evencodigos) == false) {
				WebRequest :: setProperty('cod_message', $message = 4);
				return "fail";
			}
			if ($objServ->formatPrimaryKey($causa__causcodigos) == false) {
				WebRequest :: setProperty('cod_message', $message = 4);
				return "fail";
			}
			//Hace la validacion de campos numericos y formateo de campos cadena
			$causa__causnombres = $objServ->formatString($causa__causnombres);
			$causa__causdescrips = $objServ->formatString($causa__causdescrips);
			$causa_manager = Application :: getDomainController('CausaManager');
			$message = $causa_manager->addCausa($causa__tiorcodigos, 
			$causa__evencodigos, $causa__causcodigos, 
			$causa__causnombres, $causa__causdescrips, $causa__causactivas);
			WebRequest :: setProperty('cod_message', $message);
			return "success";
		} else {
			WebRequest :: setProperty('cod_message', $message = 0);
			return "fail";
		}
	}

}
?>