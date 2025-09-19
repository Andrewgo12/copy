<?php 
class FeWFActaManager {
	var $gateway;
	var $gatewayext;
	function FeWFActaManager() {
		$this->gateway = Application :: getDataGateway("acta");
		$this->gatewayext = Application :: getDataGateway("actaExtended");
	}
	function addActa($actacodigos, $ordenumeros, $tarecodigos, $actaestacts, $actaestants, $actafechingn, $usuacodigos, $orgacodigos, $actaactivas) {
		if ($this->gateway->existActa($actacodigos) == 0) {
			$this->gateway->addActa($actacodigos, $ordenumeros, $tarecodigos, $actaestacts, $actaestants, $actafechingn, $usuacodigos, $orgacodigos, $actaactivas);
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}
	function updateActa($actacodigos, $ordenumeros, $tarecodigos, $actaestacts, $actaestants, $actafechingn, $usuacodigos, $orgacodigos, $actaactivas) {
		if ($this->gateway->existActa($actacodigos) == 1) {
			$this->gateway->updateActa($actacodigos, $ordenumeros, $tarecodigos, $actaestacts, $actaestants, $actafechingn, $usuacodigos, $orgacodigos, $actaactivas);
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function deleteActa($actacodigos) {
		if ($this->gateway->existActa($actacodigos) == 1) {
			$this->gateway->deleteActa($actacodigos);
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function getByIdActa($actacodigos) {
		$data_acta = $this->gateway->getByIdActa($actacodigos);
		return $data_acta;
	}
	function getAllActa() {
		//$this->gateway->
	}
	function getByActa_fkey($ordenumeros) {
		//$this->gateway->
	}
	function getByActa_fkey1($tarecodigos) {
		//$this->gateway->
	}
	function getByActa_fkey2($actaestacts) {
		//$this->gateway->
	}
	function getByActa_fkey3($orgacodigos) {
		//$this->gateway->
	}
	function UnsetRequest() {
		unset ($_REQUEST["acta__actacodigos"]);
		unset ($_REQUEST["acta__ordenumeros"]);
		unset ($_REQUEST["acta__tarecodigos"]);
		unset ($_REQUEST["acta__actaestacts"]);
		unset ($_REQUEST["acta__actaestants"]);
		unset ($_REQUEST["acta__actafechingn"]);
		unset ($_REQUEST["acta__usuacodigos"]);
		unset ($_REQUEST["acta__orgacodigos"]);
		unset ($_REQUEST["acta__actaactivas"]);
	}
	function updateActaSql($actacodigos, $ordenumeros, $tarecodigos, $actaestacts, $actaestants, $actafechingn, $usuacodigos, $orgacodigos, $actaactivas) {
		settype($osbSql,"string");
		if ($this->gateway->existActa($actacodigos) == 1) {
			$osbSql = $this->gatewayext->updateActaSql($actacodigos, $ordenumeros, $tarecodigos, $actaestacts, $actaestants, $actafechingn, $usuacodigos, $orgacodigos, $actaactivas);	 
		}
		return $osbSql;
	}
	//---------------------------------------------
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	*  Obtiene el sql necesario para activar un acta
	* * @param string $isbOrdenumeros Cadena con el id de la orden
	* @param array $ircData Arreglo con los codigos de las actas a desactivar
	* @return string $osbResult adena con el sql que desactivar el acta
	* @author freina <freina@parquesoft.com>
	* @date 25-Jul-2005 11:58
	* @location Cali-Colombia
	*/
	function DetermineReopenOrden($isbOrdenumeros,$ircData){
		
		settype($rcTmp,"array");
		settype($osbResult,"string");
		settype($sbActacodigos,"string");
		
		$osbResult = false;
		if($isbOrdenumeros && $ircData){
			$rcTmp = $this->gatewayext->getActaFinalizedByOrdenumeros($isbOrdenumeros);
			if($rcTmp){
				$sbActacodigos = $rcTmp[0]["actacodigos"];
				if(in_array($sbActacodigos,$ircData)){
					$osbResult = true;
				} 
			}
		}
		return $osbResult;
	}
}
?>