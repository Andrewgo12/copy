<?php
//Paquete de conexion a bases de datos
include_once("pkdatabases.php");
/**
 * @Copyright 2005 Parquesoft
 *
 * Clase que contiene las compuertas basica de la tabla: schema
 * @author Ingravity 0.0.9
 * @location Cali - Colombia
 */

class FePrPgsqlCampanha{

	/**
	 * @Copyright 2005 Parquesoft
	 *
	 * Metodo constructor de la clase tabla: schema
	 * @author Ingravity 0.0.9
	 * @location Cali - Colombia
	 */
	function FePrPgsqlCampanha(){
		$config = &ASAP::getStaticProperty('Application','config');
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
	 * ejecuta los sql pasados por parametro en una transaccion
	 * @author Ingravity 0.0.9
	 * @location Cali - Colombia
	 */
	function executeTrans() {
		
		if(is_array($this->_rcSql) && $this->_rcSql){
			$this->objdb->fncadoexecutetrans($this->_rcSql);
			if (!$this->objdb->objresult) {
				$this->consult = false;
			} else {
				$this->consult = true;
			}
		}else{
			$this->consult = false;
		}
	}
} //End of Class Schema
?>