<?php 
class FeCuFormapagoManager {
	var $gateway;
	function FeCuFormapagoManager() {
		$this->gateway = Application :: getDataGateway("formapago");
	}
	function addFormapago($fopacodigos, $fopanombres, $fopatiempon, $fopacancuotn, $fopadescrips, $fopaactivos) {
		if ($this->gateway->existFormapago($fopacodigos) == 0) {
			$this->gateway->addFormapago($fopacodigos, $fopanombres, $fopatiempon, $fopacancuotn, $fopadescrips, $fopaactivos);
			if($this->gateway->consult == false)
				return 100;
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}
	function updateFormapago($fopacodigos, $fopanombres, $fopatiempon, $fopacancuotn, $fopadescrips, $fopaactivos) {
		if ($this->gateway->existFormapago($fopacodigos) == 1) {
			$this->gateway->updateFormapago($fopacodigos, $fopanombres, $fopatiempon, $fopacancuotn, $fopadescrips, $fopaactivos);
			if($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function deleteFormapago($fopacodigos) {
		if ($this->gateway->existFormapago($fopacodigos) == 1) {
			$this->gateway->deleteFormapago($fopacodigos);
			if($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function getByIdFormapago($fopacodigos) {
		$data_formapago = $this->gateway->getByIdFormapago($fopacodigos);
		return $data_formapago;
	}
	function getAllFormapago() {
		//$this->gateway->
	}
	function UnsetRequest() {
		unset ($_REQUEST["formapago__fopacodigos"]);
		unset ($_REQUEST["formapago__fopanombres"]);
		unset ($_REQUEST["formapago__fopatiempon"]);
		unset ($_REQUEST["formapago__fopacancuotn"]);
		unset ($_REQUEST["formapago__fopadescrips"]);
		unset ($_REQUEST["formapago__fopaactivos"]);
	}
}
?>	
