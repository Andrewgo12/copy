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
* Comando de cancelar la lista de la tabla archivos
* @author Ingravity 0.0.9
* @location Cali - Colombia
*/

Class FeCrCmdCancelShowListSolucion {

    function execute(){
    	
        $_REQUEST["ordenempresa__ordenumeros"] = WebSession::getProperty("ordenempresa__ordenumeros");
        $_REQUEST["solucion__resumen"] = WebSession::getProperty("solucion__resumen");
		
        WebSession::unsetProperty("ordenempresa__ordenumeros");
        WebSession::unsetProperty("solucion__resumen");
		return "success";  
    }

}

?>	
