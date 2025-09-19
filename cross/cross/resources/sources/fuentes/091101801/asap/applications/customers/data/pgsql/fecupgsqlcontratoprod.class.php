<?php
		
//Paquete de conexion a bases de datos
include_once("pkdatabases.php");
/**
* @Copyright 2005 Parquesoft
*
* Clase que contiene las compuertas basica de la tabla: contratoprod
* @author Ingravity 0.0.9
* @location Cali - Colombia
*/

class FeCuPgsqlContratoprod
{
	var $consult;
	var $objdb;
		
	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo constructor de la clase tabla: contratoprod
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function FeCuPgsqlContratoprod(){
	    $config = &ASAP::getStaticProperty('Application','config');
	    $this->objdb = new databases();
	    $this->objdb->fncadoconn($config['database']);
	}
  
	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo para validar si un dato existe en la tabla: contratoprod
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function existContratoprod($contnics,$prodcodigos){
		$sql = "SELECT * FROM contratoprod WHERE contnics='$contnics' AND prodcodigos='$prodcodigos'";
	    $this->objdb->fncadoexecute($sql);
	    return $this->objdb->fncadorowcont();
	}
  
	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo para adicionar datos a la tabla: contratoprod
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function addContratoprod($contnics,$prodcodigos,$coprcantidan,$coprvalunidn,$coprserials,$copovigencn,$copodefinis,$copoclausus,$coporestris){   
		$sql="INSERT INTO contratoprod VALUES('$contnics','$prodcodigos',$coprcantidan,$coprvalunidn,'$coprserials',$copovigencn,'$copodefinis','$copoclausus','$coporestris')";
	    $this->objdb->fncadoexecute($sql);
	    if(!$this->objdb->objresult)
	    	return false;
	    else	
	    	return true;
	}
  
	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo para actualizar los datos a la tabla: contratoprod
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function updateContratoprod($contnics,$prodcodigos,$coprcantidan,$coprvalunidn,$coprserials,$copovigencn,$copodefinis,$copoclausus,$coporestris){
		$sql="UPDATE contratoprod SET coprcantidan=$coprcantidan,coprvalunidn=$coprvalunidn,coprserials='$coprserials',copovigencn=$copovigencn,copodefinis='$copodefinis',copoclausus='$copoclausus',coporestris='$coporestris' WHERE contnics='$contnics' AND prodcodigos='$prodcodigos'";
		$this->objdb->fncadoexecute($sql);
		if(!$this->objdb->objresult)
			return false;
		else	
			return true;
	}
  

	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo para eliminar datos a la tabla: contratoprod
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function deleteContratoprod($contnics,$prodcodigos){
		$sql="DELETE FROM contratoprod WHERE contnics='$contnics' AND prodcodigos='$prodcodigos'";
	    $this->objdb->fncadoexecute($sql);
	    if(!$this->objdb->objresult)
	    	return false;
	    else
	    	return true;
	}

	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo para consultar por campo(s) clave(s) y obtener todas las columnas de la tabla: contratoprod
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function getByIdContratoprod($contnics,$prodcodigos){
		$sql="SELECT * FROM contratoprod WHERE contnics='$contnics' AND prodcodigos='$prodcodigos'";
	    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
	    return $this->objdb->rcresult;
	}

	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo para consultar todos los registros y obtener todas las columnas de la tabla: contratoprod
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function getAllContratoprod(){
		$sql="SELECT * FROM contratoprod";
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
  
	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo para consultar por la llave foranea Contratoprod_fkey y obtener todas las columnas de la tabla: contratoprod
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function getByContratoprod_fkey($contnics){
		$sql="SELECT * FROM contratoprod WHERE contnics='$contnics'";
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo para consultar por la llave foranea Contratoprod_fkey1 y obtener todas las columnas de la tabla: contratoprod
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function getByContratoprod_fkey1($prodcodigos){
		$sql="SELECT * FROM contratoprod WHERE prodcodigos='$prodcodigos'";
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo para consultar por el(los) campo(s) llave(s) y obtener la columna Contnics de la tabla: contratoprod
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function getContnics($contnics,$prodcodigos){
		$sql="SELECT contnics FROM contratoprod WHERE contnics='$contnics' AND prodcodigos='$prodcodigos'";
	    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
	    return $this->objdb->rcresult;
	}  

	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo para consultar por el(los) campo(s) llave(s) y obtener la columna Prodcodigos de la tabla: contratoprod
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function getProdcodigos($contnics,$prodcodigos){
		$sql="SELECT prodcodigos FROM contratoprod WHERE contnics='$contnics' AND prodcodigos='$prodcodigos'";
	    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
	    return $this->objdb->rcresult;
	}  

	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo para consultar por el(los) campo(s) llave(s) y obtener la columna Coprcantidan de la tabla: contratoprod
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function getCoprcantidan($contnics,$prodcodigos){
		$sql="SELECT coprcantidan FROM contratoprod WHERE contnics='$contnics' AND prodcodigos='$prodcodigos'";
	    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
	    return $this->objdb->rcresult;
	}  

	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo para consultar por el(los) campo(s) llave(s) y obtener la columna Coprvalunidn de la tabla: contratoprod
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function getCoprvalunidn($contnics,$prodcodigos){
		$sql="SELECT coprvalunidn FROM contratoprod WHERE contnics='$contnics' AND prodcodigos='$prodcodigos'";
	    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
	    return $this->objdb->rcresult;
	}  

	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo para consultar por el(los) campo(s) llave(s) y obtener la columna Coprlicencis de la tabla: contratoprod
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function getCoprserials($contnics,$prodcodigos){
		$sql="SELECT coprserials FROM contratoprod WHERE contnics='$contnics' AND prodcodigos='$prodcodigos'";
	    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
	    return $this->objdb->rcresult;
	}  

	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo para consultar por el(los) campo(s) llave(s) y obtener la columna Copovigencn de la tabla: contratoprod
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function getCopovigencn($contnics,$prodcodigos){
		$sql="SELECT copovigencn FROM contratoprod WHERE contnics='$contnics' AND prodcodigos='$prodcodigos'";
	    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
	    return $this->objdb->rcresult;
	}  

	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo para consultar por el(los) campo(s) llave(s) y obtener la columna Copodefinis de la tabla: contratoprod
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function getCopodefinis($contnics,$prodcodigos){
		$sql="SELECT copodefinis FROM contratoprod WHERE contnics='$contnics' AND prodcodigos='$prodcodigos'";
	    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
	    return $this->objdb->rcresult;
	}  

	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo para consultar por el(los) campo(s) llave(s) y obtener la columna Copoclausus de la tabla: contratoprod
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function getCopoclausus($contnics,$prodcodigos){
		$sql="SELECT copoclausus FROM contratoprod WHERE contnics='$contnics' AND prodcodigos='$prodcodigos'";
	    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
	    return $this->objdb->rcresult;
	}  

	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo para consultar por el(los) campo(s) llave(s) y obtener la columna Coporestris de la tabla: contratoprod
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function getCoporestris($contnics,$prodcodigos){
		$sql="SELECT coporestris FROM contratoprod WHERE contnics='$contnics' AND prodcodigos='$prodcodigos'";
	    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
	    return $this->objdb->rcresult;
	}  

  
} //End of Class Contratoprod
?>