<?php 	
/**
* @Copyright 2004 FullEngine
*
* Clase manejadora para la tabla $tabla
* @author Ingravity 0.0.8
* @location Cali - Colombia
*/

class FeWFTareassincroManager {
	var $gateway;

	function FeWFTareassincroManager() {
		$this->gateway = Application :: getDataGateway("tareassincro");
	}

	function addTareassincro($tasicodigon, $proccodigos, $tasisigtareas, $tasiacttareas, $tasiesactas, $tasiindice, $tasitipsincs) {
		if ($this->gateway->existTareassincro($tasicodigon) == 0) {
			$this->gateway->addTareassincro($tasicodigon, $proccodigos, $tasisigtareas, $tasiacttareas, $tasiesactas, $tasiindice, $tasitipsincs);
			if ($this->gateway->consult == false)
				return 100;
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}

	function updateTareassincro($tasicodigon, $proccodigos, $tasisigtareas, $tasiacttareas, $tasiesactas, $tasiindice, $tasitipsincs) {
		if ($this->gateway->existTareassincro($tasicodigon) == 1) {
			$this->gateway->updateTareassincro($tasicodigon, $proccodigos, $tasisigtareas, $tasiacttareas, $tasiesactas, $tasiindice, $tasitipsincs);
			if ($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}

	function deleteTareassincro($tasicodigon) {
		if ($this->gateway->existTareassincro($tasicodigon) == 1) {
			$this->gateway->deleteTareassincro($tasicodigon);
			if ($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}

	function getByIdTareassincro($tasicodigon) {
		$data_tareassincro = $this->gateway->getByIdTareassincro($tasicodigon);
		return $data_tareassincro;
	}

	function getAllTareassincro() {
		//$this->gateway->
	}

	function getByTareassincro_fkey($proccodigos) {
		//$this->gateway->
	}

	function UnsetRequest() {
		unset ($_REQUEST["tareassincro__tasicodigon"]);
		unset ($_REQUEST["tareassincro__proccodigos"]);
		unset ($_REQUEST["tareassincro__tasisigtareas"]);
		unset ($_REQUEST["tareassincro__tasiacttareas"]);
		unset ($_REQUEST["tareassincro__tasiesactas"]);
		unset ($_REQUEST["tareassincro__tasiindice"]);
		unset ($_REQUEST["tareassincro__tasitipsincs"]);
	}
}
?>