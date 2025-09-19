<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeCuPgsqlTipocontrato {
	var $consult;
	var $objdb;
	function FeCuPgsqlTipocontrato() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	function existTipocontrato($ticocodigos) {
		$sql = 'SELECT * FROM "tipocontrato" WHERE "ticocodigos"=\''.$ticocodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}
	function addTipocontrato($ticocodigos, $ticonombres, $ticodescrips, $ticoactivos) {
		$sql = 'INSERT INTO "tipocontrato" ("ticocodigos","ticonombres","ticodescrips","ticoactivos")'
		.' VALUES(\''.$ticocodigos.'\',\''.$ticonombres.'\',\''.$ticodescrips.'\',\''.$ticoactivos.'\')';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function updateTipocontrato($ticocodigos, $ticonombres, $ticodescrips, $ticoactivos) {
		$sql = 'UPDATE "tipocontrato" SET "ticonombres"=\''.$ticonombres.'\',"ticodescrips"=\''.$ticodescrips.'\',"ticoactivos"=\''.$ticoactivos.'\' WHERE "ticocodigos"=\''.$ticocodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function deleteTipocontrato($ticocodigos) {
		$sql = 'DELETE FROM "tipocontrato" WHERE "ticocodigos"=\''.$ticocodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function getByIdTipocontrato($ticocodigos) {
		$sql = 'SELECT * FROM "tipocontrato" WHERE "ticocodigos"=\''.$ticocodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getAllTipocontrato() {
		$sql = 'SELECT * FROM "tipocontrato"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getTicocodigos($ticocodigos) {
		$sql = 'SELECT "ticocodigos" FROM "tipocontrato" WHERE "ticocodigos"=\''.$ticocodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getTiconombres($ticocodigos) {
		$sql = 'SELECT "ticonombres" FROM "tipocontrato" WHERE "ticocodigos"=\''.$ticocodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getTicodescrips($ticocodigos) {
		$sql = 'SELECT "ticodescrips" FROM "tipocontrato" WHERE "ticocodigos"=\''.$ticocodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getTicoactivos($ticocodigos) {
		$sql = 'SELECT "ticoactivos" FROM "tipocontrato" WHERE "ticocodigos"=\''.$ticocodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Tipocontrato
?>