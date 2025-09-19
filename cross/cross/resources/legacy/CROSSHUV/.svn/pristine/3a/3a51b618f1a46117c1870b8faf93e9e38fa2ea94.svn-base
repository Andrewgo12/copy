<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeCuPgsqlFormapago {
	var $consult;
	var $objdb;
	function FeCuPgsqlFormapago() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	function existFormapago($fopacodigos) {
		$sql = 'SELECT * FROM "formapago" WHERE "fopacodigos"=\''.$fopacodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}
	function addFormapago($fopacodigos, $fopanombres, $fopatiempon, $fopacancuotn, $fopadescrips, $fopaactivos) {
		$sql = 'INSERT INTO "formapago" ("fopacodigos","fopanombres","fopatiempon","fopacancuotn","fopadescrips","fopaactivos")'
		.' VALUES(\''.$fopacodigos.'\',\''.$fopanombres.'\',\''.$fopatiempon.'\','.$fopacancuotn.' ,\''.$fopadescrips.'\',\''.$fopaactivos.'\')';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function updateFormapago($fopacodigos, $fopanombres, $fopatiempon, $fopacancuotn, $fopadescrips, $fopaactivos) {
		$sql = 'UPDATE "formapago" SET "fopanombres"=\''.$fopanombres.'\',"fopatiempon"=\''.$fopatiempon.'\',"fopacancuotn"='.$fopacancuotn.' ,"fopadescrips"=\''.$fopadescrips.'\',"fopaactivos"=\''.$fopaactivos.'\' WHERE "fopacodigos"=\''.$fopacodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function deleteFormapago($fopacodigos) {
		$sql = 'DELETE FROM "formapago" WHERE "fopacodigos"=\''.$fopacodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function getByIdFormapago($fopacodigos) {
		$sql = 'SELECT * FROM "formapago" WHERE "fopacodigos"=\''.$fopacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getAllFormapago() {
		$sql = 'SELECT * FROM "formapago"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getFopacodigos($fopacodigos) {
		$sql = 'SELECT "fopacodigos" FROM "formapago" WHERE "fopacodigos"=\''.$fopacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getFopanombres($fopacodigos) {
		$sql = 'SELECT "fopanombres" FROM "formapago" WHERE "fopacodigos"=\''.$fopacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getFopatiempon($fopacodigos) {
		$sql = 'SELECT "fopatiempon" FROM "formapago" WHERE "fopacodigos"=\''.$fopacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getFopacancuotn($fopacodigos) {
		$sql = 'SELECT "fopacancuotn" FROM "formapago" WHERE "fopacodigos"=\''.$fopacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getFopadescrips($fopacodigos) {
		$sql = 'SELECT "fopadescrips" FROM "formapago" WHERE "fopacodigos"=\''.$fopacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getFopaactivos($fopacodigos) {
		$sql = 'SELECT "fopaactivos" FROM "formapago" WHERE "fopacodigos"=\''.$fopacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Formapago
?>