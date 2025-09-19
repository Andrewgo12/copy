<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdUpdateGruposinteres {
    function execute()
    {
        extract($_REQUEST);
        if(($gruposinteres__grincodigos != NULL) && ($gruposinteres__grincodigos != "") 
        && ($gruposinteres__grinnombres != NULL) && ($gruposinteres__grinnombres != "")){
        	$objServ = Application::loadServices("Data_type");
        	//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
			if($objServ->formatPrimaryKey($gruposinteres__grincodigos) == false){
				WebRequest::setProperty('cod_message',$message = 4);
		   		return "fail";
       	   	}
			//Hace la validacion de campos numericos y formateo de campos cadena
			$gruposinteres__grinnombres = $objServ->formatString($gruposinteres__grinnombres);
			$gruposinteres__grindescrips = $objServ->formatString($gruposinteres__grindescrips);
            $gruposinteres_manager = Application::getDomainController('GruposinteresManager'); 
            $message = $gruposinteres_manager->updateGruposinteres($gruposinteres__grincodigos,$gruposinteres__grinnombres,$gruposinteres__grindescrips,$gruposinteres__grinactivos); 
            WebRequest::setProperty('cod_message', $message);
            return "success";       
        }else{
            WebRequest::setProperty('cod_message',$message = 0);
            return "fail";
        }
    }
}
?>	
