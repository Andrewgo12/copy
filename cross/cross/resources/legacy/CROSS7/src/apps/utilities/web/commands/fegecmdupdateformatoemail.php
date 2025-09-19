<?php
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
Class FeGeCmdUpdateFormatoemail {

    function execute()
    {
        extract($_REQUEST);

        if(($formatoemail__foemcodigos != NULL) && ($formatoemail__foemcodigos != "") 
        && ($formatoemail__foemnombres != NULL) && ($formatoemail__foemnombres != "")
        && ($formatoemail__foemasuntos != NULL) && ($formatoemail__foemasuntos != "") 
        && ($formatoemail__foemplantils != NULL) && ($formatoemail__foemplantils != "")){
        	$objServ = Application::loadServices("Data_type");
        	//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
		    
			if($objServ->formatPrimaryKey($formatoemail__foemcodigos) == false){
				WebRequest::setProperty('cod_message',$message = 4);
		   		return "fail";
       	   	}

			//Hace la validacion de campos numericos y formateo de campos cadena
			$formatoemail__foemnombres = $objServ->formatString($formatoemail__foemnombres);
			$formatoemail__foemasuntos = $objServ->formatString($formatoemail__foemasuntos);
			$formatoemail__foemplantils = $objServ->formatString($formatoemail__foemplantils);
		    
            $formatoemail_manager = Application::getDomainController('FormatoemailManager'); 
            $message = $formatoemail_manager->updateFormatoemail($formatoemail__foemcodigos,$formatoemail__foemnombres,$formatoemail__foemasuntos
            ,$formatoemail__foemplantils,$formatoemail__foemestados); 
            WebRequest::setProperty('cod_message', $message);
            return "success";       
        }else{
            WebRequest::setProperty('cod_message',$message = 0);
            return "fail";
        }
    }
}
?>