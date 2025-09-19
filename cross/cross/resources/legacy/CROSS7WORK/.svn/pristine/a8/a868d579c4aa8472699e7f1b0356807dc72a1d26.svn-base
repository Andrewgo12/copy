<?php 
class FeCuGruposinteresManager {
	var $gateway;
	function FeCuGruposinteresManager() {
		$this->gateway = Application :: getDataGateway("gruposinteres");
	}
	function addGruposinteres($grincodigos, $grinnombres, $grindescrips, $grinactivos) {
		if ($this->gateway->existGruposinteres($grincodigos) == 0) {
			$this->gateway->addGruposinteres($grincodigos, $grinnombres, $grindescrips, $grinactivos);
			if($this->gateway->consult == false)
				return 100;
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}
	function updateGruposinteres($grincodigos, $grinnombres, $grindescrips, $grinactivos) {
		if ($this->gateway->existGruposinteres($grincodigos) == 1) {
			$this->gateway->updateGruposinteres($grincodigos, $grinnombres, $grindescrips, $grinactivos);
			if($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function deleteGruposinteres($grincodigos) {
		if ($this->gateway->existGruposinteres($grincodigos) == 1) {
			$this->gateway->deleteGruposinteres($grincodigos);
			if($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function getByIdGruposinteres($grincodigos) {
		$data_gruposinteres = $this->gateway->getByIdGruposinteres($grincodigos);
		return $data_gruposinteres;
	}
	function getAllGruposinteres() {
		//$this->gateway->
	}
	function UnsetRequest() {
		unset ($_REQUEST["gruposinteres__grincodigos"]);
		unset ($_REQUEST["gruposinteres__grinnombres"]);
		unset ($_REQUEST["gruposinteres__grindescrips"]);
		unset ($_REQUEST["gruposinteres__grinactivos"]);
	}
}
?>	
