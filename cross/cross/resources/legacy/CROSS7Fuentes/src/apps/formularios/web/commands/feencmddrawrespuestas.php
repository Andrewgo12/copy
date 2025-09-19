<?php
require_once "Web/WebRequest.class.php";
require_once "JSON/JSON.php";
class FeEnCmddrawRespuestas {
	function execute() {
		extract($_REQUEST);

		settype($objJson, "object");
		settype($objService, "object");
		settype($objManager, "object");
		settype($rcResult, "array");
		settype($rcRow,"array");
		settype($rcDesc,"array");
		settype($rcTmp,"array");
		settype($rcUser,"array");
		settype($sbHtml,"string");
		settype($sbOutput, "string");
		settype($sbCharset, "string");
		settype($nuOprecodigon, "integer");
		settype($nuCont, "integer");
		
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
			
		if($oprecodigon){
			$objManager = Application :: getDomainController('OpcionrepuesManager');
				
			$this->pregpadren=$pregpadren;

			//se obtienen los descriptores de las opciones de respueta.
			$rcTmp = explode(",",$oprecodigon);

			foreach($rcTmp as $nuCont=>$nuOprecodigon){
				$objManager->setOprecodigon($nuOprecodigon);
				$objManager->getByIdOpcionrepues();
				$rcResult = $objManager->getResult();
				$rcTmp[$nuCont] = array("oprecodigon"=>$nuOprecodigon);
				if($sbCharset=='UTF-8'){
					$rcDesc[$nuOprecodigon]= utf8_decode($rcResult[0]["opredescrisp"]);
				}else{
					$rcDesc[$nuOprecodigon]= $rcResult[0]["opredescrisp"];	
				}
			}
			
			//se ponen las respuestas seleccionadas en la secion.
			unset($rcRow);
			$rcRow[0]=$rcTmp;
			$rcRow[1]=$rcDesc;
			WebSession :: setProperty("_rcAnswer",$rcRow);
			$sbHtml = $this->drawList();
			unset($rcResult);
			$rcResult[0]=1;
			$rcResult[1]= $objService->encode($sbHtml);
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
			
		$sbPath = Application::getPluginsDirectory()."/function.drawRespuestas.php";
		include($sbPath);
		$sbHtml = smarty_function_drawRespuestas(array("pregpadren"=>$this->pregpadren),$this,false);
		return $sbHtml;
	}
}
?>