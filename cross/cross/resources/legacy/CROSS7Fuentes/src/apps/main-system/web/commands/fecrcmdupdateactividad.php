<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeCrCmdUpdateActividad {

    function execute()
    {
        extract($_REQUEST);

        if(($actividad__acticodigos != NULL) && ($actividad__acticodigos != "") 
        && ($actividad__actinombres != NULL) && ($actividad__actinombres != "")){
        	$objServ = Application::loadServices("Data_type");
        	//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
		    
			if($objServ->formatPrimaryKey($actividad__acticodigos) == false){
				WebRequest::setProperty('cod_message',$message = 4);
		   		return "fail";
       	   	}

			//Hace la validacion de campos numericos y formateo de campos cadena
		    
			$actividad__actinombres = $objServ->formatString($actividad__actinombres);
	
            if($actividad__activalorn == ""){
               $actividad__activalorn = "NULL";
            }
	
			$actividad__actiobservas = $objServ->formatString($actividad__actiobservas);
	
            $actividad_manager = Application::getDomainController('ActividadManager'); 
            $message = $actividad_manager->updateActividad($actividad__acticodigos,$actividad__actinombres,$actividad__activalorn,$actividad__actiobservas,$actividad__actiactivas); 
            WebRequest::setProperty('cod_message', $message);
            return "success";       
        }else{
            WebRequest::setProperty('cod_message',$message = 0);
            return "fail";
        }
    }

}

?>	
