<?php  
class FeGeConfigformatManager {
	var $gateway;

	function FeGeConfigformatManager() {
		$this->gateway = Application :: getDataGateway("configformat");
	}

	function addConfigformat($cofocodigon, $cofonombres, $focacodigos) {
		if ($this->gateway->existConfigformat($cofocodigon) == 0) {
			$this->gateway->addConfigformat($cofocodigon, $cofonombres, $focacodigos);
			if ($this->gateway->consult == false) {
				return 100;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}

	function updateConfigformat($cofocodigon, $cofonombres, $focacodigos) {
		if ($this->gateway->existConfigformat($cofocodigon) == 1) {
			$this->gateway->updateConfigformat($cofocodigon, $cofonombres, $focacodigos);
			if ($this->gateway->consult == false) {
				return 2;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}

	function deleteConfigformat($cofocodigon) {
		if ($this->gateway->existConfigformat($cofocodigon) == 1) {
			$this->gateway->deleteConfigformat($cofocodigon);
			if ($this->gateway->consult == false) {
				return 2;
			}
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