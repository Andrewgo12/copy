<?php 
class FeCuEstadoclientManager {
	var $gateway;
	function FeCuEstadoclientManager() {
		$this->gateway = Application :: getDataGateway("estadoclient");
	}
	function addEstadoclient($esclcodigos, $esclnombres, $escldescrips, $esclactivos) {
		if ($this->gateway->existEstadoclient($esclcodigos) == 0) {
			$this->gateway->addEstadoclient($esclcodigos, $esclnombres, $escldescrips, $esclactivos);
			if($this->gateway->consult == false)
				return 100;
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}
	function updateEstadoclient($esclcodigos, $esclnombres, $escldescrips, $esclactivos) {
		if ($this->gateway->existEstadoclient($esclcodigos) == 1) {
			$this->gateway->updateEstadoclient($esclcodigos, $esclnombres, $escldescrips, $esclactivos);
			if($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function deleteEstadoclient($esclcodigos) {
		if ($this->gateway->existEstadoclient($esclcodigos) == 1) {
			$this->gateway->deleteEstadoclient($esclcodigos);
			if($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function getByIdEstadoclient($esclcodigos) {
		$data_estadoclient = $this->gateway->getByIdEstadoclient($esclcodigos);
		return $data_estadoclient;
	}
	function getAllEstadoclient() {
		//$this->gateway->
	}
	function UnsetRequest() {
		unset ($_REQUEST["estadoclient__esclcodigos"]);
		unset ($_REQUEST["estadoclient__esclnombres"]);
		unset ($_REQUEST["estadoclient__escldescrips"]);
		unset ($_REQUEST["estadoclient__esclactivos"]);
	}
}
?>	
