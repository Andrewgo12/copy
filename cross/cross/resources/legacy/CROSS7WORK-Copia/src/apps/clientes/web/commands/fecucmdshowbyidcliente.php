<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdShowByIdCliente {
    function execute()
    {
    	settype($objService,"object");
    	settype($objManager,"object");
    	settype($rcTmp,"array");
    	settype($rcData,"array");
        extract($_REQUEST);
        if(($cliente__cliecodigos != NULL) && ($cliente__cliecodigos != "")){
           $objManager = Application::getDomainController('ClienteManager'); 
           $rcData = $objManager->getByIdCliente($cliente__cliecodigos); 
           $_REQUEST["cliente__cliecodigos"] = $rcData[0]["cliecodigos"];
           $_REQUEST["cliente__clieidentifs"] = $rcData[0]["clieidentifs"];
           $_REQUEST["cliente__ticlcodigos"] = $rcData[0]["ticlcodigos"];
           $_REQUEST["cliente__clienombres"] = $rcData[0]["clienombres"];
           $_REQUEST["cliente__clierepprnos"] = $rcData[0]["clierepprnos"];
           $_REQUEST["cliente__clierepsenos"] = $rcData[0]["clierepsenos"];
           $_REQUEST["cliente__cliereppraps"] = $rcData[0]["cliereppraps"];
           $_REQUEST["cliente__clierepseaps"] = $rcData[0]["clierepseaps"];
           $_REQUEST["cliente__clielocalizs"] = $rcData[0]["clielocalizs"];
           $_REQUEST["cliente__clietelefons"] = $rcData[0]["clietelefons"];
           if($rcData[0]["locacodigos"]){
           		$objService = Application :: loadServices("General");
           		$_REQUEST["cliente__locacodigos"] = $rcData[0]["locacodigos"];
           		$rcTmp = $objService->getByIdLocalizacion($_REQUEST["cliente__locacodigos"]);
           		$_REQUEST["cliente_locacodigos_desc"] = $rcTmp[0]["locanombres"];
           }
           $_REQUEST["cliente__cliepagwebs"] = $rcData[0]["cliepagwebs"];
           $_REQUEST["cliente__cliemails"] = $rcData[0]["cliemails"];
           $_REQUEST["cliente__esclcodigos"] = $rcData[0]["esclcodigos"];
           $_REQUEST["cliente__tiidcodigos"] = $rcData[0]["tiidcodigos"];
           $_REQUEST["cliente__grclcodigos"] = $rcData[0]["grclcodigos"];
           $_REQUEST["cliente__clienumfaxs"] = $rcData[0]["clienumfaxs"];
           $_REQUEST["cliente__clieaparaers"] = $rcData[0]["clieaparaers"];
           $_REQUEST["cliente__clieactivas"] = $rcData[0]["clieactivas"];
        }else{
           $_REQUEST["cliente__cliecodigos"] = WebSession::getProperty("cliente__cliecodigos");
           $_REQUEST["cliente__clieidentifs"] = WebSession::getProperty("cliente__clieidentifs");
           $_REQUEST["cliente__ticlcodigos"] = WebSession::getProperty("cliente__ticlcodigos");
           $_REQUEST["cliente__clienombres"] = WebSession::getProperty("cliente__clienombres");
           $_REQUEST["cliente__clierepprnos"] = WebSession::getProperty("cliente__clierepprnos");
           $_REQUEST["cliente__clierepsenos"] = WebSession::getProperty("cliente__clierepsenos");
           $_REQUEST["cliente__cliereppraps"] = WebSession::getProperty("cliente__cliereppraps");
           $_REQUEST["cliente__clierepseaps"] = WebSession::getProperty("cliente__clierepseaps");
           $_REQUEST["cliente__clielocalizs"] = WebSession::getProperty("cliente__clielocalizs");
           $_REQUEST["cliente__clietelefons"] = WebSession::getProperty("cliente__clietelefons");
           $_REQUEST["cliente__locacodigos"] = WebSession::getProperty("cliente__locacodigos");
           $_REQUEST["cliente_locacodigos_desc"] = WebSession::getProperty("cliente_locacodigos_desc");
           $_REQUEST["cliente__cliepagwebs"] = WebSession::getProperty("cliente__cliepagwebs");
           $_REQUEST["cliente__cliemails"] = WebSession::getProperty("cliente__cliemails");
           $_REQUEST["cliente__esclcodigos"] = WebSession::getProperty("cliente__esclcodigos");
           $_REQUEST["cliente__tiidcodigos"] = WebSession::getProperty("cliente__tiidcodigos");
           $_REQUEST["cliente__grclcodigos"] = WebSession::getProperty("cliente__grclcodigos");
           $_REQUEST["cliente__clienumfaxs"] = WebSession::getProperty("cliente__clienumfaxs");
           $_REQUEST["cliente__clieaparaers"] = WebSession::getProperty("cliente__clieaparaers");		
           $_REQUEST["cliente__clieactivas"] = WebSession::getProperty("cliente__clieactivas");		
        }
        WebSession::unsetProperty("cliente__cliecodigos");
        WebSession::unsetProperty("cliente__clieidentifs");
        WebSession::unsetProperty("cliente__ticlcodigos");
        WebSession::unsetProperty("cliente__clienombres");
        WebSession::unsetProperty("cliente__clierepprnos");
        WebSession::unsetProperty("cliente__clierepsenos");
        WebSession::unsetProperty("cliente__cliereppraps");
        WebSession::unsetProperty("cliente__clierepseaps");
        WebSession::unsetProperty("cliente__clielocalizs");
        WebSession::unsetProperty("cliente__clietelefons");
        WebSession::unsetProperty("cliente__locacodigos");
        WebSession::unsetProperty("cliente_locacodigos_desc");
        WebSession::unsetProperty("cliente__cliepagwebs");
        WebSession::unsetProperty("cliente__cliemails");
        WebSession::unsetProperty("cliente__esclcodigos");
        WebSession::unsetProperty("cliente__tiidcodigos");
        WebSession::unsetProperty("cliente__grclcodigos");
        WebSession::unsetProperty("cliente__clienumfaxs");
        WebSession::unsetProperty("cliente__clieaparaers");
        WebSession::unsetProperty("cliente__clieactivas");
        return "success";       
    }
}
?>