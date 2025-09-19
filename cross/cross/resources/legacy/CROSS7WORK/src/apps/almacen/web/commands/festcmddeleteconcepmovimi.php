<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdDeleteConcepmovimi {
    function execute()
    {
        extract($_REQUEST);
        if(($concepmovimi__comocodigos != NULL) && ($concepmovimi__comocodigos != "")){
           $concepmovimi_manager = Application::getDomainController('ConcepmovimiManager'); 
           $message = $concepmovimi_manager->deleteConcepmovimi($concepmovimi__comocodigos);  
           WebRequest::setProperty('cod_message', $message);
           return "success";         
        }else{
            WebRequest::setProperty('cod_message',$message = 0); 
            return "fail";
        }
    }
}
?>	
