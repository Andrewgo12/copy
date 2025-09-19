<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCrCmdShowByIdTipoorden {
    function execute()
    {
    	settype($objManager,"object");
    	settype($rcData,"array");
        extract($_REQUEST);
        if(($tipoorden__tiorcodigos != NULL) && ($tipoorden__tiorcodigos != "")){
           $objManager = Application::getDomainController('TipoordenManager'); 
           $rcData = $objManager->getByIdTipoorden($tipoorden__tiorcodigos); 
           $_REQUEST["tipoorden__tiorcodigos"] = $rcData[0]["tiorcodigos"];
           $_REQUEST["tipoorden__tiornombres"] = $rcData[0]["tiornombres"];
           $_REQUEST["tipoorden__tiordescrips"] = $rcData[0]["tiordescrips"];
           $_REQUEST["tipoorden__tioractivos"] = $rcData[0]["tioractivos"];
           $_REQUEST["tipoorden__tiorpeson"] = $rcData[0]["tiorpeson"];
        }else{
           $_REQUEST["tipoorden__tiorcodigos"] = WebSession::getProperty("tipoorden__tiorcodigos");
           $_REQUEST["tipoorden__tiornombres"] = WebSession::getProperty("tipoorden__tiornombres");
           $_REQUEST["tipoorden__tiordescrips"] = WebSession::getProperty("tipoorden__tiordescrips");
           $_REQUEST["tipoorden__tioractivos"] = WebSession::getProperty("tipoorden__tioractivos");
           $_REQUEST["tipoorden__tiorpeson"] = WebSession::getProperty("tipoorden__tiorpeson");
        }
        WebSession::unsetProperty("tipoorden__tiorcodigos");
        WebSession::unsetProperty("tipoorden__tiornombres");
        WebSession::unsetProperty("tipoorden__tiordescrips");
        WebSession::unsetProperty("tipoorden__tioractivos");
        WebSession::unsetProperty("tipoorden__tiorpeson");
        return "success";       
    }
}
?>