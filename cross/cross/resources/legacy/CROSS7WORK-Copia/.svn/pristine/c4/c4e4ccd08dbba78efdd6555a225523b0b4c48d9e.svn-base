<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdShowByIdTipocliente {
    function execute()
    {
        extract($_REQUEST);
        if(($tipocliente__ticlcodigos != NULL) && ($tipocliente__ticlcodigos != "")){
           $tipocliente_manager = Application::getDomainController('TipoclienteManager'); 
           $tipocliente_data = $tipocliente_manager->getByIdTipocliente($tipocliente__ticlcodigos); 
           $_REQUEST["tipocliente__ticlcodigos"] = $tipocliente_data[0]["ticlcodigos"];
           $_REQUEST["tipocliente__ticlnombres"] = $tipocliente_data[0]["ticlnombres"];
           $_REQUEST["tipocliente__ticldescrips"] = $tipocliente_data[0]["ticldescrips"];
           $_REQUEST["tipocliente__ticlactivos"] = $tipocliente_data[0]["ticlactivos"];
        }else{
           $_REQUEST["tipocliente__ticlcodigos"] = WebSession::getProperty("tipocliente__ticlcodigos");
           $_REQUEST["tipocliente__ticlnombres"] = WebSession::getProperty("tipocliente__ticlnombres");
           $_REQUEST["tipocliente__ticldescrips"] = WebSession::getProperty("tipocliente__ticldescrips");
           $_REQUEST["tipocliente__ticlactivos"] = WebSession::getProperty("tipocliente__ticlactivos");		
        }
        WebSession::unsetProperty("tipocliente__ticlcodigos");
        WebSession::unsetProperty("tipocliente__ticlnombres");
        WebSession::unsetProperty("tipocliente__ticldescrips");
        WebSession::unsetProperty("tipocliente__ticlactivos");
        return "success";       
    }
}
?>	
