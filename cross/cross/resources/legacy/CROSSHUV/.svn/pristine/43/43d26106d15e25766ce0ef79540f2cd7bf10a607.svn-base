<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeHrCmdCancelShowListTipoorgani {
    function execute()
    {
        $_REQUEST["tipoorgani__tiorcodigos"] = WebSession::getProperty("tipoorgani__tiorcodigos");
        $_REQUEST["tipoorgani__tiornombres"] = WebSession::getProperty("tipoorgani__tiornombres");
        $_REQUEST["tipoorgani__tiordesc"] = WebSession::getProperty("tipoorgani__tiordesc");
        $_REQUEST["tipoorgani__tiorcodpadrs"] = WebSession::getProperty("tipoorgani__tiorcodpadrs");
        $_REQUEST["tipoorgani__tioractivos"] = WebSession::getProperty("tipoorgani__tioractivos");
        WebSession::unsetProperty("tipoorgani__tiorcodigos");
        WebSession::unsetProperty("tipoorgani__tiornombres");
        WebSession::unsetProperty("tipoorgani__tiordesc");
        WebSession::unsetProperty("tipoorgani__tiorcodpadrs");
        WebSession::unsetProperty("tipoorgani__tioractivos");
        return "success";  
    }
}
?>	
