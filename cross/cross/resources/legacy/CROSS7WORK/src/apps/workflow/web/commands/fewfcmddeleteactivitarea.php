<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeWFCmdDeleteActivitarea {
    function execute()
    {
        extract($_REQUEST);
        if(($activitarea__tarecodigos != NULL) && ($activitarea__tarecodigos != "") && ($activitarea__acticodigos != NULL) && ($activitarea__acticodigos != "")){
           $activitarea_manager = Application::getDomainController('ActivitareaManager'); 
           $message = $activitarea_manager->deleteActivitarea($activitarea__tarecodigos,$activitarea__acticodigos);  
           WebRequest::setProperty('cod_message', $message);
           return "success";         
        }else{
            WebRequest::setProperty('cod_message',$message = 0); 
            return "fail";
        }
    }
}
?>	
