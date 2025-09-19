<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCrCmdCancelShowListTipoorden {
    function execute()
    {
        $_REQUEST["tipoorden__tiorcodigos"] = WebSession::getProperty("tipoorden__tiorcodigos");
        $_REQUEST["tipoorden__tiornombres"] = WebSession::getProperty("tipoorden__tiornombres");
        $_REQUEST["tipoorden__tiordescrips"] = WebSession::getProperty("tipoorden__tiordescrips");
        $_REQUEST["tipoorden__tioractivos"] = WebSession::getProperty("tipoorden__tioractivos");
        $_REQUEST["tipoorden__tiorpeson"] = WebSession::getProperty("tipoorden__tiorpeson");
        WebSession::unsetProperty("tipoorden__tiorcodigos");
        WebSession::unsetProperty("tipoorden__tiornombres");
        WebSession::unsetProperty("tipoorden__tiordescrips");
        WebSession::unsetProperty("tipoorden__tioractivos");
        WebSession::unsetProperty("tipoorden__tiorpeson");
        return "success";  
    }
}
?>