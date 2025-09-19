<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdAddFormapago {
    function execute()
    {
        extract($_REQUEST);
        if(($formapago__fopacodigos != NULL) && ($formapago__fopacodigos != "") && ($formapago__fopanombres != NULL) && ($formapago__fopanombres != "")){
        	$objServ = Application::loadServices("Data_type");
        	//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
			if($objServ->formatPrimaryKey($formapago__fopacodigos) == false){
				WebRequest::setProperty('cod_message',$message = 4);
		   		return "fail";
       	   	}
			//Hace la validacion de campos numericos y formateo de campos cadena
		$formapago__fopatiempon = $objServ->formatString($formapago__fopatiempon);
            if($formapago__fopacancuotn == ""){
               $formapago__fopacancuotn = "NULL";
            }
			if($objServ->isInteger($formapago__fopacancuotn) == false){
				WebRequest::setProperty('cod_message',$message = 4);
		   		return "fail";
       	   	}
		$formapago__fopadescrips = $objServ->formatString($formapago__fopadescrips);
            $formapago_manager = Application::getDomainController('FormapagoManager'); 
            $message = $formapago_manager->addFormapago($formapago__fopacodigos,$formapago__fopanombres,$formapago__fopatiempon,$formapago__fopacancuotn,$formapago__fopadescrips,$formapago__fopaactivos); 
            WebRequest::setProperty('cod_message', $message);
            return "success";       
        }else{
            WebRequest::setProperty('cod_message',$message = 0);
            return "fail";
        }
    }
}
?>	
