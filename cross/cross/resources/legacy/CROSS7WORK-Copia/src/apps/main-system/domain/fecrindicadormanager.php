<?php
class FeCrIndicadorManager{
	function FeCrIndicadorManager(){
		$this->objGateway = Application::getDataGateway("indicador");
	}

	function setData($rcData){
		$this->rcData = $rcData;
	}

	function getResult(){
		return $this->rcResult;
	}

	function UnsetRequest() {
		settype($sbKey,"string");
		settype($sbValue,"string");
		foreach ($_REQUEST as $sbKey => $sbValue) {
			if (strpos($sbKey,"__")!==false)
			unset ($_REQUEST[$sbKey]);
		}
		unset($_REQUEST["ordefecingdini"]);
		unset($_REQUEST["ordefecingdfin"]);
		unset($_REQUEST["ordefecdiginin"]);
		unset($_REQUEST["ordefecdigfinn"]);
		unset($_REQUEST["orgacodigos"]);
		unset($_REQUEST["orgacodigos_desc"]);
	}

	/**
	 * @copyright Copyright 2011 &copy; FullEngine
	 *
	 * Genera los indicadores
	 * @author freina <freina@parquesoft.com>
	 * @date 01-Nov-2011 09:50
	 * @location Cali-Colombia
	 */
	function getIndicador(){

		settype($rcResult,"array");
		settype($rcData,"array");
		settype($rcTmp,"array");
		settype($rcTotByDep,"array");
		settype($rcOrden,"array");
		settype($rcOrdenN,"array");
		settype($rcRow,"array");
		settype($sbOrdenumeros, "string");
		settype($sbOrgacodigos, "string");
		settype($sbFlag, "string");
		settype($nuCont,"integer");
		settype($nuCantTO,"integer");
		settype($nuCant,"integer");

		$rcData = $this->rcData;

		if($rcData && is_array($rcData)){
			
			extract($rcData);

			//se obtiene el conjunto resultado de casos cerrados.
			$this->objGateway->setData(array("ordefecingdini"=>$ordefecingdini,"ordefecingdfin"=>$ordefecingdfin,"ordefecdiginin"=>$ordefecdiginin,
									   "ordefecdigfinn"=>$ordefecdigfinn,"ordefecfinad"=>true));
			$this->objGateway->getCasos();
			$rcTmp = $this->objGateway->getResult();

			if(is_array($rcTmp) && $rcTmp){

				//se obtienen los datos de las actas de cada caso y asi a su vez las posibles transferencias de las mismas.
				foreach($rcTmp as $nuCont=>$rcRow){
					$this->sbOrdenumeros=$rcRow["ordenumeros"];
					$this->nuOrdefecfinad=$rcRow["ordefecfinad"];
					$this->getTimeByDep();
					$rcOrden[$rcRow["ordenumeros"]]["AT"] = $this->getResult();
					$this->TimeB = $rcRow["ordefecregd"];
					$this->TimeE = $rcRow["ordefecfinad"];
					$this->CalculateTime();
					$rcOrden[$rcRow["ordenumeros"]]["CT"] = $this->nuCantTime;
				}
				//caso por caso se realiza el calculo de tiempo.
				if(is_array($rcOrden) && $rcOrden){
					//por ultimo se realiza el calculo de indicador y se organiza la informacion para presentarla.
					//se evalua si viene una dep, si es asi en cuales casos trabajo 

					foreach ($rcOrden as $sbOrdenumeros=>$rcTmp){
						$sbFlag = true;
						foreach($rcTmp["AT"] as $sbOrgacodigos=>$nuCant){
							if($orgacodigos){
								$sbFlag = false;
								if($sbOrgacodigos==$orgacodigos){
									$rcTotByDep[$sbOrgacodigos] += $nuCant;
									$sbFlag = true;
									$rcOrdenN[$sbOrdenumeros]["CT"] = $rcTmp["CT"];
									$rcOrdenN[$sbOrdenumeros]["AT"] = array($sbOrgacodigos=>$nuCant);
									break;
								}
							}else{
								$rcOrdenN[$sbOrdenumeros] = $rcTmp;
								$rcTotByDep[$sbOrgacodigos] += $nuCant;
							}
							
						}
						if($sbFlag){
							$nuCantTO += $rcTmp["CT"]++;
						}
					}
					
					if(is_array($rcOrdenN) && $rcOrdenN){
						$rcOrden = $rcOrdenN;
						$rcResult["data"] = array("dataT"=>$rcOrden,"cantT"=>$nuCantTO,"dataD"=>$rcTotByDep);
						$rcResult["result"] = true;
					}else{
						$rcResult["message"] = 22;
						$rcResult["result"] = false;
					}
				}else{
					$rcResult["message"] = 22;
					$rcResult["result"] = false;	
				}
			}else{
				$rcResult["message"] = 22;
				$rcResult["result"] = false;
			}
		}else{
			$rcResult["message"] = 100;
			$rcResult["result"] = false;
		}
			
		$this->rcResult = $rcResult;
	}

