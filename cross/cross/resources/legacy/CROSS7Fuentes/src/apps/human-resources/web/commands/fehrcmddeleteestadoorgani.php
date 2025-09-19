<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeHrCmdDeleteEstadoorgani {
    function execute()
    {
        extract($_REQUEST);
        if(($estadoorgani__esorcodigos != NULL) && ($estadoorgani__esorcodigos != "")){
           $estadoorgani_manager = Application::getDomainController('EstadoorganiManager'); 
           $message = $estadoorgani_manager->deleteEstadoorgani($estadoorgani__esorcodigos);  
           WebRequest::setProperty('cod_message', $message);
           return "success";         
        }else{
            WebRequest::setProperty('cod_message',$message = 0); 
            return "fail";
        }
    }
}
?>	
