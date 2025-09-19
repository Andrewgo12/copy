<?php 
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdUpdateProveerecurs {
	function execute() {
		extract($_REQUEST);
		if (($proveerecurs__prrecodigos != NULL) && ($proveerecurs__prrecodigos != "") && ($proveerecurs__provcodigos != NULL) && ($proveerecurs__provcodigos != "") && ($proveerecurs__recucodigos != NULL) && ($proveerecurs__recucodigos != "")) {
			$objServ = Application :: loadServices("Data_type");
			//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
			if ($objServ->formatPrimaryKey($proveerecurs__prrecodigos) == false) {
				WebRequest :: setProperty('cod_message', $message = 4);
				return "fail";
			}
			//Hace la validacion de campos numericos y formateo de campos cadena
			if ($proveerecurs__prrevalorecf == "") {
				$proveerecurs__prrevalorecf = "NULL";
			}
			$proveerecurs_manager = Application :: getDomainController('ProveerecursManager');
			$message = $proveerecurs_manager->updateProveerecurs($proveerecurs__prrecodigos, $proveerecurs__provcodigos, $proveerecurs__recucodigos, $proveerecurs__prrevalorecf);
			WebRequest :: setProperty('cod_message', $message);
			return "success";
		} else {
			WebRequest :: setProperty('cod_message', $message = 0);
			return "fail";
		}
	}
}
?>	
