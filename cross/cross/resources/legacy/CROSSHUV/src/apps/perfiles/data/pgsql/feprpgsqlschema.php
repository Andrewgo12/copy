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

class FePrPgsqlSchema{

	/**
	 * @Copyright 2005 Parquesoft
	 *
	 * Metodo constructor de la clase tabla: schema
	 * @author Ingravity 0.0.9
	 * @location Cali - Colombia
	 */
	function FePrPgsqlSchema(){
		$this->config = &ASAP::getStaticProperty('Application','config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($this->config['database']);
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
	function existSchema($schecodigon){
		$sql = "SELECT * FROM schema WHERE schecodigon='$schecodigon'";
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
	function addSchema($schecodigon,$schenombres,$schedbusers,$schedbkeys,$scheobservas){
		
		settype($sbSql,"string");
		
		$sbSql='INSERT INTO "schema" ("schecodigon","schenombres","schedbusers","schedbkeys","scheobservas")' .
			' VALUES (\''.$schecodigon.'\',\''.$schenombres.'\',\''.$schedbusers.'\',\''.$schedbkeys.'\',\''.$scheobservas.'\')';

		//retorna el sql
		if(!$this->executeSql){
			$this->_rcSql[] = $sbSql;
			return;
		}
		
		$this->objdb->fncadoexecute($sbSql);
			
		if(!$this->objdb->objresult)
		return false;
		else
		return true;
	}

	/**
	 * @Copyright 2005 Parquesoft
	 *
	 * Metodo para actualizar los datos a la tabla: schema
	 * @author Ingravity 0.0.9
	 * @location Cali - Colombia
	 */
	function updateSchema($schecodigon,$schenombres,$scheobservas){
		$sql='UPDATE "schema" SET "schenombres"=\''.$schenombres.'\',"scheobservas"=\''.$scheobservas.'\' WHERE "schecodigon"=\''.$schecodigon.'\'';
		$this->objdb->fncadoexecute($sql);
		if(!$this->objdb->objresult)
		return false;
		else
		return true;
	}


	/**
	 * @Copyright 2005 Parquesoft
	 *
	 * Metodo para eliminar datos a la tabla: schema
	 * @author Ingravity 0.0.9
	 * @location Cali - Colombia
	 */
	function deleteSchema($schecodigon)
	{
		$sbInactive = Application::getConstant("REG_INACT");
		$sql='UPDATE "schema" SET "scheestados"=\''.$sbInactive.'\' WHERE "schecodigon"=\''.$schecodigon.'\'';
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
		$sql='SELECT * FROM "schema" WHERE "schecodigon"=\''.$schecodigon.'\'';
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
		$sbActive = Application::getConstant("REG_ACTIVE");
		$profileSchema = Application :: getConstant("SCHEMA_PROFILE");
		$sql='SELECT * FROM "schema" WHERE "schecodigon" != \''.$profileSchema.'\' AND "scheestados"=\''.$sbActive.'\'';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	/**
	 * @Copyright 2005 Parquesoft
	 *
	 * Metodo para consultar por el(los) campo(s) llave(s) y obtener la columna Schecodigon de la tabla: schema
	 * @author Ingravity 0.0.9
	 * @location Cali - Colombia
	 */
	function getSchecodigon($schecodigon){
		$sql='SELECT "schecodigon" FROM "schema" WHERE "schecodigon"=\''.$schecodigon.'\'';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	
	function getSqlSchecodigonByNombre($schenombres){
		$sql='SELECT "schecodigon" FROM "schema" WHERE UPPER("schenombres") LIKE \''.strtoupper($schenombres).'\'';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	/**
	 * @Copyright 2005 Parquesoft
	 *
	 * Metodo para consultar por el(los) campo(s) llave(s) y obtener la columna Schenombres de la tabla: schema
	 * @author Ingravity 0.0.9
	 * @location Cali - Colombia
	 */
	function getSchenombres($schecodigon){
		$sql='SELECT "schenombres" FROM "schema" WHERE "schecodigon"=\''.$schecodigon.'\'';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	/**
	 * @Copyright 2005 Parquesoft
	 *
	 * Metodo para consultar por el(los) campo(s) llave(s) y obtener la columna Schedbusers de la tabla: schema
	 * @author Ingravity 0.0.9
	 * @location Cali - Colombia
	 */
	function getSchedbusers($schecodigon){
		$sql='SELECT "schedbusers" FROM "schema" WHERE "schecodigon"=\''.$schecodigon.'\'';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	/**
	 * @Copyright 2005 Parquesoft
	 *
	 * Metodo para consultar por el(los) campo(s) llave(s) y obtener la columna Schedbkeys de la tabla: schema
	 * @author Ingravity 0.0.9
	 * @location Cali - Colombia
	 */
	function getSchedbkeys($schecodigon){
		$sql='SELECT "schedbkeys" FROM "schema" WHERE "schecodigon"=\''.$schecodigon.'\'';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	/**
	 * @Copyright 2005 Parquesoft
	 *
	 * Metodo para consultar por el(los) campo(s) llave(s) y obtener la columna Scheobservas de la tabla: schema
	 * @author Ingravity 0.0.9
	 * @location Cali - Colombia
	 */
	function getScheobservas($schecodigon){
		$sql='SELECT "scheobservas" FROM "schema" WHERE "schecodigon"=\''.$schecodigon.'\'';
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
	function getSchemas(){
		$sbActive = Application::getConstant("REG_ACTIVE");
		$profile_schema = Application::getConstant('SCHEMA_PROFILE');

		$sql='SELECT "schecodigon","schenombres" FROM "schema" WHERE "scheestados"=\''.$sbActive.'\' AND "schecodigon"<>\''.$profile_schema.'\'';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	/**
	 * Copyright 2006 FullEngine
	 *
	 *  genera el sql para crear un schema
	 * @author mrestrepo
	 * @param type name desc
	 * @return type name desc
	 * @date 17-March-2006 12:2:48
	 * @location Cali-Colombia
	 */
	function getSqlCreateSchema($sbNme){
		return 'CREATE SCHEMA "'.$sbNme.'"';
	}

	/**
	 * Copyright 2006 FullEngine
	 *
	 *  genera el sql para crear un schema
	 * @author mrestrepo
	 * @param type name desc
	 * @return type name desc
	 * @date 07-April-2006 12:2:48
	 * @location Cali-Colombia
	 */
	function getSqlUseSchema($sbName)
	{
		$this->objdb->tableSpace = $sbName;
		return $this->objdb->setDbParams();
	}

	/**
	 * Copyright 2006 FullEngine
	 *
	 *  genera el sql para destruir un schema
	 * @author mrestrepo
	 * @param type name desc
	 * @return type name desc
	 * @date 07-April-2006 12:2:48
	 * @location Cali-Colombia
	 */
	function getSqlDropSchema($sbName)
	{
		settype($sbMethod,"string");
		settype($sbResult,"string");
		
		if($sbName){
			$this->sbName = $sbName;
			$sbMethod = "_getSqlDropSchema_".$this->config["database"]["driver"];
			$sbResult = $this->$sbMethod();
		}
		return $sbResult;
	}
	
	function _getSqlDropSchema_pgsql(){
		return 'DROP SCHEMA '.$sbName.' CASCADE';
	}
	
	function _getSqlDropSchema_oci8(){
		return 'DROP USER '.$sbName.' CASCADE';
	}

	/**
	 * @Copyright 2005 Parquesoft
	 *
	 * Metodo para crear el schema directamente en la bd
	 * @author Ingravity 0.0.9
	 * @location Cali - Colombia
	 */
	function createSchema($nuSchecodigon)
	{
		settype($sbMethod,"string");

		$this->sbName = Application::getConstant("SUFIJO_SCHEMA").$nuSchecodigon;
		
		$sbMethod = "_createSchema_".$this->config["database"]["driver"];
		
		$this->$sbMethod();
		
		return $this->consult;
	}
	
	/**
	 * @Copyright 2011 Parquesoft
	 *
	 * Metodo para crear el schema directamente en la bd para el motor PostreSQL
	 * @author Ingravity 0.0.9
	 * @location Cali - Colombia
	 */
	function _createSchema_pgsql(){


		settype($rcSql, "array");
		settype($sbResult, "string");
		settype($sbPath, "string");
		
		$sbResult = false;

		if($this->sbName){
			
			$rcSql[] =  'CREATE SCHEMA "'.$this->sbName.'"';
			$rcSql[] = "SET search_path = ".$this->sbName.", pg_catalog";
			$sbPath = Application::getConstant("TABLES_TEMPLATE_PATH");
			$rcSql[] = file_get_contents($sbPath);
			$sbPath = Application::getConstant("DATA_TEMPLATE_PATH");
			$rcSql[] = file_get_contents($sbPath);
			$sbPath = Application::getConstant("CONSTRAINTS_TEMPLATE_PATH");
			$rcSql[] = file_get_contents($sbPath);
	
			//retorna el sql
			if(!$this->executeSql){
				$this->_rcSql = $rcSql;
				return;
			}
			$sbResult = $this->objdb->fncadoexecutetrans($rcSql);	
		}
		
		$this->consult = $sbResult;

		return;
	}
	
	/**
	 * @Copyright 2011 Parquesoft
	 *
	 * Metodo para crear el schema directamente en la bd para el motor ORACLE
	 * @author Ingravity 0.0.9
	 * @location Cali - Colombia
	 */
	function _createSchema_oci8(){

		settype($rcSql, "array");
		settype($rcTmp, "array");
		settype($rcTmpR, "array");
		settype($sbResult, "string");
		settype($sbTmp, "string");
		settype($sbPath, "string");
		settype($sbSql, "string");
		settype($nuCont, "integer");
		settype($nuContR, "integer");
		
		$sbResult = false;

		if($this->sbName){
			
			$nuContR = 0;
			
			$rcSql[] = 'CREATE USER '.$this->sbName.' IDENTIFIED BY '.$this->sbName.'  DEFAULT TABLESPACE USERS TEMPORARY TABLESPACE TEMP ACCOUNT UNLOCK';
			$rcSql[] = 'GRANT "CONNECT"  TO '.$this->sbName;
			$rcSql[] = 'GRANT "RESOURCE" TO '.$this->sbName;
			$rcSql[] = 'ALTER SESSION SET NLS_NUMERIC_CHARACTERS=". "';
			$rcSql[] = "ALTER SESSION SET CURRENT_SCHEMA = ".$this->sbName;
			$sbPath = Application::getConstant("TABLES_TEMPLATE_PATH");
			$sbTmp = file_get_contents($sbPath);
			$rcTmp = explode(";\n",$sbTmp);
			if(is_array($rcTmp) && $rcTmp){
				foreach($rcTmp as $nuCont=>$sbSql){
					$sbSql = trim($sbSql);
					if($sbSql){
						$rcTmpR[$nuContR] = $sbSql;
						$nuContR ++; 
					}
				}
			}
			$sbPath = Application::getConstant("DATA_TEMPLATE_PATH");
			$sbTmp = file_get_contents($sbPath);
			$rcTmp = explode(";\n",$sbTmp);
			if(is_array($rcTmp) && $rcTmp){
				foreach($rcTmp as $nuCont=>$sbSql){
					$sbSql = trim($sbSql);
					if($sbSql){
						$rcTmpR[$nuContR] = $sbSql;
						$nuContR ++; 
					} 
				}
			}
			$sbPath = Application::getConstant("CONSTRAINTS_TEMPLATE_PATH");
			$sbTmp = file_get_contents($sbPath);
			$rcTmp = explode(";\n",$sbTmp);
			if(is_array($rcTmp) && $rcTmp){
				foreach($rcTmp as $nuCont=>$sbSql){
					$sbSql = trim($sbSql);
					if($sbSql){
						$rcTmpR[$nuContR] = $sbSql;
						$nuContR ++; 
					} 
				}
			}
			
			if(is_array($rcTmpR) && $rcTmpR){
				$rcSql = array_merge($rcSql,$rcTmpR);
			}
			
			$sbResult = $this->objdb->fncadoexecutetrans($rcSql);
		}
		
		$this->consult = $sbResult;

		return;
	}

	/**
	 * @Copyright 2010 Parquesoft
	 *
	 * Cambia el esquema actual
	 * @author Ingravity 0.0.9
	 * @location Cali - Colombia
	 */
	function setSchema(){
		settype($sbSql,"string");
		settype($sbResult,"string");

		extract($this->rcData);

		if($schenombres){
				
			$sbSql = "SET search_path = ".$schenombres.", pg_catalog";
			//retorna el sql
			if(!$this->executeSql){
				$this->_rcSql[] = $sbSql;
				return;
			}

			$this->objdb->fncadoexecute($sbSql);
			$sbResult = $this->objdb->objresult;
			if(!$sbResult){
				$sbResult = false;
			}else{
				$sbResult = true;
			}
		}
		return $sbResult;
	}
} //End of Class Schema
?>