<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeEnCmdShowByIdTema {

    function execute(){
    	
        extract($_REQUEST);
        settype($objManager,"object");
        settype($rcData,"array");

        if(($tema__temacodigon != NULL) && ($tema__temacodigon != "")){
           $objManager = Application::getDomainController('TemaManager'); 
           $rcData = $objManager->getByIdTema($tema__temacodigon); 
           
           $_REQUEST["tema__temacodigon"] = $rcData[0]["temacodigon"];
           $_REQUEST["tema__ejtecodigon"] = $rcData[0]["ejtecodigon"];
           $_REQUEST["tema__temanombres"] = $rcData[0]["temanombres"];
           $_REQUEST["tema__temadescrips"] = $rcData[0]["temadescrips"];

        }else{
		
           $_REQUEST["tema__temacodigon"] = WebSession::getProperty("tema__temacodigon");
           $_REQUEST["tema__ejtecodigon"] = WebSession::getProperty("tema__ejtecodigon");
           $_REQUEST["tema__temanombres"] = WebSession::getProperty("tema__temanombres");
           $_REQUEST["tema__temadescrips"] = WebSession::getProperty("tema__temadescrips");		
        }
		
        WebSession::unsetProperty("tema__temacodigon");
        WebSession::unsetProperty("tema__ejtecodigon");
        WebSession::unsetProperty("tema__temanombres");
        WebSession::unsetProperty("tema__temadescrips");

        return "success";       
    }
}
?>