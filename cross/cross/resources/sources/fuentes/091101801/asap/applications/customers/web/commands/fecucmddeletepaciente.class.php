<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
  
require_once "Web/WebRequest.class.php";

Class FeCuCmdDeletePaciente {

    function execute()
    {
        extract($_REQUEST);
        
        if(($paciente__paciindentis != NULL) && ($paciente__paciindentis != "")){
           $paciente_manager = Application::getDomainController('PacienteManager'); 
           $message = $paciente_manager->deletePaciente($paciente__paciindentis);  
           WebRequest::setProperty('cod_message', $message);
           return "success";         
        }else{
            WebRequest::setProperty('cod_message',$message = 0); 
            return "fail";
        }
    }

}

?>