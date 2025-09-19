<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdAddRecurso {
    function execute()
    {
        extract($_REQUEST);
        if(($recurso__recucodigos != NULL) && ($recurso__recucodigos != "") && ($recurso__recunombres != NULL) && ($recurso__recunombres != "") && ($recurso__grrecodigos != NULL) && ($recurso__grrecodigos != "") && ($recurso__tirecodigos != NULL) && ($recurso__tirecodigos != "") && ($recurso__unmecodigos != NULL) && ($recurso__unmecodigos != "")){
        	$objServ = Application::loadServices("Data_type");
        	//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
			if($objServ->formatPrimaryKey($recurso__recucodigos) == false){
				WebRequest::setProperty('cod_message',$message = 4);
		   		return "fail";
       	   	}
			//Hace la validacion de campos numericos y formateo de campos cadena
		$recurso__recudescrips = $objServ->formatString($recurso__recudescrips);
            $recurso_manager = Application::getDomainController('RecursoManager'); 
            $message = $recurso_manager->addRecurso($recurso__recucodigos,$recurso__recunombres,$recurso__grrecodigos,$recurso__tirecodigos,$recurso__unmecodigos,$recurso__recudescrips); 
            WebRequest::setProperty('cod_message', $message);
            return "success";       
        }else{
            WebRequest::setProperty('cod_message',$message = 0);
            return "fail";
        }
    }
}
?>	
