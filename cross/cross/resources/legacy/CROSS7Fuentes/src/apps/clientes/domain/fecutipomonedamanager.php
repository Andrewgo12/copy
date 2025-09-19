<?php 
class FeCuTipomonedaManager {
	var $gateway;
	function FeCuTipomonedaManager() {
		$this->gateway = Application :: getDataGateway("tipomoneda");
	}
	function addTipomoneda($timocodigos, $timonombres, $timoequivaln, $timodescrips, $timoactivas) {
		if ($this->gateway->existTipomoneda($timocodigos) == 0) {
			$this->gateway->addTipomoneda($timocodigos, $timonombres, $timoequivaln, $timodescrips, $timoactivas);
			if($this->gateway->consult == false)
				return 100;
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}
	function updateTipomoneda($timocodigos, $timonombres, $timoequivaln, $timodescrips, $timoactivas) {
		if ($this->gateway->existTipomoneda($timocodigos) == 1) {
			$this->gateway->updateTipomoneda($timocodigos, $timonombres, $timoequivaln, $timodescrips, $timoactivas);
			if($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function deleteTipomoneda($timocodigos) {
		if ($this->gateway->existTipomoneda($timocodigos) == 1) {
			$this->gateway->deleteTipomoneda($timocodigos);
			if($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function getByIdTipomoneda($timocodigos) {
		$data_tipomoneda = $this->gateway->getByIdTipomoneda($timocodigos);
		return $data_tipomoneda;
	}
	function getAllTipomoneda() {
		//$this->gateway->
	}
	function getByTipomoneda_fkey($locacodigos) {
		//$this->gateway->
	}
	function UnsetRequest() {
		unset ($_REQUEST["tipomoneda__timocodigos"]);
		unset ($_REQUEST["tipomoneda__timonombres"]);
		unset ($_REQUEST["tipomoneda__timoequivaln"]);
		unset ($_REQUEST["tipomoneda__timodescrips"]);
		unset ($_REQUEST["tipomoneda__timoactivas"]);
	}
}
?>	
