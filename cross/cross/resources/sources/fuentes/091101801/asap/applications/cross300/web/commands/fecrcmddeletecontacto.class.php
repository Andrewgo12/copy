<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeCrCmdDeleteContacto {

	function execute() {

		settype($objService, "object");
		settype($objManager, "object");
		extract($_REQUEST);

		if (($contacto__contcodigon != NULL) && ($contacto__contcodigon != "")) {

			//Carga el servicio de customers
			$objService = Application :: loadServices("Customers");
			$objManager = $objService->loadManager('ContactoManager');
			$message = $objManager->deleteContacto($contacto__contcodigon);
			$objService->close();
			WebRequest :: setProperty('cod_message', $message);
			return "success";
		} else {
			WebRequest :: setProperty('cod_message', $message = 0);
			return "fail";
		}
	}

}
?>