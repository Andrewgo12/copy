<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdUpdateTiporecurso {
    function execute()
    {
        extract($_REQUEST);
        if(($tiporecurso__tirecodigos != NULL) && ($tiporecurso__tirecodigos != "") && ($tiporecurso__tirenombres != NULL) && ($tiporecurso__tirenombres != "")){
        	$objServ = Application::loadServices("Data_type");
        	//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
			if($objServ->formatPrimaryKey($tiporecurso__tirecodigos) == false){
				WebRequest::setProperty('cod_message',$message = 4);
		   		return "fail";
       	   	}
			//Hace la validacion de campos numericos y formateo de campos cadena
			$tiporecurso__tiredescrips = $objServ->formatString($tiporecurso__tiredescrips);
            $tiporecurso_manager = Application::getDomainController('TiporecursoManager'); 
            $message = $tiporecurso_manager->updateTiporecurso($tiporecurso__tirecodigos,$tiporecurso__tirenombres,$tiporecurso__tiredescrips); 
            WebRequest::setProperty('cod_message', $message);
            return "success";       
        }else{
            WebRequest::setProperty('cod_message',$message = 0);
            return "fail";
        }
    }
}
?>	
