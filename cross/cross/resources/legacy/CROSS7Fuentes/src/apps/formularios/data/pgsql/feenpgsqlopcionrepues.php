<?php
//Paquete de conexion a bases de datos
include_once("pkdatabases.php");
class FeEnPgsqlOpcionrepues{
	var $consult;
	var $objdb;

	function FeEnPgsqlOpcionrepues(){
		$config = &ASAP::getStaticProperty('Application','config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
		$this->sbReturn=false;
		$this->executeSql = true;
	}

	function setPrecodigon($nuPregcodigon){
		$this->nuPregcodigon = $nuPregcodigon;
	}

	function getResult(){
		return $this->rcResult;
	}

	function setReturn($sbReturn){
		$this->sbReturn=$sbReturn;
	}

	function setOprecodigon($nuOprecodigon){
		$this->nuOprecodigon=$nuOprecodigon;
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
	 * Conjunto de sql a ejecutar
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function setSql($rcSql){
		$this->_rcSql = $rcSql;
	}

	function getOpcionrepuesByPregcodigon(){
		settype($sbSql,"string");
		$sbSql='SELECT "opcionrepues"."oprecodigon", "opcionrepues"."opredescrisp", "opcionrepues"."morecodigon", "opcionrepues"."opreactivas"
    FROM "opcionrepues","pregunta" 
    WHERE "pregcodigon"=\''.$this->nuPregcodigon.'\' AND  "opcionrepues"."morecodigon"= "pregunta"."morecodigon" 
    ORDER BY "opcionrepues"."oprecodigon"';
		$this->objdb->fncadoselect($sbSql,FETCH_ASSOC);
		$this->rcResult = $this->objdb->rcresult;
	}

	function getAllOpcionrepues(){
		settype($sbSql,"string");
		$sbSql='SELECT * FROM "opcionrepues" ORDER BY "opcionrepues"."opredescrisp"';
		$this->objdb->fncadoselect($sbSql,FETCH_ASSOC);
		if($this->sbReturn){
			return $this->objdb->rcresult;
		}else{
			$this->rcResult = $this->objdb->rcresult;
		}
	}

	function getByIdOpcionrepues(){
		settype($sbSql,"string");
		$sbSql='SELECT * FROM "opcionrepues" WHERE "oprecodigon"='.$this->nuOprecodigon;
		$this->objdb->fncadoselect($sbSql,FETCH_ASSOC);
		$this->rcResult = $this->objdb->rcresult;
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

		$sbSql = 'SELECT * FROM "opcionrepues" WHERE "opcionrepues"."morecodigon"='.$morecodigon;

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
	 * Ingreso de una respuesta.
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function addOpcionrepues(){
		
		settype($sbSql,"string");
		extract($this->rcData);
		
		$sbSql = 'INSERT INTO "opcionrepues" ("oprecodigon","opredescrisp","morecodigon","opreactivas")'
		.' VALUES('.$oprecodigon.',\''.$opredescrisp.'\','.$morecodigon.',\''.$opreactivas.'\')';
		
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
	 * Modifica una respuesta.
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function updateOpcionrepues(){
		
		settype($sbSql,"string");
		extract($this->rcData);
		
		$sbSql = 'UPDATE "opcionrepues" SET "opredescrisp"=\''.$opredescrisp.'\',"morecodigon"=\''.$morecodigon.'\',"opreactivas"=\''.$opreactivas.'\' WHERE "oprecodigon"='.$oprecodigon;
		
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
	 * Elimina una respuesta.
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function deleteOpcionrepues(){
		
		settype($sbSql,"string");
		extract($this->rcData);
		
		$sbSql = 'DELETE FROM "opcionrepues" WHERE "oprecodigon"='.$oprecodigon;
		
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
	
	function existOpcionrepues(){
		settype($sbSql,"string");
		$sbSql='SELECT * FROM "opcionrepues" WHERE "oprecodigon"='.$this->nuOprecodigon;
		$this->objdb->fncadoexecute($sbSql);
		$this->rcResult["nuCant"] =  $this->objdb->fncadorowcont();
	}
	
	function getOpcionrepues(){
		
		settype($rcResult,"array");
		settype($rcTmp,"array");
		settype($sbSql,"string");
		settype($sbTmp,"string");

		extract($this->rcData);

		if($oprecodigon){
			$rcTmp[] = ' "oprecodigon"='.$oprecodigon.' ';
		}
		
		if($opredescrisp){
			$rcTmp[] = ' "opredescrisp"=\''.$opredescrisp.'\' ';
		}
		
		if($morecodigon){
			$rcTmp[] = ' "morecodigon"='.$morecodigon.' ';
		}
		
		if($opreactivas){
			$rcTmp[] = ' "opreactivas"=\''.$opreactivas.'\' ';
		}

		$sbSql = 'SELECT * FROM "respuepregun" ';

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
	
} //End of Class Opcionrepues
?>