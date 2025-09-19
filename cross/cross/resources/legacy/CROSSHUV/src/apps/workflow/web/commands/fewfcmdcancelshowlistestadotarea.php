<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";
/**
* @Copyright 2005 Parquesoft
*
* Comando de cancelar la lista de la tabla estadotarea
* @author Ingravity 0.0.9
* @location Cali - Colombia
*/

Class FeWFCmdCancelShowListEstadotarea {

    function execute(){
    	
        $_REQUEST["estadotarea__tarecodigos"] = WebSession::getProperty("estadotarea__tarecodigos");
        $_REQUEST["estadotarea__esaccodigos"] = WebSession::getProperty("estadotarea__esaccodigos");
		
        WebSession::unsetProperty("estadotarea__tarecodigos");
        WebSession::unsetProperty("estadotarea__esaccodigos");
		return "success";  
    }

}

?>	
