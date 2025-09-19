<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdDeleteCondiusuario {
    function execute()
    {
        extract($_REQUEST);
        if(($condiusuario__couscodigos != NULL) && ($condiusuario__couscodigos != "")){
           $condiusuario_manager = Application::getDomainController('CondiusuarioManager'); 
           $message = $condiusuario_manager->deleteCondiusuario($condiusuario__couscodigos);  
           WebRequest::setProperty('cod_message', $message);
           return "success";         
        }else{
            WebRequest::setProperty('cod_message',$message = 0); 
            return "fail";
        }
    }
}
?>	
