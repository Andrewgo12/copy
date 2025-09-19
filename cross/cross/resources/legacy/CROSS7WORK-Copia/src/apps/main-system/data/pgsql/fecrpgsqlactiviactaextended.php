<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeCrPgsqlActiviactaExtended {
	var $consult;
	var $objdb;
	function FeCrPgsqlActiviactaExtended() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	function addArrayActiviacta($rcActiviacta, $actanumeros, $acemnumeros, $nuStart=1) {
		if(!is_array($rcActiviacta))
			return false;
		foreach($rcActiviacta as $acticodigos){
			$rcSql[] = 'INSERT INTO "activiacta" ("acaccodigon","actacodigos","acemcodigos","acticodigos") VALUES('.$nuStart.',\''.$actanumeros.'\',\''.$acemnumeros.'\',\''.$acticodigos.'\')';
			$nuStart++;
		}
		$this->objdb->fncadoexecutetrans($rcSql);
		return $this->objdb->objresult;
	}
	
	function ObtainActivitiesDetail($acemcodigos) {
		$sbsql = 'SELECT  "activiacta"."acticodigos", "actividad"."actinombres" ' .
				'FROM "activiacta", "actividad" ' .
				'WHERE "activiacta"."acemcodigos"=\''.$acemcodigos.'\' AND "activiacta"."acticodigos"="actividad"."acticodigos"';
		$this->objdb->fncadoselect($sbsql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
}
?>