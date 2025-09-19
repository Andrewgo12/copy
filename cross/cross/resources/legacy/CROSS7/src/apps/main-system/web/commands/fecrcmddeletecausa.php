<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
  
require_once "Web/WebRequest.class.php";

Class FeCrCmdDeleteCausa {

    function execute()
    {
        extract($_REQUEST);
        
        if(($causa__tiorcodigos != NULL) && ($causa__tiorcodigos != "") && ($causa__evencodigos != NULL) && ($causa__evencodigos != "") && ($causa__causcodigos != NULL) && ($causa__causcodigos != "")){
           $causa_manager = Application::getDomainController('CausaManager'); 
           $message = $causa_manager->deleteCausa($causa__tiorcodigos,$causa__evencodigos,$causa__causcodigos);  
           WebRequest::setProperty('cod_message', $message);
           return "success";         
        }else{
            WebRequest::setProperty('cod_message',$message = 0); 
            return "fail";
        }
    }

}

?>	
