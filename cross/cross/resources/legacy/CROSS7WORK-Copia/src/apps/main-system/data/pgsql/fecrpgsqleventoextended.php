<?php		
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeCrPgsqlEventoExtended {
	var $consult;
	var $objdb;

	function FeCrPgsqlEventoExtended() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}

	function getAllActiveEvento($isbtiorcodigos) {
		
		settype($sbstate,"string");
		settype($sbtmp,"string");
		settype($osbsql,"string");
		
		$sbstate = Application :: getConstant("REG_ACT");
		if($isbtiorcodigos){
			$sbtmp = " AND \"tiorcodigos\" ='".$isbtiorcodigos."'";
		}
		$osbsql = 'SELECT * FROM "evento" WHERE "evenactivos"=\''.$sbstate.'\''.$sbtmp;
		return $osbsql;
	}
	
	function getActiveEvento($isbtiorcodigos,$isbevencodigos) {
		
		settype($sbstate,"string");
		settype($sbtmp,"string");
		settype($sbsql,"string");
		
		$sbstate = Application :: getConstant("REG_ACT");
		if($isbtiorcodigos){
			$sbtmp = " AND \"tiorcodigos\" ='".$isbtiorcodigos."'";
		}
		$sbsql = 'SELECT "evennombres" FROM "evento" WHERE "evenactivos"=\''.$sbstate.'\' AND "evencodigos"=\''.$isbevencodigos.'\''.$sbtmp;
		$this->objdb->fncadoselect($sbsql, FETCH_NUM);
		return $this->objdb->rcresult;
	}
} //End of Class Evento
?>