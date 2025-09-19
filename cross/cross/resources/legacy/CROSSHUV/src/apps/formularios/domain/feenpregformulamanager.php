<?php
class FeEnPregformulaManager{
	function FeEnPregformulaManager(){
		$this->objGateway = Application::getDataGateway("pregformula");
		$this->objGateway_D = Application::getDataGateway("respuepregun");
	}

	function setData($rcData){
		$this->rcData = $rcData;
	}

	function getResult(){
		return $this->rcResult;
	}

	function addConfiguration(){

		settype($objManager,"object");
		settype($rcData,"array");
		settype($rcResult,"array");
		settype($rcTmp,"array");
		settype($rcRow,"array");
		settype($rcSql_1,"array");
		settype($rcSql_2,"array");
		settype($rcSql,"array");
		settype($rcIndex, "array");
		settype($rcAnswer,"array");
		settype($sbResult,"string");
		settype($nuCont,"integer");
		settype($nuCant,"integer");
		settype($nuRow,"integer");
		settype($nuPrfocodigon,"integer");
		settype($nuFormcodigon,"integer");
		settype($nuReprcodigon,"integer");

		$rcData = $this->rcData;
		
		if($rcData && is_array($rcData)){
			
			$this->objGateway->setExecuteSql(false);
			$this->objGateway_D->setExecuteSql(false);
			
			$nuFormcodigon = $rcData[0]["formcodigon"];
			
			//elimina las posibles configuraciones anteriores del formulario
			$this->objGateway_D->setData(array("formcodigon"=>$nuFormcodigon));
			$this->objGateway_D->deleteByFormulario();
			$rcSql = $this->objGateway_D->getSql();
			$this->objGateway_D->setSql(null);
			
			$this->objGateway->setSql($rcSql);
			$this->objGateway->setData(array("formcodigon"=>$nuFormcodigon));
			$this->objGateway->deleteByFormulario();
			unset($rcSql);
			
			$nuCant = sizeof($rcData[1]);
			$objManager = Application :: getDomainController('NumeradorManager');
			$nuPrfocodigon = $objManager->fncgetByIdNumerador("pregformula",$nuCant);
			foreach($rcData[1] as $nuCont=>$rcTmp){
				//se recorre uno a uno las preguntas configuradas
				$nuRow++;
				$this->objGateway->setData(array("prfocodigon"=>$nuPrfocodigon,"formcodigon"=>$nuFormcodigon,"pregcodigon"=>$rcTmp["pregcodigon"],
												"pregpadren"=>$rcTmp["pregpadren"],"objecodigon"=>$rcTmp["objecodigon"],"prfoordenn"=>$nuRow));
				$this->objGateway->addPregformula();
				
				$rcAnswer = $rcTmp["answer"];
				if($rcAnswer && is_array($rcAnswer)){
					$nuCant = sizeof($rcAnswer);
					$nuReprcodigon = $objManager->fncgetByIdNumerador("respuepregun",$nuCant);
					foreach($rcAnswer as $rcRow){
						if(!$rcRow["reprpeson"]){
							$rcRow["reprpeson"] = 0;	
						}
						if(!$rcRow["reprordenn"]){
							$rcRow["reprordenn"] = 0;	
						}
						
						//relaciona el indice generado para la configuracion de la opcion de respuesta padre
						if($rcRow["oprepadren"]){
							$rcRow["oprepadren"] = $rcIndex[$rcTmp["pregpadren"]][$rcRow["oprepadren"]];
						}
						
						$this->objGateway_D->setData(array("prfocodigon"=>$nuPrfocodigon,"reprcodigon"=>$nuReprcodigon,"oprecodigon"=>$rcRow["oprecodigon"],
												"oprepadren"=>$rcRow["oprepadren"],"reprordenn"=>$rcRow["reprordenn"],"reprpeson"=>$rcRow["reprpeson"]));
						$this->objGateway_D->addRespuepregun();
						
						$rcIndex[$rcTmp["pregcodigon"]][$rcRow["oprecodigon"]] = $nuReprcodigon;
						
						$nuReprcodigon++;
					}
				}
				
				$nuPrfocodigon++;
			}
			$rcSql_1 = $this->objGateway->getSql();
			$rcSql_2 = $this->objGateway_D->getSql();
			
			if($rcSql_1 && is_array($rcSql_1)){
				$rcSql = $rcSql_1;
			}
			
			if($rcSql_2 && is_array($rcSql_2)){
				if($rcSql && is_array($rcSql)){
					$rcSql = array_merge($rcSql,$rcSql_2);
				}else{
					$rcSql = $rcSql_2;	
				}
			}
			
			//transaccion
			$this->objGateway->setSql($rcSql);
			$this->objGateway->executeTrans();
			$sbResult = $this->objGateway->getConsult();
			 if($sbResult){
			 	$rcResult["result"] = true;
			 }else{
			 	$rcResult["result"] = false;
			 }
			
		}else{
			$rcResult["result"] = false;
		}
			
		$this->rcResult = $rcResult;
	}
	
