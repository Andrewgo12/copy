<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdShowByIdGruporecurso {
    function execute()
    {
        extract($_REQUEST);
        if(($gruporecurso__grrecodigos != NULL) && ($gruporecurso__grrecodigos != "")){
           $gruporecurso_manager = Application::getDomainController('GruporecursoManager'); 
           $gruporecurso_data = $gruporecurso_manager->getByIdGruporecurso($gruporecurso__grrecodigos); 
           $_REQUEST["gruporecurso__grrecodigos"] = $gruporecurso_data[0]["grrecodigos"];
           $_REQUEST["gruporecurso__grrenombres"] = $gruporecurso_data[0]["grrenombres"];
           $_REQUEST["gruporecurso__grredescrips"] = $gruporecurso_data[0]["grredescrips"];
           $_REQUEST["gruporecurso__grreactivas"] = $gruporecurso_data[0]["grreactivas"];
        }else{
           $_REQUEST["gruporecurso__grrecodigos"] = WebSession::getProperty("gruporecurso__grrecodigos");
           $_REQUEST["gruporecurso__grrenombres"] = WebSession::getProperty("gruporecurso__grrenombres");
           $_REQUEST["gruporecurso__grredescrips"] = WebSession::getProperty("gruporecurso__grredescrips");	
           $_REQUEST["gruporecurso__grreactivas"] = WebSession::getProperty("gruporecurso__grreactivas");
        }
        WebSession::unsetProperty("gruporecurso__grrecodigos");
        WebSession::unsetProperty("gruporecurso__grrenombres");
        WebSession::unsetProperty("gruporecurso__grredescrips");
        WebSession::unsetProperty("gruporecurso__grreactivas");
        return "success";       
    }
}
?>	
