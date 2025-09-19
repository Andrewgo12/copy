<?php 
class FeStGruporecursoManager {
	var $gateway;
	function FeStGruporecursoManager() {
		$this->gateway = Application :: getDataGateway("gruporecurso");
	}
	function addGruporecurso($grrecodigos, $grrenombres, $grredescrips) {
		if ($this->gateway->existGruporecurso($grrecodigos) == 0) {
			$this->gateway->addGruporecurso($grrecodigos, $grrenombres, $grredescrips);
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}
	function updateGruporecurso($grrecodigos, $grrenombres, $grredescrips,$grreactivas) {
		if ($this->gateway->existGruporecurso($grrecodigos) == 1) {
			$this->gateway->updateGruporecurso($grrecodigos, $grrenombres, $grredescrips,$grreactivas);
			//Valida si se elimino el registro
			if($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function deleteGruporecurso($grrecodigos) {
		if ($this->gateway->existGruporecurso($grrecodigos) == 1) {
			$this->gateway->deleteGruporecurso($grrecodigos);
			//Valida si se elimino el registro
			if($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function getByIdGruporecurso($grrecodigos) {
		$data_gruporecurso = $this->gateway->getByIdGruporecurso($grrecodigos);
		return $data_gruporecurso;
	}
	function getAllGruporecurso() {
		//$this->gateway->
	}
	function UnsetRequest() {
		unset ($_REQUEST["gruporecurso__grrecodigos"]);
		unset ($_REQUEST["gruporecurso__grrenombres"]);
		unset ($_REQUEST["gruporecurso__grredescrips"]);
		unset ($_REQUEST["gruporecurso__grreactivas"]);
	}
}
?>	
