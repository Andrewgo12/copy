<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeStPgsqlProveedor {
	var $consult;
	var $objdb;
	function FeStPgsqlProveedor() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	function existProveedor($provcodigos) {
		$sql = 'SELECT * FROM "proveedor" WHERE "provcodigos"=\''.$provcodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}
	function addProveedor($provcodigos, $provnombres, $provnnomreprs, $provdireccis, $protelefons, $provemails, $provwebs, $paiscodigos, $depacodigos, $ciudcodigos) {
		$sql = 'INSERT INTO "proveedor" ("provcodigos","provnombres","provnnomreprs","provdireccis","protelefons","provemails","provwebs","paiscodigos","depacodigos","ciudcodigos")'
		.' VALUES(\''.$provcodigos.'\',\''.$provnombres.'\',\''.$provnnomreprs.'\',\''.$provdireccis.'\',\''.$protelefons.'\',\''.$provemails.'\',\''.$provwebs.'\',\''.$paiscodigos.'\',\''.$depacodigos.'\',\''.$ciudcodigos.'\')';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function updateProveedor($provcodigos, $provnombres, $provnnomreprs, $provdireccis, $protelefons, $provemails, $provwebs, $paiscodigos, $depacodigos, $ciudcodigos,$provactivas) {
		$sql = 'UPDATE "proveedor" SET "provnombres"=\''.$provnombres.'\',"provnnomreprs"=\''.$provnnomreprs.'\',"provdireccis"=\''.$provdireccis.'\',"protelefons"=\''.$protelefons.'\',"provemails"=\''.$provemails.'\',"provwebs"=\''.$provwebs.'\',"paiscodigos"=\''.$paiscodigos.'\',"depacodigos"=\''.$depacodigos.'\',"ciudcodigos"=\''.$ciudcodigos.'\',"provactivas"=\''.$provactivas.'\' WHERE "provcodigos"=\''.$provcodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function deleteProveedor($provcodigos) {
		$sql = 'DELETE FROM "proveedor" WHERE "provcodigos"=\''.$provcodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function getByIdProveedor($provcodigos) {
		$sql = 'SELECT * FROM "proveedor" WHERE "provcodigos"=\''.$provcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getAllProveedor() {
		$sql = 'SELECT * FROM "proveedor"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getProvcodigos($provcodigos) {
		$sql = 'SELECT "provcodigos" FROM "proveedor" WHERE "provcodigos"=\''.$provcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getProvnombres($provcodigos) {
		$sql = 'SELECT "provnombres" FROM "proveedor" WHERE "provcodigos"=\''.$provcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getProvnnomreprs($provcodigos) {
		$sql = 'SELECT "provnnomreprs" FROM "proveedor" WHERE "provcodigos"=\''.$provcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getProvdireccis($provcodigos) {
		$sql = 'SELECT "provdireccis" FROM "proveedor" WHERE "provcodigos"=\''.$provcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getProtelefons($provcodigos) {
		$sql = 'SELECT "protelefons" FROM "proveedor" WHERE "provcodigos"=\''.$provcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getProvemails($provcodigos) {
		$sql = 'SELECT "provemails" FROM "proveedor" WHERE "provcodigos"=\''.$provcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getProvwebs($provcodigos) {
		$sql = 'SELECT "provwebs" FROM "proveedor" WHERE "provcodigos"=\''.$provcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getPaiscodigos($provcodigos) {
		$sql = 'SELECT "paiscodigos" FROM "proveedor" WHERE "provcodigos"=\''.$provcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getDepacodigos($provcodigos) {
		$sql = 'SELECT "depacodigos" FROM "proveedor" WHERE "provcodigos"=\''.$provcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getCiudcodigos($provcodigos) {
		$sql = 'SELECT "ciudcodigos" FROM "proveedor" WHERE "provcodigos"=\''.$provcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Proveedor
?>