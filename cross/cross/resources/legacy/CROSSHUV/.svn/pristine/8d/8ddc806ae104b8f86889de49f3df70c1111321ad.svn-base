<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdCancelShowListSegurisocial {
    function execute()
    {
        $_REQUEST["segurisocial__sesocodigos"] = WebSession::getProperty("segurisocial__sesocodigos");
        $_REQUEST["segurisocial__sesonombres"] = WebSession::getProperty("segurisocial__sesonombres");
        $_REQUEST["segurisocial__sesodescrips"] = WebSession::getProperty("segurisocial__sesodescrips");
        $_REQUEST["segurisocial__sesoactivos"] = WebSession::getProperty("segurisocial__sesoactivos");
        WebSession::unsetProperty("segurisocial__sesocodigos");
        WebSession::unsetProperty("segurisocial__sesonombres");
        WebSession::unsetProperty("segurisocial__sesodescrips");
        WebSession::unsetProperty("segurisocial__sesoactivos");
        return "success";  
    }
}
?>