<?php 
class FeGeEmailManager {
	var $gateway;

	function FeGeEmailManager() {
		$this->gateway = Application :: getDataGateway("email");
	}

	function addEmail($emaicodigos, $ordenumeros, $foemcodigos, $orgacodigos, $emaiparas, $emaidesdes, $emaiasuntos, $emaitextos, $emaiestados, $usuacodigos, $emaifecregn, $emaifecenvn, $emaiadjuntos) {
		if ($this->gateway->existEmail() == 0) {
			$this->gateway->addEmail($emaicodigos, $ordenumeros, $foemcodigos, $orgacodigos, $emaiparas, $emaidesdes, $emaiasuntos, $emaitextos, $emaiestados, $usuacodigos, $emaifecregn, $emaifecenvn, $emaiadjuntos);
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}

	function updateEmail($emaicodigos, $ordenumeros, $foemcodigos, $orgacodigos, $emaiparas, $emaidesdes, $emaiasuntos, $emaitextos, $emaiestados, $usuacodigos, $emaifecregn, $emaifecenvn, $emaiadjuntos) {
		if ($this->gateway->existEmail() == 1) {
			$this->gateway->updateEmail($emaicodigos, $ordenumeros, $foemcodigos, $orgacodigos, $emaiparas, $emaidesdes, $emaiasuntos, $emaitextos, $emaiestados, $usuacodigos, $emaifecregn, $emaifecenvn, $emaiadjuntos);
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}

	function deleteEmail($emaicodigos) {
		if ($this->gateway->existEmail($emaicodigos) == 1) {
			$this->gateway->deleteEmail($emaicodigos);
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}

	function getByIdEmail($emaicodigos) {
		$data_email = $this->gateway->getByIdEmail($emaicodigos);
		return $data_email;
	}

	function getAllEmail() {
		//$this->gateway->
	}

	function UnsetRequest() {
		unset ($_REQUEST["email__emaicodigos"]);
		unset ($_REQUEST["email__ordenumeros"]);
		unset ($_REQUEST["email__foemcodigos"]);
		unset ($_REQUEST["email__orgacodigos"]);
		unset ($_REQUEST["email__emaiparas"]);
		unset ($_REQUEST["email__emaidesdes"]);
		unset ($_REQUEST["email__emaiasuntos"]);
		unset ($_REQUEST["email__emaitextos"]);
		unset ($_REQUEST["email__emaiestados"]);
		unset ($_REQUEST["email__usuacodigos"]);
		unset ($_REQUEST["email__emaifecregn"]);
		unset ($_REQUEST["email__emaifecenvn"]);
		unset ($_REQUEST["email__emaiadjuntos"]);
	}
}
?>	