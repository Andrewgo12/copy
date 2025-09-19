<?php
class FeEnEjetematicoManager{
	var $gateway;

	function FeEnEjetematicoManager(){
		$this->gateway = Application::getDataGateway("ejetematico");
	}

	function addEjetematico($ejtenombres,$ejtedescrips){

		settype($objManager,"object");
		settype($nuEjtecodigon,"integer");

		$objManager = Application::getDomainController('NumeradorManager');
		$nuEjtecodigon = $objManager->fncgetByIdNumerador('ejetematico');

		if($this->gateway->existEjetematico($nuEjtecodigon) == 0){
			$this->gateway->addEjetematico($nuEjtecodigon,$ejtenombres,$ejtedescrips);
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

	function updateEjetematico($ejtecodigon,$ejtenombres,$ejtedescrips){

		settype($objGateway,"object");

		if($this->gateway->existEjetematico($ejtecodigon) == 1){

			//se valida la realcion eje - tema - pregunta - configuracion - respusta ususario
			$objGateway = Application::getDataGateway("pregformula");
			$objGateway->setData(array("ejtecodigon"=>$ejtecodigon));
			$objGateway->existByIdEjetematico();
			if($objGateway->getConsult()){
				return 23;
			}

			$this->gateway->updateEjetematico($ejtecodigon,$ejtenombres,$ejtedescrips);
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

	function deleteEjetematico($ejtecodigon){

		settype($objManager,"object");
		settype($objGateway,"object");
		settype($rcData,"array");

		if($this->gateway->existEjetematico($ejtecodigon) == 1){

			//se valida la realcion eje - tema - pregunta - configuracion - respusta ususario
			$objGateway = Application::getDataGateway("pregformula");
			$objGateway->setData(array("ejtecodigon"=>$ejtecodigon));
			$objGateway->existByIdEjetematico();
			if($objGateway->getConsult()){
				return 24;
			}

			//valida que no haya un tema relacionado
			$objManager = Application::getDomainController('TemaManager');
			$rcData = $objManager->getByIdEjetematico($ejtecodigon);
			if(is_array($rcData) && $rcData){
				return 14;
			}

			$this->gateway->deleteEjetematico($ejtecodigon);
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

	function getByIdEjetematico($ejtecodigon)
	{
		$data_ejetematico = $this->gateway->getByIdEjetematico($ejtecodigon);
		return $data_ejetematico;
	}

	function getAllEjetematico()
	{
		$data_ejetematico = $this->gateway->getAllEjetematico();
		return $data_ejetematico;
	}


	function UnsetRequest()
	{
		unset($_REQUEST["ejetematico__ejtecodigon"]);
		unset($_REQUEST["ejetematico__ejtenombres"]);
		unset($_REQUEST["ejetematico__ejtedescrips"]);
	}
}
?>