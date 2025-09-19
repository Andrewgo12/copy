<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeWFCmdCancelShowListEstadoacta {
    function execute()
    {
        $_REQUEST["estadoacta__esaccodigos"] = WebSession::getProperty("estadoacta__esaccodigos");
        $_REQUEST["estadoacta__esacnombres"] = WebSession::getProperty("estadoacta__esacnombres");
        $_REQUEST["estadoacta__esacdescrips"] = WebSession::getProperty("estadoacta__esacdescrips");
        $_REQUEST["estadoacta__esacactivas"] = WebSession::getProperty("estadoacta__esacactivas");
        WebSession::unsetProperty("estadoacta__esaccodigos");
        WebSession::unsetProperty("estadoacta__esacnombres");
        WebSession::unsetProperty("estadoacta__esacdescrips");
        WebSession::unsetProperty("estadoacta__esacactivas");
        return "success";  
    }
}
?>	
