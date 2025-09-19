<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdAddEstadoclient {
    function execute()
    {
        extract($_REQUEST);
        if(($estadoclient__esclcodigos != NULL) && ($estadoclient__esclcodigos != "")
        && ($estadoclient__esclnombres != NULL) && ($estadoclient__esclnombres != "")) {
        	$objServ = Application::loadServices("Data_type");
        	//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
			if($objServ->formatPrimaryKey($estadoclient__esclcodigos) == false){
				WebRequest::setProperty('cod_message',$message = 4);
		   		return "fail";
       	   	}
			//Hace la validacion de campos numericos y formateo de campos cadena
		$estadoclient__esclnombres = $objServ->formatString($estadoclient__esclnombres);
		$estadoclient__escldescrips = $objServ->formatString($estadoclient__escldescrips);
            $estadoclient_manager = Application::getDomainController('EstadoclientManager'); 
            $message = $estadoclient_manager->addEstadoclient($estadoclient__esclcodigos,$estadoclient__esclnombres,$estadoclient__escldescrips,$estadoclient__esclactivos); 
            WebRequest::setProperty('cod_message', $message);
            return "success";       
        }else{
            WebRequest::setProperty('cod_message',$message = 0);
            return "fail";
        }
    }
}
?>	
