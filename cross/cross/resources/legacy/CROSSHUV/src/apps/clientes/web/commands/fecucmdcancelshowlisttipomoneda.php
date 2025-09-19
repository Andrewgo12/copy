<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdCancelShowListTipomoneda {
    function execute()
    {
        $_REQUEST["tipomoneda__timocodigos"] = WebSession::getProperty("tipomoneda__timocodigos");
        $_REQUEST["tipomoneda__timonombres"] = WebSession::getProperty("tipomoneda__timonombres");
        $_REQUEST["tipomoneda__locacodigos"] = WebSession::getProperty("tipomoneda__locacodigos");
        $_REQUEST["tipomoneda__timoequivaln"] = WebSession::getProperty("tipomoneda__timoequivaln");
        $_REQUEST["tipomoneda__timodescrips"] = WebSession::getProperty("tipomoneda__timodescrips");
        $_REQUEST["tipomoneda__timoactivas"] = WebSession::getProperty("tipomoneda__timoactivas");
        WebSession::unsetProperty("tipomoneda__timocodigos");
        WebSession::unsetProperty("tipomoneda__timonombres");
        WebSession::unsetProperty("tipomoneda__locacodigos");
        WebSession::unsetProperty("tipomoneda__timoequivaln");
        WebSession::unsetProperty("tipomoneda__timodescrips");
        WebSession::unsetProperty("tipomoneda__timoactivas");
        return "success";  
    }
}
?>	
