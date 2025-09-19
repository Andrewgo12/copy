<?php
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeWFPgsqlTarea {
	
	function FeWFPgsqlTarea() {
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
	
	function existTarea($tarecodigos) {
		$sql = 'SELECT * FROM "tarea" WHERE "tarecodigos"=\''.$tarecodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}
	function addTarea($tarecodigos, $tarenombres, $orgacodigos, $taredescris, $tareactivas) {
		$sql = 'INSERT INTO "tarea" ("tarecodigos","tarenombres","orgacodigos","taredescris","tareactivas")'
		.' VALUES(\''.$tarecodigos.'\',\''.$tarenombres.'\',\''.$orgacodigos.'\',\''.$taredescris.'\',\''.$tareactivas.'\')';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function updateTarea($tarecodigos, $tarenombres, $orgacodigos, $taredescris, $tareactivas) {
		$sql = 'UPDATE "tarea" SET "tarenombres"=\''.$tarenombres.'\',"orgacodigos"=\''.$orgacodigos.'\',"taredescris"=\''.$taredescris.'\',"tareactivas"=\''.$tareactivas.'\' WHERE "tarecodigos"=\''.$tarecodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function deleteTarea($tarecodigos) {
		$sql = 'DELETE FROM "tarea" WHERE "tarecodigos"=\''.$tarecodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function getByIdTarea($tarecodigos) {
		$sql = 'SELECT * FROM "tarea" WHERE "tarecodigos"=\''.$tarecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getAllTarea() {
		$sql = 'SELECT * FROM "tarea"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getByTarea_fkey($orgacodigos) {
		$sql = 'SELECT * FROM "tarea" WHERE "orgacodigos"=\''.$orgacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getTarecodigos($tarecodigos) {
		$sql = 'SELECT "tarecodigos" FROM "tarea" WHERE "tarecodigos"=\''.$tarecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getTarenombres($tarecodigos) {
		$sql = 'SELECT "tarenombres" FROM "tarea" WHERE "tarecodigos"=\''.$tarecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getOrgacodigos($tarecodigos) {
		$sql = 'SELECT "orgacodigos" FROM "tarea" WHERE "tarecodigos"=\''.$tarecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getTaredescris($tarecodigos) {
		$sql = 'SELECT "taredescris" FROM "tarea" WHERE "tarecodigos"=\''.$tarecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getTareactivas($tarecodigos) {
		$sql = 'SELECT "tareactivas" FROM "tarea" WHERE "tarecodigos"=\''.$tarecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	
/**
	 * @Copyright 2010 Parquesoft
	 *
	 * Modifica el encargado de una tarea.
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function setOrgacodigos(){
		
		settype($sbSql,"string");
		settype($sbTmp,"string");
		
		if(isset($tarecodigos) && $tarecodigos){
			$sbTmp = ' WHERE "tarecodigos"=\''.$tarecodigos.'\' ';
		}
		
		extract($this->rcData);
		
		$sbSql = 'UPDATE "tarea" SET "orgacodigos"=\''.$orgacodigos.'\' '.$sbTmp;
		
		//retorna el sql
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
} //End of Class Tarea
?>