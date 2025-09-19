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

Class FePrCmdAddStyle {

    function execute()
    {
        extract($_REQUEST);

        if(($style__stylcodigos != NULL) && ($style__stylcodigos != "") && ($style__applcodigos != NULL) && ($style__applcodigos != "") && ($style__stylnombres != NULL) && ($style__stylnombres != "")){
        	$objServ = Application::loadServices("Data_type");
        	//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
		    
			if($objServ->formatPrimaryKey($style__stylcodigos) == false){
				WebRequest::setProperty('cod_message',$message = 4);
		   		return "fail";
       	   	}

			//Hace la validacion de campos numericos y formateo de campos cadena
		    
		$style__stylobservas = $objServ->formatString($style__stylobservas);
	
            $style_manager = Application::getDomainController('StyleManager'); 
            $message = $style_manager->addStyle($style__stylcodigos,$style__applcodigos,$style__stylnombres,$style__stylobservas); 
            WebRequest::setProperty('cod_message', $message);
            return "success";       
        }else{
            WebRequest::setProperty('cod_message',$message = 0);
            return "fail";
        }
    }

}

?>	
