<?php  
class FeWFActaestordenManager {
	var $gateway;
	function FeWFActaestordenManager() {
		$this->gateway = Application :: getDataGateway("actaestorden");
	}
	function addActaestorden($acescodigos, $actacodigos, $acesestrecis, $acesestentrs, $acesfechmovs) {
		if ($this->gateway->existActaestorden($acescodigos) == 0) {
			$this->gateway->addActaestorden($acescodigos, $actacodigos, $acesestrecis, $acesestentrs, $acesfechmovs);
			if($this->gateway->consult == false){
				return 100;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}
	function updateActaestorden($acescodigos, $actacodigos, $acesestrecis, $acesestentrs, $acesfechmovs) {
		if ($this->gateway->existActaestorden($acescodigos) == 1) {
			$this->gateway->updateActaestorden($acescodigos, $actacodigos, $acesestrecis, $acesestentrs, $acesfechmovs);
			if($this->gateway->consult == false){
				return 2;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function deleteActaestorden($acescodigos) {
		if ($this->gateway->existActaestorden($acescodigos) == 1) {
			$this->gateway->deleteActaestorden($acescodigos);
			if($this->gateway->consult == false){
				return 2;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function getByIdActaestorden($acescodigos) {
		$data_actaestorden = $this->gateway->getByIdActaestorden($acescodigos);
		return $data_actaestorden;
	}
	function getAllActaestorden() {
		//$this->gateway->
	}
	function getByActaestorden_fkey($actacodigos) {
		//$this->gateway->
	}
	function UnsetRequest() {
		unset ($_REQUEST["actaestorden__acescodigos"]);
		unset ($_REQUEST["actaestorden__actacodigos"]);
		unset ($_REQUEST["actaestorden__acesestrecis"]);
		unset ($_REQUEST["actaestorden__acesestentrs"]);
		unset ($_REQUEST["actaestorden__acesfechmovs"]);
	}
}
?>	
