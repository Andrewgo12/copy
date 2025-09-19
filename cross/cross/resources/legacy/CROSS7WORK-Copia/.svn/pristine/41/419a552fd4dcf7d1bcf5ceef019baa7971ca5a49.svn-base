<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeEnPgsqlPregformula {
	
	function FeEnPgsqlPregformula() {
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
	 * Ingreso de la configuracion del cuestionario.
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function addPregformula(){
		
		settype($sbSql,"string");
		extract($this->rcData);
		
		$sbSql = 'INSERT INTO "pregformula" ("prfocodigon","formcodigon","pregcodigon",
										"pregpadren","objecodigon","prfoordenn")'
		.' VALUES('.$prfocodigon.','.$formcodigon.','.$pregcodigon.','.$pregpadren.','.
		$objecodigon.','.$prfoordenn.')';
		
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
	 * @Copyright 2009 Parquesoft
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
	 * @Copyright 2009 Parquesoft
	 *
	 * Obtiene la configuracion de un formulario.
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getByFormcodigon(){
		
		settype($rcResult,"array");
		settype($sbSql,"string");
		
		extract($this->rcData);
		
		$sbSql = 'SELECT "pregformula"."prfocodigon","pregformula"."formcodigon","pregformula"."pregcodigon",
		"pregformula"."pregpadren","pregformula"."objecodigon","pregformula"."prfoordenn","pregunta"."pregdescris",
		"objeto"."objedescrips","objeto"."objenombres","tema"."temacodigon","tema"."temanombres","ejetematico"."ejtecodigon","ejetematico"."ejtenombres"
		 FROM "pregformula","pregunta","objeto","ejetematico","tema" WHERE "pregformula"."formcodigon"='.$formcodigon
		.' AND "pregformula"."pregcodigon"="pregunta"."pregcodigon" 
		AND "pregformula"."objecodigon"="objeto"."objecodigon" 
		AND "pregunta"."temacodigon"="tema"."temacodigon"
		AND "tema"."ejtecodigon"="ejetematico"."ejtecodigon" ORDER BY "pregformula"."prfoordenn"';
		
		$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		$rcResult = $this->objdb->rcresult;
		
        $this->rcResult = $rcResult;
	}
	
	/**
	 * @Copyright 2009 Parquesoft
	 *
	 * Obtiene la configuracion del formulario por defecto.
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getByDefault(){
		
		settype($rcResult,"array");
		settype($sbSql,"string");
		settype($sbState,"string");
		
		$sbState = Application :: getConstant("FORM_PRED");
		
		$sbSql = 'SELECT "pregformula"."prfocodigon","pregformula"."formcodigon","pregformula"."pregcodigon",
		"pregformula"."pregpadren","pregformula"."objecodigon","pregformula"."prfoordenn","pregunta"."pregdescris",
		"objeto"."objedescrips","objeto"."objenombres","tema"."temacodigon","tema"."temanombres","ejetematico"."ejtecodigon","ejetematico"."ejtenombres"
		 FROM "formulario","pregformula","pregunta","objeto","ejetematico","tema" WHERE "formulario"."formpredets"=\''.$sbState.'\''.
		' AND "formulario"."formcodigon"="pregformula"."formcodigon" AND "pregformula"."pregcodigon"="pregunta"."pregcodigon" 
		AND "pregformula"."objecodigon"="objeto"."objecodigon" 
		AND "pregunta"."temacodigon"="tema"."temacodigon"
		AND "tema"."ejtecodigon"="ejetematico"."ejtecodigon" ORDER BY "pregformula"."prfoordenn"';
		
		$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		$rcResult = $this->objdb->rcresult;
		
        $this->rcResult = $rcResult;	
	}
	
	/**
	 * @Copyright 2009 Parquesoft
	 *
	 * Obtiene las configuraciones relacionadas a un formulario
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getByIdFormulario(){
		
		settype($rcResult,"array");
		settype($sbSql,"string");
		extract($this->rcData);
		
		$sbSql = 'SELECT * FROM "pregformula" WHERE "pregformula"."formcodigon"='.$formcodigon;
		
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
	 * Obtiene las configuraciones relacionadas a una pregunta
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getByIdPregunta(){
		
		settype($rcResult,"array");
		settype($sbSql,"string");
		extract($this->rcData);
		
		$sbSql = 'SELECT * FROM "pregformula" WHERE "pregformula"."pregcodigon"='.$pregcodigon;
		
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
	 * Elimina las configuraciones para un formulario.
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function deleteByFormulario(){
		
		settype($sbSql,"string");
		extract($this->rcData);
		
		$sbSql = 'DELETE FROM "pregformula" WHERE "formcodigon"='.$formcodigon;
		
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
	 * @Copyright 2010 Parquesoft
	 *
	 * determina si existen cuestionarios cuyas preguntas se
	 * relacionan al eje tematico, pasado por parametro, por medio del tema
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function existByIdEjetematico() {

		settype($rcResult,"array");
		settype($sbSql,"string");
		settype($nuCant,"integer");

		extract($this->rcData);

		$sbSql = 'SELECT "pregformula".* FROM "tema","pregunta","pregformula"
		WHERE "tema"."ejtecodigon"='.$ejtecodigon.' AND "pregunta"."temacodigon"="tema"."temacodigon" 
		AND "pregunta"."pregcodigon"="pregformula"."pregcodigon"';

		$this->objdb->fncadoexecute($sbSql);
		$nuCant = $this->objdb->fncadorowcont();

		if ($nuCant>0) {
			$this->consult = true;
		} else {
			$this->consult = false;
		}
	}
	
	/**
	 * @Copyright 2010 Parquesoft
	 *
	 * determina si existen cuestionarios cuyas preguntas se
	 * relacionan al tema pasado por parametro
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function existByIdTema() {

		settype($rcResult,"array");
		settype($sbSql,"string");
		settype($nuCant,"integer");

		extract($this->rcData);

		$sbSql = 'SELECT "pregformula".* FROM "pregunta","pregformula"
		WHERE "pregunta"."temacodigon"='.$temacodigon.' 
		AND "pregunta"."pregcodigon"="pregformula"."pregcodigon"';

		$this->objdb->fncadoexecute($sbSql);
		$nuCant = $this->objdb->fncadorowcont();

		if ($nuCant>0) {
			$this->consult = true;
		} else {
			$this->consult = false;
		}
	}
} //End of Class pregformula
?>