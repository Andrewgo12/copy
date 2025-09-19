<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeGeCmdDeleteConfigarchiv {
    function execute()
    {
        extract($_REQUEST);
        if(($configarchiv__cogacodigos != NULL) && ($configarchiv__cogacodigos != "")){
           $configarchiv_manager = Application::getDomainController('FileConfigurationManager'); 
           $message = $configarchiv_manager->deleteConfigarchiv($configarchiv__cogacodigos);  
           WebRequest::setProperty('cod_message', $message);
           return "success";         
        }else{
            WebRequest::setProperty('cod_message',$message = 0); 
            return "fail";
        }
    }
}
?>	