<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdDeleteTiporecurso {
    function execute()
    {
        extract($_REQUEST);
        if(($tiporecurso__tirecodigos != NULL) && ($tiporecurso__tirecodigos != "")){
           $tiporecurso_manager = Application::getDomainController('TiporecursoManager'); 
           $message = $tiporecurso_manager->deleteTiporecurso($tiporecurso__tirecodigos);  
           WebRequest::setProperty('cod_message', $message);
           return "success";         
        }else{
            WebRequest::setProperty('cod_message',$message = 0); 
            return "fail";
        }
    }
}
?>	
