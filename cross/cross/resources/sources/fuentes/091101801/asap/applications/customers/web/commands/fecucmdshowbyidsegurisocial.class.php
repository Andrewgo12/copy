<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdShowByIdSegurisocial {
    function execute()
    {
    	settype($objManager,"object");
    	settype($rcData,"array");
        extract($_REQUEST);
        if(($segurisocial__sesocodigos != NULL) && ($segurisocial__sesocodigos != "")){
           $objManager = Application::getDomainController('SegurisocialManager'); 
           $rcData = $objManager->getByIdSegurisocial($segurisocial__sesocodigos); 
           $_REQUEST["segurisocial__sesocodigos"] = $rcData[0]["sesocodigos"];
           $_REQUEST["segurisocial__sesonombres"] = $rcData[0]["sesonombres"];
           $_REQUEST["segurisocial__sesodescrips"] = $rcData[0]["sesodescrips"];
           $_REQUEST["segurisocial__sesoactivos"] = $rcData[0]["sesoactivos"];
        }else{
           $_REQUEST["segurisocial__sesocodigos"] = WebSession::getProperty("segurisocial__sesocodigos");
           $_REQUEST["segurisocial__sesonombres"] = WebSession::getProperty("segurisocial__sesonombres");
           $_REQUEST["segurisocial__sesodescrips"] = WebSession::getProperty("segurisocial__sesodescrips");
           $_REQUEST["segurisocial__sesoactivos"] = WebSession::getProperty("segurisocial__sesoactivos");
        }
        WebSession::unsetProperty("segurisocial__sesocodigos");
        WebSession::unsetProperty("segurisocial__sesonombres");
        WebSession::unsetProperty("segurisocial__sesodescrips");
        WebSession::unsetProperty("segurisocial__sesoactivos");
        return "success";       
    }
}
?>