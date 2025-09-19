<?php 		
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeGePgsqlDetaconfform {
	var $consult;
	var $objdb;

	function FeGePgsqlDetaconfform() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}

	function existDetaconfform($cofocodigon, $cacocodigon) {
		$sql = 'SELECT * FROM "detaconfform" WHERE "cofocodigon"='.$cofocodigon.' AND "cacocodigon"='.$cacocodigon.' ';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}

	function addDetaconfform($cofocodigon, $cacocodigon, $decooperados, $decovalors) {
		$sql = 'INSERT INTO "detaconfform" ("cofocodigon","cacocodigon","decooperados","decovalors")'
		.' VALUES('.$cofocodigon.' ,'.$cacocodigon.' ,\''.$decooperados.'\',\''.$decovalors.'\')';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function updateDetaconfform($cofocodigon, $cacocodigon, $decooperados, $decovalors) {
		$sql = 'UPDATE "detaconfform" SET "decooperados"=\''.$decooperados.'\',"decovalors"=\''.$decovalors.'\' WHERE "cofocodigon"='.$cofocodigon.' AND "cacocodigon"='.$cacocodigon.' ';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function deleteDetaconfform($cofocodigon, $cacocodigon) {
		$sql = 'DELETE FROM "detaconfform" WHERE "cofocodigon"='.$cofocodigon.' AND "cacocodigon"='.$cacocodigon.' ';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function getByIdDetaconfform($cofocodigon, $cacocodigon) {
		$sql = 'SELECT * FROM "detaconfform" WHERE "cofocodigon"='.$cofocodigon.' AND "cacocodigon"='.$cacocodigon.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getAllDetaconfform() {
		$sql = 'SELECT * FROM "detaconfform"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getByDetaconfform_fkey($cofocodigon) {
		$sql = 'SELECT * FROM "detaconfform" WHERE "cofocodigon"='.$cofocodigon.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getByDetaconfform_fkey1($cacocodigon) {
		$sql = 'SELECT * FROM "detaconfform" WHERE "cacocodigon"='.$cacocodigon.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getCofocodigon($cofocodigon, $cacocodigon) {
		$sql = 'SELECT "cofocodigon" FROM "detaconfform" WHERE "cofocodigon"='.$cofocodigon.' AND "cacocodigon"='.$cacocodigon.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getCacocodigon($cofocodigon, $cacocodigon) {
		$sql = 'SELECT "cacocodigon" FROM "detaconfform" WHERE "cofocodigon"='.$cofocodigon.' AND "cacocodigon"='.$cacocodigon.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getDecooperados($cofocodigon, $cacocodigon) {
		$sql = 'SELECT "decooperados" FROM "detaconfform" WHERE "cofocodigon"='.$cofocodigon.' AND "cacocodigon"='.$cacocodigon.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getDecovalors($cofocodigon, $cacocodigon) {
		$sql = 'SELECT "decovalors" FROM "detaconfform" WHERE "cofocodigon"='.$cofocodigon.' AND "cacocodigon"='.$cacocodigon.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

} //End of Class Detaconfform
?>