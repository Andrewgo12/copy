<?php       
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeGeCmdDeleteDetalledimens {
	function execute() {
		extract($_REQUEST);
		
		if (($detalledimens__dedinombres != NULL) && ($detalledimens__dedinombres != "") && 
		($detalledimens__dimecodigon != NULL) && ($detalledimens__dimecodigon != "")) {
			
			$manager = Application::getDomainController("DimensionManager");
			$result = $manager->deleteDetalledimens($detalledimens__dimecodigon,$detalledimens__dedinombres);
			
			if(!$result)
				$message = 100;
			else
				$message = 3;

			WebRequest :: setProperty('cod_message', $message);
			return "success";
		} else {
			WebRequest :: setProperty('cod_message', $message = 0);
			return "fail";
		}
	}
}
?>