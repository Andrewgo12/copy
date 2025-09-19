<?php
class FeHrPhysicaldependenciesManager {

	function FeHrPhysicaldependenciesManager() {
	}

	/**
	* @copyright Copyright 2004 © FullEngine
	*
	* Actualiza el serializado de dependencias fisicas
	* @param string $sbOrgacodigos Codigo de la dependencia que agrupa
	* @param array $rcData Arreglocon las dependencias agrupadas
	* @return integer con la señal resultado de proceso 
	* @author freina<freina@parquesoft.com>
	* @date 21-Aug-2006 09:56
	* @location Cali - Colombia
	*/
	function updatePhysicaldependencies($sbOrgacodigos, $rcData) {

		settype($rcTmp, "array");
		settype($sbValue, "string");
		settype($sbIndex, "string");
		settype($sbResult, "string");
		settype($sbDefault,"string");

		$rcTmp = $this->getPhysicaldependencies();

		if (is_array($rcTmp) && $rcTmp) {
			//se limpia el arreglo de la posible configuracion anterior
			foreach ($rcTmp as $sbIndex => $sbValue) {
				if ($sbValue == $sbOrgacodigos) {
					unset ($rcTmp[$sbIndex]);
				}
			}
		}
		if (is_array($rcData) && $rcData) {
			//se carga la nueva configuracion
			foreach ($rcData as $sbIndex => $sbValue) {
				$rcTmp[$sbValue] = $sbOrgacodigos;
			}
		}else{
			$sbDefault = Application :: getConstant("DEP_DEFAULT");
			$rcTmp[$sbDefault] = $sbOrgacodigos;
		}

		if (is_array($rcTmp) && $rcTmp) {
			$sbResult = $this->setPhysicaldependencies($rcTmp);
		} else {
			$sbResult = $this->deletePhysicaldependencies();
		}
		$this->UnsetRequest();
		return $sbResult;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Elimina el serializado la configuracion de dependencias fisicas
	* @return integer signal
	* @author freina<freina@parquesoft.com>
	* @date 21-Aug-2006 10:22
	* @location Cali-Colombia
	*/
	function deletePhysicaldependencies() {

		settype($sbPath, "string");
		settype($sbResult, "string");

		$sbPath = Application :: getBaseDirectory().'/config/physicaldependencies.data';
		if (file_exists($sbPath)) {
			unlink($sbPath);
		}
		return 3;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Escribe en un archivo serializado la configuracion de dependencias fisicas
	* @param array $rcData arreglo con la configuracion
	* @return integer signal
	* @author freina<freina@parquesoft.com>
	* @date 21-Aug-2006 10:18
	* @location Cali-Colombia
	*/
	function setPhysicaldependencies($rcData) {

		settype($sbPath, "string");
		settype($sbResult, "string");

		$sbPath = Application :: getBaseDirectory().'/config/physicaldependencies.data';
		$sbResult = & Serializer :: save($rcData, $sbPath);
		if (PEAR :: isError($sbResult)) {
			return 100;
		}
		return 3;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Obtiene las dependencias fisicas configuradas
	* @return array
	* @author feina<freina@parquesoft.com>
	* @date 21-Aug-2006 10:07
	* @location Cali-Colombia
	*/
	function getPhysicaldependencies() {
		
		settype($rcData, "array");
		settype($sbPath, "string");
		settype($sbIndex, "string");
		settype($sbValue, "string");
		
		$sbPath = Application :: getBaseDirectory().'/config/physicaldependencies.data';
		if (file_exists($sbPath)) {
			$rcData = Serializer :: load($sbPath);
			if(is_array($rcData) && $rcData){
				foreach ($rcData as $sbIndex=>$sbValue){
					$rcData[$sbIndex] = (string) $sbValue;
				}
			}
			return $rcData;
		} else {
			return null;
		}
	}

	function UnsetRequest() {
		unset ($_REQUEST["orgacodigos"]);
		unset ($_REQUEST["selTipoCampos"]);
		unset ($_REQUEST["selected_opt"]);
		unset ($_REQUEST["organombres"]);
	}
}
?>	