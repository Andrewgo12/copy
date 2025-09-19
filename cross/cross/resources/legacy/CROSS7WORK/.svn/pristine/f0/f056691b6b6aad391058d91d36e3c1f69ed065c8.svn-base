<?php
class FeGeTransferdependenciesManager {

	function FeGeTransferdependenciesManager() {
	}

	/**
	* @copyright Copyright 2004 FullEngine
	*
	* Actualiza el serializado de dependencias fisicas
	* @param string $sbOrgacodigos Codigo de la dependencia que agrupa
	* @param array $rcData Arreglocon las dependencias agrupadas
	* @return integer con la senhal resultado de proceso 
	* @author freina<freina@parquesoft.com>
	* @date 21-Aug-2006 09:56
	* @location Cali - Colombia
	*/
	function updateTransferdependencies($sbOrgacodigos, $rcData) {

		settype($rcTmp, "array");
		settype($rcValue, "array");
		settype($sbIndex, "string");
		settype($sbResult, "string");

		$rcTmp = $this->getTransferdependencies();

		if ($rcTmp) {
			//se limpia el arreglo de la posible configuracion anterior
			foreach ($rcTmp as $sbIndex => $rcValue) {
				if ($sbIndex == $sbOrgacodigos) {
					unset ($rcTmp[$sbIndex]);
					break;
				}
			}
		}
		if ($rcData) {
			//se carga la nueva configuracion
			$rcTmp[$sbOrgacodigos] = $rcData;
		}

		if ($rcTmp) {
			$sbResult = $this->setTransferdependencies($rcTmp);
		} else {
			$sbResult = $this->deleteTransferdependencies();
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
	function deleteTransferdependencies() {

		settype($sbPath, "string");
		settype($sbResult, "string");

		$sbPath = Application :: getBaseDirectory().'/config/transferdependencies.data';
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
	function setTransferdependencies($rcData) {

		settype($sbPath, "string");
		settype($sbResult, "string");

		$sbPath = Application :: getBaseDirectory().'/config/transferdependencies.data';
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
	function getTransferdependencies() {
		settype($sbPath, "string");
		$sbPath = Application :: getBaseDirectory().'/config/transferdependencies.data';
		if (file_exists($sbPath)) {
			return Serializer :: load($sbPath);
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