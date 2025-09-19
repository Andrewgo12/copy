<?php  
class FeCrListadoOrdenManager {
	function FeCrListadoOrdenManager() {
		$this->gateway = Application :: getDataGateway("SqlExtended");
	}

	function getListadoOrden($rcParams,$rcParamsDate,$rcOrder, $rcKeys, $children = null, $tareacc = null){
		
		settype($rcView,"array");
		settype($rcReturn,"array");
		
		//Determina los indices que se exigen para el ordenamiemto
        if(is_array($rcOrder) && $rcOrder){
			$rcView = $rcOrder;
		}else{
			$rcView = $rcKeys;
			$rcOrder = null;
		}
		
		if(sizeof($rcParams) == 0){
			$rcParams = null;
		}
		
		$rcReturn = $this->gateway->getListadoOrdenes($rcParams,$rcParamsDate,$rcView,$rcOrder, $children, $tareacc);
		$this->nuTotal = $this->gateway->nuTotal;
		$this->nuOffset = $this->gateway->nuOffset;
		$this->sql = $this->gateway->sql;
		return $rcReturn;
	}
	function UnsetRequest() {
		settype($sbKey,"string");
		settype($sbValue,"string");
		foreach($_REQUEST as $sbKey => $sbValue){
			if(strpos($sbKey,"__")!==false){
				unset($_REQUEST[$sbKey]);
			}if(strpos($sbKey,"check")!==false){
				unset($_REQUEST[$sbKey]);
			}
		}
		unset($_REQUEST["orgacodigos_desc"]);
		unset($_REQUEST["ordenempresa_locacodigos_desc"]);
		unset($_REQUEST["contidentis_desc"]);
		unset($_REQUEST["children"]);
		unset($_REQUEST["orden_ordesitiejes_desc"]);
		return true;
	}
}
?>	
 	