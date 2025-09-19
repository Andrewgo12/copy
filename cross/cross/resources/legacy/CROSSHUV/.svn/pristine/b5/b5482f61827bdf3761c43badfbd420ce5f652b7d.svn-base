<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdDefaultCencoclientes{
    function execute()
    {
		extract($_REQUEST);
		//SI limpia el $_REQUEST
		if($clean_table){
			$this->UnsetRequest();
			unset($_REQUEST["clean_table"]);
		}
        return "success";  
    }
    function UnsetRequest()
    {
     unset($_REQUEST["cliente__cliecodigos"]);
     unset($_REQUEST["contrato__contnics"]);
     unset($_REQUEST["cliente__clienombres"]);
     unset($_REQUEST["orden__ordenumeros"]);
    }
}
?>