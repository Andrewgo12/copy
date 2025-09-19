<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdCancelShowListRecurso {
    function execute()
    {
        $_REQUEST["recurso__recucodigos"] = WebSession::getProperty("recurso__recucodigos");
        $_REQUEST["recurso__recunombres"] = WebSession::getProperty("recurso__recunombres");
        $_REQUEST["recurso__grrecodigos"] = WebSession::getProperty("recurso__grrecodigos");
        $_REQUEST["recurso__tirecodigos"] = WebSession::getProperty("recurso__tirecodigos");
        $_REQUEST["recurso__unmecodigos"] = WebSession::getProperty("recurso__unmecodigos");
        $_REQUEST["recurso__recudescrips"] = WebSession::getProperty("recurso__recudescrips");
        WebSession::unsetProperty("recurso__recucodigos");
        WebSession::unsetProperty("recurso__recunombres");
        WebSession::unsetProperty("recurso__grrecodigos");
        WebSession::unsetProperty("recurso__tirecodigos");
        WebSession::unsetProperty("recurso__unmecodigos");
        WebSession::unsetProperty("recurso__recudescrips");
        return "success";  
    }
}
?>	
