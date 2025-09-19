<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeStPgsqlConcepmovimi {
	var $consult;
	var $objdb;
	function FeStPgsqlConcepmovimi() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	function existConcepmovimi($comocodigos) {
		$sql = 'SELECT * FROM "concepmovimi" WHERE "comocodigos"=\''.$comocodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}
	function addConcepmovimi($comocodigos, $comonombres, $comosentidos, $comodescrips) {
		$sql = 'INSERT INTO "concepmovimi" ("comocodigos","comonombres","comosentidos","comodescrips")'
		.' VALUES(\''.$comocodigos.'\',\''.$comonombres.'\',\''.$comosentidos.'\',\''.$comodescrips.'\')';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function updateConcepmovimi($comocodigos, $comonombres, $comosentidos, $comodescrips,$comoactivas) {
		$sql = 'UPDATE "concepmovimi" SET "comonombres"=\''.$comonombres.'\',"comosentidos"=\''.$comosentidos.'\',"comodescrips"=\''.$comodescrips.'\',"comoactivas"=\''.$comoactivas.'\' WHERE "comocodigos"=\''.$comocodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function deleteConcepmovimi($comocodigos) {
		$sql = 'DELETE FROM "concepmovimi" WHERE "comocodigos"=\''.$comocodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function getByIdConcepmovimi($comocodigos) {
		$sql = 'SELECT * FROM "concepmovimi" WHERE "comocodigos"=\''.$comocodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getAllConcepmovimi() {
		$sql = 'SELECT * FROM "concepmovimi"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getComocodigos($comocodigos) {
		$sql = 'SELECT "comocodigos" FROM "concepmovimi" WHERE "comocodigos"=\''.$comocodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getComonombres($comocodigos) {
		$sql = 'SELECT "comonombres" FROM "concepmovimi" WHERE "comocodigos"=\''.$comocodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getComosentidos($comocodigos) {
		$sql = 'SELECT "comosentidos" FROM "concepmovimi" WHERE "comocodigos"=\''.$comocodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getComodescrips($comocodigos) {
		$sql = 'SELECT "comodescrips" FROM "concepmovimi" WHERE "comocodigos"=\''.$comocodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Concepmovimi
?>