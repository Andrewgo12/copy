<?php
require_once "Web/WebRequest.class.php";
require_once "JSON/JSON.php";
class FeGeCmdDeleteRelacion {
	function execute() {
		extract($_REQUEST);

		settype($objJson, "object");
		settype($objService,"object");
		settype($objManager, "object");
		settype($rcResult, "array");
		settype($rcUser,"array");
		settype($rcTmp,"array");
		settype($sbOutput, "string");
		settype($sbCharset, "string");
		settype($nuMessage,"integer");
		
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
		
		if($proccodigos && $tarecodigos){
			
			$objManager = Application :: getDomainController('RelatarepersManager'); 
			$objManager->setData(array("proccodigos"=>$proccodigos,"tarecodigos"=>$tarecodigos));
			$objManager->deleteRelacion();
			$rcTmp = $objManager->getResult();
			if($rcTmp["result"]){
				//exito
				$rcResult[0] = 1;
				$rcmessages[3] = $objService->my_html_entity_decode($rcmessages[3]);
				if($sbCharset=='UTF-8'){
					$rcmessages[3] = utf8_decode($rcmessages[3]);
				}
				$rcResult[1]= $objService->encode($rcmessages[3]);
			}else{
				//que paso?
				$rcResult[0] = 0;
				switch($rcTmp["error"]){
					case 1:
						$nuMessage=100;
					break;
					case 2:
						$nuMessage = 73;
					break;
					case 3:
						$nuMessage = 0;
					break;
				}
				$rcmessages[$nuMessage] = $objService->my_html_entity_decode($rcmessages[$nuMessage]);
				if($sbCharset=='UTF-8'){
					$rcmessages[$nuMessage] = utf8_decode($rcmessages[$nuMessage]);
				}
				$rcResult[1]= $objService->encode($rcmessages[$nuMessage]);
			}
		}else{
			//resultado de los * son obligatorios
			$rcResult[0] = 0;
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