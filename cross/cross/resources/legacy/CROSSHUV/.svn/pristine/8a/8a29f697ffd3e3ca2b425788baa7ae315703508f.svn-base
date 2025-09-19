<?php 
class FeWFTareaManager {
	var $gateway;
	function FeWFTareaManager() {
		$this->gateway = Application :: getDataGateway("tarea");
	}
	function addTarea($tarecodigos, $tarenombres, $orgacodigos, $taredescris, $tareactivas) {
		if ($this->gateway->existTarea($tarecodigos) == 0) {
			$this->gateway->addTarea($tarecodigos, $tarenombres, $orgacodigos, $taredescris, $tareactivas);
			if($this->gateway->consult == false){
				return 100;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}
	function updateTarea($tarecodigos, $tarenombres, $orgacodigos, $taredescris, $tareactivas) {
		if ($this->gateway->existTarea($tarecodigos) == 1) {
			$this->gateway->updateTarea($tarecodigos, $tarenombres, $orgacodigos, $taredescris, $tareactivas);
			if($this->gateway->consult == false){
				return 2;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function deleteTarea($tarecodigos) {
		if ($this->gateway->existTarea($tarecodigos) == 1) {
			$this->gateway->deleteTarea($tarecodigos);
			if($this->gateway->consult == false){
				return 2;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function getByIdTarea($tarecodigos) {
		$data_tarea = $this->gateway->getByIdTarea($tarecodigos);
		return $data_tarea;
	}
	function getAllTarea() {
		//$this->gateway->
	}
	function getByTarea_fkey($orgacodigos) {
		//$this->gateway->
	}
	function UnsetRequest() {
		unset ($_REQUEST["tarea__tarecodigos"]);
		unset ($_REQUEST["tarea__tarenombres"]);
		unset ($_REQUEST["tarea__orgacodigos"]);
		unset ($_REQUEST["tarea__taredescris"]);
		unset ($_REQUEST["tarea__tareactivas"]);
	}
}
?>	
