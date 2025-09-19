<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeCuCmdShowByIdInfractor {

    function execute()
    {
        extract($_REQUEST);

        if(($infractor__infrcodigos != NULL) && ($infractor__infrcodigos != "")){
           $infractor_manager = Application::getDomainController('InfractorManager'); 
           $infractor_data = $infractor_manager->getByIdInfractor($infractor__infrcodigos); 
           
           $_REQUEST["infractor__tiidcodigos"] = $infractor_data[0]["tiidcodigos"];
           $_REQUEST["infractor__infrcodigos"] = $infractor_data[0]["infrcodigos"];
           $_REQUEST["infractor__ticlcodigos"] = $infractor_data[0]["ticlcodigos"];
           $_REQUEST["infractor__infrnombres"] = $infractor_data[0]["infrnombres"];
           $_REQUEST["infractor__infrrepreses"] = $infractor_data[0]["infrrepreses"];
           $_REQUEST["infractor__infrlocalizs"] = $infractor_data[0]["infrlocalizs"];
           $_REQUEST["infractor__infrtelefons"] = $infractor_data[0]["infrtelefons"];
           $_REQUEST["infractor__locacodigos"] = $infractor_data[0]["locacodigos"];
           $_REQUEST["infractor__infrnumfaxs"] = $infractor_data[0]["infrnumfaxs"];
           $_REQUEST["infractor__infractivas"] = $infractor_data[0]["infractivas"];

        }else{
		
           $_REQUEST["infractor__tiidcodigos"] = WebSession::getProperty("infractor__tiidcodigos");
           $_REQUEST["infractor__infrcodigos"] = WebSession::getProperty("infractor__infrcodigos");
           $_REQUEST["infractor__ticlcodigos"] = WebSession::getProperty("infractor__ticlcodigos");
           $_REQUEST["infractor__infrnombres"] = WebSession::getProperty("infractor__infrnombres");
           $_REQUEST["infractor__infrrepreses"] = WebSession::getProperty("infractor__infrrepreses");
           $_REQUEST["infractor__infrlocalizs"] = WebSession::getProperty("infractor__infrlocalizs");
           $_REQUEST["infractor__infrtelefons"] = WebSession::getProperty("infractor__infrtelefons");
           $_REQUEST["infractor__locacodigos"] = WebSession::getProperty("infractor__locacodigos");
           $_REQUEST["infractor__infrnumfaxs"] = WebSession::getProperty("infractor__infrnumfaxs");
           $_REQUEST["infractor__infractivas"] = WebSession::getProperty("infractor__infractivas");		
        }
		
        WebSession::unsetProperty("infractor__tiidcodigos");
        WebSession::unsetProperty("infractor__infrcodigos");
        WebSession::unsetProperty("infractor__ticlcodigos");
        WebSession::unsetProperty("infractor__infrnombres");
        WebSession::unsetProperty("infractor__infrrepreses");
        WebSession::unsetProperty("infractor__infrlocalizs");
        WebSession::unsetProperty("infractor__infrtelefons");
        WebSession::unsetProperty("infractor__locacodigos");
        WebSession::unsetProperty("infractor__infrnumfaxs");
        WebSession::unsetProperty("infractor__infractivas");

        return "success";       
    }

}

?>	
