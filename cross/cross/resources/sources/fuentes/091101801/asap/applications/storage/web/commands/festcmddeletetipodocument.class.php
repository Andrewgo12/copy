<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdDeleteTipodocument {
    function execute()
    {
        extract($_REQUEST);
        if(($tipodocument__tidocodigos != NULL) && ($tipodocument__tidocodigos != "")){
           $tipodocument_manager = Application::getDomainController('TipodocumentManager'); 
           $message = $tipodocument_manager->deleteTipodocument($tipodocument__tidocodigos);  
           WebRequest::setProperty('cod_message', $message);
           return "success";         
        }else{
            WebRequest::setProperty('cod_message',$message = 0); 
            return "fail";
        }
    }
}
?>	
