<?php
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeCrCmdShowListEvento {

	function execute() {
		
		settype($objService,"object");
		extract($_REQUEST);
		
		$objService = Application :: loadServices("Data_type");
		if ($evento__evennombres)
			$_REQUEST["evento__evennombres"] = $objService->formatString($evento__evennombres);
		if ($evento__evendescrips)
			$_REQUEST["evento__evendescrips"] = $objService->formatString($evento__evendescrips);
		

		if (!WebSession :: issetProperty("evento__tiorcodigos"))
			WebSession :: setProperty("evento__tiorcodigos", $evento__tiorcodigos);

		if (!WebSession :: issetProperty("evento__evencodigos"))
			WebSession :: setProperty("evento__evencodigos", $evento__evencodigos);

		if (!WebSession :: issetProperty("evento__evennombres"))
			WebSession :: setProperty("evento__evennombres", $evento__evennombres);

		if (!WebSession :: issetProperty("evento__evendescrips"))
			WebSession :: setProperty("evento__evendescrips", $evento__evendescrips);

		if (!WebSession :: issetProperty("evento__evenactivos"))
			WebSession :: setProperty("evento__evenactivos", $evento__evenactivos);

		return "success";
	}

}
?>