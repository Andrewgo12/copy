<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeWFCmdShowByIdEstadoproces {

    function execute()
    {
        extract($_REQUEST);

        if(($estadoproces__esprcodigos != NULL) && ($estadoproces__esprcodigos != "")){
           $estadoproces_manager = Application::getDomainController('EstadoprocesManager'); 
           $estadoproces_data = $estadoproces_manager->getByIdEstadoproces($estadoproces__esprcodigos); 
           
           $_REQUEST["estadoproces__esprcodigos"] = $estadoproces_data[0]["esprcodigos"];
           $_REQUEST["estadoproces__esprnombres"] = $estadoproces_data[0]["esprnombres"];
           $_REQUEST["estadoproces__esprdescrips"] = $estadoproces_data[0]["esprdescrips"];
           $_REQUEST["estadoproces__espractivas"] = $estadoproces_data[0]["espractivas"];

        }else{
		
           $_REQUEST["estadoproces__esprcodigos"] = WebSession::getProperty("estadoproces__esprcodigos");
           $_REQUEST["estadoproces__esprnombres"] = WebSession::getProperty("estadoproces__esprnombres");
           $_REQUEST["estadoproces__esprdescrips"] = WebSession::getProperty("estadoproces__esprdescrips");
           $_REQUEST["estadoproces__espractivas"] = WebSession::getProperty("estadoproces__espractivas");		
        }
		
        WebSession::unsetProperty("estadoproces__esprcodigos");
        WebSession::unsetProperty("estadoproces__esprnombres");
        WebSession::unsetProperty("estadoproces__esprdescrips");
        WebSession::unsetProperty("estadoproces__espractivas");

        return "success";       
    }

}

?>	
