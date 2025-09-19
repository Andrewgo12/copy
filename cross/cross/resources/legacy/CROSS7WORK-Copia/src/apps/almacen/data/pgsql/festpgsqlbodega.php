<?php  
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeStPgsqlBodega {
	var $consult;
	var $objdb;
	function FeStPgsqlBodega() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	function existBodega($bodecodigos) {
		$sql = 'SELECT * FROM "bodega" WHERE "bodecodigos"=\''.$bodecodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}
	function addBodega($bodecodigos, $tibocodigos, $bodenombres, $bodedescrips, $orgacodigos, $bodefechcred, $bodefechfind, $bodeestados) {
		$sql = 'INSERT INTO "bodega" ("bodecodigos","tibocodigos","bodenombres","orgacodigos","bodefechcred","bodefechfind","bodedescrips")'
		.' VALUES(\''.$bodecodigos.'\',\''.$tibocodigos.'\',\''.$bodenombres.'\',\''.$orgacodigos.'\',\''.$bodefechcred.'\',\''.$bodefechfind.'\',\''.$bodedescrips.'\')';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function updateBodega($bodecodigos, $tibocodigos, $bodenombres, $bodedescrips, $orgacodigos, $bodefechcred, $bodefechfind, $bodeestados) {
		if ($bodeestados) {
			$bodeestados = ",\"bodeestados\"='$bodeestados'";
		}
		$sql = 'UPDATE "bodega" SET "tibocodigos"=\''.$tibocodigos.'\',"bodenombres"=\''.$bodenombres.'\',"bodedescrips"=\''.$bodedescrips.'\',"orgacodigos"=\''.$orgacodigos.'\',"bodefechcred"=\''.$bodefechcred.'\',"bodefechfind"=\''.$bodefechfind.'\',"bodeestados"=\''.$bodeestados.'\' WHERE "bodecodigos"=\''.$bodecodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function deleteBodega($bodecodigos) {
		$sql = 'DELETE FROM "bodega" WHERE "bodecodigos"=\''.$bodecodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function getByIdBodega($bodecodigos) {
		$sql = 'SELECT * FROM "bodega" WHERE "bodecodigos"=\''.$bodecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getAllBodega() {
		$sql = 'SELECT * FROM "bodega"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getByBodega_fkey($tibocodigos) {
		$sql = 'SELECT * FROM "bodega" WHERE "tibocodigos"=\''.$tibocodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getBodecodigos($bodecodigos) {
		$sql = 'SELECT "bodecodigos" FROM "bodega" WHERE "bodecodigos"=\''.$bodecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getTibocodigos($bodecodigos) {
		$sql = 'SELECT "tibocodigos" FROM "bodega" WHERE "bodecodigos"=\''.$bodecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getbodenombres($bodecodigos) {
		$sql = 'SELECT "bodenombres" FROM "bodega" WHERE "bodecodigos"=\''.$bodecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getBodedescrips($bodecodigos) {
		$sql = 'SELECT "bodedescrips" FROM "bodega" WHERE "bodecodigos"=\''.$bodecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getOrgacodigos($bodecodigos) {
		$sql = 'SELECT "orgacodigos" FROM "bodega" WHERE "bodecodigos"=\''.$bodecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getBodefechcred($bodecodigos) {
		$sql = 'SELECT "bodefechcred" FROM "bodega" WHERE "bodecodigos"=\''.$bodecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getBodefechfind($bodecodigos) {
		$sql = 'SELECT "bodefechfind" FROM "bodega" WHERE "bodecodigos"=\''.$bodecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getBodeestados($bodecodigos) {
		$sql = 'SELECT "bodeestados" FROM "bodega" WHERE "bodecodigos"=\''.$bodecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Bodega
?>