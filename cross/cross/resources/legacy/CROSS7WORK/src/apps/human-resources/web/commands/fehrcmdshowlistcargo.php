<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeHrCmdShowListCargo {
	function execute() {
		
		settype($objService,"object");
		extract($_REQUEST);
		
		$objService = Application :: loadServices("Data_type");
		if($cargo__cargnombres){
			$_REQUEST["cargo__cargnombres"] = $objService->formatString($cargo__cargnombres);
		}
		if($cargo__cargdescrips){
			$_REQUEST["cargo__cargdescrips"] = $objService->formatString($cargo__cargdescrips);
		}
		
		if (!WebSession :: issetProperty("cargo__cargcodigos"))
			WebSession :: setProperty("cargo__cargcodigos", $cargo__cargcodigos);
		if (!WebSession :: issetProperty("cargo__cargnombres"))
			WebSession :: setProperty("cargo__cargnombres", $cargo__cargnombres);
		if (!WebSession :: issetProperty("cargo__cargdescrips"))
			WebSession :: setProperty("cargo__cargdescrips", $cargo__cargdescrips);
		if (!WebSession :: issetProperty("cargo__cargactivas"))
			WebSession :: setProperty("cargo__cargactivas", $cargo__cargactivas);
		return "success";
	}
}
?>