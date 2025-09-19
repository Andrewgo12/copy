<?php
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeCrPgsqlTipoorden {
	var $consult;
	var $objdb;
	function FeCrPgsqlTipoorden() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	function existTipoorden($tiorcodigos) {
		$sql = 'SELECT * FROM "tipoorden" WHERE "tiorcodigos"=\''.$tiorcodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}
	function addTipoorden($tiorcodigos, $tiornombres, $tiordescrips, $tioractivos, $tiorpeson) {
		$sql = 'INSERT INTO "tipoorden" ("tiorcodigos","tiornombres","tiordescrips","tioractivos","tiorpeson")'
		.' VALUES(\''.$tiorcodigos.'\',\''.$tiornombres.'\',\''.$tiordescrips.'\',\''.$tioractivos.'\','.$tiorpeson.')';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function updateTipoorden($tiorcodigos, $tiornombres, $tiordescrips, $tioractivos, $tiorpeson) {
		$sql = 'UPDATE "tipoorden" SET "tiornombres"=\''.$tiornombres.'\',"tiordescrips"=\''
		.$tiordescrips.'\',"tioractivos"=\''.$tioractivos.'\',"tiorpeson"='.$tiorpeson
		.' WHERE "tiorcodigos"=\''.$tiorcodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function deleteTipoorden($tiorcodigos) {
		$sql = 'DELETE FROM "tipoorden" WHERE "tiorcodigos"=\''.$tiorcodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function getByIdTipoorden($tiorcodigos) {
		$sql = 'SELECT * FROM "tipoorden" WHERE "tiorcodigos"=\''.$tiorcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getAllTipoorden() {
		$sql = 'SELECT * FROM "tipoorden" ORDER BY "tiornombres"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getTiorcodigos($tiorcodigos) {
		$sql = 'SELECT "tiorcodigos" FROM "tipoorden" WHERE "tiorcodigos"=\''.$tiorcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getTiornombres($tiorcodigos) {
		$sql = 'SELECT "tiornombres" FROM "tipoorden" WHERE "tiorcodigos"=\''.$tiorcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getTiordescrips($tiorcodigos) {
		$sql = 'SELECT "tiorcodigos","tiordescrips" FROM "tipoorden" WHERE "tiorcodigos"=\''.$tiorcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getTioractivos($tiorcodigos) {
		$sql = 'SELECT "tioractivos" FROM "tipoorden" WHERE "tiorcodigos"=\''.$tiorcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Tipoorden
?>