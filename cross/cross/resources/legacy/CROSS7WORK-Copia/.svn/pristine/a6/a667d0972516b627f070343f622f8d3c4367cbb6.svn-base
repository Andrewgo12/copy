<?php
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeHrPgsqlPersonal {

	function FeHrPgsqlPersonal() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
		$this->executeSql = true;
	}
	function existPersonal($perscodigos) {
		$sql = 'SELECT * FROM "personal" WHERE "perscodigos"=\''.$perscodigos.'\'';
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
	
	function addPersonal($perscodigos, $persidentifs, $persnombres, $persapell1s,
	$persapell2s, $persusrnams, $cargcodigos, $persprofecs, $perstelefo1, $perstelefo2, $locacodigos,
	$persdireccis, $persemails, $perscontacts, $perstelcont, $persestadoc) {
		
		settype($sbSql,"string");
		
		$sbSql = 'INSERT INTO "personal" ("perscodigos","persidentifs","persnombres",' .
				'"persapell1s","persapell2s","persusrnams","cargcodigos","persprofecs",' .
				'"perstelefo1","perstelefo2","locacodigos","persdireccis","persemails",' .
				'"perscontacts","perstelcont","persestadoc")'.' VALUES(\''.$perscodigos.'\',\''.
		$persidentifs.'\',\''.$persnombres.'\',\''.$persapell1s.'\',\''.$persapell2s.'\',\''.
		$persusrnams.'\',\''.$cargcodigos.'\',\''.$persprofecs.'\',\''.$perstelefo1.'\',\''.
		$perstelefo2.'\',\''.$locacodigos.'\',\''.$persdireccis.'\',\''.$persemails.'\',\''.
		$perscontacts.'\',\''.$perstelcont.'\',\''.$persestadoc.'\')';
		
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
	function updatePersonal($perscodigos, $persidentifs, $persnombres, $persapell1s,
	$persapell2s, $persusrnams, $cargcodigos, $persprofecs, $perstelefo1,
	$perstelefo2, $locacodigos, $persdireccis, $persemails, $perscontacts,
	$perstelcont, $persestadoc) {
		$sql = 'UPDATE "personal" SET "persidentifs"=\''.$persidentifs.'\',"persnombres"=\''.
		$persnombres.'\',"persapell1s"=\''.$persapell1s.'\',"persapell2s"=\''.
		$persapell2s.'\',"persusrnams"=\''.$persusrnams.'\',"cargcodigos"=\''.
		$cargcodigos.'\',"persprofecs"=\''.$persprofecs.'\',"perstelefo1"=\''.
		$perstelefo1.'\',"perstelefo2"=\''.$perstelefo2.'\',"locacodigos"=\''.
		$locacodigos.'\',"persdireccis"=\''.$persdireccis.'\',"persemails"=\''.
		$persemails.'\',"perscontacts"=\''.$perscontacts.'\',"perstelcont"=\''.
		$perstelcont.'\',"persestadoc"=\''.$persestadoc.'\' WHERE "perscodigos"=\''.$perscodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
		$this->consult = false;
		else
		$this->consult = true;
	}
	function deletePersonal($perscodigos) {
		$sql = 'DELETE FROM "personal" WHERE "perscodigos"=\''.$perscodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
		$this->consult = false;
		else
		$this->consult = true;
	}
	function getByIdPersonal($perscodigos) {
		$sql = 'SELECT * FROM "personal" WHERE "perscodigos"=\''.$perscodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getAllPersonal() {
		$sql = 'SELECT * FROM "personal"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getByPersonal_fkey($cargcodigos) {
		$sql = 'SELECT * FROM "personal" WHERE "cargcodigos"=\''.$cargcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getPerscodigos($perscodigos) {
		$sql = 'SELECT "perscodigos" FROM "personal" WHERE "perscodigos"=\''.$perscodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getPersidentifs($perscodigos) {
		$sql = 'SELECT "persidentifs" FROM "personal" WHERE "perscodigos"=\''.$perscodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getPersnombres($perscodigos) {
		$sql = 'SELECT "persnombres" FROM "personal" WHERE "perscodigos"=\''.$perscodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getPersapell1s($perscodigos) {
		$sql = 'SELECT "persapell1s" FROM "personal" WHERE "perscodigos"=\''.$perscodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getPersapell2s($perscodigos) {
		$sql = 'SELECT "persapell2s" FROM "personal" WHERE "perscodigos"=\''.$perscodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getPersusrnams($perscodigos) {
		$sql = 'SELECT "persusrnams" FROM "personal" WHERE "perscodigos"=\''.$perscodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getCargcodigos($perscodigos) {
		$sql = 'SELECT "cargcodigos" FROM "personal" WHERE "perscodigos"=\''.$perscodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getPersprofecs($perscodigos) {
		$sql = 'SELECT "persprofecs" FROM "personal" WHERE "perscodigos"=\''.$perscodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getPerstelefo1($perscodigos) {
		$sql = 'SELECT "perstelefo1" FROM "personal" WHERE "perscodigos"=\''.$perscodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getPerstelefo2($perscodigos) {
		$sql = 'SELECT "perstelefo2" FROM "personal" WHERE "perscodigos"=\''.$perscodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getPersdireccis($perscodigos) {
		$sql = 'SELECT "persdireccis" FROM "personal" WHERE "perscodigos"=\''.$perscodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getPersemails($perscodigos) {
		$sql = 'SELECT "persemails" FROM "personal" WHERE "perscodigos"=\''.$perscodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getPerscontacts($perscodigos) {
		$sql = 'SELECT "perscontacts" FROM "personal" WHERE "perscodigos"=\''.$perscodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getPerstelcont($perscodigos) {
		$sql = 'SELECT "perstelcont" FROM "personal" WHERE "perscodigos"=\''.$perscodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getPersestadoc($perscodigos) {
		$sql = 'SELECT "persestadoc" FROM "personal" WHERE "perscodigos"=\''.$perscodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Personal
?>