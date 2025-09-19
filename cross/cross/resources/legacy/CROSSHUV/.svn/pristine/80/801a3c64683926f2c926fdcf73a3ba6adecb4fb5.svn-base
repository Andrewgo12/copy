<?php 
class FeCrTipoordenManager {
	var $gateway;
	function FeCrTipoordenManager() {
		$this->gateway = Application :: getDataGateway("tipoorden");
	}
	function addTipoorden($tiorcodigos, $tiornombres, $tiordescrips, $tioractivos, $tiorpeson) {
		if ($this->gateway->existTipoorden($tiorcodigos) == 0) {
			$this->gateway->addTipoorden($tiorcodigos, $tiornombres, $tiordescrips, $tioractivos, $tiorpeson);
			if($this->gateway->consult == false){
				return 100;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}
	function updateTipoorden($tiorcodigos, $tiornombres, $tiordescrips, $tioractivos, $tiorpeson) {
		if ($this->gateway->existTipoorden($tiorcodigos) == 1) {
			$this->gateway->updateTipoorden($tiorcodigos, $tiornombres, $tiordescrips, $tioractivos, $tiorpeson);
			if($this->gateway->consult == false){
				return 2;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function deleteTipoorden($tiorcodigos) {
		if ($this->gateway->existTipoorden($tiorcodigos) == 1) {
            //Valida si es usado el los req
            $gateway = Application::getDataGateway('SqlExtended');
            $rcReq = $gateway->getReqByTipo($tiorcodigos);
            if(is_array($rcReq))
                return 46;
			$this->gateway->deleteTipoorden($tiorcodigos);
			if($this->gateway->consult == false){
				return 2;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function getByIdTipoorden($tiorcodigos) {
		$data_tipoorden = $this->gateway->getByIdTipoorden($tiorcodigos);
		return $data_tipoorden;
	}
	function getAllTipoorden() {
		//$this->gateway->
	}
	function UnsetRequest() {
		unset ($_REQUEST["tipoorden__tiorcodigos"]);
		unset ($_REQUEST["tipoorden__tiornombres"]);
		unset ($_REQUEST["tipoorden__tiordescrips"]);
		unset ($_REQUEST["tipoorden__tioractivos"]);
		unset ($_REQUEST["tipoorden__tiorpeson"]);
	}
}
?>