<?php 
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeCrCmdDefaultRepConsolidado {

	function execute() {
		extract($_REQUEST);
		settype($objService,"object");
		settype($nuMessage,"integer");
		
		$objService = Application :: loadServices("DateController");
		$ordefecingdini = $objService->fncdatetoint($ordefecingdini); 
		$ordefecingdfin = $objService->fncdatetoint($ordefecingdfin);
		
		if($ordefecingdini > $ordefecingdfin){
			WebRequest :: setProperty('cod_message', $nuMessage = 31);
			return "fail";
		}
		return "success";
	}
}
?>