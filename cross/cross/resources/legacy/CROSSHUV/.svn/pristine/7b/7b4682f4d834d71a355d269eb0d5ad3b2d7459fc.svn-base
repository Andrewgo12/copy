<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeCuCmdDefaultInfractor {

    function execute()
    {
		extract($_REQUEST);
		
		$rcUser = Application::getUserParam();
		
		if($_REQUEST["lang"])
			$rcUser["lang"] = $_REQUEST["lang"];
		else if($_SESSION["_authsession"]["lang"])
			$rcUser["lang"] = $_SESSION["_authsession"]["lang"];
		WebSession :: setProperty("_authsession", $rcUser);
		
		//SI limpia el $_REQUEST
		if($clean_table){
			$cargo_manager = Application::getDomainController("InfractorManager"); 
			$cargo_manager->UnsetRequest();
			unset($_REQUEST["clean_table"]);
		}
        return "success";  
    }

}

?>	
