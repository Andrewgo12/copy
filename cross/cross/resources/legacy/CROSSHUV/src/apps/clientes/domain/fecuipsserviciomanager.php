<?php 
class FeCuIpsservicioManager {
	var $gateway;
	function FeCuIpsservicioManager() {
		$this->gateway = Application :: getDataGateway("ipsservicio");
	}
	function addIpsservicio($ipsecodigos, $ipsenombres, $ipsedescrips, $ipseactivos) {
		if ($this->gateway->existIpsservicio($ipsecodigos) == 0) {
			$this->gateway->addIpsservicio($ipsecodigos, $ipsenombres, $ipsedescrips, $ipseactivos);
			if($this->gateway->consult == false){
				return 100;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}
	function updateIpsservicio($ipsecodigos, $ipsenombres, $ipsedescrips, $ipseactivos) {
		if ($this->gateway->existIpsservicio($ipsecodigos) == 1) {
			$this->gateway->updateIpsservicio($ipsecodigos, $ipsenombres, $ipsedescrips, $ipseactivos);
			if($this->gateway->consult == false){
				return 2;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function deleteIpsservicio($ipsecodigos) {
		if ($this->gateway->existIpsservicio($ipsecodigos) == 1) {
			$this->gateway->deleteIpsservicio($ipsecodigos);
			if($this->gateway->consult == false){
				return 2;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function getByIdIpsservicio($ipsecodigos) {
		$data_ipsservicio = $this->gateway->getByIdIpsservicio($ipsecodigos);
		return $data_ipsservicio;
	}
	function getAllIpsservicio() {
		//$this->gateway->
	}
	function UnsetRequest() {
		unset ($_REQUEST["ipsservicio__ipsecodigos"]);
		unset ($_REQUEST["ipsservicio__ipsenombres"]);
		unset ($_REQUEST["ipsservicio__ipsedescrips"]);
		unset ($_REQUEST["ipsservicio__ipseactivos"]);
	}
}
?>