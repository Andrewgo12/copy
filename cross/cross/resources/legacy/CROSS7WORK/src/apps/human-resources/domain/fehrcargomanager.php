<?php 
class FeHrCargoManager {
	var $gateway;
	function FeHrCargoManager() {
		$this->gateway = Application :: getDataGateway("cargo");
	}
	function addCargo($cargcodigos, $cargnombres, $cargdescrips, $cargactivas) {
		if ($this->gateway->existCargo($cargcodigos) == 0) {
			$this->gateway->addCargo($cargcodigos, $cargnombres, $cargdescrips, $cargactivas);
			if($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}
	function updateCargo($cargcodigos, $cargnombres, $cargdescrips, $cargactivas) {
		if ($this->gateway->existCargo($cargcodigos) == 1) {
			$this->gateway->updateCargo($cargcodigos, $cargnombres, $cargdescrips, $cargactivas);
			if($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function deleteCargo($cargcodigos) {
		if ($this->gateway->existCargo($cargcodigos) == 1) {
			$this->gateway->deleteCargo($cargcodigos);
			if($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function getByIdCargo($cargcodigos) {
		$data_cargo = $this->gateway->getByIdCargo($cargcodigos);
		return $data_cargo;
	}
	function getAllCargo() {
		//$this->gateway->
	}
	function UnsetRequest() {
		unset ($_REQUEST["cargo__cargcodigos"]);
		unset ($_REQUEST["cargo__cargnombres"]);
		unset ($_REQUEST["cargo__cargdescrips"]);
		unset ($_REQUEST["cargo__cargactivas"]);
	}
}
?>	
