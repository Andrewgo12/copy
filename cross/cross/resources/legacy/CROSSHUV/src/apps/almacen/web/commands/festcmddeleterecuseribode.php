<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdDeleteRecuseribode {
    function execute()
    {
        extract($_REQUEST);
        /*if(){
           $recuseribode_manager = Application::getDomainController('RecuseribodeManager'); 
           $message = $recuseribode_manager->deleteRecuseribode();  
           WebRequest::setProperty('cod_message', $message);
           return "success";         
        }else{
            WebRequest::setProperty('cod_message',$message = 0); 
            return "fail";
        }*/
    }
}
?>	
