<?php


require_once "Web/WebRequest.class.php";
/**
* @Copyright 2005 Parquesoft
*
* Comando de adicionar datos a la tabla schema
* @author Ingravity 0.0.9
* @location Cali - Colombia
*/
Class FePrCmdAddSchema {

    function execute(){
		extract($_REQUEST);
		
		settype($objService,"object");
		settype($objManager,"object");
		settype($rcResult,"array");
		settype($nuMessage,"integer");
		
		if(($schema__schenombres!= NULL) && ($schema__schenombres!= "") 
		&& ($schema__scheobservas != NULL) && ($schema__scheobservas != "")){
			
			$objService = Application::loadServices("Data_type");

			/*Hace la validacion de formateo de campos cadena*/
			$schema__schenombres = $objService->formatString($schema__schenombres);
			$schema__scheobservas = $objService->formatString($schema__scheobservas);
			
			$objManager = Application :: getDomainController("SchemaManager");
			$rcResult = $objManager->addSchema($schema__schenombres, $schema__scheobservas);
			
			if($rcResult["result"]){
				WebRequest :: setProperty('param', $rcResult["id"]);
				WebRequest::setProperty('cod_message', $nuMessage=14);
				$objManager->UnsetRequest();
				return "success";
			}else{
				WebRequest::setProperty('cod_message', $nuMessage=100);
				return "fail";
			}   
		}else{
			WebRequest::setProperty('cod_message',$nuMessage = 0);
			return "fail";
		}
	}
}
?>