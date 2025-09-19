<?php

/**
* @Copyright 2004 FullEngine
*
* Comando de modificar a la tabla $tabla
* @author Ingravity 0.0.8
* @date 14-dic-2004
* @location Cali - Colombia
*/

require_once "Web/WebRequest.class.php";

Class FePrCmdUpdateApplications {

    function execute()
    {
        extract($_REQUEST);

        if(($applications__applcodigos != NULL) && ($applications__applcodigos != "") && ($applications__applnombres != NULL) && ($applications__applnombres != "")){
        	$objServ = Application::loadServices("Data_type");
        	//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
		    
			if($objServ->formatPrimaryKey($applications__applcodigos) == false){
				WebRequest::setProperty('cod_message',$message = 4);
		   		return "fail";
       	   	}

			//Hace la validacion de campos numericos y formateo de campos cadena
		    
			$applications__applobservas = $objServ->formatString($applications__applobservas);
	
            $applications_manager = Application::getDomainController('ApplicationsManager'); 
            $message = $applications_manager->updateApplications($applications__applcodigos,$applications__applnombres,$applications__applobservas); 
            WebRequest::setProperty('cod_message', $message);
            return "success";       
        }else{
            WebRequest::setProperty('cod_message',$message = 0);
            return "fail";
        }
    }

}

?>	
