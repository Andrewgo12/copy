<?php
require_once "Web/WebRequest.class.php";
require_once "JSON/JSON.php";
class FeEnCmdUpdateAnswers {
	function execute() {
		extract($_REQUEST);

		settype($objJson, "object");
		settype($objService,"object");
		settype($rcResult, "array");
		settype($rcTmp,"array");
		settype($rcSession,"array");
		settype($rcData,"array");
		settype($rcUser,"array");
		settype($rcRow,"array");
		settype($rcWeight,"array");
		settype($rcOrder,"array");
		settype($sbHtml,"string");
		settype($sbOutput, "string");
		settype($sbCharset, "string");
		settype($nuCont,"integer");
		settype($nuRow,"integer");

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
		
		if($pregcodigon && $sel_reprpeson && $sel_reprordenn){
			
			$rcWeight = unserialize(stripslashes($sel_reprpeson));
			$rcOrder = unserialize(stripslashes($sel_reprordenn));
			
			if($rcWeight && is_array($rcWeight) && $rcOrder && is_array($rcOrder)){
				
				//se Obtiene el arreglo de sesion
				$rcSession = WebSession :: getProperty("_rcConfigEncuesta");
				
				if($rcSession && is_array($rcSession)){
					
					$rcData = $rcSession[1];
					//se recorre el arreglo de buscando la pregunta a ser actualizada
					foreach($rcData as $nuCont => $rcTmp){
						if($rcTmp["pregcodigon"]==$pregcodigon){
							foreach($rcTmp["answer"] as $nuRow=>$rcRow){
								if($rcOrder[$rcRow["oprecodigon"]]){
									$rcRow["reprordenn"]=$rcOrder[$rcRow["oprecodigon"]];	
								}else{
									$rcRow["reprordenn"]=0;
								}
								if($rcWeight[$rcRow["oprecodigon"]]){
									$rcRow["reprpeson"]= $rcWeight[$rcRow["oprecodigon"]];	
								}else{
									$rcRow["reprpeson"]= 0;
								}
								$rcTmp["answer"][$nuRow]=$rcRow;
							}
							$rcData[$nuCont] = $rcTmp;
							break;
						}
					}
					$rcSession[1]=$rcData;
					WebSession :: setProperty("_rcConfigEncuesta",$rcSession);
					$sbHtml = $this->drawList();
						
					$rcResult[0]=1;
					$rcResult[1]=$objService->encode($sbHtml);
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
}
?>