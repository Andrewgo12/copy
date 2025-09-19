<?php

/*
 // you can define the commando extending the WebCommand

 require_once "Web/WebCommand.php";
 class DefaultCommand extends WebCommand {
 }
 // really... is not neccesary extend the WebCommand
 */

require_once "Web/WebRequest.class.php";

Class FeGeCmdDefaultNuevaDescripcion {

	function execute(){
		extract($_REQUEST);
		//SI limpia el $_REQUEST
		if($clean_table){
			$this->UnsetRequest();
			unset($_REQUEST["clean_table"]);
		}
		WebSession :: unsetProperty("_rcEncuesta");
		return "success";
	}
	function UnsetRequest() {
		settype($sbKey,"string");
		settype($sbValue,"string");
		foreach ($_REQUEST as $sbKey => $sbValue) {
			if (strpos($sbKey,"__")!==false)
				unset ($_REQUEST[$sbKey]);
		}
	}
}
?>