	//--------------------------------
	/**
	 * @Copyright 2011 Parquesoft
	 *
	 * Obtiene el intervalo en el cual una o varias dependencias trabajaron sobre un caso
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getTimeByDep(){

		settype($rcResult,"array");
		settype($rcTmp,"array");
		settype($rcActa,"array");
		settype($rcOrg,"array");
		settype($rcRow,"array");
		settype($sbSql,"string");
		settype($sbTmp,"string");
		settype($nuCant,"integer");
		settype($nuCont,"integer");
		settype($nuDate,"integer");
		
		if($this->sbOrdenumeros){
			
			//se obtiene el acta del caso
			$this->objGateway->setData(array("ordenumeros"=>$this->sbOrdenumeros));
			$this->objGateway->getActa();
			$rcTmp = $this->objGateway->getResult();
				
			if(is_array($rcTmp) && $rcTmp){
				$rcActa = $rcTmp[0];
				//si encontro regitro de acta entonces buscamos si se ha transferido.
				$this->objGateway->setData(array("actacodigos"=>$rcActa["actacodigos"]));
				$this->objGateway->getTransfertarea();
				$rcTmp = $this->objGateway->getResult();

				if(is_array($rcTmp) && $rcTmp){
					$nuCant = sizeof($rcTmp);
						
					for($nuCont=0;$nuCont<$nuCant;$nuCont++){
						$rcRow = $rcTmp[$nuCont];
						if(($nuCont+1)<$nuCant){
							$nuDate = $rcTmp[$nuCont+1][trtafechan];
						}else{
							$nuDate = $this->nuOrdefecfinad;
						}
						$rcOrg[$nuCont] = array("orgacodigos"=>$rcRow["orgacodigos"],
												"fecini"=>$rcRow["trtafechan"],
												"fecfin"=>$nuDate);
					}
				}
				if(!$rcOrg){
					$rcOrg[0] = array("orgacodigos"=>$rcActa["orgacodigos"],
									  "fecini"=>$rcActa["actafechingn"],
									  "fecfin"=>$this->nuOrdefecfinad);
				}
			}
			//se realiza el analisis de tiempos
			if(is_array($rcOrg) && $rcOrg){
				foreach($rcOrg as $rcTmp){
					
					$this->TimeB = $rcTmp["fecini"];
					$this->TimeE = $rcTmp["fecfin"];
					$this->CalculateTime();
					$rcResult[$rcTmp["orgacodigos"]] += $this->nuCantTime;
				}
			}
		}

		$this->rcResult = $rcResult;

	}
	/**
	 * @copyright 2011 &copy; FullEngine
	 *
	 *  Calcula el timpo en segundos entre dos fechas, tiene en cuenta
	 *  los dias inhabiles
	 * @author freina <freina@parquesoft.com>
	 * @date 02-Nov-2011 10:18
	 * @location Cali-Colombia
	 */
	function CalculateTime(){
		
		settype($objService, "object");
		settype($objDate, "object");
		settype($rcHour, "array");
		settype($rcDH, "array");
		settype($nuTime,"integer");
		settype($nuHourHFin, "integer");
		settype($nuHourHIni, "integer");
		settype($nuHourFin, "integer");
		settype($nuHourIni, "integer");
		settype($nuCantHourT, "integer");
		settype($nuCantHour, "integer");
		settype($nuDateB, "integer");
		settype($nuDateE, "integer");

		$this->nuCantTime = 0;

		if($this->TimeB && $this->TimeE){
			
			$objDate = Application :: loadServices("DateController");
				
			//se obtienen los horarios de atencion
			$objService = Application::loadServices("General");
			$rcHour = $objService->getParam("general",'horario_atencion');
			if($rcHour && is_array($rcHour)){
				if($rcHour["hora_fin"]){
					$nuHourHFin = $objDate->hour2secs($rcHour["hora_fin"]);
				}
				if($rcHour["hora_ini"]){
					$nuHourHIni = $objDate->hour2secs($rcHour["hora_ini"]);
				}
				//cantidad de segundos del turno.
				$nuCantHourT = $nuHourHFin - $nuHourHIni;
			}else{
				//sino se ha definido un horario el turno es de todo el dia
				$nuCantHourT = $objDate->nuSecsDay;
				$nuHourHFin = $objDate->nuSecsDay - 1;
				$nuHourHIni = 0 ;
			}
			
			
			//fecha inicial y final sin horas
			$nuDateB = $this->TimeB - $objDate->getHour2DateInSecs($this->TimeB);
			$nuDateE = $this->TimeE - $objDate->getHour2DateInSecs($this->TimeE);
			
			//se obtiene la cantidad de dias entre una fecha y otra
			$objService = Application::loadServices("General");
			$rcDH = $objService->getDiasHabiles($nuDateB, $nuDateE, true, true);
			
			if(is_array($rcDH) && $rcDH){
				//cantidad de dias en segundos
				$nuTime = sizeof($rcDH);
				$nuTime = $nuTime * $nuCantHourT;
			}else{
				$nuTime = 0;
			}
			
			//hora de la fecha de inicio
			$nuHourIni = $objDate->getHour2DateInSecs($this->TimeB);
			
			//hora de la fecha de cierre
			$nuHourFin = $objDate->getHour2DateInSecs($this->TimeE);
			
			if($nuDateB == $nuDateE){
				$nuCantHour = $nuHourFin - $nuHourIni;
			}else{
				$nuCantHour = ($nuHourHFin - $nuHourIni) + ($nuHourFin-$nuHourHIni);
			}
			
			$nuTime += $nuCantHour; 
			$this->nuCantTime = $nuTime;
		}

		$this->TimeB = 0;
		$this->TimeE = 0;

	}
}
?>