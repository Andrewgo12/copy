<?php
require_once "Web/WebRequest.class.php";
require_once "JSON/JSON.php";
class FeEnCmdShowFormulario {
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
		settype($rcLabel_T,"array");
		settype($rcLabel_E,"array");
		settype($rcIndex_P,"array");
		settype($rcResp_P,"array");
		settype($rcResp_S,"array");
		settype($rcDesc,"array");
		settype($rcCont,"array");
		settype($rcData_E,"array");
		settype($rcData_T,"array");
		settype($rcAnswer, "array");
		settype($sbOutput, "string");
		settype($sbHtml,"string");
		settype($sbCharset, "string");
		settype($nuRow,"integer");
		settype($nuCont,"integer");
		settype($nuRowA, "integer");
		
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
		$objManager = Application :: getDomainController('PregformulaManager'); 
		
		//este codigo determina si el empleado ya resolvio la encuesta, se usa en ECODIS
		/*if($perscodigos == "" || $perscodigos == NULL || strlen($perscodigos)==0) {
			
			//FALTA EL PERSCODIGOS
			WebSession :: unsetProperty("_rcEncuesta");
			$rcResult[0] = 0;
			$rcResult[1]= $objService->encode(html_entity_decode($rcmessages[0]));
			$sbOutput = $objJson->encode($rcResult);
			die($sbOutput);
			
		}	else if($formcodigon) {
				
				$respuestaUsu = Application::getDomainController("RespuestausuManager");
				$respuestaUsu->setData(array("formcodigon"=>$formcodigon,"perscodigos"=>$perscodigos));
				$respuestaUsu->getByIdFormulario();
				$existe = $respuestaUsu->getResult();
							
				if(is_array($existe)) {
					//EL SUJETO YA RESOLVIÓ LA ENCUESTA
					WebSession :: unsetProperty("_rcEncuesta");
					$rcResult[0] = 0;
					$rcResult[1]= $objService->encode(html_entity_decode($rcmessages[31]));
					$sbOutput = $objJson->encode($rcResult);
					die($sbOutput);
				}
		}*/
		
		if($formcodigon){
			$objManager->setData(array("formcodigon"=>$formcodigon));
			$objManager->getConfiguration();	
		}else{
			$objManager->getDefaultConfiguration();
		}
		
		$rcTmp = $objManager->getResult();
		
