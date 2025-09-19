<?php
//Paquete de conexion a bases de datos
include_once("pkdatabases.php");
class FeScPgsqlEstadoentrada
{
	var $consult;
	var $objdb;

	function FeScPgsqlEstadoentrada(){
		$config = ASAP::getStaticProperty('Application','config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}

	function existEstadoentrada($esencodigos){
		$sql = 'SELECT * FROM "estadoentrada" WHERE "esencodigos"='.$esencodigos;
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}


	function getByIdEstadoentrada($esencodigos){
		$sql='SELECT * FROM "estadoentrada" WHERE "esencodigos"='.$esencodigos;
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getAllEstadoentrada(){
		$sql='SELECT * FROM "estadoentrada" ORDER BY "esennombres"';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Estadoentrada
?>