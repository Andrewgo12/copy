<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdCancelShowListTipoidentifi {
    function execute()
    {
        $_REQUEST["tipoidentifi__tiidcodigos"] = WebSession::getProperty("tipoidentifi__tiidcodigos");
        $_REQUEST["tipoidentifi__tiidnombres"] = WebSession::getProperty("tipoidentifi__tiidnombres");
        $_REQUEST["tipoidentifi__tiiddescrips"] = WebSession::getProperty("tipoidentifi__tiiddescrips");
        $_REQUEST["tipoidentifi__tiidactivas"] = WebSession::getProperty("tipoidentifi__tiidactivas");
        WebSession::unsetProperty("tipoidentifi__tiidcodigos");
        WebSession::unsetProperty("tipoidentifi__tiidnombres");
        WebSession::unsetProperty("tipoidentifi__tiiddescrips");
        WebSession::unsetProperty("tipoidentifi__tiidactivas");
        return "success";  
    }
}
?>	
