<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeCuPgsqlTipomoneda {
	var $consult;
	var $objdb;
	function FeCuPgsqlTipomoneda() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	function existTipomoneda($timocodigos) {
		$sql = 'SELECT * FROM "tipomoneda" WHERE "timocodigos"=\''.$timocodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}
	function addTipomoneda($timocodigos, $timonombres, $timoequivaln, $timodescrips, $timoactivas) {
		$sql = 'INSERT INTO "tipomoneda" ("timocodigos","timonombres","timoequivaln","timodescrips","timoactivas")'
		.' VALUES(\''.$timocodigos.'\',\''.$timonombres.'\','.$timoequivaln.' ,\''.$timodescrips.'\',\''.$timoactivas.'\')';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function updateTipomoneda($timocodigos, $timonombres, $timoequivaln, $timodescrips, $timoactivas) {
		$sql = 'UPDATE "tipomoneda" SET "timonombres"=\''.$timonombres.'\',"timoequivaln"='.$timoequivaln.' ,"timodescrips"=\''.$timodescrips.'\',"timoactivas"=\''.$timoactivas.'\' WHERE "timocodigos"=\''.$timocodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function deleteTipomoneda($timocodigos) {
		$sql = 'DELETE FROM "tipomoneda" WHERE "timocodigos"=\''.$timocodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function getByIdTipomoneda($timocodigos) {
		$sql = 'SELECT * FROM "tipomoneda" WHERE "timocodigos"=\''.$timocodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getAllTipomoneda() {
		$sql = 'SELECT * FROM "tipomoneda"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getTimocodigos($timocodigos) {
		$sql = 'SELECT "timocodigos" FROM "tipomoneda" WHERE "timocodigos"=\''.$timocodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getTimonombres($timocodigos) {
		$sql = 'SELECT "timonombres" FROM "tipomoneda" WHERE "timocodigos"=\''.$timocodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getTimoequivaln($timocodigos) {
		$sql = 'SELECT "timoequivaln" FROM "tipomoneda" WHERE "timocodigos"=\''.$timocodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getTimodescrips($timocodigos) {
		$sql = 'SELECT "timodescrips" FROM "tipomoneda" WHERE "timocodigos"=\''.$timocodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getTimoactivas($timocodigos) {
		$sql = 'SELECT "timoactivas" FROM "tipomoneda" WHERE "timocodigos"=\''.$timocodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Tipomoneda
?>