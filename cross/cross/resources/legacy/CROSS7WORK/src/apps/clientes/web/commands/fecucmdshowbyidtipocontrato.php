<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdShowByIdTipocontrato {
    function execute()
    {
        extract($_REQUEST);
        if(($tipocontrato__ticocodigos != NULL) && ($tipocontrato__ticocodigos != "")){
           $tipocontrato_manager = Application::getDomainController('TipocontratoManager'); 
           $tipocontrato_data = $tipocontrato_manager->getByIdTipocontrato($tipocontrato__ticocodigos); 
           $_REQUEST["tipocontrato__ticocodigos"] = $tipocontrato_data[0]["ticocodigos"];
           $_REQUEST["tipocontrato__ticonombres"] = $tipocontrato_data[0]["ticonombres"];
           $_REQUEST["tipocontrato__ticodescrips"] = $tipocontrato_data[0]["ticodescrips"];
           $_REQUEST["tipocontrato__ticoactivos"] = $tipocontrato_data[0]["ticoactivos"];
        }else{
           $_REQUEST["tipocontrato__ticocodigos"] = WebSession::getProperty("tipocontrato__ticocodigos");
           $_REQUEST["tipocontrato__ticonombres"] = WebSession::getProperty("tipocontrato__ticonombres");
           $_REQUEST["tipocontrato__ticodescrips"] = WebSession::getProperty("tipocontrato__ticodescrips");
           $_REQUEST["tipocontrato__ticoactivos"] = WebSession::getProperty("tipocontrato__ticoactivos");		
        }
        WebSession::unsetProperty("tipocontrato__ticocodigos");
        WebSession::unsetProperty("tipocontrato__ticonombres");
        WebSession::unsetProperty("tipocontrato__ticodescrips");
        WebSession::unsetProperty("tipocontrato__ticoactivos");
        return "success";       
    }
}
?>	
