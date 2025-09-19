<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCrCmdDeleteOrden {
    function execute()
    {
        extract($_REQUEST);
        if(($orden__ordenumeros != NULL) && ($orden__ordenumeros != "")){
           $orden_manager = Application::getDomainController('OrdenManager'); 
           $message = $orden_manager->deleteOrden($orden__ordenumeros);  
           WebRequest::setProperty('cod_message', $message);
           return "success";         
        }else{
            WebRequest::setProperty('cod_message',$message = 0); 
            return "fail";
        }
    }
}
?>	