		if($rcTmp && is_array($rcTmp)){
			//lenguaje
			$rcTmp = $this->getDescLang($rcTmp);
			//se analiza la configuracion
			foreach($rcTmp as $rcRow){
				
				//se almacenan los labels de las preguntas
				if($sbCharset=='UTF-8'){
					$rcRow["pregdescris"] = utf8_decode($rcRow["pregdescris"]);
				}
				$rcLabel_P[$rcRow["pregcodigon"]] = $rcRow["pregdescris"];
				
				//se almacenan los nombres de los temas
				if($sbCharset=='UTF-8'){
					$rcRow["temanombres"] = utf8_decode($rcRow["temanombres"]);
				}
				$rcLabel_T[$rcRow["temacodigon"]] = $rcRow["temanombres"];
				
				//se almacenan los nombres de los ejes
				if($sbCharset=='UTF-8'){
					$rcRow["ejtenombres"] = utf8_decode($rcRow["ejtenombres"]);
				}
				$rcLabel_E[$rcRow["ejtecodigon"]] = $rcRow["ejtenombres"];
				
				//se obtienen las repuestas padre
				if(!$rcRow["pregpadren"]){
					
					//almacena los temas de un factor
					$nuCont = 0;
					if($rcCont["eje"][$rcRow["ejtecodigon"]]){
    					$nuCont = $rcCont["eje"][$rcRow["ejtecodigon"]];
    				}
    				if($rcData_E[$rcRow["ejtecodigon"]]){
    					if(!in_array($rcRow["temacodigon"],$rcData_E[$rcRow["ejtecodigon"]])){
    						$rcData_E[$rcRow["ejtecodigon"]][$nuCont] = $rcRow["temacodigon"];
    						$nuCont ++;
    					}
    				}else{
    					$rcData_E[$rcRow["ejtecodigon"]][$nuCont] = $rcRow["temacodigon"];
    					$nuCont ++;
    				}
    				
    				$rcCont["eje"][$rcRow["ejtecodigon"]] = $nuCont;
    				
    				//almacena las preguntas de un tema
					$nuCont = 0;
					if($rcCont["tema"][$rcRow["temacodigon"]]){
    					$nuCont = $rcCont["tema"][$rcRow["temacodigon"]];
    				}
    				$rcData_T[$rcRow["temacodigon"]][$nuCont] = $rcRow["pregcodigon"];
    				$nuCont ++;
    				$rcCont["tema"][$rcRow["temacodigon"]] = $nuCont;
					
					$rcResp_P[$nuRow] = $rcRow["pregcodigon"];
					$nuRow++;
					$rcResp_S[$rcRow["pregcodigon"]]=null;
				}	
				//se obtienen los labels de las repsuestas
				foreach($rcRow["answer"] as $nuRowA=>$rcAnswer){
					
					if($sbCharset=='UTF-8'){
						$rcAnswer["opredescrisp"] = utf8_decode($rcAnswer["opredescrisp"]);
					}
					
					//modificacion para trabajar con el codigo de la configuracion
					$rcAnswer["oprecodigon"] = $rcAnswer["reprcodigon"];
					
					$rcLabel_R[$rcAnswer["oprecodigon"]] = $rcAnswer["opredescrisp"]; 
					
					$rcRow["answer"][$nuRowA] = $rcAnswer;
				}
				
				//se indexan por pregunta las respuestas
				$rcIndex_P[$rcRow["pregcodigon"]] =  $rcRow;
				
			}
			
			//se arma el arreglo de sesion
			//se almacena el formulario
			$rcSession["formcodigon"]= $rcTmp[0]["formcodigon"];
			//en esta posicion se almacenan lo que se va respondiendo
			$rcSession["select"]= $rcResp_S;
			//pregunta iniciales
			$rcSession["pi"]= $rcResp_P;
			//se almacena los labels de las preguntas
			$rcSession["lp"]= $rcLabel_P;
			//se almacena la configuracion preguntas
			$rcSession["cp"]= $rcIndex_P;
			//se almacena los labels de las respuestas
			$rcSession["lr"]= $rcLabel_R;
			//toda la configuracion
			$rcSession["all"]= $rcTmp;
			//se almacena los labels de los temas
			$rcSession["lt"]= $rcLabel_T;
			//se almacena los labels de los ejes
			$rcSession["le"]= $rcLabel_E;
			//agrupamiento por eje
			$rcSession["ae"]= $rcData_E;
			//agrupamiento por tema
			$rcSession["at"]= $rcData_T;
			
			WebSession :: setProperty("_rcEncuesta",$rcSession);
			$sbHtml = $this->drawList();
			
			$rcResult[0]=1;
			$rcResult[1]=$objService->encode($sbHtml);
			
		}else{
			//NO LOGRA DETERMINAR LA ENCUESTA A APLICAR
			WebSession :: unsetProperty("_rcEncuesta");
			$rcResult[0] = 0;
			$rcmessages[31] = $objService->my_html_entity_decode($rcmessages[31]);
			if($sbCharset=='UTF-8'){
				$rcmessages[31] = utf8_decode($rcmessages[31]);
			}
			$rcResult[1]= $objService->encode($rcmessages[31]);
		}

