<?php 
class FeCuTipoclienteManager {
	var $gateway;
	function FeCuTipoclienteManager() {
		$this->gateway = Application :: getDataGateway("tipocliente");
	}
	function addTipocliente($ticlcodigos, $ticlnombres, $ticldescrips, $ticlactivos) {
		if ($this->gateway->existTipocliente($ticlcodigos) == 0) {
			$this->gateway->addTipocliente($ticlcodigos, $ticlnombres, $ticldescrips, $ticlactivos);
			if($this->gateway->consult == false)
				return 100;
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}
	function updateTipocliente($ticlcodigos, $ticlnombres, $ticldescrips, $ticlactivos) {
		if ($this->gateway->existTipocliente($ticlcodigos) == 1) {
			$this->gateway->updateTipocliente($ticlcodigos, $ticlnombres, $ticldescrips, $ticlactivos);
			if($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function deleteTipocliente($ticlcodigos) {
		if ($this->gateway->existTipocliente($ticlcodigos) == 1) {
			$this->gateway->deleteTipocliente($ticlcodigos);
			if($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function getByIdTipocliente($ticlcodigos) {
		$data_tipocliente = $this->gateway->getByIdTipocliente($ticlcodigos);
		return $data_tipocliente;
	}
	function getAllTipocliente() {
		//$this->gateway->
	}
	function UnsetRequest() {
		unset ($_REQUEST["tipocliente__ticlcodigos"]);
		unset ($_REQUEST["tipocliente__ticlnombres"]);
		unset ($_REQUEST["tipocliente__ticldescrips"]);
		unset ($_REQUEST["tipocliente__ticlactivos"]);
	}
}
?>	
