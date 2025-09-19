<?php 
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdUpdateGruporecurso {
	function execute() {
		extract($_REQUEST);
		if (($gruporecurso__grrecodigos != NULL) && ($gruporecurso__grrecodigos != "") && ($gruporecurso__grrenombres != NULL) && ($gruporecurso__grrenombres != "")) {
			$objServ = Application :: loadServices("Data_type");
			//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
			if ($objServ->formatPrimaryKey($gruporecurso__grrecodigos) == false) {
				WebRequest :: setProperty('cod_message', $message = 4);
				return "fail";
			}
			//Hace la validacion de campos numericos y formateo de campos cadena
			$gruporecurso__grredescrips = $objServ->formatString($gruporecurso__grredescrips);
			$gruporecurso_manager = Application :: getDomainController('GruporecursoManager');
			$message = $gruporecurso_manager->updateGruporecurso($gruporecurso__grrecodigos, $gruporecurso__grrenombres, $gruporecurso__grredescrips, $gruporecurso__grreactivas);
			WebRequest :: setProperty('cod_message', $message);
			return "success";
		} else {
			WebRequest :: setProperty('cod_message', $message = 0);
			return "fail";
		}
	}
}
?>	
