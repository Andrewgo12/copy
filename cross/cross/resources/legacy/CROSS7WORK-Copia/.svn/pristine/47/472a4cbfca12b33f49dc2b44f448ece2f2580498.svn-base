<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdShowByIdBodega {
    function execute()
    {
        extract($_REQUEST);
        if(($bodega__bodecodigos != NULL) && ($bodega__bodecodigos != "")){
           $bodega_manager = Application::getDomainController('BodegaManager'); 
           $bodega_data = $bodega_manager->getByIdBodega($bodega__bodecodigos); 
           $_REQUEST["bodega__bodecodigos"] = $bodega_data[0]["bodecodigos"];
           $_REQUEST["bodega__tibocodigos"] = $bodega_data[0]["tibocodigos"];
           $_REQUEST["bodega__bodenombres"] = $bodega_data[0]["bodenombres"];
           $_REQUEST["bodega__bodedescrips"] = $bodega_data[0]["bodedescrips"];
           $_REQUEST["bodega__orgacodigos"] = $bodega_data[0]["orgacodigos"];
           $_REQUEST["bodega__bodefechcred"] = $bodega_data[0]["bodefechcred"];
           $_REQUEST["bodega__bodefechfind"] = $bodega_data[0]["bodefechfind"];
           $_REQUEST["bodega__bodeestados"] = $bodega_data[0]["bodeestados"];
        }else{
           $_REQUEST["bodega__bodecodigos"] = WebSession::getProperty("bodega__bodecodigos");
           $_REQUEST["bodega__tibocodigos"] = WebSession::getProperty("bodega__tibocodigos");
           $_REQUEST["bodega__bodenombres"] = WebSession::getProperty("bodega__bodenombres");
           $_REQUEST["bodega__bodedescrips"] = WebSession::getProperty("bodega__bodedescrips");
           $_REQUEST["bodega__orgacodigos"] = WebSession::getProperty("bodega__orgacodigos");
           $_REQUEST["bodega__bodefechcred"] = WebSession::getProperty("bodega__bodefechcred");
           $_REQUEST["bodega__bodefechfind"] = WebSession::getProperty("bodega__bodefechfind");
           $_REQUEST["bodega__bodeestados"] = WebSession::getProperty("bodega__bodeestados");		
        }
        WebSession::unsetProperty("bodega__bodecodigos");
        WebSession::unsetProperty("bodega__tibocodigos");
        WebSession::unsetProperty("bodega__bodenombres");
        WebSession::unsetProperty("bodega__bodedescrips");
        WebSession::unsetProperty("bodega__orgacodigos");
        WebSession::unsetProperty("bodega__bodefechcred");
        WebSession::unsetProperty("bodega__bodefechfind");
        WebSession::unsetProperty("bodega__bodeestados");
        return "success";       
    }
}
?>	
