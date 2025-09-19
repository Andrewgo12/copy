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
* Comando de mostrar el listado de la tabla contratoprod
* @author Ingravity 0.0.9
* @location Cali - Colombia
*/

Class FeCuCmdShowListContratoprod {

    function execute(){
    	extract($_REQUEST);
		
       if(!WebSession::issetProperty("contratoprod__contnics"))
           WebSession::setProperty("contratoprod__contnics",$contratoprod__contnics);

       if(!WebSession::issetProperty("contratoprod__prodcodigos"))
           WebSession::setProperty("contratoprod__prodcodigos",$contratoprod__prodcodigos);

       if(!WebSession::issetProperty("contratoprod__coprcantidan"))
           WebSession::setProperty("contratoprod__coprcantidan",$contratoprod__coprcantidan);

       if(!WebSession::issetProperty("contratoprod__coprvalunidn"))
           WebSession::setProperty("contratoprod__coprvalunidn",$contratoprod__coprvalunidn);

       if(!WebSession::issetProperty("contratoprod__coprlicencis"))
           WebSession::setProperty("contratoprod__coprlicencis",$contratoprod__coprlicencis);

       if(!WebSession::issetProperty("contratoprod__copovigencn"))
           WebSession::setProperty("contratoprod__copovigencn",$contratoprod__copovigencn);

       if(!WebSession::issetProperty("contratoprod_copodefinis"))
           WebSession::setProperty("contratoprod_copodefinis",$contratoprod_copodefinis);

       if(!WebSession::issetProperty("contratoprod_copoclausus"))
           WebSession::setProperty("contratoprod_copoclausus",$contratoprod_copoclausus);

       if(!WebSession::issetProperty("contratoprod_coporestris"))
           WebSession::setProperty("contratoprod_coporestris",$contratoprod_coporestris);

    	return "success";  
    }

}

?>	
