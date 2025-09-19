<?php 
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
require_once "JSON/JSON.php";
class FeGeCmdCentroComunicacionDelete {
	function execute() {
		
		extract($_REQUEST);
		settype($objCentroComunicacion,"object");
		settype($rccomucodigos,"array");
		settype($objJson, "object");
		settype($objService,"object");
		settype($rcResult, "array");
		settype($rcUser,"array");
		settype($sbHtml,"string");
		settype($sbOutput, "string");
		settype($sbmessage,"string");
		settype($sbCharset, "string");
		
		//labels
		//Trae los datos del usuario
		$rcUser = Application :: getUserParam();
		if (!is_array($rcUser)) {
			//Si no existe usuario en sesion
			$rcUser["lang"] = Application :: getSingleLang();
		}
		include ($rcUser["lang"]."/".$rcUser["lang"].".messages.php");
		
		$objJson = new Services_JSON();
		$objService = Application :: loadServices("Data_type");
		$sbCharset = strtoupper(ini_get("default_charset")) ;
		
		if($comucodigos){
			
			$rccomucodigos = explode(",",$comucodigos);
			$objCentroComunicacion = Application :: getDomainController('CentroComunicacionManager');
			$sbmessage = $objCentroComunicacion->fncDeleteComunicacionSet($rccomucodigos);
			if($sbmessage==3){
				$rcResult[0]=1;
			}else{
				$rcResult[0]=0;
			}
		}else{
			$sbmessage = 30;
			$rcResult[0]=0;	
		}
		
		$rcmessages[$sbmessage] = $objService->my_html_entity_decode($rcmessages[$sbmessage]);
		if($sbCharset=='UTF-8'){
			$rcmessages[$sbmessage] = utf8_decode($rcmessages[$sbmessage]);
		}
		$rcResult[1]= $objService->encode($rcmessages[$sbmessage]);
		
		$sbOutput = $objJson->encode($rcResult);
		die($sbOutput);
	}
}
?>	