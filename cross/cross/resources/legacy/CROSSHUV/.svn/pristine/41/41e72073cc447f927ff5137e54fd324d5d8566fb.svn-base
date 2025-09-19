<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdDeleteFormapago {
    function execute()
    {
        extract($_REQUEST);
        if(($formapago__fopacodigos != NULL) && ($formapago__fopacodigos != "")){
           $formapago_manager = Application::getDomainController('FormapagoManager'); 
           $message = $formapago_manager->deleteFormapago($formapago__fopacodigos);  
           WebRequest::setProperty('cod_message', $message);
           return "success";         
        }else{
            WebRequest::setProperty('cod_message',$message = 0); 
            return "fail";
        }
    }
}
?>	
