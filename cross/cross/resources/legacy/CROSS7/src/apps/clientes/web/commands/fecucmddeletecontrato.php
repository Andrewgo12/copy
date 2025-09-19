<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdDeleteContrato {
    function execute()
    {
        extract($_REQUEST);
        if(($contrato__contnics != NULL) && ($contrato__contnics != "")){
           $contrato_manager = Application::getDomainController('ContratoManager'); 
           $message = $contrato_manager->deleteContrato($contrato__contnics);  
           WebRequest::setProperty('cod_message', $message);
           return "success";         
        }else{
            WebRequest::setProperty('cod_message',$message = 0); 
            return "fail";
        }
    }
}
?>	
