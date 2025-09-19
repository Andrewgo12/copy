<?php
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FePoPgsqlTipoproducto {

	function FePoPgsqlTipoproducto() {

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

	function existTipoproducto() {

		settype($sbSql,"string");
		extract($this->rcData);

		$sbSql = 'SELECT * FROM tipoproducto WHERE "tiprcodigos"=\''.$tiprcodigos.'\'';
		$this->objdb->fncadoexecute($sbSql);

		if (!$this->objdb->fncadorowcont()){
			$this->consult = false;
		}else{
			$this->consult = true;
		}

	}
	function addTipoproducto() {

		settype($sbSql,"string");
		extract($this->rcData);

		$sbSql = 'INSERT INTO "tipoproducto" VALUES(\''.$tiprcodigos.'\', \''.$tiprnombres.'\', \''.$tiprdescrips.'\', \''.$tipractivas.'\')';

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

	function setTipoproducto() {

		settype($rcTmp,"array");
		settype($sbSql,"string");
		settype($sbTmp,"string");

		extract($this->rcData);

		if($tiprnombres){
			$rcTmp[] = ' "tiprnombres"=\''.$tiprnombres.'\' ';
		}

		if($tiprdescrips){
			$rcTmp[] = ' "tiprdescrips"=\''.$tiprdescrips.'\' ';
		}

		if($tipractivas){
			$rcTmp[] = ' "tipractivas"=\''.$tipractivas.'\' ';
		}

		if(is_array($rcTmp) && $rcTmp){
			$sbTmp = implode(" , ",$rcTmp);
		}

		$sbSql = 'UPDATE "tipoproducto" SET  ';
		$sbSql .= $sbTmp;
		$sbSql .= '  WHERE "tiprcodigos"=\''.$tiprcodigos.'\' ';

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
	function deleteTipoproducto() {

		settype($sbSql,"string");

		extract($this->rcData);

		$sbSql = 'DELETE FROM "tipoproducto" WHERE "tiprcodigos"=\''.$tiprcodigos.'\'';
		
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
	function getTipoproducto(){

		settype($rcResult,"array");
		settype($rcTmp,"array");
		settype($sbSql,"string");
		settype($sbTmp,"string");

		extract($this->rcData);


		if($tiprcodigos){
			$rcTmp[] = ' "tiprcodigos"=\''.$tiprcodigos.'\' ';
		}
		
		if($tipractivas){
			$rcTmp[] = ' "tipractivas"=\''.$tipractivas.'\' ';
		}

		$sbSql = 'SELECT * FROM "tipoproducto" ';

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
} //End of Class Tipoproducto
?>