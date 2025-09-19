<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
  
require_once "Web/WebRequest.class.php";

Class FeCrCmdDeleteCompromiso {

    function execute()
    {
        extract($_REQUEST);
        
        if($compromiso__compcodigos){
           $compromiso_manager = Application::getDomainController('CompromisoManager'); 
           $message = $compromiso_manager->deleteCompromiso($compromiso__compcodigos);  
           WebRequest::setProperty('cod_message', $message);
           return "success";         
        }else{
            WebRequest::setProperty('cod_message',$message = 0); 
            return "fail";
        }
    }

}

?>	
