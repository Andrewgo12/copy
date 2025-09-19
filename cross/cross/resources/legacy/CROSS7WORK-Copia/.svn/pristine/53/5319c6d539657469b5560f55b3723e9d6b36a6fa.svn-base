<?php 
class FeGeTipoarchivoManager {
	var $gateway;
	function FeGeTipoarchivoManager() {
		$this->gateway = Application :: getDataGateway("tipoarchivo");
	}
	function addTipoarchivo($tiarcodigos, $tiarnombres, $tiarobservas, $tiarestados) {
		if ($this->gateway->existTipoarchivo($tiarcodigos) == 0) {
			$this->gateway->addTipoarchivo($tiarcodigos, $tiarnombres, $tiarobservas, $tiarestados);
			if($this->gateway->consult == false){
				return 100;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}
	function updateTipoarchivo($tiarcodigos, $tiarnombres, $tiarobservas, $tiarestados) {
		if ($this->gateway->existTipoarchivo($tiarcodigos) == 1) {
			$this->gateway->updateTipoarchivo($tiarcodigos, $tiarnombres, $tiarobservas, $tiarestados);
			if($this->gateway->consult == false){
				return 2;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function deleteTipoarchivo($tiarcodigos) {
		if ($this->gateway->existTipoarchivo($tiarcodigos) == 1) {
			$this->gateway->deleteTipoarchivo($tiarcodigos);
			if($this->gateway->consult == false){
				return 2;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function getByIdTipoarchivo($tiarcodigos) {
		$data_tipoarchivo = $this->gateway->getByIdTipoarchivo($tiarcodigos);
		return $data_tipoarchivo;
	}
	function getAllTipoarchivo() {
		//$this->gateway->
	}
	function UnsetRequest() {
		unset ($_REQUEST["tipoarchivo__tiarcodigos"]);
		unset ($_REQUEST["tipoarchivo__tiarnombres"]);
		unset ($_REQUEST["tipoarchivo__tiarobservas"]);
		unset ($_REQUEST["tipoarchivo__tiarestados"]);
	}
}
?>