<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdDeleteProveerecurs {
    function execute()
    {
        extract($_REQUEST);
        if(($proveerecurs__prrecodigos != NULL) && ($proveerecurs__prrecodigos != "")){
           $proveerecurs_manager = Application::getDomainController('ProveerecursManager'); 
           $message = $proveerecurs_manager->deleteProveerecurs($proveerecurs__prrecodigos);  
           WebRequest::setProperty('cod_message', $message);
           return "success";         
        }else{
            WebRequest::setProperty('cod_message',$message = 0); 
            return "fail";
        }
    }
}
?>	
