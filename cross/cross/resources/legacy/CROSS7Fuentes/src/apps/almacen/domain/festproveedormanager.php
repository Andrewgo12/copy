<?php 
class FeStProveedorManager {
	var $gateway;
	function FeStProveedorManager() {
		$this->gateway = Application :: getDataGateway("proveedor");
	}
	function addProveedor($provcodigos, $provnombres, $provnnomreprs, $provdireccis, $protelefons, $provemails, $provwebs, $paiscodigos, $depacodigos, $ciudcodigos) {
		if ($this->gateway->existProveedor($provcodigos) == 0) {
			$this->gateway->addProveedor($provcodigos, $provnombres, $provnnomreprs, $provdireccis, $protelefons, $provemails, $provwebs, $paiscodigos, $depacodigos, $ciudcodigos);
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}
	function updateProveedor($provcodigos, $provnombres, $provnnomreprs, $provdireccis, $protelefons, $provemails, $provwebs, $paiscodigos, $depacodigos, $ciudcodigos, $provactivas) {
		if ($this->gateway->existProveedor($provcodigos) == 1) {
			$this->gateway->updateProveedor($provcodigos, $provnombres, $provnnomreprs, $provdireccis, $protelefons, $provemails, $provwebs, $paiscodigos, $depacodigos, $ciudcodigos, $provactivas);
			if($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function deleteProveedor($provcodigos) {
		if ($this->gateway->existProveedor($provcodigos) == 1) {
			$this->gateway->deleteProveedor($provcodigos);
			if($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function getByIdProveedor($provcodigos) {
		$data_proveedor = $this->gateway->getByIdProveedor($provcodigos);
		return $data_proveedor;
	}
	function getAllProveedor() {
		//$this->gateway->
	}
	function UnsetRequest() {
		unset ($_REQUEST["proveedor__provcodigos"]);
		unset ($_REQUEST["proveedor__provnombres"]);
		unset ($_REQUEST["proveedor__provnnomreprs"]);
		unset ($_REQUEST["proveedor__provdireccis"]);
		unset ($_REQUEST["proveedor__protelefons"]);
		unset ($_REQUEST["proveedor__provemails"]);
		unset ($_REQUEST["proveedor__provwebs"]);
		unset ($_REQUEST["proveedor__paiscodigos"]);
		unset ($_REQUEST["proveedor__depacodigos"]);
		unset ($_REQUEST["proveedor__ciudcodigos"]);
	}
}
?>	
