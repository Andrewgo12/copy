<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdDeleteEstadoclient {
    function execute()
    {
        extract($_REQUEST);
        if(($estadoclient__esclcodigos != NULL) && ($estadoclient__esclcodigos != "")){
           $estadoclient_manager = Application::getDomainController('EstadoclientManager'); 
           $message = $estadoclient_manager->deleteEstadoclient($estadoclient__esclcodigos);  
           WebRequest::setProperty('cod_message', $message);
           return "success";         
        }else{
            WebRequest::setProperty('cod_message',$message = 0); 
            return "fail";
        }
    }
}
?>	
