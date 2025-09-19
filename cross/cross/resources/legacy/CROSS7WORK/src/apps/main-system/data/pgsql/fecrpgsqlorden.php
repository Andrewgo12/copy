<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeCrPgsqlOrden {
	var $consult;
	var $objdb;
	function FeCrPgsqlOrden() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	function existOrden($ordenumeros) {
		$sql = 'SELECT * FROM "orden" WHERE "ordenumeros"=\''.$ordenumeros.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}
	function addOrden($ordenumeros, $proccodigos, $ordesitiejes, $usuacodigos, $ordeestaacs,  $ordeobservs, $ordefecingd, $ordefecregd, $ordefecvend, $ordefecfinad, $ordefecentn) {
		$sql = 'INSERT INTO "orden" ("ordenumeros","proccodigos","ordesitiejes","usuacodigos","ordeestaacs","ordeobservs","ordefecingd","ordefecregd","ordefecvend","ordefecfinad","ordefecentn")'
		.' VALUES(\''.$ordenumeros.'\',\''.$proccodigos.'\',\''.$ordesitiejes.'\',\''.$usuacodigos.'\',\''.$ordeestaacs.'\',\''.$ordeobservs.'\','.$ordefecingd.' ,'.$ordefecregd.' ,'.$ordefecvend.' ,'.$ordefecfinad.' ,'.$ordefecentn.' )';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function updateOrden($ordenumeros, $proccodigos, $ordesitiejes, $usuacodigos, $ordeestaacs,  $ordeobservs, $ordefecingd, $ordefecregd, $ordefecvend, $ordefecfinad, $ordefecentn) {
		$sql = 'UPDATE "orden" SET "proccodigos"=\''.$proccodigos.'\',"ordesitiejes"=\''.$ordesitiejes.'\',"usuacodigos"=\''.$usuacodigos.'\',"ordeestaacs"=\''.$ordeestaacs.'\',"ordeobservs"=\''.$ordeobservs.'\',"ordefecingd"='.$ordefecingd.' ,"ordefecregd"='.$ordefecregd.' ,"ordefecvend"='.$ordefecvend.' ,"ordefecfinad"='.$ordefecfinad.' ,"ordefecentn"='.$ordefecentn.' WHERE "ordenumeros"=\''.$ordenumeros.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function deleteOrden($ordenumeros) {
		$sql = 'SELECT fnDeleteOrden(\''.$ordenumeros.'\')';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function getByIdOrden($ordenumeros) {
		$sql = 'SELECT * FROM "orden" WHERE "ordenumeros"=\''.$ordenumeros.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getAllOrden() {
		$sql = 'SELECT * FROM "orden"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getByOrden_fkey($proccodigos) {
		$sql = 'SELECT * FROM "orden" WHERE "proccodigos"=\''.$proccodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getByOrden_fkey2($ordeestaacs) {
		$sql = 'SELECT * FROM "orden" WHERE "ordeestaacs"=\''.$ordeestaacs.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getByOrden_fkey3($ordeestaans) {
		$sql = 'SELECT * FROM "orden" WHERE ordeestaans=\''.$ordeestaans.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getOrdenumeros($ordenumeros) {
		$sql = 'SELECT "ordenumeros" FROM "orden" WHERE "ordenumeros"=\''.$ordenumeros.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getProccodigos($ordenumeros) {
		$sql = 'SELECT "proccodigos" FROM "orden" WHERE "ordenumeros"=\''.$ordenumeros.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getOrdesitiejes($ordenumeros) {
		$sql = 'SELECT "ordesitiejes" FROM "orden" WHERE "ordenumeros"=\''.$ordenumeros.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getUsuacodigos($ordenumeros) {
		$sql = 'SELECT "usuacodigos" FROM "orden" WHERE "ordenumeros"=\''.$ordenumeros.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getOrdeestaacs($ordenumeros) {
		$sql = 'SELECT "ordeestaacs" FROM "orden" WHERE "ordenumeros"=\''.$ordenumeros.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getOrdeobservs($ordenumeros) {
		$sql = 'SELECT "ordeobservs" FROM "orden" WHERE "ordenumeros"=\''.$ordenumeros.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getOrdefecingd($ordenumeros) {
		$sql = 'SELECT "ordefecingd" FROM "orden" WHERE "ordenumeros"=\''.$ordenumeros.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getOrdefecregd($ordenumeros) {
		$sql = 'SELECT "ordefecregd" FROM "orden" WHERE "ordenumeros"=\''.$ordenumeros.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getOrdefecvend($ordenumeros) {
		$sql = 'SELECT "ordefecvend" FROM "orden" WHERE "ordenumeros"=\''.$ordenumeros.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getOrdefecfinad($ordenumeros) {
		$sql = 'SELECT "ordefecfinad" FROM "orden" WHERE "ordenumeros"=\''.$ordenumeros.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getOrdefecentn($ordenumeros) {
		$sql = 'SELECT "ordefecentn" FROM "orden" WHERE "ordenumeros"=\''.$ordenumeros.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Orden
?>