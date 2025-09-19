<?php
//Paquete de conexion a bases de datos
include_once("pkdatabases.php");
class FeGePgsqlNumeradorExtended{
	
	function FeGePgsqlNumeradorExtended(){
		
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
	
	/**
	 *   Propiedad intelectual del FullEngine.
	 *
	 *	Obtiene el proximo consecutivo de la base de datos
	 *	@author freina
	 *	@param string $numecodigos(Nombre de indice)
	 *	@param  integer $nuincremento(Cantidad en la que se incrementara el indice)
	 *	@return integer or null
	 *	@date 13-Jul-2004 16:03
	 *	@location Cali-Colombia
	 */
	function getByIdNumeradorTrans($numecodigos,$nuincremento=0){
		
		if(!$numecodigos || $nuincremento < 0){
			return null;
		}
		// se inicia la transaccion
		$this->objdb->fncadobegintrans();
		//Se bloquea la tabla de numerador
		$this->objdb->fncadolock("numerador");
		//Consulta el registro
		$sql='SELECT * FROM "numerador" WHERE "numecodigos"=\''.$numecodigos.'\'';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		if(!$this->objdb->rcresult){
			//cierra transaccion
			$this->objdb->fncadorollbacktrans();
			return null;
		}
		$nuindact = $this->objdb->rcresult[0]["numeproximon"];
		//Hace el aumento del valor
		if($nuincremento){
			$nuindprox = $nuindact + $nuincremento;
		}
		else{
			$nuindprox = $nuindact + 1;
		}
		//Hace el update del registro
		$sbsql = 'UPDATE "numerador" SET "numeproximon" = '.$nuindprox.' WHERE "numecodigos"=\''.$numecodigos.'\'';
		$this->objdb->fncadoexecute($sbsql);
		if(!$this->objdb->objresult){
			//cierra transaccion
			$this->objdb->fncadorollbacktrans();
			return null;
		}
		//cierra transaccion
		$this->objdb->fncadocommittrans();
		return $nuindact;
	}
	
	/**
	 * @Copyright 2010 Parquesoft
	 *
	 * Actualiza la tabla de numerador
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function setNumerador(){
		
		settype($sbSql,"string");
		
		extract($this->rcData);
		
		$sbSql = 'UPDATE "numerador" SET "numeproximon" = '.$numeproximon.' WHERE "numecodigos"=\''.$numecodigos.'\'';
		
		//retorna el sql
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
}
?>