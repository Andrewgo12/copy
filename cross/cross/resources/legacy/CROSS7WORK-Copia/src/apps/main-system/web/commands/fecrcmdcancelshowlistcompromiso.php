<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeCrCmdCancelShowListCompromiso {

    function execute()
    {
        
        $_REQUEST["compromiso__compcodigos"] = WebSession::getProperty("compromiso__compcodigos");
        $_REQUEST["compromiso__compdescris"] = WebSession::getProperty("compromiso__compdescris");
        $_REQUEST["compromiso__compactivos"] = WebSession::getProperty("compromiso__compactivos");
	    
        WebSession::unsetProperty("compromiso__compcodigos");
        WebSession::unsetProperty("compromiso__compdescris");
        WebSession::unsetProperty("compromiso__compactivos");
		
        return "success";  
    }

}

?>	
