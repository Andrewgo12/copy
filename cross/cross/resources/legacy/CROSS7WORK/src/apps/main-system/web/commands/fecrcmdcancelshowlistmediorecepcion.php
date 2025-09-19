<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeCrCmdCancelShowListMediorecepcion {

    function execute()
    {
        
        $_REQUEST["mediorecepcion__merecodigos"] = WebSession::getProperty("mediorecepcion__merecodigos");
        $_REQUEST["mediorecepcion__merenombres"] = WebSession::getProperty("mediorecepcion__merenombres");
        $_REQUEST["mediorecepcion__mereescrips"] = WebSession::getProperty("mediorecepcion__mereescrips");
        $_REQUEST["mediorecepcion__mereactivos"] = WebSession::getProperty("mediorecepcion__mereactivos");
	    
        WebSession::unsetProperty("mediorecepcion__merecodigos");
        WebSession::unsetProperty("mediorecepcion__merenombres");
        WebSession::unsetProperty("mediorecepcion__mereescrips");
        WebSession::unsetProperty("mediorecepcion__mereactivos");
		
        return "success";  
    }

}

?>	
