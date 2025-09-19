<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeHrCmdShowListTipoorgani {
	function execute() {
		settype($objService,"object");
		extract($_REQUEST);
		
		$objService = Application :: loadServices("Data_type");
		if($tipoorgani__tiornombres){
			$_REQUEST["tipoorgani__tiornombres"] = $objService->formatString($tipoorgani__tiornombres);
		}
		if($tipoorgani__tiordesc){
			$_REQUEST["tipoorgani__tiordesc"] = $objService->formatString($tipoorgani__tiordesc);
		}
		
		if (!WebSession :: issetProperty("tipoorgani__tiorcodigos"))
			WebSession :: setProperty("tipoorgani__tiorcodigos", $tipoorgani__tiorcodigos);
		if (!WebSession :: issetProperty("tipoorgani__tiornombres"))
			WebSession :: setProperty("tipoorgani__tiornombres", $tipoorgani__tiornombres);
		if (!WebSession :: issetProperty("tipoorgani__tiordesc"))
			WebSession :: setProperty("tipoorgani__tiordesc", $tipoorgani__tiordesc);
		if (!WebSession :: issetProperty("tipoorgani__tiorcodpadrs"))
			WebSession :: setProperty("tipoorgani__tiorcodpadrs", $tipoorgani__tiorcodpadrs);
		if (!WebSession :: issetProperty("tipoorgani__tioractivos"))
			WebSession :: setProperty("tipoorgani__tioractivos", $tipoorgani__tioractivos);
		return "success";
	}
}
?>