<?php
require_once "Web/WebRequest.class.php";
/**
* @Copyright 2005 Parquesoft
*
* Comando de actualizar datos a la tabla schema
* @author Ingravity 0.0.9
* @location Cali - Colombia
*/
Class FePrCmdUpdateSchema {

    function execute(){
        extract($_REQUEST);
        
        settype($objService,"object");
        settype($objManager,"object");
        settype($nuMessage,"integer");

        if(($schema__schecodigon != NULL) && ($schema__schecodigon != "") 
        && ($schema__schenombres != NULL) && ($schema__schenombres != "") 
        && ($schema__scheobservas != NULL) && ($schema__scheobservas != "")){
        	
        	$objService = Application::loadServices("Data_type");
        	
			//Hace el formateo de campos cadena
			$schema__schenombres = $objService->formatString($schema__schenombres);
			$schema__scheobservas = $objService->formatString($schema__scheobservas);
	
            $objManager = Application::getDomainController('SchemaManager'); 
            $nuMessage = $objManager->updateSchema($schema__schecodigon,$schema__schenombres,$schema__scheobservas); 
            WebRequest::setProperty('cod_message', $nuMessage);
            return "success";       
        }else{
            WebRequest::setProperty('cod_message',$nuMessage = 0);
            return "fail";
        }
    }
}
?>