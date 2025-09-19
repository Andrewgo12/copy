<?php
/*
 // you can define the commando extending the WebCommand

 require_once "Web/WebCommand.php";
 class DefaultCommand extends WebCommand {
 }
 // really... is not neccesary extend the WebCommand
 */
require_once "Web/WebRequest.class.php";
Class FeEnCmdAddFormulario {

	function execute(){
		
		extract($_REQUEST);
		settype($objService,"object");
		settype($objDate,"object");
		settype($objManager,"object");
		settype($nuMessage,"integer");

		if(($formulario__formnombres != NULL) && ($formulario__formnombres != "")
		&& ($formulario__formfeccrean != NULL) && ($formulario__formfeccrean != "")
		&& ($formulario__formpredets != NULL) && ($formulario__formpredets != "")){
			//Fechas
			$objDate = Application::loadServices("DateController");
			$formulario__formfeccrean = $objDate->fncintdatehour();

			$objService = Application::loadServices("Data_type");
			$formulario__formintrodus = $objService->formatString($formulario__formintrodus);
			$formulario__formnombres = $objService->formatString($formulario__formnombres);

			$objManager = Application::getDomainController('FormularioManager');
			$nuMessage = $objManager->addFormulario($formulario__formnombres,$formulario__formfeccrean,$formulario__formintrodus,$formulario__formpredets,$formulario__formactivos);
			WebRequest::setProperty('cod_message', $nuMessage);
			return "success";
		}else{
			WebRequest::setProperty('cod_message',$nuMessage = 0);
			return "fail";
		}
	}
}
?>