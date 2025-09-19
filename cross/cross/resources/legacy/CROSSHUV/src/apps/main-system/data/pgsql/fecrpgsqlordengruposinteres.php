<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeCrPgsqlOrdengruposinteres {
	
	function FeCrPgsqlOrdengruposinteres() {
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
	function existOrdengruposinteres($ordenumeros) {
		
		settype($sbSql,"string");
		$sbSql = 'SELECT * FROM "ordengruposinteres" WHERE "ordenumeros"=\''.$ordenumeros.'\' ';
		$this->objdb->fncadoexecute($sbSql);
		return $this->objdb->fncadorowcont();
	}
	function addOrdengruposinteres() {
		settype($sbSql,"string");
		extract($this->rcData);
		$sbSql = 'INSERT INTO "ordengruposinteres" ("ordenumeros","grincodigos")'.' VALUES(\''.$ordenumeros.'\',\''.$grincodigos.'\')';
		if(!$this->executeSql){
			$this->sbSql = $sbSql;
			return;
		}
		$this->objdb->fncadoexecute($sbSql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	
	function getOrdengruposinteresByOrdenumeros(){
		
		settype($sbSql,"string");
		extract($this->rcData);
		$sbSql = 'SELECT * FROM "ordengruposinteres" WHERE "ordenumeros"=\''.$ordenumeros.'\'';
		$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
        $this->rcResult = $this->objdb->rcresult;
	}
	
	function getUpdateOrdengruposinteres(){
		
		settype($sbSql,"string");
		extract($this->rcData);
		
		$sbSql = 'UPDATE "ordengruposinteres" SET "grincodigos"='.$grincodigos.'\' WHERE "ordenumeros"=\''.$ordenumeros.'\'';
		
		if(!$this->executeSql){
			$this->sbSql = $sbSql;
			return;
		}
		$this->objdb->fncadoexecute($sbSql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	
} //End of Class Llave
?>