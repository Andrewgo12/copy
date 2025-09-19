<?php 
class FeCuTipoidentifiManager {
	var $gateway;
	function FeCuTipoidentifiManager() {
		$this->gateway = Application :: getDataGateway("tipoidentifi");
	}
	function addTipoidentifi($tiidcodigos, $tiidnombres, $tiiddescrips, $tiidactivas) {
		if ($this->gateway->existTipoidentifi($tiidcodigos) == 0) {
			$this->gateway->addTipoidentifi($tiidcodigos, $tiidnombres, $tiiddescrips, $tiidactivas);
			if($this->gateway->consult == false)
				return 100;
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}
	function updateTipoidentifi($tiidcodigos, $tiidnombres, $tiiddescrips, $tiidactivas) {
		if ($this->gateway->existTipoidentifi($tiidcodigos) == 1) {
			$this->gateway->updateTipoidentifi($tiidcodigos, $tiidnombres, $tiiddescrips, $tiidactivas);
			if($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function deleteTipoidentifi($tiidcodigos) {
		if ($this->gateway->existTipoidentifi($tiidcodigos) == 1) {
			$this->gateway->deleteTipoidentifi($tiidcodigos);
			if($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function getByIdTipoidentifi($tiidcodigos) {
		$data_tipoidentifi = $this->gateway->getByIdTipoidentifi($tiidcodigos);
		return $data_tipoidentifi;
	}
	function getAllTipoidentifi() {
		//$this->gateway->
	}
	function UnsetRequest() {
		unset ($_REQUEST["tipoidentifi__tiidcodigos"]);
		unset ($_REQUEST["tipoidentifi__tiidnombres"]);
		unset ($_REQUEST["tipoidentifi__tiiddescrips"]);
		unset ($_REQUEST["tipoidentifi__tiidactivas"]);
	}
}
?>	
