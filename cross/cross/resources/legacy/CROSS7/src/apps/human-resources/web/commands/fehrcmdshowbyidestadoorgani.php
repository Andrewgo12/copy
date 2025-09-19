<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeHrCmdShowByIdEstadoorgani {
    function execute()
    {
        extract($_REQUEST);
        if(($estadoorgani__esorcodigos != NULL) && ($estadoorgani__esorcodigos != "")){
           $estadoorgani_manager = Application::getDomainController('EstadoorganiManager'); 
           $estadoorgani_data = $estadoorgani_manager->getByIdEstadoorgani($estadoorgani__esorcodigos); 
           $_REQUEST["estadoorgani__esorcodigos"] = $estadoorgani_data[0]["esorcodigos"];
           $_REQUEST["estadoorgani__esornombres"] = $estadoorgani_data[0]["esornombres"];
           $_REQUEST["estadoorgani__esordescrips"] = $estadoorgani_data[0]["esordescrips"];
           $_REQUEST["estadoorgani__esoractivas"] = $estadoorgani_data[0]["esoractivas"];
        }else{
           $_REQUEST["estadoorgani__esorcodigos"] = WebSession::getProperty("estadoorgani__esorcodigos");
           $_REQUEST["estadoorgani__esornombres"] = WebSession::getProperty("estadoorgani__esornombres");
           $_REQUEST["estadoorgani__esordescrips"] = WebSession::getProperty("estadoorgani__esordescrips");
           $_REQUEST["estadoorgani__esoractivas"] = WebSession::getProperty("estadoorgani__esoractivas");		
        }
        WebSession::unsetProperty("estadoorgani__esorcodigos");
        WebSession::unsetProperty("estadoorgani__esornombres");
        WebSession::unsetProperty("estadoorgani__esordescrips");
        WebSession::unsetProperty("estadoorgani__esoractivas");
        return "success";       
    }
}
?>	
