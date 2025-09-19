<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdCancelShowListGruporecurso {
    function execute()
    {
        $_REQUEST["gruporecurso__grrecodigos"] = WebSession::getProperty("gruporecurso__grrecodigos");
        $_REQUEST["gruporecurso__grrenombres"] = WebSession::getProperty("gruporecurso__grrenombres");
        $_REQUEST["gruporecurso__grredescrips"] = WebSession::getProperty("gruporecurso__grredescrips");
        WebSession::unsetProperty("gruporecurso__grrecodigos");
        WebSession::unsetProperty("gruporecurso__grrenombres");
        WebSession::unsetProperty("gruporecurso__grredescrips");
        return "success";  
    }
}
?>	
