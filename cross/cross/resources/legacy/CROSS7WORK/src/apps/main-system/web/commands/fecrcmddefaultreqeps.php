<?php
/*
 // you can define the commando extending the WebCommand
 require_once "Web/WebCommand.php";
 class DefaultCommand extends WebCommand {
 }
 // really... is not neccesary extend the WebCommand
 */
require_once "Web/WebRequest.class.php";
class FeCrCmdDefaultReqeps {
	function execute() {
		extract($_REQUEST);
		//SI limpia el $_REQUEST
		if ($clean_table) {
			$this->UnsetRequest();
			unset ($_REQUEST["clean_table"]);
		}
		return "success";
	}
	function UnsetRequest() {
		foreach($_REQUEST as $key => $value){
			if(ereg("__",$key)){
				unset($_REQUEST["$key"]);
			}
		}
		unset($_REQUEST["evencodigos"]);
		unset($_REQUEST["causcodigos"]);
		return true;
	}
}
?>