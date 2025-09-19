<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdUpdateTipobodega {
    function execute()
    {
        extract($_REQUEST);
        if(($tipobodega__tibocodigos != NULL) && ($tipobodega__tibocodigos != "") && ($tipobodega__tibonombres != NULL) && ($tipobodega__tibonombres != "")){
        	$objServ = Application::loadServices("Data_type");
        	//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
			if($objServ->formatPrimaryKey($tipobodega__tibocodigos) == false){
				WebRequest::setProperty('cod_message',$message = 4);
		   		return "fail";
       	   	}
			//Hace la validacion de campos numericos y formateo de campos cadena
			$tipobodega__tibodescrips = $objServ->formatString($tipobodega__tibodescrips);
            $tipobodega_manager = Application::getDomainController('TipobodegaManager'); 
            $message = $tipobodega_manager->updateTipobodega($tipobodega__tibocodigos,$tipobodega__tibonombres,$tipobodega__tibodescrips); 
            WebRequest::setProperty('cod_message', $message);
            return "success";       
        }else{
            WebRequest::setProperty('cod_message',$message = 0);
            return "fail";
        }
    }
}
?>	
