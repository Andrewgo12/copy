<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeScCmdShowListSchedule {

    function execute()
    {
		extract($_REQUEST);
		//SI limpia el $_REQUEST
		if($clean){
			$cargo_manager = Application::getDomainController("EntradaManager"); 
			$cargo_manager->UnsetRequest();
			unset($_REQUEST["clean"]);
		}
        return "success";  
    }

}

?>	
