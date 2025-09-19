<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeCrPgsqlOrdenExtended {
	var $consult;
	var $objdb;
	function FeCrPgsqlOrdenExtended() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	function addOrdenSql($ordenumeros, $proccodigos, $ordesitiejes, $usuacodigos, $ordeestaacs, $ordeobservs, $ordefecingd, $ordefecregd, $ordefecvend, $ordefecfinad, $ordefecentn) {
		
		settype($sbdbnull, "string");
		settype($sbsql, "string");
		$sbdbnull = Application :: getConstant("DB_NULL");
		if($ordesitiejes && $ordesitiejes != $sbdbnull){
			$ordesitiejes = "'".$ordesitiejes."'";
		}
		$sbsql = 'INSERT INTO "orden" ("ordenumeros","proccodigos","ordesitiejes","usuacodigos","ordeestaacs","ordeobservs","ordefecingd","ordefecregd","ordefecvend","ordefecfinad","ordefecentn")'
		.' VALUES(\''.$ordenumeros.'\',\''.$proccodigos.'\','.$ordesitiejes.',\''.$usuacodigos.'\',\''.$ordeestaacs.'\',\''.$ordeobservs.'\','.$ordefecingd.','.$ordefecregd.','.$ordefecvend.','.$ordefecfinad.','.$ordefecentn.')';
		return $sbsql;
	}
	function updateOrdenSql($ordenumeros, $proccodigos, $ordesitiejes, $usuacodigos, $ordeestaacs, $ordeobservs, $ordefecingd, $ordefecregd, $ordefecvend, $ordefecfinad, $ordefecentn) {
		settype($sbdbnull, "string");
		settype($sbsql, "string");
		$sbdbnull = Application :: getConstant("DB_NULL");
		if($ordesitiejes && $ordesitiejes != $sbdbnull){
			$ordesitiejes = "'".$ordesitiejes."'";
		}
		$sbsql = 'UPDATE "orden" SET "proccodigos"=\''.$proccodigos.'\',"ordesitiejes"='.$ordesitiejes.' ,"usuacodigos"=\''.$usuacodigos.'\',"ordeestaacs"=\''.$ordeestaacs.'\',"ordeobservs"=\''.$ordeobservs.'\',"ordefecingd"='.$ordefecingd.' ,"ordefecregd"='.$ordefecregd.' ,"ordefecvend"='.$ordefecvend.' ,"ordefecfinad"='.$ordefecfinad.' ,"ordefecentn"='.$ordefecentn.' WHERE "ordenumeros"=\''.$ordenumeros.'\'';
		return $sbsql;
	}
	function OrdenTrans($ircdata) {
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
	function DetermineFinalizedOrden($isbOrdenumeros){
		settype($sbDbNull, "string");
		settype($sbSql, "string");
		$sbSql = 'SELECT * FROM "orden" WHERE "ordenumeros"=\''.$isbOrdenumeros.'\' AND "ordefecfinad" IS NOT NULL';
		$this->objdb->fncadoexecute($sbSql);
		return $this->objdb->fncadorowcont();
	}
	function getSqlActivateOrden($isbOrdenumeros){
		settype($sbDbNull, "string");
		settype($sbSql, "string");
		$sbDbNull = Application :: getConstant("DB_NULL");
		$sbSql = 'UPDATE "orden" SET "ordefecfinad"='.$sbDbNull.' WHERE "ordenumeros"=\''.$isbOrdenumeros.'\'';
		return $sbSql;
	}
	/**
	* @copyright Copyright 2006 &copy; FullEngine
	*
	* Modifica la fecha de finalizacion del caso
	* @param string $sbOrdenumeros Codigo del caso
	* @param integer $nuOrdefecfinad Entero con la fecha timestamp
	* @author freina <freina@parquesoft.com>
	* @date 15-Dec-2006 14:50
	* @location Cali-Colombia
	*/
	function setOrdefecfinad($sbOrdenumeros, $nuOrdefecfinad) {
		settype($sbSql, "string");
		
		$sbSql = 'UPDATE "orden" SET "ordefecfinad"='.$nuOrdefecfinad.' WHERE "ordenumeros"=\''.$sbOrdenumeros.'\'';
		$this->objdb->fncadoexecute($sbSql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	
	/**
	* @copyright Copyright 2007 &copy; FullEngine
	*
	* Determina si el numero de caso al cual se le 
	* hace seguimiento es un seguimiento
	* @param string $sbOrdenumeros Codigo del caso
	* @author freina <freina@parquesoft.com>
	* @date 29-May-2007 16:59
	* @location Cali-Colombia
	*/
	function DeterminePursuitOrden($sbOrdenumeros){
		
		settype($objService,"object");
		settype($rcTypes,"array");
		settype($sbTmp,"string");
		settype($sbSql,"string");
		
		if($sbOrdenumeros){
			//Se obtiene los tipos de caso a los que no debe hacerse seguimiento
			$objService = Application :: loadServices("General");
			$rcTypes = $objService->getParam("cross300","TYPES_CASE_PURSUIT");
			
			if(is_array($rcTypes) && $rcTypes){
				$sbTmp = " AND \"ordenempresa\".\"tiorcodigos\" IN ('".implode("','",$rcTypes)."')";
				$sbSql = "SELECT \"orden\".\"ordenumeros\" FROM \"orden\",\"ordenempresa\" " .
					" WHERE \"orden\".\"ordenumeros\"='".$sbOrdenumeros."' " .
					" AND \"orden\".\"ordenumeros\"=\"ordenempresa\".\"ordenumeros\" ".$sbTmp;
				$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
				if($this->objdb->rcresult){
					return true;
				}
			}
		}
		return false;
	}
} //End of Class OrdenExtended
?>