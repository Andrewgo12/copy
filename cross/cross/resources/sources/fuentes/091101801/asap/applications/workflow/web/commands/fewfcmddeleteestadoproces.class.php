<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
  
require_once "Web/WebRequest.class.php";

Class FeWFCmdDeleteEstadoproces {

    function execute()
    {
        extract($_REQUEST);
        
        if(($estadoproces__esprcodigos != NULL) && ($estadoproces__esprcodigos != "")){
           $estadoproces_manager = Application::getDomainController('EstadoprocesManager'); 
           $message = $estadoproces_manager->deleteEstadoproces($estadoproces__esprcodigos);  
           WebRequest::setProperty('cod_message', $message);
           return "success";         
        }else{
            WebRequest::setProperty('cod_message',$message = 0); 
            return "fail";
        }
    }

}

?>	
