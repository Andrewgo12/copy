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
* Comando de consultar los datos de la tabla estadotarea
* @author Ingravity 0.0.9
* @location Cali - Colombia
*/

Class FeWFCmdShowByIdEstadotarea {

    function execute(){
        extract($_REQUEST);

        if(($estadotarea__tarecodigos != NULL) && ($estadotarea__tarecodigos != "") && ($estadotarea__esaccodigos != NULL) && ($estadotarea__esaccodigos != "")){
           $estadotarea_manager = Application::getDomainController('EstadotareaManager'); 
           $estadotarea_data = $estadotarea_manager->getByIdEstadotarea($estadotarea__tarecodigos,$estadotarea__esaccodigos); 
           
           $_REQUEST["estadotarea__tarecodigos"] = $estadotarea_data[0]["tarecodigos"];
           $_REQUEST["estadotarea__esaccodigos"] = $estadotarea_data[0]["esaccodigos"];

        }else{
		
           $_REQUEST["estadotarea__tarecodigos"] = WebSession::getProperty("estadotarea__tarecodigos");
           $_REQUEST["estadotarea__esaccodigos"] = WebSession::getProperty("estadotarea__esaccodigos");		
        }
		
        WebSession::unsetProperty("estadotarea__tarecodigos");
        WebSession::unsetProperty("estadotarea__esaccodigos");

        return "success";       
    }

}

?>	
