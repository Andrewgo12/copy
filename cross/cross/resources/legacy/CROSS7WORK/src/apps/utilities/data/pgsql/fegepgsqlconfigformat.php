<?php 		
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeGePgsqlConfigformat {
	var $consult;
	var $objdb;

	function FeGePgsqlConfigformat() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}

	function existConfigformat($cofocodigon) {
		$sql = 'SELECT * FROM "configformat" WHERE "cofocodigon"='.$cofocodigon.' ';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}

	function addConfigformat($cofocodigon, $cofonombres, $focacodigos) {
		$sql = 'INSERT INTO "configformat" ("cofocodigon","cofonombres","focacodigos")'
		.' VALUES('.$cofocodigon.' ,\''.$cofonombres.'\',\''.$focacodigos.'\')';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function updateConfigformat($cofocodigon, $cofonombres, $focacodigos) {
		$sql = 'UPDATE "configformat" SET "cofonombres"=\''.$cofonombres.'\',"focacodigos"=\''.$focacodigos.'\' WHERE "cofocodigon"='.$cofocodigon.' ';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function deleteConfigformat($cofocodigon) {
		$sql = 'DELETE FROM "configformat" WHERE "cofocodigon"='.$cofocodigon.' ';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function getByIdConfigformat($cofocodigon) {
		$sql = 'SELECT * FROM "configformat" WHERE "cofocodigon"='.$cofocodigon.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getAllConfigformat() {
		$sql = 'SELECT * FROM "configformat"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getCofocodigon($cofocodigon) {
		$sql = 'SELECT "cofocodigon" FROM "configformat" WHERE "cofocodigon"='.$cofocodigon.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getCofonombres($cofocodigon) {
		$sql = 'SELECT "cofonombres" FROM "configformat" WHERE "cofocodigon"='.$cofocodigon.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getFocacodigos($cofocodigon) {
		$sql = 'SELECT "focacodigos" FROM "configformat" WHERE "cofocodigon"='.$cofocodigon.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

} //End of Class Configformat
?>