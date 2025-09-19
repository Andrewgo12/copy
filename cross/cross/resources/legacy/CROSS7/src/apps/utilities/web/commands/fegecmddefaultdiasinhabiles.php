<?php
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeGeCmdDefaultDiasInhabiles {
    function execute() {

    	extract($_REQUEST);
        if(!$nday){
            WebSession :: unsetProperty("rcfechas");
			unset($_REQUEST["clean_table"]);
			unset($_REQUEST["nmonth"]);
			unset($_REQUEST["nyear"]);
			unset($_REQUEST["nday"]);
			unset($_REQUEST["flag"]);
			unset($_REQUEST["fecha"]);
        }
            
		//SI limpia el $_REQUEST
		if($clean_table){
			WebSession :: unsetProperty("rcfechas");
			unset($_REQUEST["clean_table"]);
			unset($_REQUEST["nmonth"]);
			unset($_REQUEST["nyear"]);
			unset($_REQUEST["nday"]);
			unset($_REQUEST["flag"]);
			unset($_REQUEST["fecha"]);
		}
    	return "success";
    }
}
?>