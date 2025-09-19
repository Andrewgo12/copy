<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeCrPgsqlGruposinteres {
	var $consult;
	var $objdb;
	function FeCrPgsqlGruposinteres() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	function existGruposinteres($grincodigos) {
		$sql = 'SELECT * FROM "gruposinteres" WHERE "grincodigos"=\''.$grincodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}
	function addGruposinteres($grincodigos, $grinnombres, $grindescrips, $grinactivos) {
		$sql = 'INSERT INTO "gruposinteres" ("grincodigos","grinnombres","grindescrips","grinactivos")'
		.' VALUES(\''.$grincodigos.'\',\''.$grinnombres.'\',\''.$grindescrips.'\',\''.$grinactivos.'\')';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function updateGruposinteres($grincodigos, $grinnombres, $grindescrips, $grinactivos) {
		$sql = 'UPDATE "gruposinteres" SET "grinnombres"=\''.$grinnombres.'\',"grindescrips"=\''.$grindescrips.'\',"grinactivos"=\''.$grinactivos.'\' WHERE "grincodigos"=\''.$grincodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function deleteGruposinteres($grincodigos) {
		$sql = 'DELETE FROM "gruposinteres" WHERE "grincodigos"=\''.$grincodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function getByIdGruposinteres($grincodigos) {
		$sql = 'SELECT * FROM "gruposinteres" WHERE "grincodigos"=\''.$grincodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getAllGruposinteres() {
		$sql = 'SELECT * FROM "gruposinteres"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getGrincodigos($grincodigos) {
		$sql = 'SELECT "grincodigos" FROM "gruposinteres" WHERE "grincodigos"=\''.$grincodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getGrinnombres($grincodigos) {
		$sql = 'SELECT "grinnombres" FROM "gruposinteres" WHERE "grincodigos"=\''.$grincodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getGrindescrips($grincodigos) {
		$sql = 'SELECT "grindescrips" FROM "gruposinteres" WHERE "grincodigos"=\''.$grincodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getGrinactivos($grincodigos) {
		$sql = 'SELECT "grinactivos" FROM "gruposinteres" WHERE "grincodigos"=\''.$grincodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Gruposinteres
?>