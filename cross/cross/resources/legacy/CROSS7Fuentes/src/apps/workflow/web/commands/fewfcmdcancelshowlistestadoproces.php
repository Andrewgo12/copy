<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeWFCmdCancelShowListEstadoproces {

    function execute()
    {
        
        $_REQUEST["estadoproces__esprcodigos"] = WebSession::getProperty("estadoproces__esprcodigos");
        $_REQUEST["estadoproces__esprnombres"] = WebSession::getProperty("estadoproces__esprnombres");
        $_REQUEST["estadoproces__esprdescrips"] = WebSession::getProperty("estadoproces__esprdescrips");
        $_REQUEST["estadoproces__espractivas"] = WebSession::getProperty("estadoproces__espractivas");
	    
        WebSession::unsetProperty("estadoproces__esprcodigos");
        WebSession::unsetProperty("estadoproces__esprnombres");
        WebSession::unsetProperty("estadoproces__esprdescrips");
        WebSession::unsetProperty("estadoproces__espractivas");
		
        return "success";  
    }

}

?>	
