<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeCrCmdShowByIdEvento {

    function execute()
    {
        extract($_REQUEST);

        if(($evento__tiorcodigos != NULL) && ($evento__tiorcodigos != "") && ($evento__evencodigos != NULL) && ($evento__evencodigos != "")){
           $evento_manager = Application::getDomainController('EventoManager'); 
           $evento_data = $evento_manager->getByIdEvento($evento__tiorcodigos,$evento__evencodigos); 
           
           $_REQUEST["evento__tiorcodigos"] = $evento_data[0]["tiorcodigos"];
           $_REQUEST["evento__evencodigos"] = $evento_data[0]["evencodigos"];
           $_REQUEST["evento__evennombres"] = $evento_data[0]["evennombres"];
           $_REQUEST["evento__evendescrips"] = $evento_data[0]["evendescrips"];
           $_REQUEST["evento__evenactivos"] = $evento_data[0]["evenactivos"];

        }else{
		
           $_REQUEST["evento__tiorcodigos"] = WebSession::getProperty("evento__tiorcodigos");
           $_REQUEST["evento__evencodigos"] = WebSession::getProperty("evento__evencodigos");
           $_REQUEST["evento__evennombres"] = WebSession::getProperty("evento__evennombres");
           $_REQUEST["evento__evendescrips"] = WebSession::getProperty("evento__evendescrips");
           $_REQUEST["evento__evenactivos"] = WebSession::getProperty("evento__evenactivos");		
        }
		
        WebSession::unsetProperty("evento__tiorcodigos");
        WebSession::unsetProperty("evento__evencodigos");
        WebSession::unsetProperty("evento__evennombres");
        WebSession::unsetProperty("evento__evendescrips");
        WebSession::unsetProperty("evento__evenactivos");

        return "success";       
    }

}

?>	
