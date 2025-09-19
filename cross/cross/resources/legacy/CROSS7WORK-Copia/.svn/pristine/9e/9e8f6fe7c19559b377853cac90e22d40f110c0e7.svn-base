<?php 
class FeCrCampconfformManager {
	var $gateway;

	function FeCrCampconfformManager() {
		$this->gateway = Application :: getDataGateway("campconfform");
	}

	function addCampconfform($cacocodigon, $caconombres, $cacoprocedes) {
		if ($this->gateway->existCampconfform($cacocodigon) == 0) {
			$this->gateway->addCampconfform($cacocodigon, $caconombres, $cacoprocedes);
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}

	function updateCampconfform($cacocodigon, $caconombres, $cacoprocedes) {
		if ($this->gateway->existCampconfform($cacocodigon) == 1) {
			$this->gateway->updateCampconfform($cacocodigon, $caconombres, $cacoprocedes);
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}

	function deleteCampconfform($cacocodigon) {
		if ($this->gateway->existCampconfform($cacocodigon) == 1) {
			$this->gateway->deleteCampconfform($cacocodigon);
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}

	function getByIdCampconfform($cacocodigon) {
		$data_campconfform = $this->gateway->getByIdCampconfform($cacocodigon);
		return $data_campconfform;
	}

	function getAllCampconfform() {
		//$this->gateway->
	}

	function UnsetRequest() {
		unset ($_REQUEST["campconfform__cacocodigon"]);
		unset ($_REQUEST["campconfform__caconombres"]);
		unset ($_REQUEST["campconfform__cacoprocedes"]);
	}

}
?>