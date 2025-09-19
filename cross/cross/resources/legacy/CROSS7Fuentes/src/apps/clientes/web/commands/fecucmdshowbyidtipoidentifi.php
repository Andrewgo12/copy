<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdShowByIdTipoidentifi {
    function execute()
    {
        extract($_REQUEST);
        if(($tipoidentifi__tiidcodigos != NULL) && ($tipoidentifi__tiidcodigos != "")){
           $tipoidentifi_manager = Application::getDomainController('TipoidentifiManager'); 
           $tipoidentifi_data = $tipoidentifi_manager->getByIdTipoidentifi($tipoidentifi__tiidcodigos); 
           $_REQUEST["tipoidentifi__tiidcodigos"] = $tipoidentifi_data[0]["tiidcodigos"];
           $_REQUEST["tipoidentifi__tiidnombres"] = $tipoidentifi_data[0]["tiidnombres"];
           $_REQUEST["tipoidentifi__tiiddescrips"] = $tipoidentifi_data[0]["tiiddescrips"];
           $_REQUEST["tipoidentifi__tiidactivas"] = $tipoidentifi_data[0]["tiidactivas"];
        }else{
           $_REQUEST["tipoidentifi__tiidcodigos"] = WebSession::getProperty("tipoidentifi__tiidcodigos");
           $_REQUEST["tipoidentifi__tiidnombres"] = WebSession::getProperty("tipoidentifi__tiidnombres");
           $_REQUEST["tipoidentifi__tiiddescrips"] = WebSession::getProperty("tipoidentifi__tiiddescrips");
           $_REQUEST["tipoidentifi__tiidactivas"] = WebSession::getProperty("tipoidentifi__tiidactivas");		
        }
        WebSession::unsetProperty("tipoidentifi__tiidcodigos");
        WebSession::unsetProperty("tipoidentifi__tiidnombres");
        WebSession::unsetProperty("tipoidentifi__tiiddescrips");
        WebSession::unsetProperty("tipoidentifi__tiidactivas");
        return "success";       
    }
}
?>	
