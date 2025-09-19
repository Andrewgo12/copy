<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCrCmdCancelShowListPrioridad {
    function execute()
    {
        $_REQUEST["prioridad__priocodigos"] = WebSession::getProperty("prioridad__priocodigos");
        $_REQUEST["prioridad__prionombres"] = WebSession::getProperty("prioridad__prionombres");
        $_REQUEST["prioridad__priodescrips"] = WebSession::getProperty("prioridad__priodescrips");
        $_REQUEST["prioridad__prioactivas"] = WebSession::getProperty("prioridad__prioactivas");
        WebSession::unsetProperty("prioridad__priocodigos");
        WebSession::unsetProperty("prioridad__prionombres");
        WebSession::unsetProperty("prioridad__priodescrips");
        WebSession::unsetProperty("prioridad__prioactivas");
        return "success";  
    }
}
?>	
