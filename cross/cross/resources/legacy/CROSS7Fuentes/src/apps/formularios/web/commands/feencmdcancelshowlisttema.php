<?php
/*
 // you can define the commando extending the WebCommand
 require_once "Web/WebCommand.php";
 class DefaultCommand extends WebCommand {
 }
 // really... is not neccesary extend the WebCommand
 */
require_once "Web/WebRequest.class.php";
class FeEnCmdCancelShowListTema {
	function execute(){
		$_REQUEST["tema__temacodigon"] = WebSession::getProperty("tema__temacodigon");
		$_REQUEST["tema__temanombres"] = WebSession::getProperty("tema__temanombres");
		$_REQUEST["tema__temadescrips"] = WebSession::getProperty("tema__temadescrips");
		$_REQUEST["tema__ejtecodigon"] = WebSession::getProperty("tema__ejtecodigon");
		WebSession::unsetProperty("tema__temacodigon");
		WebSession::unsetProperty("tema__temanombres");
		WebSession::unsetProperty("tema__temadescrips");
		WebSession::unsetProperty("tema__ejtecodigon");
		return "success";
	}
}
?>