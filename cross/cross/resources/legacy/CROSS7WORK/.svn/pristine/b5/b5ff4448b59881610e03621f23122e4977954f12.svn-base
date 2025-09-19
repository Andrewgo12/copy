<?php

/**
* @Copyright 2004 FullEngine
*
* Comando de adicionar a la tabla $tabla
* @author Ingravity 0.0.8
* @date 14-dic-2004
* @location Cali - Colombia
*/

require_once "Web/WebRequest.class.php";

Class FePrCmdAddLanguage {

    function execute()
    {
        extract($_REQUEST);

        if(($language__langcodigos != NULL) && ($language__langcodigos != "") && ($language__langnombres != NULL) && ($language__langnombres != "")){
        	$objServ = Application::loadServices("Data_type");
        	//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
		    
			if($objServ->formatPrimaryKey($language__langcodigos) == false){
				WebRequest::setProperty('cod_message',$message = 4);
		   		return "fail";
       	   	}

			//Hace la validacion de campos numericos y formateo de campos cadena
		    
		$language__langobservas = $objServ->formatString($language__langobservas);
	
            $language_manager = Application::getDomainController('LanguageManager'); 
            $message = $language_manager->addLanguage($language__langcodigos,$language__langnombres,$language__langobservas); 
            WebRequest::setProperty('cod_message', $message);
            return "success";       
        }else{
            WebRequest::setProperty('cod_message',$message = 0);
            return "fail";
        }
    }

}

?>	
