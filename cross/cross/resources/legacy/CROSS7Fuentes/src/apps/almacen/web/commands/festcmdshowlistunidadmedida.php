<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdShowListUnidadmedida {
    function execute()
    {
       extract($_REQUEST);
       if(!WebSession::issetProperty("unidadmedida__unmecodigos"))
           WebSession::setProperty("unidadmedida__unmecodigos",$unidadmedida__unmecodigos);
       if(!WebSession::issetProperty("unidadmedida__unmenombres"))
           WebSession::setProperty("unidadmedida__unmenombres",$unidadmedida__unmenombres);
       if(!WebSession::issetProperty("unidadmedida__unmesiglas"))
           WebSession::setProperty("unidadmedida__unmesiglas",$unidadmedida__unmesiglas);
       if(!WebSession::issetProperty("unidadmedida__unmedescrips"))
           WebSession::setProperty("unidadmedida__unmedescrips",$unidadmedida__unmedescrips);
        return "success";  
    }
}
?>	
