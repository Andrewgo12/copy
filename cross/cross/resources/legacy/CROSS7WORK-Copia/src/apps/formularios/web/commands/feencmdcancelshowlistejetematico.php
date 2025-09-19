<?php
/*
 // you can define the commando extending the WebCommand
 require_once "Web/WebCommand.php";
 class DefaultCommand extends WebCommand {
 }
 // really... is not neccesary extend the WebCommand
 */
require_once "Web/WebRequest.class.php";
class FeEnCmdCancelShowListEjetematico {
	function execute(){
		$_REQUEST["ejetematico__ejtecodigon"] = WebSession::getProperty("ejetematico__ejtecodigon");
		$_REQUEST["ejetematico__ejtenombres"] = WebSession::getProperty("ejetematico__ejtenombres");
		$_REQUEST["ejetematico__ejtedescrips"] = WebSession::getProperty("ejetematico__ejtedescrips");
		WebSession::unsetProperty("ejetematico__ejtecodigon");
		WebSession::unsetProperty("ejetematico__ejtenombres");
		WebSession::unsetProperty("ejetematico__ejtedescrips");
		return "success";
	}
}
?>