<?php
//Paquete de conexion a bases de datos
include_once("pkdatabases.php");
class FeEnPgsqlFormulario
{

	function FeEnPgsqlFormulario(){
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

	function existFormulario($formcodigon){
		$sql = 'SELECT * FROM "formulario" WHERE "formcodigon"=\''.$formcodigon.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}

	function addFormulario($formcodigon,$formnombres,$formfeccrean,$formintrodus,$formpredets,$formactivos){
		$sql='INSERT INTO "formulario" ("formcodigon","formnombres","formfeccrean","formintrodus","formpredets","formactivos") VALUES ('.$formcodigon.',\''.$formnombres.'\','.$formfeccrean.',\''.$formintrodus.'\',\''.$formpredets.'\',\''.$formactivos.'\')';
		$this->objdb->fncadoexecute($sql);
		if(!$this->objdb->objresult)
		$this->consult = false;
		else
		$this->consult = true;
	}

	function updateFormulario($formcodigon,$formnombres,$formintrodus,$formpredets,$formactivos){
		$sql='UPDATE "formulario" SET "formnombres"=\''.$formnombres.'\',"formintrodus"=\''.$formintrodus.'\',"formpredets"=\''.$formpredets.'\',"formactivos"=\''.$formactivos.'\' WHERE "formcodigon"=\''.$formcodigon.'\'';
		$this->objdb->fncadoexecute($sql);
		if(!$this->objdb->objresult)
		$this->consult = false;
		else
		$this->consult = true;
	}

	function deleteFormulario($formcodigon){
		$sql='DELETE FROM "formulario" WHERE "formcodigon"=\''.$formcodigon.'\'';
		$this->objdb->fncadoexecute($sql);
		if(!$this->objdb->objresult)
		$this->consult = false;
		else
		$this->consult = true;
	}

	function getByIdFormulario($formcodigon){
		$sql='SELECT * FROM "formulario" WHERE "formcodigon"=\''.$formcodigon.'\'';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function activeFormulario($formcodigon){
		$sbActive = Application::getConstant("REG_ACT");
		$sbInActive = Application::getConstant("REG_INACT");
		 
		$sql='UPDATE "formulario" SET formactivos=\''.$sbActive.'\' WHERE "formcodigon"=\''.$formcodigon.'\'';
		$this->objdb->fncadoexecute($sql);

		$sql='UPDATE "formulario" SET formactivos=\''.$sbInActive.'\' WHERE "formcodigon" <> \''.$formcodigon.'\'';
		$this->objdb->fncadoexecute($sql);

		if(!$this->objdb->objresult)
		$this->consult = false;
		else
		$this->consult = true;
	}

	function getAllFormulario(){
		$sql='SELECT * FROM "formulario" ORDER BY "formcodigon"';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getDataFormulariosUsados(){
		$sql='SELECT DISTINCT "formcodigon" FROM "respuestausu"';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	//--------------------------------
	/**
	 * @Copyright 2010 Parquesoft
	 *
	 * actualiza el formulario
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function setFormulario(){

		settype($rcTmp,"array");
		settype($sbSql,"string");
		settype($sbTmp,"string");

		extract($this->rcData);

		if($formpredets){
			$rcTmp[] = ' "formpredets"=\''.$formpredets.'\' ';
		}

		if(is_array($rcTmp) && $rcTmp){
			$sbTmp = implode(" , ",$rcTmp);
		}

		$sbSql = 'UPDATE "formulario" SET  ';
		$sbSql .= $sbTmp;
		
		if($formcodigon){
			$sbSql .= '  WHERE "formcodigon"='.$formcodigon;	
		}

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
} //End of Class Formulario
?>