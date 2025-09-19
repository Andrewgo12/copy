<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdCancelShowListProveedor {
    function execute()
    {
        $_REQUEST["proveedor__provcodigos"] = WebSession::getProperty("proveedor__provcodigos");
        $_REQUEST["proveedor__provnombres"] = WebSession::getProperty("proveedor__provnombres");
        $_REQUEST["proveedor__provnnomreprs"] = WebSession::getProperty("proveedor__provnnomreprs");
        $_REQUEST["proveedor__provdireccis"] = WebSession::getProperty("proveedor__provdireccis");
        $_REQUEST["proveedor__protelefons"] = WebSession::getProperty("proveedor__protelefons");
        $_REQUEST["proveedor__provemails"] = WebSession::getProperty("proveedor__provemails");
        $_REQUEST["proveedor__provwebs"] = WebSession::getProperty("proveedor__provwebs");
        $_REQUEST["proveedor__paiscodigos"] = WebSession::getProperty("proveedor__paiscodigos");
        $_REQUEST["proveedor__depacodigos"] = WebSession::getProperty("proveedor__depacodigos");
        $_REQUEST["proveedor__ciudcodigos"] = WebSession::getProperty("proveedor__ciudcodigos");
        WebSession::unsetProperty("proveedor__provcodigos");
        WebSession::unsetProperty("proveedor__provnombres");
        WebSession::unsetProperty("proveedor__provnnomreprs");
        WebSession::unsetProperty("proveedor__provdireccis");
        WebSession::unsetProperty("proveedor__protelefons");
        WebSession::unsetProperty("proveedor__provemails");
        WebSession::unsetProperty("proveedor__provwebs");
        WebSession::unsetProperty("proveedor__paiscodigos");
        WebSession::unsetProperty("proveedor__depacodigos");
        WebSession::unsetProperty("proveedor__ciudcodigos");
        return "success";  
    }
}
?>	
