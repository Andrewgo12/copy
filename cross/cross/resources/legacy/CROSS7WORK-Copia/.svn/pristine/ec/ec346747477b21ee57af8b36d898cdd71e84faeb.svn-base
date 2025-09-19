<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeStPgsqlProveerecurs {
	var $consult;
	var $objdb;
	function FeStPgsqlProveerecurs() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	function existProveerecurs($prrecodigos) {
		$sql = 'SELECT * FROM "proveerecurs" WHERE "prrecodigos"=\''.$prrecodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}
	function addProveerecurs($prrecodigos, $provcodigos, $recucodigos, $prrevalorecf) {
		$sql = 'INSERT INTO "proveerecurs" ("prrecodigos","provcodigos","recucodigos","prrevalorecf")'
		.' VALUES(\''.$prrecodigos.'\',\''.$provcodigos.'\',\''.$recucodigos.'\','.$prrevalorecf.' )';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function updateProveerecurs($prrecodigos, $provcodigos, $recucodigos, $prrevalorecf) {
		$sql = 'UPDATE "proveerecurs" SET "provcodigos"=\''.$provcodigos.'\',"recucodigos"=\''.$recucodigos.'\',"prrevalorecf"='.$prrevalorecf.' WHERE "prrecodigos"=\''.$prrecodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function deleteProveerecurs($prrecodigos) {
		$sql = 'DELETE FROM "proveerecurs" WHERE "prrecodigos"=\''.$prrecodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function getByIdProveerecurs($prrecodigos) {
		$sql = 'SELECT * FROM "proveerecurs" WHERE "prrecodigos"=\''.$prrecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getAllProveerecurs() {
		$sql = 'SELECT * FROM "proveerecurs"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getByProveerecurs_fkey($provcodigos) {
		$sql = 'SELECT * FROM "proveerecurs" WHERE "provcodigos"=\''.$provcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getByProveerecurs_fkey1($recucodigos) {
		$sql = 'SELECT * FROM "proveerecurs" WHERE "recucodigos"=\''.$recucodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getPrrecodigos($prrecodigos) {
		$sql = 'SELECT "prrecodigos" FROM "proveerecurs" WHERE "prrecodigos"=\''.$prrecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getProvcodigos($prrecodigos) {
		$sql = 'SELECT "provcodigos" FROM "proveerecurs" WHERE "prrecodigos"=\''.$prrecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getRecucodigos($prrecodigos) {
		$sql = 'SELECT "recucodigos" FROM "proveerecurs" WHERE "prrecodigos"=\''.$prrecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getPrrevalorecf($prrecodigos) {
		$sql = 'SELECT "prrevalorecf" FROM "proveerecurs" WHERE "prrecodigos"=\''.$prrecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Proveerecurs
?>