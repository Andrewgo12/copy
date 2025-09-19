<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeCrPgsqlInfractor {
	var $consult;
	var $objdb;
	function FeCrPgsqlInfractor() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	
	function getAllInfractor() {
		$sbestado = Application :: getConstant("REG_ACT");
        $sql = 'SELECT * '.
                'FROM "infractor"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	
	function getByIdInfractor($infrcodigos) {
		$sql = 'SELECT * FROM "infractor" WHERE "infrcodigos"=\''.$infrcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Actaempresa
?>