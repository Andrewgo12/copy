<?php
require_once "Web/WebRequest.class.php";
require_once "JSON/JSON.php";
class FeGeCmdDeleteEnte {
	function execute() {
		extract($_REQUEST);

		settype($objJson, "object");
		settype($objService,"object");
		settype($objManager, "object");
		settype($rcResult, "array");
		settype($rcTmp,"array");
		settype($rcRow,"array");
		settype($rcSession,"array");
		settype($rcData,"array");
		settype($rcUser,"array");
		settype($sbHtml,"string");
		settype($sbOutput, "string");
		settype($sbCharset, "string");
		settype($nuCont,"integer");

		
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

		if($orgacodigos){
			
			//se valida que no se haya cambiado de formulario
			$rcSession = WebSession :: getProperty("_rcRelacionTarea_Persona");
			
			if($rcSession && is_array($rcSession)){
				$rcData = $rcSession[1];
				//se recorre el arreglo de sesion quitando la persona
				if($rcData && is_array($rcData)){
					foreach($rcData as $rcRow){
						if($rcRow["orgacodigos"]!=$orgacodigos){
							$rcTmp[$nuCont]=$rcRow;
							$nuCont++;
						}
					}	
				}
				$rcSession[1]=$rcTmp;
				WebSession :: setProperty("_rcRelacionTarea_Persona",$rcSession);
				$sbHtml = $this->drawList();
					
				$rcResult[0]=1;
				$rcResult[1]=$sbHtml;
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

	function drawList(){

		settype($sbPath,"string");
		settype($sbHtml,"string");
			
		$sbPath = Application::getPluginsDirectory()."/function.drawRelacion.php";
		include($sbPath);
		$sbHtml = smarty_function_drawRelacion(array(),$this,false);
		return $sbHtml;
	}
}
?>