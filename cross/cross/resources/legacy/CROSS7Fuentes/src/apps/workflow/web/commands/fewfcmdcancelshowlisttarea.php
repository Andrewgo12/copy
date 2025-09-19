<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeWFCmdCancelShowListTarea {
    function execute()
    {
        $_REQUEST["tarea__tarecodigos"] = WebSession::getProperty("tarea__tarecodigos");
        $_REQUEST["tarea__tarenombres"] = WebSession::getProperty("tarea__tarenombres");
        $_REQUEST["tarea__orgacodigos"] = WebSession::getProperty("tarea__orgacodigos");
        $_REQUEST["tarea__taredescris"] = WebSession::getProperty("tarea__taredescris");
        $_REQUEST["tarea__tareactivas"] = WebSession::getProperty("tarea__tareactivas");
        WebSession::unsetProperty("tarea__tarecodigos");
        WebSession::unsetProperty("tarea__tarenombres");
        WebSession::unsetProperty("tarea__orgacodigos");
        WebSession::unsetProperty("tarea__taredescris");
        WebSession::unsetProperty("tarea__tareactivas");
        return "success";  
    }
}
?>	
