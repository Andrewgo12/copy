<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdShowListBodega {
    function execute()
    {
       extract($_REQUEST);
       if(!WebSession::issetProperty("bodega__bodecodigos"))
           WebSession::setProperty("bodega__bodecodigos",$bodega__bodecodigos);
       if(!WebSession::issetProperty("bodega__tibocodigos"))
           WebSession::setProperty("bodega__tibocodigos",$bodega__tibocodigos);
       if(!WebSession::issetProperty("bodega__bodenombres"))
           WebSession::setProperty("bodega__bodenombres",$bodega__bodenombres);
       if(!WebSession::issetProperty("bodega__bodedescrips"))
           WebSession::setProperty("bodega__bodedescrips",$bodega__bodedescrips);
       if(!WebSession::issetProperty("bodega__orgacodigos"))
           WebSession::setProperty("bodega__orgacodigos",$bodega__orgacodigos);
       if(!WebSession::issetProperty("bodega__bodefechcred"))
           WebSession::setProperty("bodega__bodefechcred",$bodega__bodefechcred);
       if(!WebSession::issetProperty("bodega__bodefechfind"))
           WebSession::setProperty("bodega__bodefechfind",$bodega__bodefechfind);
       if(!WebSession::issetProperty("bodega__bodeestados"))
           WebSession::setProperty("bodega__bodeestados",$bodega__bodeestados);
        return "success";  
    }
}
?>	
