<?php 
class FeCrDetaconfformManager {
	var $gateway;

	function FeCrDetaconfformManager() {
		$this->gateway = Application :: getDataGateway("detaconfform");
	}

	function addDetaconfform($cofocodigon, $cacocodigon, $decooperados, $decovalors) {
		if ($this->gateway->existDetaconfform($cofocodigon, $cacocodigon) == 0) {
			$this->gateway->addDetaconfform($cofocodigon, $cacocodigon, $decooperados, $decovalors);
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}

	function updateDetaconfform($cofocodigon, $cacocodigon, $decooperados, $decovalors) {
		if ($this->gateway->existDetaconfform($cofocodigon, $cacocodigon) == 1) {
			$this->gateway->updateDetaconfform($cofocodigon, $cacocodigon, $decooperados, $decovalors);
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}

	function deleteDetaconfform($cofocodigon, $cacocodigon) {
		if ($this->gateway->existDetaconfform($cofocodigon, $cacocodigon) == 1) {
			$this->gateway->deleteDetaconfform($cofocodigon, $cacocodigon);
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}

	function getByIdDetaconfform($cofocodigon, $cacocodigon) {
		$data_detaconfform = $this->gateway->getByIdDetaconfform($cofocodigon, $cacocodigon);
		return $data_detaconfform;
	}

	function getAllDetaconfform() {
		//$this->gateway->
	}

	function getByDetaconfform_fkey($cofocodigon) {
		//$this->gateway->
	}

	function getByDetaconfform_fkey1($cacocodigon) {
		//$this->gateway->
	}

	function UnsetRequest() {
		unset ($_REQUEST["detaconfform__cofocodigon"]);
		unset ($_REQUEST["detaconfform__cacocodigon"]);
		unset ($_REQUEST["detaconfform__decooperados"]);
		unset ($_REQUEST["detaconfform__decovalors"]);
	}

}
?>