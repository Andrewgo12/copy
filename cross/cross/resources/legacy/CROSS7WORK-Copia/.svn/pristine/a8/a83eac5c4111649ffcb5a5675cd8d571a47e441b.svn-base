<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeHrCmdDeleteOrganizacion {
    function execute()
    {
        extract($_REQUEST);
        if(($organizacion__orgacodigos != NULL) && ($organizacion__orgacodigos != "")){
           $organizacion_manager = Application::getDomainController('OrganizacionManager'); 
           $message = $organizacion_manager->deleteOrganizacion($organizacion__orgacodigos);  
           WebRequest::setProperty('cod_message', $message);
           return "success";         
        }else{
            WebRequest::setProperty('cod_message',$message = 0); 
            return "fail";
        }
    }
}
?>	
