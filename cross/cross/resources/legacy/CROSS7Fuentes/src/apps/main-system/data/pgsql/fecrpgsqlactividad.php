<?php 
		
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeCrPgsqlActividad {
	var $consult;
	var $objdb;

	function FeCrPgsqlActividad() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}

	function existActividad($acticodigos) {
		$sql = 'SELECT * FROM "actividad" WHERE "acticodigos"=\''.$acticodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}

	function addActividad($acticodigos, $actinombres, $activalorn, $actiobservas, $actiactivas) {
		$sql = 'INSERT INTO "actividad" ("acticodigos","actinombres","activalorn","actiobservas","actiactivas") VALUES(\''.$acticodigos.'\',\''.$actinombres.'\','.$activalorn.' ,\''.$actiobservas.'\',\''.$actiactivas.'\')';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function updateActividad($acticodigos, $actinombres, $activalorn, $actiobservas, $actiactivas) {
		$sql = 'UPDATE "actividad" SET "actinombres"=\''.$actinombres.'\',"activalorn"='.$activalorn.' ,"actiobservas"=\''.$actiobservas.'\' WHERE "acticodigos"=\''.$acticodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function deleteActividad($acticodigos) {
		$sql = 'DELETE FROM "actividad" WHERE "acticodigos"=\''.$acticodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function getByIdActividad($acticodigos) {
		$sql = 'SELECT * FROM "actividad" WHERE "acticodigos"=\''.$acticodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getAllActividad() {
		$sql = 'SELECT * FROM "actividad"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getActicodigos($acticodigos) {
		$sql = 'SELECT "acticodigos" FROM "actividad" WHERE "acticodigos"=\''.$acticodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getActinombres($acticodigos) {
		$sql = 'SELECT "actinombres" FROM "actividad" WHERE "acticodigos"=\''.$acticodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getActivalorn($acticodigos) {
		$sql = 'SELECT "activalorn" FROM "actividad" WHERE "acticodigos"=\''.$acticodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getActiobservas($acticodigos) {
		$sql = 'SELECT "actiobservas" FROM "actividad" WHERE "acticodigos"=\''.$acticodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getActiactivas($acticodigos) {
		$sql = 'SELECT "actiactivas" FROM "actividad" WHERE "acticodigos"=\''.$acticodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

} //End of Class Actividad
?>