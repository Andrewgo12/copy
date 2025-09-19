<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeGePgsqlConfigarchiv {
	var $consult;
	var $objdb;
	function FeGePgsqlConfigarchiv() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
        $this->objdb->fncadoconn($config['database']);
	}
	function existConfigarchiv($cogacodigos) {
		$sql = 'SELECT * FROM "configarchiv" WHERE "cogacodigos"=\''.$cogacodigos.'\'';
	$this->objdb->fncadoexecute($sql);
    return $this->objdb->fncadorowcont();
	}
	function addConfigarchiv($cogacodigos, $coganombres, $cogaobservas, $tiarcodigos, $cogamarmaess, $cogamardetas, $cogaposmaess, $cogaposdetas, $cogasepainis, $cogasepafins, $coarencabezs, $coarextencis) {
		$sql = 'INSERT INTO "configarchiv" ("cogacodigos","coganombres","cogaobservas","tiarcodigos","cogamarmaess","cogamardetas","cogaposmaess","cogaposdetas","cogasepainis","cogasepafins","coarencabezs","coarextencis")'
		.' VALUES(\''.$cogacodigos.'\',\''.$coganombres.'\',\''.$cogaobservas.'\',\''.$tiarcodigos.'\',\''.$cogamarmaess.'\',\''.$cogamardetas.'\','.$cogaposmaess.' ,'.$cogaposdetas.' ,\''.$cogasepainis.'\',\''.$cogasepafins.'\',\''.$coarencabezs.'\',\''.$coarextencis.'\')';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function updateConfigarchiv($cogacodigos, $coganombres, $cogaobservas, $tiarcodigos, $cogamarmaess, $cogamardetas, $cogaposmaess, $cogaposdetas, $cogasepainis, $cogasepafins, $coarencabezs, $coarextencis) {
		$sql = 'UPDATE "configarchiv" SET "coganombres"=\''.$coganombres.'\',"cogaobservas"=\''.$cogaobservas.'\',"tiarcodigos"=\''.$tiarcodigos.'\',"cogamarmaess"=\''.$cogamarmaess.'\',"cogamardetas"=\''.$cogamardetas.'\',"cogaposmaess"='.$cogaposmaess.' ,"cogaposdetas"='.$cogaposdetas.' ,"cogasepainis"=\''.$cogasepainis.'\',"cogasepafins"=\''.$cogasepafins.'\',"coarencabezs"=\''.$coarencabezs.'\',"coarextencis"=\''.$coarextencis.'\' WHERE "cogacodigos"=\''.$cogacodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function deleteConfigarchiv($cogacodigos) {
		$sql = 'DELETE FROM "configarchiv" WHERE "cogacodigos"=\''.$cogacodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function getByIdConfigarchiv($cogacodigos) {
		$sql = 'SELECT * FROM "configarchiv" WHERE "cogacodigos"=\''.$cogacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getAllConfigarchiv() {
		$sql = 'SELECT * FROM "configarchiv"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getByConfigarchiv_fkey($tiarcodigos) {
		$sql = 'SELECT * FROM "configarchiv" WHERE "tiarcodigos"=\''.$tiarcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getCogacodigos($cogacodigos) {
		$sql = 'SELECT "cogacodigos" FROM "configarchiv" WHERE "cogacodigos"=\''.$cogacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getCoganombres($cogacodigos) {
		$sql = 'SELECT "coganombres" FROM "configarchiv" WHERE "cogacodigos"=\''.$cogacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getCogaobservas($cogacodigos) {
		$sql = 'SELECT "cogaobservas" FROM "configarchiv" WHERE "cogacodigos"=\''.$cogacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getTiarcodigos($cogacodigos) {
		$sql = 'SELECT "tiarcodigos" FROM "configarchiv" WHERE "cogacodigos"=\''.$cogacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getCogamarmaess($cogacodigos) {
		$sql = 'SELECT "cogamarmaess" FROM "configarchiv" WHERE "cogacodigos"=\''.$cogacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getCogamardetas($cogacodigos) {
		$sql = 'SELECT "cogamardetas" FROM "configarchiv" WHERE "cogacodigos"=\''.$cogacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getCogaposmaess($cogacodigos) {
		$sql = 'SELECT "cogaposmaess" FROM "configarchiv" WHERE "cogacodigos"=\''.$cogacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getCogaposdetas($cogacodigos) {
		$sql = 'SELECT "cogaposdetas" FROM "configarchiv" WHERE "cogacodigos"=\''.$cogacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getCogasepainis($cogacodigos) {
		$sql = 'SELECT "cogasepainis" FROM "configarchiv" WHERE "cogacodigos"=\''.$cogacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getCogasepafins($cogacodigos) {
		$sql = 'SELECT "cogasepafins" FROM "configarchiv" WHERE "cogacodigos"=\''.$cogacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getCoarencabezs($cogacodigos) {
		$sql = 'SELECT "coarencabezs" FROM "configarchiv" WHERE "cogacodigos"=\''.$cogacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getCoarextencis($cogacodigos) {
		$sql = 'SELECT "coarextencis" FROM "configarchiv" WHERE "cogacodigos"=\''.$cogacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Configarchiv
?>