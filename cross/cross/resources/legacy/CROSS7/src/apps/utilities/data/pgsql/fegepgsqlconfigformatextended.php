<?php 		
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeGePgsqlConfigformatExtended {
	var $consult;
	var $objdb;

	function FeGePgsqlConfigformatExtended() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}

	function getByIdFocacodigos($focacodigos) {
		$sql = 'SELECT * FROM "configformat" WHERE "focacodigos"=\''.$focacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Configformat
?>