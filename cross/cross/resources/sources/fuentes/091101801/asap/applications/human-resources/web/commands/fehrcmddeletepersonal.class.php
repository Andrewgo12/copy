<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeHrCmdDeletePersonal {
    function execute()
    {
        extract($_REQUEST);
        if(($personal__perscodigos != NULL) && ($personal__perscodigos != "")){
           $personal_manager = Application::getDomainController('PersonalManager'); 
           $message = $personal_manager->deletePersonal($personal__perscodigos);  
           WebRequest::setProperty('cod_message', $message);
           return "success";         
        }else{
            WebRequest::setProperty('cod_message',$message = 0); 
            return "fail";
        }
    }
}
?>	
