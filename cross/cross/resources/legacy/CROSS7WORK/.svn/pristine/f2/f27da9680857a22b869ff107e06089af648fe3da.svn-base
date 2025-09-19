<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdDeleteSegurisocial {
    function execute()
    {
        extract($_REQUEST);
        if(($segurisocial__sesocodigos != NULL) && ($segurisocial__sesocodigos != "")){
           $segurisocial_manager = Application::getDomainController('SegurisocialManager'); 
           $message = $segurisocial_manager->deleteSegurisocial($segurisocial__sesocodigos);  
           WebRequest::setProperty('cod_message', $message);
           return "success";         
        }else{
            WebRequest::setProperty('cod_message',$message = 0); 
            return "fail";
        }
    }
}
?>	
