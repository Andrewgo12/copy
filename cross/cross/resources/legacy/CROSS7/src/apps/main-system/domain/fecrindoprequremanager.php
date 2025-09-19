<?php
class FeCrIndoprequreManager{
	function FeCrIndoprequreManager(){
		$this->objGateway = Application::getDataGateway("indoprequre");
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
		unset($_REQUEST["ordefecregdb"]);
		unset($_REQUEST["ordefecregde"]);
		unset($_REQUEST["ordefecingdb"]);
		unset($_REQUEST["ordefecingde"]);
		unset($_REQUEST["tiorcodigos"]);
		unset($_REQUEST["evencodigos"]);
		unset($_REQUEST["causcodigos"]);
	}

	/**
	 * @copyright Copyright 2011 &copy; FullEngine
	 *
	 * Genera los indicadores
	 * @author freina <freina@parquesoft.com>
	 * @date 01-Nov-2011 09:50
	 * @location Cali-Colombia
	 */
	function getIndoprequre(){

		settype($rcResult,"array");
		settype($rcData,"array");
		settype($rcTmp,"array");
		settype($rcOrden,"array");
		settype($rcRow,"array");
		settype($nuCont,"integer");
		settype($nuCantTO,"integer");

		$rcData = $this->rcData;

		if($rcData && is_array($rcData)){
			
			extract($rcData);

			//se obtiene el conjunto resultado de casos cerrados.
			$this->objGateway->setData(array("ordefecregdb"=>$ordefecregdb,"ordefecregde"=>$ordefecregde,"ordefecingdb"=>$ordefecingdb,
									   "ordefecingde"=>$ordefecingde,"ordefecfinad"=>true,"tiorcodigos"=>$tiorcodigos,
									   "evencodigos"=>$evencodigos,"causcodigos"=>$causcodigos));
			$this->objGateway->getCasos();
			$rcTmp = $this->objGateway->getResult();

			if(is_array($rcTmp) && $rcTmp){

				//caso por caso se realiza el calculo de tiempo.
				foreach($rcTmp as $nuCont=>$rcRow){
					$this->TimeB = $rcRow["ordefecregd"];
					$this->TimeE = $rcRow["ordefecfinad"];
					$this->CalculateTime();
					$rcOrden[$rcRow["ordenumeros"]]["CT"] = $this->nuCantTime;
					$nuCantTO += $this->nuCantTime;
				}
				
				if(is_array($rcOrden) && $rcOrden){
					//por ultimo se realiza el calculo de indicador y se organiza la informacion para presentarla.					
					$rcResult["data"] = array("dataT"=>$rcOrden,"cantT"=>$nuCantTO);
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
			$rcResult["message"] = 100;
			$rcResult["result"] = false;
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