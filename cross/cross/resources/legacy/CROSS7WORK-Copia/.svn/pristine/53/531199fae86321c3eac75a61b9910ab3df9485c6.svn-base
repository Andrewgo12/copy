<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeGeCmdShowByIdConfigarchiv {
    function execute()
    {
        extract($_REQUEST);
        if(($configarchiv__cogacodigos != NULL) && ($configarchiv__cogacodigos != "")){
           $configarchiv_manager = Application::getDomainController('ConfigarchivManager'); 
           $configarchiv_data = $configarchiv_manager->getByIdConfigarchiv($configarchiv__cogacodigos); 
           $_REQUEST["configarchiv__cogacodigos"] = $configarchiv_data[0]["cogacodigos"];
           $_REQUEST["configarchiv__coganombres"] = $configarchiv_data[0]["coganombres"];
           $_REQUEST["configarchiv__cogaobservas"] = $configarchiv_data[0]["cogaobservas"];
           $_REQUEST["configarchiv__tiarcodigos"] = $configarchiv_data[0]["tiarcodigos"];
           $_REQUEST["configarchiv__cogamarmaess"] = $configarchiv_data[0]["cogamarmaess"];
           $_REQUEST["configarchiv__cogamardetas"] = $configarchiv_data[0]["cogamardetas"];
           $_REQUEST["configarchiv__cogaposmaess"] = $configarchiv_data[0]["cogaposmaess"];
           $_REQUEST["configarchiv__cogaposdetas"] = $configarchiv_data[0]["cogaposdetas"];
           $_REQUEST["configarchiv__cogasepainis"] = $configarchiv_data[0]["cogasepainis"];
           $_REQUEST["configarchiv__cogasepafins"] = $configarchiv_data[0]["cogasepafins"];
           $_REQUEST["configarchiv__coarencabezs"] = $configarchiv_data[0]["coarencabezs"];
           $_REQUEST["configarchiv__coarextencis"] = $configarchiv_data[0]["coarextencis"];
        }else{
           $_REQUEST["configarchiv__cogacodigos"] = WebSession::getProperty("configarchiv__cogacodigos");
           $_REQUEST["configarchiv__coganombres"] = WebSession::getProperty("configarchiv__coganombres");
           $_REQUEST["configarchiv__cogaobservas"] = WebSession::getProperty("configarchiv__cogaobservas");
           $_REQUEST["configarchiv__tiarcodigos"] = WebSession::getProperty("configarchiv__tiarcodigos");
           $_REQUEST["configarchiv__cogamarmaess"] = WebSession::getProperty("configarchiv__cogamarmaess");
           $_REQUEST["configarchiv__cogamardetas"] = WebSession::getProperty("configarchiv__cogamardetas");
           $_REQUEST["configarchiv__cogaposmaess"] = WebSession::getProperty("configarchiv__cogaposmaess");
           $_REQUEST["configarchiv__cogaposdetas"] = WebSession::getProperty("configarchiv__cogaposdetas");
           $_REQUEST["configarchiv__cogasepainis"] = WebSession::getProperty("configarchiv__cogasepainis");
           $_REQUEST["configarchiv__cogasepafins"] = WebSession::getProperty("configarchiv__cogasepafins");
           $_REQUEST["configarchiv__coarencabezs"] = WebSession::getProperty("configarchiv__coarencabezs");
           $_REQUEST["configarchiv__coarextencis"] = WebSession::getProperty("configarchiv__coarextencis");		
        }
        WebSession::unsetProperty("configarchiv__cogacodigos");
        WebSession::unsetProperty("configarchiv__coganombres");
        WebSession::unsetProperty("configarchiv__cogaobservas");
        WebSession::unsetProperty("configarchiv__tiarcodigos");
        WebSession::unsetProperty("configarchiv__cogamarmaess");
        WebSession::unsetProperty("configarchiv__cogamardetas");
        WebSession::unsetProperty("configarchiv__cogaposmaess");
        WebSession::unsetProperty("configarchiv__cogaposdetas");
        WebSession::unsetProperty("configarchiv__cogasepainis");
        WebSession::unsetProperty("configarchiv__cogasepafins");
        WebSession::unsetProperty("configarchiv__coarencabezs");
        WebSession::unsetProperty("configarchiv__coarextencis");
        return "success";       
    }
}
?>	
