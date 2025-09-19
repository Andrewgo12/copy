<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdDeleteIpsservicio {
    function execute()
    {
        extract($_REQUEST);
        if(($ipsservicio__ipsecodigos != NULL) && ($ipsservicio__ipsecodigos != "")){
           $ipsservicio_manager = Application::getDomainController('IpsservicioManager'); 
           $message = $ipsservicio_manager->deleteIpsservicio($ipsservicio__ipsecodigos);  
           WebRequest::setProperty('cod_message', $message);
           return "success";         
        }else{
            WebRequest::setProperty('cod_message',$message = 0); 
            return "fail";
        }
    }
}
?>	
