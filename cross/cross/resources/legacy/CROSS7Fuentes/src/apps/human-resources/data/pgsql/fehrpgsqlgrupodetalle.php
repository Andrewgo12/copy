<?php
//Paquete de conexion a bases de datos
include_once("pkdatabases.php");
class FeHrPgsqlGrupodetalle{
	
	function FeHrPgsqlGrupodetalle(){
		
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
	
	function existGrupodetalle($grupcodigon,$perscodigos){
		
		$sql = 'SELECT * FROM "grupodetalle" WHERE "grupcodigon"='.$grupcodigon.' AND "perscodigos"=\''.$perscodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}

	function addGrupodetalle($grupcodigon,$perscodigos,$persrespons){
		
		settype($sbSql,"string");
		
		$sbSql='INSERT INTO "grupodetalle" ("grupcodigon","perscodigos","persrespons")'
		.' VALUES('.$grupcodigon.' ,\''.$perscodigos.'\',\''.$persrespons.'\')';
		
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

	function updateGrupodetalle($grupcodigon,$perscodigos,$persrespons){
		
		$sql='UPDATE "grupodetalle" SET "persrespons"=\''.$persrespons.'\' WHERE "grupcodigon"='.$grupcodigon.' AND "perscodigos"=\''.$perscodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if(!$this->objdb->objresult)
		$this->consult = false;
		else
		$this->consult = true;
	}

	function deleteGrupodetalle($grupcodigon,$perscodigos){
		
		$sql='DELETE FROM "grupodetalle" WHERE "grupcodigon"='.$grupcodigon.' AND "perscodigos"=\''.$perscodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if(!$this->objdb->objresult)
		$this->consult = false;
		else
		$this->consult = true;
	}

	function getByIdGrupodetalle($grupcodigon,$perscodigos){
		
		$sql='SELECT * FROM "grupodetalle" WHERE "grupcodigon"='.$grupcodigon.' AND "perscodigos"=\''.$perscodigos.'\'';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getAllGrupodetalle(){
		
		$sql='SELECT * FROM "grupodetalle"';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getByGrupodetalle_fkey($grupcodigon){
		
		$sql='SELECT * FROM "grupodetalle" WHERE "grupcodigon"='.$grupcodigon.' ';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getByGrupodetalle_fkey1($perscodigos){
		
		$sql='SELECT * FROM "grupodetalle" WHERE "perscodigos"=\''.$perscodigos.'\'';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getGrupcodigon($grupcodigon,$perscodigos){
		
		$sql='SELECT "grupcodigon" FROM "grupodetalle" WHERE "grupcodigon"='.$grupcodigon.' AND "perscodigos"=\''.$perscodigos.'\'';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getPerscodigos($grupcodigon,$perscodigos){
		
		$sql='SELECT "perscodigos" FROM "grupodetalle" WHERE "grupcodigon"='.$grupcodigon.' AND "perscodigos"=\''.$perscodigos.'\'';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getPersrespons($grupcodigon,$perscodigos){
		
		$sql='SELECT "persrespons" FROM "grupodetalle" WHERE "grupcodigon"='.$grupcodigon.' AND "perscodigos"=\''.$perscodigos.'\'';
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Grupodetalle
?>