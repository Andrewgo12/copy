<?php
require_once "Web/WebRequest.class.php";
require_once "JSON/JSON.php";
class FeGeCmdSendIntegraLog {
	function execute() {
		extract($_REQUEST);

		settype($objJson, "object");
		settype($objService,"object");
		settype($objManager,"object");
		settype($rcResult, "array");
		settype($rcTmp,"array");
		settype($rcUser,"array");
		settype($sbOutput, "string");

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

		if(isset($inlocodigon) && $inlocodigon){
			
			$objManager = Application :: getDomainController('IntegraLogManager');
			$objManager->setData(array("inlocodigon"=>$inlocodigon));
			$objManager->sendIntegration();
			$rcTmp = $objManager->getResult();
			
			if($rcTmp["result"]=="succes"){
				//resultado de los * son obligatorios
				$rcResult[0]=1;
				$rcResult[1]= $objService->encode(html_entity_decode($rcmessages[3]));
				$rcResult[2]= $inlocodigon;
				$rcResult[3]= $objService->encode($rcTmp["text_error"]);
				$rcResult[4]= $objService->encode($rcTmp["fecha_mod"]);
				$rcResult[5]= "";
			}else{
				if($rcTmp["result"]=="fail"){
					//resultado de los * son obligatorios
					$rcResult[0]=2;
					$rcResult[1]= $objService->encode(html_entity_decode($rcmessages[$rcTmp["message"]]));
					$rcResult[2]= $inlocodigon;
					$rcResult[3]= $objService->encode($rcTmp["text_error"]);
					$rcResult[4]= "";
					$rcResult[5]= "";
				}else{
					if($rcTmp["result"]=="error"){
						//resultado de los * son obligatorios
						$rcResult[0]=3;
						$rcResult[1]= $objService->encode(html_entity_decode($rcmessages[100]));
						$rcResult[2]= $inlocodigon;
						$rcResult[3]= "";
						$rcResult[4]= "";
						$rcResult[5]= "";
					}
				}
			}
		}else{
			//resultado de los * son obligatorios
			$rcResult[0]=3;
			$rcResult[1]= $objService->encode(html_entity_decode($rcmessages[0]));
			$rcResult[2]= $inlocodigon;
			$rcResult[3]= "";
			$rcResult[4]= "";
			$rcResult[5]= "";
		}

		$sbOutput = $objJson->encode($rcResult);
		die($sbOutput);
	}
}
?>