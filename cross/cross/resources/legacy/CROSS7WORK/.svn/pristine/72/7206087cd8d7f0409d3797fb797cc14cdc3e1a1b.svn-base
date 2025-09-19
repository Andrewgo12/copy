<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdShowByIdIpsservicio {
    function execute()
    {
    	settype($objManager,"object");
    	settype($rcData,"array");
        extract($_REQUEST);
        if(($ipsservicio__ipsecodigos != NULL) && ($ipsservicio__ipsecodigos != "")){
           $objManager = Application::getDomainController('IpsservicioManager'); 
           $rcData = $objManager->getByIdIpsservicio($ipsservicio__ipsecodigos); 
           $_REQUEST["ipsservicio__ipsecodigos"] = $rcData[0]["ipsecodigos"];
           $_REQUEST["ipsservicio__ipsenombres"] = $rcData[0]["ipsenombres"];
           $_REQUEST["ipsservicio__ipsedescrips"] = $rcData[0]["ipsedescrips"];
           $_REQUEST["ipsservicio__ipseactivos"] = $rcData[0]["ipseactivos"];
        }else{
           $_REQUEST["ipsservicio__ipsecodigos"] = WebSession::getProperty("ipsservicio__ipsecodigos");
           $_REQUEST["ipsservicio__ipsenombres"] = WebSession::getProperty("ipsservicio__ipsenombres");
           $_REQUEST["ipsservicio__ipsedescrips"] = WebSession::getProperty("ipsservicio__ipsedescrips");
           $_REQUEST["ipsservicio__ipseactivos"] = WebSession::getProperty("ipsservicio__ipseactivos");
        }
        WebSession::unsetProperty("ipsservicio__ipsecodigos");
        WebSession::unsetProperty("ipsservicio__ipsenombres");
        WebSession::unsetProperty("ipsservicio__ipsedescrips");
        WebSession::unsetProperty("ipsservicio__ipseactivos");
        return "success";       
    }
}
?>