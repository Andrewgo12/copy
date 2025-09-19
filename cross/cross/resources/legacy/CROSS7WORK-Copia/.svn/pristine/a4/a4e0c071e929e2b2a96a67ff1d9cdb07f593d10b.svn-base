<?php
/*
 // you can define the commando extending the WebCommand

 require_once "Web/WebCommand.php";
 class DefaultCommand extends WebCommand {
 }
 // really... is not neccesary extend the WebCommand
 */
require_once "Web/WebRequest.class.php";
Class FeEnCmdShowListModeloresp {

	function execute(){
		
		extract($_REQUEST);
		settype($objService,"object");

		$objService = Application :: loadServices("Data_type");
		if ($modeloresp__morenombres)
		$_REQUEST["modeloresp__morenombres"] = $objService->formatString($modeloresp__morenombres);
		if ($modeloresp__moredescrips)
		$_REQUEST["modeloresp__moredescrips"] = $objService->formatString($modeloresp__moredescrips);
			
		if(!WebSession::issetProperty("modeloresp__morecodigon"))
		WebSession::setProperty("modeloresp__morecodigon",$modeloresp__morecodigon);

		if(!WebSession::issetProperty("modeloresp__morenombres"))
		WebSession::setProperty("modeloresp__morenombres",$modeloresp__morenombres);

		if(!WebSession::issetProperty("modeloresp__moredescrips"))
		WebSession::setProperty("modeloresp__moredescrips",$modeloresp__moredescrips);

		if(isset($_REQUEST["sqlConsult"])){
			$_REQUEST["sqlConsult"] = null;
		}
		return "success";
	}
}
?>