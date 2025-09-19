<?php
/*
 // you can define the commando extending the WebCommand

 require_once "Web/WebCommand.php";
 class DefaultCommand extends WebCommand {
 }
 // really... is not neccesary extend the WebCommand
 */
require_once "Web/WebRequest.class.php";

Class FeEnCmdDeleteFormulario {

	function execute(){
		
		extract($_REQUEST);
		settype($objManager,"object");
		settype($nuMessage,"integer");

		if(($formulario__formcodigon != NULL) && ($formulario__formcodigon != "")){
			
			$objManager = Application::getDomainController('FormularioManager');
			$nuMessage = $objManager->deleteFormulario($formulario__formcodigon);
			 
			WebRequest::setProperty('cod_message', $nuMessage);
			return "success";
		}else{
			WebRequest::setProperty('cod_message',$nuMessage = 0);
			return "fail";
		}
	}
}
?>