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
class FePrPgsqlAuthschema {
	
	/**
	 * @Copyright 2005 Parquesoft
	 *
	 * Metodo constructor de la clase tabla: schema
	 * @author Ingravity 0.0.9
	 * @location Cali - Colombia
	 */
	function FePrPgsqlAuthschema(){
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
	 * @Copyright 2005 Parquesoft
	 *
	 * Metodo para validar si un dato existe en la tabla: schema
	 * @author Ingravity 0.0.9
	 * @location Cali - Colombia
	 */
	function existAuthschema($authusernams,$schecodigon){
		$sql = 'SELECT * FROM "authschema"  WHERE "schecodigon"=\''.$schecodigon.'\' AND "authusernams"=\''.$authusernams.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}

	/**
	 * @Copyright 2005 Parquesoft
	 *
	 * Metodo para adicionar datos a la tabla: schema
	 * @author Ingravity 0.0.9
	 * @location Cali - Colombia
	 */
	function addAuthschema($authusernams,$schecodigon){
		
		settype($sbSql,"string");
		
		$sbSql='INSERT INTO "authschema" ("authusernams","schecodigon") VALUES (\''.$authusernams.'\',\''.$schecodigon.'\')';
		
		//retorna el sql
		if(!$this->executeSql){
			$this->_rcSql[] = $sbSql;
			return;
		}
		
		$this->objdb->fncadoexecute($sbSql);
		if(!$this->objdb->objresult)
		$this->consult = false;
		else
		$this->consult = true;
		return true;
	}

	/**
	 * @Copyright 2005 Parquesoft
	 *
	 * Metodo para eliminar datos a la tabla: schema
	 * @author Ingravity 0.0.9
	 * @location Cali - Colombia
	 */
	function deleteAuthschema($authusernams,$schecodigon){
		$sql='DELETE FROM "authschema" WHERE "authusernams"=\''.$authusernams.'\'';
		if($schecodigon)
		$sql .=  ' AND "schecodigon"=\''.$schecodigon.'\'';
		$this->objdb->fncadoexecute($sql);
		if(!$this->objdb->objresult)
		return false;
		else
		return true;
	}

	/**
	 * @Copyright 2005 Parquesoft
	 *
	 * Metodo para consultar por campo(s) clave(s) y obtener todas las columnas de la tabla: schema
	 * @author Ingravity 0.0.9
	 * @location Cali - Colombia
	 */
	function getByIdSchema($schecodigon){
		$sql='SELECT * FROM "authschema" WHERE "schecodigon"=\''.$schecodigon.'\'';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	/**
	 * @Copyright 2005 Parquesoft
	 *
	 * Metodo para consultar todos los registros y obtener todas las columnas de la tabla: schema
	 * @author Ingravity 0.0.9
	 * @location Cali - Colombia
	 */
	function getAllSchema(){
		$sql='SELECT * FROM "authschema"';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	/**
	 * Copyright 2006 FullEngine
	 *
	 *  Consulta los esquemas menos el del profiles
	 * @author creyes
	 * @param type name desc
	 * @return type name desc
	 * @date 17-March-2006 12:2:48
	 * @location Cali-Colombia
	 */

	function getSchemasUser($authusernams){
		$sql='SELECT "schecodigon" FROM "authschema" WHERE "authusernams"=\''.$authusernams.'\'';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getAuthAuthSchema($authusernams,$schecodigon){
		$sql = 'SELECT * FROM "authschema"  WHERE "schecodigon"=\''.$schecodigon.'\' AND "authusernams"=\''.$authusernams.'\'';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Schema
?>