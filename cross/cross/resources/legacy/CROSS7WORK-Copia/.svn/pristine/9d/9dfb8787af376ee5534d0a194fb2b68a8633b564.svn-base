<?php
class FeGeFormatocartaManager {
	var $gateway;

	function FeGeFormatocartaManager() {
		$this->gateway = Application :: getDataGateway("formatocarta");
	}

	function addFormatocarta($focacodigos, $focanombres, $focaplantils, $focaestados) {
		if ($this->gateway->existFormatocarta($focacodigos) == 0) {
			$this->gateway->addFormatocarta($focacodigos, $focanombres, $focaplantils, $focaestados);
			if($this->gateway->consult == false){
				return 100;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}

	function updateFormatocarta($focacodigos, $focanombres, $focaplantils, $focaestados) {
		if ($this->gateway->existFormatocarta($focacodigos) == 1) {
			$this->gateway->updateFormatocarta($focacodigos, $focanombres, $focaplantils, $focaestados);
			if($this->gateway->consult == false){
				return 2;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}

	function deleteFormatocarta($focacodigos) {
		if ($this->gateway->existFormatocarta($focacodigos) == 1) {
			$this->gateway->deleteFormatocarta($focacodigos);
			if($this->gateway->consult == false){
				return 2;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}

	function getByIdFormatocarta($focacodigos) {
		$data_formatocarta = $this->gateway->getByIdFormatocarta($focacodigos);
		return $data_formatocarta;
	}

	function getAllFormatocarta() {
		//$this->gateway->
	}

	function UnsetRequest() {
		unset ($_REQUEST["formatocarta__focacodigos"]);
		unset ($_REQUEST["formatocarta__focanombres"]);
		unset ($_REQUEST["formatocarta__focaplantils"]);
		unset ($_REQUEST["formatocarta__focaestados"]);
		unset ($_REQUEST["formatocartaf__tags"]);
	}
}
?>