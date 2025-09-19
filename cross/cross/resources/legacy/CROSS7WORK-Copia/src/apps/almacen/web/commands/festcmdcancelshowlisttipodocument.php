<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdCancelShowListTipodocument {
    function execute()
    {
        $_REQUEST["tipodocument__tidocodigos"] = WebSession::getProperty("tipodocument__tidocodigos");
        $_REQUEST["tipodocument__tidonombres"] = WebSession::getProperty("tipodocument__tidonombres");
        $_REQUEST["tipodocument__tidodescrips"] = WebSession::getProperty("tipodocument__tidodescrips");
        WebSession::unsetProperty("tipodocument__tidocodigos");
        WebSession::unsetProperty("tipodocument__tidonombres");
        WebSession::unsetProperty("tipodocument__tidodescrips");
        return "success";  
    }
}
?>	
