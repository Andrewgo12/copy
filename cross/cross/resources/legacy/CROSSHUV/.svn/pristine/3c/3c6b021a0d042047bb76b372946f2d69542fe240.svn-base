<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdShowListTipoexamen {
	function execute() {
		
		settype($objService,"object");
		extract($_REQUEST);
		
		$objService = Application :: loadServices("Data_type");
		if($tipoexamen__tiexnombres){
			$_REQUEST["tipoexamen__tiexnombres"] = $objService->formatString($tipoexamen__tiexnombres);
		}
		if($tipoexamen__tiexdescrips){
			$_REQUEST["tipoexamen__tiexdescrips"] = $objService->formatString($tipoexamen__tiexdescrips);
		}
		
		if (!WebSession :: issetProperty("tipoexamen__tiexcodigos"))
			WebSession :: setProperty("tipoexamen__tiexcodigos", $tipoexamen__tiexcodigos);
		if (!WebSession :: issetProperty("tipoexamen__tiexnombres"))
			WebSession :: setProperty("tipoexamen__tiexnombres", $tipoexamen__tiexnombres);
		if (!WebSession :: issetProperty("tipoexamen__tiexdescrips"))
			WebSession :: setProperty("tipoexamen__tiexdescrips", $tipoexamen__tiexdescrips);
		if (!WebSession :: issetProperty("tipoexamen__tiexactivos"))
			WebSession :: setProperty("tipoexamen__tiexactivos", $tipoexamen__tiexactivos);
		return "success";
	}
}
?>