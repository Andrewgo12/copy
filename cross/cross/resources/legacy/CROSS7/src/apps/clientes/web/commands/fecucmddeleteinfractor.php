<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
  
require_once "Web/WebRequest.class.php";

Class FeCuCmdDeleteInfractor {

    function execute()
    {
        extract($_REQUEST);
        
        if(($infractor__infrcodigos != NULL) && ($infractor__infrcodigos != "")){
           $infractor_manager = Application::getDomainController('InfractorManager'); 
           $message = $infractor_manager->deleteInfractor($infractor__infrcodigos);  
           WebRequest::setProperty('cod_message', $message);
           return "success";         
        }else{
            WebRequest::setProperty('cod_message',$message = 0); 
            return "fail";
        }
    }

}

?>	
