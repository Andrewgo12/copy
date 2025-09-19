<?php 		
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeGePgsqlLocalizacion {
	var $consult;
	var $objdb;

	function FeGePgsqlLocalizacion() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}

	function existLocalizacion($locacodigos) {
		$sql = 'SELECT * FROM "localizacion" WHERE "locacodigos"=\''.$locacodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}

	function deleteLocalizacion($locacodigos) {
		$sql = 'DELETE FROM "localizacion" WHERE "locacodigos"=\''.$locacodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function getByIdLocalizacion($locacodigos) {
		$sql = 'SELECT * FROM "localizacion" WHERE "locacodigos"=\''.$locacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getAllLocalizacion() {
		$sql = 'SELECT * FROM "localizacion"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getLocacodigos($locacodigos) {
		$sql = 'SELECT "locacodigos" FROM "localizacion" WHERE "locacodigos"=\''.$locacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getLocanombres($locacodigos) {
		$sql = 'SELECT "locanombres" FROM "localizacion" WHERE "locacodigos"=\''.$locacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getLocadescrips($locacodigos) {
		$sql = 'SELECT "locadescrips" FROM "localizacion" WHERE "locacodigos"=\''.$locacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getTilocodigos($locacodigos) {
		$sql = 'SELECT "tilocodigos" FROM "localizacion" WHERE "locacodigos"=\''.$locacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getLocacodpadrs($locacodigos) {
		$sql = 'SELECT "locacodpadrs" FROM "localizacion" WHERE "locacodigos"=\''.$locacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getLocaordenn($locacodigos) {
		$sql = 'SELECT "locaordenn" FROM "localizacion" WHERE "locacodigos"=\''.$locacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getLocazonas($locacodigos) {
		$sql = 'SELECT "locazonas" FROM "localizacion" WHERE "locacodigos"=\''.$locacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getLocaestados($locacodigos) {
		$sql = 'SELECT "locaestados" FROM "localizacion" WHERE "locacodigos"=\''.$locacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Localizacion
?>