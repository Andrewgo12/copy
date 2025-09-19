<?php  
class FeGeConfigforemaManager {
	var $gateway;

	function FeGeConfigforemaManager() {
		$this->gateway = Application :: getDataGateway("configforema");
	}

	function addConfigforema($cofecodigon, $cofenombres, $foemcodigos) {
		if ($this->gateway->existConfigforema($cofecodigon) == 0) {
			$this->gateway->addConfigforema($cofecodigon, $cofenombres, $foemcodigos);
			if ($this->gateway->consult == false) {
				return 100;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}

	function updateConfigforema($cofecodigon, $cofenombres, $foemcodigos) {
		if ($this->gateway->existConfigforema($cofecodigon) == 1) {
			$this->gateway->updateConfigforema($cofecodigon, $cofenombres, $foemcodigos);
			if ($this->gateway->consult == false) {
				return 2;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}

	function deleteConfigforema($cofecodigon) {
		if ($this->gateway->existConfigforema($cofecodigon) == 1) {
			$this->gateway->deleteConfigforema($cofecodigon);
			if ($this->gateway->consult == false) {
				return 2;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}

	function getByIdConfigforema($cofecodigon) {
		$data_configforema = $this->gateway->getByIdConfigforema($cofecodigon);
		return $data_configforema;
	}

	function getAllConfigforema() {
		settype($orcResult,"array");
		$orcResult = $this->gateway->getAllConfigforema();
		return $orcResult;
	}
	
	function getByCofecodigonLj($inucofecodigon){
		settype($objGateway,"object");
		settype($orcResult,"array");
		if($inucofecodigon){
			$objGateway = Application :: getDataGateway("sqlExtended");
			$orcResult = $objGateway->getByCofecodigonLj($inucofecodigon); 
		}
		return $orcResult;
	}

	function UnsetRequest() {
		unset ($_REQUEST["configforema__cofecodigon"]);
		unset ($_REQUEST["configforema__cofenombres"]);
		unset ($_REQUEST["configforema__foemcodigos"]);
	}
}
?>