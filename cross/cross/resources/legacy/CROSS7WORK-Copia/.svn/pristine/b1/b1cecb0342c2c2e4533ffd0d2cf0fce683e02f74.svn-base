<?php 
class FeStUnidadmedidaManager {
	var $gateway;
	function FeStUnidadmedidaManager() {
		$this->gateway = Application :: getDataGateway("unidadmedida");
	}
	function addUnidadmedida($unmecodigos, $unmenombres, $unmesiglas, $unmedescrips) {
		if ($this->gateway->existUnidadmedida($unmecodigos) == 0) {
			$this->gateway->addUnidadmedida($unmecodigos, $unmenombres, $unmesiglas, $unmedescrips);
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}
	function updateUnidadmedida($unmecodigos, $unmenombres, $unmesiglas, $unmedescrips, $unidadmedida__unmeactivas) {
		if ($this->gateway->existUnidadmedida($unmecodigos) == 1) {
			$this->gateway->updateUnidadmedida($unmecodigos, $unmenombres, $unmesiglas, $unmedescrips, $unidadmedida__unmeactivas);
			if($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function deleteUnidadmedida($unmecodigos) {
		if ($this->gateway->existUnidadmedida($unmecodigos) == 1) {
			$this->gateway->deleteUnidadmedida($unmecodigos);
			if($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function getByIdUnidadmedida($unmecodigos) {
		$data_unidadmedida = $this->gateway->getByIdUnidadmedida($unmecodigos);
		return $data_unidadmedida;
	}
	function getAllUnidadmedida() {
		//$this->gateway->
	}
	function UnsetRequest() {
		unset ($_REQUEST["unidadmedida__unmecodigos"]);
		unset ($_REQUEST["unidadmedida__unmenombres"]);
		unset ($_REQUEST["unidadmedida__unmesiglas"]);
		unset ($_REQUEST["unidadmedida__unmedescrips"]);
		unset ($_REQUEST["unidadmedida__unmeactivas"]);
	}
}
?>	
