<?php
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeEnPgsqlRespuepregun {

	function FeEnPgsqlRespuepregun() {
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
	function addRespuepregun(){

		settype($sbSql,"string");
		extract($this->rcData);

		$sbSql = 'INSERT INTO "respuepregun" ("prfocodigon","reprcodigon","oprecodigon",
										"oprepadren","reprordenn","reprpeson")'
										.' VALUES('.$prfocodigon.','.$reprcodigon.','.$oprecodigon.','.$oprepadren.','.
										$reprordenn.','.$reprpeson.')';

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
	 * Obtiene el detalle de la configuracion del formulario.
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getByPrfocodigon(){

		settype($rcResult,"array");
		settype($sbSql,"string");

		extract($this->rcData);

		$sbSql = 'SELECT "respuepregun"."prfocodigon","respuepregun"."reprcodigon","respuepregun"."oprecodigon",
		"respuepregun"."oprepadren","respuepregun"."reprordenn","respuepregun"."reprpeson","opcionrepues"."opredescrisp"
		 FROM "respuepregun","opcionrepues" WHERE "respuepregun"."prfocodigon"='.$prfocodigon
		.' AND "respuepregun"."oprecodigon"="opcionrepues"."oprecodigon" ORDER BY "respuepregun"."reprordenn"';

		$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		$rcResult = $this->objdb->rcresult;

		$this->rcResult = $rcResult;
	}
	/**
	 * @Copyright 2009 Parquesoft
	 *
	 * Obtiene las configuraciones relacionadas a una respuesta
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getByIdOpcionrepues(){

		settype($rcResult,"array");
		settype($sbSql,"string");
		extract($this->rcData);

		$sbSql = 'SELECT * FROM "respuepregun" WHERE "respuepregun"."oprecodigon"='.$oprecodigon;

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
		
		$sbSql = 'DELETE FROM "respuepregun" WHERE "prfocodigon" IN (SELECT "pregformula"."prfocodigon" FROM "pregformula" WHERE "pregformula"."formcodigon"='.$formcodigon.')';
		
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
	 * @Copyright 2014 Parquesoft
	 *
	 * Obtiene el detalle de la configuracion de la encuesta
	 * @author freina<freina@fullengine.com>
	 *
	 * @location Cali - Colombia
	 */
	function getRespuepregun(){		

		settype($rcResult,"array");
		settype($rcTmp,"array");
		settype($sbSql,"string");
		settype($sbTmp,"string");

		extract($this->rcData);

		if($prfocodigon){
			$rcTmp[] = ' "prfocodigon"='.$prfocodigon.' ';
		}
		
		if($reprcodigon){
			$rcTmp[] = ' "reprcodigon"='.$reprcodigon.' ';
		}
		
		if($oprecodigon){
			$rcTmp[] = ' "oprecodigon"='.$oprecodigon.' ';
		}
		
		if($oprepadren){
			$rcTmp[] = ' "oprepadren"='.$oprepadren.' ';
		}
		
		if($reprordenn){
			$rcTmp[] = ' "reprordenn"='.$reprordenn.' ';
		}
		
		if($reprpeson){
			$rcTmp[] = ' "reprpeson"='.$reprpeson.' ';
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
	
} //End of Class Respuepregun
?>