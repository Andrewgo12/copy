<?php 		
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeCrPgsqlAnexos {
	var $consult;
	var $objdb;

	function FeCrPgsqlAnexos() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}

	function existAnexos($ordenumeros, $anexcodigon) {
		$sql = 'SELECT * FROM "anexos" WHERE "ordenumeros"=\''.$ordenumeros.'\' AND "anexcodigon"='.$anexcodigon.' ';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}

	function addAnexos($ordenumeros, $anexcodigon, $anexnombarch, $anexfechingn, $usuacodigos) {
		$sql = 'INSERT INTO "anexos" ("ordenumeros","anexcodigon","anexnombarch","anexfechingn","usuacodigos") VALUES(\''.$ordenumeros.'\','.$anexcodigon.' ,\''.$anexnombarch.'\','.$anexfechingn.' ,\''.$usuacodigos.'\')';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function updateAnexos($ordenumeros, $anexcodigon, $anexnombarch, $anexfechingn, $usuacodigos) {
		$sql = 'UPDATE "anexos" SET "anexnombarch"=\''.$anexnombarch.'\',"anexfechingn"='.$anexfechingn.' ,"usuacodigos"=\''.$usuacodigos.'\' WHERE "ordenumeros"=\''.$ordenumeros.'\' AND "anexcodigon"='.$anexcodigon.' ';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function deleteAnexos($ordenumeros, $anexcodigon) {
		$sql = 'DELETE FROM "anexos" WHERE "ordenumeros"=\''.$ordenumeros.'\' AND "anexcodigon"='.$anexcodigon.' ';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function getByIdAnexos($ordenumeros, $anexcodigon) {
		$sql = 'SELECT * FROM "anexos" WHERE "ordenumeros"=\''.$ordenumeros.'\' AND "anexcodigon"='.$anexcodigon.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getAllAnexos() {
		$sql = 'SELECT * FROM "anexos"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getByAnexos_fkey($ordenumeros) {
		$sql = 'SELECT * FROM "anexos" WHERE "ordenumeros"=\''.$ordenumeros.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getOrdenumeros($ordenumeros, $anexcodigon) {
		$sql = 'SELECT "ordenumeros" FROM "anexos" WHERE "ordenumeros"=\''.$ordenumeros.'\' AND "anexcodigon"='.$anexcodigon.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getAnexcodigon($ordenumeros, $anexcodigon) {
		$sql = 'SELECT "anexcodigon" FROM "anexos" WHERE "ordenumeros"=\''.$ordenumeros.'\' AND "anexcodigon"='.$anexcodigon.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getanexnombarch($ordenumeros, $anexcodigon) {
		$sql = 'SELECT "anexnombarch" FROM "anexos" WHERE "ordenumeros"=\''.$ordenumeros.'\' AND "anexcodigon"='.$anexcodigon.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getAnexfechingn($ordenumeros, $anexcodigon) {
		$sql = 'SELECT "anexfechingn" FROM "anexos" WHERE "ordenumeros"=\''.$ordenumeros.'\' AND "anexcodigon"='.$anexcodigon.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getUsuacodigos($ordenumeros, $anexcodigon) {
		$sql = 'SELECT "usuacodigos" FROM "anexos" WHERE "ordenumeros"=\''.$ordenumeros.'\' AND "anexcodigon"='.$anexcodigon.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

} //End of Class Anexos
?>