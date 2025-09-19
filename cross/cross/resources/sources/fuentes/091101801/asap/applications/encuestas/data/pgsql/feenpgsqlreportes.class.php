<?php
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeEnPgsqlReportes {

	function FeEnPgsqlReportes() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
		$this->executeSql = true;
	}
	/**
	 * @Copyright 2009 Parquesoft
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
	 * @Copyright 2009 Parquesoft
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
	 * @Copyright 2009 Parquesoft
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
	 * @Copyright 2009 Parquesoft
	 *
	 * obtiene el sql
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getSql(){
		return $this->sbSql;
	}
	/**
	 * @Copyright 2009 Parquesoft
	 *
	 * Obtiene el resultado de la consulta (data)
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getResult(){
		return $this->rcResult;
	}

	function getResponseFrequencies(){

		settype($rcResult,"array");
		settype($sbSql,"string");

		extract($this->rcData);

		$sbSql =  'SELECT "detarespusua"."oprecodigon", count ("detarespusua"."oprecodigon") AS "cantidad" ';
		$sbSql .= 'FROM "respuestausu", "detarespusua" ';
		$sbSql .= 'WHERE "respuestausu"."formcodigon" = '.$formcodigon.' ';
		$sbSql .= 'AND "respuestausu"."reusfecingn" BETWEEN '.$fechaini." AND ".$fechafin.' ';
		$sbSql .= 'AND "respuestausu"."reuscodigon"="detarespusua"."reuscodigon" ';
		$sbSql .= 'GROUP BY "detarespusua"."oprecodigon"';
		 
		$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		$rcResult = $this->objdb->rcresult;

		$this->rcResult = $rcResult;
	}
} //End of Class Reporte
?>