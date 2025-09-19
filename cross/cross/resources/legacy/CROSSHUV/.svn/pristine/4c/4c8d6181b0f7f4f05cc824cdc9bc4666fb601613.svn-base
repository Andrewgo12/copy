<?php 
   				
/**
* @Copyright 2004 FullEngine
*
* Clase manejadora para la tabla $tabla
* @author Ingravity 0.0.8
* @location Cali - Colombia
*/

class FePrProfilesManager {
	var $gateway;

	function FePrProfilesManager() {
		$this->gateway = Application :: getDataGateway("profiles");
	}

	function addProfiles($profcodigos, $applcodigos, $profnombres, $profdescrips) {
		if ($this->gateway->existProfiles($profcodigos, $applcodigos, $profnombres) == 0) {
			//Valida el nombre
			if ($this->gateway->nameExist($applcodigos, $profnombres) == 0)
				$this->gateway->addProfiles($profcodigos, $applcodigos, $profnombres, $profdescrips);
			else
				return 101;
			if ($this->gateway->consult == false)
				return 100;
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}

	function updateProfiles($profcodigos, $applcodigos, $profnombres, $profdescrips) {
		$rcProfile = $this->gateway->getByIdProfiles($profcodigos, $applcodigos);
		if (is_array($rcProfile)) {
			//Verifica si se ha cambiado el nombre
			if($rcProfile[0]["profnombres"] != $profnombres){
				if ($this->gateway->nameExist($applcodigos, $profnombres) > 0)
					return 101;
			}
			$this->gateway->updateProfiles($profcodigos, $applcodigos, $profnombres, $profdescrips);
			if ($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}

	function deleteProfiles($profcodigos, $applcodigos) {
		if ($this->gateway->existProfiles($profcodigos, $applcodigos) == 1) {
			$sqlExtend = Application :: getDataGateway("Extend");
			//Consulta si existen usuarios por perfil
			$rcAuth = $sqlExtend->getAuthByApplProf($profcodigos, $applcodigos);
			if(is_array($rcAuth))
				return 2;
			//Elimina los permisos
			$sqlExtend->deletePermisions($profcodigos, $applcodigos);
			$this->gateway->deleteProfiles($profcodigos, $applcodigos);
			if ($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}

	function getByIdProfiles($profcodigos, $applcodigos) {
		$data_profiles = $this->gateway->getByIdProfiles($profcodigos, $applcodigos);
		return $data_profiles;
	}

	function getAllProfiles() {
		//$this->gateway->
	}

	function getByProfiles_fkey($applcodigos) {
		return $this->gateway->getByProfiles_fkey($applcodigos);
	}

	function UnsetRequest() {
		unset ($_REQUEST["profiles__profcodigos"]);
		unset ($_REQUEST["profiles__applcodigos"]);
		unset ($_REQUEST["profiles__profnombres"]);
		unset ($_REQUEST["profiles__profdescrips"]);
	}

}

?>