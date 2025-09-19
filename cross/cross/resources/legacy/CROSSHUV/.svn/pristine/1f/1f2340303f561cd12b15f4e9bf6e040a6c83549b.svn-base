<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeStPgsqlGruporecurso {
	var $consult;
	var $objdb;
	function FeStPgsqlGruporecurso() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	function existGruporecurso($grrecodigos) {
		$sql = 'SELECT * FROM "gruporecurso" WHERE "grrecodigos"=\''.$grrecodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}
	function addGruporecurso($grrecodigos, $grrenombres, $grredescrips) {
		$sql = 'INSERT INTO "gruporecurso" ("grrecodigos","grrenombres","grredescrips")'
		.' VALUES(\''.$grrecodigos.'\',\''.$grrenombres.'\',\''.$grredescrips.'\')';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function updateGruporecurso($grrecodigos, $grrenombres, $grredescrips,$grreactivas) {
		$sql = 'UPDATE "gruporecurso" SET "grrenombres"=\''.$grrenombres.'\',"grredescrips"=\''.$grredescrips.'\',"grreactivas"=\''.$grreactivas.'\' WHERE "grrecodigos"=\''.$grrecodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function deleteGruporecurso($grrecodigos) {
		$sql = 'DELETE FROM "gruporecurso" WHERE "grrecodigos"=\''.$grrecodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function getByIdGruporecurso($grrecodigos) {
		$sql = 'SELECT * FROM "gruporecurso" WHERE "grrecodigos"=\''.$grrecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getAllGruporecurso() {
		$sql = 'SELECT * FROM "gruporecurso"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getGrrecodigos($grrecodigos) {
		$sql = 'SELECT "grrecodigos" FROM "gruporecurso" WHERE "grrecodigos"=\''.$grrecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getGrrenombres($grrecodigos) {
		$sql = 'SELECT "grrenombres" FROM "gruporecurso" WHERE "grrecodigos"=\''.$grrecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getGrredescrips($grrecodigos) {
		$sql = 'SELECT "grredescrips" FROM "gruporecurso" WHERE "grrecodigos"=\''.$grrecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Gruporecurso
?>