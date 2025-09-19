<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
  
require_once "Web/WebRequest.class.php";

Class FeWFCmdDeleteProceso {

    function execute()
    {
        extract($_REQUEST);
        
        if(($proceso__proccodigos != NULL) && ($proceso__proccodigos != "")){
           $proceso_manager = Application::getDomainController('ProcesoManager'); 
           $message = $proceso_manager->deleteProceso($proceso__proccodigos);  
           WebRequest::setProperty('cod_message', $message);
           return "success";         
        }else{
            WebRequest::setProperty('cod_message',$message = 0); 
            return "fail";
        }
    }

}

?>	
