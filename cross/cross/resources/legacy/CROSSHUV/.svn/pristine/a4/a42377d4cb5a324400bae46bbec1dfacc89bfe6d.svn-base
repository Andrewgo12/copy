<?php
/*
 // you can define the commando extending the WebCommand
 require_once "Web/WebCommand.php";
 class DefaultCommand extends WebCommand {
 }
 // really... is not neccesary extend the WebCommand
 */
require_once "Web/WebRequest.class.php";
class FeEnCmdCancelShowListPregunta {
	function execute(){
		$_REQUEST["pregunta__pregcodigon"] = WebSession::getProperty("pregunta__pregcodigon");
		$_REQUEST["pregunta__pregdescris"] = WebSession::getProperty("pregunta__pregdescris");
		$_REQUEST["pregunta__temacodigon"] = WebSession::getProperty("pregunta__temacodigon");
		$_REQUEST["pregunta__morecodigon"] = WebSession::getProperty("pregunta__morecodigon");
		$_REQUEST["pregunta__pregtipopres"] = WebSession::getProperty("pregunta__pregtipopres");
		$_REQUEST["pregunta__pregactivas"] = WebSession::getProperty("pregunta__pregactivas");
		
		WebSession::unsetProperty("pregunta__pregcodigon");
		WebSession::unsetProperty("pregunta__pregdescris");
		WebSession::unsetProperty("pregunta__temacodigon");
		WebSession::unsetProperty("pregunta__morecodigon");
		WebSession::unsetProperty("pregunta__pregtipopres");
		WebSession::unsetProperty("pregunta__pregactivas");
		return "success";
	}
}
?>