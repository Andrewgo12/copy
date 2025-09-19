<?php  
class FePrPermisionsManager {
	var $gateway;
	function FePrPermisionsManager() {
		$this->gateway = Application :: getDataGateway("permisions");
	}
	function addPermisions($profcodigos, $applcodigos, $commnombres) {
		if ($this->gateway->existPermisions($profcodigos, $applcodigos, $commnombres) == 0) {
			$this->gateway->addPermisions($profcodigos, $applcodigos, $commnombres);
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}
	function updatePermisions($profcodigos, $applcodigos, $commnombres) {
		if ($this->gateway->existPermisions($profcodigos, $applcodigos, $commnombres) == 1) {
			$this->gateway->updatePermisions($profcodigos, $applcodigos, $commnombres);
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function deletePermisions($profcodigos, $applcodigos, $commnombres) {
		if ($this->gateway->existPermisions($profcodigos, $applcodigos, $commnombres) == 1) {
			$this->gateway->deletePermisions($profcodigos, $applcodigos, $commnombres);
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function getByIdPermisions($profcodigos, $applcodigos, $commnombres) {
		$data_permisions = $this->gateway->getByIdPermisions($profcodigos, $applcodigos, $commnombres);
		return $data_permisions;
	}
	function getAllPermisions() {
		//$this->gateway->
	}
	function getByPermisions_fkey($profcodigos, $applcodigos) {
		$data_permisions = $this->gateway->getByPermisions_fkey($profcodigos, $applcodigos);
		return $data_permisions;
	}
	function getByPermisions_fkeycache($profcodigos, $applcodigos) {
		$data_permisions = $this->gateway->getByPermisions_fkeycache($profcodigos, $applcodigos);
		if(!is_array($data_permisions))
			return null;
		$nuCont = 0;
		foreach($data_permisions as $rcValue){
			$rcProfile[$nuCont] = $rcValue["commnombres"];
			$nuCont ++;		
		}
		return $rcProfile;
	}
	function getByPermisions_fkey1($commnombres, $applcodigos) {
		//$this->gateway->
	}
	
	function UnsetRequest() {
		unset ($_REQUEST["permisions__schecodigon"]);
		unset ($_REQUEST["permisions__profcodigos"]);
		unset ($_REQUEST["permisions__applcodigos"]);
		unset ($_REQUEST["permisions__commnombres"]);
	}
	
	function genSqlAdd($profcodigos, $applcodigos, $rcCommands,$schecodigon) 
	{
		//Genera los sql
		$rcSql = $this->gateway->genSqlAddPerm($profcodigos, $applcodigos, $rcCommands,$schecodigon);
		//Inserta los Sql
		$gatewayExt = Application :: getDataGateway("extend");
		return $gatewayExt->exeRcSql($rcSql);
	}
}
?>	
