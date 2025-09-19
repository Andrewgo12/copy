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
class FePrPgsqlStyle {
	var $consult;
	var $objdb;

	function FePrPgsqlStyle() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}

	function existStyle($stylcodigos, $applcodigos) {
		$sql = 'SELECT * FROM "style" WHERE "stylcodigos"=\''.$stylcodigos.'\' AND "applcodigos"=\''.$applcodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}

	function addStyle($stylcodigos, $applcodigos, $stylnombres, $stylobservas) {
		$sql = 'INSERT INTO "style" ("stylcodigos","applcodigos","stylnombres","stylobservas")'
		.' VALUES(\''.$stylcodigos.'\',\''.$applcodigos.'\',\''.$stylnombres.'\',\''.$stylobservas.'\')';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function updateStyle($stylcodigos, $applcodigos, $stylnombres, $stylobservas) {
		$sql = 'UPDATE "style" SET "stylnombres"=\''.$stylnombres.'\',"stylobservas"=\''.$stylobservas.'\' WHERE "stylcodigos"=\''.$stylcodigos.'\' AND "applcodigos"=\''.$applcodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function deleteStyle($stylcodigos, $applcodigos) {
		$sql = 'DELETE FROM "style" WHERE "stylcodigos"=\''.$stylcodigos.'\' AND "applcodigos"=\''.$applcodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function getByIdStyle($stylcodigos, $applcodigos) {
		$sql = 'SELECT * FROM "style" WHERE "stylcodigos"=\''.$stylcodigos.'\' AND "applcodigos"=\''.$applcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getAllStyle() {
		$sql = 'SELECT * FROM "style"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getByStyle_fkey($applcodigos) {
		$sql = 'SELECT * FROM "style" WHERE "applcodigos"=\''.$applcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getStylcodigos($stylcodigos, $applcodigos) {
		$sql = 'SELECT "stylcodigos" FROM "style" WHERE "stylcodigos"=\''.$stylcodigos.'\' AND "applcodigos"=\''.$applcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getApplcodigos($stylcodigos, $applcodigos) {
		$sql = 'SELECT "applcodigos" FROM "style" WHERE "stylcodigos"=\''.$stylcodigos.'\' AND "applcodigos"=\''.$applcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getStylnombres($stylcodigos, $applcodigos) {
		$sql = 'SELECT "stylnombres" FROM "style" WHERE "stylcodigos"=\''.$stylcodigos.'\' AND "applcodigos"=\''.$applcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getStylobservas($stylcodigos, $applcodigos) {
		$sql = 'SELECT "stylobservas" FROM "style" WHERE "stylcodigos"=\''.$stylcodigos.'\' AND "applcodigos"=\''.$applcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

} //End of Class Style
?>