<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeCrPgsqlOrden_logExtended {
	var $consult;
	var $objdb;

	function FeCrPgsqlOrden_logExtended() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}

	function addOrden_logSql($orlonumeron, $orlousuarios, $orlofecingd, $ircdata) {
		settype($sbsql,"string");
		settype($sbindex,"string");
		settype($sbtmp,"string");
		$sbsql = 'INSERT INTO "orden_log" VALUES('.$orlonumeron.',\''.$orlousuarios.'\', '.$orlofecingd.' ';
		foreach($ircdata as $sbindex => $sbtmp){
			$sbsql .= ','.$sbtmp;
		}
		$sbsql .= ")";
		return $sbsql;
	}
	
	function addOrden_logSqlEsp($orlonumeron, $orlousuarios, $orlofecingd, $isbdata) {
		settype($sbsql,"string");
		$sbsql = 'INSERT INTO "orden_log" VALUES('.$orlonumeron.',\''.$orlousuarios.'\', '.$orlofecingd.' ,'.$isbdata;
		$sbsql .= ')';
		return $sbsql;
	}
	
	function getOrden_log($isbOrdenumeros) {
		
		settype($sbSql,"string");
		
		$sbSql = 'SELECT * FROM "orden_log" WHERE "ordenumeros"=\''.$isbOrdenumeros.'\' ORDER BY "orlofecingd"';
		$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Orden_log
?>