<?php 
class FeCrPrioridadManager {
	var $gateway;
	function FeCrPrioridadManager() {
		$this->gateway = Application :: getDataGateway("prioridad");
	}
	function addPrioridad($priocodigos, $prionombres, $priodescrips, $prioactivas) {
		if ($this->gateway->existPrioridad($priocodigos) == 0) {
			$this->gateway->addPrioridad($priocodigos, $prionombres, $priodescrips, $prioactivas);
			if($this->gateway->consult == false){
				return 100;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}
	function updatePrioridad($priocodigos, $prionombres, $priodescrips, $prioactivas) {
		if ($this->gateway->existPrioridad($priocodigos) == 1) {
			$this->gateway->updatePrioridad($priocodigos, $prionombres, $priodescrips, $prioactivas);
			if($this->gateway->consult == false){
				return 2;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function deletePrioridad($priocodigos) {
		if ($this->gateway->existPrioridad($priocodigos) == 1) {
            //Valida si es usado el los req
            $gateway = Application::getDataGateway('SqlExtended');
            $rcReq = $gateway->getReqByPrioridad($priocodigos);
            if(is_array($rcReq))
                return 50;
			$this->gateway->deletePrioridad($priocodigos);
			if($this->gateway->consult == false){
				return 2;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function getByIdPrioridad($priocodigos) {
		$data_prioridad = $this->gateway->getByIdPrioridad($priocodigos);
		return $data_prioridad;
	}
	function getAllPrioridad() {
		//$this->gateway->
	}
	function UnsetRequest() {
		unset ($_REQUEST["prioridad__priocodigos"]);
		unset ($_REQUEST["prioridad__prionombres"]);
		unset ($_REQUEST["prioridad__priodescrips"]);
		unset ($_REQUEST["prioridad__prioactivas"]);
	}
}
?>