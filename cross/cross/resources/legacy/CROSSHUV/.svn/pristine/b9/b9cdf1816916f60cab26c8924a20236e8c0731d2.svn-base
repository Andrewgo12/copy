<?php
require_once "Web/WebRequest.class.php";
require_once "JSON/JSON.php";
class FeCuCmdLoadPaciente {
	function execute() {
		extract($_REQUEST);

		settype($objJson, "object");
		settype($objService,"object");
		settype($objGateway, "object");
		settype($objGeneral, "object");
		settype($objDate, "object");
		settype($rcResult, "array");
		settype($rcUser,"array");
		settype($rcTmp,"array");
		settype($rcTmpL, "array");
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

		if(isset($paciindentis) && $paciindentis){

			$objDate = Application :: loadServices("DateController");

			$objGateway =Application :: getDataGateway("paciente");
			$objGateway->setData(array("paciindentis"=>$paciindentis));
			$objGateway->getPaciente();
			$rcTmp = $objGateway->getResult();

			if($rcTmp && is_array($rcTmp)){

				$rcTmp = $rcTmp[0];
				if($rcTmp["pacifecnacis"]){
					$rcTmp["pacifecnacis"] = $objDate->fncformatofecha($rcTmp["pacifecnacis"]);
				}

				if($rcTmp["locacodigos"]){
					$objGeneral = Application :: loadServices("General");
					$objGateway = $objGeneral->getGateWay("localizacion");
					$rcTmpL = $objGateway->getByIdLocalizacion($rcTmp["locacodigos"]);
					$objGeneral->close();
					if(is_array($rcTmpL) && $rcTmpL){
						$rcTmp["paciente_locacodigos_desc"] = $rcTmpL[0]["locanombres"];
					}
				}

				$rcResult[0]=1;
				$rcResult[1] = $objService->encode($rcTmp["paciindentis"]);
				$rcResult[2] = $objService->encode($rcTmp["tiidcodigos"]);
				$rcResult[3] = $objService->encode($rcTmp["paciprinoms"]);
				$rcResult[4] = $objService->encode($rcTmp["pacisegnoms"]);				
				$rcResult[5] = $objService->encode($rcTmp["pacipriapes"]);
				$rcResult[6] = $objService->encode($rcTmp["pacisegapes"]);
				$rcResult[7] = $objService->encode($rcTmp["pacifecnacis"]);
				$rcResult[8] = $objService->encode($rcTmp["sexocodigos"]);
				$rcResult[9] = $objService->encode($rcTmp["paciemail"]);
				$rcResult[10] = $objService->encode($rcTmp["locacodigos"]);
				$rcResult[11] = $objService->encode($rcTmp["pacidirecios"]);
				$rcResult[12] = $objService->encode($rcTmp["pacitelefons"]);
				$rcResult[13] = $objService->encode($rcTmp["pacinumcels"]);
				$rcResult[14] = $objService->encode($rcTmp["pacihisclis"]);
				$rcResult[15] = $objService->encode($rcTmp["paciobservs"]);
				$rcResult[16] = $objService->encode($rcTmp["paciactivos"]);
				$rcResult[17] = $objService->encode($rcTmp["paciente_locacodigos_desc"]);
			}else{
				$rcResult[0] = 0;
				$rcResult[1] = $objService->encode(html_entity_decode($rcmessages[23]));
				$rcResult[2] = "";
				$rcResult[3] = "";
				$rcResult[4] = "";
				$rcResult[5] = "";
				$rcResult[6] = "";
				$rcResult[7] = "";
				$rcResult[8] = "";
				$rcResult[9] = "";
				$rcResult[10] = "";
				$rcResult[11] = "";
				$rcResult[12] = "";
				$rcResult[13] = "";
				$rcResult[14] = "";
				$rcResult[15] = "";
				$rcResult[16] = "";
				$rcResult[17] = "";
			}
		}else{
			$rcResult[0] = 0;
			$rcResult[1]= $objService->encode(html_entity_decode($rcmessages[0]));
			$rcResult[2] = "";
			$rcResult[3] = "";
			$rcResult[4] = "";
			$rcResult[5] = "";
			$rcResult[6] = "";
			$rcResult[7] = "";
			$rcResult[8] = "";
			$rcResult[9] = "";
			$rcResult[10] = "";
			$rcResult[11] = "";
			$rcResult[12] = "";
			$rcResult[13] = "";
			$rcResult[14] = "";
			$rcResult[15] = "";
			$rcResult[16] = "";
			$rcResult[17] = "";
		}

		$sbOutput = $objJson->encode($rcResult);
		die($sbOutput);
	}
}
?>