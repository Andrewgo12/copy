<?php
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
Class FeGeCmdCancelShowListFormatocarta {

    function execute()
    {
        
        $_REQUEST["formatocarta__focacodigos"] = WebSession::getProperty("formatocarta__focacodigos");
        $_REQUEST["formatocarta__focanombres"] = WebSession::getProperty("formatocarta__focanombres");
        $_REQUEST["formatocarta__focaplantils"] = WebSession::getProperty("formatocarta__focaplantils");
        $_REQUEST["formatocarta__focaestados"] = WebSession::getProperty("formatocarta__focaestados");
	    
        WebSession::unsetProperty("formatocarta__focacodigos");
        WebSession::unsetProperty("formatocarta__focanombres");
        WebSession::unsetProperty("formatocarta__focaplantils");
        WebSession::unsetProperty("formatocarta__focaestados");
		
        return "success";  
    }
}
?>