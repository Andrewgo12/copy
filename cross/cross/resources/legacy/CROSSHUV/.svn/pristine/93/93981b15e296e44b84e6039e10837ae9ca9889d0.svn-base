<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdUpdateTipoidentifi {
    function execute(){
    	
    	settype($nuLonMax,"integer");
		settype($nuLonMin,"integer");
		settype($nuLong,"integer");
		
        extract($_REQUEST);
        if(($tipoidentifi__tiidcodigos != NULL) && ($tipoidentifi__tiidcodigos != "")
        && ($tipoidentifi__tiidnombres != NULL) && ($tipoidentifi__tiidnombres != "")){
        	$objServ = Application::loadServices("Data_type");
        	//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
			if($objServ->formatPrimaryKey($tipoidentifi__tiidcodigos) == false){
				WebRequest::setProperty('cod_message',$message = 4);
		   		return "fail";
       	   	}
       	   	
        	//Se realiza la validacion de la longitud de nombre para el tipo de identificacion
			$nuLonMax = Application :: getConstant("LON_MAX_NTI");
			$nuLonMin = Application :: getConstant("LON_MIN_NTI");
			$nuLong = strlen($tipoidentifi__tiidnombres);
			if($nuLonMax<$nuLong || $nuLonMin>$nuLong){
				WebRequest::setProperty('cod_message',$message = 17);
				return "fail";
			}
       	   	
			//Hace la validacion de campos numericos y formateo de campos cadena
			$tipoidentifi__tiidnombres = $objServ->formatString($tipoidentifi__tiidnombres);
			$tipoidentifi__tiiddescrips = $objServ->formatString($tipoidentifi__tiiddescrips);
            $tipoidentifi_manager = Application::getDomainController('TipoidentifiManager'); 
            $message = $tipoidentifi_manager->updateTipoidentifi($tipoidentifi__tiidcodigos,$tipoidentifi__tiidnombres,$tipoidentifi__tiiddescrips,$tipoidentifi__tiidactivas); 
            WebRequest::setProperty('cod_message', $message);
            return "success";       
        }else{
            WebRequest::setProperty('cod_message',$message = 0);
            return "fail";
        }
    }
}
?>	