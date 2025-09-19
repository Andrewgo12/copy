<?php
class FeEnOpcionrepuesManager{

	function FeEnOpcionrepuesManager(){
		$this->objGateway = Application::getDataGateway("opcionrepues");
	}

	function setPrecodigon($nuPregcodigon){
		$this->nuPregcodigon = $nuPregcodigon;
	}

	function getResult(){
		return $this->rcResult;
	}

	function setOprecodigon($nuOprecodigon){
		$this->nuOprecodigon=$nuOprecodigon;
	}
	
	/**
	 * @Copyright 2009 Parquesoft
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
	 * @copyright Copyright 2004 &copy; FullEngine
	 *
	 *  Obtiene las opciones de respuesta
	 *  Si el codigo de pregunta esta presente entonces presenta primero las opciones de respuesta
	 *  relacionadas con el modelo de respuesta de la pregunta
	 * @author freina <freina@parquesoft.com>
	 * @date 09-Jul-2009 15:35
	 * @location Cali-Colombia
	 */
	function getOpcionrepuesByPregcodigon(){

		settype($rcData,"array");
		settype($rcTmp,"array");
		settype($rcIndex,"array");
		settype($rcRow,"array");
		settype($sbTmp,"string");
		settype($nuCont,"integer");

		//si viene la pregunta se ubican primero las respuestas que esten relacionadas al modelo de respuesta
		if($this->nuPregcodigon){
			$this->objGateway->setPrecodigon($this->nuPregcodigon);
			$this->objGateway->getOpcionrepuesByPregcodigon();
			$rcTmp = $this->objGateway->getResult();
			//se obtienen los indices de las preguntas.
			if($rcTmp && is_array($rcTmp)){
				foreach($rcTmp as $nuCont=>$rcRow){
					$rcIndex[$nuCont] = $rcRow["oprecodigon"];
					$rcData[$nuCont][0] = $rcRow["oprecodigon"];
					$rcData[$nuCont][1] = $rcRow["opredescrisp"];
				}
			}
		}

		if($nuCont){
			$nuCont++;
		}
		// se obtiene el resto de opciones
		$this->objGateway->getAllOpcionrepues();
		$rcTmp = $this->objGateway->getResult();
		if($rcTmp && is_array($rcTmp)){
			foreach($rcTmp as $rcRow){
				$sbTmp = true;
				// se excluyen los ta seleccionados
				if($rcIndex && is_array($rcIndex)){
					if(in_array($rcRow["oprecodigon"],$rcIndex)){
						$sbTmp = false;
					}
				}
				if($sbTmp){
					$rcData[$nuCont][0] = $rcRow["oprecodigon"];
					$rcData[$nuCont][1] = $rcRow["opredescrisp"];
					$nuCont++;
				}
			}
		}
		$this->rcResult = $rcData;
	}


	function getByIdOpcionrepues(){
		settype($rcData,"array");
		if($this->nuOprecodigon){
			$this->objGateway->setOprecodigon($this->nuOprecodigon); 
			$this->objGateway->getByIdOpcionrepues();
			$rcData = $this->objGateway->getResult();	
		}
		
		$this->rcResult = $rcData;
	}
	
 /**
	 * @Copyright 2009 Parquesoft
	 *
	 * Obtiene las preguntas con un modelo de respuestas
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getByIdModeloresp(){
		
		if($this->rcData){
			extract($this->rcData);
			$this->objGateway->setData(array("morecodigon"=>$morecodigon));
			$this->objGateway->getByIdModeloresp();
			$this->rcResult = $this->objGateway->getResult();
		}
	}
	
	/**
	 * @Copyright 2009 Parquesoft
	 *
	 * Ingreso de una nueva respuesta
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function addOpcionrepues(){
		
		settype($objManager,"object");
		settype($nuOprecodigon,"integer");
		
		if($this->rcData){
			$objManager = Application::getDomainController('NumeradorManager');
			$nuOprecodigon = $objManager->fncgetByIdNumerador('opcionrepues');
			
			extract($this->rcData);
			$this->objGateway->setData(array("oprecodigon"=>$nuOprecodigon,
											 "opredescrisp"=>$opredescrisp,
									   		 "morecodigon"=>$morecodigon,
									   		 "opreactivas"=>$opreactivas));
			$this->objGateway->addOpcionrepues();
			if($this->objGateway->getConsult()){
				$this->UnsetRequest();
				$this->rcResult["message"] = 3;
			}else{
				$this->rcResult["message"] = 100; 
			}
		}
	}
	
	/**
	 * @Copyright 2009 Parquesoft
	 *
	 * modifica una respuesta
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function updateOpcionrepues(){
		
		settype($objManager,"object");
		settype($rcData,"array");
		
		if($this->rcData){
			extract($this->rcData);
			//valida que la respuesta no este en una configuracion
			$objManager = Application::getDomainController('PregformulaManager');
			$objManager->setData(array("oprecodigon"=>$oprecodigon));
			$objManager->getByIdOpcionrepues();
			$rcData = $objManager->getResult(); 
			if(is_array($rcData) && $rcData){
				$this->rcResult["message"] = 28;
				return;
			}
			
			$this->objGateway->setOprecodigon($oprecodigon);
			$this->objGateway->existOpcionrepues();
			$rcData = $this->objGateway->getResult();
			if($rcData["nuCant"]== 1){
				$this->objGateway->setData(array("oprecodigon"=>$oprecodigon,
												 "opredescrisp"=>$opredescrisp,
										   		 "morecodigon"=>$morecodigon,
										   		 "opreactivas"=>$opreactivas));
				$this->objGateway->updateOpcionrepues();
				if($this->objGateway->getConsult()){
					$this->UnsetRequest();
					$this->rcResult["message"] = 3;
				}else{
					$this->rcResult["message"] = 100; 
				}
			}else{
				$this->rcResult["message"] = 2;
			}
		}
	}
	
	/**
	 * @Copyright 2009 Parquesoft
	 *
	 * modifica una respuesta
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function deleteOpcionrepues(){
		
		settype($objManager,"object");
		settype($rcData,"array");
		
		if($this->rcData){
			extract($this->rcData);
			//valida que la respuesta no este en una configuracion
			$objManager = Application::getDomainController('PregformulaManager');
			$objManager->setData(array("oprecodigon"=>$oprecodigon));
			$objManager->getByIdOpcionrepues();
			$rcData = $objManager->getResult(); 
			if(is_array($rcData) && $rcData){
				$this->rcResult["message"] = 29;
				return;
			}
			
			$this->objGateway->setOprecodigon($oprecodigon);
			$this->objGateway->existOpcionrepues();
			$rcData = $this->objGateway->getResult();
			if($rcData["nuCant"]== 1){
				$this->objGateway->setData(array("oprecodigon"=>$oprecodigon));
				$this->objGateway->deleteOpcionrepues();
				if($this->objGateway->getConsult()){
					$this->UnsetRequest();
					$this->rcResult["message"] = 3;
				}else{
					$this->rcResult["message"] = 100; 
				}
			}else{
				$this->rcResult["message"] = 2;
			}
		}
	}
	
	function unsetRequest() {
		unset($_REQUEST["opcionrepues__oprecodigon"]);
		unset($_REQUEST["opcionrepues__opredescrisp"]);
		unset($_REQUEST["opcionrepues__morecodigon"]);
		unset($_REQUEST["opcionrepues__opreactivas"]);
	}
}
?>