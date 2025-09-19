<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeHrPgsqlCargo {
	var $consult;
	var $objdb;
	function FeHrPgsqlCargo() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	function existCargo($cargcodigos) {
		$sql = 'SELECT * FROM "cargo" WHERE "cargcodigos"=\''.$cargcodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}
	function addCargo($cargcodigos, $cargnombres, $cargdescrips, $cargactivas) {
		$sql = 'INSERT INTO "cargo" ("cargcodigos","cargnombres","cargdescrips","cargactivas")'
		.' VALUES(\''.$cargcodigos.'\',\''.$cargnombres.'\',\''.$cargdescrips.'\',\''.$cargactivas.'\')';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function updateCargo($cargcodigos, $cargnombres, $cargdescrips, $cargactivas) {
		$sql = 'UPDATE "cargo" SET "cargnombres"=\''.$cargnombres.'\',"cargdescrips"=\''.$cargdescrips.'\',"cargactivas"=\''.$cargactivas.'\' WHERE "cargcodigos"=\''.$cargcodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function deleteCargo($cargcodigos) {
		$sql = 'DELETE FROM "cargo" WHERE "cargcodigos"=\''.$cargcodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function getByIdCargo($cargcodigos) {
		$sql = 'SELECT * FROM "cargo" WHERE "cargcodigos"=\''.$cargcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getAllCargo() {
		$sql = 'SELECT * FROM "cargo"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getCargcodigos($cargcodigos) {
		$sql = 'SELECT "cargcodigos" FROM "cargo" WHERE "cargcodigos"=\''.$cargcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getCargnombres($cargcodigos) {
		$sql = 'SELECT "cargnombres" FROM "cargo" WHERE "cargcodigos"=\''.$cargcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getCargdescrips($cargcodigos) {
		$sql = 'SELECT "cargdescrips" FROM "cargo" WHERE "cargcodigos"=\''.$cargcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getCargactivas($cargcodigos) {
		$sql = 'SELECT "cargactivas" FROM "cargo" WHERE "cargcodigos"=\''.$cargcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Cargo
?>