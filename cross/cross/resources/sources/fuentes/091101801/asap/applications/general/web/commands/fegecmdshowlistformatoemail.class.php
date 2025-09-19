<?php
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
Class FeGeCmdShowListFormatoemail {

    function execute()
    {
       extract($_REQUEST);
       
       $objServ = Application::loadServices("Data_type");
       	if($formatoemail__foemnombres)
		$_REQUEST["formatoemail__foemnombres"] = $objServ->formatString($formatoemail__foemnombres);
		if($formatoemail__foemasuntos)
		$_REQUEST["formatoemail__foemasuntos"] = $objServ->formatString($formatoemail__foemasuntos);
		if($formatoemail__foemplantils)
		$_REQUEST["formatoemail__foemplantils"] = $objServ->formatString($formatoemail__foemplantils);
		
       if(!WebSession::issetProperty("formatoemail__foemcodigos"))
           WebSession::setProperty("formatoemail__foemcodigos",$formatoemail__foemcodigos);

       if(!WebSession::issetProperty("formatoemail__foemnombres"))
           WebSession::setProperty("formatoemail__foemnombres",$formatoemail__foemnombres);
           
       if(!WebSession::issetProperty("formatoemail__foemasuntos"))
           WebSession::setProperty("formatoemail__foemasuntos",$formatoemail__foemasuntos);

       if(!WebSession::issetProperty("formatoemail__foemplantils"))
           WebSession::setProperty("formatoemail__foemplantils",$formatoemail__foemplantils);

       if(!WebSession::issetProperty("formatoemail__foemestados"))
           WebSession::setProperty("formatoemail__foemestados",$formatoemail__foemestados);

        return "success";  
    }
}
?>