<?php
/*
 // you can define the commando extending the WebCommand
 require_once "Web/WebCommand.php";
 class DefaultCommand extends WebCommand {
 }
 // really... is not neccesary extend the WebCommand
 */
require_once "Web/WebRequest.class.php";
class FeGeCmdShowListEquivalencias {
	function execute(){
		
		settype($objDate,"object");
		
		extract($_REQUEST);
		if(!WebSession::issetProperty("equivalencias__equicodigon"))
		WebSession::setProperty("equivalencias__equicodigon",$equivalencias__equicodigon);
		if(!WebSession::issetProperty("equivalencias__equitablcros"))
		WebSession::setProperty("equivalencias__equitablcros",$equivalencias__equitablcros);
		if(!WebSession::issetProperty("equivalencias__equicampcros"))
		WebSession::setProperty("equivalencias__equicampcros",$equivalencias__equicampcros);
		if(!WebSession::issetProperty("equivalencias__equivalcros"))
		WebSession::setProperty("equivalencias__equivalcros",$equivalencias__equivalcros);
		if(!WebSession::issetProperty("equivalencias__equinomcros"))
		WebSession::setProperty("equivalencias__equinomcros",$equivalencias__equinomcros);
		if(!WebSession::issetProperty("equivalencias__equitabldocs"))
		WebSession::setProperty("equivalencias__equitabldocs",$equivalencias__equitabldocs);
		if(!WebSession::issetProperty("equivalencias__equicampdocs"))
		WebSession::setProperty("equivalencias__equicampdocs",$equivalencias__equicampdocs);
		if(!WebSession::issetProperty("equivalencias__equivaldocs"))
		WebSession::setProperty("equivalencias__equivaldocs",$equivalencias__equivaldocs);
		if(!WebSession::issetProperty("equivalencias__equinomdocs"))
		WebSession::setProperty("equivalencias__equinomdocs",$equivalencias__equinomdocs);
		 
		$objDate = Application :: loadServices("DateController");
		if(!WebSession::issetProperty("equivalencias__equifechacrn"))
		WebSession::setProperty("equivalencias__equifechacrn",$objDate->fncdatehourtoint($equivalencias__equifechacrn));
		if(!WebSession::issetProperty("equivalencias__equiestados"))
		WebSession::setProperty("equivalencias__equiestados",$equivalencias__equiestados);
		
		if(!WebSession::issetProperty("equivalencias__equiareacros"))
		WebSession::setProperty("equivalencias__equiareacros",$equivalencias__equiareacros);
		if(!WebSession::issetProperty("equivalencias__equiareadocs"))
		WebSession::setProperty("equivalencias__equiareadocs",$equivalencias__equiareadocs);
		if(!WebSession::issetProperty("equivalencias__equiseridocs"))
		WebSession::setProperty("equivalencias__equiseridocs",$equivalencias__equiseridocs);
		
		return "success";
	}
}
?>