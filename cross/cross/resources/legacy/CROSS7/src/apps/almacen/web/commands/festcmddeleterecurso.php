<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdDeleteRecurso {
    function execute()
    {
        extract($_REQUEST);
        if(($recurso__recucodigos != NULL) && ($recurso__recucodigos != "")){
           $recurso_manager = Application::getDomainController('RecursoManager'); 
           $message = $recurso_manager->deleteRecurso($recurso__recucodigos);  
           WebRequest::setProperty('cod_message', $message);
           return "success";         
        }else{
            WebRequest::setProperty('cod_message',$message = 0); 
            return "fail";
        }
    }
}
?>	
