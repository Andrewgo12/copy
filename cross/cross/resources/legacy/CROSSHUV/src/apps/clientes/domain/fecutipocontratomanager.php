<?php 
class FeCuTipocontratoManager {
	var $gateway;
	function FeCuTipocontratoManager() {
		$this->gateway = Application :: getDataGateway("tipocontrato");
	}
	function addTipocontrato($ticocodigos, $ticonombres, $ticodescrips, $ticoactivos) {
		if ($this->gateway->existTipocontrato($ticocodigos) == 0) {
			$this->gateway->addTipocontrato($ticocodigos, $ticonombres, $ticodescrips, $ticoactivos);
			if($this->gateway->consult == false)
				return 100;
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}
	function updateTipocontrato($ticocodigos, $ticonombres, $ticodescrips, $ticoactivos) {
		if ($this->gateway->existTipocontrato($ticocodigos) == 1) {
			$this->gateway->updateTipocontrato($ticocodigos, $ticonombres, $ticodescrips, $ticoactivos);
			if($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function deleteTipocontrato($ticocodigos) {
		if ($this->gateway->existTipocontrato($ticocodigos) == 1) {
			$this->gateway->deleteTipocontrato($ticocodigos);
			if($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function getByIdTipocontrato($ticocodigos) {
		$data_tipocontrato = $this->gateway->getByIdTipocontrato($ticocodigos);
		return $data_tipocontrato;
	}
	function getAllTipocontrato() {
		//$this->gateway->
	}
	function UnsetRequest() {
		unset ($_REQUEST["tipocontrato__ticocodigos"]);
		unset ($_REQUEST["tipocontrato__ticonombres"]);
		unset ($_REQUEST["tipocontrato__ticodescrips"]);
		unset ($_REQUEST["tipocontrato__ticoactivos"]);
	}
}
?>	
