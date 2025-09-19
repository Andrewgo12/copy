<?php


require_once "Web/WebRequest.class.php";
/**
* @Copyright 2005 Parquesoft
*
* Comando de actualizar datos a la tabla estadotarea
* @author Ingravity 0.0.9
* @location Cali - Colombia
*/
Class FeWFCmdUpdateEstadotarea {

    function execute(){
        extract($_REQUEST);

        if(($estadotarea__tarecodigos != NULL) && ($estadotarea__tarecodigos != "") && ($estadotarea__esaccodigos != NULL) && ($estadotarea__esaccodigos != "")){
        	$objServ = Application::loadServices("Data_type");
        	//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
		    
			if($objServ->formatPrimaryKey($estadotarea__tarecodigos) == false){
				WebRequest::setProperty('cod_message',$message = 4);
		   		return "fail";
       	   	}

			//Hace la validacion de campos numericos y formateo de campos cadena
		    
            $estadotarea_manager = Application::getDomainController('EstadotareaManager'); 
            $message = $estadotarea_manager->updateEstadotarea($estadotarea__tarecodigos,$estadotarea__esaccodigos); 
            WebRequest::setProperty('cod_message', $message);
            return "success";       
        }else{
            WebRequest::setProperty('cod_message',$message = 0);
            return "fail";
        }
    }

}

?>	
