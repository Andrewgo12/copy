<?php
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
Class FeGeCmdShowListFormatocarta {

    function execute()
    {
       extract($_REQUEST);
       
       $objServ = Application::loadServices("Data_type");
		if($formatocarta__focanombres)
		$_REQUEST["formatocarta__focanombres"] = $objServ->formatString($formatocarta__focanombres);
		if($formatocarta__focaplantils)
		$_REQUEST["formatocarta__focaplantils"] = $objServ->formatString($formatocarta__focaplantils);
		
       if(!WebSession::issetProperty("formatocarta__focacodigos"))
           WebSession::setProperty("formatocarta__focacodigos",$formatocarta__focacodigos);

       if(!WebSession::issetProperty("formatocarta__focanombres"))
           WebSession::setProperty("formatocarta__focanombres",$formatocarta__focanombres);

       if(!WebSession::issetProperty("formatocarta__focaplantils"))
           WebSession::setProperty("formatocarta__focaplantils",$formatocarta__focaplantils);

       if(!WebSession::issetProperty("formatocarta__focaestados"))
           WebSession::setProperty("formatocarta__focaestados",$formatocarta__focaestados);

        return "success";  
    }
}
?>