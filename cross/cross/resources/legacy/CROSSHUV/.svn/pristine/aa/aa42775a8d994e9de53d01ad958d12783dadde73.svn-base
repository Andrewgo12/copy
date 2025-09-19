<?php
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeCuPgsqlTipoexamen {
	var $consult;
	var $objdb;
	function FeCuPgsqlTipoexamen() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	function existTipoexamen($tiexcodigos) {
		$sql = 'SELECT * FROM "tipoexamen" WHERE "tiexcodigos"=\''.$tiexcodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}
	function addTipoexamen($tiexcodigos, $tiexnombres, $tiexdescrips, $tiexactivos) {
		$sql = 'INSERT INTO "tipoexamen" ("tiexcodigos","tiexnombres","tiexdescrips","tiexactivos")'
		.' VALUES(\''.$tiexcodigos.'\',\''.$tiexnombres.'\',\''.$tiexdescrips.'\',\''.$tiexactivos.'\')';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function updateTipoexamen($tiexcodigos, $tiexnombres, $tiexdescrips, $tiexactivos) {
		$sql = 'UPDATE "tipoexamen" SET "tiexnombres"=\''.$tiexnombres.'\',"tiexdescrips"=\''
		.$tiexdescrips.'\',"tiexactivos"=\''.$tiexactivos.'\''
		.' WHERE "tiexcodigos"=\''.$tiexcodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function deleteTipoexamen($tiexcodigos) {
		$sql = 'DELETE FROM "tipoexamen" WHERE "tiexcodigos"=\''.$tiexcodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function getByIdTipoexamen($tiexcodigos) {
		$sql = 'SELECT * FROM "tipoexamen" WHERE "tiexcodigos"=\''.$tiexcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getAllTipoexamen() {
		$sql = 'SELECT * FROM "tipoexamen" ORDER BY "tiexnombres"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getTiexcodigos($tiexcodigos) {
		$sql = 'SELECT "tiexcodigos" FROM "tipoexamen" WHERE "tiexcodigos"=\''.$tiexcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getTiexnombres($tiexcodigos) {
		$sql = 'SELECT "tiexnombres" FROM "tipoexamen" WHERE "tiexcodigos"=\''.$tiexcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getTiexdescrips($tiexcodigos) {
		$sql = 'SELECT "tiexdescrips" FROM "tipoexamen" WHERE "tiexcodigos"=\''.$tiexcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getTiexactivos($tiexcodigos) {
		$sql = 'SELECT "tiexactivos" FROM "tipoexamen" WHERE "tiexcodigos"=\''.$tiexcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Tipoexamen
?>