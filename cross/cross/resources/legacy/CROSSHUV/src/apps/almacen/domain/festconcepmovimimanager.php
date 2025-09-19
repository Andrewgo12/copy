<?php 
class FeStConcepmovimiManager {
	var $gateway;
	function FeStConcepmovimiManager() {
		$this->gateway = Application :: getDataGateway("concepmovimi");
	}
	function addConcepmovimi($comocodigos, $comonombres, $comosentidos, $comodescrips) {
		if ($this->gateway->existConcepmovimi($comocodigos) == 0) {
			$this->gateway->addConcepmovimi($comocodigos, $comonombres, $comosentidos, $comodescrips);
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}
	function updateConcepmovimi($comocodigos, $comonombres, $comosentidos, $comodescrips,$comoactivas) {
		if ($this->gateway->existConcepmovimi($comocodigos) == 1) {
			$this->gateway->updateConcepmovimi($comocodigos, $comonombres, $comosentidos, $comodescrips,$comoactivas);
			//Valida si se elimino el registro
			if($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function deleteConcepmovimi($comocodigos) {
		if ($this->gateway->existConcepmovimi($comocodigos) == 1) {
			$this->gateway->deleteConcepmovimi($comocodigos);
			//Valida si se elimino el registro
			if($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function getByIdConcepmovimi($comocodigos) {
		$data_concepmovimi = $this->gateway->getByIdConcepmovimi($comocodigos);
		return $data_concepmovimi;
	}
	function getAllConcepmovimi() {
		//$this->gateway->
	}
	function UnsetRequest() {
		unset ($_REQUEST["concepmovimi__comocodigos"]);
		unset ($_REQUEST["concepmovimi__comonombres"]);
		unset ($_REQUEST["concepmovimi__comosentidos"]);
		unset ($_REQUEST["concepmovimi__comodescrips"]);
		unset ($_REQUEST["concepmovimi__comodactivas"]);
	}
}
?>	
