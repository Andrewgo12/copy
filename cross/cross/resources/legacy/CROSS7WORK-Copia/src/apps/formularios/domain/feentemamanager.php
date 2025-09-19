<?php
class FeEnTemaManager
{
	var $gateway;

	function FeEnTemaManager()
	{
		$this->gateway = Application::getDataGateway("tema");
	}

	function addTema($ejtecodigon,$temanombres,$temadescrips){

		settype($objManager,"object");
		settype($nuTemacodigon,"integer");

		$objManager = Application::getDomainController('NumeradorManager');
		$nuTemacodigon = $objManager->fncgetByIdNumerador('tema');

		if($this->gateway->existTema($nuTemacodigon) == 0){
			$this->gateway->addTema($nuTemacodigon,$ejtecodigon,$temanombres,$temadescrips);
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

	function updateTema($temacodigon,$ejtecodigon,$temanombres,$temadescrips){

		settype($objGateway,"object");

		if($this->gateway->existTema($temacodigon) == 1){

			//se valida la realcion tema - pregunta - configuracion - respusta ususario
			$objGateway = Application::getDataGateway("pregformula");
			$objGateway->setData(array("temacodigon"=>$temacodigon));
			$objGateway->existByIdTema();
			if($objGateway->getConsult()){
				return 25;
			}

			$this->gateway->updateTema($temacodigon,$ejtecodigon,$temanombres,$temadescrips);
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

	function deleteTema($temacodigon){

		settype($objManager,"object");
		settype($objGateway,"object");
		settype($rcData,"array");

		if($this->gateway->existTema($temacodigon) == 1){
				
			//se valida la realcion tema - pregunta - configuracion - respusta ususario
			$objGateway = Application::getDataGateway("pregformula");
			$objGateway->setData(array("temacodigon"=>$temacodigon));
			$objGateway->existByIdTema();
			if($objGateway->getConsult()){
				return 26;
			}

			//valida que no haya relacion con preguntas
			$objManager = Application::getDomainController('PreguntaManager');
			$objManager->setData(array("temacodigon"=>$temacodigon));
			$objManager->getByIdTema();
			$rcData = $objManager->getResult();
			if(is_array($rcData) && $rcData){
				return 17;
			}

			$this->gateway->deleteTema($temacodigon);
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

	function getByIdTema($temacodigon){
		$data_tema = $this->gateway->getByIdTema($temacodigon);
		return $data_tema;
	}

	function getByIdEjetematico($ejtecodigon){

		settype($rcData,"array");
		$rcData = $this->gateway->getByIdEjetematico($ejtecodigon);
		return $rcData;
	}

	function getAllTema(){
		//$this->gateway->
	}


	function UnsetRequest(){
		unset($_REQUEST["tema__temacodigon"]);
		unset($_REQUEST["tema__ejtecodigon"]);
		unset($_REQUEST["tema__temanombres"]);
		unset($_REQUEST["tema__temadescrips"]);
	}
}
?>