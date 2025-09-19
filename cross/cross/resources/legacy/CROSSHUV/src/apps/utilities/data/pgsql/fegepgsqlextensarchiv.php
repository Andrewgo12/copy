<?php
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeGePgsqlExtensarchiv {

	function FeGePgsqlExtensarchiv() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
		$this->executeSql = true;
	}
	/**
	 * @Copyright 2012 Parquesoft
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
	 * @Copyright 2012 Parquesoft
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
	 * @Copyright 2012 Parquesoft
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
	 * @Copyright 2012 Parquesoft
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
	 * @Copyright 2012 Parquesoft
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
	 * @Copyright 2012 Parquesoft
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
	 * @Copyright 2012 Parquesoft
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

	/**
	 * @Copyright 2012 Parquesoft
	 *
	 * Obtiene los registros de Extensarchiv
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getExtensarchiv(){

		settype($rcResult,"array");
		settype($rcTmp,"array");
		settype($sbSql,"string");
		settype($sbTmp,"string");

		if(is_array($this->rcData) && $this->rcData){
			extract($this->rcData);	
		}

		if($exarcodigos){
			$rcTmp[] = ' "exarcodigos"=\''.$exarcodigos.'\' ';
		}

		$sbSql = 'SELECT * FROM "extensarchiv" ';

		if(is_array($rcTmp) && $rcTmp){
			$sbTmp = implode(" AND ",$rcTmp);
			$sbSql .= ' WHERE ';
			$sbSql .= $sbTmp;
		}

		if(!$this->executeSql){
			$this->_rcSql[] = $sbSql;
			return;
		}
		$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		$rcResult = $this->objdb->rcresult;

		$this->rcResult = $rcResult;

	}
} //End of Class extensarchiv
?>