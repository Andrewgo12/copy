<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeWFCmdDeleteEstadoacta {
    function execute()
    {
        extract($_REQUEST);
        if(($estadoacta__esaccodigos != NULL) && ($estadoacta__esaccodigos != "")){
           $estadoacta_manager = Application::getDomainController('EstadoactaManager'); 
           $message = $estadoacta_manager->deleteEstadoacta($estadoacta__esaccodigos);  
           WebRequest::setProperty('cod_message', $message);
           return "success";         
        }else{
            WebRequest::setProperty('cod_message',$message = 0); 
            return "fail";
        }
    }
}
?>	
