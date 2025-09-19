<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeWFCmdUpdateEstadoproces {

    function execute()
    {
        extract($_REQUEST);

        if(($estadoproces__esprcodigos != NULL) && ($estadoproces__esprcodigos != "") && ($estadoproces__esprnombres != NULL) && ($estadoproces__esprnombres != "")){
        	$objServ = Application::loadServices("Data_type");
        	//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
		    
			if($objServ->formatPrimaryKey($estadoproces__esprcodigos) == false){
				WebRequest::setProperty('cod_message',$message = 4);
		   		return "fail";
       	   	}

			//Hace la validacion de campos numericos y formateo de campos cadena
		    
			$estadoproces__esprnombres = $objServ->formatString($estadoproces__esprnombres);
	
			$estadoproces__esprdescrips = $objServ->formatString($estadoproces__esprdescrips);
	
            $estadoproces_manager = Application::getDomainController('EstadoprocesManager'); 
            $message = $estadoproces_manager->updateEstadoproces($estadoproces__esprcodigos,$estadoproces__esprnombres,$estadoproces__esprdescrips,$estadoproces__espractivas); 
            WebRequest::setProperty('cod_message', $message);
            return "success";       
        }else{
            WebRequest::setProperty('cod_message',$message = 0);
            return "fail";
        }
    }

}

?>	
