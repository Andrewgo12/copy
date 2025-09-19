<?php 
class FeStTipodocumentManager {
	var $gateway;
	function FeStTipodocumentManager() {
		$this->gateway = Application :: getDataGateway("tipodocument");
	}
	function addTipodocument($tidocodigos, $tidonombres, $tidodescrips) {
		if ($this->gateway->existTipodocument($tidocodigos) == 0) {
			$this->gateway->addTipodocument($tidocodigos, $tidonombres, $tidodescrips);
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}
	function updateTipodocument($tidocodigos, $tidonombres, $tidodescrips, $tidoactivas) {
		if ($this->gateway->existTipodocument($tidocodigos) == 1) {
			$this->gateway->updateTipodocument($tidocodigos, $tidonombres, $tidodescrips, $tidoactivas);
			if($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function deleteTipodocument($tidocodigos) {
		if ($this->gateway->existTipodocument($tidocodigos) == 1) {
			$this->gateway->deleteTipodocument($tidocodigos);
			if($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function getByIdTipodocument($tidocodigos) {
		$data_tipodocument = $this->gateway->getByIdTipodocument($tidocodigos);
		return $data_tipodocument;
	}
	function getAllTipodocument() {
		//$this->gateway->
	}
	function UnsetRequest() {
		unset ($_REQUEST["tipodocument__tidocodigos"]);
		unset ($_REQUEST["tipodocument__tidonombres"]);
		unset ($_REQUEST["tipodocument__tidodescrips"]);
		unset ($_REQUEST["tipodocument__tidoactivas"]);
	}
}
?>	
