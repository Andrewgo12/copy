<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeStPgsqlMovimialmace {
	var $consult;
	var $objdb;
	function FeStPgsqlMovimialmace() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	function existMovimialmace($moalcodigos) {
		$sql = 'SELECT * FROM "movimialmace" WHERE "moalcodigos"=\''.$moalcodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}
	function addMovimialmace($moalcodigos, $bodecodigos, $recucodigos, $moalfechmovd, $comocodigos, $moalcantrecf, $perscodigos, $tidocodigos, $moalnumedocs, $moalsignos) {
		$sql = 'INSERT INTO "movimialmace" ("moalcodigos","bodecodigos","recucodigos","moalfechmovd","comocodigos","moalcantrecf","perscodigos","tidocodigos","moalnumedocs","moalsignos")'
		.' VALUES(\''.$moalcodigos.'\',\''.$bodecodigos.'\',\''.$recucodigos.'\','.$moalfechmovd.' ,\''.$comocodigos.'\','.$moalcantrecf.' ,\''.$perscodigos.'\',\''.$tidocodigos.'\',\''.$moalnumedocs.'\',\''.$moalsignos.'\')';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function updateMovimialmace($moalcodigos, $bodecodigos, $recucodigos, $moalfechmovd, $comocodigos, $moalcantrecf, $perscodigos, $tidocodigos, $moalnumedocs, $moalsignos) {
		$sql = 'UPDATE "movimialmace" SET "bodecodigos"=\''.$bodecodigos.'\',"recucodigos"=\''.$recucodigos.'\',"moalfechmovd"='.$moalfechmovd.' ,"comocodigos"=\''.$comocodigos.'\',"moalcantrecf"='.$moalcantrecf.' ,"perscodigos"=\''.$perscodigos.'\',"tidocodigos"=\''.$tidocodigos.'\',"moalnumedocs"=\''.$moalnumedocs.'\',"moalsignos"=\''.$moalsignos.'\' WHERE "moalcodigos"=\''.$moalcodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function deleteMovimialmace($moalcodigos) {
		$sql = 'DELETE FROM "movimialmace" WHERE "moalcodigos"=\''.$moalcodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function getByIdMovimialmace($moalcodigos) {
		$sql = 'SELECT * FROM "movimialmace" WHERE "moalcodigos"=\''.$moalcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getAllMovimialmace() {
		$sql = 'SELECT * FROM "movimialmace"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getByMovimialmace_fkey($bodecodigos) {
		$sql = 'SELECT * FROM "movimialmace" WHERE "bodecodigos"=\''.$bodecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getByMovimialmace_fkey1($recucodigos) {
		$sql = 'SELECT * FROM "movimialmace" WHERE "recucodigos"=\''.$recucodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getByMovimialmace_fkey2($comocodigos) {
		$sql = 'SELECT * FROM "movimialmace" WHERE "comocodigos"=\''.$comocodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getByMovimialmace_fkey4($tidocodigos) {
		$sql = 'SELECT * FROM "movimialmace" WHERE "tidocodigos"=\''.$tidocodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getMoalcodigos($moalcodigos) {
		$sql = 'SELECT "moalcodigos" FROM "movimialmace" WHERE "moalcodigos"=\''.$moalcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getBodecodigos($moalcodigos) {
		$sql = 'SELECT "bodecodigos" FROM "movimialmace" WHERE "moalcodigos"=\''.$moalcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getRecucodigos($moalcodigos) {
		$sql = 'SELECT "recucodigos" FROM "movimialmace" WHERE "moalcodigos"=\''.$moalcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getMoalfechmovd($moalcodigos) {
		$sql = 'SELECT "moalfechmovd" FROM "movimialmace" WHERE "moalcodigos"=\''.$moalcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getComocodigos($moalcodigos) {
		$sql = 'SELECT "comocodigos" FROM "movimialmace" WHERE "moalcodigos"=\''.$moalcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getMoalcantrecf($moalcodigos) {
		$sql = 'SELECT "moalcantrecf" FROM "movimialmace" WHERE "moalcodigos"=\''.$moalcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getPerscodigos($moalcodigos) {
		$sql = 'SELECT "perscodigos" FROM "movimialmace" WHERE "moalcodigos"=\''.$moalcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getTidocodigos($moalcodigos) {
		$sql = 'SELECT "tidocodigos" FROM "movimialmace" WHERE "moalcodigos"=\''.$moalcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getMoalnumedocs($moalcodigos) {
		$sql = 'SELECT "moalnumedocs" FROM "movimialmace" WHERE "moalcodigos"=\''.$moalcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getMoalsignos($moalcodigos) {
		$sql = 'SELECT "moalsignos" FROM "movimialmace" WHERE "moalcodigos"=\''.$moalcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Movimialmace
?>