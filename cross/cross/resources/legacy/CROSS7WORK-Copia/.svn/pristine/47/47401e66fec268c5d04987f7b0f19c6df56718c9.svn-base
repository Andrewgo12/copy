<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdShowListGruposinteres {
    function execute()
    {
       extract($_REQUEST);
       if(!WebSession::issetProperty("gruposinteres__grincodigos"))
           WebSession::setProperty("gruposinteres__grincodigos",$gruposinteres__grincodigos);
       if(!WebSession::issetProperty("gruposinteres__grinnombres"))
           WebSession::setProperty("gruposinteres__grinnombres",$gruposinteres__grinnombres);
       if(!WebSession::issetProperty("gruposinteres__grindescrips"))
           WebSession::setProperty("gruposinteres__grindescrips",$gruposinteres__grindescrips);
       if(!WebSession::issetProperty("gruposinteres__grinactivos"))
           WebSession::setProperty("gruposinteres__grinactivos",$gruposinteres__grinactivos);
        return "success";  
    }
}
?>	