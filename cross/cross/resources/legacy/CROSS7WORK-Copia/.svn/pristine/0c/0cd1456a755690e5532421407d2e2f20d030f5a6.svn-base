<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeWFCmdAddTarea {
    function execute()
    {
        extract($_REQUEST);
        if(($tarea__tarecodigos != NULL) && ($tarea__tarecodigos != "") && 
            ($tarea__tarenombres != NULL) && ($tarea__tarenombres != "")){
            	
        	$objServ = Application::loadServices("Data_type");
        	
        	//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
			if($objServ->formatPrimaryKey($tarea__tarecodigos) == false){
				WebRequest::setProperty('cod_message',$message = 4);
		   		return "fail";
       	   	}
			//Hace la validacion de campos numericos y formateo de campos cadena
		$tarea__tarenombres = $objServ->formatString($tarea__tarenombres);
		$tarea__orgacodigos = $objServ->formatString($tarea__orgacodigos);
		$tarea__taredescris = $objServ->formatString($tarea__taredescris);
            $tarea_manager = Application::getDomainController('TareaManager'); 
            $message = $tarea_manager->addTarea($tarea__tarecodigos,$tarea__tarenombres,$tarea__orgacodigos,$tarea__taredescris,$tarea__tareactivas); 
            WebRequest::setProperty('cod_message', $message);
            return "success";       
        }else{
            WebRequest::setProperty('cod_message',$message = 0);
            return "fail";
        }
    }
}
?>	
