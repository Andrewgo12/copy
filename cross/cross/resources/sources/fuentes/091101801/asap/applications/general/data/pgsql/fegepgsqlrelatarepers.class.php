<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeGePgsqlRelatarepers {
	
	function FeGePgsqlRelatarepers() {
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
		return $this->_rcSql;
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
	
	/**
	 * @Copyright 2009 Parquesoft
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
	 * @Copyright 2009 Parquesoft
	 *
	 * Ingreso de la tarea relacionada
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function addRelatarepers(){
		
		settype($sbSql,"string");
		extract($this->rcData);
		
		$sbSql = 'INSERT INTO "relatarepers" ("retpcodigos","proccodigos","tarecodigos","retpfeccren","retpactivos")'
		.' VALUES(\''.$retpcodigos.'\',\''.$proccodigos.'\',\''.$tarecodigos.'\','.$retpfeccren.',\''.$retpactivos.'\')';
		
		if(!$this->executeSql){
			$this->_rcSql[] = $sbSql;
			return;
		}
		$this->objdb->fncadoexecute($sbSql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	
	/**
	 * @Copyright 2009 Parquesoft
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
	 * @Copyright 2009 Parquesoft
	 *
	 * Obtiene el registro de relacion activo para el par proceso tarea
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getExistRow(){
		
		settype($rcResult,"array");
		settype($sbSql,"string");
		
		extract($this->rcData);
		
		$sbSql = 'SELECT * FROM "relatarepers" WHERE "relatarepers"."proccodigos"=\''.$proccodigos
		.'\' AND "relatarepers"."tarecodigos"=\''.$tarecodigos 
		.'\' AND "relatarepers"."retpactivos"=\''.$retpactivos.'\'';
		
		if(!$this->executeSql){
			$this->_rcSql[] = $sbSql;
			return;
		}
		
		$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		$rcResult = $this->objdb->rcresult;
		
        $this->rcResult = $rcResult;
	}
	
	/**
	 * @Copyright 2009 Parquesoft
	 *
	 * Cambia el estado de un registro
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function updateState(){
		settype($sbSql,"string");
		extract($this->rcData);
		
		$sbSql = 'UPDATE "relatarepers" SET "retpactivos"=\''.$retpactivos.'\' WHERE "retpcodigos"=\''.$retpcodigos.'\'';
		
		if(!$this->executeSql){
			$this->_rcSql[] = $sbSql;
			return;
		}
		$this->objdb->fncadoexecute($sbSql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
} //End of Class relatarepers
?>