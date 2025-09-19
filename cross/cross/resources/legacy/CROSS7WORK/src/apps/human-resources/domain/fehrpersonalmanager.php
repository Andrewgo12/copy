<?php
class FeHrPersonalManager {
	var $gateway;
	function FeHrPersonalManager() {
		$this->gateway = Application :: getDataGateway("personal");
		$this->gatewayex = Application :: getDataGateway("personalExtended");
	}
	function addPersonal($perscodigos, $persidentifs, $persnombres, $persapell1s, 
	$persapell2s, $persusrnams, $cargcodigos, $persprofecs, $perstelefo1, 
	$perstelefo2, $locacodigos, $persdireccis, $persemails, $perscontacts, 
	$perstelcont, $persestadoc) {
		if ($this->gateway->existPersonal($perscodigos) == 0) {
			if ($this->gatewayex->existPersonal($persidentifs) == 0) {
				if ($this->gatewayex->existPersonalByPersusrnams($persusrnams) == 0) {
					$this->gateway->addPersonal($perscodigos, $persidentifs, $persnombres, 
					$persapell1s, $persapell2s, $persusrnams, $cargcodigos, $persprofecs, 
					$perstelefo1, $perstelefo2, $locacodigos, $persdireccis, $persemails, 
					$perscontacts, $perstelcont, $persestadoc);
					$this->UnsetRequest();
				return 3;
				}else{
					return 20;
				}
			}else{
				return 19;
			}
		} else {
			return 1;
		}
	}
	function updatePersonal($perscodigos, $persidentifs, $persnombres, $persapell1s, 
	$persapell2s, $persusrnams, $cargcodigos, $persprofecs, $perstelefo1, $perstelefo2, 
	$locacodigos, $persdireccis, $persemails, $perscontacts, $perstelcont, $persestadoc) {
		settype($rcTmp,"array");
		if ($this->gateway->existPersonal($perscodigos) == 1) {
			//se valida que la identificacion no se este utilizando bajo otro codigo
			$rcTmp = $this->gatewayex->getByIdPersonal($persidentifs);
			if($rcTmp){
				if($rcTmp[0]["perscodigos"]!=$perscodigos){
					return 19;
				}
			}
			//se valida que el usuario no este relacionado a otro empleado
			$rcTmp = $this->gatewayex->getByPersusrnams($persusrnams);
			if($rcTmp){
				if($rcTmp[0]["perscodigos"]!=$perscodigos){
					return 20;
				}
			}
			$this->gateway->updatePersonal($perscodigos, $persidentifs, $persnombres, 
			$persapell1s, $persapell2s, $persusrnams, $cargcodigos, $persprofecs, 
			$perstelefo1, $perstelefo2, $locacodigos, $persdireccis, $persemails, 
			$perscontacts, $perstelcont, $persestadoc);
			if ($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function deletePersonal($perscodigos) {
		if ($this->gateway->existPersonal($perscodigos) == 1) {
			$this->gateway->deletePersonal($perscodigos);
			if ($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function getByIdPersonal($perscodigos) {
		$data_personal = $this->gateway->getByIdPersonal($perscodigos);
		return $data_personal;
	}
	function getAllPersonal() {
		//$this->gateway->
	}
	function getByPersonal_fkey($cargcodigos) {
		//$this->gateway->
	}
	function UnsetRequest() {
		unset ($_REQUEST["personal__perscodigos"]);
		unset ($_REQUEST["personal__persidentifs"]);
		unset ($_REQUEST["personal__persnombres"]);
		unset ($_REQUEST["personal__persapell1s"]);
		unset ($_REQUEST["personal__persapell2s"]);
		unset ($_REQUEST["personal__persusrnams"]);
		unset ($_REQUEST["personal__cargcodigos"]);
		unset ($_REQUEST["personal__persprofecs"]);
		unset ($_REQUEST["personal__perstelefo1"]);
		unset ($_REQUEST["personal__perstelefo2"]);
		unset ($_REQUEST["personal__persdireccis"]);
		unset ($_REQUEST["personal__persemails"]);
		unset ($_REQUEST["personal__perscontacts"]);
		unset ($_REQUEST["personal__perstelcont"]);
		unset ($_REQUEST["personal__persestadoc"]);
		unset ($_REQUEST["personal__locacodigos"]);
		unset ($_REQUEST["personal_locacodigos_desc"]);
	}
}
?>