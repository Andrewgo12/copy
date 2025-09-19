<?php
//Paquete de conexion a bases de datos
include_once("pkdatabases.php");
/**
* @Copyright 2005 Parquesoft
*
* Clase que contiene las compuertas basica de la tabla: archivos
* @author Ingravity 0.0.9
* @location Cali - Colombia
*/

class FeGePgsqlArchivos
{
	var $consult;
	var $objdb;
		
	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo constructor de la clase tabla: archivos
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function FeGePgsqlArchivos(){
	    $config = &ASAP::getStaticProperty('Application','config');
	    $this->objdb = new databases();
	    $this->objdb->fncadoconn($config['database']);
        $this->objdate = Application :: loadServices("DateController");
	}
  
	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo para validar si un dato existe en la tabla: archivos
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function existArchivos($archcodigon){
		$sql = 'SELECT * FROM "archivos" WHERE "archcodigon"='.$archcodigon;
	    $this->objdb->fncadoexecute($sql);
	    return $this->objdb->fncadorowcont();
	}
  
	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo para adicionar datos a la tabla: archivos
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function addArchivos($archcodigon,$archidrefes,$archreferes,$archnombres,$archmimetys,$archtamanon,$archcontens){   
        $archfechan = $this->objdate->fncintdatehour();
        $sql='INSERT INTO "archivos" VALUES('.$archcodigon.',\''.$archidrefes.'\',\''.$archreferes
        .'\',\''.$archnombres.'\',\''.$archmimetys.'\','.$archtamanon.','.CLOB.','.$archfechan.')';
	    $this->objdb->fncadoexecute($sql);
	    
	    ///ingreso de BLOB
	    $this->objdb->fncadoUpdateClob('"archivos"', '"archcodigon"', '"archcontens"', $archcontens, $archcodigon);
	    
	    if(!$this->objdb->objresult)
	    	return false;
	    else	
	    	return true;
	}
  
	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo para actualizar los datos a la tabla: archivos
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function updateArchivos($archcodigon,$archidrefes,$archreferes,$archnombres,$archmimetys,$archtamanon,$archcontens){
		$archfechan = $this->objdate->fncintdatehour();
        $sql='UPDATE "archivos" '.
            'SET '.
                '"archidrefes"=\''.$archidrefes.'\','.
                '"archreferes"=\''.$archreferes.'\','.
                '"archnombres"=\''.$archnombres.'\','.
                '"archmimetys"=\''.$archmimetys.'\','.
                '"archtamanon"='.$archtamanon.','.
                '"archcontens"='.CLOB.','.
                '"archfechan"='.$archfechan.' '.
            'WHERE "archcodigon"='.$archcodigon;
		$this->objdb->fncadoexecute($sql);
		
		///ingreso de BLOB
	    $this->objdb->fncadoUpdateClob('"archivos"', '"archcodigon"', '"archcontens"', $archcontens, $archcodigon);
	    
		if(!$this->objdb->objresult)
			return false;
		else	
			return true;
	}
  

	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo para eliminar datos a la tabla: archivos
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function deleteArchivos($archcodigon){
		$sql='DELETE FROM "archivos" WHERE "archcodigon"='.$archcodigon;
	    $this->objdb->fncadoexecute($sql);
	    if(!$this->objdb->objresult)
	    	return false;
	    else
	    	return true;
	}

	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo para consultar por campo(s) clave(s) y obtener todas las columnas de la tabla: archivos
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function getByIdArchivos($archcodigon){
	 $sql='SELECT * FROM "archivos" WHERE "archcodigon"='.$archcodigon;
         $this->objdb->fncadoselect($sql,FETCH_ASSOC);
         $rcResult = $this->objdb->rcresult;
         if(is_array($rcResult) && $rcResult){
             if(!$rcResult [0]["archcontens"]) {
                 $sbPath = "/var/www/html/cross/apps/091101801_docs/".$archcodigon;
                 if(file_exists($sbPath)){
                     $sbPoint = fopen($sbPath, "r");
                     $rcResult[0]["archcontens"] = fgets($sbPoint);
                     fclose($sbPoint);
                     if($rcResult[0]["archcontens"]===false){
                         $rcResult = null;
                     }
                 }
             }
         }
         return $rcResult;
	}
	
	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo para consultar por las referencias
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function getByRefArchivos($archidrefes,$archreferes){
		$sql='SELECT * FROM "archivos" WHERE '.
            '"archidrefes"=\''.$archidrefes.'\' AND '.
            '"archreferes"=\''.$archreferes.'\'';
	    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
	    return $this->objdb->rcresult;
	}
	

	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo para consultar todos los registros y obtener todas las columnas de la tabla: archivos
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function getAllArchivos(){
		$sql='SELECT * FROM "archivos"';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
  

	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo para consultar por el(los) campo(s) llave(s) y obtener la columna Archcodigon de la tabla: archivos
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function getDescArchivo($archidrefes,$archreferes){
		$sql='SELECT '.
                '"archcodigon",'.
                '"archidrefes",'.
                '"archreferes",'.
                '"archnombres",'.
                '"archmimetys",'.
                '"archtamanon",'.
                '"archfechan", '.
				'"archextensis" '.
            'FROM "archivos" '.
            'WHERE '.
            '"archidrefes"=\''.$archidrefes.'\' AND '.
            '"archreferes"=\''.$archreferes.'\'';
	    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
	    return $this->objdb->rcresult;
	}
	
	/**
	* @Copyright 2007 Parquesoft
	*
	* Metodo para adicionar datos a la tabla: archivos
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function addSqlArchivos($archcodigon,$archidrefes,$archreferes,$archnombres,$archmimetys,$archtamanon,$archcontens,$archextensis){
		
		settype($rcSql,"array");
		settype($nuArchfechan,"integer");
		   
        $nuArchfechan = $this->objdate->fncintdatehour();
        $rcSql[] = 'INSERT INTO "archivos" VALUES('.$archcodigon.',\''.$archidrefes.'\',\''.$archreferes
        .'\',\''.$archnombres.'\',\''.$archmimetys.'\','.$archtamanon.','.CLOB.','.$nuArchfechan.',\''.$archextensis.'\')';
	    
	    ///ingreso de BLOB
	    $this->objdb->fncadoUpdateClob('"archivos"', '"archcodigon"', '"archcontens"', $archcontens, $archcodigon, false);
	    
	    $rcSql[] = $this->objdb->sbresult;
	    return $rcSql;
	}
	
	/**
	* @Copyright 2007 Parquesoft
	*
	* Metodo para adicionar datos a la tabla: archivos
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function deleteSqlArchivos($sbArchidrefes,$sbArchreferes,$rcArchcodigon){
		
		settype($sbSql,"string");
		settype($sbTmp,"string");
		settype($sbWhere,"string");
		
		$sbWhere =' "archidrefes"=\''.$sbArchidrefes.'\' AND "archreferes"=\''.$sbArchreferes."'";
		   
        if($rcArchcodigon){
        	$sbTmp = "'".implode("','",$rcArchcodigon)."'";
        	$sbWhere .=' AND "archcodigon" NOT IN ('.$sbTmp.')';
        }
        
        $sbSql= 'DELETE FROM "archivos" WHERE '.$sbWhere;
	    return $sbSql;
	}    
} //End of Class Archivos
?>
