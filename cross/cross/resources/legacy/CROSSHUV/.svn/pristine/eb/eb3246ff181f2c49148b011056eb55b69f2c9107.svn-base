<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeGePgsqlComunicacion {
	var $consult;
	var $objdb;

	function FeGePgsqlComunicacion() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}

	function existComunicacion($comucodigos) {
		$sql = 'SELECT * FROM "comunicacion" WHERE "comucodigos"=\''.$comucodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}

	function addComunicacion($comucodigos, $ordenumeros, $focacodigos, $comuasuntos, $comutextos, $comuestados, $comuusuagen, $usuacodigos, $comufecregn, $comufecenvn) {
		$sql = 'INSERT INTO "comunicacion" ("comucodigos","ordenumeros","focacodigos","comuasuntos","comutextos","comuestados","comuusuagen","usuacodigos","comufecregn","comufecenvn")'
		.' VALUES(\''.$comucodigos.'\',\''.$ordenumeros.'\',\''.$focacodigos.'\',\''.$comuasuntos.'\',\''.$comutextos.'\',\''.$comuestados.'\',\''.$comuusuagen.'\',\''.$usuacodigos.'\','.$comufecregn.' ,'.$comufecenvn.' )';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function updateComunicacion($comucodigos, $ordenumeros, $focacodigos, $comuasuntos, $comutextos, $comuestados, $comuusuagen, $usuacodigos, $comufecregn, $comufecenvn) {
		$sql = 'UPDATE "comunicacion" SET "ordenumeros"=\''.$ordenumeros.'\',"focacodigos"=\''.$focacodigos.'\',"comuasuntos"=\''.$comuasuntos.'\',comutextos=\''.$comutextos.'\',"comuestados"=\''.$comuestados.'\',"comuusuagen"=\''.$comuusuagen.'\',usuacodigon=\''.$usuacodigos.'\',"comufecregn"='.$comufecregn.' ,"comufecenvn"='.$comufecenvn.' WHERE "comucodigos"=\''.$comucodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function deleteComunicacion($comucodigos) {
		$sql = 'DELETE FROM "comunicacion" WHERE "comucodigos"=\''.$comucodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function getByIdComunicacion($comucodigos) {
		$sql = 'SELECT * FROM "comunicacion" WHERE "comucodigos"=\''.$comucodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getAllComunicacion() {
		$sql = 'SELECT * FROM "comunicacion"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getByComunicacion_fkey($focacodigos) {
		$sql = 'SELECT * FROM "comunicacion" WHERE "focacodigos"=\''.$focacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getComucodigos($comucodigos) {
		$sql = 'SELECT "comucodigos" FROM "comunicacion" WHERE "comucodigos"=\''.$comucodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getOrdenumeros($comucodigos) {
		$sql = 'SELECT "ordenumeros" FROM "comunicacion" WHERE "comucodigos"=\''.$comucodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getFocacodigos($comucodigos) {
		$sql = 'SELECT "focacodigos" FROM "comunicacion" WHERE "comucodigos"=\''.$comucodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getComuasuntos($comucodigos) {
		$sql = 'SELECT "comuasuntos" FROM "comunicacion" WHERE "comucodigos"=\''.$comucodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getComutextos($comucodigos) {
		$sql = 'SELECT "comutextos" FROM "comunicacion" WHERE "comucodigos"=\''.$comucodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getComuestados($comucodigos) {
		$sql = 'SELECT "comuestados" FROM "comunicacion" WHERE "comucodigos"=\''.$comucodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getComuusuagen($comucodigos) {
		$sql = 'SELECT "comuusuagen" FROM "comunicacion" WHERE "comucodigos"=\''.$comucodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getUsuacodigon($comucodigos) {
		$sql = 'SELECT "usuacodigos" FROM "comunicacion" WHERE "comucodigos"=\''.$comucodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getComufecregn($comucodigos) {
		$sql = 'SELECT "comufecregn" FROM "comunicacion" WHERE "comucodigos"=\''.$comucodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getComufecenvn($comucodigos) {
		$sql = 'SELECT "comufecenvn" FROM "comunicacion" WHERE "comucodigos"=\''.$comucodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

} //End of Class Comunicacion
?>