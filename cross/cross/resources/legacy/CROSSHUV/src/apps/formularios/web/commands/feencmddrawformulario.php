<?php
require_once "Web/WebRequest.class.php";
require_once "JSON/JSON.php";
class FeEnCmdDrawFormulario {
	function execute() {
		extract($_REQUEST);

		settype($objJson, "object");
		settype($objService,"object");
		settype($objManager, "object");
		settype($rcResult, "array");
		settype($rcSession,"array");
		settype($rcUser,"array");
		settype($rcTmp,"array");
		settype($rcRow,"array");
		settype($rcSelect,"array");
		settype($rcIndex,"array");
		settype($rcData,"array");
		settype($sbOutput, "string");
		settype($sbHtml,"string");
		settype($sbCharset, "string");
		settype($nuIndex,"integer");
		
		
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
		
		if($oprecodigon && $pregcodigon && $sbDiv){
			
			$rcSession = WebSession :: getProperty("_rcEncuesta");
			//se almacena la respuesta a la pregunta
			$rcSelect = $rcSession["select"];
			$rcData = $rcSession["all"];
			//se debe validar si la pregunta ya tenia respuesta
			if($rcSelect[$pregcodigon]){
				//entonces se debe limpiar las posibles respuestas descendientes.
				$this->select($pregcodigon, $rcData, $rcIndex, $nuIndex);

				if($rcIndex && is_array($rcIndex)){
					foreach($rcIndex as $nuIndex){
						unset($rcSelect[$nuIndex]);
					}
				}
			}
			$rcSelect[$pregcodigon] = $oprecodigon;
			
			//se determina la siguiente pregunta
			//se seleccionan las repuestas hijas de la pregunta
			$rcData = $rcSession["cp"];
			if($rcData && is_array($rcData)){
			foreach($rcData as $nuPregcodigon=>$rcTmp){
					if($rcTmp["pregpadren"]==$pregcodigon){
						//se evalua entonces las respuestas
						foreach($rcTmp["answer"] as $rcRow){
							if($rcRow["oprepadren"]==$oprecodigon){
								$rcSelect[$nuPregcodigon] = null;
								$pregcodigon = $nuPregcodigon;
								break 2;
							}
						}
					}
				}	
			}
			
			$rcSession["select"] = $rcSelect;
			
			//pregunta actual
			$rcSession["pa"] = $pregcodigon;
			WebSession :: setProperty("_rcEncuesta",$rcSession);
			$sbHtml = $this->drawList();
			
			$rcResult[0]=1;
			$rcResult[1]=$objService->encode($sbHtml);
			$rcResult[2]=$sbDiv;
			
		}else{
			//faltan datos
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
			
		$sbPath = Application::getPluginsDirectory()."/function.viewNewQestions.php";
		include($sbPath);
		
		$sbHtml = smarty_function_viewNewQestions(array(),$this,false);
		return $sbHtml;
	}
	
	function select($nuPregcodigon, & $rcData, & $rcResult, & $nuIndex) {
		
		settype($nuCant, "integer");
		settype($nuCont, "integer");
		$nuCant = sizeof($rcData);
		for ($nuCont = 0; $nuCont < $nuCant; $nuCont ++) {
			if ($rcData[$nuCont]["pregpadren"] == $nuPregcodigon) {
				$this->select($rcData[$nuCont]["pregcodigon"], $rcData, $rcResult, $nuIndex);
				$rcResult[$nuIndex] = $rcData[$nuCont]["pregcodigon"];
				$nuIndex ++;
			}
		}
		return;
	}
}
?>