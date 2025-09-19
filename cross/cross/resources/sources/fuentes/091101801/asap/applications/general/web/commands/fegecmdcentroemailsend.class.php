<?php 
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeGeCmdCentroEmailSend {
	function execute() {
		
		settype($objCentroEmail,"object");
		settype($rcemaicodigos,"array");
		settype($sbemaicodigos,"string");
		settype($sbmessage,"string");
		
		$sbemaicodigos = $_REQUEST["selectcheck"];
		if($sbemaicodigos){
			
			$rcemaicodigos = explode(",",$sbemaicodigos);
			$objCentroEmail = Application :: getDomainController('CentroEmailManager');
			$sbmessage = $objCentroEmail->fncSendEmailSet($rcemaicodigos);
			WebRequest :: setProperty('cod_message', $sbmessage);
			return "success";
		}
		$sbmessage = 18;
		WebRequest :: setProperty('cod_message', $sbmessage);
		return "fail";
	}
}
?>	