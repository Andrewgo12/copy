<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeCrPgsqlOrganizacion {
	var $consult;
	var $objdb;
	function FeCrPgsqlOrganizacion() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	function existOrganizacion($orgacodigos) {
		$sql = 'SELECT * FROM "organizacion" WHERE "orgacodigos"=\''.$orgacodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}
	function addOrganizacion($orgacodigos, $organombres, $tiorcodigos, $orgacgpads, $orgaordenn, $orgafechcred, $esorcodigos, $grupcodigos, $orgatelefo1s, $orgatelefo2s, $locacodigos) {
		$sql = 'INSERT INTO "organizacion" ("orgacodigos","organombres","tiorcodigos","orgacgpads","orgaordenn","orgafechcred","esorcodigos","grupcodigos","orgatelefo1s","orgatelefo2s","locacodigos")'
		.' VALUES(\''.$orgacodigos.'\',\''.$organombres.'\',\''.$tiorcodigos.'\',\''.$orgacgpads.'\','.$orgaordenn.' ,'.$orgafechcred.' ,\''.$esorcodigos.'\',\''.$grupcodigos.'\',\''.$orgatelefo1s.'\',\''.$orgatelefo2s.'\',\''.$locacodigos.'\')';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function updateOrganizacion($orgacodigos, $organombres, $tiorcodigos, $orgacgpads, $orgaordenn, $orgafechcred, $esorcodigos, $grupcodigos, $orgatelefo1s, $orgatelefo2s, $locacodigos) {
		$sql = 'UPDATE "organizacion" SET "organombres"=\''.$organombres.'\',"tiorcodigos"=\''.$tiorcodigos.'\',"orgacgpads"=\''.$orgacgpads.'\',"orgaordenn"='.$orgaordenn.' ,"orgafechcred"='.$orgafechcred.' ,"esorcodigos"=\''.$esorcodigos.'\',"grupcodigos"=\''.$grupcodigos.'\',"orgatelefo1s"=\''.$orgatelefo1s.'\',"orgatelefo2s"=\''.$orgatelefo2s.'\',"locacodigos"=\''.$locacodigos.'\' WHERE "orgacodigos"=\''.$orgacodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function deleteOrganizacion($orgacodigos) {
		$sql = 'DELETE FROM "organizacion" WHERE "orgacodigos"=\''.$orgacodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function getByIdOrganizacion($orgacodigos) {
		$sql = 'SELECT * FROM "organizacion" WHERE "orgacodigos"=\''.$orgacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getAllOrganizacion() {
		$sql = 'SELECT * FROM "organizacion"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getByOrganizacion_fkey($tiorcodigos) {
		$sql = 'SELECT * FROM "organizacion" WHERE "tiorcodigos"=\''.$tiorcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getByOrganizacion_fkey1($esorcodigos) {
		$sql = 'SELECT * FROM "organizacion" WHERE "esorcodigos"=\''.$esorcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getByOrganizacion_fkey2($grupcodigos) {
		$sql = 'SELECT * FROM "organizacion" WHERE "grupcodigos"=\''.$grupcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getOrgacodigos($orgacodigos) {
		$sql = 'SELECT "orgacodigos" FROM "organizacion" WHERE "orgacodigos"=\''.$orgacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getOrganombres($orgacodigos) {
		$sql = 'SELECT "organombres" FROM "organizacion" WHERE "orgacodigos"=\''.$orgacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getTiorcodigos($orgacodigos) {
		$sql = 'SELECT "tiorcodigos" FROM "organizacion" WHERE "orgacodigos"=\''.$orgacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getOrgacgpads($orgacodigos) {
		$sql = 'SELECT "orgacgpads" FROM "organizacion" WHERE "orgacodigos"=\''.$orgacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getOrgaordenn($orgacodigos) {
		$sql = 'SELECT "orgaordenn" FROM "organizacion" WHERE "orgacodigos"=\''.$orgacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getOrgafechcred($orgacodigos) {
		$sql = 'SELECT "orgafechcred" FROM "organizacion" WHERE "orgacodigos"=\''.$orgacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getEsorcodigos($orgacodigos) {
		$sql = 'SELECT "esorcodigos" FROM "organizacion" WHERE "orgacodigos"=\''.$orgacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getGrupcodigos($orgacodigos) {
		$sql = 'SELECT "grupcodigos" FROM "organizacion" WHERE "orgacodigos"=\''.$orgacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getOrgatelefo1s($orgacodigos) {
		$sql = 'SELECT "orgatelefo1s" FROM "organizacion" WHERE "orgacodigos"=\''.$orgacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getOrgatelefo2s($orgacodigos) {
		$sql = 'SELECT "orgatelefo2s" FROM "organizacion" WHERE "orgacodigos"=\''.$orgacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getLocacodigos($orgacodigos) {
		$sql = 'SELECT "locacodigos" FROM "organizacion" WHERE "orgacodigos"=\''.$orgacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getOrgaemails($orgacodigos) {
		$sql = 'SELECT "orgaemails" FROM "organizacion" WHERE "orgacodigos"=\''.$orgacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Organizacion
?>