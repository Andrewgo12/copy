<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeCrCmdShowByIdActividad {

    function execute()
    {
        extract($_REQUEST);

        if(($actividad__acticodigos != NULL) && ($actividad__acticodigos != "")){
           $actividad_manager = Application::getDomainController('ActividadManager'); 
           $actividad_data = $actividad_manager->getByIdActividad($actividad__acticodigos); 
           
           $_REQUEST["actividad__acticodigos"] = $actividad_data[0]["acticodigos"];
           $_REQUEST["actividad__actinombres"] = $actividad_data[0]["actinombres"];
           $_REQUEST["actividad__activalorn"] = $actividad_data[0]["activalorn"];
           $_REQUEST["actividad__actiobservas"] = $actividad_data[0]["actiobservas"];
           $_REQUEST["actividad__actiactivas"] = $actividad_data[0]["actiactivas"];

        }else{
		
           $_REQUEST["actividad__acticodigos"] = WebSession::getProperty("actividad__acticodigos");
           $_REQUEST["actividad__actinombres"] = WebSession::getProperty("actividad__actinombres");
           $_REQUEST["actividad__activalorn"] = WebSession::getProperty("actividad__activalorn");
           $_REQUEST["actividad__actiobservas"] = WebSession::getProperty("actividad__actiobservas");
           $_REQUEST["actividad__actiactivas"] = WebSession::getProperty("actividad__actiactivas");		
        }
		
        WebSession::unsetProperty("actividad__acticodigos");
        WebSession::unsetProperty("actividad__actinombres");
        WebSession::unsetProperty("actividad__activalorn");
        WebSession::unsetProperty("actividad__actiobservas");
        WebSession::unsetProperty("actividad__actiactivas");

        return "success";       
    }

}

?>	
