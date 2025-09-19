<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdUpdateBodega {
    function execute()
    {
        extract($_REQUEST);
        if(($bodega__bodecodigos != NULL) && ($bodega__bodecodigos != "") && ($bodega__tibocodigos != NULL) && ($bodega__tibocodigos != "") && ($bodega__bodenombres != NULL) && ($bodega__bodenombres != "") && ($bodega__orgacodigos != NULL) && ($bodega__orgacodigos != "") && ($bodega__bodefechcred != NULL) && ($bodega__bodefechcred != "")){
        	$objServ = Application::loadServices("Data_type");
        	//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
			if($objServ->formatPrimaryKey($bodega__bodecodigos) == false){
				WebRequest::setProperty('cod_message',$message = 4);
		   		return "fail";
       	   	}
			//Hace la validacion de campos numericos y formateo de campos cadena
			$bodega__bodedescrips = $objServ->formatString($bodega__bodedescrips);
			$bodega__bodefechfind = $objServ->formatString($bodega__bodefechfind);
            $bodega_manager = Application::getDomainController('BodegaManager'); 
            $message = $bodega_manager->updateBodega($bodega__bodecodigos,$bodega__tibocodigos,$bodega__bodenombres,$bodega__bodedescrips,$bodega__orgacodigos,$bodega__bodefechcred,$bodega__bodefechfind,$bodega__bodeestados); 
            WebRequest::setProperty('cod_message', $message);
            return "success";       
        }else{
            WebRequest::setProperty('cod_message',$message = 0);
            return "fail";
        }
    }
}
?>	
