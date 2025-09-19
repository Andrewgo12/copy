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
* Comando de limpiar los datos de la pantalla de la tabla schema
* @author Ingravity 0.0.9
* @location Cali - Colombia
*/

Class FePrCmdClearSchema {

    function execute(){
		extract($_REQUEST);
		$schema_manager = Application::getDomainController("SchemaManager"); 
		$schema_manager->UnsetRequest();
        return "success";  
    }

}

?>	
