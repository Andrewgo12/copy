<?php 
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCrCmdDefaultActuacionCompromiso {
	function execute() {
		extract($_REQUEST);
		//SI limpia el $_REQUEST
		if (($clean_table)) {
			unset ($_REQUEST["orden__ordenumeros"]);
			unset ($_REQUEST["orden"]);
			unset ($_REQUEST["acta"]);
			unset ($_REQUEST["acemnumeros"]);
			unset ($_REQUEST["clean_table"]);
		}
		if($_REQUEST["message"]){
			WebRequest :: setProperty('cod_message', $message);
			WebRequest :: setProperty('param', $_REQUEST["orden"]);
			unset ($_REQUEST["orden"]);
		}
		return "success";
	}
}
?>	