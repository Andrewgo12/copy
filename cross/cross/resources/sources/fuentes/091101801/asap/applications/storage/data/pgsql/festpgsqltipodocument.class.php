<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeStPgsqlTipodocument {
	var $consult;
	var $objdb;
	function FeStPgsqlTipodocument() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	function existTipodocument($tidocodigos) {
		$sql = 'SELECT * FROM "tipodocument" WHERE "tidocodigos"=\''.$tidocodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}
	function addTipodocument($tidocodigos, $tidonombres, $tidodescrips) {
		$sql = 'INSERT INTO "tipodocument" ("tidocodigos","tidonombres","tidodescrips")'
		.' VALUES(\''.$tidocodigos.'\',\''.$tidonombres.'\',\''.$tidodescrips.'\')';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function updateTipodocument($tidocodigos, $tidonombres, $tidodescrips, $tidoactivas) {
		$sql = 'UPDATE "tipodocument" SET "tidonombres"=\''.$tidonombres.'\',"tidodescrips"=\''.$tidodescrips.'\',"tidoactivas"=\''.$tidoactivas.'\' WHERE "tidocodigos"=\''.$tidocodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function deleteTipodocument($tidocodigos) {
		$sql = 'DELETE FROM "tipodocument" WHERE "tidocodigos"=\''.$tidocodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function getByIdTipodocument($tidocodigos) {
		$sql = 'SELECT * FROM "tipodocument" WHERE "tidocodigos"=\''.$tidocodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getAllTipodocument() {
		$sql = 'SELECT * FROM "tipodocument"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getTidocodigos($tidocodigos) {
		$sql = 'SELECT "tidocodigos" FROM "tipodocument" WHERE "tidocodigos"=\''.$tidocodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getTidonombres($tidocodigos) {
		$sql = 'SELECT "tidonombres" FROM "tipodocument" WHERE "tidocodigos"=\''.$tidocodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getTidodescrips($tidocodigos) {
		$sql = 'SELECT "tidodescrips" FROM "tipodocument" WHERE "tidocodigos"=\''.$tidocodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Tipodocument
?>