<?php 
		
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeCrPgsqlMediorecepcion {
	var $consult;
	var $objdb;

	function FeCrPgsqlMediorecepcion() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}

	function existMediorecepcion($merecodigos) {
		$sql = 'SELECT * FROM "mediorecepcion" WHERE "merecodigos"=\''.$merecodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}

	function addMediorecepcion($merecodigos, $merenombres, $mereescrips, $mereactivos) {
		$sql = 'INSERT INTO "mediorecepcion" ("merecodigos","merenombres","mereescrips","mereactivos") VALUES(\''.$merecodigos.'\',\''.$merenombres.'\',\''.$mereescrips.'\',\''.$mereactivos.'\')';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function updateMediorecepcion($merecodigos, $merenombres, $mereescrips, $mereactivos) {
		$sql = 'UPDATE "mediorecepcion" SET "merenombres"=\''.$merenombres.'\',"mereescrips"=\''.$mereescrips.'\',"mereactivos"=\''.$mereactivos.'\' WHERE "merecodigos"=\''.$merecodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function deleteMediorecepcion($merecodigos) {
		$sql = 'DELETE FROM "mediorecepcion" WHERE "merecodigos"=\''.$merecodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function getByIdMediorecepcion($merecodigos) {
		$sql = 'SELECT * FROM "mediorecepcion" WHERE "merecodigos"=\''.$merecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getAllMediorecepcion() {
		$sql = 'SELECT * FROM "mediorecepcion"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getMerecodigos($merecodigos) {
		$sql = 'SELECT "merecodigos" FROM "mediorecepcion" WHERE "merecodigos"=\''.$merecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getMerenombres($merecodigos) {
		$sql = 'SELECT "merenombres" FROM "mediorecepcion" WHERE "merecodigos"=\''.$merecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getMereescrips($merecodigos) {
		$sql = 'SELECT "mereescrips" FROM "mediorecepcion" WHERE "merecodigos"=\''.$merecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getMereactivos($merecodigos) {
		$sql = 'SELECT "mereactivos" FROM "mediorecepcion" WHERE "merecodigos"=\''.$merecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

} //End of Class Mediorecepcion
?>