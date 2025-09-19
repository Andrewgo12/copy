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
* Comando de cancelar la lista de la tabla schema
* @author Ingravity 0.0.9
* @location Cali - Colombia
*/

Class FePrCmdCancelShowListSchema {

    function execute(){
    	
        $_REQUEST["schema__schecodigon"] = WebSession::getProperty("schema__schecodigon");
        $_REQUEST["schema__schenombres"] = WebSession::getProperty("schema__schenombres");
        $_REQUEST["schema__schedbusers"] = WebSession::getProperty("schema__schedbusers");
        $_REQUEST["schema__schedbkeys"] = WebSession::getProperty("schema__schedbkeys");
        $_REQUEST["schema__scheobservas"] = WebSession::getProperty("schema__scheobservas");
		
        WebSession::unsetProperty("schema__schecodigon");
        WebSession::unsetProperty("schema__schenombres");
        WebSession::unsetProperty("schema__schedbusers");
        WebSession::unsetProperty("schema__schedbkeys");
        WebSession::unsetProperty("schema__scheobservas");
		return "success";  
    }

}

?>	
