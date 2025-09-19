<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeCuPgsqlEstadoclient {
	var $consult;
	var $objdb;
	function FeCuPgsqlEstadoclient() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	function existEstadoclient($esclcodigos) {
		$sql = 'SELECT * FROM "estadoclient" WHERE "esclcodigos"=\''.$esclcodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}
	function addEstadoclient($esclcodigos, $esclnombres, $escldescrips, $esclactivos) {
		$sql = 'INSERT INTO "estadoclient" ("esclcodigos","esclnombres","escldescrips")'
		.' VALUES(\''.$esclcodigos.'\',\''.$esclnombres.'\',\''.$escldescrips.'\')';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function updateEstadoclient($esclcodigos, $esclnombres, $escldescrips, $esclactivos) {
		$sql = 'UPDATE "estadoclient" SET "esclnombres"=\''.$esclnombres.'\',"escldescrips"=\''.$escldescrips.'\',"esclactivos"=\''.$esclactivos.'\' WHERE "esclcodigos"=\''.$esclcodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function deleteEstadoclient($esclcodigos) {
		$sql = 'DELETE FROM "estadoclient" WHERE "esclcodigos"=\''.$esclcodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function getByIdEstadoclient($esclcodigos) {
		$sql = 'SELECT * FROM "estadoclient" WHERE "esclcodigos"=\''.$esclcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getAllEstadoclient() {
		$sql = 'SELECT * FROM "estadoclient"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getEsclcodigos($esclcodigos) {
		$sql = 'SELECT "esclcodigos" FROM "estadoclient" WHERE "esclcodigos"=\''.$esclcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getEsclnombres($esclcodigos) {
		$sql = 'SELECT "esclnombres" FROM "estadoclient" WHERE "esclcodigos"=\''.$esclcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getEscldescrips($esclcodigos) {
		$sql = 'SELECT "escldescrips" FROM "estadoclient" WHERE "esclcodigos"=\''.$esclcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getEsclactivos($esclcodigos) {
		$sql = 'SELECT "esclactivos" FROM "estadoclient" WHERE "esclcodigos"=\''.$esclcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Estadoclient
?>