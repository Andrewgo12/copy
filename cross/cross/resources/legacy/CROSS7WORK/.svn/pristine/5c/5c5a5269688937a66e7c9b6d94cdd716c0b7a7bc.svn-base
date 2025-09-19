<?php 
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeGeCmdAddTipoarchivo {
	function execute() {
		extract($_REQUEST);
		if (($tipoarchivo__tiarcodigos != NULL) && ($tipoarchivo__tiarcodigos != "") && ($tipoarchivo__tiarnombres != NULL) && ($tipoarchivo__tiarnombres != "")) {
			$objServ = Application :: loadServices("Data_type");
			//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
			if ($objServ->formatPrimaryKey($tipoarchivo__tiarcodigos) == false) {
				WebRequest :: setProperty('cod_message', $message = 4);
				return "fail";
			}
			//Hace la validacion de campos numericos y formateo de campos cadena
			$tipoarchivo__tiarobservas = $objServ->formatString($tipoarchivo__tiarobservas);
			$tipoarchivo_manager = Application :: getDomainController('TipoarchivoManager');
			$message = $tipoarchivo_manager->addTipoarchivo($tipoarchivo__tiarcodigos, $tipoarchivo__tiarnombres, $tipoarchivo__tiarobservas, $tipoarchivo__tiarestados);
			WebRequest :: setProperty('cod_message', $message);
			return "success";
		} else {
			WebRequest :: setProperty('cod_message', $message = 0);
			return "fail";
		}
	}
}
?>	