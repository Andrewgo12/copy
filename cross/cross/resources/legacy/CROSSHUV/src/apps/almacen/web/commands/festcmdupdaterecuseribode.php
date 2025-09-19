<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdUpdateRecuseribode {
    function execute()
    {
        extract($_REQUEST);
        if(($recuseribode__resbnumedocu != NULL) && ($recuseribode__resbnumedocu != "") && ($recuseribode__recucodigos != NULL) && ($recuseribode__recucodigos != "") && ($recuseribode__resbserirecu != NULL) && ($recuseribode__resbserirecu != "") && ($recuseribode__resbbodeactu != NULL) && ($recuseribode__resbbodeactu != "") && ($recuseribode__resbbodeante != NULL) && ($recuseribode__resbbodeante != "") && ($recuseribode__resbfechmovi != NULL) && ($recuseribode__resbfechmovi != "") && ($recuseribode__perscodigos != NULL) && ($recuseribode__perscodigos != "")){
        	$objServ = Application::loadServices("Data_type");
        	//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
			if($objServ->formatPrimaryKey($recuseribode__) == false){
				WebRequest::setProperty('cod_message',$message = 4);
		   		return "fail";
       	   	}
			//Hace la validacion de campos numericos y formateo de campos cadena
			if($objServ->isInteger($recuseribode__resbfechmovi) == false){
				WebRequest::setProperty('cod_message',$message = 4);
		   		return "fail";
       	   	}
            $recuseribode_manager = Application::getDomainController('RecuseribodeManager'); 
            $message = $recuseribode_manager->updateRecuseribode($recuseribode__resbnumedocu,$recuseribode__recucodigos,$recuseribode__resbserirecu,$recuseribode__resbbodeactu,$recuseribode__resbbodeante,$recuseribode__resbfechmovi,$recuseribode__perscodigos); 
            WebRequest::setProperty('cod_message', $message);
            return "success";       
        }else{
            WebRequest::setProperty('cod_message',$message = 0);
            return "fail";
        }
    }
}
?>	
