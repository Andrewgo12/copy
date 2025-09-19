<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeWFCmdShowListEstadoacta {
    function execute()
    {
       settype($objService, "object");
		extract($_REQUEST);
		$objService = Application :: loadServices("Data_type");
		if($estadoacta__esacnombres){
			$_REQUEST["estadoacta__esacnombres"] = $objService->formatString($estadoacta__esacnombres);
		}
		if($estadoacta__esacdescrips){
			$_REQUEST["estadoacta__esacdescrips"] = $objService->formatString($estadoacta__esacdescrips);
		}
       if(!WebSession::issetProperty("estadoacta__esaccodigos"))
           WebSession::setProperty("estadoacta__esaccodigos",$estadoacta__esaccodigos);
       if(!WebSession::issetProperty("estadoacta__esacnombres"))
           WebSession::setProperty("estadoacta__esacnombres",$estadoacta__esacnombres);
       if(!WebSession::issetProperty("estadoacta__esacdescrips"))
           WebSession::setProperty("estadoacta__esacdescrips",$estadoacta__esacdescrips);
       if(!WebSession::issetProperty("estadoacta__esacactivas"))
           WebSession::setProperty("estadoacta__esacactivas",$estadoacta__esacactivas);
        return "success";  
    }
}
?>