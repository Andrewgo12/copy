<?php
/*
 // you can define the commando extending the WebCommand
 require_once "Web/WebCommand.php";
 class DefaultCommand extends WebCommand {
 }
 // really... is not neccesary extend the WebCommand
 */
require_once "Web/WebRequest.class.php";
class FeGeCmdCancelShowListEquivalencias {
	function execute(){
		
		$_REQUEST["equivalencias__equicodigon"] = WebSession::getProperty("equivalencias__equicodigon");
		$_REQUEST["equivalencias__equitablcros"] = WebSession::getProperty("equivalencias__equitablcros");
		$_REQUEST["equivalencias__equicampcros"] = WebSession::getProperty("equivalencias__equicampcros");
		$_REQUEST["equivalencias__equivalcros"] = WebSession::getProperty("equivalencias__equivalcros");
		$_REQUEST["equivalencias__equinomcros"] = WebSession::getProperty("equivalencias__equinomcros");
		$_REQUEST["equivalencias__equitabldocs"] = WebSession::getProperty("equivalencias__equitabldocs");
		$_REQUEST["equivalencias__equicampdocs"] = WebSession::getProperty("equivalencias__equicampdocs");
		$_REQUEST["equivalencias__equivaldocs"] = WebSession::getProperty("equivalencias__equivaldocs");
		$_REQUEST["equivalencias__equinomdocs"] = WebSession::getProperty("equivalencias__equinomdocs");
		$_REQUEST["equivalencias__equifechacrn"] = WebSession::getProperty("equivalencias__equifechacrn");
		$_REQUEST["equivalencias__equiestados"] = WebSession::getProperty("equivalencias__equiestados");
		$_REQUEST["equivalencias__equiareacros"] = WebSession::getProperty("equivalencias__equiareacros");
		$_REQUEST["equivalencias__equiareacros"] = WebSession::getProperty("equiareacros_desc");
		$_REQUEST["equivalencias__equiareadocs"] = WebSession::getProperty("equivalencias__equiareadocs");
		$_REQUEST["equivalencias__equiseridocs"] = WebSession::getProperty("equivalencias__equiseridocs");
		WebSession::unsetProperty("equivalencias__equicodigon");
		WebSession::unsetProperty("equivalencias__equitablcros");
		WebSession::unsetProperty("equivalencias__equicampcros");
		WebSession::unsetProperty("equivalencias__equivalcros");
		WebSession::unsetProperty("equivalencias__equinomcros");
		WebSession::unsetProperty("equivalencias__equitabldocs");
		WebSession::unsetProperty("equivalencias__equicampdocs");
		WebSession::unsetProperty("equivalencias__equivaldocs");
		WebSession::unsetProperty("equivalencias__equinomdocs");
		WebSession::unsetProperty("equivalencias__equifechacrn");
		WebSession::unsetProperty("equivalencias__equiestados");
		WebSession::unsetProperty("equivalencias__equiareacros");
		WebSession::unsetProperty("equiareacros_desc");
		WebSession::unsetProperty("equivalencias__equiareadocs");
		WebSession::unsetProperty("equivalencias__equiseridocs");
		
		return "success";
	}
}
?>
