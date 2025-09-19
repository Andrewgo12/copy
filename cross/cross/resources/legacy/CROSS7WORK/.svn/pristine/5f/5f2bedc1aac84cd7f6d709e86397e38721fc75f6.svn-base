<?php 
class FeHrEstadoorganiManager {
	var $gateway;
	function FeHrEstadoorganiManager() {
		$this->gateway = Application :: getDataGateway("estadoorgani");
	}
	function addEstadoorgani($esorcodigos, $esornombres, $esordescrips, $esoractivas) {
		if ($this->gateway->existEstadoorgani($esorcodigos) == 0) {
			$this->gateway->addEstadoorgani($esorcodigos, $esornombres, $esordescrips, $esoractivas);
			if($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}
	function updateEstadoorgani($esorcodigos, $esornombres, $esordescrips, $esoractivas) {
		if ($this->gateway->existEstadoorgani($esorcodigos) == 1) {
			$this->gateway->updateEstadoorgani($esorcodigos, $esornombres, $esordescrips, $esoractivas);
			if($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function deleteEstadoorgani($esorcodigos) {
		if ($this->gateway->existEstadoorgani($esorcodigos) == 1) {
			$this->gateway->deleteEstadoorgani($esorcodigos);
            if ($this->gateway->consult == false) {
				return 2;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function getByIdEstadoorgani($esorcodigos) {
		$data_estadoorgani = $this->gateway->getByIdEstadoorgani($esorcodigos);
		return $data_estadoorgani;
	}
	function getAllEstadoorgani() {
		//$this->gateway->
	}
	function UnsetRequest() {
		unset ($_REQUEST["estadoorgani__esorcodigos"]);
		unset ($_REQUEST["estadoorgani__esornombres"]);
		unset ($_REQUEST["estadoorgani__esordescrips"]);
		unset ($_REQUEST["estadoorgani__esoractivas"]);
	}
}
?>	
