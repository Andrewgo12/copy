<?php       
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeGeCmdAddDatosAdicionalesWeb {
	function execute() {
		extract($_REQUEST);
		
		if (($dedinombres != NULL) && ($dedinombres != "") && 
		($deditipodats != NULL) && ($deditipodats != "") &&
		($deditamtips != NULL) && ($deditamtips != "") &&
		($deditipobjes != NULL) && ($deditipobjes != "") &&
		($dedinotnulls != NULL) && ($dedinotnulls != "") &&
		($dediordenn != NULL) && ($dediordenn != "")) {
			
			if(!isset($dimecodigon) || !$dimecodigon) {
				
				//GUARDAR dimension
				
				//GUARDAR configdimension
				
			}
			
			$manager = Application::getDomainController("DimensionManager");
			$result = $manager->addDetalles($_REQUEST);
			
			if(!$result)
				$message = 1;
			else {
				$message = 3;
				$this->unsetRequest();
			}
			WebRequest :: setProperty('cod_message', $message);
			return "success";
		} else {
			WebRequest :: setProperty('cod_message', $message = 0);
			return "fail";
		}
	}
	
	function unsetRequest() {
		unset($_REQUEST["dedinombres"]);
		unset($_REQUEST["deditipodats"]);
		unset($_REQUEST["deditamtips"]);
		unset($_REQUEST["deditipobjes"]);
		unset($_REQUEST["dedinotnulls"]);
		unset($_REQUEST["dediordenn"]);
	}
}
?>