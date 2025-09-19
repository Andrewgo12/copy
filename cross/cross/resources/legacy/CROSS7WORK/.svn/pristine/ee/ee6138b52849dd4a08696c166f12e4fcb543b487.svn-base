<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeGePgsqlConfigarchivExtended {
	var $consult;
	var $objdb;
	function FeGePgsqlConfigarchivExtended() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	function addConfigarchivSql($cogacodigos, $coganombres, $cogaobservas, $tiarcodigos, $cogamarmaess, $cogamardetas, $cogaposmaess, $cogaposdetas, $cogasepainis, $cogasepafins, $coarencabezs, $coarextencis) {
		$sbsql = 'INSERT INTO "configarchiv" ("cogacodigos","coganombres","cogaobservas","tiarcodigos","cogamarmaess","cogamardetas","cogaposmaess","cogaposdetas","cogasepainis","cogasepafins","coarencabezs","coarextencis")'
		.' VALUES(\''.$cogacodigos.'\',\''.$coganombres.'\',\''.$cogaobservas.'\',\''.$tiarcodigos.'\',\''.$cogamarmaess.'\',\''.$cogamardetas.'\','.$cogaposmaess.' ,'.$cogaposdetas.' ,\''.$cogasepainis.'\',\''.$cogasepafins.'\',\''.$coarencabezs.'\',\''.$coarextencis.'\')';
		return $sbsql; 
	}
	function updateConfigarchivSql($cogacodigos, $coganombres, $cogaobservas, $tiarcodigos, $cogamarmaess, $cogamardetas, $cogaposmaess, $cogaposdetas, $cogasepainis, $cogasepafins, $coarencabezs, $coarextencis) {
		$sbsql = 'UPDATE "configarchiv" SET "coganombres"=\''.$coganombres.'\',"cogaobservas"=\''.$cogaobservas.'\',"tiarcodigos"=\''.$tiarcodigos.'\',"cogamarmaess"=\''.$cogamarmaess.'\',"cogamardetas"=\''.$cogamardetas.'\',"cogaposmaess"='.$cogaposmaess.' ,"cogaposdetas"='.$cogaposdetas.' ,"cogasepainis"=\''.$cogasepainis.'\',"cogasepafins"=\''.$cogasepafins.'\',"coarencabezs"=\''.$coarencabezs.'\',"coarextencis"=\''.$coarextencis.'\' WHERE "cogacodigos"=\''.$cogacodigos.'\'';
		return $sbsql;
	}
	function deleteConfigarchivSql($cogacodigos) {
		$sbsql = 'DELETE FROM "configarchiv" WHERE "cogacodigos"=\''.$cogacodigos.'\'';
		return $sbsql;
	}
	function ConfigarchivTrans($ircdata) {
		if (!$ircdata) {
			$this->consult = false;
		}
		$this->objdb->fncadoexecutetrans($ircdata);
		if (!$this->objdb->objresult) {
			$this->consult = false;
		} else {
			$this->consult = true;
		}
	}
	function getByConfigarchiv_fkeySql($tiarcodigos) {
		$sbsql = 'SELECT "cogacodigos","coganombres","cogaobservas" FROM "configarchiv" WHERE "tiarcodigos"=\''.$tiarcodigos.'\'';
		return $sbsql;
	}
} //End of Class ConfigarchivExtended
?>