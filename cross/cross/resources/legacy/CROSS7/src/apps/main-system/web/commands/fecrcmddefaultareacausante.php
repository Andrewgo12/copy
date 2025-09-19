<?php
/*
 // you can define the commando extending the WebCommand

 require_once "Web/WebCommand.php";
 class DefaultCommand extends WebCommand {
 }
 // really... is not neccesary extend the WebCommand
 */

require_once "Web/WebRequest.class.php";

Class FeCrCmdDefaultAreaCausante{

	function execute() {
		extract($_REQUEST);

		settype($sbKey,"string");
		settype($sbValue,"string");

		//SI limpia el $_REQUEST
		if ($clean_table) {
			foreach ($_REQUEST as $sbKey => $sbValue) {
				if (ereg("__", $sbKey))
				unset ($_REQUEST[$sbKey]);
			}
		}

		return "success";
	}
}
?>