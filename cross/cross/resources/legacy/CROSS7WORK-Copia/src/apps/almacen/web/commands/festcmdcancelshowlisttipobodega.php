<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdCancelShowListTipobodega {
    function execute()
    {
        $_REQUEST["tipobodega__tibocodigos"] = WebSession::getProperty("tipobodega__tibocodigos");
        $_REQUEST["tipobodega__tibonombres"] = WebSession::getProperty("tipobodega__tibonombres");
        $_REQUEST["tipobodega__tibodescrips"] = WebSession::getProperty("tipobodega__tibodescrips");
        WebSession::unsetProperty("tipobodega__tibocodigos");
        WebSession::unsetProperty("tipobodega__tibonombres");
        WebSession::unsetProperty("tipobodega__tibodescrips");
        return "success";  
    }
}
?>	
