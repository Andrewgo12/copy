<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdCancelShowListEstadoclient {
    function execute()
    {
        $_REQUEST["estadoclient__esclcodigos"] = WebSession::getProperty("estadoclient__esclcodigos");
        $_REQUEST["estadoclient__esclnombres"] = WebSession::getProperty("estadoclient__esclnombres");
        $_REQUEST["estadoclient__escldescrips"] = WebSession::getProperty("estadoclient__escldescrips");
        $_REQUEST["estadoclient__esclactivos"] = WebSession::getProperty("estadoclient__esclactivos");
        WebSession::unsetProperty("estadoclient__esclcodigos");
        WebSession::unsetProperty("estadoclient__esclnombres");
        WebSession::unsetProperty("estadoclient__escldescrips");
        WebSession::unsetProperty("estadoclient__esclactivos");
        return "success";  
    }
}
?>	
