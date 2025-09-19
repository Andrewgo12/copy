<?php
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeCrPgsqlAlertaCasos {

	function FeCrPgsqlAlertaCasos() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
		$this->executeSql = true;
	}
	/**
	 * @Copyright 2017 Fullengine
	 *
	 * Modifica el arreglo de datos
	 * @author freina<freina@fullengine.com>
	 *
	 * @location Cali - Colombia
	 */
	function setData($rcData){
		$this->rcData = $rcData;
	}
	/**
	 * @Copyright 2017 Fullengine
	 *
	 * Obtiene el resultado de la consulta
	 * @author freina<freina@fullengine.com>
	 *
	 * @location Cali - Colombia
	 */
	function getConsult(){
		return $this->consult;
	}
	/**
	 * @Copyright 2017 Fullengine
	 *
	 * determina si se ejecuta el sql
	 * @author freina<freina@fullengine.com>
	 *
	 * @location Cali - Colombia
	 */
	function setExecuteSql($blState) {
		$this->executeSql = $blState;
	}
	/**
	 * @Copyright 2017 Fullengine
	 *
	 * obtiene el sql
	 * @author freina<freina@fullengine.com>
	 *
	 * @location Cali - Colombia
	 */
	function getSql(){
		return $this->_rcSql;
	}
	/**
	 * @Copyright 2017 Fullengine
	 *
	 * Obtiene el resultado de la consulta (data)
	 * @author freina<freina@fullengine.com>
	 *
	 * @location Cali - Colombia
	 */
	function getResult(){
		return $this->rcResult;
	}

	/**
	 * @Copyright 2017 Fullengine
	 *
	 * Conjunto de sql a ejecutar
	 * @author freina<freina@fullengine.com>
	 *
	 * @location Cali - Colombia
	 */
	function setSql($rcSql){
		$this->_rcSql = $rcSql;
	}

	/**
	 * @Copyright 2017 Fullengine
	 *
	 * ejecuta las transaccion
	 * @author freina<freina@fullengine.com>
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
	 * @Copyright 2017 Fullengine
	 *
	 * Obtiene los registros de los casos
	 * @author freina<freina@fullengine.com>
	 *
	 * @location Cali - Colombia
	 */
	function getCasos(){

		settype($rcResult,"array");
		settype($rcTmp,"array");
		settype($sbSql,"string");
		settype($sbTmp,"string");

		extract($this->rcData);

		if(!empty($ordefecingdini) && !empty($ordefecingdfin)){
			$rcTmp[] = ' "ordefecregd" BETWEEN '.$ordefecingdini.' AND '.$ordefecingdfin.' ';
		}

		if(!empty($ordefecdiginin) && !empty($ordefecdigfinn)){
			$rcTmp[] = ' "ordefecingd" BETWEEN '.$ordefecdiginin.' AND '.$ordefecdigfinn.' ';
		}

		if(!empty($ordefecfinad)){
			$rcTmp[] = ' "ordefecfinad" IS NULL ';
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
	 * @Copyright 2017 Fullengine
	 *
	 * Obtiene el acta de un caso (para CVC es una)
	 * @author freina<freina@fullengine.com>
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

		if($sbStatusI){
			$rcTmp[] = ' "actaactivas" NOT IN (\''.$sbStatusI.'\') ';
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
		$sbSql .= ' ORDER BY actafechingn DESC';

		if(!$this->executeSql){
			$this->_rcSql[] = $sbSql;
			return;
		}
		$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		$rcResult = $this->objdb->rcresult;

		$this->rcResult = $rcResult;

	}
} //End of Class alerta casos
?>