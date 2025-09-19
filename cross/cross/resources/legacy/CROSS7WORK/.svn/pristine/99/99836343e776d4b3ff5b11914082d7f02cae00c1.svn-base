<?php
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeWFPgsqlProceso {

	function FeWFPgsqlProceso() {
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
	
	function existProceso($proccodigos) {
		$sql = 'SELECT * FROM "proceso" WHERE "proccodigos"=\''.$proccodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}
	function existProcesoOrd($proccodigos) {
		$sql = 'SELECT * FROM "orden" WHERE "proccodigos"=\''.$proccodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}

	function addProceso($proccodigos, $procnombres, $procdescris, $perscodigos, $procestinis, $procestfins, $procfeccren, $orgacodigos, $proctiempon, $procactivas) {
		$this->rcSql[] = 'INSERT INTO "proceso" ("proccodigos","procnombres","procdescris","perscodigos","procestinis","procestfins","procfeccren","orgacodigos","proctiempon")'
		.' VALUES(\''.$proccodigos.'\',\''.$procnombres.'\',\''.$procdescris.'\',\''.$perscodigos.'\',\''.$procestinis.'\',\''.$procestfins.'\','.$procfeccren.' ,\''.$orgacodigos.'\','.$proctiempon.' )';
	}
	function addConfigproces($proccodigos, $procnombres){
		$this->rcSql[] = 'INSERT INTO "configproces" VALUES (\''.$proccodigos.'\',\''.$procnombres.'\',\''.$proccodigos.'\')';
	}
	function deleteConfigproces($proccodigos){
		$this->rcSql[] = 'DELETE FROM "configproces" WHERE "proccodigos"=\''.$proccodigos.'\'';
	}
	function addDetaconfproc($proccodigos,$key, $value, $op){
		$this->rcSql[] = 'INSERT INTO "detaconfproc" VALUES (\''.$proccodigos.'\',\''.$key.'\',\''.$op.'\',\''.$value.'\')';
	}
	function execSql(){
		if(!is_array($this->rcSql))
			$this->consult= false;
			$this->objdb->fncadoexecutetrans($this->rcSql);
			$this->consult = $this->objdb->objresult;
	}
	function updateProceso($proccodigos, $procnombres, $procdescris, $perscodigos, $procestinis, $procestfins, $procfeccren, $orgacodigos, $proctiempon, $procactivas) {
		$this->rcSql[] = 'UPDATE "proceso" SET "procnombres"=\''.$procnombres.'\',"procdescris"=\''.$procdescris.'\',"perscodigos"=\''.$perscodigos.'\',"procestinis"=\''.$procestinis.'\',"procestfins"=\''.$procestfins.'\',"procfeccren"='.$procfeccren.' ,"orgacodigos"=\''.$orgacodigos.'\',"proctiempon"='.$proctiempon.' ,"procactivas"=\''.$procactivas.'\' WHERE "proccodigos"=\''.$proccodigos.'\'';
	}
	function deleteDetaConfproc($proccodigos){
		$this->rcSql[] = 'DELETE FROM "detaconfproc" WHERE "coprcodigon"=\''.$proccodigos.'\'';
	}
	function deleteProceso($proccodigos) {
		$this->rcSql[]  = 'DELETE FROM "proceso" WHERE "proccodigos"=\''.$proccodigos.'\'';
	}
	function deleteRutaByProc($proccodigos){
		$this->rcSql[] = 'DELETE FROM "ruta" WHERE "proccodigos"=\''.$proccodigos.'\'';
	}
	function deleteRutaRegla($rutacodigon){
		$this->rcSql[] = 'DELETE FROM "rutaregla" WHERE "rutacodigon"=\''.$rutacodigon.'\'';
	}

	function addRutaRegla($rutacodigon,$reglcodigos){
		$this->rcSql[] = 'INSERT INTO "rutaregla" VALUES ('.$rutacodigon.',\''.$reglcodigos.'\')';
	}

	function getByIdProceso($proccodigos) {
		$sql = 'SELECT * FROM "proceso" WHERE "proccodigos"=\''.$proccodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getDetaconfprocByProceso($proccodigos) {
		$sql = 'SELECT ' .
						'"detaconfproc"."decovalors", ' .
						'"campconfproc"."caconombres" ' .
					'FROM "detaconfproc","campconfproc"' .
					' WHERE ' .
						'"detaconfproc"."coprcodigon"=\''.$proccodigos.'\' AND ' .
						'"detaconfproc"."cacocodigon"="campconfproc"."cacocodigon"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function validaDetaconfproc($rcConfig, $proccodigos=null){
		//Obtiene todas las configuraciones
		$rcConfigproces = $this->getAllConfigproces();
		if(!is_array($rcConfigproces))
			return false;
		$nuRegs = sizeof($rcConfig);
		foreach($rcConfig as $key => $value){
			$rcWhere[] = '("cacocodigon"='.$key.' AND "decovalors"=\''.$value.'\')';
		}
		$sbWhere = '('.implode(' OR ', $rcWhere).')';
		foreach($rcConfigproces as $rcRow){
			if($proccodigos != $rcRow['coprcodigon']){
				$sql = 'SELECT * FROM "detaconfproc" WHERE "coprcodigon" = '.$rcRow['coprcodigon'].' AND '.$sbWhere;
				$this->objdb->fncadoexecute($sql);
				if($this->objdb->fncadorowcont() == $nuRegs)
					return true;
			}
		}
		return false;
	}
	function getAllProceso() {
		$sql = 'SELECT * FROM "proceso"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getAllConfigproces() {
		$sql = 'SELECT * FROM "configproces"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getRutas($proccodigos){
		$sql = 'SELECT * FROM "ruta" WHERE "proccodigos"=\''.$proccodigos.'\' ORDER BY "rutacodigon"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getIndexTareas(){
		$sql = 'SELECT * FROM "tarea" ORDER BY "tarenombres"';
		$this->objdb->fncadosetmodefetch(FETCH_ASSOC);
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			return null;
		while (!$this->objdb->objresult->EOF) {
			$rcTmp = $this->objdb->fncadofetch();
			$this->objdb->fncadomovenext();
			$rcResult[$rcTmp["tarecodigos"]] = $rcTmp["tarenombres"]; 
		}
		return $rcResult;
	}
	function getIndexReglas(){
		$sql = 'SELECT * FROM "reglas" ORDER BY "reglnombres"';
		$this->objdb->fncadosetmodefetch(FETCH_ASSOC);
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			return null;
		while (!$this->objdb->objresult->EOF) {
			$rcTmp = $this->objdb->fncadofetch();
			$this->objdb->fncadomovenext();
			$rcResult[$rcTmp["reglcodigos"]] = $rcTmp["reglnombres"]; 
		}
		return $rcResult;
	}
	function getRutaReglas($rutacodigon){
		$sql = 'SELECT * FROM "rutaregla" WHERE "rutacodigon"='.$rutacodigon;
		$this->objdb->fncadosetmodefetch(FETCH_ASSOC);
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			return null;
		while (!$this->objdb->objresult->EOF) {
			$rcTmp = $this->objdb->fncadofetch();
			$this->objdb->fncadomovenext();
			$rcResult[] = $rcTmp["reglcodigos"]; 
		}
		return $rcResult;
	}
	function getIndexEstados(){
			$sbSql = 	'SELECT ' .
					'"estadotarea"."tarecodigos",'.
					'"estadotarea"."esaccodigos",	' .
					'"estadoacta"."esacnombres" ' .
				'FROM "estadotarea","estadoacta" ' .
				'WHERE	' .
					'"estadotarea"."esaccodigos"="estadoacta"."esaccodigos" ' .
				'ORDER BY "estadotarea"."tarecodigos","estadoacta"."esacnombres"';
		$this->objdb->fncadosetmodefetch(FETCH_ASSOC);
		$this->objdb->fncadoexecute($sbSql);
		if (!$this->objdb->objresult)
			return null;
		while (!$this->objdb->objresult->EOF) {
			$rcTmp = $this->objdb->fncadofetch();
			$this->objdb->fncadomovenext();
			$rcResult[$rcTmp["tarecodigos"]][$rcTmp['esaccodigos']] = $rcEstado[] = $rcTmp["esacnombres"]; 
		}
		return $rcResult;
	} 
	
	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo para validar si un dato existe en la tabla: ruta
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function existRuta($rutacodigon){
		$sql = 'SELECT * FROM "ruta" WHERE "rutacodigon"='.$rutacodigon;
	    $this->objdb->fncadoexecute($sql);
	    return $this->objdb->fncadorowcont();
	}
	
	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo para adicionar datos a la tabla: ruta
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function addRuta($rutacodigon,$proccodigos,$tarecodigos,$rutaesactas,$rutatarsigs,$rutainitars,$rutaporcumn,$rutacantien){   
		$this->rcSql[] = "INSERT INTO \"ruta\" VALUES($rutacodigon,'$proccodigos','$tarecodigos','$rutaesactas','$rutatarsigs','$rutainitars',$rutaporcumn,$rutacantien)";
	}
	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo para eliminar datos a la tabla: ruta
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function deleteRuta($rutacodigon){
		$this->rcSql[] = "DELETE FROM \"ruta\" WHERE \"rutacodigon\"=$rutacodigon";
	}
	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo para actualizar los datos a la tabla: ruta
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function updateRuta($rutacodigon,$proccodigos,$tarecodigos,$rutaesactas,$rutatarsigs,$rutainitars,$rutaporcumn,$rutacantien){
		$this->rcSql[] = "UPDATE \"ruta\" SET \"tarecodigos\"='$tarecodigos',\"rutaesactas\"='$rutaesactas',\"rutatarsigs\"='$rutatarsigs',\"rutainitars\"='$rutainitars',\"rutaporcumn\"=$rutaporcumn,\"rutacantien\"=$rutacantien WHERE \"rutacodigon\"=$rutacodigon";
	}

	function getByProceso_fkey($procestinis) {
		$sql = 'SELECT * FROM "proceso" WHERE "procestinis"=\''.$procestinis.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getByProceso_fkey1($procestfins) {
		$sql = 'SELECT * FROM "proceso" WHERE "procestfins"=\''.$procestfins.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getByProceso_fkey2($orgacodigos) {
		$sql = 'SELECT * FROM "proceso" WHERE "orgacodigos"=\''.$orgacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getProccodigos($proccodigos) {
		$sql = 'SELECT "proccodigos" FROM "proceso" WHERE "proccodigos"=\''.$proccodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getProcnombres($proccodigos) {
		$sql = 'SELECT "procnombres" FROM "proceso" WHERE "proccodigos"=\''.$proccodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getProcdescris($proccodigos) {
		$sql = 'SELECT "procdescris" FROM "proceso" WHERE "proccodigos"=\''.$proccodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getPerscodigos($proccodigos) {
		$sql = 'SELECT "perscodigos" FROM "proceso" WHERE "proccodigos"=\''.$proccodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getProcestinis($proccodigos) {
		$sql = 'SELECT "procestinis" FROM "proceso" WHERE "proccodigos"=\''.$proccodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getProcestfins($proccodigos) {
		$sql = 'SELECT "procestfins" FROM "proceso" WHERE "proccodigos"=\''.$proccodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getProcfeccren($proccodigos) {
		$sql = 'SELECT "procfeccren" FROM "proceso" WHERE "proccodigos"=\''.$proccodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getOrgacodigos($proccodigos) {
		$sql = 'SELECT "orgacodigos" FROM "proceso" WHERE "proccodigos"=\''.$proccodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getProctiempon($proccodigos) {
		$sql = 'SELECT "proctiempon" FROM "proceso" WHERE "proccodigos"=\''.$proccodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getProcactivas($proccodigos) {
		$sql = 'SELECT "procactivas" FROM "proceso" WHERE "proccodigos"=\''.$proccodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	
	/**
	 * @Copyright 2010 Parquesoft
	 *
	 * Modifica el encargado de un proceso.
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function setOrgacodigos(){
		
		settype($sbSql,"string");
		settype($sbTmp,"string");
		
		extract($this->rcData);
		
		if(isset($proccodigos) && $proccodigos){
			$sbTmp = ' WHERE "proccodigos"=\''.$proccodigos.'\' ';
		}
		
		$sbSql = 'UPDATE "proceso" SET "orgacodigos"=\''.$orgacodigos.'\' '.$sbTmp;
		
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
} //End of Class Proceso
?>