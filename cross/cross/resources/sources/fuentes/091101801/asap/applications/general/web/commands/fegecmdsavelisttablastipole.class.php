<?php
require_once "Web/WebRequest.class.php";
require_once "JSON/JSON.php";
class FeGeCmdSaveListTablastipole {
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
		
		if($tatlnomtabls && $tatlnomcacos && $tatlnocadess && $tatlvalcods 
		&& $tatlvaldescs && $langcodigos && $tatlvaldesls){
			
			$tatlvalcods = $objService->decode($tatlvalcods);
			$tatlvaldescs = $objService->decode($tatlvaldescs);
			$tatlvaldesls = $objService->decode($tatlvaldesls);
			
			if($sbCharset=='UTF-8'){
				$tatlvaldescs = utf8_encode($tatlvaldescs);
				$tatlvaldesls = utf8_encode($tatlvaldesls);	
			}
			
			$objManager = Application :: getDomainController('TablastipoleManager'); 
			$objManager->setData(array("tatlcodigos"=>$tatlcodigos,"tatlnomtabls"=>$tatlnomtabls,"tatlnomcacos"=>$tatlnomcacos,
									   "tatlnocadess"=>$tatlnocadess,"tatlvalcods"=>$tatlvalcods,"tatlvaldescs"=>$tatlvaldescs,
									   "langcodigos"=>$langcodigos,"tatlvaldesls"=>$tatlvaldesls));
			$objManager->saveTablastipole();
			$rcTmp = $objManager->getResult();
			if($rcTmp["result"]){
				//grabado exitoso
				$rcResult[0] = 1;
				$rcmessages[$rcTmp["message"]] = $objService->my_html_entity_decode($rcmessages[$rcTmp["message"]]);
				if($sbCharset=='UTF-8'){
					$rcmessages[$rcTmp["message"]] = utf8_decode($rcmessages[$rcTmp["message"]]);
				}
				$rcResult[1]= $objService->encode($rcmessages[$rcTmp["message"]]);
				
				if($rcTmp["tatlcodigos"]){
					
					$rcResult[2] = $rcTmp["tatlcodigos"];
					$rcResult[3] = $objService->encode($objService->my_html_entity_decode($tatlvalcods));
				}
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