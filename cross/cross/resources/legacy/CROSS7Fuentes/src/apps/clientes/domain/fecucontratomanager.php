<?php 
class FeCuContratoManager {
	var $gateway;
	var $gatewayClie;
	function FeCuContratoManager() {
		$this->gateway = Application :: getDataGateway("contrato");
		$this->gatewayClie = Application :: getDataGateway("cliente");
	}
	function addContrato($contnics,$clieidentifs, $ticocodigos, $contobjetos, 
						$timocodigos,$contmonton, $fopacodigos, $contfchainin, 
						$contfchafinn,$contfchfirmn, $contestados, $contdescrips) {
		//Valida la existencia del cliente
		if($this->gatewayClie->existClientebyId($clieidentifs) == 0){
			return 12;	
		}
		
		if ($this->gateway->existContrato($contnics) == 0) {
			$this->gateway->addContrato($contnics, $clieidentifs, $ticocodigos, $contobjetos, $timocodigos, $contmonton, $fopacodigos, $contfchainin, $contfchafinn, $contfchfirmn, $contestados, $contdescrips);
			if($this->gateway->consult == false)
				return 100;
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}
	function updateContrato($contnics, $clieidentifs, $ticocodigos, $contobjetos, $timocodigos, $contmonton, $fopacodigos, $contfchainin, $contfchafinn, $contfchfirmn, $contestados, $contdescrips) {

		//Valida la existencia del cliente
		if($this->gatewayClie->existClientebyId($clieidentifs) == 0){
			return 12;	
		}
		
		if ($this->gateway->existContrato($contnics) == 1) {
			$this->gateway->updateContrato($contnics, $clieidentifs, $ticocodigos, $contobjetos, $timocodigos, $contmonton, $fopacodigos, $contfchainin, $contfchafinn, $contfchfirmn, $contestados, $contdescrips);
			if($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function deleteContrato($contnics) {
		if ($this->gateway->existContrato($contnics) == 1) {
			$this->gateway->deleteContrato($contnics);
			if($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function getByIdContrato($contnics) {
		$data_contrato = $this->gateway->getByIdContrato($contnics);
		return $data_contrato;
	}
	function getAllContrato() {
		//$this->gateway->
	}
	function getByContrato_fkey($contclidirs) {
		//$this->gateway->
	}
	function getByContrato_fkey1($ticocodigos) {
		//$this->gateway->
	}
	function getByContrato_fkey2($timocodigos) {
		//$this->gateway->
	}
	function getByContrato_fkey3($fopacodigos) {
		//$this->gateway->
	}
	function UnsetRequest() {
		unset ($_REQUEST["contrato__contnics"]);
		unset ($_REQUEST["contrato__clieidentifs"]);
		unset ($_REQUEST["contrato_clieidentifs_desc"]);
		unset ($_REQUEST["contrato__ticocodigos"]);
		unset ($_REQUEST["contrato_contobjetos"]);
		unset ($_REQUEST["contrato__timocodigos"]);
		unset ($_REQUEST["contrato__contmonton"]);
		unset ($_REQUEST["contrato__fopacodigos"]);
		unset ($_REQUEST["contrato__contfchainin"]);
		unset ($_REQUEST["contrato__contfchafinn"]);
		unset ($_REQUEST["contrato__contfchfirmn"]);
		unset ($_REQUEST["contrato__contestados"]);
		unset ($_REQUEST["contrato_contdescrips"]);
	}
}
?>	
