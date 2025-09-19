<?php 
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdShowByIdRecurso {
	function execute() {
		extract($_REQUEST);
		if (($recurso__recucodigos != NULL) && ($recurso__recucodigos != "")) {
			$recurso_manager = Application :: getDomainController('RecursoManager');
			$recurso_data = $recurso_manager->getByIdRecurso($recurso__recucodigos);
			$_REQUEST["recurso__recucodigos"] = $recurso_data[0]["recucodigos"];
			$_REQUEST["recurso__recunombres"] = $recurso_data[0]["recunombres"];
			$_REQUEST["recurso__grrecodigos"] = $recurso_data[0]["grrecodigos"];
			$_REQUEST["recurso__tirecodigos"] = $recurso_data[0]["tirecodigos"];
			$_REQUEST["recurso__unmecodigos"] = $recurso_data[0]["unmecodigos"];
			$_REQUEST["recurso__recudescrips"] = $recurso_data[0]["recudescrips"];
			$_REQUEST["recurso__recuactivas"] = $recurso_data[0]["recuactivas"];
		} else {
			$_REQUEST["recurso__recucodigos"] = WebSession :: getProperty("recurso__recucodigos");
			$_REQUEST["recurso__recunombres"] = WebSession :: getProperty("recurso__recunombres");
			$_REQUEST["recurso__grrecodigos"] = WebSession :: getProperty("recurso__grrecodigos");
			$_REQUEST["recurso__tirecodigos"] = WebSession :: getProperty("recurso__tirecodigos");
			$_REQUEST["recurso__unmecodigos"] = WebSession :: getProperty("recurso__unmecodigos");
			$_REQUEST["recurso__recudescrips"] = WebSession :: getProperty("recurso__recudescrips");
			$_REQUEST["recurso__recuactivas"] = WebSession :: getProperty("recurso__recuactivas");
		}
		WebSession :: unsetProperty("recurso__recucodigos");
		WebSession :: unsetProperty("recurso__recunombres");
		WebSession :: unsetProperty("recurso__grrecodigos");
		WebSession :: unsetProperty("recurso__tirecodigos");
		WebSession :: unsetProperty("recurso__unmecodigos");
		WebSession :: unsetProperty("recurso__recudescrips");
		WebSession :: unsetProperty("recurso__recuactivas");
		return "success";
	}
}
?>	
