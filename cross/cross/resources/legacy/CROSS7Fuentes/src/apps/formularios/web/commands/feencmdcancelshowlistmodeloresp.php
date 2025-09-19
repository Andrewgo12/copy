<?php
/*
 // you can define the commando extending the WebCommand
 require_once "Web/WebCommand.php";
 class DefaultCommand extends WebCommand {
 }
 // really... is not neccesary extend the WebCommand
 */
require_once "Web/WebRequest.class.php";
class FeEnCmdCancelShowListModeloresp {
	function execute(){
		$_REQUEST["modeloresp__morecodigon"] = WebSession::getProperty("modeloresp__morecodigon");
		$_REQUEST["modeloresp__morenombres"] = WebSession::getProperty("modeloresp__morenombres");
		$_REQUEST["modeloresp__moredescrips"] = WebSession::getProperty("modeloresp__moredescrips");
		WebSession::unsetProperty("modeloresp__morecodigon");
		WebSession::unsetProperty("modeloresp__morenombres");
		WebSession::unsetProperty("modeloresp__moredescrips");
		return "success";
	}
}
?>