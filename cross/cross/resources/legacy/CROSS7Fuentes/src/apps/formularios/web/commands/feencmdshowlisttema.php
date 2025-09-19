<?php

/*
 // you can define the commando extending the WebCommand

 require_once "Web/WebCommand.php";
 class DefaultCommand extends WebCommand {
 }
 // really... is not neccesary extend the WebCommand
 */

require_once "Web/WebRequest.class.php";

Class FeEnCmdShowListTema {

	function execute(){
		
		extract($_REQUEST);
		settype($objService,"object");

		$objService = Application :: loadServices("Data_type");
		if ($tema__temanombres)
		$_REQUEST["tema__temanombres"] = $objService->formatString($tema__temanombres);
		if ($tema__temadescrips)
		$_REQUEST["tema__temadescrips"] = $objService->formatString($tema__temadescrips);
			
		if(!WebSession::issetProperty("tema__temacodigon"))
		WebSession::setProperty("tema__temacodigon",$tema__temacodigon);

		if(!WebSession::issetProperty("tema__ejtecodigon"))
		WebSession::setProperty("tema__ejtecodigon",$tema__ejtecodigon);

		if(!WebSession::issetProperty("tema__temanombres"))
		WebSession::setProperty("tema__temanombres",$tema__temanombres);

		if(!WebSession::issetProperty("tema__temadescrips"))
		WebSession::setProperty("tema__temadescrips",$tema__temadescrips);
		
		if(isset($_REQUEST["sqlConsult"])){
			$_REQUEST["sqlConsult"] = null;
		}
		return "success";
	}
}
?>