<?php 
class FeWFEstadoprocesManager {
	var $gateway;

	function FeWFEstadoprocesManager() {
		$this->gateway = Application :: getDataGateway("estadoproces");
	}

	function addEstadoproces($esprcodigos, $esprnombres, $esprdescrips, $espractivas) {
		if ($this->gateway->existEstadoproces($esprcodigos) == 0) {
			$this->gateway->addEstadoproces($esprcodigos, $esprnombres, $esprdescrips, $espractivas);
			if ($this->gateway->consult == false)
				return 100;
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}

	function updateEstadoproces($esprcodigos, $esprnombres, $esprdescrips, $espractivas) {
		if ($this->gateway->existEstadoproces($esprcodigos) == 1) {
			$this->gateway->updateEstadoproces($esprcodigos, $esprnombres, $esprdescrips, $espractivas);
			if ($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}

	function deleteEstadoproces($esprcodigos) {
		if ($this->gateway->existEstadoproces($esprcodigos) == 1) {
			$this->gateway->deleteEstadoproces($esprcodigos);
			if ($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}

	function getByIdEstadoproces($esprcodigos) {
		$data_estadoproces = $this->gateway->getByIdEstadoproces($esprcodigos);
		return $data_estadoproces;
	}

	function getAllEstadoproces() {
		//$this->gateway->
	}

	function UnsetRequest() {
		unset ($_REQUEST["estadoproces__esprcodigos"]);
		unset ($_REQUEST["estadoproces__esprnombres"]);
		unset ($_REQUEST["estadoproces__esprdescrips"]);
		unset ($_REQUEST["estadoproces__espractivas"]);
	}
}
?>