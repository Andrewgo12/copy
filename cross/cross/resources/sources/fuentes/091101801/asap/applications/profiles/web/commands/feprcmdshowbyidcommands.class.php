<?php

/**
* @Copyright 2004 FullEngine
*
* Comando de consultar a la tabla $tabla
* @author Ingravity 0.0.8
* @date 14-dic-2004
* @location Cali - Colombia
*/

require_once "Web/WebRequest.class.php";

Class FePrCmdShowByIdCommands {

    function execute()
    {
        extract($_REQUEST);

        if(($commands__commnombres != NULL) && ($commands__commnombres != "") && ($commands__applcodigos != NULL) && ($commands__applcodigos != "")){
           $commands_manager = Application::getDomainController('CommandsManager'); 
           $commands_data = $commands_manager->getByIdCommands($commands__commnombres,$commands__applcodigos); 
           
           $_REQUEST["commands__commnombres"] = $commands_data[0]["commnombres"];
           $_REQUEST["commands__applcodigos"] = $commands_data[0]["applcodigos"];
           $_REQUEST["commands__commobservas"] = $commands_data[0]["commobservas"];

        }else{
		
           $_REQUEST["commands__commnombres"] = WebSession::getProperty("commands__commnombres");
           $_REQUEST["commands__applcodigos"] = WebSession::getProperty("commands__applcodigos");
           $_REQUEST["commands__commobservas"] = WebSession::getProperty("commands__commobservas");		
        }
		
        WebSession::unsetProperty("commands__commnombres");
        WebSession::unsetProperty("commands__applcodigos");
        WebSession::unsetProperty("commands__commobservas");

        return "success";       
    }

}

?>	
