<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeGeCmdDeleteTipoarchivo {
    function execute()
    {
        extract($_REQUEST);
        if(($tipoarchivo__tiarcodigos != NULL) && ($tipoarchivo__tiarcodigos != "")){
           $tipoarchivo_manager = Application::getDomainController('TipoarchivoManager'); 
           $message = $tipoarchivo_manager->deleteTipoarchivo($tipoarchivo__tiarcodigos);  
           WebRequest::setProperty('cod_message', $message);
           return "success";         
        }else{
            WebRequest::setProperty('cod_message',$message = 0); 
            return "fail";
        }
    }
}
?>	
