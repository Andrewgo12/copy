<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeWFPgsqlRecorridoExtended {
	var $connection;
	var $consult;
	var $objdb;
	function FeWFPgsqlRecorridoExtended() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	function addRecorridoSql($isbRecocodigos, $isbOrdenumeros, $isbActacodigos, $isbRecoactpads, $isbRecoobligats, $isbRecoinstancs, $inuRecofecingn) {
		settype($osbSql,"string");
		settype($sbDbNull, "string");
		$sbDbNull = Application :: getConstant("DB_NULL");
		if($isbRecoactpads && $isbRecoactpads != $sbDbNull){
			$isbRecoactpads = "'".$isbRecoactpads."'";
		}
		if($isbRecoinstancs && $isbRecoinstancs != $sbDbNull){
			$isbRecoinstancs = "'".$isbRecoinstancs."'";
		}
		$osbSql = 'INSERT INTO "recorrido" ("recocodigos","ordenumeros","actacodigos","recoactpads","recoobligats","recoinstancs","recofecingn")'
		.' VALUES(\''.$isbRecocodigos.'\', \''.$isbOrdenumeros.'\', \''.$isbActacodigos.'\','.$isbRecoactpads.',\''.$isbRecoobligats.'\','.$isbRecoinstancs.', '.$inuRecofecingn.')';
		return $osbSql;
	}
	function GetRecorridoByOrdenumeros($isbOrdenumeros){
		settype($sbSql,"string");
		settype($sbState,"string");
		$sbState = Application :: getConstant("REG_ACT");
		$sbSql = 'SELECT * FROM "recorrido" WHERE "ordenumeros"=\''.$isbOrdenumeros.'\' AND "recoactivos"=\''.$sbState.'\' ORDER BY "recofecingn"';
		$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function GetSqlDeactivateRegistryRecorrido($isbActacodigos){
		settype($osbSql,"string");
		settype($sbState,"string");
		$sbState = Application :: getConstant("REG_INACT");
		$osbSql = 'UPDATE "recorrido" SET "recoactivos"=\''.$sbState.'\' WHERE "actacodigos" =\''.$isbActacodigos.'\'';
		return $osbSql;
	}
	function GetAllRecorridoByOrdenumeros($isbOrdenumeros){
		settype($sbSql,"string");
		$sbSql = 'SELECT "recorrido"."actacodigos","recorrido"."recoactpads","recorrido"."recofecingn","acta"."tarecodigos" 
		FROM "recorrido","acta"
		WHERE "recorrido"."ordenumeros"=\''.$isbOrdenumeros.'\' 
		AND "recorrido"."actacodigos"="acta"."actacodigos" ORDER BY "recofecingn"';
		$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getRecorridoByActacodigos($sbActacodigos){
		settype($sbSql,"string");
		settype($sbStatus,"string");
		$sbStatus = Application :: getConstant("REG_ACT");
		$sbSql = 'SELECT * FROM "recorrido" WHERE "actacodigos"=\''.$sbActacodigos.'\' AND "recoactivos"=\''.$sbStatus.'\' ORDER BY "recofecingn"';
		$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Recorrido
?>