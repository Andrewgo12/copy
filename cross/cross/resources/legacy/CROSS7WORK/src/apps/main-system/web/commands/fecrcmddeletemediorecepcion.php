<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
  
require_once "Web/WebRequest.class.php";

Class FeCrCmdDeleteMediorecepcion {

    function execute()
    {
        extract($_REQUEST);
        
        if(($mediorecepcion__merecodigos != NULL) && ($mediorecepcion__merecodigos != "")){
           $mediorecepcion_manager = Application::getDomainController('MediorecepcionManager'); 
           $message = $mediorecepcion_manager->deleteMediorecepcion($mediorecepcion__merecodigos);  
           WebRequest::setProperty('cod_message', $message);
           return "success";         
        }else{
            WebRequest::setProperty('cod_message',$message = 0); 
            return "fail";
        }
    }

}

?>	
