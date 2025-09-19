<?php
//Paquete de conexion a bases de datos
include_once("pkdatabases.php");
/**
* @Copyright 2005 Parquesoft
*
* Clase que contiene las compuertas basica de la tabla: transfertarea
* @author Ingravity 0.0.9
* @location Cali - Colombia
*/

class FeCrPgsqlTransfertarea{
	
	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo constructor de la clase tabla: transfertarea
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function FeCrPgsqlTransfertarea(){
	    $config = &ASAP::getStaticProperty('Application','config');
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
	* @Copyright 2005 Parquesoft
	*
	* Metodo para validar si un dato existe en la tabla: transfertarea
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function existTransfertarea($trtacodigos){
		$sql = 'SELECT * FROM "transfertarea" WHERE "trtacodigos"=\''.$trtacodigos.'\'';
	    $this->objdb->fncadoexecute($sql);
	    return $this->objdb->fncadorowcont();
	}
  
	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo para adicionar datos a la tabla: transfertarea
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function addTransfertarea($trtacodigos,$tarecodigos,$orgacodigos,$trtafechan,$trtafecingn,$trtaobservas){

		settype($sbSql, "string");
		
		$sbSql='INSERT INTO "transfertarea" ("trtacodigos","tarecodigos","orgacodigos","trtafechan","trtafecingn","trtaobservas")'
		.' VALUES(\''.$trtacodigos.'\',\''.$tarecodigos.'\',\''.$orgacodigos.'\','.$trtafechan.','.$trtafecingn.',\''.$trtaobservas.'\')';
		
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
	* Metodo para actualizar los datos a la tabla: transfertarea
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function updateTransfertarea($trtacodigos,$tarecodigos,$orgacodigos,$trtafechan,$trtaobservas){
		$sql='UPDATE "transfertarea" SET "tarecodigos"=\''.$tarecodigos.'\',"orgacodigos"=\''.$orgacodigos.'\',"trtafechan"='.$trtafechan.',"trtaobservas"=\''.$trtaobservas.'\' WHERE "trtacodigos"=\''.$trtacodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if(!$this->objdb->objresult)
			return false;
		else	
			return true;
	}
  

	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo para eliminar datos a la tabla: transfertarea
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function deleteTransfertarea($trtacodigos){
		$sql='DELETE FROM "transfertarea" WHERE "trtacodigos"=\''.$trtacodigos.'\'';
	    $this->objdb->fncadoexecute($sql);
	    if(!$this->objdb->objresult)
	    	return false;
	    else
	    	return true;
	}

	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo para consultar por campo(s) clave(s) y obtener todas las columnas de la tabla: transfertarea
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function getByIdTransfertarea($trtacodigos){
		$sql='SELECT * FROM "transfertarea" WHERE "trtacodigos"=\''.$trtacodigos.'\'';
	    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
	    return $this->objdb->rcresult;
	}

	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo para consultar todos los registros y obtener todas las columnas de la tabla: transfertarea
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function getAllTransfertarea(){
		$sql='SELECT * FROM "transfertarea"';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
  
	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo para consultar por el(los) campo(s) llave(s) y obtener la columna Trtacodigos de la tabla: transfertarea
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function getTrtacodigos($trtacodigos){
		$sql='SELECT "trtacodigos" FROM "transfertarea" WHERE "trtacodigos"=\''.$trtacodigos.'\'';
	    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
	    return $this->objdb->rcresult;
	}  

	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo para consultar por el(los) campo(s) llave(s) y obtener la columna Tarecodigos de la tabla: transfertarea
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function getTarecodigos($tarecodigos){
		$sql='SELECT "tarecodigos" FROM "transfertarea" WHERE "tarecodigos"=\''.$tarecodigos.'\'';
	    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
	    return $this->objdb->rcresult;
	}  

	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo para consultar por el(los) campo(s) llave(s) y obtener la columna Orgacodigos de la tabla: transfertarea
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function getOrgacodigos($orgacodigos){
		$sql='SELECT "orgacodigos" FROM "transfertarea" WHERE "orgacodigos"=\''.$orgacodigos.'\'';
	    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
	    return $this->objdb->rcresult;
	}  

	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo para consultar por el(los) campo(s) llave(s) y obtener la columna Trtafechan de la tabla: transfertarea
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function getTrtafechan($trtafechan){
		$sql='SELECT "trtafechan" FROM "transfertarea" WHERE "trtafechan"=\''.$trtafechan.'\'';
	    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
	    return $this->objdb->rcresult;
	}  

	/**
	* @Copyright 2011 Parquesoft
	*
	* Metodo para consultar las transferencias por medio del acta
	* @author freina<freina@fullengine.com>
	* @location Cali - Colombia
	*/
	function getByIdTarecodigos($sbTarecodigos){
		settype($sbSql, "string");
		$sbSql='SELECT * FROM "transfertarea" WHERE "tarecodigos"=\''.$sbTarecodigos.'\' ORDER BY "trtafechan"';
	    $this->objdb->fncadoselect($sbSql,FETCH_ASSOC);
	    return $this->objdb->rcresult;
	}
} //End of Class Transfertarea
?>