<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeStPgsqlUnidadmedida {
	var $consult;
	var $objdb;
	function FeStPgsqlUnidadmedida() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	function existUnidadmedida($unmecodigos) {
		$sql = 'SELECT * FROM "unidadmedida" WHERE "unmecodigos"=\''.$unmecodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}
	function addUnidadmedida($unmecodigos, $unmenombres, $unmesiglas, $unmedescrips) {
		$sql = 'INSERT INTO "unidadmedida" ("unmecodigos","unmenombres","unmesiglas","unmedescrips")'
		.' VALUES(\''.$unmecodigos.'\',\''.$unmenombres.'\',\''.$unmesiglas.'\',\''.$unmedescrips.'\')';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function updateUnidadmedida($unmecodigos, $unmenombres, $unmesiglas, $unmedescrips, $unmeactivas) {
		$sql = 'UPDATE "unidadmedida" SET "unmenombres"=\''.$unmenombres.'\',"unmesiglas"=\''.$unmesiglas.'\',"unmedescrips"=\''.$unmedescrips.'\',"unmeactivas"=\''.$unmeactivas.'\' WHERE "unmecodigos"=\''.$unmecodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function deleteUnidadmedida($unmecodigos) {
		$sql = 'DELETE FROM "unidadmedida" WHERE "unmecodigos"=\''.$unmecodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function getByIdUnidadmedida($unmecodigos) {
		$sql = 'SELECT * FROM "unidadmedida" WHERE "unmecodigos"=\''.$unmecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getAllUnidadmedida() {
		$sql = 'SELECT * FROM "unidadmedida"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getUnmecodigos($unmecodigos) {
		$sql = 'SELECT "unmecodigos" FROM "unidadmedida" WHERE "unmecodigos"=\''.$unmecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getUnmenombres($unmecodigos) {
		$sql = 'SELECT "unmenombres" FROM "unidadmedida" WHERE "unmecodigos"=\''.$unmecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getUnmesiglas($unmecodigos) {
		$sql = 'SELECT "unmesiglas" FROM "unidadmedida" WHERE "unmecodigos"=\''.$unmecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getUnmedescrips($unmecodigos) {
		$sql = 'SELECT "unmedescrips" FROM "unidadmedida" WHERE "unmecodigos"=\''.$unmecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Unidadmedida
?>