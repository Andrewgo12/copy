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
class FePrPgsqlLanguage {
	var $consult;
	var $objdb;

	function FePrPgsqlLanguage() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}

	function existLanguage($langcodigos) {
		$sql = 'SELECT * FROM "language" WHERE "langcodigos"=\''.$langcodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}

	function addLanguage($langcodigos, $langnombres, $langobservas) {
		$sql = 'INSERT INTO "language" ("langcodigos","langnombres","langobservas")'
		.' VALUES(\''.$langcodigos.'\',\''.$langnombres.'\',\''.$langobservas.'\')';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function updateLanguage($langcodigos, $langnombres, $langobservas) {
		$sql = 'UPDATE "language" SET "langnombres"=\''.$langnombres.'\',"langobservas"=\''.$langobservas.'\' WHERE "langcodigos"=\''.$langcodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function deleteLanguage($langcodigos) {
		$sql = 'DELETE FROM "language" WHERE "langcodigos"=\''.$langcodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function getByIdLanguage($langcodigos) {
		$sql = 'SELECT * FROM "language" WHERE "langcodigos"=\''.$langcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getAllLanguage() {
		$sql = 'SELECT * FROM "language"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getLangcodigos($langcodigos) {
		$sql = 'SELECT "langcodigos" FROM "language" WHERE "langcodigos"=\''.$langcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getLangnombres($langcodigos) {
		$sql = 'SELECT "langnombres" FROM "language" WHERE "langcodigos"=\''.$langcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getLangobservas($langcodigos) {
		$sql = 'SELECT "langobservas" FROM "language" WHERE "langcodigos"=\''.$langcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

} //End of Class Language
?>