<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeWFCmdShowByIdActivitarea {
    function execute()
    {
        extract($_REQUEST);
        if(($activitarea__tarecodigos != NULL) && ($activitarea__tarecodigos != "") && ($activitarea__acticodigos != NULL) && ($activitarea__acticodigos != "")){
           $activitarea_manager = Application::getDomainController('ActivitareaManager'); 
           $activitarea_data = $activitarea_manager->getByIdActivitarea($activitarea__tarecodigos,$activitarea__acticodigos); 
           $_REQUEST["activitarea__tarecodigos"] = $activitarea_data[0]["tarecodigos"];
           $_REQUEST["activitarea__acticodigos"] = $activitarea_data[0]["acticodigos"];
           $_REQUEST["activitarea__actavalorn"] = $activitarea_data[0]["actavalorn"];
           $_REQUEST["activitarea__actaobligats"] = $activitarea_data[0]["actaobligats"];
           $_REQUEST["activitarea__actaordenn"] = $activitarea_data[0]["actaordenn"];
           $_REQUEST["activitarea__actaporcetan"] = $activitarea_data[0]["actaporcetan"];
           $_REQUEST["activitarea__actaactivas"] = $activitarea_data[0]["actaactivas"];
        }else{
           $_REQUEST["activitarea__tarecodigos"] = WebSession::getProperty("activitarea__tarecodigos");
           $_REQUEST["activitarea__acticodigos"] = WebSession::getProperty("activitarea__acticodigos");
           $_REQUEST["activitarea__actavalorn"] = WebSession::getProperty("activitarea__actavalorn");
           $_REQUEST["activitarea__actaobligats"] = WebSession::getProperty("activitarea__actaobligats");
           $_REQUEST["activitarea__actaordenn"] = WebSession::getProperty("activitarea__actaordenn");
           $_REQUEST["activitarea__actaporcetan"] = WebSession::getProperty("activitarea__actaporcetan");
           $_REQUEST["activitarea__actaactivas"] = WebSession::getProperty("activitarea__actaactivas");		
        }
        WebSession::unsetProperty("activitarea__tarecodigos");
        WebSession::unsetProperty("activitarea__acticodigos");
        WebSession::unsetProperty("activitarea__actavalorn");
        WebSession::unsetProperty("activitarea__actaobligats");
        WebSession::unsetProperty("activitarea__actaordenn");
        WebSession::unsetProperty("activitarea__actaporcetan");
        WebSession::unsetProperty("activitarea__actaactivas");
        return "success";       
    }
}
?>	
