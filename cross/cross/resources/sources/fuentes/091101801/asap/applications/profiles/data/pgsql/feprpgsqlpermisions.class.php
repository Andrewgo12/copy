<?php  
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FePrPgsqlPermisions {
	
	function FePrPgsqlPermisions() {
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
	
	function existPermisions($profcodigos, $applcodigos, $commnombres) {
		$sql = 'SELECT * FROM "permisions" WHERE "profcodigos"=\''.$profcodigos.'\' AND "applcodigos"=\''.$applcodigos.'\' AND "commnombres"=\''.$commnombres.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}
	function addPermisions($schecodigon, $profcodigos, $applcodigos, $commnombres) {
		
		settype($sbSql,"string");
		
		$sbSql = 'INSERT INTO "permisions" ("schecodigon","profcodigos","applcodigos","commnombres")'
		.' VALUES(\''.$schecodigon.'\',\''.$profcodigos.'\',\''.$applcodigos.'\',\''.$commnombres.'\')';
		
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
	function deletePermisions($profcodigos, $applcodigos, $commnombres) {
		$sql = 'DELETE FROM "permisions" WHERE "profcodigos"=\''.$profcodigos.'\' AND "applcodigos"=\''.$applcodigos.'\' AND "commnombres"=\''.$commnombres.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function getByIdPermisions($profcodigos, $applcodigos, $commnombres) {
		$sql = 'SELECT * FROM "permisions" WHERE "profcodigos"=\''.$profcodigos.'\' AND "applcodigos"=\''.$applcodigos.'\' AND "commnombres"=\''.$commnombres.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getAllPermisions() {
		$sql = 'SELECT * FROM "permisions"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getByPermisions_fkey($profcodigos, $applcodigos) {
		$sql = 'SELECT * FROM "permisions" WHERE "profcodigos"=\''.$profcodigos.'\' AND "applcodigos"=\''.$applcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getByPermisions_fkeycache($profcodigos, $applcodigos) {
		$sql = 'SELECT "commnombres" FROM "permisions" WHERE "profcodigos"=\''.$profcodigos.'\' AND "applcodigos"=\''.$applcodigos.'\'';
//		$this->objdb->fncadoselectcache($sql, FETCH_ASSOC);
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getByPermisions_fkey1($commnombres, $applcodigos) {
		$sql = 'SELECT * FROM "permisions" WHERE "commnombres"=\''.$commnombres.'\' AND "applcodigos"=\''.$applcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getProfcodigos($profcodigos, $applcodigos, $commnombres) {
		$sql = 'SELECT "profcodigos" FROM "permisions" WHERE "profcodigos"=\''.$profcodigos.'\' AND "applcodigos"=\''.$applcodigos.'\' AND "commnombres"=\''.$commnombres.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getApplcodigos($profcodigos, $applcodigos, $commnombres) {
		$sql = 'SELECT "applcodigos" FROM "permisions" WHERE "profcodigos"=\''.$profcodigos.'\' AND "applcodigos"=\''.$applcodigos.'\' AND "commnombres"=\''.$commnombres.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getCommnombres($profcodigos, $applcodigos, $commnombres) {
		$sql = 'SELECT "commnombres" FROM "permisions" WHERE "profcodigos"=\''.$profcodigos.'\' AND "applcodigos"=\''.$applcodigos.'\' AND "commnombres"=\''.$commnombres.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function genSqlAddPerm($profcodigos, $applcodigos, $rcCommands,$schecodigon)
	{
        $rcSql = array('DELETE FROM "permisions" WHERE "profcodigos"=\''.$profcodigos.'\' AND "applcodigos"=\''.$applcodigos.'\' AND "schecodigon"=\''.$schecodigon.'\'');
		$nuKey = 1;
        if(is_array($rcCommands))
        {
            foreach($rcCommands as $sbName)
            {
            	$sbSql = 'INSERT INTO "permisions" ("profcodigos","applcodigos","commnombres","schecodigon") VALUES(\''.$profcodigos.'\',\''.$applcodigos.'\',\''.$sbName.'\',\''.$schecodigon.'\')';
                $rcSql[$nuKey] =  $sbSql;
                $nuKey++;
            }
        }
		return $rcSql;
	}
} //End of Class Permisions
?>