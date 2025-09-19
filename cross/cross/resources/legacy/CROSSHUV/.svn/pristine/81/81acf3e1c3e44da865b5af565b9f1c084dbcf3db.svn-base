<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeWFPgsqlDetallvalidaExtended {
	var $consult;
	var $objdb;
	function FeWFPgsqlDetallvalidaExtended() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	function getByIdOrderDetallvalida($valicodigos, $order) {
		
		settype($rcTmp, "array");
		settype($rcOrder, "array");
		settype($sbValue, "string");
		settype($sbPos, "string");
		
		$rcTmp = explode(",", $order);
		foreach ($rcTmp as $sbValue) {
			$sbPos = strpos($sbValue, ".");
			if (!($sbPos === false)) {
				$sbValue = preg_replace("#((([a-z]|[0-9])*)\.(([a-z]|[0-9])*))#", '"$2"."$4"', $sbValue);
			} else {
				$sbValue = '"'.$sbValue.'"';
			}
			$rcOrder[] = $sbValue;
		}
		if($rcOrder){
			$order = implode(",",$rcOrder);
		}
		
		$sql = 'SELECT * FROM "detallvalida" WHERE "valicodigos"=\''.$valicodigos.'\' ORDER BY '.$order;
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Detallvalida
?>