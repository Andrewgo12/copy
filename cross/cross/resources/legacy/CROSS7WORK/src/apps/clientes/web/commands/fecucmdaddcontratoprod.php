<?php


require_once "Web/WebRequest.class.php";
/**
* @Copyright 2005 Parquesoft
*
* Comando de adicionar datos a la tabla contratoprod
* @author Ingravity 0.0.9
* @location Cali - Colombia
*/
Class FeCuCmdAddContratoprod {

    function execute(){
		extract($_REQUEST);
		if(($contratoprod__contnics != NULL) && ($contratoprod__contnics != "") && ($contratoprod__prodcodigos != NULL) && ($contratoprod__prodcodigos != "")){
			$objServ = Application::loadServices("Data_type");
			/*Hace la validacion de formato (Caracteres no permitidos) de la llave primaria*/
			if($objServ->formatPrimaryKey($contratoprod__contnics) == false){
				WebRequest::setProperty('cod_message',$message = 4);
				return "fail";
			}

			/*Hace la validacion de campos numericos y formateo de campos cadena*/
			$contratoprod__contnics = $objServ->formatString($contratoprod__contnics);
			$contratoprod__prodcodigos = $objServ->formatString($contratoprod__prodcodigos);
			if($contratoprod__coprcantidan == ""){
				$contratoprod__coprcantidan = "NULL";
			}
	
			if($objServ->isInteger($contratoprod__coprcantidan) == false){
				WebRequest::setProperty('cod_message',$message = 4);
				return "fail";
			}
	
			if($contratoprod__coprvalunidn == ""){
				$contratoprod__coprvalunidn = "NULL";
			}
	
			if($objServ->isInteger($contratoprod__coprvalunidn) == false){
				WebRequest::setProperty('cod_message',$message = 4);
				return "fail";
			}
	
			$contratoprod__coprserials = $objServ->formatString($contratoprod__coprserials);
			if($contratoprod__copovigencn == ""){
				$contratoprod__copovigencn = "NULL";
			}
	
			if($objServ->isInteger($contratoprod__copovigencn) == false){
				WebRequest::setProperty('cod_message',$message = 4);
				return "fail";
			}
	
			$contratoprod_copodefinis = $objServ->formatString($contratoprod_copodefinis);
			$contratoprod_copoclausus = $objServ->formatString($contratoprod_copoclausus);
			$contratoprod_coporestris = $objServ->formatString($contratoprod_coporestris);

			$contratoprod_manager = Application::getDomainController('ContratoprodManager'); 
			$message = $contratoprod_manager->addContratoprod($contratoprod__contnics,$contratoprod__prodcodigos,$contratoprod__coprcantidan,$contratoprod__coprvalunidn,$contratoprod__coprserials,$contratoprod__copovigencn,$contratoprod_copodefinis,$contratoprod_copoclausus,$contratoprod_coporestris); 
			WebRequest::setProperty('cod_message', $message);
			return "success";       
		}else{
			WebRequest::setProperty('cod_message',$message = 0);
			return "fail";
		}
	}

}

?>	
