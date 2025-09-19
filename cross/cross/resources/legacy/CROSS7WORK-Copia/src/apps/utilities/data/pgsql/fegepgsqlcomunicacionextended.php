<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeGePgsqlComunicacionExtended {
	var $consult;
	var $objdb;

	function FeGePgsqlComunicacionExtended() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}

	function deleteComunicacionSql($comucodigos) {
		$sbsql = 'DELETE FROM "comunicacion" WHERE "comucodigos"=\''.$comucodigos.'\'';
		return $sbsql;
	}
	
	function ComunicacionTrans($ircdata) {
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
	
	function getByIdComunicacionIn($irccomucodigos) {
		
		settype($sbtmp,"string");
		settype($sbsql,"string");
		
		$sbtmp = implode("','",$irccomucodigos);
		$sbsql = 'SELECT * FROM "comunicacion" WHERE "comucodigos" IN (\''.$sbtmp.'\')';
		$this->objdb->fncadoselect($sbsql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	
	function updateComunicacionComuestadosById($comucodigos, $comuestados,$comufecenvn=0) {
		if($comufecenvn){
			$sbtmp = " ,\"comufecenvn\"=$comufecenvn";
		}
		$sbsql = 'UPDATE "comunicacion" SET "comuestados"=\''.$comuestados.'\' '.$sbtmp.' WHERE "comucodigos"=\''.$comucodigos.'\'';
		$this->objdb->fncadoexecute($sbsql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	
	function addComunicacionSql($comucodigos, $ordenumeros, $focacodigos, $comuasuntos, $comutextos, $comuestados, $comuusuagen, $usuacodigos, $comufecregn, $comufecenvn) {
		$sbsql = 'INSERT INTO "comunicacion" ("comucodigos","ordenumeros","focacodigos","comuasuntos","comutextos","comuestados","comuusuagen","usuacodigos","comufecregn","comufecenvn")'
		.' VALUES(\''.$comucodigos.'\',\''.$ordenumeros.'\',\''.$focacodigos.'\',\''.$comuasuntos.'\',\''.$comutextos.'\',\''.$comuestados.'\',\''.$comuusuagen.'\',\''.$usuacodigos.'\','.$comufecregn.' ,'.$comufecenvn.' )';
		return $sbsql;
	}
} //End of Class Comunicacion
?>