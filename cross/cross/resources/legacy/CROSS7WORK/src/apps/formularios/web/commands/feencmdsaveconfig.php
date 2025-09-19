<?php
require_once "Web/WebRequest.class.php";
require_once "JSON/JSON.php";
class FeEnCmdSaveConfig {
	function execute() {
		extract($_REQUEST);

		settype($objJson, "object");
		settype($objService,"object");
		settype($objManager, "object");
		settype($rcData,"array");
		settype($rcResult, "array");
		settype($rcSession,"array");
		settype($rcUser,"array");
		settype($rcTmp,"array");
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
		$sbCharset = strtoupper(ini_get("default_charset")) ;

		//se valida que no se haya cambiado de formulario
		$rcSession = WebSession :: getProperty("_rcConfigEncuesta");
		
		if($rcSession[1] && is_array($rcSession[1])){
			//valida que no haya relacion con respuestas de ususario
			$objManager = Application::getDomainController('RespuestausuManager');
			$objManager->setData(array("formcodigon"=>$rcSession[0]["formcodigon"]));
			$objManager->getByIdFormulario();
			$rcData = $objManager->getResult();
			 
			if(!$rcData){
				$objManager = Application :: getDomainController('PregformulaManager'); 
				$objManager->setData($rcSession);
				$objManager->addConfiguration();
				$rcTmp = $objManager->getResult();
				if($rcTmp["result"]){
					WebSession :: unsetProperty("_rcConfigEncuesta");
					//grabado exitoso
					$rcResult[0] = 1;
					$rcmessages[3] = $objService->my_html_entity_decode($rcmessages[3]);
					if($sbCharset=='UTF-8'){
						$rcmessages[3] = utf8_decode($rcmessages[3]);
					}
					$rcResult[1]= $objService->encode($rcmessages[3]);
				}else{
					//grabado exitoso
					$rcResult[0] = 0;
					$rcmessages[100] = $objService->my_html_entity_decode($rcmessages[100]);
					if($sbCharset=='UTF-8'){
						$rcmessages[100] = utf8_decode($rcmessages[100]);
					}
					$rcResult[1]= $objService->encode($rcmessages[100]);
				}	
			}else{
				//resultado de los * son obligatorios
				$rcResult[0]=0;
				$rcmessages[30] = $objService->my_html_entity_decode($rcmessages[30]);
				if($sbCharset=='UTF-8'){
					$rcmessages[30] = utf8_decode($rcmessages[30]);
				}
				$rcResult[1]= $objService->encode($rcmessages[30]);
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
}
?>