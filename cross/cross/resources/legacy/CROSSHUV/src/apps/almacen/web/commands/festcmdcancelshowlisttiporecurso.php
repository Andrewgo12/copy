<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdCancelShowListTiporecurso {
    function execute()
    {
        $_REQUEST["tiporecurso__tirecodigos"] = WebSession::getProperty("tiporecurso__tirecodigos");
        $_REQUEST["tiporecurso__tirenombres"] = WebSession::getProperty("tiporecurso__tirenombres");
        $_REQUEST["tiporecurso__tiredescrips"] = WebSession::getProperty("tiporecurso__tiredescrips");
        WebSession::unsetProperty("tiporecurso__tirecodigos");
        WebSession::unsetProperty("tiporecurso__tirenombres");
        WebSession::unsetProperty("tiporecurso__tiredescrips");
        return "success";  
    }
}
?>	
