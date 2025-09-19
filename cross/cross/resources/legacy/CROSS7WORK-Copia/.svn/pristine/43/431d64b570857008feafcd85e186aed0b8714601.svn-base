<?php
class FeEnIndicadorManager {

	function FeEnIndicadorManager() {
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
	 * Copyright 2014 FullEngine
	 *
	 * Obtiene los resultados de frecuecia de las respuestas de la encuesta
	 * @author freina<freina@parquesoft.com>
	 * @date 10-Apr-2014
	 * @location Cali-Colombia
	 */

	function getIndicador(){

		settype($objManager, "object");
		settype($objGateway, "object");
		settype($rcResult, "array");
		settype($rcTmp_RU, "array");
		settype($rcTmp_DR, "array");
		settype($rcTmp_C, "array");
		settype($rcTmp_P, "array");
		settype($rcRow, "array");
		settype($rcRowR, "array");
		settype($rcLabel_P, "array");
		settype($rcLabel_T, "array");
		settype($rcLabel_E, "array");
		settype($rcCont, "array");
		settype($rcData_E, "array");
		settype($rcData_T, "array");
		settype($rcResp_P, "array");
		settype($rcAnswer, "array");
		settype($rcLabel_R, "array");
		settype($rcIndex_P, "array");
		settype($rcTmp,"array");
		settype($rcOrgacodigos, "array");
		settype($sbPA, "string");
		settype($nuCont, "integer");
		settype($nuRow, "integer");
		settype($nuRowA, "integer");
		settype($nuCant, "integer");
		
		//error_reporting(30719);

		if(is_array($this->rcData) && $this->rcData){

			extract($this->rcData);

			if($fechaini && $fechafin && $formcodigon && $orgacodigos){
				
				$sbPA = Application::getConstant('PREG_ABIERTA');

				//se determina los servicio que estan bajo la dependencia
				$rcOrgacodigos = $this->getSalas($orgacodigos);

				// se obtiene la configuracion
				$objManager = Application::getDomainController("PregformulaManager");
				$objManager->setData(array("formcodigon"=>$formcodigon));
				$objManager->getConfiguration();
				$rcTmp_C = $objManager->getResult();
				
				//si encontramos la configuracion de la encuesta entonces realizamos la busqueda de las respuestas
				if(is_array($rcTmp_C) && $rcTmp_C){

					$rcTmp_C = $this->getDescLang($rcTmp_C);

					//primero se obtienen las frecuencia de respuestas al formulario en el rango de fechas.
					$objGateway = Application::getDataGateway("respuestausu");
					$objGateway->setData(array("fechaini"=>$fechaini,"fechafin"=>$fechafin,"formcodigon"=>$formcodigon,"orgacodigos_in"=>$rcOrgacodigos,"order_by"=>"orgacodigos"));
					$objGateway->getRespuestausu();
					$rcTmp_RU = $objGateway->getResult();
					
					if(is_array($rcTmp_RU) && $rcTmp_RU){
						$nuCant = sizeof($rcTmp_RU);
					}
					
					$objGateway = Application::getDataGateway("pregunta");
					$objGateway->setData(array("pregtipopres"=>$sbPA));
					$objGateway->getPregunta();
					$rcTmp = $objGateway->getResult();
					
					if(is_array($rcTmp) && $rcTmp){
						foreach ($rcTmp as $nuCont=>$rcRow){
							$rcTmp_P[$nuCont] = $rcRow["pregcodigon"];
						}	
					}
					
					$objGateway = Application::getDataGateway("indicador");
					$objGateway->setData(array("fechaini"=>$fechaini,"fechafin"=>$fechafin,"formcodigon"=>$formcodigon,"orgacodigos_in"=>$rcOrgacodigos));
					$objGateway->getResponseFrequencies();
					$rcTmp = $objGateway->getResult();

					if(is_array($rcTmp) && $rcTmp){
						
						foreach ($rcTmp as $nuCont=>$rcRow) {
							$rcTmp_DR[$rcRow["reuscodigon"]][$rcRow["pregcodigon"]] = $rcRow;
						}

						//se seleccionan las preguntas iniciales y se crean los arreglos de labels
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
								$rcRowR[$rcAnswer["reprcodigon"]] =  $rcAnswer["reprpeson"];
							}

							//se indexan por pregunta las respuestas
							$rcIndex_P[$rcRow["pregcodigon"]] =  $rcRowR;

						}
							
						//se arma el arreglo resultado
						//se almacena el formulario
						$rcResult["formcodigon"]= $rcTmp[0]["formcodigon"];
						//respuestas del usuario
						$rcResult["resp_usu"]= $rcTmp_RU;
						//detalle de las respuestas
						$rcResult["det_resp_usu"] = $rcTmp_DR;
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
						$rcResult["total"] = $nuCant;
						$rcResult["preg_a"] = $rcTmp_P;
					}

				}

			}
		}
		$this->rcResult = $rcResult;
	}

	/**
	 *   Propiedad intelectual del FullEngine.
	 *
	 *   Obtiene las dependencias consideradas como servicios
	 *   @author freina
	 *   @date 10-Apr-2014
	 *   @location Cali-Colombia
	 */
	function getSalas($sbOrgacodigos){

		settype($objService, "object");
		settype($objGateway, "object");
		settype($rcResult, "array");
		settype($rcData, "array");
		settype($rcTmp, "array");
		settype($sbValue, "string");
		settype($nuCont, "integer");

		if($sbOrgacodigos){
			
			//se obtienen la informacion de la tabla organizacion
			$objService = Application :: loadServices("Human_resources");
			$objGateway = $objService->getGateWay("organizacion");
			$rcData = $objGateway->getAllOrganizacion();
			$objService->close();
				
			if(is_array($rcData) && $rcData){
				
				// se determinan entonces las dependencias hijo
				$this->selectOrg($sbOrgacodigos, $rcData, $rcTmp, 0);				

				if(is_array($rcTmp) && $rcTmp){
					
					//entonces si hay dependencias configuradas como servicios se filtran cuales deben quedar en el reporte.
					$objService = Application :: loadServices("General");
					$rcData = $objService->getParam("human_resources","SERV_ORG");
						
					if(is_array($rcData) && $rcData){
						foreach($rcTmp as $sbValue){
							if (in_array($sbValue, $rcData)){
								$rcResult[$nuCont] = $sbValue;
								$nuCont ++;
							}
						}
					}else{
						$rcResult = $rcTmp;
					}
				}
			}
		}
		
		return $rcResult;
	}

	function selectOrg($sbOrgacodigos, $rcData, & $rcResult, $nuIndex) {

		settype($nuCant, "integer");
		settype($nuCont, "integer");
		
		$nuCant = sizeof($rcData);
		for ($nuCont = 0; $nuCont < $nuCant; $nuCont ++) {
			if ($rcData[$nuCont]["orgacgpads"] == $sbOrgacodigos) {
				$rcResult[$nuIndex] = $rcData[$nuCont]["orgacodigos"];
				$nuIndex ++;
				select($rcData[$nuCont]["orgacodigos"], $rcData, $rcResult, $nuIndex);
			}
		}
		return;
	}

	/**
	 *   Propiedad intelectual del FullEngine.
	 *
	 *   Obtiene los descriptores de acuerdo al lenguaje.
	 *   @author freina
	 *   @date 10-Apr-2014
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