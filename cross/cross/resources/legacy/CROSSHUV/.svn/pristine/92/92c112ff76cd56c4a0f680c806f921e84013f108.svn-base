<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
  
require_once "Web/WebRequest.class.php";

Class FeHrCmdDeleteEstadogrupo {

    function execute()
    {
        extract($_REQUEST);
        
        if(($estadogrupo__esgrcodigos != NULL) && ($estadogrupo__esgrcodigos != "")){
           $estadogrupo_manager = Application::getDomainController('EstadogrupoManager'); 
           $message = $estadogrupo_manager->deleteEstadogrupo($estadogrupo__esgrcodigos);  
           WebRequest::setProperty('cod_message', $message);
           return "success";         
        }else{
            WebRequest::setProperty('cod_message',$message = 0); 
            return "fail";
        }
    }

}

?>	
