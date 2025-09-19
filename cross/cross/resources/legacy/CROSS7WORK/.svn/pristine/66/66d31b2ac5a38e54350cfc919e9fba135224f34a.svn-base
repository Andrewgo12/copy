<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeWFPgsqlEstadoacta {
	var $consult;
	var $objdb;
	function FeWFPgsqlEstadoacta() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	function existEstadoacta($esaccodigos) {
		$sql = 'SELECT * FROM "estadoacta" WHERE "esaccodigos"=\''.$esaccodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}
	function addEstadoacta($esaccodigos, $esacnombres, $esacdescrips, $esacactivas) {
		$sql = 'INSERT INTO "estadoacta" ("esaccodigos","esacnombres","esacdescrips","esacactivas")'
		.' VALUES(\''.$esaccodigos.'\',\''.$esacnombres.'\',\''.$esacdescrips.'\',\''.$esacactivas.'\')';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function updateEstadoacta($esaccodigos, $esacnombres, $esacdescrips, $esacactivas) {
		$sql = 'UPDATE "estadoacta" SET "esacnombres"=\''.$esacnombres.'\',"esacdescrips"=\''.$esacdescrips.'\',"esacactivas"=\''.$esacactivas.'\' WHERE "esaccodigos"=\''.$esaccodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function deleteEstadoacta($esaccodigos) {
		$sql = 'DELETE FROM "estadoacta" WHERE "esaccodigos"=\''.$esaccodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function getByIdEstadoacta($esaccodigos) {
		$sql = 'SELECT * FROM "estadoacta" WHERE "esaccodigos"=\''.$esaccodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getAllEstadoacta() {
		$sql = 'SELECT * FROM "estadoacta"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getEsaccodigos($esaccodigos) {
		$sql = 'SELECT "esaccodigos" FROM "estadoacta" WHERE "esaccodigos"=\''.$esaccodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getEsacnombres($esaccodigos) {
		$sql = 'SELECT "esacnombres" FROM "estadoacta" WHERE "esaccodigos"=\''.$esaccodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getEsacdescrips($esaccodigos) {
		$sql = 'SELECT "esacdescrips" FROM "estadoacta" WHERE "esaccodigos"=\''.$esaccodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getEsacactivas($esaccodigos) {
		$sql = 'SELECT "esacactivas" FROM "estadoacta" WHERE "esaccodigos"=\''.$esaccodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Estadoacta
?>