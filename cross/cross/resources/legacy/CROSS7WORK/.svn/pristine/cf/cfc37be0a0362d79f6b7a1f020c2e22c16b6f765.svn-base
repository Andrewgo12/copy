<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeWFCmdDeleteTarea {
    function execute()
    {
        extract($_REQUEST);
        if(($tarea__tarecodigos != NULL) && ($tarea__tarecodigos != "")){
           $tarea_manager = Application::getDomainController('TareaManager'); 
           $message = $tarea_manager->deleteTarea($tarea__tarecodigos);  
           WebRequest::setProperty('cod_message', $message);
           return "success";         
        }else{
            WebRequest::setProperty('cod_message',$message = 0); 
            return "fail";
        }
    }
}
?>	
