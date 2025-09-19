<?php 
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
Class FeGeCmdDeleteFormatocarta {

	function execute() {
		extract($_REQUEST);

		if (($formatocarta__focacodigos != NULL) && ($formatocarta__focacodigos != "")) {
			$formatocarta_manager = Application :: getDomainController('FormatocartaManager');
			$message = $formatocarta_manager->deleteFormatocarta($formatocarta__focacodigos);
			WebRequest :: setProperty('cod_message', $message);
			return "success";
		} else {
			WebRequest :: setProperty('cod_message', $message = 0);
			return "fail";
		}
	}
}
?>	