<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeCrPgsqlOrden_log {
	var $consult;
	var $objdb;

	function FeCrPgsqlOrden_log() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}

	function existOrden_log($orlonumeron) {
		$sql = 'SELECT * FROM "orden_log" WHERE "orlonumeron"='.$orlonumeron.' ';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}

	function addOrden_log($orlonumeron, $orlousuarios, $orlofecingd, $ordenumeros, $proccodigos, $ordesitiejes, $usuacodigos, $ordeestaacs, $ordeobservs, $ordefecingd, $ordefecregd, $ordefecvend, $ordefecfinad, $ordefecentn) {
		$sql = 'INSERT INTO "orden_log" ("orlonumeron","orlousuarios","orlofecingd","ordenumeros","proccodigos","ordesitiejes","usuacodigos","ordeestaacs","ordeobservs","ordefecingd","ordefecregd","ordefecvend","ordefecfinad","ordefecentn")'
		.' VALUES('.$orlonumeron.',\''.$orlousuarios.'\', '.$orlofecingd.' ,\''.$ordenumeros.'\',\''.$proccodigos.'\',\''.$ordesitiejes.'\',\''.$usuacodigos.'\',\''.$ordeestaacs.'\',\''.$ordeobservs.'\','.$ordefecingd.' ,'.$ordefecregd.' ,'.$ordefecvend.' ,'.$ordefecfinad.' ,'.$ordefecentn.' )';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function updateOrden_log($orlonumeron, $orlousuarios, $orlofecingd, $ordenumeros, $proccodigos, $ordesitiejes, $usuacodigos, $ordeestaacs, $ordeobservs, $ordefecingd, $ordefecregd, $ordefecvend, $ordefecfinad, $ordefecentn) {
		$sql = 'UPDATE "orden_log" SET "orlousuarios"=\''.$orlousuarios.'\', "orlofecingd"='.$orlofecingd.' ,"ordenumeros"=\''.$ordenumeros.'\',"proccodigos"=\''.$proccodigos.'\',"ordesitiejes"=\''.$ordesitiejes.'\',"usuacodigos"=\''.$usuacodigos.'\',"ordeestaacs"=\''.$ordeestaacs.'\',"ordeobservs"=\''.$ordeobservs.'\',"ordefecingd"='.$ordefecingd.' ,"ordefecregd"='.$ordefecregd.' ,"ordefecvend"='.$ordefecvend.' ,"ordefecfinad"='.$ordefecfinad.' ,"ordefecentn"='.$ordefecentn.' WHERE "orlonumeron"='.$orlonumeron.' ';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function deleteOrden_log($orlonumeron) {
		$sql = 'DELETE FROM "orden_log" WHERE "orlonumeron"='.$orlonumeron.' ';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function getByIdOrden_log($orlonumeron) {
		$sql = 'SELECT * FROM "orden_log" WHERE "orlonumeron"='.$orlonumeron.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getAllOrden_log() {
		$sql = 'SELECT * FROM "orden_log"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getOrlonumeron($orlonumeron) {
		$sql = 'SELECT "orlonumeron" FROM "orden_log" WHERE "orlonumeron"='.$orlonumeron.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	
	function getOrlousuarios($orlonumeron) {
		$sql = 'SELECT "orlousuarios" FROM "orden_log" WHERE "orlonumeron"='.$orlonumeron.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getOrlofecingd($orlonumeron) {
		$sql = 'SELECT "orlofecingd" FROM "orden_log" WHERE "orlonumeron"='.$orlonumeron.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getOrdenumeros($orlonumeron) {
		$sql = 'SELECT "ordenumeros" FROM "orden_log" WHERE "orlonumeron"='.$orlonumeron.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getProccodigos($orlonumeron) {
		$sql = 'SELECT "proccodigos" FROM "orden_log" WHERE "orlonumeron"='.$orlonumeron.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getOrdesitiejes($orlonumeron) {
		$sql = 'SELECT "ordesitiejes" FROM "orden_log" WHERE "orlonumeron"='.$orlonumeron.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getUsuacodigos($orlonumeron) {
		$sql = 'SELECT "usuacodigos" FROM "orden_log" WHERE "orlonumeron"='.$orlonumeron.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getOrdeestaacs($orlonumeron) {
		$sql = 'SELECT "ordeestaacs" FROM "orden_log" WHERE "orlonumeron"='.$orlonumeron.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getOrdeobservs($orlonumeron) {
		$sql = 'SELECT "ordeobservs" FROM "orden_log" WHERE "orlonumeron"='.$orlonumeron.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getOrdefecingd($orlonumeron) {
		$sql = 'SELECT "ordefecingd" FROM "orden_log" WHERE "orlonumeron"='.$orlonumeron.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getOrdefecregd($orlonumeron) {
		$sql = 'SELECT "ordefecregd" FROM "orden_log" WHERE "orlonumeron"='.$orlonumeron.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getOrdefecvend($orlonumeron) {
		$sql = 'SELECT "ordefecvend" FROM "orden_log" WHERE "orlonumeron"='.$orlonumeron.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getOrdefecfinad($orlonumeron) {
		$sql = 'SELECT "ordefecfinad" FROM "orden_log" WHERE "orlonumeron"='.$orlonumeron.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getOrdefecentn($orlonumeron) {
		$sql = 'SELECT "ordefecentn" FROM "orden_log" WHERE "orlonumeron"='.$orlonumeron.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

} //End of Class Orden_log
?>