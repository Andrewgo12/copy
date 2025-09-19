<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeCrCmdShowByIdCompromiso {

    function execute()
    {
        extract($_REQUEST);

        if($compromiso__compcodigos){
           $compromiso_manager = Application::getDomainController('CompromisoManager'); 
           $compromiso_data = $compromiso_manager->getByIdCompromiso($compromiso__compcodigos); 
           
           $_REQUEST["compromiso__compcodigos"] = $compromiso_data[0]["compcodigos"];
           $_REQUEST["compromiso__compdescris"] = $compromiso_data[0]["compdescris"];
           $_REQUEST["compromiso__compactivos"] = $compromiso_data[0]["compactivos"];

        }else{
		
           $_REQUEST["compromiso__compcodigos"] = WebSession::getProperty("compromiso__compcodigos");
           $_REQUEST["compromiso__compdescris"] = WebSession::getProperty("compromiso__compdescris");
           $_REQUEST["compromiso__compactivos"] = WebSession::getProperty("compromiso__compactivos");		
        }
		
        WebSession::unsetProperty("compromiso__compcodigos");
        WebSession::unsetProperty("compromiso__compdescris");
        WebSession::unsetProperty("compromiso__compactivos");

        return "success";       
    }

}

?>	
