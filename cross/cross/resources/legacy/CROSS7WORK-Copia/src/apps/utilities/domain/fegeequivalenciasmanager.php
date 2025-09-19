<?php
class FeGeEquivalenciasManager {

	function FeGeEquivalenciasManager(){
		$this->objGateway = Application::getDataGateway("equivalencia");
	}

	function setData($rcData){
		$this->rcData = $rcData;
	}

	function getResult(){
		return $this->rcResult;
	}

	function addEquivalencias(){

		settype($objManager,"object");
		settype($objDate,"object");
		settype($rcData,"array");
		settype($nuMessage,"integer");

		if(is_array($this->rcData) && $this->rcData){

			$objManager = Application :: getDomainController('NumeradorManager');
			$rcData = $this->rcData;
			$rcData["equicodigon"] = $objManager->fncgetByIdNumerador("equivalencias");
			$objDate = Application :: loadServices("DateController");
			$rcData["equifechacrn"] = $objDate->fncintdatehour();
			$this->objGateway->setData($rcData);

			$this->objGateway->addEquivalencias();

			if($this->objGateway->getConsult()){
				$nuMessage = 3;
				$this->UnsetRequest();
			}else{
				$nuMessage = 100;
			}
		}else{
			$nuMessage = 100;
		}

		$this->rcResult["message"] = $nuMessage;
	}
	function updateEquivalencias(){

		settype($rcData,"array");
		settype($rcTmp,"array");
		settype($rcRow,"array");
		settype($rcResult,"array");
		settype($sbResult,"string");
		settype($sbFlag,"string");
		settype($sbUsed,"string");
		settype($nuCont,"integer");

		$sbFlag =true;
		$sbUsed = false;

		$rcData = $this->rcData;

		if($rcData && is_array($rcData)){

			$rcTmp = $rcData;
			// se valida la existencia del id
			$this->objGateway->setData($rcData);
			$this->objGateway->existEquivalencias();
			$sbResult = $this->objGateway->getConsult();
			if($sbResult){
				//se valida entonces que el regitro no sea duplicado
				unset($rcTmp["equicodigon"]);
				unset($rcTmp["equiestados"]);
				$this->objGateway->setData($rcTmp);
				$this->objGateway->getEquivalencias();
				$rcTmp = $this->objGateway->getResult();

				if(is_array($rcTmp) && $rcTmp){
					foreach($rcTmp as $nuCont=>$rcRow){
						if($rcRow["equicodigon"]!=$rcData["equicodigon"]){
							$sbFlag = false;
						}
					}
				}
				if($sbFlag){
					//por ultimo se valida si la equivalencia ya ha sido usada por un caso
					$this->objGateway->setData(array("equicodigon"=>$rcData["equicodigon"]));
					$this->objGateway->getEquivalenciacaso();
					$rcTmp = $this->objGateway->getResult();

					if(is_array($rcTmp) && $rcTmp){
						$this->objGateway->setData(array("equiestados"=>$rcData["equiestados"],"equicodigon"=>$rcData["equicodigon"]));
						$sbUsed = true;
					}else{
						$this->objGateway->setData($rcData);
					}

					$this->objGateway->updateEquivalencias();
					$sbResult = $this->objGateway->getConsult();
					if($sbResult){
						if($sbUsed){
							$rcResult["message"] = 73;
						}else{
							$rcResult["message"] = 3;
						}
						$rcResult["result"] = true;
						$this->UnsetRequest();
					}else{
						$rcResult["message"] = 100;
						$rcResult["result"] = false;
					}
				}else{
					$rcResult["message"] = 4;
					$rcResult["result"] = false;
				}
			}else{
				$rcResult["message"] = 2;
				$rcResult["result"] = false;
			}
		}else{
			$rcResult["message"] = 100;
			$rcResult["result"] = false;
		}
		$this->rcResult = $rcResult;
	}

	function deleteEquivalencias(){

		settype($rcData,"array");
		settype($rcResult,"array");
		settype($rcTmp,"array");
		settype($sbResult,"string");

		$rcData = $this->rcData;

		if($rcData && is_array($rcData)){
				
			// se valida la existencia del id
			$this->objGateway->setData($rcData);
			$this->objGateway->existEquivalencias();
			$sbResult = $this->objGateway->getConsult();
			if($sbResult){
				//por ultimo se valida si la equivalencia ya ha sido usada por un caso
				$this->objGateway->setData($rcData);
				$this->objGateway->getEquivalenciacaso();
				$rcTmp = $this->objGateway->getResult();

				if(is_array($rcTmp) && $rcTmp){
					$rcResult["message"] = 74;
					$rcResult["result"] = false;
				}else{
					$this->objGateway->setData($rcData);
					$this->objGateway->deleteEquivalencias();
					$sbResult = $this->objGateway->getConsult();
					if($sbResult){
						$rcResult["message"] = 3;
						$rcResult["result"] = true;
						$this->UnsetRequest();
					}else{
						$rcResult["message"] = 100;
						$rcResult["result"] = false;
					}
				}
			}else{
				$rcResult["message"] = 2;
				$rcResult["result"] = false;
			}
		}else{
			$rcResult["message"] = 100;
			$rcResult["result"] = false;
		}
		$this->rcResult = $rcResult;
	}
	function getByIdEquivalencias(){

		settype($rcResult,"array");

		extract($this->rcData);

		if(isset($equicodigon) && $equicodigon){
			$this->objGateway->setData(array("equicodigon"=>$equicodigon));
			$this->objGateway->getEquivalencias();
			$rcResult = $this->objGateway->getResult();
		}
		$this->rcResult = $rcResult;

	}
	function getAllEquivalencias()
	{
		//$this->objGateway->
	}
	function getByEquivalencias_fkey($equivalcros)
	{
		//$this->objGateway->
	}
	function UnsetRequest()
	{
		unset($_REQUEST["equivalencias__equicodigon"]);
		unset($_REQUEST["equivalencias__equitablcros"]);
		unset($_REQUEST["equivalencias__equicampcros"]);
		unset($_REQUEST["equivalencias__equivalcros"]);
		unset($_REQUEST["equivalencias__equinomcros"]);
		unset($_REQUEST["equivalencias__equiareacros"]);
		unset($_REQUEST["equivalencias__equitabldocs"]);
		unset($_REQUEST["equivalencias__equicampdocs"]);
		unset($_REQUEST["equivalencias__equivaldocs"]);
		unset($_REQUEST["equivalencias__equinomdocs"]);
		unset($_REQUEST["equivalencias__equiareadocs"]);
		unset($_REQUEST["equiareacros_desc"]);
		unset($_REQUEST["equivalencias__equiseridocs"]);
		unset($_REQUEST["equivalencias__equiestados"]);
	}
}
?>
