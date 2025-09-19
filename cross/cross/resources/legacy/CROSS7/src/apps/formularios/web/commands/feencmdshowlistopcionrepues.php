<?php
/*
 // you can define the commando extending the WebCommand

 require_once "Web/WebCommand.php";
 class DefaultCommand extends WebCommand {
 }
 // really... is not neccesary extend the WebCommand
 */
require_once "Web/WebRequest.class.php";
Class FeEnCmdShowListOpcionrepues {

	function execute(){
		extract($_REQUEST);
		
		settype($objService,"object");

		$objService = Application :: loadServices("Data_type");
		if ($opcionrepues__opredescrisp){
			$_REQUEST["opcionrepues__opredescrisp"] = $objService->formatString($opcionrepues__opredescrisp);	
		}
			
		if(!WebSession::issetProperty("opcionrepues__oprecodigon"))
		WebSession::setProperty("opcionrepues__oprecodigon",$opcionrepues__oprecodigon);

		if(!WebSession::issetProperty("opcionrepues__morecodigon"))
		WebSession::setProperty("opcionrepues__morecodigon",$opcionrepues__morecodigon);

		if(!WebSession::issetProperty("opcionrepues__opredescrisp"))
		WebSession::setProperty("opcionrepues__opredescrisp",$opcionrepues__opredescrisp);

		if(!WebSession::issetProperty("opcionrepues__opreactivas"))
		WebSession::setProperty("opcionrepues__opreactivas",$opcionrepues__opreactivas);
		
		if(isset($_REQUEST["sqlConsult"])){
			$_REQUEST["sqlConsult"] = null;
		}

		return "success";
	}
}
?>