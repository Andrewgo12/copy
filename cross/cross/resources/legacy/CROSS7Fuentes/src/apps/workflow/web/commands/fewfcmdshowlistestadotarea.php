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
* Comando de mostrar el listado de la tabla estadotarea
* @author Ingravity 0.0.9
* @location Cali - Colombia
*/

Class FeWFCmdShowListEstadotarea {

    function execute(){
    	extract($_REQUEST);
		
       if(!WebSession::issetProperty("estadotarea__tarecodigos"))
           WebSession::setProperty("estadotarea__tarecodigos",$estadotarea__tarecodigos);

       if(!WebSession::issetProperty("estadotarea__esaccodigos"))
           WebSession::setProperty("estadotarea__esaccodigos",$estadotarea__esaccodigos);

    	return "success";  
    }

}

?>	
