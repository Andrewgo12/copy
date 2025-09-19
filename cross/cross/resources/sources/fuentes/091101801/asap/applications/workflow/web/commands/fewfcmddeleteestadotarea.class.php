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
* Comando de eliminar datos a la tabla estadotarea
* @author Ingravity 0.0.9
* @location Cali - Colombia
*/

Class FeWFCmdDeleteEstadotarea {

    function execute(){
		extract($_REQUEST);
		if(($estadotarea__tarecodigos != NULL) && ($estadotarea__tarecodigos != "") && ($estadotarea__esaccodigos != NULL) && ($estadotarea__esaccodigos != "")){
			$estadotarea_manager = Application::getDomainController('EstadotareaManager'); 
			$message = $estadotarea_manager->deleteEstadotarea($estadotarea__tarecodigos,$estadotarea__esaccodigos);  
			WebRequest::setProperty('cod_message', $message);
			return "success";         
		}else{
			WebRequest::setProperty('cod_message',$message = 0); 
			return "fail";
		}
	}

}

?>	
