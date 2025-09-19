<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeHrCmdCancelShowListEstadoorgani {
    function execute()
    {
        $_REQUEST["estadoorgani__esorcodigos"] = WebSession::getProperty("estadoorgani__esorcodigos");
        $_REQUEST["estadoorgani__esornombres"] = WebSession::getProperty("estadoorgani__esornombres");
        $_REQUEST["estadoorgani__esordescrips"] = WebSession::getProperty("estadoorgani__esordescrips");
        $_REQUEST["estadoorgani__esoractivas"] = WebSession::getProperty("estadoorgani__esoractivas");
        WebSession::unsetProperty("estadoorgani__esorcodigos");
        WebSession::unsetProperty("estadoorgani__esornombres");
        WebSession::unsetProperty("estadoorgani__esordescrips");
        WebSession::unsetProperty("estadoorgani__esoractivas");
        return "success";  
    }
}
?>	
