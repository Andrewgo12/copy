<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdAddTipomoneda {
    function execute()
    {
        extract($_REQUEST);
        if(($tipomoneda__timocodigos != NULL) && ($tipomoneda__timocodigos != "") && ($tipomoneda__timonombres != NULL) && ($tipomoneda__timonombres != "")){
        	$objServ = Application::loadServices("Data_type");
        	//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
			if($objServ->formatPrimaryKey($tipomoneda__timocodigos) == false){
				WebRequest::setProperty('cod_message',$message = 4);
		   		return "fail";
       	   	}
			//Hace la validacion de campos numericos y formateo de campos cadena
            if($tipomoneda__timoequivaln == ""){
               $tipomoneda__timoequivaln = "NULL";
            }
		$tipomoneda__timodescrips = $objServ->formatString($tipomoneda__timodescrips);
            $tipomoneda_manager = Application::getDomainController('TipomonedaManager'); 
            $message = $tipomoneda_manager->addTipomoneda($tipomoneda__timocodigos,$tipomoneda__timonombres,$tipomoneda__timoequivaln,$tipomoneda__timodescrips,$tipomoneda__timoactivas); 
            WebRequest::setProperty('cod_message', $message);
            return "success";       
        }else{
            WebRequest::setProperty('cod_message',$message = 0);
            return "fail";
        }
    }
}
?>	
