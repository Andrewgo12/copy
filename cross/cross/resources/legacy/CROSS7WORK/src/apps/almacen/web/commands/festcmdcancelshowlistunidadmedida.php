<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdCancelShowListUnidadmedida {
    function execute()
    {
        $_REQUEST["unidadmedida__unmecodigos"] = WebSession::getProperty("unidadmedida__unmecodigos");
        $_REQUEST["unidadmedida__unmenombres"] = WebSession::getProperty("unidadmedida__unmenombres");
        $_REQUEST["unidadmedida__unmesiglas"] = WebSession::getProperty("unidadmedida__unmesiglas");
        $_REQUEST["unidadmedida__unmedescrips"] = WebSession::getProperty("unidadmedida__unmedescrips");
        WebSession::unsetProperty("unidadmedida__unmecodigos");
        WebSession::unsetProperty("unidadmedida__unmenombres");
        WebSession::unsetProperty("unidadmedida__unmesiglas");
        WebSession::unsetProperty("unidadmedida__unmedescrips");
        return "success";  
    }
}
?>	
