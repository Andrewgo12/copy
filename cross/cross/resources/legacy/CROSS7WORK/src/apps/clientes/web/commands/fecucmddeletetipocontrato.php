<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdDeleteTipocontrato {
    function execute()
    {
        extract($_REQUEST);
        if(($tipocontrato__ticocodigos != NULL) && ($tipocontrato__ticocodigos != "")){
           $tipocontrato_manager = Application::getDomainController('TipocontratoManager'); 
           $message = $tipocontrato_manager->deleteTipocontrato($tipocontrato__ticocodigos);  
           WebRequest::setProperty('cod_message', $message);
           return "success";         
        }else{
            WebRequest::setProperty('cod_message',$message = 0); 
            return "fail";
        }
    }
}
?>	
