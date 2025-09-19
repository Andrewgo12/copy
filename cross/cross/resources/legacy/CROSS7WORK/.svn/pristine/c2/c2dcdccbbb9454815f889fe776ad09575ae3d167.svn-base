<?php
/*
 // you can define the commando extending the WebCommand

 require_once "Web/WebCommand.php";
 class DefaultCommand extends WebCommand {
 }
 // really... is not neccesary extend the WebCommand
 */
require_once "Web/WebRequest.class.php";

Class FeEnCmdUpdateEjetematico {

	function execute(){
		
		extract($_REQUEST);
		settype($objService,"object");

		if(($ejetematico__ejtecodigon != NULL) && ($ejetematico__ejtecodigon != "")
		&& ($ejetematico__ejtenombres != NULL) && ($ejetematico__ejtenombres != "")){
			$objService = Application::loadServices("Data_type");
			//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria

			if($objService->formatPrimaryKey($ejetematico__ejtecodigon) == false){
				WebRequest::setProperty('cod_message',$message = 4);
				return "fail";
			}

			//Hace la validacion de campos numericos y formateo de campos cadena
			if($objService->isInteger($ejetematico__ejtecodigon) == false){
				WebRequest::setProperty('cod_message',$message = 4);
				return "fail";
			}

			$ejetematico__ejtenombres = $objService->formatString($ejetematico__ejtenombres);
			$ejetematico__ejtedescrips = $objService->formatString($ejetematico__ejtedescrips);

			$ejetematico_manager = Application::getDomainController('EjetematicoManager');
			$message = $ejetematico_manager->updateEjetematico($ejetematico__ejtecodigon,$ejetematico__ejtenombres,$ejetematico__ejtedescrips);
			WebRequest::setProperty('cod_message', $message);
			return "success";
		}else{
			WebRequest::setProperty('cod_message',$message = 0);
			return "fail";
		}
	}
}
?>