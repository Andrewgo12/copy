<?php  
class FeGeDetaconfformManager {
	var $gateway;

	function FeGeDetaconfformManager() {
		$this->gateway = Application :: getDataGateway("detaconfform");
	}

	function addDetaconfform($cofocodigon, $cacocodigon, $decooperados, $decovalors) {
		if ($this->gateway->existDetaconfform($cofocodigon, $cacocodigon) == 0) {
			$this->gateway->addDetaconfform($cofocodigon, $cacocodigon, $decooperados, $decovalors);
			if ($this->gateway->consult == false) {
				return 100;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}

	function updateDetaconfform($cofocodigon, $cacocodigon, $decooperados, $decovalors) {
		if ($this->gateway->existDetaconfform($cofocodigon, $cacocodigon) == 1) {
			$this->gateway->updateDetaconfform($cofocodigon, $cacocodigon, $decooperados, $decovalors);
			if ($this->gateway->consult == false) {
				return 2;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}

	function deleteDetaconfform($cofocodigon, $cacocodigon) {
		if ($this->gateway->existDetaconfform($cofocodigon, $cacocodigon) == 1) {
			$this->gateway->deleteDetaconfform($cofocodigon, $cacocodigon);
			if ($this->gateway->consult == false) {
				return 2;
			}
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}

	function getByIdDetaconfform($cofocodigon, $cacocodigon) {
		$data_detaconfform = $this->gateway->getByIdDetaconfform($cofocodigon, $cacocodigon);
		return $data_detaconfform;
	}

	function getAllDetaconfform() {
		//$this->gateway->
	}

	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Actualiza el detalle de configuracion para los formato de carta
	*   @author freina
	*	@param array $ircdata (Arreglo con el detalle)
	*   @date 17-Nov-2005 14:59
	*   @location Cali-Colombia
	*/
	function ActualizarDetalleformato($ircdata) {
		
		settype($rctmp,"array");

		foreach ($ircdata as $rctmp) {
			if ($this->gateway->existDetaconfform($rctmp["cofocodigon"], $rctmp["cacocodigon"]) == 1) {
				$this->gateway->updateDetaconfform($rctmp["cofocodigon"], $rctmp["cacocodigon"], $rctmp["decooperados"], $rctmp["decovalors"]);
				if ($this->gateway->consult == false) {
					return 2;
				}
			} else {
				return 2;
			}
		}
		$this->UnsetRequestEsp();
		return 3;
	}

	function getByDetaconfform_fkey($cofocodigon) {
		//$this->gateway->
	}

	function getByDetaconfform_fkey1($cacocodigon) {
		//$this->gateway->
	}

	function UnsetRequest() {
		unset ($_REQUEST["detaconfform__cofocodigon"]);
		unset ($_REQUEST["detaconfform__cacocodigon"]);
		unset ($_REQUEST["detaconfform__decooperados"]);
		unset ($_REQUEST["detaconfform__decovalors"]);
	}
	function UnsetRequestEsp() {
		unset ($_REQUEST["configformat__focacodigos"]);
		unset ($_REQUEST["configformat__tiorcodigos"]);
		unset ($_REQUEST["tiorcodigos"]);
		unset ($_REQUEST["configformat__tiorcodigos_desc"]);
		unset ($_REQUEST["configformat__esaccodigos"]);
		unset ($_REQUEST["esaccodigos"]);
		unset ($_REQUEST["configformat__esaccodigos_desc"]);
		unset ($_REQUEST["configformat__evencodigos"]);
		unset ($_REQUEST["evencodigos"]);
		unset ($_REQUEST["configformat__evencodigos_desc"]);
		unset ($_REQUEST["cofocodigon"]);
		unset ($_REQUEST["table"]);
	}
}
?> 	