<?php
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeCrPgsqlIndoprequre {

	function FeCrPgsqlIndoprequre() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
		$this->executeSql = true;
	}
	/**
	 * @Copyright 2013 Parquesoft
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
	 * @Copyright 2013 Parquesoft
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
	 * @Copyright 2013 Parquesoft
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
	 * @Copyright 2013 Parquesoft
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
	 * @Copyright 2013 Parquesoft
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
	 * @Copyright 2013 Parquesoft
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
	 * @Copyright 2013 Parquesoft
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
	 * @Copyright 2013 Parquesoft
	 *
	 * Obtiene los registros de los casos
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getCasos(){

		settype($rcResult,"array");
		settype($rcTmp,"array");
		settype($sbSql,"string");
		settype($sbTmp,"string");

		extract($this->rcData);

		if($ordefecregdb && $ordefecregde){
			$rcTmp[] = ' "ordefecregd" BETWEEN '.$ordefecregdb.' AND '.$ordefecregde.' ';
		}

		if($ordefecingdb && $ordefecingde){
			$rcTmp[] = ' "ordefecingd" BETWEEN '.$ordefecingdb.' AND '.$ordefecingde.' ';
		}

		if($ordefecfinad){
			$rcTmp[] = ' "ordefecfinad" IS NOT NULL ';
		}
		
		if($tiorcodigos){
			$rcTmp[] = ' "ordenempresa"."tiorcodigos" = \''.$tiorcodigos.'\' ';
		}
		
		if($evencodigos){
			$rcTmp[] = ' "ordenempresa"."evencodigos" = \''.$evencodigos.'\' ';
		}
		
		if($causcodigos){
			$rcTmp[] = ' "ordenempresa"."causcodigos" = \''.$causcodigos.'\' ';
		}
		

		$sbSql = 'SELECT "orden".*,"ordenempresa".* FROM "orden","ordenempresa" LEFT JOIN "causa" ON ("ordenempresa"."tiorcodigos"="causa"."tiorcodigos" 
																			 AND "ordenempresa"."evencodigos"="causa"."evencodigos" 
																			 AND "ordenempresa"."causcodigos"="causa"."causcodigos"),"tipoorden","evento" 
								   WHERE "orden"."ordenumeros"="ordenempresa"."ordenumeros" 
								   AND "ordenempresa"."tiorcodigos"="tipoorden"."tiorcodigos" 
								   AND "ordenempresa"."tiorcodigos"="evento"."tiorcodigos" 
								   AND "ordenempresa"."evencodigos"="evento"."evencodigos" ';

		if(is_array($rcTmp) && $rcTmp){
			$sbSql .= " AND ";
			$sbTmp = implode(" AND ",$rcTmp);
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
} //End of Class indoprequre
?>