<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCrCmdShowListTipoorden {
	function execute() {
		
		settype($objService,"object");
		extract($_REQUEST);
		
		$objService = Application :: loadServices("Data_type");
		if($tipoorden__tiornombres){
			$_REQUEST["tipoorden__tiornombres"] = $objService->formatString($tipoorden__tiornombres);
		}
		if($tipoorden__tiordescrips){
			$_REQUEST["tipoorden__tiordescrips"] = $objService->formatString($tipoorden__tiordescrips);
		}
		
		if (!WebSession :: issetProperty("tipoorden__tiorcodigos"))
			WebSession :: setProperty("tipoorden__tiorcodigos", $tipoorden__tiorcodigos);
		if (!WebSession :: issetProperty("tipoorden__tiornombres"))
			WebSession :: setProperty("tipoorden__tiornombres", $tipoorden__tiornombres);
		if (!WebSession :: issetProperty("tipoorden__tiordescrips"))
			WebSession :: setProperty("tipoorden__tiordescrips", $tipoorden__tiordescrips);
		if (!WebSession :: issetProperty("tipoorden__tioractivos"))
			WebSession :: setProperty("tipoorden__tioractivos", $tipoorden__tioractivos);
		if (!WebSession :: issetProperty("tipoorden__tiorpeson"))
			WebSession :: setProperty("tipoorden__tiorpeson", $tipoorden__tiorpeson);
		return "success";
	}
}
?>