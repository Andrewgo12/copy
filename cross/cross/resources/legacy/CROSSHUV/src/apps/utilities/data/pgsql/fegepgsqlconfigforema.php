<?php 		
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeGePgsqlConfigforema {
	var $consult;
	var $objdb;

	function FeGePgsqlConfigforema() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}

	function existConfigforema($cofecodigon) {
		$sql = 'SELECT * FROM "configforema" WHERE "cofecodigon"='.$cofecodigon.' ';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}

	function addConfigforema($cofecodigon, $cofenombres, $foemcodigos) {
		$sql = 'INSERT INTO "configforema" ("cofecodigon","cofenombres","foemcodigos")'
		.' VALUES('.$cofecodigon.' ,\''.$cofenombres.'\',\''.$foemcodigos.'\')';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function updateConfigforema($cofecodigon, $cofenombres, $foemcodigos) {
		$sql = 'UPDATE "configforema" SET "cofenombres"=\''.$cofenombres.'\',"foemcodigos"=\''.$foemcodigos.'\' WHERE "cofecodigon"='.$cofecodigon.' ';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function deleteConfigforema($cofecodigon) {
		$sql = 'DELETE FROM "configforema" WHERE "cofecodigon"='.$cofecodigon.' ';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function getByIdConfigforema($cofecodigon) {
		$sql = 'SELECT * FROM "configforema" WHERE "cofecodigon"='.$cofecodigon.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getAllConfigforema() {
		$sql = 'SELECT * FROM "configforema"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getCofocodigon($cofecodigon) {
		$sql = 'SELECT "cofecodigon" FROM "configforema" WHERE "cofecodigon"='.$cofecodigon.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getCofonombres($cofecodigon) {
		$sql = 'SELECT "cofenombres" FROM "configforema" WHERE "cofecodigon"='.$cofecodigon.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getFocacodigos($cofecodigon) {
		$sql = 'SELECT "foemcodigos" FROM "configforema" WHERE "cofecodigon"='.$cofecodigon.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

} //End of Class Configforema
?>