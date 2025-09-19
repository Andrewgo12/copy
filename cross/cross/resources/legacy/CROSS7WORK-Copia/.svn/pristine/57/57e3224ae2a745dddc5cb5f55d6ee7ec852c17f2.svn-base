<?php   
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeStPgsqlRecurso {
	var $consult;
	var $objdb;
	function FeStPgsqlRecurso() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	function existRecurso($recucodigos) {
		$sql = 'SELECT * FROM "recurso" WHERE "recucodigos"=\''.$recucodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}
	function addRecurso($recucodigos, $recunombres, $grrecodigos, $tirecodigos, $unmecodigos, $recudescrips) {
		$sql = 'INSERT INTO "recurso" ("recucodigos","recunombres","grrecodigos","tirecodigos","unmecodigos","recudescrips")'
		.' VALUES(\''.$recucodigos.'\',\''.$recunombres.'\',\''.$grrecodigos.'\',\''.$tirecodigos.'\',\''.$unmecodigos.'\',\''.$recudescrips.'\')';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function updateRecurso($recucodigos, $recunombres, $grrecodigos, $tirecodigos, $unmecodigos, $recudescrips, $recuactivas) {
		$sql = 'UPDATE "recurso" SET "recunombres"=\''.$recunombres.'\',"grrecodigos"=\''.$grrecodigos.'\',"tirecodigos"=\''.$tirecodigos.'\',"unmecodigos"=\''.$unmecodigos.'\',"recudescrips"=\''.$recudescrips.'\',"recuactivas"=\''.$recuactivas.'\' WHERE "recucodigos"=\''.$recucodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function deleteRecurso($recucodigos) {
		$sql = 'DELETE FROM "recurso" WHERE "recucodigos"=\''.$recucodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function getByIdRecurso($recucodigos) {
		$sql = 'SELECT * FROM "recurso" WHERE "recucodigos"=\''.$recucodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getAllRecurso() {
		$sql = 'SELECT * FROM "recurso"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getByRecurso_fkey($tirecodigos) {
		$sql = 'SELECT * FROM "recurso" WHERE "tirecodigos"=\''.$tirecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getByRecurso_fkey1($grrecodigos) {
		$sql = 'SELECT * FROM "recurso" WHERE "grrecodigos"=\''.$grrecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getByRecurso_fkey2($unmecodigos) {
		$sql = 'SELECT * FROM "recurso" WHERE "unmecodigos"=\''.$unmecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getRecucodigos($recucodigos) {
		$sql = 'SELECT "recucodigos" FROM "recurso" WHERE "recucodigos"=\''.$recucodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getRecunombres($recucodigos) {
		$sql = 'SELECT "recunombres" FROM "recurso" WHERE "recucodigos"=\''.$recucodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getGrrecodigos($recucodigos) {
		$sql = 'SELECT "grrecodigos" FROM "recurso" WHERE "recucodigos"=\''.$recucodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getTirecodigos($recucodigos) {
		$sql = 'SELECT "tirecodigos" FROM "recurso" WHERE "recucodigos"=\''.$recucodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getUnmecodigos($recucodigos) {
		$sql = 'SELECT "unmecodigos" FROM "recurso" WHERE "recucodigos"=\''.$recucodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getRecudescrips($recucodigos) {
		$sql = 'SELECT "recudescrips" FROM "recurso" WHERE "recucodigos"=\''.$recucodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Recurso
?>