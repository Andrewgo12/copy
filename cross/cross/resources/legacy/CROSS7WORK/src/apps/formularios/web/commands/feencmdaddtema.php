<?php
/*
 // you can define the commando extending the WebCommand

 require_once "Web/WebCommand.php";
 class DefaultCommand extends WebCommand {
 }
 // really... is not neccesary extend the WebCommand
 */

require_once "Web/WebRequest.class.php";

Class FeEnCmdAddTema {

	function execute(){
		
		extract($_REQUEST);
		settype($objService,"object");
		settype($objManager,"object");
		settype($nuMessage,"integer");

		if(($tema__ejtecodigon != NULL) && ($tema__ejtecodigon != "")
		&& ($tema__temanombres != NULL) && ($tema__temanombres != "")){
			
			$objService = Application::loadServices("Data_type");
			$tema__temanombres = $objService->formatString($tema__temanombres);
			$tema__temadescrips = $objService->formatString($tema__temadescrips);

			$objManager = Application::getDomainController('TemaManager');
			$nuMessage = $objManager->addTema($tema__ejtecodigon,$tema__temanombres,$tema__temadescrips);
			WebRequest::setProperty('cod_message', $nuMessage);
			return "success";
		}else{
			WebRequest::setProperty('cod_message',$nuMessage = 0);
			return "fail";
		}
	}
}
?>