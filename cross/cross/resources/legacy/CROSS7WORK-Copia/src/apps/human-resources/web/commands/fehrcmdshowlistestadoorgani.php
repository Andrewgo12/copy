<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeHrCmdShowListEstadoorgani {
    function execute()
    {
       settype($objService,"object");
		extract($_REQUEST);
		
		$objService = Application :: loadServices("Data_type");
		if($estadoorgani__esornombres){
			$_REQUEST["estadoorgani__esornombres"] = $objService->formatString($estadoorgani__esornombres);
		}
		if($estadoorgani__esordescrips){
			$_REQUEST["estadoorgani__esordescrips"] = $objService->formatString($estadoorgani__esordescrips);
		}
		
       if(!WebSession::issetProperty("estadoorgani__esorcodigos"))
           WebSession::setProperty("estadoorgani__esorcodigos",$estadoorgani__esorcodigos);
       if(!WebSession::issetProperty("estadoorgani__esornombres"))
           WebSession::setProperty("estadoorgani__esornombres",$estadoorgani__esornombres);
       if(!WebSession::issetProperty("estadoorgani__esordescrips"))
           WebSession::setProperty("estadoorgani__esordescrips",$estadoorgani__esordescrips);
       if(!WebSession::issetProperty("estadoorgani__esoractivas"))
           WebSession::setProperty("estadoorgani__esoractivas",$estadoorgani__esoractivas);
        return "success";  
    }
}
?>	
