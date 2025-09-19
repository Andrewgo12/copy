<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdUpdateContrato {
    function execute()
    {
        extract($_REQUEST);
        if(($contrato__contnics != NULL) && ($contrato__contnics != "") && 
        	($contrato__ticocodigos != NULL) && ($contrato__ticocodigos != "") && 
        	($contrato_contobjetos != NULL) && ($contrato_contobjetos != "") && 
        	($contrato__timocodigos != NULL) && ($contrato__timocodigos != "") && 
        	($contrato__fopacodigos != NULL) && ($contrato__fopacodigos != "") && 
        	($contrato__contfchainin != NULL) && ($contrato__contfchainin != "") && 
        	($contrato__clieidentifs != NULL) && ($contrato__clieidentifs != "")){
        	$objServ = Application::loadServices("Data_type");
        	//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
			if($objServ->formatPrimaryKey($contrato__contnics) == false){
				WebRequest::setProperty('cod_message',$message = 4);
		   		return "fail";
       	   	}

 			//Hace la validacion de campos numericos y formateo de campos cadena
            if($contrato__contmonton == ""){
               $contrato__contmonton = "NULL";
            }
            //Hace la valicaion de fechas
            $serviceDate = Application :: loadServices("DateController");
            $contrato__contfchainin = $serviceDate->fncdatehourtoint($contrato__contfchainin);

            if($contrato__contfchafinn == ""){
               $contrato__contfchafinn = "NULL";
            }else{
	            $contrato__contfchafinn = $serviceDate->fncdatehourtoint($contrato__contfchafinn);
            }
            if($contrato__contfchfirmn == ""){
               $contrato__contfchfirmn = "NULL";
            }else{
            	$contrato__contfchfirmn = $serviceDate->fncdatehourtoint($contrato__contfchfirmn);
            }
       	   	//----
			$contrato_contdescrips = $objServ->formatString($contrato_contdescrips);
            $contrato_manager = Application::getDomainController('ContratoManager'); 
            $message = $contrato_manager->updateContrato($contrato__contnics,$contrato__clieidentifs,$contrato__ticocodigos,$contrato_contobjetos,$contrato__timocodigos,$contrato__contmonton,$contrato__fopacodigos,$contrato__contfchainin,$contrato__contfchafinn,$contrato__contfchfirmn,$contrato__contestados,$contrato_contdescrips); 
            WebRequest::setProperty('cod_message', $message);
            if($message == 3){ 
	            return "success"; 
            }else{
	            return "fail"; 
            }      
        }else{
            WebRequest::setProperty('cod_message',$message = 0);
            return "fail";
        }
    }
}
?>	
