<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeHrCmdShowByIdEstadogrupo {

    function execute()
    {
        extract($_REQUEST);

        if(($estadogrupo__esgrcodigos != NULL) && ($estadogrupo__esgrcodigos != "")){
           $estadogrupo_manager = Application::getDomainController('EstadogrupoManager'); 
           $estadogrupo_data = $estadogrupo_manager->getByIdEstadogrupo($estadogrupo__esgrcodigos); 
           
           $_REQUEST["estadogrupo__esgrcodigos"] = $estadogrupo_data[0]["esgrcodigos"];
           $_REQUEST["estadogrupo__esgrnombres"] = $estadogrupo_data[0]["esgrnombres"];
           $_REQUEST["estadogrupo__esgrdescrips"] = $estadogrupo_data[0]["esgrdescrips"];
           $_REQUEST["estadogrupo__esgractivas"] = $estadogrupo_data[0]["esgractivas"];

        }else{
		
           $_REQUEST["estadogrupo__esgrcodigos"] = WebSession::getProperty("estadogrupo__esgrcodigos");
           $_REQUEST["estadogrupo__esgrnombres"] = WebSession::getProperty("estadogrupo__esgrnombres");
           $_REQUEST["estadogrupo__esgrdescrips"] = WebSession::getProperty("estadogrupo__esgrdescrips");
           $_REQUEST["estadogrupo__esgractivas"] = WebSession::getProperty("estadogrupo__esgractivas");		
        }
		
        WebSession::unsetProperty("estadogrupo__esgrcodigos");
        WebSession::unsetProperty("estadogrupo__esgrnombres");
        WebSession::unsetProperty("estadogrupo__esgrdescrips");
        WebSession::unsetProperty("estadogrupo__esgractivas");

        return "success";       
    }

}

?>	
