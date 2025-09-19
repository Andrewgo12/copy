<?php 
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
Class FeGeCmdDeleteFormatoemail {

	function execute() {
		extract($_REQUEST);

		if (($formatoemail__foemcodigos != NULL) && ($formatoemail__foemcodigos != "")) {
			$formatoemail_manager = Application :: getDomainController('FormatoemailManager');
			$message = $formatoemail_manager->deleteFormatoemail($formatoemail__foemcodigos);
			WebRequest :: setProperty('cod_message', $message);
			return "success";
		} else {
			WebRequest :: setProperty('cod_message', $message = 0);
			return "fail";
		}
	}
}
?>