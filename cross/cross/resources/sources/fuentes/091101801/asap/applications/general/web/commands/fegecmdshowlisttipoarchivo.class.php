<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeGeCmdShowListTipoarchivo {
    function execute()
    {
       extract($_REQUEST);
       if(!WebSession::issetProperty("tipoarchivo__tiarcodigos"))
           WebSession::setProperty("tipoarchivo__tiarcodigos",$tipoarchivo__tiarcodigos);
       if(!WebSession::issetProperty("tipoarchivo__tiarnombres"))
           WebSession::setProperty("tipoarchivo__tiarnombres",$tipoarchivo__tiarnombres);
       if(!WebSession::issetProperty("tipoarchivo__tiarobservas"))
           WebSession::setProperty("tipoarchivo__tiarobservas",$tipoarchivo__tiarobservas);
       if(!WebSession::issetProperty("tipoarchivo__tiarestados"))
           WebSession::setProperty("tipoarchivo__tiarestados",$tipoarchivo__tiarestados);
        return "success";  
    }
}
?>	