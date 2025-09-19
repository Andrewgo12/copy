<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeHrCmdCancelShowListCargo {
    function execute()
    {
        $_REQUEST["cargo__cargcodigos"] = WebSession::getProperty("cargo__cargcodigos");
        $_REQUEST["cargo__cargnombres"] = WebSession::getProperty("cargo__cargnombres");
        $_REQUEST["cargo__cargdescrips"] = WebSession::getProperty("cargo__cargdescrips");
        $_REQUEST["cargo__cargactivas"] = WebSession::getProperty("cargo__cargactivas");
        WebSession::unsetProperty("cargo__cargcodigos");
        WebSession::unsetProperty("cargo__cargnombres");
        WebSession::unsetProperty("cargo__cargdescrips");
        WebSession::unsetProperty("cargo__cargactivas");
        return "success";  
    }
}
?>	
