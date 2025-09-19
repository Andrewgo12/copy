<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdAddTipocontrato {
    function execute()
    {
        extract($_REQUEST);
        if(($tipocontrato__ticocodigos != NULL) && ($tipocontrato__ticocodigos != "") && ($tipocontrato__ticonombres != NULL) && ($tipocontrato__ticonombres != "")){
        	$objServ = Application::loadServices("Data_type");
        	//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
			if($objServ->formatPrimaryKey($tipocontrato__ticocodigos) == false){
				WebRequest::setProperty('cod_message',$message = 4);
		   		return "fail";
       	   	}
			//Hace la validacion de campos numericos y formateo de campos cadena
		$tipocontrato__ticodescrips = $objServ->formatString($tipocontrato__ticodescrips);
            $tipocontrato_manager = Application::getDomainController('TipocontratoManager'); 
            $message = $tipocontrato_manager->addTipocontrato($tipocontrato__ticocodigos,$tipocontrato__ticonombres,$tipocontrato__ticodescrips,$tipocontrato__ticoactivos); 
            WebRequest::setProperty('cod_message', $message);
            return "success";       
        }else{
            WebRequest::setProperty('cod_message',$message = 0);
            return "fail";
        }
    }
}
?>	
