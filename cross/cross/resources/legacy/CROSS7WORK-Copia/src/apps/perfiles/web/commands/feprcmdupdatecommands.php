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

Class FePrCmdUpdateCommands {

    function execute()
    {
        extract($_REQUEST);

        if(($commands__commnombres != NULL) && ($commands__commnombres != "") && ($commands__applcodigos != NULL) && ($commands__applcodigos != "")){
        	$objServ = Application::loadServices("Data_type");
        	//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
		    
			if($objServ->formatPrimaryKey($commands__commnombres) == false){
				WebRequest::setProperty('cod_message',$message = 4);
		   		return "fail";
       	   	}

			//Hace la validacion de campos numericos y formateo de campos cadena
		    
			$commands__commobservas = $objServ->formatString($commands__commobservas);
	
            $commands_manager = Application::getDomainController('CommandsManager'); 
            $message = $commands_manager->updateCommands($commands__commnombres,$commands__applcodigos,$commands__commobservas); 
            WebRequest::setProperty('cod_message', $message);
            return "success";       
        }else{
            WebRequest::setProperty('cod_message',$message = 0);
            return "fail";
        }
    }

}

?>	
