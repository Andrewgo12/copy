<?php
//Paquete de conexion a bases de datos
include_once("pkdatabases.php");
class FeHrPgsqlGrupo{
	
	function FeHrPgsqlGrupo(){
		
		$config = &ASAP::getStaticProperty('Application','config');
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
	function existGrupo($grupcodigon){
		
		$sql = 'SELECT * FROM "grupo" WHERE "grupcodigon"='.$grupcodigon.' ';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}

	function addGrupo($grupcodigon,$grupcodigos,$grupnombres,$esgrcodigos,$grupfchainin,$grupfchafinn){
		
		settype($sbSql,"string");
		
		$sbSql='INSERT INTO "grupo" ("grupcodigon","grupcodigos","grupnombres","esgrcodigos","grupfchainin","grupfchafinn")'
		.' VALUES('.$grupcodigon.' ,\''.$grupcodigos.'\',\''.$grupnombres.'\',\''.$esgrcodigos.'\','.$grupfchainin.' ,'.$grupfchafinn.')';
		
		//retorna el sql
		if(!$this->executeSql){
			$this->_rcSql[] = $sbSql;
			return;
		}
		
		$this->objdb->fncadoexecute($sbSql);
		if(!$this->objdb->objresult)
		$this->consult = false;
		else
		$this->consult = true;
	}

	function updateGrupo($grupcodigon,$grupcodigos,$grupnombres,$esgrcodigos,$grupfchafinn,$grupactivos){
		
		$sql='UPDATE "grupo" SET "grupcodigos"=\''.$grupcodigos.'\',"grupnombres"=\''.$grupnombres.'\',"esgrcodigos"=\''.$esgrcodigos.'\',"grupfchafinn"='.$grupfchafinn.' ,"grupactivos"=\''.$grupactivos.'\' WHERE "grupcodigon"='.$grupcodigon.' ';
		$this->objdb->fncadoexecute($sql);
		if(!$this->objdb->objresult)
		$this->consult = false;
		else
		$this->consult = true;
	}

	function deleteGrupo($grupcodigon){
		
		$sql='DELETE FROM "grupo" WHERE "grupcodigon"='.$grupcodigon.' ';
		$this->objdb->fncadoexecute($sql);
		if(!$this->objdb->objresult)
		$this->consult = false;
		else
		$this->consult = true;
	}

	function getByIdGrupo($grupcodigon){
		
		$sql='SELECT * FROM "grupo" WHERE "grupcodigon"='.$grupcodigon.' ';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getAllGrupo(){
		
		$sql='SELECT * FROM "grupo"';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getByGrupo_fkey($esgrcodigos){
		
		$sql='SELECT * FROM "grupo" WHERE "esgrcodigos"=\''.$esgrcodigos.'\'';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getGrupcodigon($grupcodigon){
		
		$sql='SELECT "grupcodigon" FROM "grupo" WHERE "grupcodigon"='.$grupcodigon.' ';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getGrupcodigos($grupcodigon){
		
		$sql='SELECT "grupcodigos" FROM "grupo" WHERE "grupcodigon"='.$grupcodigon.' ';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getGrupnombres($grupcodigon){
		
		$sql='SELECT "grupnombres" FROM "grupo" WHERE "grupcodigon"='.$grupcodigon.' ';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getEsgrcodigos($grupcodigon){
		
		$sql='SELECT "esgrcodigos" FROM "grupo" WHERE "grupcodigon"='.$grupcodigon.' ';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getGrupfchainin($grupcodigon){
		
		$sql='SELECT "grupfchainin" FROM "grupo" WHERE "grupcodigon"='.$grupcodigon.' ';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getGrupfchafinn($grupcodigon){
		
		$sql='SELECT "grupfchafinn" FROM "grupo" WHERE "grupcodigon"='.$grupcodigon.' ';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getGrupactivos($grupcodigon){
		
		$sql='SELECT "grupactivos" FROM "grupo" WHERE "grupcodigon"='.$grupcodigon.' ';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Grupo
?>