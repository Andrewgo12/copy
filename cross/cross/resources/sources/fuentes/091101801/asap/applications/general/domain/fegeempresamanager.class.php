<?php 
class FeGeEmpresaManager {
	var $gateway;

	function FeGeEmpresaManager() {
		//$this->gateway = Application :: getDataGateway("empresa");
	}

	function addEmpresa($emprnits, $emprnombres, $emprdireccs, $emprtelefos, $emprfaxs, $emprnombreps, $emprlogos) {
		if ($this->gateway->existEmpresa($emprnits) == 0) {
			$this->gateway->addEmpresa($emprnits, $emprnombres, $emprdireccs, $emprtelefos, $emprfaxs, $emprnombreps, $emprlogos);
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}

	function updateEmpresa($emprnits, $emprnombres, $emprdireccs, $emprtelefos, $emprfaxs, $emprnombreps, $emprlogos) {
		if ($this->gateway->existEmpresa($emprnits) == 1) {
			$this->gateway->updateEmpresa($emprnits, $emprnombres, $emprdireccs, $emprtelefos, $emprfaxs, $emprnombreps, $emprlogos);
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}

	function deleteEmpresa($emprnits) {
		if ($this->gateway->existEmpresa($emprnits) == 1) {
			$this->gateway->deleteEmpresa($emprnits);
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}

	function getByIdEmpresa($emprnits="") {
		settype($objManager,"object");
		settype($orcResult,"array");
		//$data_empresa = $this->gateway->getByIdEmpresa($emprnits);
		$objManager = Application :: getDomainController("ParamsManager");
		$orcResult = $objManager->getParam("general","empresa");
		return $orcResult;
	}

	function getAllEmpresa() {
		//$this->gateway->
	}

	function UnsetRequest() {
		unset ($_REQUEST["empresa__emprnits"]);
		unset ($_REQUEST["empresa__emprnombres"]);
		unset ($_REQUEST["empresa__emprdireccs"]);
		unset ($_REQUEST["empresa__emprtelefos"]);
		unset ($_REQUEST["empresa__emprfaxs"]);
		unset ($_REQUEST["empresa__emprnombreps"]);
		unset ($_REQUEST["empresa__emprlogos"]);
	}
}
?>