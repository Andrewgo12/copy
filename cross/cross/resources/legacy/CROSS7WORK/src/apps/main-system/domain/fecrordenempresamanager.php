<?php 
class FeCrOrdenempresaManager {
	var $gateway;
	function FeCrOrdenempresaManager() {
		$this->gateway = Application :: getDataGateway("ordenempresa");
	}
	function deleteOrdenempresa($ordenumeros) {
		if ($this->gateway->existOrdenempresa($ordenumeros) == 1) {
			$this->gateway->deleteOrdenempresa($ordenumeros);
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function getByIdOrdenempresa($ordenumeros) {
        $ordenempresaExtended = Application :: getDataGateway("ordenempresaExtended");
		$data_ordenempresa = $ordenempresaExtended->getByOrdenOrdenempresa($ordenumeros);
		return $data_ordenempresa;
	}
	function getAllOrdenempresa() {
		//$this->gateway->
	}
	function getByOrdenempresa_fkey($ordenumeros) {
		//$this->gateway->
	}
	function getByOrdenempresa_fkey2($priocodigos) {
		//$this->gateway->
	}
	function getByOrdenempresa_fkey3($tiorcodigos) {
		//$this->gateway->
	}
	function getByOrdenempresa_fkey4($evencodigos, $causcodigos) {
		//$this->gateway->
	}
	function getByOrdenempresa_fkey5($locacodigos) {
		//$this->gateway->
	}
	function UnsetRequest() {
		unset ($_REQUEST["ordenempresa__ordenumeros"]);
		unset ($_REQUEST["ordenempresa__contidentis"]);
		unset ($_REQUEST["ordenempresa__contidentis_desc"]);
		unset ($_REQUEST["ordenempresa__infrcodigos"]);
		unset ($_REQUEST["ordenempresa__infrcodigos_desc"]);
		unset ($_REQUEST["ordenempresa__priocodigos"]);
		unset ($_REQUEST["ordenempresa__tiorcodigos"]);
		unset ($_REQUEST["ordenempresa__evencodigos"]);
		unset ($_REQUEST["ordenempresa__causcodigos"]);
		unset ($_REQUEST["ordenempresa__locacodigos"]);
		unset ($_REQUEST["ordenempresa__pais"]);
		unset ($_REQUEST["ordenempresa__departamento"]);
		unset ($_REQUEST["ordenempresa__orgacodigos"]);
	}
	function UnsetRequestCompromisos() {
		unset ($_REQUEST["ordenumeros"]);
		unset ($_REQUEST["ordefecregd"]);
		unset ($_REQUEST["infrcodigos"]);
		unset ($_REQUEST["infrcodigos_desc"]);
		unset ($_REQUEST["tiorcodigos"]);
		unset ($_REQUEST["evencodigos"]);
		unset ($_REQUEST["causcodigos"]);
		unset ($_REQUEST["orgacodigos"]);
		unset ($_REQUEST["locacodigos"]);
		unset ($_REQUEST["locacodigos_desc"]);
		unset ($_REQUEST["compcodigos"]);
		unset ($_REQUEST["accofecrevn"]);
		unset ($_REQUEST["accoactivas"]);
	}
}
?>