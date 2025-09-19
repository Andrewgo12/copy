<?php
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeCuPgsqlCondiusuario {
	var $consult;
	var $objdb;
	function FeCuPgsqlCondiusuario() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	function existCondiusuario($couscodigos) {
		$sql = 'SELECT * FROM "condiusuario" WHERE "couscodigos"=\''.$couscodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}
	function addCondiusuario($couscodigos, $cousnombres, $cousdescrips, $cousactivos) {
		$sql = 'INSERT INTO "condiusuario" ("couscodigos","cousnombres","cousdescrips","cousactivos")'
		.' VALUES(\''.$couscodigos.'\',\''.$cousnombres.'\',\''.$cousdescrips.'\',\''.$cousactivos.'\')';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function updateCondiusuario($couscodigos, $cousnombres, $cousdescrips, $cousactivos) {
		$sql = 'UPDATE "condiusuario" SET "cousnombres"=\''.$cousnombres.'\',"cousdescrips"=\''
		.$cousdescrips.'\',"cousactivos"=\''.$cousactivos.'\''
		.' WHERE "couscodigos"=\''.$couscodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function deleteCondiusuario($couscodigos) {
		$sql = 'DELETE FROM "condiusuario" WHERE "couscodigos"=\''.$couscodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function getByIdCondiusuario($couscodigos) {
		$sql = 'SELECT * FROM "condiusuario" WHERE "couscodigos"=\''.$couscodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getAllCondiusuario() {
		$sql = 'SELECT * FROM "condiusuario" ORDER BY "cousnombres"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getCouscodigos($couscodigos) {
		$sql = 'SELECT "couscodigos" FROM "condiusuario" WHERE "couscodigos"=\''.$couscodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getCousnombres($couscodigos) {
		$sql = 'SELECT "cousnombres" FROM "condiusuario" WHERE "couscodigos"=\''.$couscodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getCousdescrips($couscodigos) {
		$sql = 'SELECT "cousdescrips" FROM "condiusuario" WHERE "couscodigos"=\''.$couscodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getCousactivos($couscodigos) {
		$sql = 'SELECT "cousactivos" FROM "condiusuario" WHERE "couscodigos"=\''.$couscodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Condiusuario
?>