<?php
class FeWFActivitareaManager {
	var $gateway;
	function FeWFActivitareaManager() {
		$this->gateway = Application :: getDataGateway("activitarea");
	}
	function addActivitarea($tarecodigos, $acticodigos, $actavalorn, $actaobligats, $actaordenn, $actaporcetan, $actaactivas) {
		if ($this->gateway->existActivitarea($tarecodigos, $acticodigos) == 0) {
			$this->gateway->addActivitarea($tarecodigos, $acticodigos, $actavalorn, $actaobligats, $actaordenn, $actaporcetan, $actaactivas);
			if($this->gateway->consult == false){
				return 100;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}
	function updateActivitarea($tarecodigos, $acticodigos, $actavalorn, $actaobligats, $actaordenn, $actaporcetan, $actaactivas) {
		if ($this->gateway->existActivitarea($tarecodigos, $acticodigos) == 1) {
			$this->gateway->updateActivitarea($tarecodigos, $acticodigos, $actavalorn, $actaobligats, $actaordenn, $actaporcetan, $actaactivas);
			if($this->gateway->consult == false){
				return 2;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function deleteActivitarea($tarecodigos, $acticodigos) {
		if ($this->gateway->existActivitarea($tarecodigos, $acticodigos) == 1) {
			$this->gateway->deleteActivitarea($tarecodigos, $acticodigos);
			if($this->gateway->consult == false){
				return 2;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function getByIdActivitarea($tarecodigos, $acticodigos) {
		$data_activitarea = $this->gateway->getByIdActivitarea($tarecodigos, $acticodigos);
		return $data_activitarea;
	}
	function getAllActivitarea() {
		//$this->gateway->
	}
	function getByActivitarea_fkey($tarecodigos) {
		//$this->gateway->
	}
	function getByActivitarea_fkey1($acticodigos) {
		//$this->gateway->
	}
	function UnsetRequest() {
		unset ($_REQUEST["activitarea__tarecodigos"]);
		unset ($_REQUEST["activitarea__acticodigos"]);
		unset ($_REQUEST["activitarea__actavalorn"]);
		unset ($_REQUEST["activitarea__actaobligats"]);
		unset ($_REQUEST["activitarea__actaordenn"]);
		unset ($_REQUEST["activitarea__actaporcetan"]);
		unset ($_REQUEST["activitarea__actaactivas"]);
	}
}
?>	
