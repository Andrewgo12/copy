<?php

/*
 // you can define the commando extending the WebCommand

 require_once "Web/WebCommand.php";
 class DefaultCommand extends WebCommand {
 }
 // really... is not neccesary extend the WebCommand
 */

require_once "Web/WebRequest.class.php";

Class FeEnCmdAddModeloresp {

	function execute(){
		extract($_REQUEST);
		
		settype($objService,"object");
		settype($objManager,"object");
		settype($nuMessage,"integer");

		if(($modeloresp__morenombres != NULL) && ($modeloresp__morenombres != "")){
			//obtenemos de la tabla numerador el codigo para el modelo de respuesta
			$objService = Application :: loadServices("Data_type");
			$modeloresp__morenombres = $objService->formatString($modeloresp__morenombres);
			$modeloresp__moredescrips = $objService->formatString($modeloresp__moredescrips);

			$objManager = Application::getDomainController('ModelorespManager');
			$nuMessage = $objManager->addModeloresp($modeloresp__morenombres,$modeloresp__moredescrips);
			WebRequest::setProperty('cod_message', $nuMessage);
			return "success";
		}else{
			WebRequest::setProperty('cod_message',$nuMessage = 0);
			return "fail";
		}
	}
}
?>