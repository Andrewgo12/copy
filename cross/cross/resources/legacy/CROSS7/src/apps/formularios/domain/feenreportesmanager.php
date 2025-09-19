<?php
class FeEnReportesManager {

	function FeEnReportesManager() {
		$this->gateway = Application::getDataGateway("reportes");
	}

	/**
	 * @Copyright 2014 Parquesoft
	 *
	 * Modifica el arreglo de datos
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function setData($rcData){
		$this->rcData = $rcData;
	}

	/**
	 * @Copyright 2014 Parquesoft
	 *
	 * Obtiene la respuesta del metodo
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getResult(){
		return $this->rcResult;
	}

	/**
	 * Copyright 2009 FullEngine
	 *
	 * Obtiene los resultados de frecuecia de las respuestas de la encuesta
	 * @author freina<freina@parquesoft.com>
	 * @date 04-May-2009
	 * @location Cali-Colombia
	 */

	function getReport(){

		settype($objManager, "object");
		settype($objGateway, "object");
		settype($rcResult, "array");
		settype($rcTmp_R, "array");
		settype($rcTmp_C, "array");
		settype($rcRow, "array");
		settype($rcIndexR, "array");
		settype($rcLabel_P, "array");
		settype($rcLabel_T, "array");
		settype($rcLabel_E, "array");
		settype($rcCont, "array");
		settype($rcData_E, "array");
		settype($rcData_T, "array");
		settype($rcResp_P, "array");
		settype($nuCont, "integer");
		settype($rcAnswer, "array");
		settype($rcLabel_R, "array");
		settype($rcIndex_P, "array");
		settype($rcTmp,"array");
		settype($nuRow, "integer");
		settype($nuRowA, "integer");
		settype($nuCant, "integer");

		if(is_array($this->rcData) && $this->rcData){

			extract($this->rcData);

			if($fechaini && $fechafin && $formcodigon){

				// se obtiene la configuracion
				$objManager = Application::getDomainController("PregformulaManager");
				$objManager->setData(array("formcodigon"=>$formcodigon));
				$objManager->getConfiguration();
				$rcTmp_C = $objManager->getResult();

				//si encntramnos la configuracion de la encuesta entonces realizamos la busqueda de las respuestas
				if(is_array($rcTmp_C) && $rcTmp_C){
						
					$rcTmp_C = $this->getDescLang($rcTmp_C);

					//primero se obtienen las frecuencia de respuestas al formulario en el rango de fechas.
					$objGateway = Application::getDataGateway("respuestausu");
					$objGateway->setData(array("fechaini"=>$fechaini,"fechafin"=>$fechafin,"formcodigon"=>$formcodigon));
					$objGateway->getRespuestausu();
					$rcTmp = $objGateway->getResult();
					if(is_array($rcTmp) && $rcTmp){
						$nuCant = sizeof($rcTmp);
					}
					$this->gateway->setData(array("fechaini"=>$fechaini,"fechafin"=>$fechafin,"formcodigon"=>$formcodigon));
					$this->gateway->getResponseFrequencies();
					$rcTmp_R = $this->gateway->getResult();

					if(is_array($rcTmp_R) && $rcTmp_R){

						//se arma un arreglo con el id de la respuesta como indice
						foreach($rcTmp_R as $rcRow){
							$rcIndexR[$rcRow["oprecodigon"]] = $rcRow["cantidad"];
						}

						//se seleccionan las preguntas iniciales y se crean los arreglos de labels
						//---------------------------------------------
						foreach($rcTmp_C as $rcRow){

							//se almacenan los labels de las preguntas							
							$rcLabel_P[$rcRow["pregcodigon"]] = $rcRow["pregdescris"];

							//se almacenan los nombres de los temas
							$rcLabel_T[$rcRow["temacodigon"]] = $rcRow["temanombres"];

							//se almacenan los nombres de los ejes
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
								
							}
							//se obtienen los labels de las repsuestas
							foreach($rcRow["answer"] as $nuRowA=>$rcAnswer){
									
								$rcLabel_R[$rcAnswer["oprecodigon"]] = $rcAnswer["opredescrisp"];
									
								$rcRow["answer"][$nuRowA] = $rcAnswer;
							}

							//se indexan por pregunta las respuestas
							$rcIndex_P[$rcRow["pregcodigon"]] =  $rcRow;

						}
							
						//se arma el arreglo resultado
						//se almacena el formulario
						$rcResult["formcodigon"]= $rcTmp[0]["formcodigon"];
						//pregunta iniciales
						$rcResult["pi"]= $rcResp_P;
						//se almacena los labels de las preguntas
						$rcResult["lp"]= $rcLabel_P;
						//se almacena la configuracion preguntas
						$rcResult["cp"]= $rcIndex_P;
						//se almacena los labels de las respuestas
						$rcResult["lr"]= $rcLabel_R;
						//toda la configuracion
						$rcResult["all"]= $rcTmp_C;
						//se almacena los labels de los temas
						$rcResult["lt"]= $rcLabel_T;
						//se almacena los labels de los ejes
						$rcResult["le"]= $rcLabel_E;
						//agrupamiento por eje
						$rcResult["ae"]= $rcData_E;
						//agrupamiento por tema
						$rcResult["at"]= $rcData_T;
						//frequencia de respuesta
						$rcResult["fr"]= $rcIndexR;
						$rcResult["total"] = $nuCant;
						//---------------------------------------------
					}

				}

			}
		}
		$this->rcResult = $rcResult;
	}

	/**
	 *   Propiedad intelectual del FullEngine.
	 *
	 *   Obtiene los descriptores de acuerdo al lenguaje.
	 *   @author freina
	 *   @date 15-Feb-2014 16:51
	 *   @location Cali-Colombia
	 */
	function getDescLang($rcData){

		settype($objService,"object");
		settype($objGateway, "object");
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