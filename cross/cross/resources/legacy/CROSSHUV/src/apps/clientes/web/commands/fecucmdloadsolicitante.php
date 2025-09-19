<?php
require_once "Web/WebRequest.class.php";
require_once "JSON/JSON.php";
class FeCuCmdLoadSolicitante {
	function execute() {
		extract($_REQUEST);

		settype($objJson, "object");
		settype($objService,"object");
		settype($objManager, "object");
		settype($objDate, "object");
		settype($rcResult, "array");
		settype($rcUser,"array");
		settype($rcTmp,"array");
		settype($rcTmpD, "array");
		settype($rcSession,"array");
		settype($rcData, "array");
		settype($sbOutput, "string");
		settype($sbHtml,"string");
		settype($sbIndex, "string");
		settype($sbField, "string");
		settype($sbValue, "string");
		settype($sbPos, "string");
		settype($sbTmp, "string");
		settype($sbIndexD, "string");

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

		if(isset($type) && $type && isset($objvalue) && $objvalue){

			$objDate = Application :: loadServices("DateController");

			if ((WebSession :: issetProperty("_rcSolicitante"))) {
				$rcSession = WebSession :: getProperty("_rcSolicitante");
			}

			$objManager = Application :: getDomainController('SolicitanteManager');

			switch ($type) {
				case "1":
					$objManager->setData(array("contindentis"=>$objvalue));
					$objManager->getContacto();
					$sbIndex = "contacto";
					$sbField = "contindentis";

					//trabajo de almacenar lo que hay en la forma
					if(!$rcSession["cliente"]["cliecodigos"]){
						$rcTmpD = unserialize($objService->decode($sbData));
						foreach ($rcTmpD as $sbIndexD => $sbValue) {
							$sbPos = strpos($sbIndexD, "__");
							if (!($sbPos === false)) {
								$sbTmp = substr($sbIndexD, ($sbPos +2));
								$rcSession["cliente"][$sbTmp] = $sbValue;
							}else{
								$rcSession["cliente"][$sbIndexD] = $sbValue;
							}
						}
						if($rcSession["cliente"]["locacodigos"]){
							$rcSession["cliente"]["locacodigos_c"] = $rcSession["cliente"]["locacodigos"];
							unset($rcSession["cliente"]["locacodigos"]);
						}
						if($rcSession["cliente"]["tiidcodigos"]){
							$rcSession["cliente"]["tiidcodigos_c"] = $rcSession["cliente"]["tiidcodigos"];
							unset($rcSession["cliente"]["tiidcodigos"]);
						}
					}
					break;
				case "2":
					$objManager->setData(array("clieidentifs"=>$objvalue));
					$objManager->getCliente();
					$sbIndex = "cliente";
					$sbField = "clieidentifs";

					//trabajo de almacenar lo que hay en la forma
					if(!$rcSession["contacto"]["contcodigon"]){
						$rcTmpD = unserialize($objService->decode($sbData));
						foreach ($rcTmpD as $sbIndexD => $sbValue) {
							$sbPos = strpos($sbIndexD, "__");
							if (!($sbPos === false)) {
								$sbTmp = substr($sbIndexD, ($sbPos +2));
								$rcSession["contacto"][$sbTmp] = $sbValue;
							}else{
								$rcSession["contacto"][$sbIndexD] = $sbValue;
							}
						}
					}
					break;
			}

			$rcTmp = $objManager->getResult();

			if($rcTmp && is_array($rcTmp) && $rcTmp["result"]){

				$rcData = $rcTmp["data"];

				switch ($type) {
					case "1":
						if($rcData["contfecnacis"]){
							$rcData["contfecnacis"] = $objDate->fncformatofechahora($rcData["contfecnacis"]);
						}
						if($rcData["locanombres"]){
							$rcData["contacto_locacodigos_desc"] = $rcData["locanombres"];
							unset($rcData["locanombres"]);
						}
						break;
					case "2":
						if($rcData["locacodigos"]){
							$rcData["locacodigos_c"] = $rcData["locacodigos"];
							$rcData["cliente_locacodigos_desc"] = $rcData["locanombres"];
							unset($rcData["locanombres"]);
							unset($rcData["locacodigos"]);
						}
						if($rcData["tiidcodigos"]){
							$rcData["tiidcodigos_c"] = $rcData["tiidcodigos"];
							unset($rcData["tiidcodigos"]);
						}
						break;
				}

				$rcSession[$sbIndex] = $rcData;

				WebSession :: setProperty("_rcSolicitante",$rcSession);

				$sbHtml = $this->drawList();

				$rcResult[0]=1;
				$rcResult[1]=$objService->encode($sbHtml);

				switch ($type) {
					case "1":
						$rcResult[2] = $objService->encode($rcData["contcodigon"]);
						break;
					case "2":
						$rcResult[2] = $objService->encode($rcData["cliecodigos"]);
						break;
				}
				$rcResult[3] = $type;
			}else{

				$rcData[$sbField] = $objvalue;
				$rcSession[$sbIndex] = $rcData ;
				WebSession :: setProperty("_rcSolicitante",$rcSession);
				$sbHtml = $this->drawList();
				$rcResult[0] = 0;
				$rcResult[1]= $objService->encode($sbHtml);
				$rcResult[2] = "";
				$rcResult[3] = $type;
			}
		}else{
			$rcResult[0] = 0;
			$rcResult[1]= $objService->encode(html_entity_decode($rcmessages[0]));
			$rcResult[2] = "";
			$rcResult[3] = "";
		}

		$sbOutput = $objJson->encode($rcResult);
		die($sbOutput);
	}

	function drawList(){

		settype($sbPath,"string");
		settype($sbHtml,"string");
			
		$sbPath = Application::getPluginsDirectory()."/function.drawSolicitante.php";
		include($sbPath);
		$sbHtml = smarty_function_drawSolicitante(array(),$this,false);
		return $sbHtml;
	}
}
?>