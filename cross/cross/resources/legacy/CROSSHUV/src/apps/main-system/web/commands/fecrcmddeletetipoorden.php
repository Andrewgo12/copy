<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCrCmdDeleteTipoorden {
    function execute()
    {
        extract($_REQUEST);
        if(($tipoorden__tiorcodigos != NULL) && ($tipoorden__tiorcodigos != "")){
           $tipoorden_manager = Application::getDomainController('TipoordenManager'); 
           $message = $tipoorden_manager->deleteTipoorden($tipoorden__tiorcodigos);  
           WebRequest::setProperty('cod_message', $message);
           return "success";         
        }else{
            WebRequest::setProperty('cod_message',$message = 0); 
            return "fail";
        }
    }
}
?>	
