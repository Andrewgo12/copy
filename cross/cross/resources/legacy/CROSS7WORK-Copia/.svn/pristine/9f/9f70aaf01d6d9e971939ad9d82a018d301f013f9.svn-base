<?php 
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
Class FeGeCmdShowListTipolocaliza {

	function execute() {
		extract($_REQUEST);
		
		$objService = Application :: loadServices("Data_type");
		if($tipolocaliza__tilonombres)
		$_REQUEST["tipolocaliza__tilonombres"] = $objService->formatString($tipolocaliza__tilonombres);
		if($tipolocaliza__tilodesc)
		$_REQUEST["tipolocaliza__tilodesc"] = $objService->formatString($tipolocaliza__tilodesc);
		if($tipolocaliza__tiloimagens)
		$_REQUEST["tipolocaliza__tiloimagens"] = $objService->formatString($tipolocaliza__tiloimagens);

		if (!WebSession :: issetProperty("tipolocaliza__tilocodigos"))
			WebSession :: setProperty("tipolocaliza__tilocodigos", $tipolocaliza__tilocodigos);

		if (!WebSession :: issetProperty("tipolocaliza__tilonombres"))
			WebSession :: setProperty("tipolocaliza__tilonombres", $tipolocaliza__tilonombres);

		if (!WebSession :: issetProperty("tipolocaliza__tilodesc"))
			WebSession :: setProperty("tipolocaliza__tilodesc", $tipolocaliza__tilodesc);

		if (!WebSession :: issetProperty("tipolocaliza__tilocodpadrs"))
			WebSession :: setProperty("tipolocaliza__tilocodpadrs", $tipolocaliza__tilocodpadrs);

		if (!WebSession :: issetProperty("tipolocaliza__tiloimagens"))
			WebSession :: setProperty("tipolocaliza__tiloimagens", $tipolocaliza__tiloimagens);

		if (!WebSession :: issetProperty("tipolocaliza__tiloestados"))
			WebSession :: setProperty("tipolocaliza__tiloestados", $tipolocaliza__tiloestados);

		return "success";
	}
}
?>