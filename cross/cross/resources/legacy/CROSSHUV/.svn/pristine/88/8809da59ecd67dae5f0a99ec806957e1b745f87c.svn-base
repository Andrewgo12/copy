<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeWFPgsqlValidacionExtended {
	var $objdb;
	function FeWFPgsqlValidacionExtended() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	function getRowValidacion($proccodigos, $tarecodigos, $valiestacts) {
		$sql = 'SELECT 
		    				* 
		    			FROM 
		    				"validacion" 
		    			WHERE 
		    				"proccodigos"=\''.$proccodigos.'\' AND 
		    				"tarecodigos"=\''.$tarecodigos.'\' AND 
		    				"valiestacts"=\''.$valiestacts.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Validacion
?>