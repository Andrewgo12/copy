<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdDeleteGruporecurso {
    function execute()
    {
        extract($_REQUEST);
        if(($gruporecurso__grrecodigos != NULL) && ($gruporecurso__grrecodigos != "")){
           $gruporecurso_manager = Application::getDomainController('GruporecursoManager'); 
           $message = $gruporecurso_manager->deleteGruporecurso($gruporecurso__grrecodigos);  
           WebRequest::setProperty('cod_message', $message);
           return "success";         
        }else{
            WebRequest::setProperty('cod_message',$message = 0); 
            return "fail";
        }
    }
}
?>	
