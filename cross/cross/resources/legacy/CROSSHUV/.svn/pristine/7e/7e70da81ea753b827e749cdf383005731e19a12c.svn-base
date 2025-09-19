<?php 		
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeCrPgsqlAnexosExtended {
	var $consult;
	var $objdb;

	function FeCrPgsqlAnexosExtended() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}

	function addAnexosSql($ordenumeros, $anexcodigon, $anexnombarch, $anexfechingn, $usuacodigos) {
		$sbsql = 'INSERT INTO "anexos" VALUES(\''.$ordenumeros.'\','.$anexcodigon.' ,\''.$anexnombarch.'\','.$anexfechingn.' ,\''.$usuacodigos.'\')';
		return  $sbsql;
	}
	
	function deleteAnexosSql($ordenumeros, $anexcodigon) {
		$sbsql = 'DELETE FROM "anexos" WHERE "ordenumeros"=\''.$ordenumeros.'\' AND "anexcodigon"='.$anexcodigon.' ';
		return $sbsql; 
	}
	
	function deleteAnexosByordenumeros($ordenumeros) {
		$sbsql = 'DELETE FROM "anexos" WHERE "ordenumeros"=\''.$ordenumeros.'\'';
		return $sbsql; 
	}
} //End of Class Anexos
?>