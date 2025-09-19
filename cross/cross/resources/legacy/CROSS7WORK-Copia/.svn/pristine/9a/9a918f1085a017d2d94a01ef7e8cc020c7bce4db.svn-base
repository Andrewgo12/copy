<?php
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FePoPgsqlProducto {

	function FePoPgsqlProducto() {

		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
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

	function existProducto() {

		settype($sbSql,"string");
		extract($this->rcData);

		$sbSql = 'SELECT * FROM producto WHERE "prodcodigos"=\''.$prodcodigos.'\'';
		$this->objdb->fncadoexecute($sbSql);

		if (!$this->objdb->fncadorowcont()){
			$this->consult = false;
		}else{
			$this->consult = true;
		}

	}
	function addProducto() {

		settype($sbSql,"string");
		extract($this->rcData);

		$sbSql = 'INSERT INTO "producto" VALUES(\''.$prodcodigos.'\', \''.$prodnombres.'\', \''.$marccodigos.'\', \''.$modecodigos.'\', \''.$tiprcodigos.'\',
		\''.$prodversions.'\', \''.$proddescrips.'\', '.$prodcoston.', '.$prodvalorn.', '.$prodfechinin.', '.$prodfechfinn.')';

		if(!$this->executeSql){
			$this->_rcSql[] = $sbSql;
			return;
		}
		$this->objdb->fncadoexecute($sbSql);
		if (!$this->objdb->objresult){
			$this->consult = false;
		}else{
			$this->consult = true;
		}

	}

	/**
	 * @Copyright 2010 Parquesoft
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

	function setProducto() {

		settype($rcTmp,"array");
		settype($sbSql,"string");
		settype($sbTmp,"string");

		extract($this->rcData);

		if($prodnombres){
			$rcTmp[] = ' "prodnombres"=\''.$prodnombres.'\' ';
		}

		if($marccodigos){
			$rcTmp[] = ' "marccodigos"=\''.$marccodigos.'\' ';
		}

		if($modecodigos){
			$rcTmp[] = ' "modecodigos"=\''.$modecodigos.'\' ';
		}

		if($tiprcodigos){
			$rcTmp[] = ' "tiprcodigos"=\''.$tiprcodigos.'\' ';
		}

		if($prodversions){
			$rcTmp[] = ' "prodversions"=\''.$prodversions.'\' ';
		}

		if($proddescrips){
			$rcTmp[] = ' "proddescrips"=\''.$proddescrips.'\' ';
		}

		if($prodcoston){
			$rcTmp[] = ' "prodcoston"='.$prodcoston.' ';
		}

		if($prodvalorn){
			$rcTmp[] = ' "prodvalorn"='.$prodvalorn.' ';
		}

		if($prodfechinin){
			$rcTmp[] = ' "prodfechinin"='.$prodfechinin.' ';
		}

		if($prodfechfinn){
			$rcTmp[] = ' "prodfechfinn"='.$prodfechfinn.' ';
		}

		if($prodactivas){
			$rcTmp[] = ' "prodactivas"=\''.$prodactivas.'\' ';
		}

		if(is_array($rcTmp) && $rcTmp){
			$sbTmp = implode(" , ",$rcTmp);
		}

		$sbSql = 'UPDATE "producto" SET  ';
		$sbSql .= $sbTmp;
		$sbSql .= '  WHERE "prodcodigos"=\''.$prodcodigos.'\' ';

		if(!$this->executeSql){
			$this->_rcSql[] = $sbSql;
			return;
		}
		$this->objdb->fncadoexecute($sbSql);
		if (!$this->objdb->objresult){
			$this->consult = false;
		}else{
			$this->consult = true;
		}

	}
	function deleteProducto() {

		settype($sbSql,"string");

		extract($this->rcData);

		$sbSql = 'DELETE FROM "producto" WHERE "prodcodigos"=\''.$prodcodigos.'\'';
		
		if(!$this->executeSql){
			$this->_rcSql[] = $sbSql;
			return;
		}
		
		$this->objdb->fncadoexecute($sbSql);
		if (!$this->objdb->objresult){
			$this->consult = false;
		}else{
			$this->consult = true;
		}

	}
	
	/**
	 * @Copyright 2010 Parquesoft
	 *
	 * Obtiene los registros de los productos
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getProducto(){

		settype($rcResult,"array");
		settype($rcTmp,"array");
		settype($sbSql,"string");
		settype($sbTmp,"string");

		extract($this->rcData);


		if($prodcodigos){
			$rcTmp[] = ' "prodcodigos"=\''.$prodcodigos.'\' ';
		}
		
		if($tiprcodigos){
			$rcTmp[] = ' "tiprcodigos"=\''.$tiprcodigos.'\' ';
		}
		
		if($prodactivas){
			$rcTmp[] = ' "prodactivas"=\''.$prodactivas.'\' ';
		}

		$sbSql = 'SELECT * FROM "producto" ';

		if(is_array($rcTmp) && $rcTmp){
			$sbTmp = implode(" AND ",$rcTmp);
			$sbSql .= ' WHERE ';
			$sbSql .= $sbTmp;
		}

		if(!$this->executeSql){
			$this->_rcSql[] = $sbSql;
			return;
		}
		$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		$rcResult = $this->objdb->rcresult;

		$this->rcResult = $rcResult;

	}
} //End of Class Producto
?>