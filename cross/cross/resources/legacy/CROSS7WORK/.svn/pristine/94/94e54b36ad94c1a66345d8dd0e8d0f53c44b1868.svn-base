<?php
/*
 // you can define the commando extending the WebCommand

 require_once "Web/WebCommand.php";
 class DefaultCommand extends WebCommand {
 }
 // really... is not neccesary extend the WebCommand
 */
require_once "Web/WebRequest.class.php";
Class FeEnCmdUpdatePregunta {

	function execute(){
		
		extract($_REQUEST);
		settype($objManager,"object");
		settype($objService,"object");
		settype($nuMessage,"integer");

		if(($pregunta__pregcodigon != NULL) && ($pregunta__pregcodigon != "")
		&&($pregunta__pregtipopres != NULL) && ($pregunta__pregtipopres != "")
		&& ($pregunta__pregdescris != NULL) && ($pregunta__pregdescris != "")
		&&($pregunta__temacodigon != NULL) && ($pregunta__temacodigon != "")){
			
			$objService = Application::loadServices("Data_type");
			$pregunta__pregdescris = $objService->formatString($pregunta__pregdescris);
			
			$objManager = Application::getDomainController('PreguntaManager');
			$nuMessage = $objManager->updatePregunta($pregunta__pregcodigon,$pregunta__pregdescris,$pregunta__temacodigon,
			$pregunta__morecodigon,$pregunta__pregtipopres,$pregunta__pregactivas);
			WebRequest::setProperty('cod_message', $nuMessage);
			return "success";
		}else{
			WebRequest::setProperty('cod_message',$nuMessage = 0);
			return "fail";
		}
	}
}
?>