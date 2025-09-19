<?php
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeCrCmdShowListMediorecepcion {

	function execute() {
		
		settype($objService,"object");
		extract($_REQUEST);
		
		$objService = Application :: loadServices("Data_type");
		if ($mediorecepcion__merenombres)
			$_REQUEST["mediorecepcion__merenombres"] = $objService->formatString($mediorecepcion__merenombres);
		if ($mediorecepcion__mereescrips)
			$_REQUEST["mediorecepcion__mereescrips"] = $objService->formatString($mediorecepcion__mereescrips);
		

		if (!WebSession :: issetProperty("mediorecepcion__merecodigos"))
			WebSession :: setProperty("mediorecepcion__merecodigos", $mediorecepcion__merecodigos);

		if (!WebSession :: issetProperty("mediorecepcion__merenombres"))
			WebSession :: setProperty("mediorecepcion__merenombres", $mediorecepcion__merenombres);

		if (!WebSession :: issetProperty("mediorecepcion__mereescrips"))
			WebSession :: setProperty("mediorecepcion__mereescrips", $mediorecepcion__mereescrips);

		if (!WebSession :: issetProperty("mediorecepcion__mereactivos"))
			WebSession :: setProperty("mediorecepcion__mereactivos", $mediorecepcion__mereactivos);

		return "success";
	}

}
?>