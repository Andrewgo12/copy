<?php 
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeGeCmdBackup {
	function execute() {
		$databasesManager = Application :: getDomainController('DatabasesManager');
        $sbmessage = $databasesManager->getBackup();
        WebRequest :: setProperty('cod_message', $sbmessage);
		return "success";
	}
}
?>