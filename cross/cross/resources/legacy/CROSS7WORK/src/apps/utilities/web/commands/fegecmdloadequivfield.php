<?php
require_once "Web/WebRequest.class.php";
require_once "JSON/JSON.php";
class FeGeCmdloadEquivField {
	function execute() {
		extract($_REQUEST);

		settype($objJson, "object");
		settype($objService,"object");
		settype($rcResult, "array");
		settype($rcUser,"array");
		settype($rcTmp,"array");
		settype($rcRow,"array");
		settype($sbOutput, "string");
		settype($sbHtml,"string");
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

		if(isset($signal) && $signal && $table){
				
			if($signal==1){
				$rcTmp = Application :: getConstant("EQUIV_CROSS");
			}else{
				if($signal==2){
					$rcTmp = Application :: getConstant("EQUIV_DOCUNET");
				}else{
					$rcTmp = Application :: getConstant("EQUIV_VITAL");
				}
			}

			if($rcTmp && is_array($rcTmp)){

				foreach($rcTmp as $nuCont=>$rcRow){
					if(isset($rcRow[$table]) && $rcRow[$table]){
						$sbHtml = $rcRow[$table];
						break;
					}
				}

				if($sbHtml){
					$rcResult[0]=1;
					$rcResult[1]=$objService->encode($sbHtml);
					$rcResult[2]= "";
					$rcResult[3]= $signal;
				}else{
					$rcResult[0] = 0;
					$rcResult[1]= "";
					$rcResult[2]= $objService->encode(html_entity_decode($rcmessages[0]));
					$rcResult[3]= $signal;
				}
			}else{
				$rcResult[0] = 0;
				$rcResult[1]= "";
				$rcResult[2]= $objService->encode(html_entity_decode($rcmessages[0]));
				$rcResult[3]= $signal;
			}
		}else{
			$rcResult[0] = 0;
			$rcResult[1]= "";
			$rcResult[2]= "";
			$rcResult[3]= $signal;
		}

		$sbOutput = $objJson->encode($rcResult);
		die($sbOutput);
	}
}
?>