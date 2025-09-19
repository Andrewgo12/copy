<?php
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
Class FeGeCmdCancelShowListFormatoemail {

    function execute()
    {
        
        $_REQUEST["formatoemail__foemcodigos"] = WebSession::getProperty("formatoemail__foemcodigos");
        $_REQUEST["formatoemail__foemnombres"] = WebSession::getProperty("formatoemail__foemnombres");
        $_REQUEST["formatoemail__foemasuntos"] = WebSession::getProperty("formatoemail__foemasuntos");
        $_REQUEST["formatoemail__foemplantils"] = WebSession::getProperty("formatoemail__foemplantils");
        $_REQUEST["formatoemail__foemestados"] = WebSession::getProperty("formatoemail__foemestados");
	    
        WebSession::unsetProperty("formatoemail__foemcodigos");
        WebSession::unsetProperty("formatoemail__foemnombres");
        WebSession::unsetProperty("formatoemail__foemasuntos");
        WebSession::unsetProperty("formatoemail__foemplantils");
        WebSession::unsetProperty("formatoemail__foemestados");
		
        return "success";  
    }
}
?>	