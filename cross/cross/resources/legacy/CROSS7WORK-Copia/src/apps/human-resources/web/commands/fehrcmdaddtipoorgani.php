<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeHrCmdAddTipoorgani {
	function execute() {
		settype($tipoorgani__tiorcodpadrs,"string");
		extract($_REQUEST);
		if (($tipoorgani__tiorcodigos != NULL) && ($tipoorgani__tiorcodigos != "")
		 && ($tipoorgani__tiornombres != NULL) && ($tipoorgani__tiornombres != "")) {
			$objServ = Application :: loadServices("Data_type");
			//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
			if ($objServ->formatPrimaryKey($tipoorgani__tiorcodigos) == false) {
				WebRequest :: setProperty('cod_message', $message = 4);
				return "fail";
			}
			//Hace la validacion de campos numericos y formateo de campos cadena
			$tipoorgani__tiornombres = $objServ->formatString($tipoorgani__tiornombres);
			$tipoorgani__tiordesc = $objServ->formatString($tipoorgani__tiordesc);
			$tipoorgani__tiorcodpadrs = $objServ->formatString($tipoorgani__tiorcodpadrs);
			$tipoorgani_manager = Application :: getDomainController('TipoorganiManager');
			$message = $tipoorgani_manager->addTipoorgani($tipoorgani__tiorcodigos,
			 $tipoorgani__tiornombres, $tipoorgani__tiordesc, $tipoorgani__tiorcodpadrs,
			  $tipoorgani__tioractivos);
			WebRequest :: setProperty('cod_message', $message);
			return "success";
		} else {
			WebRequest :: setProperty('cod_message', $message = 0);
			return "fail";
		}
	}
}
?>