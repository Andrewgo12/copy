<?php 	
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeGePgsqlEmail {
	var $consult;
	var $objdb;

	function FeGePgsqlEmail() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}

	function existEmail() {
		$sql = 'SELECT * FROM "email" WHERE "emaicodigos"=\''.$emaicodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}

	function addEmail($emaicodigos, $ordenumeros, $foemcodigos, $orgacodigos, $emaiparas, $emaidesdes, $emaiasuntos, $emaitextos, $emaiestados, $usuacodigos, $emaifecregn, $emaifecenvn, $emaiadjuntos) {
		$sql = 'INSERT INTO "email" ("emaicodigos","ordenumeros","foemcodigos","orgacodigos","emaiparas","emaidesdes","emaiasuntos","emaitextos","emaiestados","usuacodigos","emaifecregn","emaifecenvn","emaiadjuntos")'
		.' VALUES(\''.$emaicodigos.'\',\''.$ordenumeros.'\',\''.$foemcodigos.'\',\''.$orgacodigos.'\',\''.$emaiparas.'\',\''.$emaidesdes.'\',\''.$emaiasuntos.'\',\''.$emaitextos.'\',\''.$emaiestados.'\',\''.$usuacodigos.'\','.$emaifecregn.' ,\''.$emaifecenvn.'\',\''.$emaiadjuntos.'\')';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function updateEmail($emaicodigos, $ordenumeros, $foemcodigos, $orgacodigos, $emaiparas, $emaidesdes, $emaiasuntos, $emaitextos, $emaiestados, $usuacodigos, $emaifecregn, $emaifecenvn, $emaiadjuntos) {
		$sql = 'UPDATE "email" SET "emaicodigos"=\''.$emaicodigos.'\',"ordenumeros"=\''.$ordenumeros.'\',"foemcodigos"=\''.$foemcodigos.'\',"orgacodigos"=\''.$orgacodigos.'\',"emaiparas"=\''.$emaiparas.'\',"emaidesdes"=\''.$emaidesdes.'\',"emaiasuntos"=\''.$emaiasuntos.'\',emaitextos=\''.$emaitextos.'\',"emaiestados"=\''.$emaiestados.'\',"usuacodigos"=\''.$usuacodigos.'\',"emaifecregn"='.$emaifecregn.' ,"emaifecenvn"='.$emaifecenvn.' ,"emaiadjuntos"=\''.$emaiadjuntos.'\' WHERE "emaicodigos"=\''.$emaicodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function deleteEmail($emaicodigos) {
		$sql = 'DELETE FROM "email" WHERE "emaicodigos"=\''.$emaicodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function getByIdEmail($emaicodigos) {
		$sql = 'SELECT * FROM "email" WHERE "emaicodigos"=\''.$emaicodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getAllEmail() {
		$sql = 'SELECT * FROM "email"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getEmaicodigos($emaicodigos) {
		$sql = 'SELECT "emaicodigos" FROM "email" WHERE "emaicodigos"=\''.$emaicodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getOrdenumeros($emaicodigos) {
		$sql = 'SELECT "ordenumeros" FROM "email" WHERE "emaicodigos"=\''.$emaicodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	
	function getFoemcodigos($emaicodigos) {
		$sql = 'SELECT "foemcodigos" FROM "email" WHERE "emaicodigos"=\''.$emaicodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getOrgacodigos($emaicodigos) {
		$sql = 'SELECT "orgacodigos" FROM "email" WHERE "emaicodigos"=\''.$emaicodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getEmaiparas($emaicodigos) {
		$sql = 'SELECT "emaiparas" FROM "email" WHERE "emaicodigos"=\''.$emaicodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getEmaidesdes($emaicodigos) {
		$sql = 'SELECT "emaidesdes" FROM "email" WHERE "emaicodigos"=\''.$emaicodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getEmaiasuntos($emaicodigos) {
		$sql = 'SELECT "emaiasuntos" FROM "email" WHERE "emaicodigos"=\''.$emaicodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getEmaitextos($emaicodigos) {
		$sql = 'SELECT "emaitextos" FROM "email" WHERE "emaicodigos"=\''.$emaicodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getEmaiestados($emaicodigos) {
		$sql = 'SELECT "emaiestados" FROM "email" WHERE "emaicodigos"=\''.$emaicodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getUsuacodigos() {
		$sql = 'SELECT "usuacodigos" FROM "email" WHERE "emaicodigos"=\''.$emaicodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getEmaifecregn($emaicodigos) {
		$sql = 'SELECT "emaifecregn" FROM "email" WHERE "emaicodigos"=\''.$emaicodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getEmaifecenvn($emaicodigos) {
		$sql = 'SELECT "emaifecenvn" FROM "email" WHERE "emaicodigos"=\''.$emaicodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getEmaiadjuntos($emaicodigos) {
		$sql = 'SELECT "emaiadjuntos" FROM "email" WHERE "emaicodigos"=\''.$emaicodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

} //End of Class Email
?>