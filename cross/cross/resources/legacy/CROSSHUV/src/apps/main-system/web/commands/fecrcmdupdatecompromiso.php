<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeCrCmdUpdateCompromiso {

    function execute()
    {
        extract($_REQUEST);

        if(($compromiso__compcodigos != NULL) && ($compromiso__compcodigos != "") 
        && ($compromiso__compdescris != NULL) && ($compromiso__compdescris != ""))
        {
        	$objServ = Application::loadServices("Data_type");

			//Hace la validacion de campos numericos y formateo de campos cadena
			$compromiso__compdescris = $objServ->formatString($compromiso__compdescris);
	
			$compromiso__compactivos = Application::getConstant("REG_ACT");
            $compromiso_manager = Application::getDomainController('CompromisoManager'); 
            $message = $compromiso_manager->updateCompromiso($compromiso__compcodigos,$compromiso__compdescris,$compromiso__compactivos); 
            WebRequest::setProperty('cod_message', $message);
            return "success";       
        }else{
            WebRequest::setProperty('cod_message',$message = 0);
            return "fail";
        }
    }

}

?>	
