<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdShowListCondiusuario {
	function execute() {
		
		settype($objService,"object");
		extract($_REQUEST);
		
		$objService = Application :: loadServices("Data_type");
		if($condiusuario__cousnombres){
			$_REQUEST["condiusuario__cousnombres"] = $objService->formatString($condiusuario__cousnombres);
		}
		if($condiusuario__cousdescrips){
			$_REQUEST["condiusuario__cousdescrips"] = $objService->formatString($condiusuario__cousdescrips);
		}
		
		if (!WebSession :: issetProperty("condiusuario__couscodigos"))
			WebSession :: setProperty("condiusuario__couscodigos", $condiusuario__couscodigos);
		if (!WebSession :: issetProperty("condiusuario__cousnombres"))
			WebSession :: setProperty("condiusuario__cousnombres", $condiusuario__cousnombres);
		if (!WebSession :: issetProperty("condiusuario__cousdescrips"))
			WebSession :: setProperty("condiusuario__cousdescrips", $condiusuario__cousdescrips);
		if (!WebSession :: issetProperty("condiusuario__cousactivos"))
			WebSession :: setProperty("condiusuario__cousactivos", $condiusuario__cousactivos);
		return "success";
	}
}
?>