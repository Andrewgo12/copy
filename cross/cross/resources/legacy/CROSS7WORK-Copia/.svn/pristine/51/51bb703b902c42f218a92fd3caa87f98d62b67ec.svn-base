<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCrCmdCancelShowListActaempresa {
    function execute()
    {
        $_REQUEST["actaempresa__actacodigos"] = WebSession::getProperty("actaempresa__actacodigos");
        $_REQUEST["actaempresa__acemnumeros"] = WebSession::getProperty("actaempresa__acemnumeros");
        $_REQUEST["actaempresa__esaccodigos"] = WebSession::getProperty("actaempresa__esaccodigos");
        $_REQUEST["actaempresa__acemfeccren"] = WebSession::getProperty("actaempresa__acemfeccren");
        $_REQUEST["actaempresa__acemfecaten"] = WebSession::getProperty("actaempresa__acemfecaten");
        $_REQUEST["actaempresa__acemhorainn"] = WebSession::getProperty("actaempresa__acemhorainn");
        $_REQUEST["actaempresa__acemhorafin"] = WebSession::getProperty("actaempresa__acemhorafin");
        $_REQUEST["actaempresa__acemobservas"] = WebSession::getProperty("actaempresa__acemobservas");
        WebSession::unsetProperty("actaempresa__actacodigos");
        WebSession::unsetProperty("actaempresa__acemnumeros");
        WebSession::unsetProperty("actaempresa__esaccodigos");
        WebSession::unsetProperty("actaempresa__acemfeccren");
        WebSession::unsetProperty("actaempresa__acemfecaten");
        WebSession::unsetProperty("actaempresa__acemhorainn");
        WebSession::unsetProperty("actaempresa__acemhorafin");
        WebSession::unsetProperty("actaempresa__acemobservas");
        return "success";  
    }
}
?>	
