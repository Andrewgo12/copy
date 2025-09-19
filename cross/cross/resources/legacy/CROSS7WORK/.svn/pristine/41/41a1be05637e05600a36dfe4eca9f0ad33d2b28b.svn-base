<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdShowListTipocliente {
    function execute()
    {
       extract($_REQUEST);
       if(!WebSession::issetProperty("tipocliente__ticlcodigos"))
           WebSession::setProperty("tipocliente__ticlcodigos",$tipocliente__ticlcodigos);
       if(!WebSession::issetProperty("tipocliente__ticlnombres"))
           WebSession::setProperty("tipocliente__ticlnombres",$tipocliente__ticlnombres);
       if(!WebSession::issetProperty("tipocliente__ticldescrips"))
           WebSession::setProperty("tipocliente__ticldescrips",$tipocliente__ticldescrips);
       if(!WebSession::issetProperty("tipocliente__ticlactivos"))
           WebSession::setProperty("tipocliente__ticlactivos",$tipocliente__ticlactivos);
        return "success";  
    }
}
?>	
