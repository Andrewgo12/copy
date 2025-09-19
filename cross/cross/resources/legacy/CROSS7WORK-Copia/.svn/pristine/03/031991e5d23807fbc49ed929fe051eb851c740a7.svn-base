<?php
class FeEnModelorespManager
{
	var $gateway;

	function FeEnModelorespManager()
	{
		$this->gateway = Application::getDataGateway("modeloresp");
	}

	function addModeloresp($morenombres,$moredescrips){

		settype($objManager,"object");
		settype($nuMorecodigon,"integer");

		$objManager = Application::getDomainController('NumeradorManager');
		$nuMorecodigon = $objManager->fncgetByIdNumerador('modeloresp');

		if($this->gateway->existModeloresp($nuMorecodigon) == 0){
			$this->gateway->addModeloresp($nuMorecodigon,$morenombres,$moredescrips);
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

	function updateModeloresp($morecodigon,$morenombres,$moredescrips){
		if($this->gateway->existModeloresp($morecodigon) == 1){
			$this->gateway->updateModeloresp($morecodigon,$morenombres,$moredescrips);
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

	function deleteModeloresp($morecodigon){

		settype($objManager,"object");
		settype($rcData,"array");

		if($this->gateway->existModeloresp($morecodigon) == 1){
			//valida que no haya relacion con preguntas
			$objManager = Application::getDomainController('PreguntaManager');
			$objManager->setData(array("morecodigon"=>$morecodigon));
			$objManager->getByIdModeloresp();
			$rcData = $objManager->getResult();
			if(is_array($rcData) && $rcData){
				return 15;
			}
			//valida que no haya relacion con opciones de respuesta
			$objManager = Application::getDomainController('OpcionrepuesManager');
			$objManager->setData(array("morecodigon"=>$morecodigon));
			$objManager->getByIdModeloresp();
			$rcData = $objManager->getResult();
			if(is_array($rcData) && $rcData){
				return 16;
			}
				
			$this->gateway->deleteModeloresp($morecodigon);
			if($this->gateway->consult){
				$this->UnsetRequest();
				return 3;
			}
			else
			return 100;
		}else{
			return 2;
		}
	}

	function getByIdModeloresp($morecodigon)
	{
		$data_modeloresp = $this->gateway->getByIdModeloresp($morecodigon);
		return $data_modeloresp;
	}

	function getAllModeloresp()
	{
		return $this->gateway->getAllModeloresp();
	}


	function UnsetRequest()
	{
		unset($_REQUEST["modeloresp__morecodigon"]);
		unset($_REQUEST["modeloresp__morenombres"]);
		unset($_REQUEST["modeloresp__moredescrips"]);
	}
}
?>