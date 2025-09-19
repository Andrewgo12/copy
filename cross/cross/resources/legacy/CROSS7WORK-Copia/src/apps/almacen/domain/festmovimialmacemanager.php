<?php  
class FeStMovimialmaceManager {
	var $gateway;
	function FeStMovimialmaceManager() {
		$this->gateway = Application :: getDataGateway("movimialmace");
	}
	function addMovimialmace($rcGeneric,$rcResources) {
		
		//Obtiene la fecha del movimiento		
		$DateController = Application :: loadServices("DateController");
		$moalfechmovd = $DateController->fncintdatehour();
		$rcGeneric["moalfechmovd"] = $DateController->fncintdatehour();
		//Obtiene el codigo del personal que es el nombre del usuario
		$rcUser = Application::getUserParam();
		$rcGeneric["perscodigos"] = $rcUser["username"];
		//Trae los indices del numerador
		$nuReg = sizeof($rcResources) * 2;
		$gateWay = Application :: getDomainController('NumeradorManager');
		$IndMov = $gateWay->fncgetByIdNumerador("movimialmace",$nuReg);
		
		//Genera los sql con movimialmace y recuseribode
		$gateWay = Application :: getDataGateway("movimialmaceExtended");
		$result = $gateWay->getExecSqlMovimialmace($rcGeneric,$rcResources,$IndMov);
		if($result == 3)
			$this->UnsetRequest();
		return $result;
	}
	function updateMovimialmace($moalcodigos, $bodecodigos, $recucodigos, $moalfechmovd, $comocodigos, $moalcantrecf, $perscodigos, $tidocodigos, $moalnumedocs, $moalsignos) {
		if ($this->gateway->existMovimialmace($moalcodigos) == 1) {
			$this->gateway->updateMovimialmace($moalcodigos, $bodecodigos, $recucodigos, $moalfechmovd, $comocodigos, $moalcantrecf, $perscodigos, $tidocodigos, $moalnumedocs, $moalsignos);
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function deleteMovimialmace($moalcodigos) {
		if ($this->gateway->existMovimialmace($moalcodigos) == 1) {
			$this->gateway->deleteMovimialmace($moalcodigos);
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function getByIdMovimialmace($moalcodigos) {
		$data_movimialmace = $this->gateway->getByIdMovimialmace($moalcodigos);
		return $data_movimialmace;
	}
	function getAllMovimialmace() {
		//$this->gateway->
	}
	function getByMovimialmace_fkey($bodecodigos) {
		//$this->gateway->
	}
	function getByMovimialmace_fkey1($recucodigos) {
		//$this->gateway->
	}
	function getByMovimialmace_fkey2($comocodigos) {
		//$this->gateway->
	}
	function getByMovimialmace_fkey4($tidocodigos) {
		//$this->gateway->
	}
	function UnsetRequest() {
		unset ($_REQUEST["movimialmace__moalcodigos"]);
		unset ($_REQUEST["movimialmace__bodecodigos_in"]);
		unset ($_REQUEST["movimialmace__bodecodigos_in_desc"]);
		unset ($_REQUEST["movimialmace__bodecodigos_out"]);
		unset ($_REQUEST["movimialmace__bodecodigos_out_desc"]);
		unset ($_REQUEST["movimialmace__recucodigos"]);
		unset ($_REQUEST["movimialmace__moalfechmovd"]);
		unset ($_REQUEST["movimialmace__comocodigos_in"]);
		unset ($_REQUEST["movimialmace__comocodigos_in_desc"]);
		unset ($_REQUEST["movimialmace__comocodigos_out"]);
		unset ($_REQUEST["movimialmace__comocodigos_out_desc"]);
		unset ($_REQUEST["movimialmace__moalcantrecf"]);
		unset ($_REQUEST["movimialmace__perscodigos"]);
		unset ($_REQUEST["movimialmace__tidocodigos"]);
		unset ($_REQUEST["movimialmace__tidocodigos_desc"]);
		unset ($_REQUEST["movimialmace__moalnumedocs"]);
		unset ($_REQUEST["movimialmace__moalsignos"]);
		unset ($_REQUEST["movimialmace__recucodigos_desc"]);
		unset ($_REQUEST["movimialmace__prefix"]);
		unset ($_REQUEST["movimialmace__suffix"]);
		unset ($_REQUEST["movimialmace__serial1"]);
		unset ($_REQUEST["movimialmace__serial2"]);
	}
}
?>	
