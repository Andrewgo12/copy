<?php 
		
/**
* @Copyright 2004 FullEngine
*
* Clase compuerta para la tabla $tabla
* @author Ingravity 0.0.8
* @location Cali - Colombia
*/
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FePrPgsqlProfiles {
	var $consult;
	var $objdb;

	function FePrPgsqlProfiles() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}

	function existProfiles($profcodigos, $applcodigos) {
		$sql = 'SELECT * FROM "profiles" WHERE "profcodigos"=\''.$profcodigos.'\' AND "applcodigos"=\''.$applcodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}
	function nameExist($applcodigos, $profnombres) {
		$sql = 'SELECT * FROM "profiles" WHERE "applcodigos"=\''.$applcodigos.'\' AND "profnombres"=\''.$profnombres.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}

	function addProfiles($profcodigos, $applcodigos, $profnombres, $profdescrips) {
		$sql = 'INSERT INTO "profiles" ("profcodigos","applcodigos","profnombres","profdescrips")'
		.' VALUES(\''.$profcodigos.'\',\''.$applcodigos.'\',\''.$profnombres.'\',\''.$profdescrips.'\')';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function updateProfiles($profcodigos, $applcodigos, $profnombres, $profdescrips) {
		$sql = 'UPDATE "profiles" SET "profnombres"=\''.$profnombres.'\',"profdescrips"=\''.$profdescrips.'\' WHERE "profcodigos"=\''.$profcodigos.'\' AND "applcodigos"=\''.$applcodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function deleteProfiles($profcodigos, $applcodigos) {
		$sql = 'DELETE FROM "profiles" WHERE "profcodigos"=\''.$profcodigos.'\' AND "applcodigos"=\''.$applcodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function getByIdProfiles($profcodigos, $applcodigos) {
		$sql = 'SELECT * FROM "profiles" WHERE "profcodigos"=\''.$profcodigos.'\' AND "applcodigos"=\''.$applcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getAllProfiles() {
		$sql = 'SELECT * FROM "profiles"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getByProfiles_fkey($applcodigos) {
		$sql = 'SELECT * FROM "profiles" WHERE "applcodigos"=\''.$applcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getProfcodigos($profcodigos, $applcodigos) {
		$sql = 'SELECT "profcodigos" FROM "profiles" WHERE "profcodigos"=\''.$profcodigos.'\' AND "applcodigos"=\''.$applcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getApplcodigos($profcodigos, $applcodigos) {
		$sql = 'SELECT "applcodigos" FROM "profiles" WHERE "profcodigos"=\''.$profcodigos.'\' AND "applcodigos"=\''.$applcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getProfnombres($profcodigos, $applcodigos) {
		$sql = 'SELECT "profnombres" FROM "profiles" WHERE "profcodigos"=\''.$profcodigos.'\' AND "applcodigos"=\''.$applcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getProfdescrips($profcodigos, $applcodigos) {
		$sql = 'SELECT "profdescrips" FROM "profiles" WHERE "profcodigos"=\''.$profcodigos.'\' AND "applcodigos"=\''.$applcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

} //End of Class Profiles
?>