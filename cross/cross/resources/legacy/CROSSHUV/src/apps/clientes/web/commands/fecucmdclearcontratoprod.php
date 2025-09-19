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
* Comando de limpiar los datos de la pantalla de la tabla contratoprod
* @author Ingravity 0.0.9
* @location Cali - Colombia
*/

Class FeCuCmdClearContratoprod {

    function execute(){
		extract($_REQUEST);
		$contratoprod_manager = Application::getDomainController("ContratoprodManager"); 
		$contratoprod_manager->UnsetRequest();
        return "success";  
    }

}

?>	
