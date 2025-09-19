<?php 
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeGeCmdCentroEmailDelete {
	function execute() {
		
		settype($objCentroEmail,"object");
		settype($rcemaicodigos,"array");
		settype($sbemaicodigos,"string");
		settype($sbmessage,"string");
		
		$sbemaicodigos = $_REQUEST["selectcheck"];
		if($sbemaicodigos){
			
			$rcemaicodigos = explode(",",$sbemaicodigos);
			$objCentroEmail = Application :: getDomainController('CentroEmailManager');
			$sbmessage = $objCentroEmail->fncDeleteEmailSet($rcemaicodigos);
			WebRequest :: setProperty('cod_message', $sbmessage);
			return "success";
		}
		$sbmessage = 20;
		WebRequest :: setProperty('cod_message', $sbmessage);
		return "fail";
	}
}
?>	