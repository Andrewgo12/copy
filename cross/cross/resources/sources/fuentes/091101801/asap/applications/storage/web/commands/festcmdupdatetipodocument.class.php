<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdUpdateTipodocument {
    function execute()
    {
        extract($_REQUEST);
        if(($tipodocument__tidocodigos != NULL) && ($tipodocument__tidocodigos != "") && ($tipodocument__tidonombres != NULL) && ($tipodocument__tidonombres != "")){
        	$objServ = Application::loadServices("Data_type");
        	//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
			if($objServ->formatPrimaryKey($tipodocument__tidocodigos) == false){
				WebRequest::setProperty('cod_message',$message = 4);
		   		return "fail";
       	   	}
			//Hace la validacion de campos numericos y formateo de campos cadena
			$tipodocument__tidodescrips = $objServ->formatString($tipodocument__tidodescrips);
            $tipodocument_manager = Application::getDomainController('TipodocumentManager'); 
            $message = $tipodocument_manager->updateTipodocument($tipodocument__tidocodigos,$tipodocument__tidonombres,$tipodocument__tidodescrips,$tipodocument__tidoactivas); 
            WebRequest::setProperty('cod_message', $message);
            return "success";       
        }else{
            WebRequest::setProperty('cod_message',$message = 0);
            return "fail";
        }
    }
}
?>	
