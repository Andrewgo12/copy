<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeCuPgsqlContratoExtended {
	var $consult;
	var $objdb;
	function FeCuPgsqlContratoExtended() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	function getAllActiveContrato() {
		$sbestado = Application :: getConstant("REG_ACT");
		$sql = 'SELECT * FROM "contrato" WHERE "contestados"=\''.$sbestado.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Contrato
?>