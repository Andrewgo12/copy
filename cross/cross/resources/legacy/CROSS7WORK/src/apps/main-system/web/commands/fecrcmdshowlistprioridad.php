<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCrCmdShowListPrioridad {
	function execute() {
		settype($objService, "object");
		extract($_REQUEST);

		$objService = Application :: loadServices("Data_type");
		if ($prioridad__prionombres)
			$_REQUEST["prioridad__prionombres"] = $objService->formatString($prioridad__prionombres);
		if ($prioridad__priodescrips)
			$_REQUEST["prioridad__priodescrips"] = $objService->formatString($prioridad__priodescrips);

		if (!WebSession :: issetProperty("prioridad__priocodigos"))
			WebSession :: setProperty("prioridad__priocodigos", $prioridad__priocodigos);
		if (!WebSession :: issetProperty("prioridad__prionombres"))
			WebSession :: setProperty("prioridad__prionombres", $prioridad__prionombres);
		if (!WebSession :: issetProperty("prioridad__priodescrips"))
			WebSession :: setProperty("prioridad__priodescrips", $prioridad__priodescrips);
		if (!WebSession :: issetProperty("prioridad__prioactivas"))
			WebSession :: setProperty("prioridad__prioactivas", $prioridad__prioactivas);
		return "success";
	}
}
?>