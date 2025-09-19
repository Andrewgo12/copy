<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdShowListTipocontrato {
    function execute()
    {
       extract($_REQUEST);
       if(!WebSession::issetProperty("tipocontrato__ticocodigos"))
           WebSession::setProperty("tipocontrato__ticocodigos",$tipocontrato__ticocodigos);
       if(!WebSession::issetProperty("tipocontrato__ticonombres"))
           WebSession::setProperty("tipocontrato__ticonombres",$tipocontrato__ticonombres);
       if(!WebSession::issetProperty("tipocontrato__ticodescrips"))
           WebSession::setProperty("tipocontrato__ticodescrips",$tipocontrato__ticodescrips);
       if(!WebSession::issetProperty("tipocontrato__ticoactivos"))
           WebSession::setProperty("tipocontrato__ticoactivos",$tipocontrato__ticoactivos);
        return "success";  
    }
}
?>	
