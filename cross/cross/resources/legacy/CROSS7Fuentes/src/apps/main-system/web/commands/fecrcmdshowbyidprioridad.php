<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCrCmdShowByIdPrioridad {
    function execute()
    {
        extract($_REQUEST);
        if(($prioridad__priocodigos != NULL) && ($prioridad__priocodigos != "")){
           $prioridad_manager = Application::getDomainController('PrioridadManager'); 
           $prioridad_data = $prioridad_manager->getByIdPrioridad($prioridad__priocodigos); 
           $_REQUEST["prioridad__priocodigos"] = $prioridad_data[0]["priocodigos"];
           $_REQUEST["prioridad__prionombres"] = $prioridad_data[0]["prionombres"];
           $_REQUEST["prioridad__priodescrips"] = $prioridad_data[0]["priodescrips"];
           $_REQUEST["prioridad__prioactivas"] = $prioridad_data[0]["prioactivas"];
        }else{
           $_REQUEST["prioridad__priocodigos"] = WebSession::getProperty("prioridad__priocodigos");
           $_REQUEST["prioridad__prionombres"] = WebSession::getProperty("prioridad__prionombres");
           $_REQUEST["prioridad__priodescrips"] = WebSession::getProperty("prioridad__priodescrips");
           $_REQUEST["prioridad__prioactivas"] = WebSession::getProperty("prioridad__prioactivas");		
        }
        WebSession::unsetProperty("prioridad__priocodigos");
        WebSession::unsetProperty("prioridad__prionombres");
        WebSession::unsetProperty("prioridad__priodescrips");
        WebSession::unsetProperty("prioridad__prioactivas");
        return "success";       
    }
}
?>