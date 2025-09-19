<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeHrCmdDeleteCargo {
    function execute()
    {
        extract($_REQUEST);
        if(($cargo__cargcodigos != NULL) && ($cargo__cargcodigos != "")){
           $cargo_manager = Application::getDomainController('CargoManager'); 
           $message = $cargo_manager->deleteCargo($cargo__cargcodigos);  
           WebRequest::setProperty('cod_message', $message);
           return "success";         
        }else{
            WebRequest::setProperty('cod_message',$message = 0); 
            return "fail";
        }
    }
}
?>	
