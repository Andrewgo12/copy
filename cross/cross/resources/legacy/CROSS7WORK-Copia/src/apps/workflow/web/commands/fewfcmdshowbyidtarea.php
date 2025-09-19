<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeWFCmdShowByIdTarea {
    function execute()
    {
        extract($_REQUEST);
        if(($tarea__tarecodigos != NULL) && ($tarea__tarecodigos != "")){
           $tarea_manager = Application::getDomainController('TareaManager'); 
           $tarea_data = $tarea_manager->getByIdTarea($tarea__tarecodigos); 
           $_REQUEST["tarea__tarecodigos"] = $tarea_data[0]["tarecodigos"];
           $_REQUEST["tarea__tarenombres"] = $tarea_data[0]["tarenombres"];
           $_REQUEST["tarea__orgacodigos"] = $tarea_data[0]["orgacodigos"];
           $_REQUEST["tarea__taredescris"] = $tarea_data[0]["taredescris"];
           $_REQUEST["tarea__tareactivas"] = $tarea_data[0]["tareactivas"];
        }else{
           $_REQUEST["tarea__tarecodigos"] = WebSession::getProperty("tarea__tarecodigos");
           $_REQUEST["tarea__tarenombres"] = WebSession::getProperty("tarea__tarenombres");
           $_REQUEST["tarea__orgacodigos"] = WebSession::getProperty("tarea__orgacodigos");
           $_REQUEST["tarea__taredescris"] = WebSession::getProperty("tarea__taredescris");
           $_REQUEST["tarea__tareactivas"] = WebSession::getProperty("tarea__tareactivas");		
        }
        WebSession::unsetProperty("tarea__tarecodigos");
        WebSession::unsetProperty("tarea__tarenombres");
        WebSession::unsetProperty("tarea__orgacodigos");
        WebSession::unsetProperty("tarea__taredescris");
        WebSession::unsetProperty("tarea__tareactivas");
        return "success";       
    }
}
?>	
