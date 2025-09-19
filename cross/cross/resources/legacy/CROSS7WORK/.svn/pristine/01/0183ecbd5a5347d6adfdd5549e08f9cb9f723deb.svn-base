<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdCancelShowListCondiusuario {
    function execute()
    {
        $_REQUEST["condiusuario__couscodigos"] = WebSession::getProperty("condiusuario__couscodigos");
        $_REQUEST["condiusuario__cousnombres"] = WebSession::getProperty("condiusuario__cousnombres");
        $_REQUEST["condiusuario__cousdescrips"] = WebSession::getProperty("condiusuario__cousdescrips");
        $_REQUEST["condiusuario__cousactivos"] = WebSession::getProperty("condiusuario__cousactivos");
        WebSession::unsetProperty("condiusuario__couscodigos");
        WebSession::unsetProperty("condiusuario__cousnombres");
        WebSession::unsetProperty("condiusuario__cousdescrips");
        WebSession::unsetProperty("condiusuario__cousactivos");
        return "success";  
    }
}
?>