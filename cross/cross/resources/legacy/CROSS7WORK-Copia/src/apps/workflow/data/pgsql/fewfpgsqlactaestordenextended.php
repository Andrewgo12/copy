<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeWFPgsqlActaestordenExtended {
	var $objdb;
	function FeWFPgsqlActaestordenExtended() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	function addActaestordenSql($acescodigos, $actacodigos, $acesestrecis, $acesestentrs, $acesfechmovs) {
		$sql = 'INSERT INTO "actaestorden" ("acescodigos","actacodigos","acesestrecis","acesestentrs","acesfechmovs")'
		.' VALUES(\''.$acescodigos.'\',\''.$actacodigos.'\','.$acesestrecis.' ,\''.$acesestentrs.'\',\''.$acesfechmovs.'\')';
		return $sql;
	}
	function getLastRecord() {
		$sql = 'SELECT * FROM "actaestorden" WHERE "actacodigos"=\'|\' ORDER BY "acesfechmovs"';
		return $sql;
	}
	function getActaestordenByActacodigos($isbActacodigos){
		settype($sbSql,"string");
   		$sbSql='SELECT * FROM "actaestorden" WHERE "actacodigos"=\''.$isbActacodigos.'\' ORDER BY "acesfechmovs"';
   		$this->objdb->fncadoselect($sbSql,FETCH_ASSOC);
   		return $this->objdb->rcresult;
  }
} //End of Class Actaestorden
?>