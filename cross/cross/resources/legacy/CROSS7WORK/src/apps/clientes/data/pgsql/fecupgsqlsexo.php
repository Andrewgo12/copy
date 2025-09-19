<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeCuPgsqlSexo {
	var $consult;
	var $objdb;
	function FeCuPgsqlSexo() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	function existSexo($sexocodigos) {
		$sql = 'SELECT * FROM "sexo" WHERE "sexocodigos"=\''.$sexocodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}
	function addSexo($sexocodigos, $sexonombres, $sexoobservs, $sexoactivos) {
		$sql = 'INSERT INTO "sexo" ("sexocodigos","sexonombres","sexoobservs","sexoactivos")'
		.' VALUES(\''.$sexocodigos.'\',\''.$sexonombres.'\',\''.$sexoobservs.'\',\''.$sexoactivos.'\')';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function updateSexo($sexocodigos, $sexonombres, $sexoobservs, $sexoactivos) {
		$sql = 'UPDATE "sexo" SET "sexonombres"=\''.$sexonombres.'\',"sexoobservs"=\''.$sexoobservs.'\',"sexoactivos"=\''.$sexoactivos.'\' WHERE "sexocodigos"=\''.$sexocodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function deleteSexo($sexocodigos) {
		$sql = 'DELETE FROM "sexo" WHERE "sexocodigos"=\''.$sexocodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function getByIdSexo($sexocodigos) {
		$sql = 'SELECT * FROM "sexo" WHERE "sexocodigos"=\''.$sexocodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getAllSexo() {
		$sql = 'SELECT * FROM "sexo"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getSexocodigos($sexocodigos) {
		$sql = 'SELECT "sexocodigos" FROM "sexo" WHERE "sexocodigos"=\''.$sexocodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getSexonombres($sexocodigos) {
		$sql = 'SELECT "sexonombres" FROM "sexo" WHERE "sexocodigos"=\''.$sexocodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getSexoobservs($sexocodigos) {
		$sql = 'SELECT "sexoobservs" FROM "sexo" WHERE "sexocodigos"=\''.$sexocodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getSexoactivos($sexocodigos) {
		$sql = 'SELECT "sexoactivos" FROM "sexo" WHERE "sexocodigos"=\''.$sexocodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Sexo
?>