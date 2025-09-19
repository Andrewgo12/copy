<?php
		
//Paquete de conexion a bases de datos
include_once("pkdatabases.php");
/**
* @Copyright 2005 Parquesoft
*
* Clase que contiene las compuertas basica de la tabla: estadotarea
* @author Ingravity 0.0.9
* @location Cali - Colombia
*/

class FeWFPgsqlEstadotarea
{
	var $consult;
	var $objdb;
		
	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo constructor de la clase tabla: estadotarea
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function FeWFPgsqlEstadotarea(){
	    $config = &ASAP::getStaticProperty('Application','config');
	    $this->objdb = new databases();
	    $this->objdb->fncadoconn($config['database']);
	}
  
	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo para validar si un dato existe en la tabla: estadotarea
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function existEstadotarea($tarecodigos,$esaccodigos){
		$sql = 'SELECT * FROM "estadotarea" WHERE "tarecodigos"=\''.$tarecodigos.'\' AND "esaccodigos"=\''.$esaccodigos.'\'';
	    $this->objdb->fncadoexecute($sql);
	    return $this->objdb->fncadorowcont();
	}
  
	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo para adicionar datos a la tabla: estadotarea
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function addEstadotarea($tarecodigos,$esaccodigos){   
		$sql='INSERT INTO "estadotarea" ("tarecodigos","esaccodigos")'
		.' VALUES(\''.$tarecodigos.'\',\''.$esaccodigos.'\')';
	    $this->objdb->fncadoexecute($sql);
	    if(!$this->objdb->objresult)
	    	return false;
	    else	
	    	return true;
	}
	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo para eliminar datos a la tabla: estadotarea
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function updateEstadotarea($tarecodigos,$esaccodigos) {
		$sql = 'UPDATE "estadotarea" SET "tarecodigos"=\''.$tarecodigos.'\', "esaccodigos"=\''.$esaccodigos.'\' WHERE "tarecodigos"=\''.$tarecodigos.'\' AND "esaccodigos"=\''.$esaccodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			return false;
		else
			return true;
	}
	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo para eliminar datos a la tabla: estadotarea
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function deleteEstadotarea($tarecodigos,$esaccodigos){
		$sql='DELETE FROM "estadotarea" WHERE "tarecodigos"=\''.$tarecodigos.'\' AND "esaccodigos"=\''.$esaccodigos.'\'';
	    $this->objdb->fncadoexecute($sql);
	    if(!$this->objdb->objresult)
	    	return false;
	    else
	    	return true;
	}

	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo para consultar por campo(s) clave(s) y obtener todas las columnas de la tabla: estadotarea
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function getByIdEstadotarea($tarecodigos,$esaccodigos){
		$sql='SELECT * FROM "estadotarea" WHERE "tarecodigos"=\''.$tarecodigos.'\' AND "esaccodigos"=\''.$esaccodigos.'\'';
	    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
	    return $this->objdb->rcresult;
	}

	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo para consultar todos los registros y obtener todas las columnas de la tabla: estadotarea
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function getAllEstadotarea(){
		$sql='SELECT * FROM "estadotarea"';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
  
	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo para consultar por la llave foranea Estadotarea_fkey y obtener todas las columnas de la tabla: estadotarea
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function getByEstadotarea_fkey($tarecodigos){
		$sql='SELECT * FROM "estadotarea" WHERE "tarecodigos"=\''.$tarecodigos.'\'';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo para consultar por la llave foranea Estadotarea_fkey1 y obtener todas las columnas de la tabla: estadotarea
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function getByEstadotarea_fkey1($esaccodigos){
		$sql='SELECT * FROM "estadotarea" WHERE "esaccodigos"=\''.$esaccodigos.'\'';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo para consultar por el(los) campo(s) llave(s) y obtener la columna Tarecodigos de la tabla: estadotarea
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function getTarecodigos($tarecodigos,$esaccodigos){
		$sql='SELECT "tarecodigos" FROM "estadotarea" WHERE "tarecodigos"=\''.$tarecodigos.'\' AND "esaccodigos"=\''.$esaccodigos.'\'';
	    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
	    return $this->objdb->rcresult;
	}  

	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo para consultar por el(los) campo(s) llave(s) y obtener la columna Esaccodigos de la tabla: estadotarea
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function getEsaccodigos($tarecodigos,$esaccodigos){
		$sql='SELECT "esaccodigos" FROM "estadotarea" WHERE "tarecodigos"=\''.$tarecodigos.'\' AND "esaccodigos"=\''.$esaccodigos.'\'';
	    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
	    return $this->objdb->rcresult;
	}  

  
} //End of Class Estadotarea
?>