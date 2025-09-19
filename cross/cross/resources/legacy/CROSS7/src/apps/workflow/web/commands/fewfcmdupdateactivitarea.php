<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeWFCmdUpdateActivitarea {
    function execute()
    {
        extract($_REQUEST);
        if(($activitarea__tarecodigos != NULL) && ($activitarea__tarecodigos != "") && ($activitarea__acticodigos != NULL) && ($activitarea__acticodigos != "")){
        	
        	if($activitarea__actavalorn<0)
        	{
        		WebRequest::setProperty('cod_message',$message = 11);
		   		return "fail";
        	}
        	if($activitarea__actaporcetan<0)
        	{
        		WebRequest::setProperty('cod_message',$message = 12);
		   		return "fail";
        	}
        	if($activitarea__actaporcetan>100)
        	{
        		WebRequest::setProperty('cod_message',$message = 13);
		   		return "fail";
        	}
        	
        	
        	$objServ = Application::loadServices("Data_type");
        	
        	//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
			if($objServ->formatPrimaryKey($activitarea__tarecodigos) == false){
				WebRequest::setProperty('cod_message',$message = 4);
		   		return "fail";
       	   	}
			//Hace la validacion de campos numericos y formateo de campos cadena
            if($activitarea__actavalorn == ""){
               $activitarea__actavalorn = "NULL";
            }
			$activitarea__actaobligats = $objServ->formatString($activitarea__actaobligats);
            if($activitarea__actaordenn == ""){
               $activitarea__actaordenn = "NULL";
            }
			if($objServ->isInteger($activitarea__actaordenn) == false){
				WebRequest::setProperty('cod_message',$message = 4);
		   		return "fail";
       	   	}
            if($activitarea__actaporcetan == ""){
               $activitarea__actaporcetan = "NULL";
            }
            $activitarea_manager = Application::getDomainController('ActivitareaManager'); 
            $message = $activitarea_manager->updateActivitarea($activitarea__tarecodigos,$activitarea__acticodigos,$activitarea__actavalorn,$activitarea__actaobligats,$activitarea__actaordenn,$activitarea__actaporcetan,$activitarea__actaactivas); 
            WebRequest::setProperty('cod_message', $message);
            return "success";       
        }else{
            WebRequest::setProperty('cod_message',$message = 0);
            return "fail";
        }
    }
}
?>	
