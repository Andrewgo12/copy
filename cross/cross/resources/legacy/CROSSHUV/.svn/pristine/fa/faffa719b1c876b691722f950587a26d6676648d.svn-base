<?php
require_once "Web/WebRequest.class.php";
require_once "JSON/JSON.php";
class FeEnCmdloadFormulario {
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
		settype($rcLabel_P,"array");
		settype($rcLabel_R,"array");
		settype($rcLabel_O,"array");
		settype($rcConfig,"array");
		settype($rcAnswer,"array");
		settype($rcPreg,"array");
		settype($rcIndex, "array");
		settype($sbOutput, "string");
		settype($sbHtml,"string");
		settype($sbCharset, "string");
		settype($nuCont,"integer");
		settype($nuContA,"integer");
		
		//labels
		//Trae los datos del usuario
		$rcUser = Application :: getUserParam();
		if (!is_array($rcUser)) {
			//Si no existe usuario en sesion
			$rcUser["lang"] = Application :: getSingleLang();
		}
		
		//se limpia la sesion 
		if(WebSession :: issetProperty("_rcConfigEncuesta")){
			WebSession :: unsetProperty("_rcConfigEncuesta");
		}
		if(WebSession :: issetProperty("_rcAnswer")){
			WebSession :: unsetProperty("_rcAnswer");
		}
		include ($rcUser["lang"]."/".$rcUser["lang"].".messages.php");
		
		$objJson = new Services_JSON();
		$objService = Application :: loadServices("Data_type");
		$objManager = Application :: getDomainController('PregformulaManager'); 
		
		if($formcodigon){
			$objManager->setData(array("formcodigon"=>$formcodigon));
			$objManager->getConfiguration();
			$rcTmp = $objManager->getResult();

			if($rcTmp && is_array($rcTmp)){
				
				$sbCharset = strtoupper(ini_get("default_charset")) ;
				
				//se analiza la configuracion
				foreach($rcTmp as $nuCont=>$rcRow){
					
					//se almacenan los labels de las preguntas
					if($sbCharset=='UTF-8'){
						$rcLabel_P[$rcRow["pregcodigon"]] = utf8_decode($rcRow["pregdescris"]);	
					}else{
						$rcLabel_P[$rcRow["pregcodigon"]] = $rcRow["pregdescris"];
					}
					
					//se almacenan las preguntas
					$rcPreg[$nuCont] = $rcRow["pregcodigon"];
					
					//se almacenan los labels de los objetos
					$rcLabel_O[$rcRow["objecodigon"]] = $rcRow["objenombres"];
					
					//se obtienen los labels de las repsuestas
					foreach($rcRow["answer"] as $rcAnswer){
						
						//se almacena el codigo de la respuesta
						$rcIndex[$rcAnswer["reprcodigon"]] = $rcAnswer["oprecodigon"];						
						
						if($sbCharset=='UTF-8'){
							$rcLabel_R[$rcAnswer["oprecodigon"]] = utf8_decode($rcAnswer["opredescrisp"]);	
						}else{
							$rcLabel_R[$rcAnswer["oprecodigon"]] = $rcAnswer["opredescrisp"];
						} 
					}
					
					$rcConfig[$nuCont]["pregcodigon"] = $rcRow["pregcodigon"];
					$rcConfig[$nuCont]["pregpadren"] = $rcRow["pregpadren"];
					$rcConfig[$nuCont]["answer"] = $rcRow["answer"];
					$rcConfig[$nuCont]["objecodigon"] = $rcRow["objecodigon"];
				}
				
				//se actualiza el codigo padre
				if(is_array($rcConfig) && $rcConfig){
					foreach ($rcConfig as $nuCont=>$rcRow){
						foreach($rcRow["answer"] as $nuContA=>$rcAnswer){
							if($rcAnswer["oprepadren"]){
								$rcAnswer["oprepadren"] = $rcIndex[$rcAnswer["oprepadren"]];	
							}
							$rcRow["answer"][$nuContA] = $rcAnswer;
						}
						$rcConfig[$nuCont]= $rcRow;
					}
				}
				
				//se arma el arreglo de sesion
				$rcSession[0]["formcodigon"]=$formcodigon;
				$rcSession[1]= $rcConfig;
				$rcSession[2]= $rcLabel_P;
				$rcSession[3]= $rcLabel_R;
				$rcSession[4] = $rcLabel_O;
				
				WebSession :: setProperty("_rcConfigEncuesta",$rcSession);
				$sbHtml = $this->drawList();
				
				$rcResult[0]=1;
				$rcResult[1]=$objService->encode($sbHtml);
				$rcResult[2] = $rcPreg;
				
			}else{
				$rcResult[0] = 0;
			}	
		}else{
			$rcResult[0] = 0;
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