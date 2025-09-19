<?php
/*
 // you can define the commando extending the WebCommand

 require_once "Web/WebCommand.php";
 class DefaultCommand extends WebCommand {
 }
 // really... is not neccesary extend the WebCommand
 */

require_once "Web/WebRequest.class.php";

Class FeEnCmdDeletePregunta {

	function execute(){
		
		extract($_REQUEST);
		settype($objManager,"object");
		settype($nuMessage,"integer");

		if(($pregunta__pregcodigon != NULL) && ($pregunta__pregcodigon != "")){
			$objManager = Application::getDomainController('PreguntaManager');
			$nuMessage = $objManager->deletePregunta($pregunta__pregcodigon);
			WebRequest::setProperty('cod_message', $nuMessage);
			return "success";
		}else{
			WebRequest::setProperty('cod_message',$nuMessage = 0);
			return "fail";
		}
	}
}
?>