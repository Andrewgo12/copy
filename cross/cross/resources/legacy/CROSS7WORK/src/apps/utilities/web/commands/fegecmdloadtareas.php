<?php
require_once "Web/WebRequest.class.php";
require_once "JSON/JSON.php";
class FeGeCmdloadTareas {
	function execute() {
		extract($_REQUEST);

		settype($objJson, "object");
		settype($objWorkFlow,"object");
		settype($objService, "object");
		settype($objGateway, "object");
		settype($rcResult, "array");
		settype($rcTmp, "array");
		settype($rcRow,"array");
		settype($sbOutput, "string");
		settype($nuCont,"integer");

		$objJson = new Services_JSON();
		$objService = Application :: loadServices("Data_type");
		
		if(WebSession :: issetProperty("_rcRelacionTarea_Persona")){
			WebSession :: unsetProperty("_rcRelacionTarea_Persona");	
		}
		
		if($proccodigos){
			
			$objWorkFlow = Application::loadServices('Workflow');
			$objGateway = $objWorkFlow->getGateWay('rutaExtended');
			$rcTmp = $objGateway->getByProceso_Tareas($proccodigos);
			$objWorkFlow->close();
			if($rcTmp && is_array($rcTmp)){
				foreach($rcTmp as $nuCont=>$rcRow){
					$rcRow["tarenombres"] = $objService->encode($rcRow["tarenombres"]);
					$rcResult[$nuCont][0] = $rcRow["tarecodigos"];
					$rcResult[$nuCont][1] = $rcRow["tarenombres"];
				}
			}

			//respuesta
			$sbOutput = $objJson->encode($rcResult);
			die($sbOutput);
		}
	}
}
?>