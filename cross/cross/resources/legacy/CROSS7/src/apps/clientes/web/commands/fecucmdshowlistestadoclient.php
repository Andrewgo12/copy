<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdShowListEstadoclient {
    function execute()
    {
       extract($_REQUEST);
       if(!WebSession::issetProperty("estadoclient__esclcodigos"))
           WebSession::setProperty("estadoclient__esclcodigos",$estadoclient__esclcodigos);
       if(!WebSession::issetProperty("estadoclient__esclnombres"))
           WebSession::setProperty("estadoclient__esclnombres",$estadoclient__esclnombres);
       if(!WebSession::issetProperty("estadoclient__escldescrips"))
           WebSession::setProperty("estadoclient__escldescrips",$estadoclient__escldescrips);
       if(!WebSession::issetProperty("estadoclient__esclactivos"))
           WebSession::setProperty("estadoclient__esclactivos",$estadoclient__esclactivos);
        return "success";  
    }
}
?>	
