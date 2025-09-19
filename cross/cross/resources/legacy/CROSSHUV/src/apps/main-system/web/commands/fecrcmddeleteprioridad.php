<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCrCmdDeletePrioridad {
    function execute()
    {
        extract($_REQUEST);
        if(($prioridad__priocodigos != NULL) && ($prioridad__priocodigos != "")){
           $prioridad_manager = Application::getDomainController('PrioridadManager'); 
           $message = $prioridad_manager->deletePrioridad($prioridad__priocodigos);  
           WebRequest::setProperty('cod_message', $message);
           return "success";         
        }else{
            WebRequest::setProperty('cod_message',$message = 0); 
            return "fail";
        }
    }
}
?>	
