<?php
require_once "Web/WebRequest.class.php";
require_once "JSON/JSON.php";
class FeGeCmdCentroComunicacionConsult {
	function execute() {
		extract($_REQUEST);

		settype($objJson, "object");
		settype($objDate,"object");
		settype($objService,"object");
		settype($rcResult, "array");
		settype($rcTmp,"array");
		settype($rcUser,"array");
		settype($rcParams,"array");
		settype($sbHtml,"string");
		settype($sbOutput, "string");
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
		$objDate = Application :: loadServices("DateController");
		$sbCharset = strtoupper(ini_get("default_charset")) ;

		if($ordefecregdi && $ordefecregdf){
			
			//se arma el arreglo de parametros
			$rcParams["ordefecregdi"] = $objDate->fncdatehourtoint($ordefecregdi);
			$rcParams["ordefecregdf"] = $objDate->fncdatehourtoint($ordefecregdf);
			 
			if($ordenumeros){
				$rcParams["ordenumeros"] =$ordenumeros;
			}
			
			if($focacodigos){
				$rcParams["focacodigos"] =$focacodigos;
			}  
			
			if($comuestados){
				$rcParams["comuestados"] =$comuestados;
			}
			
			$sbHtml = $this->drawList($rcParams);
			if($sbHtml){
				$rcResult[0]=1;
			$rcResult[1]=$objService->encode($sbHtml);	
			}else{
				$rcResult[0]=0;
				$rcmessages[68] = $objService->my_html_entity_decode($rcmessages[68]);
				if($sbCharset=='UTF-8'){
					$rcmessages[68] = utf8_decode($rcmessages[68]);
				}
				$rcResult[1]= $objService->encode($rcmessages[68]);
			}
			
		}else{
			//resultado de los * son obligatorios
			$rcResult[0]=0;
			$rcmessages[0] = $objService->my_html_entity_decode($rcmessages[0]);
			if($sbCharset=='UTF-8'){
				$rcmessages[0] = utf8_decode($rcmessages[0]);
			}
			$rcResult[1]= $objService->encode($rcmessages[0]);
		}

		$sbOutput = $objJson->encode($rcResult);
		die($sbOutput);
	}

	function drawList($rcParams){

		settype($sbPath,"string");
		settype($sbHtml,"string");
			
		$sbPath = Application::getPluginsDirectory()."/function.drawListCom.php";
		include($sbPath);
		$sbHtml = smarty_function_drawListCom($rcParams,$this,false);
		return $sbHtml;
	}
}
	?>