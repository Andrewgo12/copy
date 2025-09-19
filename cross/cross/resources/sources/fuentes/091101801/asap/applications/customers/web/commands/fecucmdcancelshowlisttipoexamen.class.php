<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdCancelShowListTipoexamen {
    function execute()
    {
        $_REQUEST["tipoexamen__tiexcodigos"] = WebSession::getProperty("tipoexamen__tiexcodigos");
        $_REQUEST["tipoexamen__tiexnombres"] = WebSession::getProperty("tipoexamen__tiexnombres");
        $_REQUEST["tipoexamen__tiexdescrips"] = WebSession::getProperty("tipoexamen__tiexdescrips");
        $_REQUEST["tipoexamen__tiexactivos"] = WebSession::getProperty("tipoexamen__tiexactivos");
        WebSession::unsetProperty("tipoexamen__tiexcodigos");
        WebSession::unsetProperty("tipoexamen__tiexnombres");
        WebSession::unsetProperty("tipoexamen__tiexdescrips");
        WebSession::unsetProperty("tipoexamen__tiexactivos");
        return "success";  
    }
}
?>