<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdShowByIdTipoexamen {
    function execute()
    {
    	settype($objManager,"object");
    	settype($rcData,"array");
        extract($_REQUEST);
        if(($tipoexamen__tiexcodigos != NULL) && ($tipoexamen__tiexcodigos != "")){
           $objManager = Application::getDomainController('TipoexamenManager'); 
           $rcData = $objManager->getByIdTipoexamen($tipoexamen__tiexcodigos); 
           $_REQUEST["tipoexamen__tiexcodigos"] = $rcData[0]["tiexcodigos"];
           $_REQUEST["tipoexamen__tiexnombres"] = $rcData[0]["tiexnombres"];
           $_REQUEST["tipoexamen__tiexdescrips"] = $rcData[0]["tiexdescrips"];
           $_REQUEST["tipoexamen__tiexactivos"] = $rcData[0]["tiexactivos"];
        }else{
           $_REQUEST["tipoexamen__tiexcodigos"] = WebSession::getProperty("tipoexamen__tiexcodigos");
           $_REQUEST["tipoexamen__tiexnombres"] = WebSession::getProperty("tipoexamen__tiexnombres");
           $_REQUEST["tipoexamen__tiexdescrips"] = WebSession::getProperty("tipoexamen__tiexdescrips");
           $_REQUEST["tipoexamen__tiexactivos"] = WebSession::getProperty("tipoexamen__tiexactivos");
        }
        WebSession::unsetProperty("tipoexamen__tiexcodigos");
        WebSession::unsetProperty("tipoexamen__tiexnombres");
        WebSession::unsetProperty("tipoexamen__tiexdescrips");
        WebSession::unsetProperty("tipoexamen__tiexactivos");
        return "success";       
    }
}
?>