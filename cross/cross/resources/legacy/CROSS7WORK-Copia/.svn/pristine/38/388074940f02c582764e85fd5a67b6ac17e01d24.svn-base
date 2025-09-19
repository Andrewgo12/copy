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
* Comando de limpiar los datos de la pantalla de la tabla estadotarea
* @author Ingravity 0.0.9
* @location Cali - Colombia
*/

Class FeWFCmdClearEstadotarea {

    function execute(){
		extract($_REQUEST);
		$estadotarea_manager = Application::getDomainController("EstadotareaManager"); 
		$estadotarea_manager->UnsetRequest();
        return "success";  
    }

}

?>	
