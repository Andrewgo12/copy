<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeHrCmdDeleteTipoorgani {
    function execute()
    {
        extract($_REQUEST);
        if(($tipoorgani__tiorcodigos != NULL) && ($tipoorgani__tiorcodigos != "")){
           $tipoorgani_manager = Application::getDomainController('TipoorganiManager'); 
           $message = $tipoorgani_manager->deleteTipoorgani($tipoorgani__tiorcodigos);  
           WebRequest::setProperty('cod_message', $message);
           return "success";         
        }else{
            WebRequest::setProperty('cod_message',$message = 0); 
            return "fail";
        }
    }
}
?>	
