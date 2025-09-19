<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeWFPgsqlEstadoactaExtended {
	var $consult;
	var $objdb;
	function FeWFPgsqlEstadoactaExtended() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	
	function getAllActiveEstadoacta() {
		
		settype($sbstate,"string");
		settype($osbsql,"string");
		
		$sbstate = Application :: getConstant("REG_ACT");
		$osbsql = 'SELECT * FROM "estadoacta" WHERE "esacactivas"=\''.$sbstate.'\'';
		return $osbsql;
	}
	
	function getActiveEstadoacta($isbesaccodigos) {
		
		settype($sbstate,"string");
		settype($sbsql,"string");
		
		$sbstate = Application :: getConstant("REG_ACT");
		$sbsql = 'SELECT "esacnombres" FROM "estadoacta" WHERE "esacactivas"=\''.$sbstate.'\' AND "esaccodigos"=\''.$isbesaccodigos.'\'';
		$this->objdb->fncadoselect($sbsql, FETCH_NUM);
		return $this->objdb->rcresult;
	}
	
	/**
    * Copyright 2005 FullEngine
    *
    * Consulta los estados de las actas 
    * @author freina<freina@parquesoft.com>
    * @return array Con indices asociativos como indice
    * @date 04-Aug-2006 11:30:00
    * @location Cali-Colombia
    */
    function getEstadoacta(){
        $sbSql = "SELECT * FROM estadoacta ORDER BY esacnombres";
		$this->objdb->fncadosetmodefetch(FETCH_ASSOC);
		$this->objdb->fncadoexecute($sbSql);
		if (!$this->objdb->objresult)
			return null;
		while (!$this->objdb->objresult->EOF) {
			$rcTmp = $this->objdb->fncadofetch();
			$this->objdb->fncadomovenext();
			$rcReturn[$rcTmp["esaccodigos"]] = $rcTmp["esacnombres"];
		}
        return $rcReturn;
    }
} //End of Class Estadoacta
?>