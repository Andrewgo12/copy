<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeGeCmdCancelShowListTipoarchivo {
    function execute()
    {
        $_REQUEST["tipoarchivo__tiarcodigos"] = WebSession::getProperty("tipoarchivo__tiarcodigos");
        $_REQUEST["tipoarchivo__tiarnombres"] = WebSession::getProperty("tipoarchivo__tiarnombres");
        $_REQUEST["tipoarchivo__tiarobservas"] = WebSession::getProperty("tipoarchivo__tiarobservas");
        $_REQUEST["tipoarchivo__tiarestados"] = WebSession::getProperty("tipoarchivo__tiarestados");
        WebSession::unsetProperty("tipoarchivo__tiarcodigos");
        WebSession::unsetProperty("tipoarchivo__tiarnombres");
        WebSession::unsetProperty("tipoarchivo__tiarobservas");
        WebSession::unsetProperty("tipoarchivo__tiarestados");
        return "success";  
    }
}
?>	
