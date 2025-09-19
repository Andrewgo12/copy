<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdDefaultCliente {
    function execute()
    {
		extract($_REQUEST);
		
		$rcUser = Application::getUserParam();
		
		if($_REQUEST["lang"])
			$rcUser["lang"] = $_REQUEST["lang"];
		else if($_SESSION["_authsession"]["lang"])
			$rcUser["lang"] = $_SESSION["_authsession"]["lang"];
		WebSession :: setProperty("_authsession", $rcUser);
		
		if(array_key_exists("web",$_SESSION))
			$_REQUEST["web"] = $_SESSION["web"];
		
		//SI limpia el $_REQUEST
		if($clean_table){
			$cargo_manager = Application::getDomainController("ClienteManager"); 
			$cargo_manager->UnsetRequest();
			unset($_REQUEST["clean_table"]);
		}
        return "success";  
    }
}
?>	
