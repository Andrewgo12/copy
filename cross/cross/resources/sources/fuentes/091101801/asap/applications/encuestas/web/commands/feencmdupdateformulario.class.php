<?php
/*
 // you can define the commando extending the WebCommand

 require_once "Web/WebCommand.php";
 class DefaultCommand extends WebCommand {
 }
 // really... is not neccesary extend the WebCommand
 */
require_once "Web/WebRequest.class.php";
Class FeEnCmdUpdateFormulario {

	function execute(){
		
		extract($_REQUEST);
		settype($objService,"object");
		settype($objDate,"object");
		settype($objManager,"object");
		settype($nuMesssage,"integer");

		if(($formulario__formcodigon != NULL) && ($formulario__formcodigon != "")
		&& ($formulario__formnombres != NULL) && ($formulario__formnombres != "")
		&& ($formulario__formfeccrean != NULL) && ($formulario__formfeccrean != "")
		&& ($formulario__formpredets != NULL) && ($formulario__formpredets != "")){
			
			$objService = Application::loadServices("Data_type");
			$formulario__formnombres = $objService->formatString($formulario__formnombres);
			$formulario__formintrodus = $objService->formatString($formulario__formintrodus);
			 
			$objManager = Application::getDomainController('FormularioManager');
			$nuMesssage = $objManager->updateFormulario($formulario__formcodigon,$formulario__formnombres,$formulario__formintrodus,$formulario__formpredets,$formulario__formactivos);
			WebRequest::setProperty('cod_message', $nuMesssage);
			return "success";
		}
		else
		{
			WebRequest::setProperty('cod_message',$nuMesssage = 0);
			return "fail";
		}
	}
}
?>