<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeCrCmdCancelShowListActividad {

    function execute()
    {
        
        $_REQUEST["actividad__acticodigos"] = WebSession::getProperty("actividad__acticodigos");
        $_REQUEST["actividad__actinombres"] = WebSession::getProperty("actividad__actinombres");
        $_REQUEST["actividad__activalorn"] = WebSession::getProperty("actividad__activalorn");
        $_REQUEST["actividad__actiobservas"] = WebSession::getProperty("actividad__actiobservas");
        $_REQUEST["actividad__actiactivas"] = WebSession::getProperty("actividad__actiactivas");
	    
        WebSession::unsetProperty("actividad__acticodigos");
        WebSession::unsetProperty("actividad__actinombres");
        WebSession::unsetProperty("actividad__activalorn");
        WebSession::unsetProperty("actividad__actiobservas");
        WebSession::unsetProperty("actividad__actiactivas");
		
        return "success";  
    }

}

?>	
