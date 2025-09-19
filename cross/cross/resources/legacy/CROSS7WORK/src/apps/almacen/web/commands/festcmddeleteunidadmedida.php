<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdDeleteUnidadmedida {
    function execute()
    {
        extract($_REQUEST);
        if(($unidadmedida__unmecodigos != NULL) && ($unidadmedida__unmecodigos != "")){
           $unidadmedida_manager = Application::getDomainController('UnidadmedidaManager'); 
           $message = $unidadmedida_manager->deleteUnidadmedida($unidadmedida__unmecodigos);  
           WebRequest::setProperty('cod_message', $message);
           return "success";         
        }else{
            WebRequest::setProperty('cod_message',$message = 0); 
            return "fail";
        }
    }
}
?>	
