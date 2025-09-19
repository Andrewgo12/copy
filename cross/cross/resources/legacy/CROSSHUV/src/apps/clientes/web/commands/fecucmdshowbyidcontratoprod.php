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
* Comando de consultar los datos de la tabla contratoprod
* @author Ingravity 0.0.9
* @location Cali - Colombia
*/

Class FeCuCmdShowByIdContratoprod {

    function execute(){
        extract($_REQUEST);

        if(($contratoprod__contnics != NULL) && ($contratoprod__contnics != "") && ($contratoprod__prodcodigos != NULL) && ($contratoprod__prodcodigos != "")){
           $contratoprod_manager = Application::getDomainController('ContratoprodManager'); 
           $contratoprod_data = $contratoprod_manager->getByIdContratoprod($contratoprod__contnics,$contratoprod__prodcodigos); 
           
           $_REQUEST["contratoprod__contnics"] = $contratoprod_data[0]["contnics"];
           $_REQUEST["contratoprod__prodcodigos"] = $contratoprod_data[0]["prodcodigos"];
           $_REQUEST["contratoprod__coprcantidan"] = $contratoprod_data[0]["coprcantidan"];
           $_REQUEST["contratoprod__coprvalunidn"] = $contratoprod_data[0]["coprvalunidn"];
           $_REQUEST["contratoprod__coprserials"] = $contratoprod_data[0]["coprserials"];
           $_REQUEST["contratoprod__copovigencn"] = $contratoprod_data[0]["copovigencn"];
           $_REQUEST["contratoprod_copodefinis"] = $contratoprod_data[0]["copodefinis"];
           $_REQUEST["contratoprod_copoclausus"] = $contratoprod_data[0]["copoclausus"];
           $_REQUEST["contratoprod_coporestris"] = $contratoprod_data[0]["coporestris"];

        }else{
		
           $_REQUEST["contratoprod__contnics"] = WebSession::getProperty("contratoprod__contnics");
           $_REQUEST["contratoprod__prodcodigos"] = WebSession::getProperty("contratoprod__prodcodigos");
           $_REQUEST["contratoprod__coprcantidan"] = WebSession::getProperty("contratoprod__coprcantidan");
           $_REQUEST["contratoprod__coprvalunidn"] = WebSession::getProperty("contratoprod__coprvalunidn");
           $_REQUEST["contratoprod__coprserials"] = WebSession::getProperty("contratoprod__coprserials");
           $_REQUEST["contratoprod__copovigencn"] = WebSession::getProperty("contratoprod__copovigencn");
           $_REQUEST["contratoprod_copodefinis"] = WebSession::getProperty("contratoprod_copodefinis");
           $_REQUEST["contratoprod_copoclausus"] = WebSession::getProperty("contratoprod_copoclausus");
           $_REQUEST["contratoprod_coporestris"] = WebSession::getProperty("contratoprod_coporestris");		
        }
		
        WebSession::unsetProperty("contratoprod__contnics");
        WebSession::unsetProperty("contratoprod__prodcodigos");
        WebSession::unsetProperty("contratoprod__coprcantidan");
        WebSession::unsetProperty("contratoprod__coprvalunidn");
        WebSession::unsetProperty("contratoprod__coprserials");
        WebSession::unsetProperty("contratoprod__copovigencn");
        WebSession::unsetProperty("contratoprod__copodefinis");
        WebSession::unsetProperty("contratoprod__copoclausus");
        WebSession::unsetProperty("contratoprod__coporestris");

        return "success";       
    }

}

?>	
