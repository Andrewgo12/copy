<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeEnCmdUpdateRespuestausu {

    function execute()
    {
        extract($_REQUEST);

        if(($respuestausu__usuacodigon != NULL) && ($respuestausu__usuacodigon != "") 
        && ($respuestausu__formcodigon != NULL) && ($respuestausu__formcodigon != "") 
        && ($respuestausu__pregcodigon != NULL) && ($respuestausu__pregcodigon != "") 
        && ($respuestausu__reuscodigon != NULL) && ($respuestausu__reuscodigon != ""))
        {
        	$objServ = Application::loadServices("Data_type");
        	//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
		    
			if($objServ->formatPrimaryKey($respuestausu__usuacodigon) == false){
				WebRequest::setProperty('cod_message',$message = 4);
		   		return "fail";
       	   	}

			//Hace la validacion de campos numericos y formateo de campos cadena
		    
            if($respuestausu__varecodigon == ""){
               $respuestausu__varecodigon = "NULL";
            }
	
			if($objServ->isInteger($respuestausu__varecodigon) == false){
				WebRequest::setProperty('cod_message',$message = 4);
		   		return "fail";
       	   	}
	
            if($respuestausu__respcodigon == ""){
               $respuestausu__respcodigon = "NULL";
            }
	
			if($objServ->isInteger($respuestausu__respcodigon) == false){
				WebRequest::setProperty('cod_message',$message = 4);
		   		return "fail";
       	   	}
	
			$respuestausu__reusvalorabis = $objServ->formatString($respuestausu__reusvalorabis);
	
            $respuestausu_manager = Application::getDomainController('RespuestausuManager'); 
            $message = $respuestausu_manager->updateRespuestausu($respuestausu__usuacodigon,$respuestausu__formcodigon,$respuestausu__pregcodigon,$respuestausu__reuscodigon,$respuestausu__varecodigon,$respuestausu__respcodigon,$respuestausu__reusvalorabis); 
            WebRequest::setProperty('cod_message', $message);
            return "success";       
        }else{
            WebRequest::setProperty('cod_message',$message = 0);
            return "fail";
        }
    }

}

?>	
