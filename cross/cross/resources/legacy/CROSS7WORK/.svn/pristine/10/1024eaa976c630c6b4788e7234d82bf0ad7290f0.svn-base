<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdShowListTipomoneda {
    function execute()
    {
       extract($_REQUEST);
       if(!WebSession::issetProperty("tipomoneda__timocodigos"))
           WebSession::setProperty("tipomoneda__timocodigos",$tipomoneda__timocodigos);
       if(!WebSession::issetProperty("tipomoneda__timonombres"))
           WebSession::setProperty("tipomoneda__timonombres",$tipomoneda__timonombres);
       if(!WebSession::issetProperty("tipomoneda__locacodigos"))
           WebSession::setProperty("tipomoneda__locacodigos",$tipomoneda__locacodigos);
       if(!WebSession::issetProperty("tipomoneda__timoequivaln"))
           WebSession::setProperty("tipomoneda__timoequivaln",$tipomoneda__timoequivaln);
       if(!WebSession::issetProperty("tipomoneda__timodescrips"))
           WebSession::setProperty("tipomoneda__timodescrips",$tipomoneda__timodescrips);
       if(!WebSession::issetProperty("tipomoneda__timoactivas"))
           WebSession::setProperty("tipomoneda__timoactivas",$tipomoneda__timoactivas);
        return "success";  
    }
}
?>	
