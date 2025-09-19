<?php 
		
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeCrPgsqlCausa {
	var $consult;
	var $objdb;

	function FeCrPgsqlCausa() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}

	function existCausa($tiorcodigos, $evencodigos, $causcodigos) {
		$sql = 'SELECT * FROM "causa" WHERE "tiorcodigos"=\''.$tiorcodigos.'\' AND "evencodigos"=\''.$evencodigos.'\' AND "causcodigos"=\''.$causcodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}

	function addCausa($tiorcodigos, $evencodigos, $causcodigos, $causnombres, $causdescrips, $causactivas) {
		$sql = 'INSERT INTO "causa" ("tiorcodigos","evencodigos","causcodigos","causnombres","causdescrips") VALUES(\''.$tiorcodigos.'\',\''.$evencodigos.'\',\''.$causcodigos.'\',\''.$causnombres.'\',\''.$causdescrips.'\')';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function updateCausa($tiorcodigos, $evencodigos, $causcodigos, $causnombres, $causdescrips, $causactivas) {
		$sql = 'UPDATE "causa" SET "causnombres"=\''.$causnombres.'\',"causdescrips"=\''.$causdescrips.'\',"causactivas"=\''.$causactivas.'\' WHERE "tiorcodigos"=\''.$tiorcodigos.'\' AND "evencodigos"=\''.$evencodigos.'\' AND "causcodigos"=\''.$causcodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function deleteCausa($tiorcodigos, $evencodigos, $causcodigos) {
		$sql = 'DELETE FROM "causa" WHERE "tiorcodigos"=\''.$tiorcodigos.'\' AND "evencodigos"=\''.$evencodigos.'\' AND "causcodigos"=\''.$causcodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function getByIdCausa($tiorcodigos, $evencodigos, $causcodigos) {
		$sql = 'SELECT * FROM "causa" WHERE "tiorcodigos"=\''.$tiorcodigos.'\' AND "evencodigos"=\''.$evencodigos.'\' AND "causcodigos"=\''.$causcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getAllCausa() {
		$sql = 'SELECT * FROM "causa"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getByCausa_fkey1($tiorcodigos, $evencodigos) {
		$sql = 'SELECT * FROM "causa" WHERE "tiorcodigos"=\''.$tiorcodigos.'\' AND "evencodigos"=\''.$evencodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getTiorcodigos($tiorcodigos, $evencodigos, $causcodigos) {
		$sql = 'SELECT "tiorcodigos" FROM "causa" WHERE "tiorcodigos"=\''.$tiorcodigos.'\' AND "evencodigos"=\''.$evencodigos.'\' AND "causcodigos"=\''.$causcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getEvencodigos($tiorcodigos, $evencodigos, $causcodigos) {
		$sql = 'SELECT "evencodigos" FROM "causa" WHERE "tiorcodigos"=\''.$tiorcodigos.'\' AND "evencodigos"=\''.$evencodigos.'\' AND "causcodigos"=\''.$causcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getCauscodigos($tiorcodigos, $evencodigos, $causcodigos) {
		$sql = 'SELECT "causcodigos" FROM "causa" WHERE "tiorcodigos"=\''.$tiorcodigos.'\' AND "evencodigos"=\''.$evencodigos.'\' AND "causcodigos"=\''.$causcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getCausnombres($tiorcodigos, $evencodigos, $causcodigos) {
		$sql = 'SELECT "causnombres" FROM "causa" WHERE "tiorcodigos"=\''.$tiorcodigos.'\' AND "evencodigos"=\''.$evencodigos.'\' AND "causcodigos"=\''.$causcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getCausdescrips($tiorcodigos, $evencodigos, $causcodigos) {
		$sql = 'SELECT "causdescrips" FROM "causa" WHERE "tiorcodigos"=\''.$tiorcodigos.'\' AND "evencodigos"=\''.$evencodigos.'\' AND "causcodigos"=\''.$causcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getCausactivas($tiorcodigos, $evencodigos, $causcodigos) {
		$sql = 'SELECT "causactivas" FROM "causa" WHERE "tiorcodigos"=\''.$tiorcodigos.'\' AND "evencodigos"=\''.$evencodigos.'\' AND "causcodigos"=\''.$causcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

} //End of Class Causa
?>