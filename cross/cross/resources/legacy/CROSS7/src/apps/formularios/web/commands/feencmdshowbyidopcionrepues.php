<?php
/*
 // you can define the commando extending the WebCommand

 require_once "Web/WebCommand.php";
 class DefaultCommand extends WebCommand {
 }
 // really... is not neccesary extend the WebCommand
 */
require_once "Web/WebRequest.class.php";
Class FeEnCmdShowByIdOpcionrepues {

	function execute(){
		extract($_REQUEST);
		settype($objManager,"object");
		settype($rcData,"array");

		if(($opcionrepues__oprecodigon != NULL) && ($opcionrepues__oprecodigon != "")){
			$objManager = Application::getDomainController('OpcionrepuesManager');
			$objManager->setOprecodigon($opcionrepues__oprecodigon);
			$objManager->getByIdOpcionrepues();
			$rcData =  $objManager->getResult();
			 
			$_REQUEST["opcionrepues__oprecodigon"] = $rcData[0]["oprecodigon"];
			$_REQUEST["opcionrepues__morecodigon"] = $rcData[0]["morecodigon"];
			$_REQUEST["opcionrepues__opredescrisp"] = $rcData[0]["opredescrisp"];
			$_REQUEST["opcionrepues__opreactivas"] = $rcData[0]["opreactivas"];

		}else{

			$_REQUEST["opcionrepues__oprecodigon"] = WebSession::getProperty("opcionrepues__oprecodigon");
			$_REQUEST["opcionrepues__morecodigon"] = WebSession::getProperty("opcionrepues__morecodigon");
			$_REQUEST["opcionrepues__opredescrisp"] = WebSession::getProperty("opcionrepues__opredescrisp");
			$_REQUEST["opcionrepues__opreactivas"] = WebSession::getProperty("opcionrepues__opreactivas");
		}

		WebSession::unsetProperty("opcionrepues__oprecodigon");
		WebSession::unsetProperty("opcionrepues__morecodigon");
		WebSession::unsetProperty("opcionrepues__opredescrisp");
		WebSession::unsetProperty("opcionrepues__opreactivas");

		return "success";
	}
}
?>