<?php 
class FeHrTipoorganiManager {
	var $gateway;
	function FeHrTipoorganiManager() {
		$this->gateway = Application :: getDataGateway("tipoorgani");
	}
	function addTipoorgani($tiorcodigos, $tiornombres, $tiordesc, $tiorcodpadrs, $tioractivos) {
		if ($this->gateway->existTipoorgani($tiorcodigos) == 0) {
			$this->gateway->addTipoorgani($tiorcodigos, $tiornombres, $tiordesc, $tiorcodpadrs, $tioractivos);
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}
	function updateTipoorgani($tiorcodigos, $tiornombres, $tiordesc, $tiorcodpadrs, $tioractivos) {
		if ($this->gateway->existTipoorgani($tiorcodigos) == 1) {
			$this->gateway->updateTipoorgani($tiorcodigos, $tiornombres, $tiordesc, $tiorcodpadrs, $tioractivos);
			if($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function deleteTipoorgani($tiorcodigos) {
		if ($this->gateway->existTipoorgani($tiorcodigos) == 1) {
			$this->gateway->deleteTipoorgani($tiorcodigos);
			if($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function getByIdTipoorgani($tiorcodigos) {
		$data_tipoorgani = $this->gateway->getByIdTipoorgani($tiorcodigos);
		return $data_tipoorgani;
	}
	function getAllTipoorgani() {
		//$this->gateway->
	}
	function UnsetRequest() {
		unset ($_REQUEST["tipoorgani__tiorcodigos"]);
		unset ($_REQUEST["tipoorgani__tiornombres"]);
		unset ($_REQUEST["tipoorgani__tiordesc"]);
		unset ($_REQUEST["tipoorgani__tiorcodpadrs"]);
		unset ($_REQUEST["tipoorgani__tioractivos"]);
	}
}
?>	
