<?php 
class FeStRecursoManager {
	var $gateway;
	function FeStRecursoManager() {
		$this->gateway = Application :: getDataGateway("recurso");
	}
	function addRecurso($recucodigos, $recunombres, $grrecodigos, $tirecodigos, $unmecodigos, $recudescrips) {
		if ($this->gateway->existRecurso($recucodigos) == 0) {
			$this->gateway->addRecurso($recucodigos, $recunombres, $grrecodigos, $tirecodigos, $unmecodigos, $recudescrips);
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}
	function updateRecurso($recucodigos, $recunombres, $grrecodigos, $tirecodigos, $unmecodigos, $recudescrips, $recuactivas) {
		if ($this->gateway->existRecurso($recucodigos) == 1) {
			$this->gateway->updateRecurso($recucodigos, $recunombres, $grrecodigos, $tirecodigos, $unmecodigos, $recudescrips, $recuactivas);
			if($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function deleteRecurso($recucodigos) {
		if ($this->gateway->existRecurso($recucodigos) == 1) {
			$this->gateway->deleteRecurso($recucodigos);
			if($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function getByIdRecurso($recucodigos) {
		$data_recurso = $this->gateway->getByIdRecurso($recucodigos);
		return $data_recurso;
	}
	function getAllRecurso() {
		//$this->gateway->
	}
	function getByRecurso_fkey($tirecodigos) {
		//$this->gateway->
	}
	function getByRecurso_fkey1($grrecodigos) {
		//$this->gateway->
	}
	function getByRecurso_fkey2($unmecodigos) {
		//$this->gateway->
	}
	function UnsetRequest() {
		unset ($_REQUEST["recurso__recucodigos"]);
		unset ($_REQUEST["recurso__recunombres"]);
		unset ($_REQUEST["recurso__grrecodigos"]);
		unset ($_REQUEST["recurso__tirecodigos"]);
		unset ($_REQUEST["recurso__unmecodigos"]);
		unset ($_REQUEST["recurso__recudescrips"]);
		unset ($_REQUEST["recurso__recuactivas"]);
	}
}
?>	
