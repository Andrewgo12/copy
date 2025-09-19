<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdShowListProveedor {
    function execute()
    {
       extract($_REQUEST);
       if(!WebSession::issetProperty("proveedor__provcodigos"))
           WebSession::setProperty("proveedor__provcodigos",$proveedor__provcodigos);
       if(!WebSession::issetProperty("proveedor__provnombres"))
           WebSession::setProperty("proveedor__provnombres",$proveedor__provnombres);
       if(!WebSession::issetProperty("proveedor__provnnomreprs"))
           WebSession::setProperty("proveedor__provnnomreprs",$proveedor__provnnomreprs);
       if(!WebSession::issetProperty("proveedor__provdireccis"))
           WebSession::setProperty("proveedor__provdireccis",$proveedor__provdireccis);
       if(!WebSession::issetProperty("proveedor__protelefons"))
           WebSession::setProperty("proveedor__protelefons",$proveedor__protelefons);
       if(!WebSession::issetProperty("proveedor__provemails"))
           WebSession::setProperty("proveedor__provemails",$proveedor__provemails);
       if(!WebSession::issetProperty("proveedor__provwebs"))
           WebSession::setProperty("proveedor__provwebs",$proveedor__provwebs);
       if(!WebSession::issetProperty("proveedor__paiscodigos"))
           WebSession::setProperty("proveedor__paiscodigos",$proveedor__paiscodigos);
       if(!WebSession::issetProperty("proveedor__depacodigos"))
           WebSession::setProperty("proveedor__depacodigos",$proveedor__depacodigos);
       if(!WebSession::issetProperty("proveedor__ciudcodigos"))
           WebSession::setProperty("proveedor__ciudcodigos",$proveedor__ciudcodigos);
        return "success";  
    }
}
?>	
