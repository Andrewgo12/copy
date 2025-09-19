<?php
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeHrCmdShowListEstadogrupo {

	function execute() {
		settype($objService,"object");
		extract($_REQUEST);
		
		$objService = Application :: loadServices("Data_type");
		if($estadogrupo__esgrnombres){
			$_REQUEST["estadogrupo__esgrnombres"] = $objService->formatString($estadogrupo__esgrnombres);
		}
		if($estadogrupo__esgrdescrips){
			$_REQUEST["estadogrupo__esgrdescrips"] = $objService->formatString($estadogrupo__esgrdescrips);
		}


		if (!WebSession :: issetProperty("estadogrupo__esgrcodigos"))
			WebSession :: setProperty("estadogrupo__esgrcodigos", $estadogrupo__esgrcodigos);

		if (!WebSession :: issetProperty("estadogrupo__esgrnombres"))
			WebSession :: setProperty("estadogrupo__esgrnombres", $estadogrupo__esgrnombres);

		if (!WebSession :: issetProperty("estadogrupo__esgrdescrips"))
			WebSession :: setProperty("estadogrupo__esgrdescrips", $estadogrupo__esgrdescrips);

		if (!WebSession :: issetProperty("estadogrupo__esgractivas"))
			WebSession :: setProperty("estadogrupo__esgractivas", $estadogrupo__esgractivas);

		return "success";
	}

}
?>