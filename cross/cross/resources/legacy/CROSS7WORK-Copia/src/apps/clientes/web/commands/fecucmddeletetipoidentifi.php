<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdDeleteTipoidentifi {
    function execute()
    {
        extract($_REQUEST);
        if(($tipoidentifi__tiidcodigos != NULL) && ($tipoidentifi__tiidcodigos != "")){
           $tipoidentifi_manager = Application::getDomainController('TipoidentifiManager'); 
           $message = $tipoidentifi_manager->deleteTipoidentifi($tipoidentifi__tiidcodigos);  
           WebRequest::setProperty('cod_message', $message);
           return "success";         
        }else{
            WebRequest::setProperty('cod_message',$message = 0); 
            return "fail";
        }
    }
}
?>	
