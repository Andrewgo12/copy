<?php
require_once "Web/WebRequest.class.php";
require_once "JSON/JSON.php";
class FeEnCmdAddAnswers {
	function execute() {
		extract($_REQUEST);

		settype($objJson, "object");
		settype($objService,"object");
		settype($objManager, "object");
		settype($rcResult, "array");
		settype($rcTmp,"array");
		settype($rcSession,"array");
		settype($rcAnswer,"array");
		settype($rcUser,"array");
		settype($rcDesc,"array");
		settype($rcIndex,"array");
		settype($rcPregpadren,"array");
		settype($rcWeight,"array");
		settype($rcOrder,"array");
		settype($sbHtml,"string");
		settype($sbOutput, "string");
		settype($sbTmp,"string");
		settype($sbFlag,"string");
		settype($sbTipo,"string");
		settype($sbPregdescris,"string");
		settype($sbIndex,"string");
		settype($sbLabel,"string");
		settype($sbValue,"string");
		settype($sbObjenombres,"string");
		settype($sbCharset, "string");
		settype($nuCant, "integer");
		settype($nuCont,"integer");

		$sbTmp = true;
		//siempre va una respuesta.
		$sbFlag = true;
		$sbCharset = strtoupper(ini_get("default_charset")) ;
		
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
		$sbTipo = Application :: getConstant("PREG_CER");

		//se ponen las respuestas seleccionadas en la secion.
		$rcAnswer = WebSession :: getProperty("_rcAnswer");
		if($formcodigon && $pregcodigon && $objecodigon){
			//se obtiene el descriptor del objeto
			$objManager = Application::getDomainController('ObjetoManager');
			$objManager->setObjecodigon($objecodigon);
			$objManager->getByIdObjeto();
			$rcTmp = $objManager->getResult();
			if($rcTmp && is_array($rcTmp)){
				if($sbCharset=='UTF-8'){
					$rcTmp[0]["objenombres"] = utf8_decode($rcTmp[0]["objenombres"]);
				}
				$sbObjenombres = $rcTmp[0]["objenombres"];
			}
			//se obtiene el descriptor de pregunta.
			$objManager = Application::getDomainController('PreguntaManager');
			$rcTmp = $objManager->getByIdPregunta($pregcodigon);
			if($rcTmp && is_array($rcTmp)){
				if($sbCharset=='UTF-8'){
					$rcTmp[0]["pregdescris"] = utf8_decode($rcTmp[0]["pregdescris"]);
				}
				$sbPregdescris = $rcTmp[0]["pregdescris"];
			}
			//se valida que no se haya cambiado de formulario
			$rcSession = WebSession :: getProperty("_rcConfigEncuesta");
			
			//si la respuesta es cerrada debe tener repuestas asociadas
			if($sbFlag && !is_array($rcAnswer) && !$rcAnswer){
				//respuesta de una pregunta abierta no puede ser padre.
				$rcResult[0]=0;
				$rcmessages[7] = $objService->my_html_entity_decode($rcmessages[7]);
				if($sbCharset=='UTF-8'){
					$rcmessages[7] = utf8_decode($rcmessages[7]);
				}
				$rcResult[1]= $objService->encode($rcmessages[7]);
				$sbOutput = $objJson->encode($rcResult);
				die($sbOutput);
			}
			
			//se valida la respuesta padre
			if($pregpadren){
				$rcTmp = $objManager->getByIdPregunta($pregpadren);
				if($rcTmp && is_array($rcTmp)){
					if($sbTipo!=$rcTmp[0]["pregtipopres"]){
						//respuesta de una pregunta abierta no puede ser padre.
						$rcResult[0]=0;
						$rcmessages[6] = $objService->my_html_entity_decode($rcmessages[6]);
						if($sbCharset=='UTF-8'){
							$rcmessages[6] = utf8_decode($rcmessages[6]);
						}
						$rcResult[1]= $objService->encode($rcmessages[6]);
						$sbOutput = $objJson->encode($rcResult);
						die($sbOutput);
					}
				}
			}
			
			//si la pregunta padre viene, entonces se debe validar que se hayan configurado respuestas padre.
			if($sbFlag && $pregpadren && $sel_pregpadren){
				$rcPregpadren = unserialize(stripslashes($sel_pregpadren));
				if($rcPregpadren && is_array($rcPregpadren)){
					foreach($rcPregpadren as $sbIndex=>$sbValue){
						if(!$sbValue){
							$sbTmp = false;
							break;
						}
					}	
				}
			}
			
			if($sbTmp){
				
				//se actualiza el arreglo de sesion
				if($rcSession && is_array($rcSession)){
					$nuCant = sizeof($rcSession[1]);
					$rcDesc = $rcSession[3];
				}
				
				//se actualiza el arreglo de respuestas
				if($rcPregpadren && is_array($rcPregpadren)){
					foreach($rcAnswer[0] as $nuCont=>$rcTmp){
						$rcTmp["oprepadren"] = $rcPregpadren[$rcTmp["oprecodigon"]];
						$rcAnswer[0][$nuCont] = $rcTmp;
					}	
				}
				
				//se actualizan los pesos
				if($sel_reprpeson){
					$rcWeight = unserialize(stripslashes($sel_reprpeson));
					if($rcWeight && is_array($rcWeight)){
						foreach($rcAnswer[0] as $nuCont=>$rcTmp){
							if($rcWeight[$rcTmp["oprecodigon"]]){
								$rcTmp["reprpeson"] = $rcWeight[$rcTmp["oprecodigon"]];	
							}else{
								//peso en cero
								$rcTmp["reprpeson"] = 0;
							}
							$rcAnswer[0][$nuCont] = $rcTmp;
						}
					}
				}
				//se actualiza el orden
				if($sel_reprordenn){
					$rcOrder = unserialize(stripslashes($sel_reprordenn));
					if($rcOrder && is_array($rcOrder)){
						foreach($rcAnswer[0] as $nuCont=>$rcTmp){
							if($rcOrder[$rcTmp["oprecodigon"]]){
								$rcTmp["reprordenn"] = $rcOrder[$rcTmp["oprecodigon"]];	
							}else{
								//orden en cero
								$rcTmp["reprordenn"] = 0;
							}
							$rcAnswer[0][$nuCont] = $rcTmp;
						}
					}
				}
				
				$rcSession[0]["formcodigon"]=$formcodigon;
				$rcSession[1][$nuCant]["pregcodigon"]=$pregcodigon;
				$rcSession[1][$nuCant]["pregpadren"]=$pregpadren;
				$rcSession[1][$nuCant]["answer"]=$rcAnswer[0];
				$rcSession[1][$nuCant]["objecodigon"]=$objecodigon;
				$rcSession[2][$pregcodigon]=$sbPregdescris;
				$rcSession[4][$objecodigon] = $sbObjenombres;
				
				if($rcAnswer && is_array($rcAnswer)){
					//labels de las respuestas.
					if($rcAnswer[1] && is_array($rcAnswer[1])){
						if($rcDesc && is_array($rcDesc)){
							$rcIndex = array_keys($rcDesc);
							foreach($rcAnswer[1] as $sbIndex=>$sbLabel){
								if(!in_array($sbIndex,$rcIndex)){
									$rcDesc[$sbIndex]=$sbLabel;
								}
							}	
						}else{
							foreach($rcAnswer[1] as $sbIndex=>$sbLabel){
									$rcAnswer[1][$sbIndex] = $sbLabel;
							}
							$rcDesc = $rcAnswer[1];
						}
					}
					$rcSession[3]=$rcDesc;	
				}
				
				WebSession :: setProperty("_rcConfigEncuesta",$rcSession);
				$sbHtml = $this->drawList();
				
				$rcResult[0]=1;
				$rcResult[1]=$objService->encode($sbHtml);
				WebSession :: unsetProperty("_rcAnswer");
				
			}else{
				//respuesta de falta configuar las respuestas padre
				$rcResult[0]=0;
				$rcmessages[5] = $objService->my_html_entity_decode($rcmessages[5]);
				if($sbCharset=='UTF-8'){
					$rcmessages[5] = utf8_decode($rcmessages[5]);
				}
				$rcResult[1]= $objService->encode($rcmessages[5]);
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