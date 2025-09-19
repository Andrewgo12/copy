<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeWFPgsqlTareassincroExtended {
	var $connection;
	var $consult;
	var $objdb;
	function FeWFPgsqlTareassincroExtended() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	function get_Tasiindice($proccodigos, $tasisigtareas, $tasiacttareas, $tasiesactas) {
		$sql = 'SELECT "tasiindice","tasitipsincs" FROM "tareassincro" WHERE "proccodigos"=\''.
		$proccodigos.'\' AND "tasisigtareas"=\''.
		$tasisigtareas.'\' AND'.' "tasiacttareas"=\''.
		$tasiacttareas.'\' AND "tasiesactas"=\''.$tasiesactas.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getByItasiindice($tasiindice, $tasiacttareas) {
		$sql = 'SELECT * FROM "tareassincro" WHERE "tasiindice"='.$tasiindice.' AND'.' tasiacttareas<>\''.$tasiacttareas.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Tareassincro
?>