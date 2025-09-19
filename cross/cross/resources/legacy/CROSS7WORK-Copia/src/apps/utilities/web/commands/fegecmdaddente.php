<?php
require_once "Web/WebRequest.class.php";
require_once "JSON/JSON.php";
class FeGeCmdAddEnte {
	function execute() {
		extract($_REQUEST);

		settype($objJson, "object");
		settype($objService,"object");
		settype($objManager, "object");
		settype($objGateway, "object");
		settype($rcResult, "array");
		settype($rcTmp,"array");
		settype($rcRow,"array");
		settype($rcSession,"array");
		settype($rcUser,"array");
		settype($sbHtml,"string");
		settype($sbOutput, "string");
		settype($sbFlag,"string");
		settype($sbOrganombres,"string");
		settype($sbProcnombres,"string");
		settype($sbTarenombres,"string");
		settype($sbCharset, "string");
		settype($nuCant, "integer");

		//determina si se debe consultar el descriptor de del proceso y la tarea
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
		$sbCharset = strtoupper(ini_get("default_charset")) ;

		
		if($orgacodigos && $proccodigos && $tarecodigos){
			//se obtiene el descriptor del ente
			$objManager = Application::loadServices("Human_resources");
			$rcTmp = $objManager->getDataEntesOrg($orgacodigos,true);
			if($rcTmp && is_array($rcTmp)){
				$sbOrganombres = $rcTmp["nombre"];
			}
			//se optiene el arreglo de sesion
			$rcSession = WebSession :: getProperty("_rcRelacionTarea_Persona");
			
			//se determina la cantidad de personas relacionadas
			if($rcSession && is_array($rcSession)){
				$nuCant = sizeof($rcSession[1]);
				$sbFlag = true;
			}
			
			//si no viene arreglo de sesion entonces se obtiene el nombre del proceso y tarea
			if($sbFlag){
				
				//se valida si la persona ya esta en el arreglo
				$rcTmp = $rcSession[1];
				if($rcTmp && is_array($rcTmp)){
					foreach($rcTmp as $rcRow){
						if($rcRow["orgacodigos"]==$orgacodigos){
							$rcResult[0]=0;
							$rcmessages[72] = $objService->my_html_entity_decode($rcmessages[72]);
							if($sbCharset=='UTF-8'){
								$rcmessages[72] = utf8_decode($rcmessages[72]);
							}
							$rcResult[1]= $objService->encode($rcmessages[72]);
							$sbOutput = $objJson->encode($rcResult);
							die($sbOutput);
						}
					}
				}
				
				$objManager = Application::loadServices("Workflow");
				$objGateway = $objManager->getGateWay("proceso");
				$rcTmp = $objGateway->getByIdProceso($proccodigos);
				if($rcTmp && is_array($rcTmp)){
					$sbProcnombres = $rcTmp[0]["procnombres"];
				}
				$objGateway = $objManager->getGateWay("tarea");
				$rcTmp = $objGateway->getByIdTarea($tarecodigos);
				if($rcTmp && is_array($rcTmp)){
					$sbTarenombres = $rcTmp[0]["tarenombres"];
				}
				$objManager->close();
			}
			
			
			
			$rcSession[0]["proccodigos"]=$proccodigos;
			$rcSession[0]["procnombres"]= $sbProcnombres;
			$rcSession[0]["tarecodigos"]=$tarecodigos;
			$rcSession[0]["tarenombres"]=$sbTarenombres;
			$rcSession[1][$nuCant]["orgacodigos"]=$orgacodigos;
			$rcSession[1][$nuCant]["organombres"]=$sbOrganombres;
			
			WebSession :: setProperty("_rcRelacionTarea_Persona",$rcSession);
			$sbHtml = $this->drawList();
			
			$rcResult[0]=1;
			$rcResult[1]=$objService->encode($sbHtml);
			
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