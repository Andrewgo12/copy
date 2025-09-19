<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdAddUnidadmedida {
    function execute()
    {
        extract($_REQUEST);
        if(($unidadmedida__unmecodigos != NULL) && ($unidadmedida__unmecodigos != "") && ($unidadmedida__unmenombres != NULL) && ($unidadmedida__unmenombres != "") && ($unidadmedida__unmesiglas != NULL) && ($unidadmedida__unmesiglas != "")){
        	$objServ = Application::loadServices("Data_type");
        	//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
			if($objServ->formatPrimaryKey($unidadmedida__unmecodigos) == false){
				WebRequest::setProperty('cod_message',$message = 4);
		   		return "fail";
       	   	}
			//Hace la validacion de campos numericos y formateo de campos cadena
		$unidadmedida__unmedescrips = $objServ->formatString($unidadmedida__unmedescrips);
            $unidadmedida_manager = Application::getDomainController('UnidadmedidaManager'); 
            $message = $unidadmedida_manager->addUnidadmedida($unidadmedida__unmecodigos,$unidadmedida__unmenombres,$unidadmedida__unmesiglas,$unidadmedida__unmedescrips); 
            WebRequest::setProperty('cod_message', $message);
            return "success";       
        }else{
            WebRequest::setProperty('cod_message',$message = 0);
            return "fail";
        }
    }
}
?>	
