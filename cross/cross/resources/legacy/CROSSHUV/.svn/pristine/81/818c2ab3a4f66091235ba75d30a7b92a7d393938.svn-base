<?php
class FeEnPreguntaManager
{
	var $gateway;

	function FeEnPreguntaManager()
	{
		$this->gateway = Application::getDataGateway("pregunta");
	}

	function addPregunta($pregdescris,$temacodigon,$morecodigon,$pregtipopres,$pregactivas){

		settype($objManager,"object");
		settype($nuPregcodigon,"integer");
		settype($sbTipo,"string");

		//se valida que si la pregunta es abierta no lleve modelo de respuesta
		$sbTipo = Application::getConstant('PREG_ABIERTA');
			
		if($morecodigon!=null && $morecodigon!=""){
			if($pregtipopres==$sbTipo){
				return 19;
			}
		}

		$objManager = Application::getDomainController('NumeradorManager');
		$nuPregcodigon = $objManager->fncgetByIdNumerador('pregunta');

		if($this->gateway->existPregunta($nuPregcodigon) == 0){
			$this->gateway->addPregunta($nuPregcodigon,$pregdescris,$temacodigon,$morecodigon,$pregtipopres,$pregactivas);
			if($this->gateway->consult){
				$this->UnsetRequest();
				return 3;
			}else{
				return 100;
			}
		}else{
			return 1;
		}
	}

	function updatePregunta($pregcodigon,$pregdescris,$temacodigon,$morecodigon,$pregtipopres,$pregactivas){

		settype($objManager,"object");
		settype($rcData,"array");
		settype($sbTipo,"string");

		if($this->gateway->existPregunta($pregcodigon) == 1){

			//se valida que si la pregunta es abierta no lleve modelo de respuesta
			$sbTipo = Application::getConstant('PREG_ABIERTA');

			if($morecodigon!=null && $morecodigon!=""){
				if($pregtipopres==$sbTipo){
					return 19;
				}
			}

			//valida que no haya relacion con configuraciones
			$objManager = Application::getDomainController('PregformulaManager');
			$objManager->setData(array("pregcodigon"=>$pregcodigon));
			$objManager->getByIdPregunta();
			$rcData = $objManager->getResult();
			if(is_array($rcData) && $rcData){
				return 20;
			}

			//valida si la pregunta esta siendo usada en una configuracion.

			$this->gateway->updatePregunta($pregcodigon,$pregdescris,$temacodigon,$morecodigon,$pregtipopres,$pregactivas);
			if($this->gateway->consult){
				$this->UnsetRequest();
				return 3;
			}else{
				return 100;
			}
		}else{
			return 2;
		}
	}

	function deletePregunta($pregcodigon){

		settype($objManager,"object");
		settype($rcData,"array");

		if($this->gateway->existPregunta($pregcodigon) == 1){

			//valida que no haya relacion con configuraciones
			$objManager = Application::getDomainController('PregformulaManager');
			$objManager->setData(array("pregcodigon"=>$pregcodigon));
			$objManager->getByIdPregunta();
			$rcData = $objManager->getResult();
			if(is_array($rcData) && $rcData){
				return 27;
			}

			$this->gateway->deletePregunta($pregcodigon);
			if($this->gateway->consult)
			{
				$this->UnsetRequest();
				return 3;
			}
			else
			return 100;
		}else{
			return 2;
		}
	}

	function getByIdPregunta($pregcodigon)
	{
		$data_pregunta = $this->gateway->getByIdPregunta($pregcodigon);
		return $data_pregunta;
	}

	function getAllPregunta()
	{
		return $this->gateway->getDataPregunta();
	}

	function getAllPreguntas($form=false)
	{
		return $this->gateway->getDataPreguntasAgrupadas($form);
	}

	function getAllPreguntasUsadas($nuForm)
	{
		return $this->gateway->getAllPreguntasUsadas($nuForm);
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
	 * @Copyright 2009 Parquesoft
	 *
	 * Obtiene el resultado de la consulta (data)
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getResult(){
		return $this->rcResult;
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
			$this->gateway->setData(array("morecodigon"=>$morecodigon));
			$this->gateway->getByIdModeloresp();
			$this->rcResult = $this->gateway->getResult();
		}
	}

	/**
	 * @Copyright 2009 Parquesoft
	 *
	 * Obtiene las preguntas con un tema
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getByIdTema(){

		if($this->rcData){
			extract($this->rcData);
			$this->gateway->setData(array("temacodigon"=>$temacodigon));
			$this->gateway->getByIdTema();
			$this->rcResult = $this->gateway->getResult();
		}
	}

	function UnsetRequest(){
		unset($_REQUEST["pregunta__pregcodigon"]);
		unset($_REQUEST["pregunta__morecodigon"]);
		unset($_REQUEST["pregunta__pregactivas"]);
		unset($_REQUEST["pregunta__pregdescris"]);
		unset($_REQUEST["pregunta__temacodigon"]);
		unset($_REQUEST["pregunta__pregtipopres"]);
	}
}
?>