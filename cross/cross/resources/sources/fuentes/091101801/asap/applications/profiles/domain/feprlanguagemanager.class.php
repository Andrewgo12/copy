<?php 
   				
/**
* @Copyright 2004 FullEngine
*
* Clase manejadora para la tabla $tabla
* @author Ingravity 0.0.8
* @location Cali - Colombia
*/

class FePrLanguageManager {
	var $gateway;

	function FePrLanguageManager() {
		$this->gateway = Application :: getDataGateway("language");
	}

	function addLanguage($langcodigos, $langnombres, $langobservas) {
		if ($this->gateway->existLanguage($langcodigos) == 0) {
			$this->gateway->addLanguage($langcodigos, $langnombres, $langobservas);
			if ($this->gateway->consult == false)
				return 100;
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}

	function updateLanguage($langcodigos, $langnombres, $langobservas) {
		if ($this->gateway->existLanguage($langcodigos) == 1) {
			$this->gateway->updateLanguage($langcodigos, $langnombres, $langobservas);
			if ($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}

	function deleteLanguage($langcodigos) {
		if ($this->gateway->existLanguage($langcodigos) == 1) {
			$this->gateway->deleteLanguage($langcodigos);
			if ($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}

	function getByIdLanguage($langcodigos) {
		$data_language = $this->gateway->getByIdLanguage($langcodigos);
		return $data_language;
	}

	function getAllLanguage() {
		return $this->gateway->getAllLanguage();
	}

	function UnsetRequest() {
		unset ($_REQUEST["language__langcodigos"]);
		unset ($_REQUEST["language__langnombres"]);
		unset ($_REQUEST["language__langobservas"]);
	}

}

?>	
 	