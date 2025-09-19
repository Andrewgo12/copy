<?php	
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeGePgsqlTipolocaliza {
	var $consult;
	var $objdb;

	function FeGePgsqlTipolocaliza() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}

	function existTipolocaliza($tilocodigos) {
		$sql = 'SELECT * FROM "tipolocaliza" WHERE "tilocodigos"=\''.$tilocodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}

	function deleteTipolocaliza($tilocodigos) {
		$sql = 'DELETE FROM "tipolocaliza" WHERE "tilocodigos"=\''.$tilocodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function getByIdTipolocaliza($tilocodigos) {
		$sql = 'SELECT * FROM "tipolocaliza" WHERE "tilocodigos"=\''.$tilocodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getAllTipolocaliza() {
		$sql = 'SELECT * FROM "tipolocaliza"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getTilocodigos($tilocodigos) {
		$sql = 'SELECT "tilocodigos" FROM "tipolocaliza" WHERE "tilocodigos"=\''.$tilocodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getTilonombres($tilocodigos) {
		$sql = 'SELECT "tilonombres" FROM "tipolocaliza" WHERE "tilocodigos"=\''.$tilocodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getTilodesc($tilocodigos) {
		$sql = 'SELECT "tilodesc" FROM "tipolocaliza" WHERE "tilocodigos"=\''.$tilocodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getTilocodpadrs($tilocodigos) {
		$sql = 'SELECT "tilocodpadrs" FROM "tipolocaliza" WHERE "tilocodigos"=\''.$tilocodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getTiloimagens($tilocodigos) {
		$sql = 'SELECT "tiloimagens" FROM "tipolocaliza" WHERE "tilocodigos"=\''.$tilocodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getTiloestados($tilocodigos) {
		$sql = 'SELECT "tiloestados" FROM "tipolocaliza" WHERE "tilocodigos"=\''.$tilocodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Tipolocaliza
?>