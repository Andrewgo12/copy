<?php 
   				
/**
* @Copyright 2004 FullEngine
*
* Clase manejadora para la tabla $tabla
* @author Ingravity 0.0.8
* @location Cali - Colombia
*/

class FePrStyleManager {
	var $gateway;

	function FePrStyleManager() {
		$this->gateway = Application :: getDataGateway("style");
	}

	function addStyle($stylcodigos, $applcodigos, $stylnombres, $stylobservas) {
		if ($this->gateway->existStyle($stylcodigos, $applcodigos) == 0) {
			$this->gateway->addStyle($stylcodigos, $applcodigos, $stylnombres, $stylobservas);
			if ($this->gateway->consult == false)
				return 100;
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}

	function updateStyle($stylcodigos, $applcodigos, $stylnombres, $stylobservas) {
		if ($this->gateway->existStyle($stylcodigos, $applcodigos) == 1) {
			$this->gateway->updateStyle($stylcodigos, $applcodigos, $stylnombres, $stylobservas);
			if ($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}

	function deleteStyle($stylcodigos, $applcodigos) {
		if ($this->gateway->existStyle($stylcodigos, $applcodigos) == 1) {
			$this->gateway->deleteStyle($stylcodigos, $applcodigos);
			if ($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}

	function getByIdStyle($stylcodigos, $applcodigos) {
		$data_style = $this->gateway->getByIdStyle($stylcodigos, $applcodigos);
		return $data_style;
	}

	function getAllStyle() {
		//$this->gateway->
	}

	function getByStyle_fkey($applcodigos) {
		return $this->gateway->getByStyle_fkey($applcodigos);
	}

	function UnsetRequest() {
		unset ($_REQUEST["style__stylcodigos"]);
		unset ($_REQUEST["style__applcodigos"]);
		unset ($_REQUEST["style__stylnombres"]);
		unset ($_REQUEST["style__stylobservas"]);
	}

}

?>	
 	