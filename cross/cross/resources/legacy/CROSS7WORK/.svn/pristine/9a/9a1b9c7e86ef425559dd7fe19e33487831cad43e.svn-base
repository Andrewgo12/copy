<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeCrCmdCancelShowListCausa {

    function execute()
    {
        
        $_REQUEST["causa__tiorcodigos"] = WebSession::getProperty("causa__tiorcodigos");
        $_REQUEST["causa__evencodigos"] = WebSession::getProperty("causa__evencodigos");
        $_REQUEST["causa__causcodigos"] = WebSession::getProperty("causa__causcodigos");
        $_REQUEST["causa__causnombres"] = WebSession::getProperty("causa__causnombres");
        $_REQUEST["causa__causdescrips"] = WebSession::getProperty("causa__causdescrips");
        $_REQUEST["causa__causactivas"] = WebSession::getProperty("causa__causactivas");
	    
        WebSession::unsetProperty("causa__tiorcodigos");
        WebSession::unsetProperty("causa__evencodigos");
        WebSession::unsetProperty("causa__causcodigos");
        WebSession::unsetProperty("causa__causnombres");
        WebSession::unsetProperty("causa__causdescrips");
        WebSession::unsetProperty("causa__causactivas");
		
        return "success";  
    }

}

?>	
