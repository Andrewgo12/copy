<?php
require_once "Web/WebRequest.class.php";
require_once "JSON/JSON.php";
class FeEnCmdSaveEncuesta {
	function execute() {
		extract($_REQUEST);

		settype($objJson, "object");
		settype($objDate, "object");
		settype($objService,"object");
		settype($objServiceCU,"object");
		settype($objGateway, "object");
		settype($objManager, "object");
		settype($rcResult, "array");
		settype($rcSession,"array");
		settype($rcSelect,"array");
		settype($rcIndex,"array");
		settype($rcUser,"array");
		settype($rcTmp,"array");
		settype($rcRow,"array");
		settype($sbResult,"string");
		settype($sbOutput, "string");
		settype($sbIndex,"string");
		settype($sbValue,"string");
		settype($sbFlag,"string");
		settype($sbCharset, "string");
		
		$sbFlag = false;
		
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

		//se valida que no se haya cambiado de formulario
		$rcSession = WebSession :: getProperty("_rcEncuesta");
		
		if($rcSession["select"] && is_array($rcSession["select"])){
			
			if(!$orgacodigos || !$paciindentis){
				//resultado de los * son obligatorios
				$rcResult[0] = 0;
				$rcmessages[0] = $objService->my_html_entity_decode($rcmessages[0]);
				if($sbCharset=='UTF-8'){
					$rcmessages[0] = utf8_decode($rcmessages[0]);
				}
				$rcResult[1]= $objService->encode($rcmessages[0]);
				$sbOutput = $objJson->encode($rcResult);
				die($sbOutput);
			}
			
			//se valida la orden si viene
			if($ordenumeros){
				$objManager = Application :: loadServices("Cross300");
				$sbResult = $objManager->fncValidateExistenceOrder($ordenumeros);
				if(!$sbResult){
					//resultado de los * son obligatorios
					$rcResult[0] = 0;
					$rcmessages[8] = $objService->my_html_entity_decode($rcmessages[8]);
					if($sbCharset=='UTF-8'){
						$rcmessages[8] = utf8_decode($rcmessages[8]);
					}
					$rcResult[1]= $objService->encode($rcmessages[8]);
					$sbOutput = $objJson->encode($rcResult);
					die($sbOutput);
				}
			}
			
			//se valida el solicitante si viene
			if($contidentis){
				$objManager = Application :: loadServices("Customers");
				$sbResult = $objManager->existActiveSolicitanteByIdentis($contidentis);
				if(!$sbResult){
					//resultado de los * son obligatorios
					$rcResult[0] = 0;					
					$rcmessages[9] = $objService->my_html_entity_decode($rcmessages[9]);
					if($sbCharset=='UTF-8'){
						$rcmessages[9] = utf8_decode($rcmessages[9]);
					}
					$rcResult[1]= $objService->encode($rcmessages[9]);
					$sbOutput = $objJson->encode($rcResult);
					die($sbOutput);
				}
			}
			
			if($paciindentis){
				$objServiceCU = Application :: loadServices("Customers");
				$objGateway = $objServiceCU->loadGateway("paciente");
				$sbResult = $objGateway->existPacienteByIdentis($paciindentis);
				$objServiceCU->close();
				if(!$sbResult){
					//resultado de los * son obligatorios
					$rcResult[0] = 0;					
					$rcmessages[38] = $objService->my_html_entity_decode($rcmessages[38]);
					if($sbCharset=='UTF-8'){
						$rcmessages[38] = utf8_decode($rcmessages[38]);
					}
					$rcResult[1]= $objService->encode($rcmessages[38]);
					$sbOutput = $objJson->encode($rcResult);
					die($sbOutput);
				}
			}
			
			//se valida la dependencia si viene
			if($orgacodigos){
				$objManager = Application :: loadServices("Human_resources");
				$rcTmp = $objManager->getOrganizacionActiveByOrgacodigos($orgacodigos);
				if(!$rcTmp || !is_array($rcTmp)){
					//resultado de los * son obligatorios
					$rcResult[0] = 0;
					$rcmessages[10] = $objService->my_html_entity_decode($rcmessages[10]);
					if($sbCharset=='UTF-8'){
						$rcmessages[10] = utf8_decode($rcmessages[10]);
					}
					$rcResult[1]= $objService->encode($rcmessages[10]);
					$sbOutput = $objJson->encode($rcResult);
					die($sbOutput);
				}
			}
			
			//se realiza el analisis de las preguntas.
			$rcSelect = $rcSession["select"];
			if($rcSelect && is_array($rcSelect)){
				foreach($rcSelect as $sbIndex=>$sbValue){
					$rcSelect[$sbIndex] = array("oprecodigon"=>$sbValue);
				}
			}
			//preguntas abiertas
			if($sbDesc){
				$sbDesc=stripslashes($sbDesc);
				$rcTmp = unserialize($sbDesc);
				if($rcTmp && is_array($rcTmp)){
					foreach($rcTmp as $rcRow){
						$rcIndex = 	explode("_",$rcRow[0]);
						$rcSelect[$rcIndex[0]] = array("oprecodigon"=>$rcIndex[1],"deruvalorabis"=>$objService->decode($rcRow[1]));
					}
				}
			}
			
			//se valida que almenos se haya contestado una pregunta
			if($rcSelect && is_array($rcSelect)){
			foreach($rcSelect as $sbIndex=>$rcTmp){
					if($rcTmp["oprecodigon"]){
						$sbFlag= true;
						break;
					}
				}
			}
			if(!$sbFlag){
				//resultado de los * son obligatorios
				$rcResult[0] = 0;
				$rcmessages[11] = $objService->my_html_entity_decode($rcmessages[11]);
				if($sbCharset=='UTF-8'){
					$rcmessages[11] = utf8_decode($rcmessages[11]);
				}
				$rcResult[1]= $objService->encode($rcmessages[11]);
				$sbOutput = $objJson->encode($rcResult);
				die($sbOutput);
			}
			
			$objManager = Application :: getDomainController('RespuestausuManager'); 
			$objManager->setData(array("formcodigon"=>$rcSession["formcodigon"],"reusfecingn"=>$objDate->fncintdatehour(),"usuacodigos"=>$rcUser["username"],
										"reusdirips"=>$_SERVER["REMOTE_ADDR"],"ordenumeros"=>$ordenumeros,"orgacodigos"=>$orgacodigos,
										"contindentis"=>$contidentis,"paciindentis"=>$paciindentis,"rcDetalle"=>$rcSelect));
			$objManager->addRespuesta();
			$rcTmp = $objManager->getResult();
			if($rcTmp["result"]){
				WebSession :: unsetProperty("_rcEncuesta");
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