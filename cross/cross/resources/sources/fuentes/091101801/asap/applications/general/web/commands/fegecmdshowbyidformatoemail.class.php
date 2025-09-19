<?php
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
Class FeGeCmdShowByIdFormatoemail {

    function execute()
    {
        extract($_REQUEST);

        if(($formatoemail__foemcodigos != NULL) && ($formatoemail__foemcodigos != "")){
           $formatoemail_manager = Application::getDomainController('FormatoemailManager'); 
           $formatoemail_data = $formatoemail_manager->getByIdFormatoemail($formatoemail__foemcodigos); 
           
           $_REQUEST["formatoemail__foemcodigos"] = $formatoemail_data[0]["foemcodigos"];
           $_REQUEST["formatoemail__foemnombres"] = $formatoemail_data[0]["foemnombres"];
           $_REQUEST["formatoemail__foemasuntos"] = $formatoemail_data[0]["foemasuntos"];
           $_REQUEST["formatoemail__foemplantils"] = $formatoemail_data[0]["foemplantils"];
           $_REQUEST["formatoemail__foemestados"] = $formatoemail_data[0]["foemestados"];

        }else{
		
           $_REQUEST["formatoemail__foemcodigos"] = WebSession::getProperty("formatoemail__foemcodigos");
           $_REQUEST["formatoemail__foemnombres"] = WebSession::getProperty("formatoemail__foemnombres");
           $_REQUEST["formatoemail__foemasuntos"] = WebSession::getProperty("formatoemail__foemasuntos");
           $_REQUEST["formatoemail__foemplantils"] = WebSession::getProperty("formatoemail__foemplantils");
           $_REQUEST["formatoemail__foemestados"] = WebSession::getProperty("formatoemail__foemestados");		
        }
		
        WebSession::unsetProperty("formatoemail__foemcodigos");
        WebSession::unsetProperty("formatoemail__foemnombres");
        WebSession::unsetProperty("formatoemail__foemasuntos");
        WebSession::unsetProperty("formatoemail__foemplantils");
        WebSession::unsetProperty("formatoemail__foemestados");

        return "success";       
    }
}
?>	