<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
  
require_once "Web/WebRequest.class.php";

Class FeCrCmdDeleteEvento {

    function execute()
    {
        extract($_REQUEST);
        
        if(($evento__tiorcodigos != NULL) && ($evento__tiorcodigos != "") && ($evento__evencodigos != NULL) && ($evento__evencodigos != "")){
           $evento_manager = Application::getDomainController('EventoManager'); 
           $message = $evento_manager->deleteEvento($evento__tiorcodigos,$evento__evencodigos);  
           WebRequest::setProperty('cod_message', $message);
           return "success";         
        }else{
            WebRequest::setProperty('cod_message',$message = 0); 
            return "fail";
        }
    }

}

?>	
