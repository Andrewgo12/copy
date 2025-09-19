<?php
class FeGeGetValuesManager {

	function autoReference($sbSqlId, $rcParams) {

		settype($objGateway, "object");
		settype($rcData, "array");
		settype($rcResult, "array");
		settype($sbTmp, "string");
		settype($sbValue, "string");

		$objGateway = Application :: getDataGateway("SqlExtended");

		//Arma el vector de los parametros
		foreach ($rcParams as $sbTmp => $sbValue) {
			$rcData[$sbTmp] = array ($sbValue);
		}
		//Ejecuta el sql indicado
		$rcResult = $objGateway->getAutoReference($sbSqlId, $rcData);
		return $rcResult;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	*  Obtiene los valores seleccionados de las dependencias fisicas
	* @param array $rcParams Arreglo con los parametros
	* @return array $rcbResult Arreglo con la dupla valor,label
	* @author freina <freina@parquesoft.com>
	* @date 21-Aug-2006 12:46
	* @location Cali-Colombia
	*/
	function selectedValues($sbSqlId, $rcParams) {

		settype($objManager, "object");
		settype($rcResult, "array");
		settype($rcTmp, "array");
		settype($rcValue, "array");
		settype($sbIndex, "string");

		if ($rcParams["orgacodigos"]) {
			$objManager = Application :: getDomainController('TransferdependenciesManager');
			$rcTmp = $objManager->getTransferdependencies();

			if ($rcTmp) {
				foreach ($rcTmp as $sbIndex => $rcValue) {
					if ($sbIndex == $rcParams["orgacodigos"]) {
						$rcResult = $rcValue;
						break;
					}
				}
			}
		}

		return $rcResult;
	}
}
?>