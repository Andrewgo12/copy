<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeCrCmdAddCompromiso {

    function execute()
    {
        extract($_REQUEST);

        if(($compromiso__compdescris != NULL) && ($compromiso__compdescris != ""))
        {
        	$objServ = Application::loadServices("Data_type");

        	//Hace la validacion de campos numericos y formateo de campos cadena
			$compromiso__compdescris = $objServ->formatString($compromiso__compdescris);
	
			$numerador = Application::getDomainController("NumeradorManager");
			$compromiso__compcodigos = $numerador->fncgetByIdNumerador("compromiso");
			
            $compromiso_manager = Application::getDomainController('CompromisoManager'); 
            $compromiso__compactivos = Application::getConstant("REG_ACT");
            $message = $compromiso_manager->addCompromiso($compromiso__compcodigos,$compromiso__compdescris,$compromiso__compactivos); 
            WebRequest::setProperty('cod_message', $message);
            return "success";       
        }else{
            WebRequest::setProperty('cod_message',$message = 0);
            return "fail";
        }
    }

}

?>	
