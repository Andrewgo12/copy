<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeHrCmdShowByIdCargo {
    function execute()
    {
        extract($_REQUEST);
        if(($cargo__cargcodigos != NULL) && ($cargo__cargcodigos != "")){
           $cargo_manager = Application::getDomainController('CargoManager'); 
           $cargo_data = $cargo_manager->getByIdCargo($cargo__cargcodigos); 
           $_REQUEST["cargo__cargcodigos"] = $cargo_data[0]["cargcodigos"];
           $_REQUEST["cargo__cargnombres"] = $cargo_data[0]["cargnombres"];
           $_REQUEST["cargo__cargdescrips"] = $cargo_data[0]["cargdescrips"];
           $_REQUEST["cargo__cargactivas"] = $cargo_data[0]["cargactivas"];
        }else{
           $_REQUEST["cargo__cargcodigos"] = WebSession::getProperty("cargo__cargcodigos");
           $_REQUEST["cargo__cargnombres"] = WebSession::getProperty("cargo__cargnombres");
           $_REQUEST["cargo__cargdescrips"] = WebSession::getProperty("cargo__cargdescrips");
           $_REQUEST["cargo__cargactivas"] = WebSession::getProperty("cargo__cargactivas");		
        }
        WebSession::unsetProperty("cargo__cargcodigos");
        WebSession::unsetProperty("cargo__cargnombres");
        WebSession::unsetProperty("cargo__cargdescrips");
        WebSession::unsetProperty("cargo__cargactivas");
        return "success";       
    }
}
?>	
