<?php
require_once "Web/WebRequest.class.php";
require_once "JSON/JSON.php";
class FeGeCmdUpdateIntelogdoc {
	function execute() {
		extract($_REQUEST);

		settype($objJson, "object");
		settype($objService,"object");
		settype($objManager, "object");
		settype($rcResult, "array");
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

		if(isset($nmbre_srie) && $nmbre_srie &&  isset($nmbre_tpo_crpta) && $nmbre_tpo_crpta
		&& isset($nmbre_crpta) && $nmbre_crpta && isset($nmbre_tpo_dcto) && $nmbre_tpo_dcto
		&& isset($nmbre_dcto) && $nmbre_dcto &&  isset($ext) && $ext && isset($fncnrio) && $fncnrio
		&& isset($inlocodigon) && $inlocodigon && isset($d_id_cross) && $d_id_cross){
			
			 $nmbre_srie = $objService->formatString($nmbre_srie);
			 $nmbre_tpo_crpta = $objService->formatString($nmbre_tpo_crpta);
			 $nmbre_crpta = $objService->formatString($nmbre_crpta);
			 $nmbre_tpo_dcto = $objService->formatString($nmbre_tpo_dcto);
			 $nmbre_dcto = $objService->formatString($nmbre_dcto);
			 $ext = $objService->formatString($ext);
			 $fncnrio = $objService->formatString($fncnrio);
			
			$objManager = Application :: getDomainController('IntegraLogManager');
			$objManager->setData(array("inlocodigon"=>$inlocodigon,"nmbre_srie"=>$nmbre_srie,"nmbre_tpo_crpta"=>$nmbre_tpo_crpta,
															"nmbre_crpta"=>$nmbre_crpta,"nmbre_tpo_dcto"=>$nmbre_tpo_dcto,
															"nmbre_dcto"=>$nmbre_dcto,"ext"=>$ext,"fncnrio"=>$fncnrio,
															"d_id_cross"=>$d_id_cross));
			$objManager->setIntelogdoc();
			$rcTmp = $objManager->getResult();

			if($rcTmp && is_array($rcTmp) && $rcTmp["result"]){
				$rcResult[0]=1;
				$rcResult[1]= $objService->encode(html_entity_decode($rcmessages[$rcTmp["message"]]));
			}else{
				$rcResult[0] = 0;
				$rcResult[1]= $objService->encode(html_entity_decode($rcmessages[$rcTmp["message"]]));
			}
		}else{
			$rcResult[0] = 0;
			$rcResult[1]= $objService->encode(html_entity_decode($rcmessages[0]));
		}

		$sbOutput = $objJson->encode($rcResult);
		die($sbOutput);
	}
}
?>