<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeGePgsqlTipoarchivo {
	var $consult;
	var $objdb;
	function FeGePgsqlTipoarchivo() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	function existTipoarchivo($tiarcodigos) {
		$sql = 'SELECT * FROM "tipoarchivo" WHERE "tiarcodigos"=\''.$tiarcodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}
	function addTipoarchivo($tiarcodigos, $tiarnombres, $tiarobservas, $tiarestados) {
		$sql = 'INSERT INTO "tipoarchivo" ("tiarcodigos","tiarnombres","tiarobservas","tiarestados")'
		.' VALUES(\''.$tiarcodigos.'\',\''.$tiarnombres.'\',\''.$tiarobservas.'\', \''.$tiarestados.'\')';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function updateTipoarchivo($tiarcodigos, $tiarnombres, $tiarobservas, $tiarestados) {
		$sql = 'UPDATE "tipoarchivo" SET "tiarnombres"=\''.$tiarnombres.'\',"tiarobservas"=\''.$tiarobservas.'\', "tiarestados"=\''.$tiarestados.'\' WHERE "tiarcodigos"=\''.$tiarcodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function deleteTipoarchivo($tiarcodigos) {
		$sql = 'DELETE FROM "tipoarchivo" WHERE "tiarcodigos"=\''.$tiarcodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function getByIdTipoarchivo($tiarcodigos) {
		$sql = 'SELECT * FROM "tipoarchivo" WHERE "tiarcodigos"=\''.$tiarcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getAllTipoarchivo() {
		$sql = 'SELECT * FROM "tipoarchivo"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getTiarcodigos($tiarcodigos) {
		$sql = 'SELECT "tiarcodigos" FROM "tipoarchivo" WHERE "tiarcodigos"=\''.$tiarcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getTiarnombres($tiarcodigos) {
		$sql = 'SELECT "tiarnombres" FROM "tipoarchivo" WHERE "tiarcodigos"=\''.$tiarcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getTiarobservas($tiarcodigos) {
		$sql = 'SELECT "tiarobservas" FROM "tipoarchivo" WHERE "tiarcodigos"=\''.$tiarcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getTiarestados($tiarcodigos) {
		$sql = 'SELECT "tiarestados" FROM "tipoarchivo" WHERE "tiarcodigos"=\''.$tiarcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Tipoarchivo
?>