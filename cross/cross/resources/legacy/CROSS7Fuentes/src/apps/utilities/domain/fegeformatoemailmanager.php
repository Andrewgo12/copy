<?php
class FeGeFormatoemailManager {
	var $gateway;

	function FeGeFormatoemailManager() {
		$this->gateway = Application :: getDataGateway("formatoemail");
	}

	function addFormatoemail($foemcodigos, $foemnombres, $foemasuntos, $foemplantils, $foemestados) {
		if ($this->gateway->existFormatoemail($foemcodigos) == 0) {
			$this->gateway->addFormatoemail($foemcodigos, $foemnombres, $foemasuntos, $foemplantils, $foemestados);
			if($this->gateway->consult == false){
				return 100;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}

	function updateFormatoemail($foemcodigos, $foemnombres, $foemasuntos, $foemplantils, $foemestados) {
		if ($this->gateway->existFormatoemail($foemcodigos) == 1) {
			$this->gateway->updateFormatoemail($foemcodigos, $foemnombres, $foemasuntos, $foemplantils, $foemestados);
			if($this->gateway->consult == false){
				return 2;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}

	function deleteFormatoemail($foemcodigos) {
		if ($this->gateway->existFormatoemail($foemcodigos) == 1) {
			$this->gateway->deleteFormatoemail($foemcodigos);
			if($this->gateway->consult == false){
				return 2;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}

	function getByIdFormatoemail($foemcodigos) {
		$data_formatoemail = $this->gateway->getByIdFormatoemail($foemcodigos);
		return $data_formatoemail;
	}

	function getAllFormatoemail() {
		//$this->gateway->
	}

	function UnsetRequest() {
		unset ($_REQUEST["formatoemail__foemcodigos"]);
		unset ($_REQUEST["formatoemail__foemnombres"]);
		unset ($_REQUEST["formatoemail__foemasuntos"]);
		unset ($_REQUEST["formatoemail__foemplantils"]);
		unset ($_REQUEST["formatoemail__foemestados"]);
		unset ($_REQUEST["formatoemailf__tags_1"]);
		unset ($_REQUEST["formatoemailf__tags_2"]);
	}
}
?>