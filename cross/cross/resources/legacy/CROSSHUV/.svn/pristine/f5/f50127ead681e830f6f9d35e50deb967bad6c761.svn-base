<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdShowListTipobodega {
    function execute()
    {
       extract($_REQUEST);
       if(!WebSession::issetProperty("tipobodega__tibocodigos"))
           WebSession::setProperty("tipobodega__tibocodigos",$tipobodega__tibocodigos);
       if(!WebSession::issetProperty("tipobodega__tibonombres"))
           WebSession::setProperty("tipobodega__tibonombres",$tipobodega__tibonombres);
       if(!WebSession::issetProperty("tipobodega__tibodescrips"))
           WebSession::setProperty("tipobodega__tibodescrips",$tipobodega__tibodescrips);
        return "success";  
    }
}
?>	
