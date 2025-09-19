<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeHrPgsqlTipoorgani {
	var $consult;
	var $objdb;
	function FeHrPgsqlTipoorgani() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	function existTipoorgani($tiorcodigos) {
		$sql = 'SELECT * FROM "tipoorgani" WHERE "tiorcodigos"=\''.$tiorcodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}
	function addTipoorgani($tiorcodigos, $tiornombres, $tiordesc, $tiorcodpadrs, $tioractivos) {
		$sql = 'INSERT INTO "tipoorgani" ("tiorcodigos","tiornombres","tiordesc","tiorcodpadrs","tioractivos")'
		.' VALUES(\''.$tiorcodigos.'\',\''.$tiornombres.'\',\''.$tiordesc.'\',\''.$tiorcodpadrs.'\',\''.$tioractivos.'\')';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function updateTipoorgani($tiorcodigos, $tiornombres, $tiordesc, $tiorcodpadrs, $tioractivos) {
		$sql = 'UPDATE "tipoorgani" SET "tiornombres"=\''.$tiornombres.'\',"tiordesc"=\''.$tiordesc.'\',"tiorcodpadrs"=\''.$tiorcodpadrs.'\',"tioractivos"=\''.$tioractivos.'\' WHERE "tiorcodigos"=\''.$tiorcodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function deleteTipoorgani($tiorcodigos) {
		$sql = 'DELETE FROM "tipoorgani" WHERE "tiorcodigos"=\''.$tiorcodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function getByIdTipoorgani($tiorcodigos) {
		$sql = 'SELECT * FROM "tipoorgani" WHERE "tiorcodigos"=\''.$tiorcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getAllTipoorgani() {
		$sql = 'SELECT * FROM "tipoorgani"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getTiorcodigos($tiorcodigos) {
		$sql = 'SELECT "tiorcodigos" FROM "tipoorgani" WHERE "tiorcodigos"=\''.$tiorcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getTiornombres($tiorcodigos) {
		$sql = 'SELECT "tiornombres" FROM "tipoorgani" WHERE "tiorcodigos"=\''.$tiorcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getTiordesc($tiorcodigos) {
		$sql = 'SELECT "tiordesc" FROM "tipoorgani" WHERE "tiorcodigos"=\''.$tiorcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getTiorcodpadrs($tiorcodigos) {
		$sql = 'SELECT "tiorcodpadrs" FROM "tipoorgani" WHERE "tiorcodigos"=\''.$tiorcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getTioractivos($tiorcodigos) {
		$sql = 'SELECT "tioractivos" FROM "tipoorgani" WHERE "tiorcodigos"=\''.$tiorcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Tipoorgani
?>