<?php 
class FeCrCausaManager {
	var $gateway;
	function FeCrCausaManager() {
		$this->gateway = Application :: getDataGateway("causa");
	}
	function addCausa($tiorcodigos, $evencodigos, $causcodigos, $causnombres, $causdescrips, $causactivas) {
		if ($this->gateway->existCausa($tiorcodigos, $evencodigos, $causcodigos) == 0) {
			$this->gateway->addCausa($tiorcodigos, $evencodigos, $causcodigos, $causnombres, $causdescrips, $causactivas);
			if($this->gateway->consult == false){
				return 100;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}
	function updateCausa($tiorcodigos, $evencodigos, $causcodigos, $causnombres, $causdescrips, $causactivas) {
		if ($this->gateway->existCausa($tiorcodigos,$evencodigos, $causcodigos) == 1) {
			$this->gateway->updateCausa($tiorcodigos, $evencodigos, $causcodigos, $causnombres, $causdescrips, $causactivas);
			if($this->gateway->consult == false){
				return 2;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function deleteCausa($tiorcodigos, $evencodigos, $causcodigos) {
		if ($this->gateway->existCausa($tiorcodigos, $evencodigos, $causcodigos) == 1) {
            //Valida su uso en los requerimientos
            //Valida si es usado el los req
            $gateway = Application::getDataGateway('SqlExtended');
            $rcReq = $gateway->getRequerimientoByCausa($tiorcodigos, $evencodigos, $causcodigos);
            if(is_array($rcReq))
                return 48;
			$this->gateway->deleteCausa($tiorcodigos, $evencodigos, $causcodigos);
			if($this->gateway->consult == false){
				return 2;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function getByIdCausa($tiorcodigos, $evencodigos, $causcodigos) {
		$data_causa = $this->gateway->getByIdCausa($tiorcodigos, $evencodigos, $causcodigos);
		return $data_causa;
	}
	function getAllCausa() {
		//$this->gateway->
	}
	function getByCausa_fkey($evencodigos) {
		//$this->gateway->
	}
	function UnsetRequest() {
		unset ($_REQUEST["causa__tiorcodigos"]);
		unset ($_REQUEST["causa__evencodigos"]);
		unset ($_REQUEST["causa__causcodigos"]);
		unset ($_REQUEST["causa__causnombres"]);
		unset ($_REQUEST["causa__causdescrips"]);
		unset ($_REQUEST["causa__causactivas"]);
	}
}
?>