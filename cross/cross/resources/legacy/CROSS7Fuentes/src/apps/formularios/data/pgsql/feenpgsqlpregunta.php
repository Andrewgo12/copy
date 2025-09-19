<?php
//Paquete de conexion a bases de datos
include_once("pkdatabases.php");
class FeEnPgsqlPregunta
{
	var $consult;
	var $objdb;

	function FeEnPgsqlPregunta()
	{
		$config = &ASAP::getStaticProperty('Application','config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
		$this->executeSql = true;
	}

	function existPregunta($pregcodigon)
	{
		$sql = 'SELECT * FROM "pregunta" WHERE "pregcodigon"='.$pregcodigon;
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}

	function addPregunta($pregcodigon,$pregdescris,$temacodigon,$morecodigon,$pregtipopres,$pregactivas){
		if($morecodigon){
			$sql='INSERT INTO "pregunta" ("pregcodigon","morecodigon","pregdescris","temacodigon","pregtipopres","pregactivas") 
			VALUES('.$pregcodigon.','.$morecodigon.',\''.$pregdescris.'\','.$temacodigon.',\''.$pregtipopres.'\',\''.$pregactivas.'\')';	
		}else{
			$sql='INSERT INTO "pregunta" ("pregcodigon","pregdescris","temacodigon","pregtipopres","pregactivas") 
			VALUES('.$pregcodigon.',\''.$pregdescris.'\','.$temacodigon.',\''.$pregtipopres.'\',\''.$pregactivas.'\')';	
		}
		$this->objdb->fncadoexecute($sql);
		if(!$this->objdb->objresult)
		$this->consult = false;
		else
		$this->consult = true;
	}

	function updatePregunta($pregcodigon,$pregdescris,$temacodigon,$morecodigon,$pregtipopres,$pregactivas)
	{
		if($morecodigon)
		$sql='UPDATE "pregunta" SET "pregdescris"=\''.$pregdescris.'\',"morecodigon"=\''.$morecodigon.'\', "pregtipopres"=\''.$pregtipopres.'\' , "pregactivas"=\''.$pregactivas.'\' WHERE "pregcodigon"=\''.$pregcodigon.'\'';
		else
		$sql='UPDATE "pregunta" SET "pregdescris"=\''.$pregdescris.'\',"pregtipopres"=\''.$pregtipopres.'\', "morecodigon"=NULL , "pregactivas"=\''.$pregactivas.'\' WHERE "pregcodigon"=\''.$pregcodigon.'\'';
		$this->objdb->fncadoexecute($sql);
		if(!$this->objdb->objresult)
		$this->consult = false;
		else
		$this->consult = true;
	}

	function deletePregunta($pregcodigon)
	{
		$sql='DELETE FROM "pregunta" WHERE "pregcodigon"='.$pregcodigon;
		$this->objdb->fncadoexecute($sql);
		if(!$this->objdb->objresult)
		$this->consult = false;
		else
		$this->consult = true;
	}

	function getByIdPregunta($pregcodigon)
	{
		$sql='SELECT * FROM "pregunta" WHERE "pregcodigon"='.$pregcodigon;
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getAllPregunta()
	{
		$sql='SELECT * FROM "pregunta"';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getDataPreguntasAgrupadas($formcodigon=false)
	{
		$sql='SELECT "ejtenombres","temanombres","pregunta"."pregcodigon" as "pregcodigon","pregdescris" '.
		'FROM "ejetematico","tema","pregunta"'.
		'WHERE "ejetematico"."ejtecodigon"="tema"."ejtecodigon" '.
		'AND "tema"."temacodigon"="pregunta"."temacodigon" ';

		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getAllPreguntasUsadas($nuForm)
	{
		$sql='SELECT "pregcodigon" FROM "pregformula" WHERE "formcodigon"=\''.$nuForm.'\'';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
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
	 * Obtiene las preguntas con un modelo de respuestas
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getByIdModeloresp(){

		settype($rcResult,"array");
		settype($sbSql,"string");
		extract($this->rcData);

		$sbSql = 'SELECT * FROM "pregunta" WHERE "pregunta"."morecodigon"='.$morecodigon;

		if(!$this->executeSql){
			$this->_rcSql[] = $sbSql;
			return;
		}
		$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		$rcResult = $this->objdb->rcresult;

		$this->rcResult = $rcResult;

	}
	/**
	 * @Copyright 2009 Parquesoft
	 *
	 * Obtiene las preguntas con un modelo de respuestas
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getByIdTema(){

		settype($rcResult,"array");
		settype($sbSql,"string");
		extract($this->rcData);

		$sbSql = 'SELECT * FROM "pregunta" WHERE "pregunta"."temacodigon"='.$temacodigon;

		if(!$this->executeSql){
			$this->_rcSql[] = $sbSql;
			return;
		}
		$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		$rcResult = $this->objdb->rcresult;

		$this->rcResult = $rcResult;

	}
	
	function getPregunta(){
		
		settype($rcResult,"array");
		settype($rcTmp,"array");
		settype($sbSql,"string");
		settype($sbTmp,"string");

		extract($this->rcData);

		if($pregcodigon){
			$rcTmp[] = ' "pregcodigon"='.$pregcodigon.' ';
		}
		
		if($pregdescris){
			$rcTmp[] = ' "pregdescris"=\''.$pregdescris.'\' ';
		}
		
		if($temacodigon){
			$rcTmp[] = ' "temacodigon"='.$temacodigon.' ';
		}
		
		if($morecodigon){
			$rcTmp[] = ' "morecodigon"='.$morecodigon.' ';
		}
		
		if($pregtipopres){
			$rcTmp[] = ' "pregtipopres"=\''.$pregtipopres.'\' ';
		}
		
		if($pregactivas){
			$rcTmp[] = ' "pregactivas"=\''.$pregactivas.'\' ';
		}

		$sbSql = 'SELECT * FROM "pregunta" ';

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
	
} //End of Class Pregunta
?>