<?php
/*
 // you can define the commando extending the WebCommand

 require_once "Web/WebCommand.php";
 class DefaultCommand extends WebCommand {
 }
 // really... is not neccesary extend the WebCommand
 */
require_once "Web/WebRequest.class.php";
Class FeEnCmdDefaultReport{
	function execute(){
		extract($_REQUEST);
		settype($sbKey,"string");
		settype($sbValue,"string");
		//SI limpia el $_REQUEST
		if($clean_table){
			foreach ($_REQUEST as $sbKey => $sbValue) {
				if (strpos($sbKey,"__")!==false)
				unset ($_REQUEST[$sbKey]);
			}
			unset($_REQUEST["cod_message"]);
			unset($_REQUEST["clean_table"]);
		}
		return "success";
	}
}
?>