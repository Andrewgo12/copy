<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdShowListGruporecurso {
    function execute()
    {
       extract($_REQUEST);
       if(!WebSession::issetProperty("gruporecurso__grrecodigos"))
           WebSession::setProperty("gruporecurso__grrecodigos",$gruporecurso__grrecodigos);
       if(!WebSession::issetProperty("gruporecurso__grrenombres"))
           WebSession::setProperty("gruporecurso__grrenombres",$gruporecurso__grrenombres);
       if(!WebSession::issetProperty("gruporecurso__grredescrips"))
           WebSession::setProperty("gruporecurso__grredescrips",$gruporecurso__grredescrips);
        return "success";  
    }
}
?>	
