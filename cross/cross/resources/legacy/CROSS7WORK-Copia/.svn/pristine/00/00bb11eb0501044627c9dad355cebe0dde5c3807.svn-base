<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeCrCmdDefaultContacto{

    function execute()
    {
		extract($_REQUEST);
		//SI limpia el $_REQUEST
		if (($clean_table)) {
			//Carga el servicio de customers
			$service = Application :: loadServices("Customers");
			$contacto_manager = $service->loadManager('ContactoManager');
			$contacto_manager->UnsetRequest();
			unset($_REQUEST["clean_table"]);
			$service->close();
		}
        return "success";  
    }

}

?>	