	/**
	* @copyright Copyright 2009 FullEngine
	*
	* Obtiene la configuracion de un formulario
	* @author freina <freina@parquesoft.com>
	* @date 2-Aug-2009 11:39
	* @location Cali-Colombia
	*/
	function getConfiguration(){
		
		settype($rcResult,"array");
		settype($rcTmp,"array");
		settype($rcRow,"array");
		settype($nuCont,"integer");
		
		extract($this->rcData);
		if($formcodigon){
			$this->objGateway->setData(array("formcodigon"=>$formcodigon));
			$this->objGateway->getByFormcodigon();
			$rcResult = $this->objGateway->getResult();
			
			//se obtiene el detalle de cada pregunta
			if($rcResult && is_array($rcResult)){
				foreach($rcResult as $nuCont=>$rcTmp){
					$this->objGateway_D->setData(array("prfocodigon"=>$rcTmp["prfocodigon"]));
					$this->objGateway_D->getByPrfocodigon();
					$rcRow = $this->objGateway_D->getResult();
					if($rcRow && is_array($rcRow)){
						$rcResult[$nuCont]["answer"] = $rcRow;	
					}else{
						$rcResult[$nuCont]["answer"] = null;
					}
				}
			}
		}
		$this->rcResult = $rcResult;
	}
	
/**
	* @copyright Copyright 2009 FullEngine
	*
	* Obtiene la configuracion de un formulario
	* @author freina <freina@parquesoft.com>
	* @date 02-Aug-2009 11:39
	* @location Cali-Colombia
	*/
	function getDefaultConfiguration(){
		
		settype($rcResult,"array");
		settype($rcTmp,"array");
		settype($rcRow,"array");
		settype($nuCont,"integer");
		
		$this->objGateway->getByDefault();
		$rcResult = $this->objGateway->getResult();
		
		//se obtiene el detalle de cada pregunta
		if($rcResult && is_array($rcResult)){
			foreach($rcResult as $nuCont=>$rcTmp){
				$this->objGateway_D->setData(array("prfocodigon"=>$rcTmp["prfocodigon"]));
				$this->objGateway_D->getByPrfocodigon();
				$rcRow = $this->objGateway_D->getResult();
				if($rcRow && is_array($rcRow)){
					$rcResult[$nuCont]["answer"] = $rcRow;	
				}else{
					$rcResult[$nuCont]["answer"] = null;
				}	
			}
		}
		$this->rcResult = $rcResult;
	}
	
	/**
	 * @Copyright 2009 Parquesoft
	 *
	 * Obtiene las configuraciones relacionadas a un formulario
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getByIdFormulario(){
		
		if($this->rcData){
			extract($this->rcData);
			$this->objGateway->setData(array("formcodigon"=>$formcodigon));
			$this->objGateway->getByIdFormulario();
			$this->rcResult = $this->objGateway->getResult();
		}
	}
	
	/**
	 * @Copyright 2009 Parquesoft
	 *
	 * Obtiene las configuraciones relacionadas a una pregunta
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getByIdPregunta(){
		
		if($this->rcData){
			extract($this->rcData);
			$this->objGateway->setData(array("pregcodigon"=>$pregcodigon));
			$this->objGateway->getByIdPregunta();
			$this->rcResult = $this->objGateway->getResult();
		}
	}
	
	/**
	 * @Copyright 2009 Parquesoft
	 *
	 * Obtiene las configuraciones relacionadas a una respuesta
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getByIdOpcionrepues(){
	if($this->rcData){
			extract($this->rcData);
			$this->objGateway_D->setData(array("oprecodigon"=>$oprecodigon));
			$this->objGateway_D->getByIdOpcionrepues();
			$this->rcResult = $this->objGateway_D->getResult();
		}
	}
}
?>