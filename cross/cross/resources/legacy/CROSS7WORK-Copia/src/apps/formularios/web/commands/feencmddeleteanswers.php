<?php
require_once "Web/WebRequest.class.php";
require_once "JSON/JSON.php";
class FeEnCmdDeleteAnswers {
	function execute() {
		extract($_REQUEST);

		settype($objJson, "object");
		settype($objService,"object");
		settype($objManager, "object");
		settype($rcResult, "array");
		settype($rcTmp,"array");
		settype($rcIndex,"array");
		settype($rcSession,"array");
		settype($rcData,"array");
		settype($rcUser,"array");
		settype($sbHtml,"string");
		settype($sbOutput, "string");
		settype($sbCharset, "string");
		settype($nuIndex,"integer");
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
		$sbCharset = strtoupper(ini_get("default_charset")) ;

		if($pregcodigon){
			
			//se valida que no se haya cambiado de formulario
			$rcSession = WebSession :: getProperty("_rcConfigEncuesta");
			
			if($rcSession && is_array($rcSession)){
				$rcData = $rcSession[1];
				$rcIndex[$nuIndex] = $pregcodigon;
				$nuIndex ++;
				$this->select($pregcodigon, $rcData, $rcIndex, $nuIndex);
				//se recorre el arreglo de sesion quitando la pregunta y sus hijos
				foreach($rcData as $rcRow){
					if(!in_array($rcRow["pregcodigon"],$rcIndex)){
						$rcTmp[$nuCont]=$rcRow;
						$nuCont++;
					}
				}
				$rcSession[1]=$rcTmp;
				WebSession :: setProperty("_rcConfigEncuesta",$rcSession);
				$sbHtml = $this->drawList();
					
				$rcResult[0]=1;
				$rcResult[1]=$objService->encode($sbHtml);;
				$rcResult[2]=$rcIndex;
			}
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
			
		$sbPath = Application::getPluginsDirectory()."/function.drawAnswers.php";
		include($sbPath);
		$sbHtml = smarty_function_drawAnswers(array(),$this,false);
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