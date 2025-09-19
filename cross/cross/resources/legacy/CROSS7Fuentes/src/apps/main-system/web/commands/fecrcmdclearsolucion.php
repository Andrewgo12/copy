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
* Comando de limpiar los datos de la pantalla de la tabla archivos
* @author Ingravity 0.0.9
* @location Cali - Colombia
*/

Class FeCrCmdClearSolucion {

    function execute(){
    	
    	settype($objManager, "object");
    	
		extract($_REQUEST);
		$objManager = Application::getDomainController("SolucionManager");
		$objManager->unsetAttachment(); 
		$objManager->UnsetRequest();
        return "success";  
    }

}

?>	
