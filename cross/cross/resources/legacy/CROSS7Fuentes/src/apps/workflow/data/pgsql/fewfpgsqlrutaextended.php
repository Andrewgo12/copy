<?php
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeWFPgsqlRutaExtended {
	var $connection;
	var $consult;
	var $objdb;
	function FeWFPgsqlRutaExtended() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	function getByRuta_rutainitars($proccodigos, $rutainitars) {
		$sql = 'SELECT
						"tarea"."tarecodigos",
						"tarea"."orgacodigos",
						"ruta"."rutaesactas",' .
						'"ruta"."rutacodigon",
						"ruta"."rutaporcumn"
					FROM 
						"ruta","tarea"
					WHERE 
						"ruta"."proccodigos" = \''.$proccodigos.'\' AND 
						"ruta"."rutainitars" = \''.$rutainitars.'\'
						AND "ruta"."tarecodigos" = "tarea"."tarecodigos"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getByRuta_rutaesactas($proccodigos, $tarecodigos, $rutaesactas) {
		settype($sbSql,"string");
		$sbSql .= 'SELECT * ';
		$sbSql .= 'FROM "ruta" ';
		$sbSql .= "WHERE  \"ruta\".\"proccodigos\" = '$proccodigos' ";
		$sbSql .= "AND \"ruta\".\"tarecodigos\" = '$tarecodigos' ";
		$sbSql .= "AND \"ruta\".\"rutaesactas\" = '$rutaesactas' ";
		$sbSql .= "AND (\"ruta\".\"rutainitars\" IS NULL OR \"ruta\".\"rutainitars\"='')";
		$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getByRuta_rutatarsigs($proccodigos, $tarecodigos, $rutainitars) {
		settype($sbSql,"string");
		$sbSql .= 'SELECT "tarea"."tarecodigos", "tarea"."orgacodigos", "ruta"."rutaesactas","ruta"."rutacodigon"';
		$sbSql .= ' FROM "ruta","tarea"';
		$sbSql .= " WHERE 	\"ruta\".\"proccodigos\" = '$proccodigos'";
		$sbSql .= " AND \"ruta\".\"rutainitars\" ='$rutainitars'";
		$sbSql .= " AND \"ruta\".\"tarecodigos\" = '$tarecodigos'";
		$sbSql .= " AND \"ruta\".\"tarecodigos\" = \"tarea\".\"tarecodigos\"";
		$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	/**
	 * Copyright 2005 FullEngine
	 *
	 * Consulta las ocurrencias de un estado de
	 * tarea en la tabla de rutas
	 * @author creyes
	 * @param type name desc
	 * @return type name desc
	 * @date 22-December-2005 15:54:31
	 * @location Cali-Colombia
	 */
	function getRutaByRutaesactas($rutaesactas){
		$sql = 'SELECT * FROM "ruta" WHERE "ruta"."rutaesactas" = \''.$rutaesactas.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	/**
	* Copyright 2010 FullEngine
	*
	* Obtiene el estado inicial de una tarea dentro de un proceso
	* @author freina <freina@parquesoft.com>
	* @param string $sbProccodigos Cadena con el Id del proceso
	* @param string $sbTarecodigos Cadena con el Id de la tarea
	* @return type name desc
	* @date 10-Oct-2010 15:00:00
	* @location Cali-Colombia
	*/
	function getEstIniTarea($sbProccodigos,$sbTarecodigos){
		
		settype($sbSql,"string");
		$sbSql = 'SELECT * from "ruta" where "proccodigos"=\''.$sbProccodigos.'\' and "tarecodigos"=\''.$sbTarecodigos.'\' AND "rutainitars" IS NOT NULL';
		$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		return $this->objdb->rcresult;
		
	}
	/**
	* Copyright 2010 FullEngine
	*
	* Obtiene los estados configurados para una tarea dentro de un proceso
	* @author freina <freina@parquesoft.com>
	* @param string $sbProccodigos Cadena con el Id del proceso
	* @param string $sbTarecodigos Cadena con el Id de la tarea
	* @param boolean indica si se cierra o no el servicio
	* @return type name desc
	* @date 18-Oct-2010 16:29:00
	* @location Cali-Colombia
	*/
	function getEstTarea($sbProccodigos,$sbTarecodigos){
		
		settype($sbSql,"string");
		$sbSql = 'SELECT * from "ruta" where "proccodigos"=\''.$sbProccodigos.'\' and "tarecodigos"=\''.$sbTarecodigos.'\' AND "rutainitars" IS NULL';
		$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		return $this->objdb->rcresult;
		
	}
	/**
    * Copyright 2010 FullEngine
    * 
    * Consulta las tareas de un proceso
    * @author freina<freina@parquesoft.com>
    * @param string $sbProccodigos Codigo del proceso
    * @return array
    * @date 01-Nov-2010 16:00
    * @location Cali-Colombia
    */
	function getByProceso_Tareas($sbProccodigos) {
		settype($sbSql,"string");
		$sbSql = 'SELECT DISTINCT "ruta"."tarecodigos","tarea"."tarenombres"
				  FROM "ruta","tarea" WHERE "ruta"."proccodigos" = \''.$sbProccodigos.'\' 
				  AND "ruta"."tarecodigos" = "tarea"."tarecodigos"';
		$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Ruta
?>