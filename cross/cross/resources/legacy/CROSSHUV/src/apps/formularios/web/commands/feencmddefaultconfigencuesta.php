<?php

/*
 // you can define the commando extending the WebCommand

 require_once "Web/WebCommand.php";
 class DefaultCommand extends WebCommand {
 }
 // really... is not neccesary extend the WebCommand
 */

require_once "Web/WebRequest.class.php";

Class FeEnCmdDefaultConfigEncuesta {

	function execute(){
		extract($_REQUEST);
		//SI limpia el $_REQUEST
		if($clean_table){
			unset($_REQUEST["clean_table"]);
		}
		
		WebSession :: unsetProperty("_rcConfigEncuesta");
		WebSession :: unsetProperty("_rcAnswer");
		
		return "success";
	}
}
?>