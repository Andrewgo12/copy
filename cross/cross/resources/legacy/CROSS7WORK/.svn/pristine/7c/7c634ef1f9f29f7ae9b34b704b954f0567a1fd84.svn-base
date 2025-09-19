<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeCuCmdUpdateInfractor {

    function execute()
    {
        extract($_REQUEST);

        if(($infractor__infrcodigos != NULL) && ($infractor__infrcodigos != "")
        && ($infractor__infrnombres != NULL) && ($infractor__infrnombres != ""))
        {
        	$objServ = Application::loadServices("Data_type");
			if($objServ->formatPrimaryKey($infractor__infrcodigos) == false){
				WebRequest::setProperty('cod_message',$message = 4);
		   		return "fail";
       	   	}

			//Hace la validacion de campos numericos y formateo de campos cadena
		    $infractor__tiidcodigos = $objServ->formatString($infractor__tiidcodigos);
			$infractor__ticlcodigos = $objServ->formatString($infractor__ticlcodigos);
			$infractor__infrnombres = strtoupper($objServ->formatString($infractor__infrnombres));
			$infractor__infrrepreses = strtoupper($objServ->formatString($infractor__infrrepreses));
			$infractor__infrlocalizs = strtoupper($objServ->formatString($infractor__infrlocalizs));
			$infractor__infrtelefons = strtoupper($objServ->formatString($infractor__infrtelefons));
			$infractor__locacodigos = $objServ->formatString($infractor__locacodigos);
			$infractor__infrnumfaxs = strtoupper($objServ->formatString($infractor__infrnumfaxs));
			$infractor__infractivas = Application::getConstant("REG_ACT");
	
            $infractor_manager = Application::getDomainController('InfractorManager'); 
            $message = $infractor_manager->updateInfractor($infractor__tiidcodigos,$infractor__infrcodigos,$infractor__ticlcodigos,$infractor__infrnombres,$infractor__infrrepreses,$infractor__infrlocalizs,$infractor__infrtelefons,$infractor__locacodigos,$infractor__infrnumfaxs,$infractor__infractivas); 
            WebRequest::setProperty('cod_message', $message);
            return "success";       
        }
        else
        {
            WebRequest::setProperty('cod_message',$message = 0);
            return "fail";
        }
    }
}
?>