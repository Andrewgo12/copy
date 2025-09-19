<?php 
		
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeCrPgsqlEvento {
	var $consult;
	var $objdb;

	function FeCrPgsqlEvento() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}

	function existEvento($tiorcodigos, $evencodigos) {
		$sql = 'SELECT * FROM "evento" WHERE "tiorcodigos"=\''.$tiorcodigos.'\' AND "evencodigos"=\''.$evencodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}

	function addEvento($tiorcodigos, $evencodigos, $evennombres, $evendescrips, $evenactivos) {
		$sql = 'INSERT INTO "evento" ("tiorcodigos","evencodigos","evennombres","evendescrips") VALUES(\''.$tiorcodigos.'\',\''.$evencodigos.'\',\''.$evennombres.'\',\''.$evendescrips.'\')';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function updateEvento($tiorcodigos, $evencodigos, $evennombres, $evendescrips, $evenactivos) {
		$sql = 'UPDATE "evento" SET "evennombres"=\''.$evennombres.'\',"evendescrips"=\''.$evendescrips.'\',"evenactivos"=\''.$evenactivos.'\' WHERE "tiorcodigos"=\''.$tiorcodigos.'\' AND "evencodigos"=\''.$evencodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function deleteEvento($tiorcodigos, $evencodigos) {
		$sql = 'DELETE FROM "evento" WHERE "tiorcodigos"=\''.$tiorcodigos.'\' AND "evencodigos"=\''.$evencodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function getByIdEvento($tiorcodigos, $evencodigos) {
		$sql = 'SELECT * FROM "evento" WHERE "tiorcodigos"=\''.$tiorcodigos.'\' AND "evencodigos"=\''.$evencodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getAllEvento() {
		$sql = 'SELECT * FROM "evento"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getByEvento_fkey($tiorcodigos) {
		$sql = 'SELECT * FROM "evento" WHERE "tiorcodigos"=\''.$tiorcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getTiorcodigos($tiorcodigos, $evencodigos) {
		$sql = 'SELECT "tiorcodigos" FROM "evento" WHERE "tiorcodigos"=\''.$tiorcodigos.'\' AND "evencodigos"=\''.$evencodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getEvencodigos($tiorcodigos, $evencodigos) {
		$sql = 'SELECT "evencodigos" FROM "evento" WHERE "tiorcodigos"=\''.$tiorcodigos.'\' AND "evencodigos"=\''.$evencodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getEvennombres($tiorcodigos, $evencodigos) {
		$sql = 'SELECT "evennombres" FROM "evento" WHERE "tiorcodigos"=\''.$tiorcodigos.'\' AND "evencodigos"=\''.$evencodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getEvendescrips($tiorcodigos, $evencodigos) {
		$sql = 'SELECT "evendescrips" FROM "evento" WHERE "tiorcodigos"=\''.$tiorcodigos.'\' AND "evencodigos"=\''.$evencodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getEvenactivos($tiorcodigos, $evencodigos) {
		$sql = 'SELECT "evenactivos" FROM "evento" WHERE "tiorcodigos"=\''.$tiorcodigos.'\' AND "evencodigos"=\''.$evencodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

} //End of Class Evento
?>