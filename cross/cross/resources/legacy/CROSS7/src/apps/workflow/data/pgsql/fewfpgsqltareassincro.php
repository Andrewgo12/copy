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
class FeWFPgsqlTareassincro {
	var $consult;
	var $objdb;

	function FeWFPgsqlTareassincro() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}

	function existTareassincro($tasicodigon) {
		$sql = 'SELECT * FROM "tareassincro" WHERE "tasicodigon"='.$tasicodigon.' ';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}

	function addTareassincro($tasicodigon, $proccodigos, $tasisigtareas, $tasiacttareas, $tasiesactas, $tasiindice, $tasitipsincs) {
		$sql = 'INSERT INTO "tareassincro" ("tasicodigon","proccodigos","tasisigtareas","tasiacttareas","tasiesactas","tasiindice","tasitipsincs")'
		.' VALUES('.$tasicodigon.' ,\''.$proccodigos.'\',\''.$tasisigtareas.'\',\''.$tasiacttareas.'\',\''.$tasiesactas.'\','.$tasiindice.' ,\''.$tasitipsincs.'\')';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function updateTareassincro($tasicodigon, $proccodigos, $tasisigtareas, $tasiacttareas, $tasiesactas, $tasiindice, $tasitipsincs) {
		$sql = 'UPDATE "tareassincro" SET "proccodigos"=\''.$proccodigos.'\',"tasisigtareas"=\''.$tasisigtareas.'\',"tasiacttareas"=\''.$tasiacttareas.'\',"tasiesactas"=\''.$tasiesactas.'\',"tasiindice"='.$tasiindice.' ,"tasitipsincs"=\''.$tasitipsincs.'\' WHERE "tasicodigon"='.$tasicodigon.' ';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function deleteTareassincro($tasicodigon) {
		$sql = 'DELETE FROM "tareassincro" WHERE "tasicodigon"='.$tasicodigon.' ';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function getByIdTareassincro($tasicodigon) {
		$sql = 'SELECT * FROM "tareassincro" WHERE "tasicodigon"='.$tasicodigon.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getAllTareassincro() {
		$sql = 'SELECT * FROM "tareassincro"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getByTareassincro_fkey($proccodigos) {
		$sql = 'SELECT * FROM "tareassincro" WHERE "proccodigos"=\''.$proccodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getTasicodigon($tasicodigon) {
		$sql = 'SELECT "tasicodigon" FROM "tareassincro" WHERE "tasicodigon"='.$tasicodigon.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getProccodigos($tasicodigon) {
		$sql = 'SELECT "proccodigos" FROM "tareassincro" WHERE "tasicodigon"='.$tasicodigon.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getTasisigtareas($tasicodigon) {
		$sql = 'SELECT "tasisigtareas" FROM "tareassincro" WHERE "tasicodigon"='.$tasicodigon.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getTasiacttareas($tasicodigon) {
		$sql = 'SELECT "tasiacttareas" FROM "tareassincro" WHERE "tasicodigon"='.$tasicodigon.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getTasiesactas($tasicodigon) {
		$sql = 'SELECT "tasiesactas" FROM "tareassincro" WHERE "tasicodigon"='.$tasicodigon.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getTasiindice($tasicodigon) {
		$sql = 'SELECT "tasiindice" FROM "tareassincro" WHERE "tasicodigon"='.$tasicodigon.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getTasitipsincs($tasicodigon) {
		$sql = 'SELECT "tasitipsincs" FROM "tareassincro" WHERE "tasicodigon"='.$tasicodigon.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

} //End of Class Tareassincro
?>