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
* Comando de eliminar datos a la tabla contratoprod
* @author Ingravity 0.0.9
* @location Cali - Colombia
*/

Class FeCuCmdDeleteContratoprod {

    function execute(){
		extract($_REQUEST);
		if(($contratoprod__contnics != NULL) && ($contratoprod__contnics != "") && ($contratoprod__prodcodigos != NULL) && ($contratoprod__prodcodigos != "")){
			$contratoprod_manager = Application::getDomainController('ContratoprodManager'); 
			$message = $contratoprod_manager->deleteContratoprod($contratoprod__contnics,$contratoprod__prodcodigos);  
			WebRequest::setProperty('cod_message', $message);
			return "success";         
		}else{
			WebRequest::setProperty('cod_message',$message = 0); 
			return "fail";
		}
	}

}

?>	
