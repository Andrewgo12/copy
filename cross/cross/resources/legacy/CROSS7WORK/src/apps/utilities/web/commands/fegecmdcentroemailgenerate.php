<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeGeCmdCentroEmailGenerate {
	function execute() {

		settype($serviceDate, "object");
		settype($objCentroEmail, "object");
		settype($rctmp, "array");
		settype($sbmessage, "string");

		if ($_REQUEST["email__ordenumeros"]) {
			$rctmp["ordenumeros"] = $_REQUEST["email__ordenumeros"];
		}
		if ($_REQUEST["email__orgacodigos"]) {
			$rctmp["orgacodigos"] = $_REQUEST["email__orgacodigos"];
		}
		if ($_REQUEST["orden__ordefecregdi"] && $_REQUEST["orden__ordefecregdf"]) {
			$serviceDate = Application :: loadServices("DateController");
			$rctmp["ordefecregdi"] = $serviceDate->fncdatehourtoint($_REQUEST["orden__ordefecregdi"]);
			$rctmp["ordefecregdf"] = $serviceDate->fncdatehourtoint($_REQUEST["orden__ordefecregdf"]);
		}
		
		if ($rctmp) {
			
			$objCentroEmail = Application :: getDomainController('CentroEmailManager');
			$sbmessage = $objCentroEmail->fncGenerateEmailSet($rctmp);
			WebRequest :: setProperty('cod_message', $sbmessage);
			if($sbmessage != 3){
				unset($_REQUEST["email__ordenumeros"]);
				unset($_REQUEST["email__orgacodigos"]);
				unset($_REQUEST["orden__ordefecregdi"]);
				unset($_REQUEST["orden__ordefecregdf"]);
			}
			unset($_REQUEST["email__emaiestados"]);
			return "success";
		}
		$sbmessage = 22;
		WebRequest :: setProperty('cod_message', $sbmessage);
		return "fail";
	}
}
?>	