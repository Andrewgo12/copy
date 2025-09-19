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
* Comando de cancelar la lista de la tabla contratoprod
* @author Ingravity 0.0.9
* @location Cali - Colombia
*/

Class FeCuCmdCancelShowListContratoprod {

    function execute(){
    	
        $_REQUEST["contratoprod__contnics"] = WebSession::getProperty("contratoprod__contnics");
        $_REQUEST["contratoprod__prodcodigos"] = WebSession::getProperty("contratoprod__prodcodigos");
        $_REQUEST["contratoprod__coprcantidan"] = WebSession::getProperty("contratoprod__coprcantidan");
        $_REQUEST["contratoprod__coprvalunidn"] = WebSession::getProperty("contratoprod__coprvalunidn");
        $_REQUEST["contratoprod__coprlicencis"] = WebSession::getProperty("contratoprod__coprlicencis");
        $_REQUEST["contratoprod__copovigencn"] = WebSession::getProperty("contratoprod__copovigencn");
        $_REQUEST["contratoprod_copodefinis"] = WebSession::getProperty("contratoprod_copodefinis");
        $_REQUEST["contratoprod_copoclausus"] = WebSession::getProperty("contratoprod_copoclausus");
        $_REQUEST["contratoprod_coporestris"] = WebSession::getProperty("contratoprod_coporestris");
		
        WebSession::unsetProperty("contratoprod__contnics");
        WebSession::unsetProperty("contratoprod__prodcodigos");
        WebSession::unsetProperty("contratoprod__coprcantidan");
        WebSession::unsetProperty("contratoprod__coprvalunidn");
        WebSession::unsetProperty("contratoprod__coprlicencis");
        WebSession::unsetProperty("contratoprod__copovigencn");
        WebSession::unsetProperty("contratoprod_copodefinis");
        WebSession::unsetProperty("contratoprod_copoclausus");
        WebSession::unsetProperty("contratoprod_coporestris");
		return "success";  
    }

}

?>	
