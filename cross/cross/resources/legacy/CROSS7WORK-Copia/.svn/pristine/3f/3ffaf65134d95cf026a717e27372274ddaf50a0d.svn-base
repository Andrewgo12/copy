<?php 
   				

class FeHrEstadogrupoManager {
	var $gateway;

	function FeHrEstadogrupoManager() {
		$this->gateway = Application :: getDataGateway("estadogrupo");
	}

	function addEstadogrupo($esgrcodigos, $esgrnombres, $esgrdescrips, $esgractivas) {
		if ($this->gateway->existEstadogrupo($esgrcodigos) == 0) {
			$this->gateway->addEstadogrupo($esgrcodigos, $esgrnombres, $esgrdescrips, $esgractivas);
            if($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}

	function updateEstadogrupo($esgrcodigos, $esgrnombres, $esgrdescrips, $esgractivas) {
		if ($this->gateway->existEstadogrupo($esgrcodigos) == 1) {
			$this->gateway->updateEstadogrupo($esgrcodigos, $esgrnombres, $esgrdescrips, $esgractivas);
            if($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}

	function deleteEstadogrupo($esgrcodigos) {
		if ($this->gateway->existEstadogrupo($esgrcodigos) == 1) {
			$this->gateway->deleteEstadogrupo($esgrcodigos);
            if ($this->gateway->consult == false) {
				return 2;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}

	function getByIdEstadogrupo($esgrcodigos) {
		$data_estadogrupo = $this->gateway->getByIdEstadogrupo($esgrcodigos);
		return $data_estadogrupo;
	}

	function getAllEstadogrupo() {
		//$this->gateway->
	}

	function UnsetRequest() {
		unset ($_REQUEST["estadogrupo__esgrcodigos"]);
		unset ($_REQUEST["estadogrupo__esgrnombres"]);
		unset ($_REQUEST["estadogrupo__esgrdescrips"]);
		unset ($_REQUEST["estadogrupo__esgractivas"]);
	}

}

?>	
 	