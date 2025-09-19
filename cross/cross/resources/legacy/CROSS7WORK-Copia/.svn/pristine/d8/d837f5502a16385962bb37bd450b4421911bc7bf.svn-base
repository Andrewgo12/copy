<?php 
class FeCuCondiusuarioManager {
	var $gateway;
	function FeCuCondiusuarioManager() {
		$this->gateway = Application :: getDataGateway("condiusuario");
	}
	function addCondiusuario($couscodigos, $cousnombres, $cousdescrips, $cousactivos) {
		if ($this->gateway->existCondiusuario($couscodigos) == 0) {
			$this->gateway->addCondiusuario($couscodigos, $cousnombres, $cousdescrips, $cousactivos);
			if($this->gateway->consult == false){
				return 100;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}
	function updateCondiusuario($couscodigos, $cousnombres, $cousdescrips, $cousactivos) {
		if ($this->gateway->existCondiusuario($couscodigos) == 1) {
			$this->gateway->updateCondiusuario($couscodigos, $cousnombres, $cousdescrips, $cousactivos);
			if($this->gateway->consult == false){
				return 2;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function deleteCondiusuario($couscodigos) {
		if ($this->gateway->existCondiusuario($couscodigos) == 1) {
			$this->gateway->deleteCondiusuario($couscodigos);
			if($this->gateway->consult == false){
				return 2;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function getByIdCondiusuario($couscodigos) {
		$data_condiusuario = $this->gateway->getByIdCondiusuario($couscodigos);
		return $data_condiusuario;
	}
	function getAllCondiusuario() {
		//$this->gateway->
	}
	function UnsetRequest() {
		unset ($_REQUEST["condiusuario__couscodigos"]);
		unset ($_REQUEST["condiusuario__cousnombres"]);
		unset ($_REQUEST["condiusuario__cousdescrips"]);
		unset ($_REQUEST["condiusuario__cousactivos"]);
	}
}
?>