<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeCuPgsqlTipocliente {
	var $consult;
	var $objdb;
	function FeCuPgsqlTipocliente() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	function existTipocliente($ticlcodigos) {
		$sql = 'SELECT * FROM "tipocliente" WHERE "ticlcodigos"=\''.$ticlcodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}
	function addTipocliente($ticlcodigos, $ticlnombres, $ticldescrips, $ticlactivos) {
		$sql = 'INSERT INTO "tipocliente" ("ticlcodigos","ticlnombres","ticldescrips","ticlactivos")'
		.' VALUES(\''.$ticlcodigos.'\',\''.$ticlnombres.'\',\''.$ticldescrips.'\',\''.$ticlactivos.'\')';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function updateTipocliente($ticlcodigos, $ticlnombres, $ticldescrips, $ticlactivos) {
		$sql = 'UPDATE "tipocliente" SET "ticlnombres"=\''.$ticlnombres.'\',"ticldescrips"=\''.$ticldescrips.'\',"ticlactivos"=\''.$ticlactivos.'\' WHERE "ticlcodigos"=\''.$ticlcodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function deleteTipocliente($ticlcodigos) {
		$sql = 'DELETE FROM "tipocliente" WHERE "ticlcodigos"=\''.$ticlcodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function getByIdTipocliente($ticlcodigos) {
		$sql = 'SELECT * FROM "tipocliente" WHERE "ticlcodigos"=\''.$ticlcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getAllTipocliente() {
		$sql = 'SELECT * FROM "tipocliente"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getTiclcodigos($ticlcodigos) {
		$sql = 'SELECT "ticlcodigos" FROM "tipocliente" WHERE "ticlcodigos"=\''.$ticlcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getTiclnombres($ticlcodigos) {
		$sql = 'SELECT "ticlnombres" FROM "tipocliente" WHERE "ticlcodigos"=\''.$ticlcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getTicldescrips($ticlcodigos) {
		$sql = 'SELECT "ticldescrips" FROM "tipocliente" WHERE "ticlcodigos"=\''.$ticlcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getTiclactivos($ticlcodigos) {
		$sql = 'SELECT "ticlactivos" FROM "tipocliente" WHERE "ticlcodigos"=\''.$ticlcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Tipocliente
?>