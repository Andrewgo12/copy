<?php 
class FeCuTipoexamenManager {
	var $gateway;
	function FeCuTipoexamenManager() {
		$this->gateway = Application :: getDataGateway("tipoexamen");
	}
	function addTipoexamen($tiexcodigos, $tiexnombres, $tiexdescrips, $tiexactivos) {
		if ($this->gateway->existTipoexamen($tiexcodigos) == 0) {
			$this->gateway->addTipoexamen($tiexcodigos, $tiexnombres, $tiexdescrips, $tiexactivos);
			if($this->gateway->consult == false){
				return 100;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}
	function updateTipoexamen($tiexcodigos, $tiexnombres, $tiexdescrips, $tiexactivos) {
		if ($this->gateway->existTipoexamen($tiexcodigos) == 1) {
			$this->gateway->updateTipoexamen($tiexcodigos, $tiexnombres, $tiexdescrips, $tiexactivos);
			if($this->gateway->consult == false){
				return 2;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function deleteTipoexamen($tiexcodigos) {
		if ($this->gateway->existTipoexamen($tiexcodigos) == 1) {
			$this->gateway->deleteTipoexamen($tiexcodigos);
			if($this->gateway->consult == false){
				return 2;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function getByIdTipoexamen($tiexcodigos) {
		$data_tipoexamen = $this->gateway->getByIdTipoexamen($tiexcodigos);
		return $data_tipoexamen;
	}
	function getAllTipoexamen() {
		//$this->gateway->
	}
	function UnsetRequest() {
		unset ($_REQUEST["tipoexamen__tiexcodigos"]);
		unset ($_REQUEST["tipoexamen__tiexnombres"]);
		unset ($_REQUEST["tipoexamen__tiexdescrips"]);
		unset ($_REQUEST["tipoexamen__tiexactivos"]);
	}
}
?>