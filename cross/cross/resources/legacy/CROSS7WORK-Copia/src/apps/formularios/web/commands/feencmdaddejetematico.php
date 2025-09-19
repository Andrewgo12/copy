<?php
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeEnCmdAddEjetematico {

    function execute(){
    	
        extract($_REQUEST);
        settype($objService,"object");
        settype($objManager,"object");
        settype($nuMessage,"integer");
        
        if(($ejetematico__ejtenombres != NULL) && ($ejetematico__ejtenombres != "")){
        	$objService = Application::loadServices("Data_type");
        	//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
		    
			$ejetematico__ejtedescrips = $objService->formatString($ejetematico__ejtedescrips);
			$ejetematico__ejtenombres = $objService->formatString($ejetematico__ejtenombres);
	
            $objManager = Application::getDomainController('EjetematicoManager'); 
            $nuMessage = $objManager->addEjetematico($ejetematico__ejtenombres,$ejetematico__ejtedescrips); 
            WebRequest::setProperty('cod_message', $nuMessage);
            return "success";       
        }else{
            WebRequest::setProperty('cod_message',$nuMessage = 0);
            return "fail";
        }
    }
}
?>