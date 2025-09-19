<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeEnCmdUpdatePregformula {

    function execute()
    {
        extract($_REQUEST);

        if(($pregformula__pregcodigon != NULL) && ($pregformula__pregcodigon != "") 
        && ($pregformula__formcodigon != NULL) && ($pregformula__formcodigon != "")){
        	$objServ = Application::loadServices("Data_type");
        	//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
		    
			if($objServ->formatPrimaryKey($pregformula__pregcodigon) == false){
				WebRequest::setProperty('cod_message',$message = 4);
		   		return "fail";
       	   	}

			//Hace la validacion de campos numericos y formateo de campos cadena
		    
            $pregformula_manager = Application::getDomainController('PregformulaManager'); 
            $message = $pregformula_manager->updatePregformula($pregformula__pregcodigon,$pregformula__formcodigon); 
            WebRequest::setProperty('cod_message', $message);
            return "success";       
        }else{
            WebRequest::setProperty('cod_message',$message = 0);
            return "fail";
        }
    }

}

?>	
