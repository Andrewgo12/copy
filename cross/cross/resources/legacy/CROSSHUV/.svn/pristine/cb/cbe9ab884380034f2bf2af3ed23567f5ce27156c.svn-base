<?php 
class FeCrConfigformatManager {
	var $gateway;

	function FeCrConfigformatManager() {
		$this->gateway = Application :: getDataGateway("configformat");
	}

	function addConfigformat($cofocodigon, $cofonombres, $focacodigos) {
		if ($this->gateway->existConfigformat($cofocodigon) == 0) {
			$this->gateway->addConfigformat($cofocodigon, $cofonombres, $focacodigos);
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}

	function updateConfigformat($cofocodigon, $cofonombres, $focacodigos) {
		if ($this->gateway->existConfigformat($cofocodigon) == 1) {
			$this->gateway->updateConfigformat($cofocodigon, $cofonombres, $focacodigos);
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}

	function deleteConfigformat($cofocodigon) {
		if ($this->gateway->existConfigformat($cofocodigon) == 1) {
			$this->gateway->deleteConfigformat($cofocodigon);
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}

	function getByIdConfigformat($cofocodigon) {
		$data_configformat = $this->gateway->getByIdConfigformat($cofocodigon);
		return $data_configformat;
	}

	function getAllConfigformat() {
		//$this->gateway->
	}

	function UnsetRequest() {
		unset ($_REQUEST["configformat__cofocodigon"]);
		unset ($_REQUEST["configformat__cofonombres"]);
		unset ($_REQUEST["configformat__focacodigos"]);
	}

}
?>