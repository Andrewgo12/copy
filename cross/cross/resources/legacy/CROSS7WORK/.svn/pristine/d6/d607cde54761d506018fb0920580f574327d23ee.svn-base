<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdShowByIdMovimialmace {
    function execute()
    {
        extract($_REQUEST);
        if(($movimialmace__moalcodigos != NULL) && ($movimialmace__moalcodigos != "")){
           $movimialmace_manager = Application::getDomainController('MovimialmaceManager'); 
           $movimialmace_data = $movimialmace_manager->getByIdMovimialmace($movimialmace__moalcodigos); 
           $_REQUEST["movimialmace__moalcodigos"] = $movimialmace_data[0]["moalcodigos"];
           $_REQUEST["movimialmace__bodecodigos"] = $movimialmace_data[0]["bodecodigos"];
           $_REQUEST["movimialmace__recucodigos"] = $movimialmace_data[0]["recucodigos"];
           $_REQUEST["movimialmace__moalfechmovd"] = $movimialmace_data[0]["moalfechmovd"];
           $_REQUEST["movimialmace__comocodigos"] = $movimialmace_data[0]["comocodigos"];
           $_REQUEST["movimialmace__moalcantrecf"] = $movimialmace_data[0]["moalcantrecf"];
           $_REQUEST["movimialmace__perscodigos"] = $movimialmace_data[0]["perscodigos"];
           $_REQUEST["movimialmace__tidocodigos"] = $movimialmace_data[0]["tidocodigos"];
           $_REQUEST["movimialmace__moalnumedocs"] = $movimialmace_data[0]["moalnumedocs"];
           $_REQUEST["movimialmace__moalsignos"] = $movimialmace_data[0]["moalsignos"];
        }else{
           $_REQUEST["movimialmace__moalcodigos"] = WebSession::getProperty("movimialmace__moalcodigos");
           $_REQUEST["movimialmace__bodecodigos"] = WebSession::getProperty("movimialmace__bodecodigos");
           $_REQUEST["movimialmace__recucodigos"] = WebSession::getProperty("movimialmace__recucodigos");
           $_REQUEST["movimialmace__moalfechmovd"] = WebSession::getProperty("movimialmace__moalfechmovd");
           $_REQUEST["movimialmace__comocodigos"] = WebSession::getProperty("movimialmace__comocodigos");
           $_REQUEST["movimialmace__moalcantrecf"] = WebSession::getProperty("movimialmace__moalcantrecf");
           $_REQUEST["movimialmace__perscodigos"] = WebSession::getProperty("movimialmace__perscodigos");
           $_REQUEST["movimialmace__tidocodigos"] = WebSession::getProperty("movimialmace__tidocodigos");
           $_REQUEST["movimialmace__moalnumedocs"] = WebSession::getProperty("movimialmace__moalnumedocs");
           $_REQUEST["movimialmace__moalsignos"] = WebSession::getProperty("movimialmace__moalsignos");		
        }
        WebSession::unsetProperty("movimialmace__moalcodigos");
        WebSession::unsetProperty("movimialmace__bodecodigos");
        WebSession::unsetProperty("movimialmace__recucodigos");
        WebSession::unsetProperty("movimialmace__moalfechmovd");
        WebSession::unsetProperty("movimialmace__comocodigos");
        WebSession::unsetProperty("movimialmace__moalcantrecf");
        WebSession::unsetProperty("movimialmace__perscodigos");
        WebSession::unsetProperty("movimialmace__tidocodigos");
        WebSession::unsetProperty("movimialmace__moalnumedocs");
        WebSession::unsetProperty("movimialmace__moalsignos");
        return "success";       
    }
}
?>	
