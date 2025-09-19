<?php 
class FeStProveerecursManager {
	var $gateway;
	function FeStProveerecursManager() {
		$this->gateway = Application :: getDataGateway("proveerecurs");
	}
	function addProveerecurs($prrecodigos, $provcodigos, $recucodigos, $prrevalorecf) {
		if ($this->gateway->existProveerecurs($prrecodigos) == 0) {
			$this->gateway->addProveerecurs($prrecodigos, $provcodigos, $recucodigos, $prrevalorecf);
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}
	function updateProveerecurs($prrecodigos, $provcodigos, $recucodigos, $prrevalorecf) {
		if ($this->gateway->existProveerecurs($prrecodigos) == 1) {
			$this->gateway->updateProveerecurs($prrecodigos, $provcodigos, $recucodigos, $prrevalorecf);
			if($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function deleteProveerecurs($prrecodigos) {
		if ($this->gateway->existProveerecurs($prrecodigos) == 1) {
			$this->gateway->deleteProveerecurs($prrecodigos);
			if($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function getByIdProveerecurs($prrecodigos) {
		$data_proveerecurs = $this->gateway->getByIdProveerecurs($prrecodigos);
		return $data_proveerecurs;
	}
	function getAllProveerecurs() {
		//$this->gateway->
	}
	function getByProveerecurs_fkey($provcodigos) {
		//$this->gateway->
	}
	function getByProveerecurs_fkey1($recucodigos) {
		//$this->gateway->
	}
	function UnsetRequest() {
		unset ($_REQUEST["proveerecurs__prrecodigos"]);
		unset ($_REQUEST["proveerecurs__provcodigos"]);
		unset ($_REQUEST["proveerecurs__recucodigos"]);
		unset ($_REQUEST["proveerecurs__prrevalorecf"]);
	}
}
?>	