		$sbOutput = $objJson->encode($rcResult);
		die($sbOutput);
	}
	
	function drawList(){

		settype($sbPath,"string");
		settype($sbHtml,"string");
			
		$sbPath = Application::getPluginsDirectory()."/function.viewEncuesta.php";
		include($sbPath);
		
		$sbHtml = smarty_function_viewEncuesta(array(),$this,false);
		return $sbHtml;
	}
	
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Obtiene los descripotores de acuerdo al lenguaje.
	*   @author freina
	*   @date 18-Aug-2009 17:54
	*   @location Cali-Colombia
	*/
	function getDescLang($rcData){
	
		settype($objService,"object");
		settype($rcResult,"array");
		settype($rcConstante,"array");
		settype($rcUser,"array");
		settype($rcTmpP,"array");
		settype($rcTmpR,"array");
		settype($rcTmpE,"array");
		settype($rcTmpT,"array");
		settype($rcTmp,"array");
		settype($rcIndexP,"array");
		settype($rcIndexR,"array");
		settype($rcIndexE,"array");
		settype($rcIndexT,"array");
		settype($rcRow,"array");
		settype($nuRow,"integer");
		settype($nuCont,"integer");
		
		if($rcData && is_array($rcData)){
			
			//Para cargar el lenguaje
			$rcUser = Application :: getUserParam();
			if (!is_array($rcUser)) {
				//Si no existe usuario en sesion
				$rcUser["lang"] = Application :: getSingleLang();
			}
			
			//se obtiene la constante de configuracion
			$objService = Application :: loadServices("General");
			$rcConstante = Application :: getConstant("TAB_TIP_DESC");
			$objGateway = $objService->getGateWay("tablastipole");
			$objGateway->setData(array("entidad"=>"pregunta","langcodigos"=>$rcUser["lang"]));
			$objGateway->getByTatlnomtabls_Langcodigos();
			$rcTmpP = $objGateway->getResult();
			$objGateway->setData(array("entidad"=>"opcionrepues","langcodigos"=>$rcUser["lang"]));
			$objGateway->getByTatlnomtabls_Langcodigos();
			$rcTmpR = $objGateway->getResult();
			$objGateway->setData(array("entidad"=>"ejetematico","langcodigos"=>$rcUser["lang"]));
			$objGateway->getByTatlnomtabls_Langcodigos();
			$rcTmpE = $objGateway->getResult();
			$objGateway->setData(array("entidad"=>"tema","langcodigos"=>$rcUser["lang"]));
			$objGateway->getByTatlnomtabls_Langcodigos();
			$rcTmpT = $objGateway->getResult();
			$objService->close();
			
			if($rcConstante && is_array($rcConstante) 
			&& $rcTmpP && is_array($rcTmpP)
			&& $rcTmpR && is_array($rcTmpR)
			&& $rcTmpE && is_array($rcTmpE)
			&& $rcTmpT && is_array($rcTmpT)){
				//preguntas
				foreach($rcTmpP as $nuRow=>$rcRow){
					$rcIndexP[$rcRow["tatlvalcods"]] = $rcRow["tatlvaldesls"]; 
				}
				//respuestas
				foreach($rcTmpR as $nuRow=>$rcRow){
					$rcIndexR[$rcRow["tatlvalcods"]] = $rcRow["tatlvaldesls"]; 
				}
				//eje tematico
				foreach($rcTmpE as $nuRow=>$rcRow){
					$rcIndexE[$rcRow["tatlvalcods"]] = $rcRow["tatlvaldesls"]; 
				}
				//tema
				foreach($rcTmpT as $nuRow=>$rcRow){
					$rcIndexT[$rcRow["tatlvalcods"]] = $rcRow["tatlvaldesls"]; 
				}
				//por ultimo se toma el valor de del nuevo lenguaje y se actualiza
				foreach($rcData as $nuCont=>$rcTmp){
					//label de la pregunta
					if($rcIndexP[$rcTmp["pregcodigon"]]){
						$rcTmp["pregdescris"] = $rcIndexP[$rcTmp["pregcodigon"]];
					}
					//label del eje tematico
					if($rcIndexE[$rcTmp["ejtecodigon"]]){
						$rcTmp["ejtenombres"] = $rcIndexE[$rcTmp["ejtecodigon"]];
					}
					//label del tema
					if($rcIndexT[$rcTmp["temacodigon"]]){
						$rcTmp["temanombres"] = $rcIndexT[$rcTmp["temacodigon"]];
					}
					if($rcTmp["answer"] && is_array($rcTmp["answer"])){
						foreach($rcTmp["answer"] as $nuRow=>$rcRow){
							if($rcIndexR[$rcRow["oprecodigon"]]){
								$rcRow["opredescrisp"] = $rcIndexR[$rcRow["oprecodigon"]];
							}
							$rcTmp["answer"][$nuRow] = $rcRow;
						}	
					}
					$rcResult[$nuCont] = $rcTmp;
				}
			}else{
				$rcResult = $rcData;
			}
		}
		
		return $rcResult;
	}
}
?>