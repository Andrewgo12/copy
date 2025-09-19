<?php
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeCuPgsqlSegurisocial {
	var $consult;
	var $objdb;
	function FeCuPgsqlSegurisocial() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	function existSegurisocial($sesocodigos) {
		$sql = 'SELECT * FROM "segurisocial" WHERE "sesocodigos"=\''.$sesocodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}
	function addSegurisocial($sesocodigos, $sesonombres, $sesodescrips, $sesoactivos) {
		$sql = 'INSERT INTO "segurisocial" ("sesocodigos","sesonombres","sesodescrips","sesoactivos")'
		.' VALUES(\''.$sesocodigos.'\',\''.$sesonombres.'\',\''.$sesodescrips.'\',\''.$sesoactivos.'\')';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function updateSegurisocial($sesocodigos, $sesonombres, $sesodescrips, $sesoactivos) {
		$sql = 'UPDATE "segurisocial" SET "sesonombres"=\''.$sesonombres.'\',"sesodescrips"=\''
		.$sesodescrips.'\',"sesoactivos"=\''.$sesoactivos.'\''
		.' WHERE "sesocodigos"=\''.$sesocodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function deleteSegurisocial($sesocodigos) {
		$sql = 'DELETE FROM "segurisocial" WHERE "sesocodigos"=\''.$sesocodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function getByIdSegurisocial($sesocodigos) {
		$sql = 'SELECT * FROM "segurisocial" WHERE "sesocodigos"=\''.$sesocodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getAllSegurisocial() {
		$sql = 'SELECT * FROM "segurisocial" ORDER BY "sesonombres"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getSesocodigos($sesocodigos) {
		$sql = 'SELECT "sesocodigos" FROM "segurisocial" WHERE "sesocodigos"=\''.$sesocodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getSesonombres($sesocodigos) {
		$sql = 'SELECT "sesonombres" FROM "segurisocial" WHERE "sesocodigos"=\''.$sesocodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getSesodescrips($sesocodigos) {
		$sql = 'SELECT "sesodescrips" FROM "segurisocial" WHERE "sesocodigos"=\''.$sesocodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getSesoactivos($sesocodigos) {
		$sql = 'SELECT "sesoactivos" FROM "segurisocial" WHERE "sesocodigos"=\''.$sesocodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Segurisocial
?>