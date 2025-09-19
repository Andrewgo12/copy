<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdDeleteTipocliente {
    function execute()
    {
        extract($_REQUEST);
        if(($tipocliente__ticlcodigos != NULL) && ($tipocliente__ticlcodigos != "")){
           $tipocliente_manager = Application::getDomainController('TipoclienteManager'); 
           $message = $tipocliente_manager->deleteTipocliente($tipocliente__ticlcodigos);  
           WebRequest::setProperty('cod_message', $message);
           return "success";         
        }else{
            WebRequest::setProperty('cod_message',$message = 0); 
            return "fail";
        }
    }
}
?>	
