<?php 		
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeGePgsqlDetaconfformExtended {
	var $consult;
	var $objdb;

	function FeGePgsqlDetaconfformExtended() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}

	function getByIdCofocodigon($cofocodigon) {
		$sql = 'SELECT * FROM "detaconfform" WHERE "cofocodigon"='.$cofocodigon.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Detaconfform
?>