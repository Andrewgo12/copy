<?php
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
Class FeGeCmdGetFormatocarta {

	function execute() {
		
		extract($_REQUEST);
		
		settype($objManager,"object");
		settype($rcTmp,"array");
		settype($sbOutput,"string");
		

		if (($formatocarta__focacodigos != NULL) && ($formatocarta__focacodigos != "")) {

			$objManager = Application :: getDomainController('FormatocartaManager');
			$rcTmp = $objManager->getByIdFormatocarta($formatocarta__focacodigos);
			
			if($rcTmp){
				$sbOutput = $rcTmp[0]["focaplantils"];
			}
			
		}
		die($sbOutput);
	}
}
?>