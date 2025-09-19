<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdAddTipocliente {
    function execute()
    {
        extract($_REQUEST);
        if(($tipocliente__ticlcodigos != NULL) && ($tipocliente__ticlcodigos != "")
        && ($tipocliente__ticlnombres != NULL) && ($tipocliente__ticlnombres != "")){
        	$objServ = Application::loadServices("Data_type");
        	//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
			if($objServ->formatPrimaryKey($tipocliente__ticlcodigos) == false){
				WebRequest::setProperty('cod_message',$message = 4);
		   		return "fail";
       	   	}
			//Hace la validacion de campos numericos y formateo de campos cadena
		$tipocliente__ticlnombres = $objServ->formatString($tipocliente__ticlnombres);
		$tipocliente__ticldescrips = $objServ->formatString($tipocliente__ticldescrips);
            $tipocliente_manager = Application::getDomainController('TipoclienteManager'); 
            $message = $tipocliente_manager->addTipocliente($tipocliente__ticlcodigos,$tipocliente__ticlnombres,$tipocliente__ticldescrips,$tipocliente__ticlactivos); 
            WebRequest::setProperty('cod_message', $message);
            return "success";       
        }else{
            WebRequest::setProperty('cod_message',$message = 0);
            return "fail";
        }
    }
}
?>	
