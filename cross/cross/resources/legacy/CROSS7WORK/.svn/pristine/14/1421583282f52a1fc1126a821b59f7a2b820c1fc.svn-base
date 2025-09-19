<?php 
class FeCuSegurisocialManager {
	var $gateway;
	function FeCuSegurisocialManager() {
		$this->gateway = Application :: getDataGateway("segurisocial");
	}
	function addSegurisocial($sesocodigos, $sesonombres, $sesodescrips, $sesoactivos) {
		if ($this->gateway->existSegurisocial($sesocodigos) == 0) {
			$this->gateway->addSegurisocial($sesocodigos, $sesonombres, $sesodescrips, $sesoactivos);
			if($this->gateway->consult == false){
				return 100;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}
	function updateSegurisocial($sesocodigos, $sesonombres, $sesodescrips, $sesoactivos) {
		if ($this->gateway->existSegurisocial($sesocodigos) == 1) {
			$this->gateway->updateSegurisocial($sesocodigos, $sesonombres, $sesodescrips, $sesoactivos);
			if($this->gateway->consult == false){
				return 2;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function deleteSegurisocial($sesocodigos) {
		if ($this->gateway->existSegurisocial($sesocodigos) == 1) {
			$this->gateway->deleteSegurisocial($sesocodigos);
			if($this->gateway->consult == false){
				return 2;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function getByIdSegurisocial($sesocodigos) {
		$data_segurisocial = $this->gateway->getByIdSegurisocial($sesocodigos);
		return $data_segurisocial;
	}
	function getAllSegurisocial() {
		//$this->gateway->
	}
	function UnsetRequest() {
		unset ($_REQUEST["segurisocial__sesocodigos"]);
		unset ($_REQUEST["segurisocial__sesonombres"]);
		unset ($_REQUEST["segurisocial__sesodescrips"]);
		unset ($_REQUEST["segurisocial__sesoactivos"]);
	}
}
?>