<?php
/*
 // you can define the commando extending the WebCommand
 require_once "Web/WebCommand.php";
 class DefaultCommand extends WebCommand {
 }
 // really... is not neccesary extend the WebCommand
 */
require_once "Web/WebRequest.class.php";
class FeEnCmdCancelShowListOpcionrepues {
	function execute(){
		$_REQUEST["opcionrepues__oprecodigon"] = WebSession::getProperty("opcionrepues__oprecodigon");
		$_REQUEST["opcionrepues__opredescrisp"] = WebSession::getProperty("opcionrepues__opredescrisp");
		$_REQUEST["opcionrepues__morecodigon"] = WebSession::getProperty("opcionrepues__morecodigon");
		$_REQUEST["opcionrepues__opreactivas"] = WebSession::getProperty("opcionrepues__opreactivas");
		WebSession::unsetProperty("opcionrepues__oprecodigon");
		WebSession::unsetProperty("opcionrepues__opredescrisp");
		WebSession::unsetProperty("opcionrepues__morecodigon");
		WebSession::unsetProperty("opcionrepues__opreactivas");
		return "success";
	}
}
?>