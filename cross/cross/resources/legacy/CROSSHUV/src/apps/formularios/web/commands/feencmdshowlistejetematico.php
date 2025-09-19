<?php
/*
 // you can define the commando extending the WebCommand

 require_once "Web/WebCommand.php";
 class DefaultCommand extends WebCommand {
 }
 // really... is not neccesary extend the WebCommand
 */
require_once "Web/WebRequest.class.php";

Class FeEnCmdShowListEjetematico {

	function execute(){
		extract($_REQUEST);

		$objService = Application :: loadServices("Data_type");
		if ($ejetematico__ejtenombres)
		$_REQUEST["ejetematico__ejtenombres"] = $objService->formatString($ejetematico__ejtenombres);
		if ($ejetematico__ejtedescrips)
		$_REQUEST["ejetematico__ejtedescrips"] = $objService->formatString($ejetematico__ejtedescrips);
			
		if(!WebSession::issetProperty("ejetematico__ejtecodigon"))
		WebSession::setProperty("ejetematico__ejtecodigon",$ejetematico__ejtecodigon);

		if(!WebSession::issetProperty("ejetematico__ejtenombres"))
		WebSession::setProperty("ejetematico__ejtenombres",$ejetematico__ejtenombres);

		if(!WebSession::issetProperty("ejetematico__ejtedescrips"))
		WebSession::setProperty("ejetematico__ejtedescrips",$ejetematico__ejtedescrips);

		if(isset($_REQUEST["sqlConsult"])){
			$_REQUEST["sqlConsult"] = null;
		}

		return "success";
	}
}
?>