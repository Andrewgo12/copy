<?php
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeCrPgsqlIndicador {

	function FeCrPgsqlIndicador() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
		$this->executeSql = true;
	}
	/**
	 * @Copyright 2011 Parquesoft
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
	 * @Copyright 2011 Parquesoft
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
	 * @Copyright 2011 Parquesoft
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
	 * @Copyright 2011 Parquesoft
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
	 * @Copyright 2011 Parquesoft
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
	 * @Copyright 2011 Parquesoft
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
	 * @Copyright 2011 Parquesoft
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
	 * @Copyright 2011 Parquesoft
	 *
	 * Obtiene los registros de los casos
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getCasos(){

		settype($rcResult,"array");
		settype($rcTmp,"array");
		settype($sbSql,"string");
		settype($sbTmp,"string");

		extract($this->rcData);

		if($ordefecingdini && $ordefecingdfin){
			$rcTmp[] = ' "ordefecregd" BETWEEN '.$ordefecingdini.' AND '.$ordefecingdfin.' ';
		}

		if($ordefecdiginin && $ordefecdigfinn){
			$rcTmp[] = ' "ordefecingd" BETWEEN '.$ordefecdiginin.' AND '.$ordefecdigfinn.' ';
		}

		if($ordefecfinad){
			$rcTmp[] = ' "ordefecfinad" IS NOT NULL ';
		}

		$sbSql = 'SELECT * FROM "orden" ';

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

	/**
	 * @Copyright 2011 Parquesoft
	 *
	 * Obtiene el acta de un caso (para CVC es una)
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getActa(){

		settype($objService,"object");
		settype($rcResult,"array");
		settype($rcTmp,"array");
		settype($sbSql,"string");
		settype($sbTmp,"string");
		settype($sbStatusA,"string");
		settype($sbStatusI,"string");
		settype($sbTarecodigos,"string");

		extract($this->rcData);

		$sbStatusA = Application :: getConstant("REG_ACT");
		$sbStatusI = Application :: getConstant("REG_INACT");
		$objService = Application::loadServices('General');
		$sbTarecodigos = $objService->getParam("cross300","TAREA_SEGUIMIENTO");

		if($ordenumeros){
			$rcTmp[] = ' "ordenumeros" = \''.$ordenumeros.'\' ';
		}

		if($sbStatusA && $sbStatusI){
			$rcTmp[] = ' "actaactivas" NOT IN (\''.$sbStatusA.'\', \''.$sbStatusI.'\') ';
		}

		if($sbTarecodigos){
			$rcTmp[] = ' "tarecodigos" <> \''.$sbTarecodigos.'\' ';
		}

		$sbSql = 'SELECT * FROM "acta" ';

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
	/**
	 * @Copyright 2011 Parquesoft
	 *
	 * Obtiene las posibles transferencias realizadas sobre un acta
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getTransfertarea(){
		
		settype($rcResult,"array");
		settype($rcTmp,"array");
		settype($sbSql,"string");
		settype($sbTmp,"string");

		extract($this->rcData);

		if($actacodigos){
			$rcTmp[] = ' "tarecodigos" = \''.$actacodigos.'\' ';
		}

		$sbSql = 'SELECT * FROM "transfertarea" ';

		if(is_array($rcTmp) && $rcTmp){
			$sbTmp = implode(" AND ",$rcTmp);
			$sbSql .= ' WHERE ';
			$sbSql .= $sbTmp;
			$sbSql .= ' ORDER BY "trtafechan" ';
		}

		if(!$this->executeSql){
			$this->_rcSql[] = $sbSql;
			return;
		}
		$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		$rcResult = $this->objdb->rcresult;

		$this->rcResult = $rcResult;
	}
} //End of Class indicador
?>