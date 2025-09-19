<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeGePgsqlCampconfform {
	var $consult;
	var $objdb;

	function FeGePgsqlCampconfform() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}

	function existCampconfform($cacocodigon) {
		$sql = 'SELECT * FROM "campconfform" WHERE "cacocodigon"='.$cacocodigon.' ';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}

	function addCampconfform($cacocodigon, $caconombres, $cacoprocedes) {
		$sql = 'INSERT INTO "campconfform" ("cacocodigon","caconombres","cacoprocedes")'
		.' VALUES('.$cacocodigon.' ,\''.$caconombres.'\',\''.$cacoprocedes.'\')';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function updateCampconfform($cacocodigon, $caconombres, $cacoprocedes) {
		$sql = 'UPDATE "campconfform" SET "caconombres"=\''.$caconombres.'\',"cacoprocedes"=\''.$cacoprocedes.'\' WHERE "cacocodigon"='.$cacocodigon.' ';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function deleteCampconfform($cacocodigon) {
		$sql = 'DELETE FROM "campconfform" WHERE "cacocodigon"='.$cacocodigon.' ';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function getByIdCampconfform($cacocodigon) {
		$sql = 'SELECT * FROM "campconfform" WHERE "cacocodigon"='.$cacocodigon.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getAllCampconfform() {
		$sql = 'SELECT * FROM "campconfform"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getCacocodigon($cacocodigon) {
		$sql = 'SELECT "cacocodigon" FROM "campconfform" WHERE "cacocodigon"='.$cacocodigon.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getCaconombres($cacocodigon) {
		$sql = 'SELECT "caconombres" FROM "campconfform" WHERE "cacocodigon"='.$cacocodigon.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getCacoprocedes($cacocodigon) {
		$sql = 'SELECT "cacoprocedes" FROM "campconfform" WHERE "cacocodigon"='.$cacocodigon.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

} //End of Class Campconfform
?>