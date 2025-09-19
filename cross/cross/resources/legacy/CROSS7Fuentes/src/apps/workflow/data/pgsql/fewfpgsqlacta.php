<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeWFPgsqlActa {
	var $consult;
	var $objdb;
	function FeWFPgsqlActa() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	function existActa($actacodigos) {
		$sql = 'SELECT * FROM "acta" WHERE "actacodigos"=\''.$actacodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}
	function addActa($actacodigos, $ordenumeros, $tarecodigos, $actaestacts, $actaestants, $actafechingn, $usuacodigos, $orgacodigos, $actaactivas) {
		$sql = 'INSERT INTO "acta" ("actacodigos","ordenumeros","tarecodigos","actaestacts","actaestants","actafechingn","usuacodigos","orgacodigos","actaactivas")'
		.' VALUES(\''.$actacodigos.'\',\''.$ordenumeros.'\',\''.$tarecodigos.'\',\''.$actaestacts.'\',\''.$actaestants.'\','.$actafechingn.' ,\''.$usuacodigos.'\',\''.$orgacodigos.'\',\''.$actaactivas.'\')';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function updateActa($actacodigos, $ordenumeros, $tarecodigos, $actaestacts, $actaestants, $actafechingn, $usuacodigos, $orgacodigos, $actaactivas) {
		$sql = 'UPDATE "acta" SET "ordenumeros"=\''.$ordenumeros.'\',"tarecodigos"=\''.$tarecodigos.'\',"actaestacts"=\''.$actaestacts.'\',"actaestants"=\''.$actaestants.'\',"actafechingn"='.$actafechingn.' ,"usuacodigos"=\''.$usuacodigos.'\',"orgacodigos"=\''.$orgacodigos.'\',"actaactivas"=\''.$actaactivas.'\' WHERE "actacodigos"=\''.$actacodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function deleteActa($actacodigos) {
		$sql = 'DELETE FROM "acta" WHERE "actacodigos"=\''.$actacodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function getByIdActa($actacodigos) {
		$sql = 'SELECT * FROM "acta" WHERE "actacodigos"=\''.$actacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getAllActa() {
		$sql = 'SELECT * FROM "acta"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getByActa_fkey($ordenumeros) {
		$sql = 'SELECT * FROM "acta" WHERE "ordenumeros"=\''.$ordenumeros.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getByActa_fkey1($tarecodigos) {
		$sql = 'SELECT * FROM "acta" WHERE "tarecodigos"=\''.$tarecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getByActa_fkey2($actaestacts) {
		$sql = 'SELECT * FROM "acta" WHERE "actaestacts"=\''.$actaestacts.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getByActa_fkey3($orgacodigos) {
		$sql = 'SELECT * FROM "acta" WHERE "orgacodigos"=\''.$orgacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getActacodigos($actacodigos) {
		$sql = 'SELECT "actacodigos" FROM "acta" WHERE "actacodigos"=\''.$actacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getOrdenumeros($actacodigos) {
		$sql = 'SELECT "ordenumeros" FROM "acta" WHERE "actacodigos"=\''.$actacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getTarecodigos($actacodigos) {
		$sql = 'SELECT "tarecodigos" FROM "acta" WHERE "actacodigos"=\''.$actacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getActaestacts($actacodigos) {
		$sql = 'SELECT "actaestacts" FROM "acta" WHERE "actacodigos"=\''.$actacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getActaestants($actacodigos) {
		$sql = 'SELECT "actaestants" FROM "acta" WHERE "actacodigos"=\''.$actacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getActafechingn($actacodigos) {
		$sql = 'SELECT "actafechingn" FROM "acta" WHERE "actacodigos"=\''.$actacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getUsuacodigos($actacodigos) {
		$sql = 'SELECT "usuacodigos" FROM "acta" WHERE "actacodigos"=\''.$actacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getOrgacodigos($actacodigos) {
		$sql = 'SELECT "orgacodigos" FROM "acta" WHERE "actacodigos"=\''.$actacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getActaactivas($actacodigos) {
		$sql = 'SELECT "actaactivas" FROM "acta" WHERE "actacodigos"=\''.$actacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Acta
?>