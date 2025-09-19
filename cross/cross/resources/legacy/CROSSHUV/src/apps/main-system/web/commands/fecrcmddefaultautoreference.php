<?php
require_once "JSON/JSON.php";
class FeCrCmdDefaultAutoreference {

	function execute() {
		
		extract($_REQUEST);
		settype($sbresult,"string");
		
		$gateway = Application :: getDataGateway('sqlExtended');
		$sql = $gateway->getSqlConsult($sqlid);
		
		//Elabora el filtro
		if($sqlid=="prospecto") {
			if(isset($tiorcodigos) && strlen($tiorcodigos)>0){
				$sql .= ' AND tiorcodigos=\''.$tiorcodigos.'\'';
			}
			$gateway->objdb->setField($valueField);
			$gateway->objdb->setValue($value);
			$sql .= ' AND '. $gateway->objdb->fncadogetlike().' ORDER BY 2';
		}else{
			if($labelField=="contindentis" || $labelField=="paciindentis"){
				$sql .= ' AND "'.$labelField.'"=\''.$value.'\' ORDER BY 2';
			}else{
				$gateway->objdb->setField($labelField);
				$gateway->objdb->setValue($value);
				$sql .= ' AND '. $gateway->objdb->fncadogetlike().' ORDER BY 2';	
			}	
		}
		
		//Ejecuta la consulta
		$gateway->objdb->fncadoselect($sql,FETCH_ASSOC);
		$result = $gateway->objdb->rcresult;

		if(is_array($result) && $result){
			foreach ($result as $row){
				$rcTmp[] = $row[$valueField]."___".$row[$labelField];	
			}
			$sbresult = join(">>>",$rcTmp);	
		}
		
		$objJson = new Services_JSON();
		$sbResponse = $objJson->encode($sbresult);
		
		die($sbResponse);
	}
}
?>