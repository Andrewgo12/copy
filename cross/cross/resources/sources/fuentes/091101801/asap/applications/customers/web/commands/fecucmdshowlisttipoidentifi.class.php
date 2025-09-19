<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdShowListTipoidentifi {
    function execute()
    {
       extract($_REQUEST);
       if(!WebSession::issetProperty("tipoidentifi__tiidcodigos"))
           WebSession::setProperty("tipoidentifi__tiidcodigos",$tipoidentifi__tiidcodigos);
       if(!WebSession::issetProperty("tipoidentifi__tiidnombres"))
           WebSession::setProperty("tipoidentifi__tiidnombres",$tipoidentifi__tiidnombres);
       if(!WebSession::issetProperty("tipoidentifi__tiiddescrips"))
           WebSession::setProperty("tipoidentifi__tiiddescrips",$tipoidentifi__tiiddescrips);
       if(!WebSession::issetProperty("tipoidentifi__tiidactivas"))
           WebSession::setProperty("tipoidentifi__tiidactivas",$tipoidentifi__tiidactivas);
        return "success";  
    }
}
?>	
