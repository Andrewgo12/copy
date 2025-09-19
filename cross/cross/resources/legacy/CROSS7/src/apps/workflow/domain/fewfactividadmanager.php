<?php 
class FeWFActividadManager {
	var $gateway;
	function FeWFActividadManager() {
		$this->gateway = Application :: getDataGateway("actividad");
	}
	function addActividad($acticodigos, $actinombres, $activalorn, $actiobservas, $actiactivas) {
		if ($this->gateway->existActividad($acticodigos) == 0) {
			$this->gateway->addActividad($acticodigos, $actinombres, $activalorn, $actiobservas, $actiactivas);
			if($this->gateway->consult == false){
				return 100;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}
	function updateActividad($acticodigos, $actinombres, $activalorn, $actiobservas, $actiactivas) {
		if ($this->gateway->existActividad($acticodigos) == 1) {
			$this->gateway->updateActividad($acticodigos, $actinombres, $activalorn, $actiobservas, $actiactivas);
			if($this->gateway->consult == false){
				return 2;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function deleteActividad($acticodigos) {
		if ($this->gateway->existActividad($acticodigos) == 1) {
			$this->gateway->deleteActividad($acticodigos);
			if($this->gateway->consult == false){
				return 2;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function getByIdActividad($acticodigos) {
		$data_actividad = $this->gateway->getByIdActividad($acticodigos);
		return $data_actividad;
	}
	function getAllActividad() {
		//$this->gateway->
	}
	function UnsetRequest() {
		unset ($_REQUEST["actividad__acticodigos"]);
		unset ($_REQUEST["actividad__actinombres"]);
		unset ($_REQUEST["actividad__activalorn"]);
		unset ($_REQUEST["actividad__actiobservas"]);
		unset ($_REQUEST["actividad__actiactivas"]);
	}
}
?>	
