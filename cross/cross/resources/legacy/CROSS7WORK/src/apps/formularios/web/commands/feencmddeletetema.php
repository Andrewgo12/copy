<?php
/*
 // you can define the commando extending the WebCommand

 require_once "Web/WebCommand.php";
 class DefaultCommand extends WebCommand {
 }
 // really... is not neccesary extend the WebCommand
 */
require_once "Web/WebRequest.class.php";
Class FeEnCmdDeleteTema {

	function execute(){
		
		extract($_REQUEST);
		settype($objManager,"object");
		settype($nuMessage,"integer");

		if(($tema__temacodigon != NULL) && ($tema__temacodigon != "")){
			
			$objManager = Application::getDomainController('TemaManager');
			$nuMessage = $objManager->deleteTema($tema__temacodigon);
			WebRequest::setProperty('cod_message', $nuMessage);
			return "success";
		}else{
			WebRequest::setProperty('cod_message',$nuMessage = 0);
			return "fail";
		}
	}
}
?>