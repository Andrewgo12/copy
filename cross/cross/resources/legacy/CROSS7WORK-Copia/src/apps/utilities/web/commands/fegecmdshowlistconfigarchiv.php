<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeGeCmdShowListConfigarchiv {
    function execute()
    {
       extract($_REQUEST);
       if(!WebSession::issetProperty("configarchiv__cogacodigos"))
           WebSession::setProperty("configarchiv__cogacodigos",$configarchiv__cogacodigos);
       if(!WebSession::issetProperty("configarchiv__coganombres"))
           WebSession::setProperty("configarchiv__coganombres",$configarchiv__coganombres);
       if(!WebSession::issetProperty("configarchiv__cogaobservas"))
           WebSession::setProperty("configarchiv__cogaobservas",$configarchiv__cogaobservas);
       if(!WebSession::issetProperty("configarchiv__tiarcodigos"))
           WebSession::setProperty("configarchiv__tiarcodigos",$configarchiv__tiarcodigos);
       if(!WebSession::issetProperty("configarchiv__cogamarmaess"))
           WebSession::setProperty("configarchiv__cogamarmaess",$configarchiv__cogamarmaess);
       if(!WebSession::issetProperty("configarchiv__cogamardetas"))
           WebSession::setProperty("configarchiv__cogamardetas",$configarchiv__cogamardetas);
       if(!WebSession::issetProperty("configarchiv__cogaposmaess"))
           WebSession::setProperty("configarchiv__cogaposmaess",$configarchiv__cogaposmaess);
       if(!WebSession::issetProperty("configarchiv__cogaposdetas"))
           WebSession::setProperty("configarchiv__cogaposdetas",$configarchiv__cogaposdetas);
       if(!WebSession::issetProperty("configarchiv__cogasepainis"))
           WebSession::setProperty("configarchiv__cogasepainis",$configarchiv__cogasepainis);
       if(!WebSession::issetProperty("configarchiv__cogasepafins"))
           WebSession::setProperty("configarchiv__cogasepafins",$configarchiv__cogasepafins);
       if(!WebSession::issetProperty("configarchiv__coarencabezs"))
           WebSession::setProperty("configarchiv__coarencabezs",$configarchiv__coarencabezs);
       if(!WebSession::issetProperty("configarchiv__coarextencis"))
           WebSession::setProperty("configarchiv__coarextencis",$configarchiv__coarextencis);
        return "success";  
    }
}
?>	
