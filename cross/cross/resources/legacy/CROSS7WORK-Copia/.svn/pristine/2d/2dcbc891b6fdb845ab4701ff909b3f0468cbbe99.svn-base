<?php
/**
 * @Copyright 2004 FullEngine
 *
 * Clase compuerta para la tabla $tabla
 * @author Ingravity 0.0.8
 * @location Cali - Colombia
 */
//Paquete de conexion a bases de datos
include_once("pkdatabases.php");
class FePrPgsqlAuth {
	
	function FePrPgsqlAuth(){
		
		$config = &ASAP::getStaticProperty('Application','config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
		$this->executeSql = true;
	}

	function existAuth($authusernams){
		
		$sql = 'SELECT * FROM "auth" WHERE "authusernams"=\''.$authusernams.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
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

	function addAuth($authusernams,$authuserpasss,$authrealname,$authrealape1,$authrealape2,$authemail,$applcodigos,$stylcodigos,$langcodigos,$profcodigos){
		
		settype($sbSql,"string");
		
		$sbSql='INSERT INTO "auth" ("authusernams","authuserpasss","authrealname","authrealape1","authrealape2","authemail","applcodigos","stylcodigos","langcodigos","profcodigos")'
		.' VALUES(\''.$authusernams.'\',\''.$authuserpasss.'\',\''.$authrealname.'\',\''.$authrealape1.'\',\''.$authrealape2.'\',\''.$authemail.'\',\''.$applcodigos.'\',\''.$stylcodigos.'\',\''.$langcodigos.'\',\''.$profcodigos.'\')';
		
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

	function updateAuth($authusernams,$authuserpasss,$authrealname,$authrealape1,$authrealape2,$authemail,$applcodigos,$stylcodigos,$langcodigos,$profcodigos,$authestados){

		$sql='UPDATE "auth" SET "authuserpasss"=\''.$authuserpasss.'\',"authrealname"=\''.$authrealname.'\',"authrealape1"=\''.$authrealape1.'\',"authrealape2"=\''.$authrealape2.'\',"authemail"=\''.$authemail.'\',"applcodigos"=\''.$applcodigos.'\',"stylcodigos"=\''.$stylcodigos.'\',"langcodigos"=\''.$langcodigos.'\',"profcodigos"=\''.$profcodigos.'\',"authestados"=\''.$authestados.'\' WHERE "authusernams"=\''.$authusernams.'\'';
		$this->objdb->fncadoexecute($sql);
		if(!$this->objdb->objresult)
		$this->consult = false;
		else
		$this->consult = true;
	}

	function deleteAuth($authusernams){
		
		$sql='DELETE FROM "auth" WHERE "authusernams"=\''.$authusernams.'\'';
		$this->objdb->fncadoexecute($sql);
		if(!$this->objdb->objresult)
		$this->consult = false;
		else
		$this->consult = true;
	}

	function getByIdAuth($authusernams){
		
		$sql='SELECT * FROM "auth" WHERE "authusernams"=\''.$authusernams.'\'';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getAllAuth(){
		
		$sql='SELECT * FROM "auth"';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getByAuth_fkey($profcodigos,$applcodigos){
		
		$sql='SELECT * FROM "auth" WHERE "profcodigos"=\''.$profcodigos.'\' AND "applcodigos"=\''.$applcodigos.'\'';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getByAuth_fkey1($stylcodigos,$applcodigos){
		
		$sql='SELECT * FROM "auth" WHERE "stylcodigos"=\''.$stylcodigos.'\' AND "applcodigos"=\''.$applcodigos.'\'';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getByAuth_fkey2($langcodigos){
		
		$sql='SELECT * FROM "auth" WHERE "langcodigos"=\''.$langcodigos.'\'';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getAuthusernams($authusernams){
		
		$sql='SELECT "authusernams" FROM "auth" WHERE "authusernams"=\''.$authusernams.'\'';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getAuthuserpasss($authusernams){
		
		$sql='SELECT "authuserpasss" FROM "auth" WHERE "authusernams"=\''.$authusernams.'\'';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getAuthrealname($authusernams){
		
		$sql='SELECT "authrealname" FROM "auth" WHERE "authusernams"=\''.$authusernams.'\'';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getAuthrealape1($authusernams){
		
		$sql='SELECT "authrealape1" FROM "auth" WHERE "authusernams"=\''.$authusernams.'\'';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getAuthrealape2($authusernams){
		
		$sql='SELECT "authrealape2" FROM "auth" WHERE "authusernams"=\''.$authusernams.'\'';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getAuthemail($authusernams){
		
		$sql='SELECT "authemail" FROM "auth" WHERE "authusernams"=\''.$authusernams.'\'';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getApplcodigos($authusernams){
		
		$sql='SELECT "applcodigos" FROM "auth" WHERE "authusernams"=\''.$authusernams.'\'';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getStylcodigos($authusernams){
		
		$sql='SELECT "stylcodigos" FROM "auth" WHERE "authusernams"=\''.$authusernams.'\'';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getLangcodigos($authusernams){
		
		$sql='SELECT "langcodigos" FROM "auth" WHERE "authusernams"=\''.$authusernams.'\'';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getProfcodigos($authusernams){
		
		$sql='SELECT "profcodigos" FROM "auth" WHERE "authusernams"=\''.$authusernams.'\'';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Auth
?>