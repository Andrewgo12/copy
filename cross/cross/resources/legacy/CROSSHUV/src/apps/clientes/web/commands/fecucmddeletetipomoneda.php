<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdDeleteTipomoneda {
    function execute()
    {
        extract($_REQUEST);
        if(($tipomoneda__timocodigos != NULL) && ($tipomoneda__timocodigos != "")){
           $tipomoneda_manager = Application::getDomainController('TipomonedaManager'); 
           $message = $tipomoneda_manager->deleteTipomoneda($tipomoneda__timocodigos);  
           WebRequest::setProperty('cod_message', $message);
           return "success";         
        }else{
            WebRequest::setProperty('cod_message',$message = 0); 
            return "fail";
        }
    }
}
?>	
