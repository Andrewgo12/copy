<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdDeleteBodega {
    function execute()
    {
        extract($_REQUEST);
        if(($bodega__bodecodigos != NULL) && ($bodega__bodecodigos != "")){
           $bodega_manager = Application::getDomainController('BodegaManager'); 
           $message = $bodega_manager->deleteBodega($bodega__bodecodigos);  
           WebRequest::setProperty('cod_message', $message);
           return "success";         
        }else{
            WebRequest::setProperty('cod_message',$message = 0); 
            return "fail";
        }
    }
}
?>	
