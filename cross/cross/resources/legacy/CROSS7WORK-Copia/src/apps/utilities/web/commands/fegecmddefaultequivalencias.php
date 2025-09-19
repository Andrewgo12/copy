<?php
/*
 // you can define the commando extending the WebCommand
 require_once "Web/WebCommand.php";
 class DefaultCommand extends WebCommand {
 }
 // really... is not neccesary extend the WebCommand
 */
require_once "Web/WebRequest.class.php";
class FeGeCmdDefaultEquivalencias {
	function execute(){
		
		settype($objManager,"object");
		extract($_REQUEST);
		//SI limpia el $_REQUEST
		if($clean_table){
			$objManager = Application::getDomainController("EquivalenciasManager");
			$objManager->UnsetRequest();
			unset($_REQUEST["clean_table"]);
		}
		return "success";
	}
}
?>