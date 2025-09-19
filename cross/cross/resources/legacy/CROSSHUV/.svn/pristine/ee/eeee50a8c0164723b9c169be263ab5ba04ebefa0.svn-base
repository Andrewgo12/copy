<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCrCmdCancelShowListGruposinteres {
    function execute()
    {
        $_REQUEST["gruposinteres__grincodigos"] = WebSession::getProperty("gruposinteres__grincodigos");
        $_REQUEST["gruposinteres__grinnombres"] = WebSession::getProperty("gruposinteres__grinnombres");
        $_REQUEST["gruposinteres__grindescrips"] = WebSession::getProperty("gruposinteres__grindescrips");
        $_REQUEST["gruposinteres__grinactivos"] = WebSession::getProperty("gruposinteres__grinactivos");
        WebSession::unsetProperty("gruposinteres__grincodigos");
        WebSession::unsetProperty("gruposinteres__grinnombres");
        WebSession::unsetProperty("gruposinteres__grindescrips");
        WebSession::unsetProperty("gruposinteres__grinactivos");
        return "success";  
    }
}
?>	