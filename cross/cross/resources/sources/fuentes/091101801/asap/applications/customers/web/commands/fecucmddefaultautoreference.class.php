<?php
require_once "JSON/JSON.php";
class FeCuCmdDefaultAutoreference {

	function execute() {

		settype($objGateway,"object");
		settype($rcResult,"array");
		settype($rcTmp,"array");
		settype($rcRow,"array");
		settype($sbSql,"string");
		settype($sbResult,"string");
		settype($sbResponse,"string");
		extract($_REQUEST);

		$objGateway = Application :: getDataGateway('sqlExtended');
		$sbSql = $objGateway->getSqlConsult($sqlid);

		//Elabora el filtro
		$objGateway->objdb->setField($labelField);
		$objGateway->objdb->setValue($value);
		$sbSql .= ' AND '. $objGateway->objdb->fncadogetlike().' ORDER BY "'.$labelField.'"';

		//Ejecuta la consulta
		$objGateway->objdb->fncadoselect($sbSql,FETCH_ASSOC);
		$rcResult = $objGateway->objdb->rcresult;

		if(is_array($rcResult) && $rcResult){
			foreach ($rcResult as $rcRow){
				$rcTmp[] = $rcRow[$valueField]."___".$rcRow[$labelField];
			}
				
			$sbResult = join(">>>",$rcTmp);
		}

		$objJson = new Services_JSON();
		$sbResponse = $objJson->encode($sbResult);

		die($sbResponse);
	}
}
?>