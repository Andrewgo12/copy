<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeCrCmdCancelShowListEvento {

    function execute()
    {
        
        $_REQUEST["evento__tiorcodigos"] = WebSession::getProperty("evento__tiorcodigos");
        $_REQUEST["evento__evencodigos"] = WebSession::getProperty("evento__evencodigos");
        $_REQUEST["evento__evennombres"] = WebSession::getProperty("evento__evennombres");
        $_REQUEST["evento__evendescrips"] = WebSession::getProperty("evento__evendescrips");
        $_REQUEST["evento__evenactivos"] = WebSession::getProperty("evento__evenactivos");
	    
        WebSession::unsetProperty("evento__tiorcodigos");
        WebSession::unsetProperty("evento__evencodigos");
        WebSession::unsetProperty("evento__evennombres");
        WebSession::unsetProperty("evento__evendescrips");
        WebSession::unsetProperty("evento__evenactivos");
		
        return "success";  
    }

}

?>	
