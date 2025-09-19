<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeCrPgsqlOrdenempresa_logExtended {
	var $consult;
	var $objdb;

	function FeCrPgsqlOrdenempresa_logExtended() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}

	function addOrdenempresa_logSql($orlonumeron, $ircdata) {
		settype($sbsql,"string");
		settype($sbindex,"string");
		settype($sbtmp,"string");
		
		$sbsql = 'INSERT INTO "ordenempresa_log" ("orlonumeron"';
		foreach($ircdata as $sbindex => $sbtmp){
			$sbsql .= ',"'.strtolower($sbindex).'"';
		}
		$sbsql .= ') VALUES('.$orlonumeron.'';
		foreach($ircdata as $sbindex => $sbtmp){
			$sbsql .= ','.$sbtmp;
		}
		$sbsql .= ")";
		return $sbsql;
	}
	
	function addOrdenempresa_logSqlEsp($orlonumeron, $isbdata) {
		settype($sbsql,"string");
		$sbsql = 'INSERT INTO "ordenempresa_log" VALUES('.$orlonumeron.','.$isbdata;
		$sbsql .= ')';
		return $sbsql;
	}
	
	function getOrdenempresa_log($ircOrlonumeron) {
		
		settype($sbSql,"string");
		settype($sbTmp,"string");
		
		if($ircOrlonumeron){
			$sbTmp = implode(",",$ircOrlonumeron);
			$sbSql = 'SELECT * FROM "ordenempresa_log" WHERE "orlonumeron" IN('.$sbTmp.')';
			$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
			return $this->objdb->rcresult;
		}
		return null;
	}
} //End of Class Ordenempresa_log
?>