<?php
require_once "Web/WebRequest.class.php";
require_once "JSON/JSON.php";
class FeGeCmdDrawRelacion {
	function execute() {
		extract($_REQUEST);

		settype($objJson, "object");
		settype($objService,"object");
		settype($objManager, "object");
		settype($objGateway, "object");
		settype($rcResult, "array");
		settype($rcTmp,"array");
		settype($rcRow,"array");
		settype($rcOrg,"array");
		settype($rcSession,"array");
		settype($sbHtml,"string");
		settype($sbOutput, "string");
		settype($sbProcnombres,"string");
		settype($sbTarenombres,"string");
		settype($nuCont, "integer");
		
		$objJson = new Services_JSON();
		$objService = Application :: loadServices("Data_type");
		
		//si esta en sesion se borra
		if(WebSession :: issetProperty("_rcRelacionTarea_Persona")){
			WebSession :: unsetProperty("_rcRelacionTarea_Persona");	
		}
		
		if($proccodigos && $tarecodigos){
			
			// se obtiene la realcion almacenada
			$objManager = Application :: getDomainController('RelatarepersManager'); 
			$objManager->setData(array("proccodigos"=>$proccodigos,"tarecodigos"=>$tarecodigos));
			$objManager->getRelacion();
			$rcResult = $objManager->getResult();
			
			if($rcResult && is_array($rcResult) && $rcResult[1] && is_array($rcResult[1])){
				
				//se obtiene el nombre del proceso y tarea
				$objManager = Application::loadServices("Workflow");
				$objGateway = $objManager->getGateWay("proceso");
				$rcTmp = $objGateway->getByIdProceso($rcResult[0]["proccodigos"]);
				if($rcTmp && is_array($rcTmp)){
					$sbProcnombres = $rcTmp[0]["procnombres"];
				}
				$objGateway = $objManager->getGateWay("tarea");
				$rcTmp = $objGateway->getByIdTarea($rcResult[0]["tarecodigos"]);
				if($rcTmp && is_array($rcTmp)){
					$sbTarenombres = $rcTmp[0]["tarenombres"];
				}
				$objManager->close();
				
				//se obtiene el descriptor del ente
				
				$objManager = Application::loadServices("Human_resources");
				foreach($rcResult[1] as $nuCont => $rcTmp){
					
					$rcRow = $objManager->getDataEntesOrg($rcTmp["orgacodigos"]);
					$rcOrg[$nuCont]["orgacodigos"] = $rcTmp["orgacodigos"];
					if($rcRow && is_array($rcRow)){
						$rcOrg[$nuCont]["organombres"] = $rcRow["nombre"];
					}
				}
				$objManager->close();
				
				$rcSession[0]["proccodigos"]=$rcResult[0]["proccodigos"];
				$rcSession[0]["procnombres"]= $sbProcnombres;
				$rcSession[0]["tarecodigos"]=$rcResult[0]["tarecodigos"];
				$rcSession[0]["tarenombres"]=$sbTarenombres;
				$rcSession[1]= $rcOrg;
				
				WebSession :: setProperty("_rcRelacionTarea_Persona",$rcSession);
				$sbHtml = $this->drawList();
				
				$rcResult[0]=1;
				$rcResult[1]=$objService->encode($sbHtml);
			}else{
				//resultado de los * son obligatorios
				$rcResult[0]=0;
			}
		}else{
			//resultado de los * son obligatorios
			$rcResult[0]=0;
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