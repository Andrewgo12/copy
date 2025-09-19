<?php
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeCrCmdShowListCausa {

	function execute() {
		
		settype($objService,"object");
		extract($_REQUEST);
		
		$objService = Application :: loadServices("Data_type");
		if ($causa__causnombres)
			$_REQUEST["causa__causnombres"] = $objService->formatString($causa__causnombres);
		if ($causa__causdescrips)
			$_REQUEST["causa__causdescrips"] = $objService->formatString($causa__causdescrips);
		

		if (!WebSession :: issetProperty("causa__tiorcodigos"))
			WebSession :: setProperty("causa__tiorcodigos", $causa__tiorcodigos);

		if (!WebSession :: issetProperty("causa__evencodigos"))
			WebSession :: setProperty("causa__evencodigos", $causa__evencodigos);

		if (!WebSession :: issetProperty("causa__causcodigos"))
			WebSession :: setProperty("causa__causcodigos", $causa__causcodigos);

		if (!WebSession :: issetProperty("causa__causnombres"))
			WebSession :: setProperty("causa__causnombres", $causa__causnombres);

		if (!WebSession :: issetProperty("causa__causdescrips"))
			WebSession :: setProperty("causa__causdescrips", $causa__causdescrips);

		if (!WebSession :: issetProperty("causa__causactivas"))
			WebSession :: setProperty("causa__causactivas", $causa__causactivas);

		return "success";
	}

}
?>