<?php
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeCrPgsqlTipoordenExtended {
	
	function FeCrPgsqlTipoordenExtended() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
		$this->executeSql = true;
	}
	
	/**
	 * @Copyright 2010 Parquesoft
	 *
	 * Modifica el arreglo de datos
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function setData($rcData){
		$this->rcData = $rcData;
	}
	/**
	 * @Copyright 2010 Parquesoft
	 *
	 * Obtiene el resultado de la consulta
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getConsult(){
		return $this->consult;
	}
	/**
	 * @Copyright 2010 Parquesoft
	 *
	 * determina si se ejecuta el sql
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function setExecuteSql($blState) {
		$this->executeSql = $blState;
	}
	/**
	 * @Copyright 2010 Parquesoft
	 *
	 * obtiene el sql
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getSql(){
		return $this->_rcSql;
	}
	/**
	 * @Copyright 2010 Parquesoft
	 *
	 * Obtiene el resultado de la consulta (data)
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getResult(){
		return $this->rcResult;
	}
	
	/**
	 * @Copyright 2010 Parquesoft
	 *
	 * Conjunto de sql a ejecutar
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function setSql($rcSql){
		$this->_rcSql = $rcSql;
	}
	
	/**
	 * @Copyright 2010 Parquesoft
	 *
	 * ejecuta las transaccion
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function executeTrans() {
		if (!$this->_rcSql) {
			$this->consult = false;
		}
		$this->objdb->fncadoexecutetrans($this->_rcSql);
		if (!$this->objdb->objresult) {
			$this->consult = false;
		} else {
			$this->consult = true;
		}
	}
	
	function getAllActiveTipoorden() {
		
		settype($sbstate,"string");
		settype($osbsql,"string");
		
		$sbstate = Application :: getConstant("REG_ACT");
		$osbsql = 'SELECT * FROM "tipoorden" WHERE "tioractivos"=\''.$sbstate.'\'';
		return $osbsql;
	}
	
	function getAllTipoorden() {
		
		settype($sbState,"string");
		settype($sbSql,"string");
		
		$sbState = Application :: getConstant("REG_ACT");
		$sbSql = 'SELECT * FROM "tipoorden" WHERE "tioractivos"=\''.$sbState.'\'';
		$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	
	function getActiveTipoorden($isbtiorcodigos) {
		
		settype($sbstate,"string");
		settype($sbsql,"string");
		
		$sbstate = Application :: getConstant("REG_ACT");
		$sbsql = 'SELECT "tiornombres" FROM "tipoorden" WHERE "tioractivos"=\''.$sbstate.'\' AND "tiorcodigos"=\''.$isbtiorcodigos.'\'';
		$this->objdb->fncadoselect($sbsql, FETCH_NUM);
		return $this->objdb->rcresult;
	}
	
	/**
    * Copyright 2006 FullEngine
    * 
    * Consulta los tipos de requerimiento y retorna un arreglo con indices aosciativos, 
    * descartando los tipos detallados  como  invalidos (seguimiento)
    * @author freina<freina@parquesoft.com>
    * @date 29-May-2007 11:45
    * @location Cali-Colombia
    */
	function getTipoordenWithoutPursuit() {
		
		settype($objService,"object");
		settype($rcTypes,"array");
		settype($sbState,"string");
		settype($sbSql,"string");
		settype($sbTmp,"string");
		
		//Se obtiene los tipos de caso que no deben presentarse en las tablas.
		$objService = Application :: loadServices("General");
		$rcTypes = $objService->getParam("cross300","TYPES_CASE_PURSUIT");
		
		if(is_array($rcTypes) && $rcTypes){
			$sbTmp = " AND \"tipoorden\".\"tiorcodigos\" NOT IN ('".implode("','",$rcTypes)."')";
		}
		
		$sbState = Application :: getConstant("REG_ACT");
		$sbSql = "SELECT * FROM tipoorden WHERE tioractivos='".$sbState."'".$sbTmp;
		$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	
	/**
    * Copyright 2006 FullEngine
    * 
    * Consulta los tipos de requerimiento y retorna un arreglo con indices aosciativos, 
    * solo los tipos que se entiende como de seguimiento
    * @author freina<freina@parquesoft.com>
    * @date 29-May-2007 11:45
    * @location Cali-Colombia
    */
	function getTipoordenPursuit() {
		
		settype($objService,"object");
		settype($rcTypes,"array");
		settype($sbState,"string");
		settype($sbSql,"string");
		settype($sbTmp,"string");
		
		$sbState = Application :: getConstant("REG_ACT");
		$sbSql = "SELECT * FROM tipoorden WHERE tioractivos='".$sbState."'";
		$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	
	/**
	 * @Copyright 2010 Parquesoft
	 *
	 * Obtiene el peso de la carga de trabajo de una dependencia
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getPesotipoByOrgacodigos(){
		
		settype($rcResult,"array");
		settype($sbSql,"string");
		
		extract($this->rcData);
		
		$sbSql = 'SELECT sum("tipoorden"."tiorpeson") as "peso"  
		FROM "acta", "orden","ordenempresa" LEFT JOIN "tipoorden" ON ("ordenempresa"."tiorcodigos"="tipoorden"."tiorcodigos") 
		WHERE "acta"."orgacodigos"=\''.$orgacodigos.'\' AND "acta"."actafechfinn" IS NULL AND "acta"."actaactivas"=\''.$actaactivas.'\' 
		AND "acta"."ordenumeros"="orden"."ordenumeros"  AND "orden"."ordefecfinad" IS NULL AND "orden"."ordenumeros"="ordenempresa"."ordenumeros"';
		
		if(!$this->executeSql){
			$this->_rcSql[] = $sbSql;
			return;
		}
		
		$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		$rcResult = $this->objdb->rcresult;
		
        $this->rcResult = $rcResult;
	}
} //End of Class Tipoorden
?>