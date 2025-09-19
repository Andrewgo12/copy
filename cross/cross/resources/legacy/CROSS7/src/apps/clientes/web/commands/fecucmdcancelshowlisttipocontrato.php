<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdCancelShowListTipocontrato {
    function execute()
    {
        $_REQUEST["tipocontrato__ticocodigos"] = WebSession::getProperty("tipocontrato__ticocodigos");
        $_REQUEST["tipocontrato__ticonombres"] = WebSession::getProperty("tipocontrato__ticonombres");
        $_REQUEST["tipocontrato__ticodescrips"] = WebSession::getProperty("tipocontrato__ticodescrips");
        $_REQUEST["tipocontrato__ticoactivos"] = WebSession::getProperty("tipocontrato__ticoactivos");
        WebSession::unsetProperty("tipocontrato__ticocodigos");
        WebSession::unsetProperty("tipocontrato__ticonombres");
        WebSession::unsetProperty("tipocontrato__ticodescrips");
        WebSession::unsetProperty("tipocontrato__ticoactivos");
        return "success";  
    }
}
?>	
