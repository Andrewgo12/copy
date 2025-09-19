<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeCuPgsqlTipoidentifi {
	var $consult;
	var $objdb;
	function FeCuPgsqlTipoidentifi() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	function existTipoidentifi($tiidcodigos) {
		$sql = 'SELECT * FROM "tipoidentifi" WHERE "tiidcodigos"=\''.$tiidcodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}
	function addTipoidentifi($tiidcodigos, $tiidnombres, $tiiddescrips, $tiidactivas) {
		$sql = 'INSERT INTO "tipoidentifi" ("tiidcodigos","tiidnombres","tiiddescrips","tiidactivas")'
		.' VALUES(\''.$tiidcodigos.'\',\''.$tiidnombres.'\',\''.$tiiddescrips.'\',\''.$tiidactivas.'\')';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function updateTipoidentifi($tiidcodigos, $tiidnombres, $tiiddescrips, $tiidactivas) {
		$sql = 'UPDATE "tipoidentifi" SET "tiidnombres"=\''.$tiidnombres.'\',"tiiddescrips"=\''.$tiiddescrips.'\',"tiidactivas"=\''.$tiidactivas.'\' WHERE "tiidcodigos"=\''.$tiidcodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function deleteTipoidentifi($tiidcodigos) {
		$sql = 'DELETE FROM "tipoidentifi" WHERE "tiidcodigos"=\''.$tiidcodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function getByIdTipoidentifi($tiidcodigos) {
		$sql = 'SELECT * FROM "tipoidentifi" WHERE "tiidcodigos"=\''.$tiidcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getAllTipoidentifi() {
		$sql = 'SELECT * FROM "tipoidentifi"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getTiidcodigos($tiidcodigos) {
		$sql = 'SELECT "tiidcodigos" FROM "tipoidentifi" WHERE "tiidcodigos"=\''.$tiidcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getTiidnombres($tiidcodigos) {
		$sql = 'SELECT "tiidnombres" FROM "tipoidentifi" WHERE "tiidcodigos"=\''.$tiidcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getTiiddescrips($tiidcodigos) {
		$sql = 'SELECT "tiiddescrips" FROM "tipoidentifi" WHERE "tiidcodigos"=\''.$tiidcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getTiidactivas($tiidcodigos) {
		$sql = 'SELECT "tiidactivas" FROM "tipoidentifi" WHERE "tiidcodigos"=\''.$tiidcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Tipoidentifi
?>