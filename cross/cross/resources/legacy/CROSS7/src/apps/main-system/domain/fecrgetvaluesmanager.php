<?php
class FeCrGetValuesManager {
	
	function autoReference($sbSqlId, $rcParams) {
		
		settype($objGateway,"object");
		settype($rcData,"array");
		settype($rcResult,"array");
		settype($sbTmp,"string");
		settype($sbValue,"string");
		
		$objGateway = Application :: getDataGateway("SqlExtended");

		//Arma el vector de los parametros
		foreach ($rcParams as $sbTmp=>$sbValue) {
			$rcData[$sbTmp] = array ($sbValue);
		}
		//Ejecuta el sql indicado
		$rcResult = $objGateway->getAutoReference($sbSqlId, $rcData);
		return $rcResult;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	*  Obtiene los valores para cargar los combos
	* @param string $sbSqlId Identificador del sql en la compuerta
	* @param array $rcParams Arreglo con los parametros
	* @return array $rcbResult Arreglo con la dupla valor,label
	* @author freina <freina@parquesoft.com>
	* @date 17-Jul-2006 18:14
	* @location Cali-Colombia
	*/
	function selectValues($sbSqlId, $rcParams) {
		
		settype($objGateway, "object");
		settype($rcData, "array");
		settype($rcResult, "array");
		settype($sbTmp, "string");
		settype($sbValue, "string");

		$osbResult = "null";
		$objGateway = Application :: getDataGateway("SqlExtended");

		foreach ($rcParams as $sbTmp=>$sbValue) {
			$rcData[$sbTmp] = array ($sbValue);
		}

		//Ejecuta el sql indicado
		$rcResult = $objGateway->getLoadSelect($sbSqlId, $rcData);
		
		return $rcResult;
	}
}
?>