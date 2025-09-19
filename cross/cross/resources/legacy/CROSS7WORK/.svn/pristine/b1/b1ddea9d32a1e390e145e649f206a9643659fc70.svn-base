<?php  
class FeWFEstadoactaManager {
	var $gateway;
	function FeWFEstadoactaManager() {
		$this->gateway = Application :: getDataGateway("estadoacta");
	}
	function addEstadoacta($esaccodigos, $esacnombres, $esacdescrips, $esacactivas) {
		if ($this->gateway->existEstadoacta($esaccodigos) == 0) {
			$this->gateway->addEstadoacta($esaccodigos, $esacnombres, $esacdescrips, $esacactivas);
			if($this->gateway->consult == false){
				return 100;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}
	function updateEstadoacta($esaccodigos, $esacnombres, $esacdescrips, $esacactivas) {
		if ($this->gateway->existEstadoacta($esaccodigos) == 1) {
			//Valida que el estado no sea usado en un proceso
            $gatewayRuta = Application::getDataGateway('RutaExtended');
            $rcRutas = $gatewayRuta->getRutaByRutaesactas($esaccodigos);
            if(is_array($rcRutas))
                return 14;

            $this->gateway->updateEstadoacta($esaccodigos, $esacnombres, $esacdescrips, $esacactivas);
			if($this->gateway->consult == false){
				return 2;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function deleteEstadoacta($esaccodigos) {
		if ($this->gateway->existEstadoacta($esaccodigos) == 1) {
			$this->gateway->deleteEstadoacta($esaccodigos);
			if($this->gateway->consult == false){
				return 2;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function getByIdEstadoacta($esaccodigos) {
		$data_estadoacta = $this->gateway->getByIdEstadoacta($esaccodigos);
		return $data_estadoacta;
	}
	function getAllEstadoacta() {
		//$this->gateway->
	}
	function UnsetRequest() {
		unset ($_REQUEST["estadoacta__esaccodigos"]);
		unset ($_REQUEST["estadoacta__esacnombres"]);
		unset ($_REQUEST["estadoacta__esacdescrips"]);
		unset ($_REQUEST["estadoacta__esacactivas"]);
	}
}
?>