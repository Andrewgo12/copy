<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeGePgsqlDetaretape {
	
	function FeGePgsqlDetaretape() {
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
	 * Ingreso del detalle del personal
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function addDetaretape(){
		
		settype($sbSql,"string");
		extract($this->rcData);
		
		$sbSql = 'INSERT INTO "detaretape" ("retpcodigos","drtpcodigos","orgacodigos")'
		.' VALUES(\''.$retpcodigos.'\',\''.$drtpcodigos.'\',\''.$orgacodigos.'\')';
		
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
	 * Obtiene el detalle de la configuracion del formulario.
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
  	function getByRetpcodigos(){
  		
  		settype($rcResult,"array");
		settype($sbSql,"string");
		
		extract($this->rcData);
		
		$sbSql = 'SELECT * FROM "detaretape" WHERE "detaretape"."retpcodigos"=\''.$retpcodigos.'\'';
		
  		if(!$this->executeSql){
			$this->_rcSql[] = $sbSql;
			return;
		}
		$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		$rcResult = $this->objdb->rcresult;
		
        $this->rcResult = $rcResult;
  }
} //End of Class detaretape
?>