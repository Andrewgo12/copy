<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCrCmdDeleteGruposinteres {
    function execute()
    {
        extract($_REQUEST);
        if(($gruposinteres__grincodigos != NULL) && ($gruposinteres__grincodigos != "")){
           $tipocliente_manager = Application::getDomainController('GruposinteresManager'); 
           $message = $gruposinteres_manager->deleteGruposinteres($gruposinteres__grincodigos);  
           WebRequest::setProperty('cod_message', $message);
           return "success";         
        }else{
            WebRequest::setProperty('cod_message',$message = 0); 
            return "fail";
        }
    }
}
?>	