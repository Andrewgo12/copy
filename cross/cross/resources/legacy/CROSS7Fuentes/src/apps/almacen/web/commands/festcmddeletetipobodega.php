<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdDeleteTipobodega {
    function execute()
    {
        extract($_REQUEST);
        if(($tipobodega__tibocodigos != NULL) && ($tipobodega__tibocodigos != "")){
           $tipobodega_manager = Application::getDomainController('TipobodegaManager'); 
           $message = $tipobodega_manager->deleteTipobodega($tipobodega__tibocodigos);  
           WebRequest::setProperty('cod_message', $message);
           return "success";         
        }else{
            WebRequest::setProperty('cod_message',$message = 0); 
            return "fail";
        }
    }
}
?>	
