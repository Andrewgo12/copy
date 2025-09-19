<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdAddImportarLeads {
    function execute()
    {
		extract($_REQUEST);
		
   		chmod($_FILES['importfile']['tmp_name'] ,  0644);
		
		$manager = Application::getDomainController("ContactoManager");
		$transaccion = $manager->importarContactos($_FILES['importfile']['tmp_name']);
		
		if(!$transaccion) {
			WebRequest :: setProperty('cod_message', $message = 4);
			return "fail";
		}
		else {
			WebRequest :: setProperty('cod_message', $message = 3);
			return "success";
		}
    }
}
?>