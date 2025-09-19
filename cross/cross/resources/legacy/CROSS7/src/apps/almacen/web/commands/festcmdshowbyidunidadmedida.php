<?php 
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdShowByIdUnidadmedida {
	function execute() {
		extract($_REQUEST);
		if (($unidadmedida__unmecodigos != NULL) && ($unidadmedida__unmecodigos != "")) {
			$unidadmedida_manager = Application :: getDomainController('UnidadmedidaManager');
			$unidadmedida_data = $unidadmedida_manager->getByIdUnidadmedida($unidadmedida__unmecodigos);
			$_REQUEST["unidadmedida__unmecodigos"] = $unidadmedida_data[0]["unmecodigos"];
			$_REQUEST["unidadmedida__unmenombres"] = $unidadmedida_data[0]["unmenombres"];
			$_REQUEST["unidadmedida__unmesiglas"] = $unidadmedida_data[0]["unmesiglas"];
			$_REQUEST["unidadmedida__unmedescrips"] = $unidadmedida_data[0]["unmedescrips"];
			$_REQUEST["unidadmedida__unmeactivas"] = $unidadmedida_data[0]["unmeactivas"];
		} else {
			$_REQUEST["unidadmedida__unmecodigos"] = WebSession :: getProperty("unidadmedida__unmecodigos");
			$_REQUEST["unidadmedida__unmenombres"] = WebSession :: getProperty("unidadmedida__unmenombres");
			$_REQUEST["unidadmedida__unmesiglas"] = WebSession :: getProperty("unidadmedida__unmesiglas");
			$_REQUEST["unidadmedida__unmedescrips"] = WebSession :: getProperty("unidadmedida__unmedescrips");
			$_REQUEST["unidadmedida__unmeactivas"] = WebSession :: getProperty("unidadmedida__unmeactivas");
		}
		WebSession :: unsetProperty("unidadmedida__unmecodigos");
		WebSession :: unsetProperty("unidadmedida__unmenombres");
		WebSession :: unsetProperty("unidadmedida__unmesiglas");
		WebSession :: unsetProperty("unidadmedida__unmedescrips");
		WebSession :: unsetProperty("unidadmedida__unmeactivas");
		return "success";
	}
}
?>	
