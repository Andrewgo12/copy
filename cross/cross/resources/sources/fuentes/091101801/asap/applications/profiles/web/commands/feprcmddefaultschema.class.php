<?php
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
Class FePrCmdDefaultSchema {

    function execute() {
    	
    	settype($objManager,"object");
    	
		extract($_REQUEST);
		//Si limpia el $_REQUEST
		if ($clean_table) {
			$objManager = Application :: getDomainController("SchemaManager");
			$objManager->UnsetRequest();
			unset ($_REQUEST["clean_table"]);
		}
		return "success";
	}
}
?>