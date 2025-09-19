<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeCrPgsqlPrioridad {
	var $consult;
	var $objdb;
	function FeCrPgsqlPrioridad() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	function existPrioridad($priocodigos) {
		$sql = 'SELECT * FROM "prioridad" WHERE "priocodigos"=\''.$priocodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}
	function addPrioridad($priocodigos, $prionombres, $priodescrips, $prioactivas) {
		$sql = 'INSERT INTO "prioridad" ("priocodigos","prionombres","priodescrips","prioactivas")'
		.' VALUES(\''.$priocodigos.'\',\''.$prionombres.'\',\''.$priodescrips.'\',\''.$prioactivas.'\')';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function updatePrioridad($priocodigos, $prionombres, $priodescrips, $prioactivas) {
		$sql = 'UPDATE "prioridad" SET "prionombres"=\''.$prionombres.'\',"priodescrips"=\''.$priodescrips.'\',"prioactivas"=\''.$prioactivas.'\' WHERE "priocodigos"=\''.$priocodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function deletePrioridad($priocodigos) {
		$sql = 'DELETE FROM "prioridad" WHERE "priocodigos"=\''.$priocodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function getByIdPrioridad($priocodigos) {
		$sql = 'SELECT * FROM "prioridad" WHERE "priocodigos"=\''.$priocodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getAllPrioridad() {
		$sql = 'SELECT * FROM "prioridad"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getPriocodigos($priocodigos) {
		$sql = 'SELECT "priocodigos" FROM "prioridad" WHERE "priocodigos"=\''.$priocodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getPrionombres($priocodigos) {
		$sql = 'SELECT "prionombres" FROM "prioridad" WHERE "priocodigos"=\''.$priocodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getPriodescrips($priocodigos) {
		$sql = 'SELECT "priodescrips" FROM "prioridad" WHERE "priocodigos"=\''.$priocodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getPrioactivas($priocodigos) {
		$sql = 'SELECT "prioactivas" FROM "prioridad" WHERE "priocodigos"=\''.$priocodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Prioridad
?>