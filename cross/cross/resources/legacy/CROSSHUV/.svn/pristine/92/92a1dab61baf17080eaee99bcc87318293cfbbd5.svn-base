<?php
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeCrPgsqlColpatria {

	function FeCrPgsqlColpatria() {
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

	/**
	 * @Copyright 2010 Parquesoft
	 *
	 * Obtiene los registros de los casos
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getDataCasos(){

		settype($rcResult,"array");
		settype($rcTmp,"array");
		settype($sbSql,"string");
		settype($sbTmp,"string");

		extract($this->rcData);

		if($ordefecregd1 && $ordefecregd2){
			$rcTmp[] = ' "orden"."ordefecregd" BETWEEN '.$ordefecregd1.' AND '.$ordefecregd2.' ';
		}

		if($usuacodigos){
			$rcTmp[] = ' "orden"."usuacodigos"=\''.$usuacodigos.'\' ';
		}
		
		$rcTmp[] = ' "orden"."ordenumeros" = "ordenempresa"."ordenumeros" ';

		if($locacodigos){
			$rcTmp[] = ' "ordenempresa"."locacodigos"=\''.$locacodigos.'\' ';
		}


		$sbSql = 'SELECT "orden"."proccodigos","orden"."ordenumeros","ordenempresa"."tiorcodigos",
		         "ordenempresa"."evencodigos","ordenempresa"."causcodigos" FROM "orden","ordenempresa" ';

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
	 * @Copyright 2010 Parquesoft
	 *
	 * Obtiene los registros de las dimensiones de los casos
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getDataList(){

		settype($rcResult,"array");
		settype($rcTmp,"array");
		settype($sbSql,"string");
		settype($sbTmp,"string");

		extract($this->rcData);

		if($vahorro){
			$rcTmp[] = ' "'.$table.'"."vahorro"=\''.$vahorro.'\' ';
		}
		
		$rcTmp[] = ' "'.$table.'"."ordenumeros" = "orden"."ordenumeros" ';
		$rcTmp[] = ' "orden"."ordenumeros" = "ordenempresa"."ordenumeros" ';


		$sbSql = 'SELECT "contacto"."contindentis",(COALESCE("contacto"."contprinoms", \'\') || \' \' || COALESCE("contacto"."contsegnoms", \'\') || \' \' || COALESCE("contacto"."contpriapes", \'\') || \' \' || COALESCE("contacto"."contsegapes", \'\'))  AS "contnombre","orden"."usuacodigos","orden"."ordefecregd",
		         "ordenempresa"."locacodigos","localizacion"."locanombres","'.$table.'".* 
		         FROM "'.$table.'","orden",
		         "ordenempresa" LEFT JOIN "contacto" ON(CAST("ordenempresa"."contidentis" AS INTEGER)="contacto"."contcodigon") 
		         				LEFT JOIN "localizacion" ON("ordenempresa"."locacodigos"="localizacion"."locacodigos") ';

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
} //End of Class integralog
?>