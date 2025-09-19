<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeCuPgsqlContrato {
	var $consult;
	var $objdb;
	function FeCuPgsqlContrato() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	function existContrato($contnics) {
		$sql = 'SELECT * FROM "contrato" WHERE "contnics"=\''.$contnics.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}
	function addContrato($contnics, $clieidentifs, $ticocodigos, $contobjetos, $timocodigos, $contmonton, $fopacodigos, $contfchainin, $contfchafinn, $contfchfirmn, $contestados, $contdescrips) {
		$sql = 'INSERT INTO "contrato" ("contnics","clieidentifs","ticocodigos","contobjetos","timocodigos","contmonton","fopacodigos","contfchainin","contfchafinn","contfchfirmn","contestados","contdescrips")'
		.' VALUES(\''.$contnics.'\',\''.$clieidentifs.'\',\''.$ticocodigos.'\',\''.$contobjetos.'\',\''.$timocodigos.'\','.$contmonton.' ,\''.$fopacodigos.'\','.$contfchainin.' ,'.$contfchafinn.' ,'.$contfchfirmn.' , \''.$contestados.'\',\''.$contdescrips.'\')';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function updateContrato($contnics, $clieidentifs, $ticocodigos, $contobjetos, $timocodigos, $contmonton, $fopacodigos, $contfchainin, $contfchafinn, $contfchfirmn, $contestados, $contdescrips) {
		$sql = 'UPDATE "contrato" SET "clieidentifs"=\''.$clieidentifs.'\',"ticocodigos"=\''.$ticocodigos.'\',"contobjetos"=\''.$contobjetos.'\',"timocodigos"=\''.$timocodigos.'\',"contmonton"='.$contmonton.' ,"fopacodigos"=\''.$fopacodigos.'\',"contfchainin"='.$contfchainin.' ,"contfchafinn"='.$contfchafinn.' ,"contfchfirmn"='.$contfchfirmn.' ,"contestados"=\''.$contestados.'\',"contdescrips"=\''.$contdescrips.'\' WHERE "contnics"=\''.$contnics.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function deleteContrato($contnics) {
		$sql = 'DELETE FROM "contrato" WHERE "contnics"=\''.$contnics.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function getByIdContrato($contnics) {
		$sql = 'SELECT * FROM "contrato" WHERE "contnics"=\''.$contnics.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getAllContrato() {
		$sql = 'SELECT * FROM "contrato"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getByContrato_fkey($contclieids) {
		$sql = 'SELECT * FROM "contrato" WHERE contclieids=\''.$contclieids.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getByContrato_fkey1($ticocodigos) {
		$sql = 'SELECT * FROM "contrato" WHERE "ticocodigos"=\''.$ticocodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getByContrato_fkey2($timocodigos) {
		$sql = 'SELECT * FROM "contrato" WHERE "timocodigos"=\''.$timocodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getByContrato_fkey3($fopacodigos) {
		$sql = 'SELECT * FROM "contrato" WHERE "fopacodigos"=\''.$fopacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getContnics($contnics) {
		$sql = 'SELECT "contnics" FROM "contrato" WHERE "contnics"=\''.$contnics.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getCliecodigos($contnics) {
		$sql = 'SELECT "cliecodigos" FROM "contrato" WHERE "contnics"=\''.$contnics.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getTicocodigos($contnics) {
		$sql = 'SELECT "ticocodigos" FROM "contrato" WHERE "contnics"=\''.$contnics.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getContobjetos($contnics) {
		$sql = 'SELECT "contobjetos" FROM "contrato" WHERE "contnics"=\''.$contnics.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getTimocodigos($contnics) {
		$sql = 'SELECT "timocodigos" FROM "contrato" WHERE "contnics"=\''.$contnics.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getContmonton($contnics) {
		$sql = 'SELECT "contmonton" FROM "contrato" WHERE "contnics"=\''.$contnics.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getFopacodigos($contnics) {
		$sql = 'SELECT "fopacodigos" FROM "contrato" WHERE "contnics"=\''.$contnics.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getContfchainin($contnics) {
		$sql = 'SELECT "contfchainin" FROM "contrato" WHERE "contnics"=\''.$contnics.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getContfchafinn($contnics) {
		$sql = 'SELECT "contfchafinn" FROM "contrato" WHERE "contnics"=\''.$contnics.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getContfchfirmn($contnics) {
		$sql = 'SELECT "contfchfirmn" FROM "contrato" WHERE "contnics"=\''.$contnics.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getContestados($contnics) {
		$sql = 'SELECT "contestados" FROM "contrato" WHERE "contnics"=\''.$contnics.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getContdescrips($contnics) {
		$sql = 'SELECT "contdescrips" FROM "contrato" WHERE "contnics"=\''.$contnics.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Contrato
?>