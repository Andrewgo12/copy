<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeEnPgsqlDetarespusua {
	
	function FeEnPgsqlDetarespusua() {
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
	 * Ingreso del detalle de la respuesta
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function addDetarespusua(){
		
		settype($sbSql,"string");
		extract($this->rcData);
		
		$sbSql = 'INSERT INTO "detarespusua" ("reuscodigon","derucodigon","pregcodigon",
										"oprecodigon","deruvalorabis")'
		.' VALUES('.$reuscodigon.','.$derucodigon.','.$pregcodigon.','.$oprecodigon.',\''.
		$deruvalorabis.'\')';
		
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
	 * @Copyright 2014 Parquesoft
	 *
	 * Obtiene el detalle de respuesta de un usuario
	 * @author freina<freina@fullengine.com>
	 *
	 * @location Cali - Colombia
	 */
	function getDetarespusua(){

		settype($rcResult,"array");
		settype($rcTmp,"array");
		settype($sbSql,"string");
		settype($sbTmp,"string");
		settype($sbOrder,"string");

		extract($this->rcData);

		if($reuscodigon){
			$rcTmp[] = ' "reuscodigon"='.$reuscodigon.' ';
		}

		if($derucodigon){
			$rcTmp[] = ' "derucodigon"='.$derucodigon.' ';
		}

		if($pregcodigon){
			$rcTmp[] = ' "pregcodigon"='.$pregcodigon.' ';
		}

		if($oprecodigon){
			$rcTmp[] = ' "oprecodigon"='.$oprecodigon.' ';
		}

		if($deruvalorabis){
			$rcTmp[] = ' "deruvalorabis"=\''.$deruvalorabis.'\' ';
		}


		$sbSql = 'SELECT * FROM "detarespusua" ';

		if(is_array($rcTmp) && $rcTmp){
			$sbTmp = implode(" AND ",$rcTmp);
			$sbSql .= ' WHERE ';
			$sbSql .= $sbTmp;
		}
		
		if($order_by){
			$rcTmp = explode(",",$order_by);
			$sbOrder = ' ORDER BY ';
			$sbTmp = implode ('","',$rcTmp);
			$sbSql .= $sbOrder.'"'.$sbTmp.'"';
		}

		if(!$this->executeSql){
			$this->_rcSql[] = $sbSql;
			return;
		}
		$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		$rcResult = $this->objdb->rcresult;

		$this->rcResult = $rcResult;

	}
	
} //End of Class detarespusua
?>