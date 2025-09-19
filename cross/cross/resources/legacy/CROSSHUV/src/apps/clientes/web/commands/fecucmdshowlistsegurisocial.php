<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdShowListSegurisocial {
	function execute() {
		
		settype($objService,"object");
		extract($_REQUEST);
		
		$objService = Application :: loadServices("Data_type");
		if($segurisocial__sesonombres){
			$_REQUEST["segurisocial__sesonombres"] = $objService->formatString($segurisocial__sesonombres);
		}
		if($segurisocial__sesodescrips){
			$_REQUEST["segurisocial__sesodescrips"] = $objService->formatString($segurisocial__sesodescrips);
		}
		
		if (!WebSession :: issetProperty("segurisocial__sesocodigos"))
			WebSession :: setProperty("segurisocial__sesocodigos", $segurisocial__sesocodigos);
		if (!WebSession :: issetProperty("segurisocial__sesonombres"))
			WebSession :: setProperty("segurisocial__sesonombres", $segurisocial__sesonombres);
		if (!WebSession :: issetProperty("segurisocial__sesodescrips"))
			WebSession :: setProperty("segurisocial__sesodescrips", $segurisocial__sesodescrips);
		if (!WebSession :: issetProperty("segurisocial__sesoactivos"))
			WebSession :: setProperty("segurisocial__sesoactivos", $segurisocial__sesoactivos);
		return "success";
	}
}
?>