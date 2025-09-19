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
* Comando de eliminar datos a la tabla archivos
* @author Ingravity 0.0.9
* @location Cali - Colombia
*/

Class FeCrCmdDeleteSolucion {

    function execute(){
    	
    	settype($objManager, "object");
    	settype($nuMessage, "integer");
    	
		extract($_REQUEST);
		if(($ordenempresa__ordenumeros != NULL) && ($ordenempresa__ordenumeros != "")){
			
			$objManager = Application::getDomainController('SolucionManager'); 
			$nuMessage = $objManager->deleteSolucion($ordenempresa__ordenumeros);  
			WebRequest::setProperty('cod_message', $nuMessage);
			return "success";         
		}else{
			WebRequest::setProperty('cod_message',$nuMessage = 0); 
			return "fail";
		}
	}

}

?>	
