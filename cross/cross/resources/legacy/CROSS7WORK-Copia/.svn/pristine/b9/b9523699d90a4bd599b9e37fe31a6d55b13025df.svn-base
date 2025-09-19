<?php
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeCuPgsqlIpsservicio {
	var $consult;
	var $objdb;
	function FeCuPgsqlIpsservicio() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	function existIpsservicio($ipsecodigos) {
		$sql = 'SELECT * FROM "ipsservicio" WHERE "ipsecodigos"=\''.$ipsecodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}
	function addIpsservicio($ipsecodigos, $ipsenombres, $ipsedescrips, $ipseactivos) {
		$sql = 'INSERT INTO "ipsservicio" ("ipsecodigos","ipsenombres","ipsedescrips","ipseactivos")'
		.' VALUES(\''.$ipsecodigos.'\',\''.$ipsenombres.'\',\''.$ipsedescrips.'\',\''.$ipseactivos.'\')';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function updateIpsservicio($ipsecodigos, $ipsenombres, $ipsedescrips, $ipseactivos) {
		$sql = 'UPDATE "ipsservicio" SET "ipsenombres"=\''.$ipsenombres.'\',"ipsedescrips"=\''
		.$ipsedescrips.'\',"ipseactivos"=\''.$ipseactivos.'\''
		.' WHERE "ipsecodigos"=\''.$ipsecodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function deleteIpsservicio($ipsecodigos) {
		$sql = 'DELETE FROM "ipsservicio" WHERE "ipsecodigos"=\''.$ipsecodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function getByIdIpsservicio($ipsecodigos) {
		$sql = 'SELECT * FROM "ipsservicio" WHERE "ipsecodigos"=\''.$ipsecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getAllIpsservicio() {
		$sql = 'SELECT * FROM "ipsservicio" ORDER BY "ipsenombres"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getIpsecodigos($ipsecodigos) {
		$sql = 'SELECT "ipsecodigos" FROM "ipsservicio" WHERE "ipsecodigos"=\''.$ipsecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getIpsenombres($ipsecodigos) {
		$sql = 'SELECT "ipsenombres" FROM "ipsservicio" WHERE "ipsecodigos"=\''.$ipsecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getIpsedescrips($ipsecodigos) {
		$sql = 'SELECT "ipsedescrips" FROM "ipsservicio" WHERE "ipsecodigos"=\''.$ipsecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getIpseactivos($ipsecodigos) {
		$sql = 'SELECT "ipseactivos" FROM "ipsservicio" WHERE "ipsecodigos"=\''.$ipsecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Ipsservicio
?>