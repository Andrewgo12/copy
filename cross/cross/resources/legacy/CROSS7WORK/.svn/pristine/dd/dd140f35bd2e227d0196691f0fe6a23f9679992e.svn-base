<?php
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeCuPgsqlSolicitante {

	function FeCuPgsqlSolicitante() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
		$this->executeSql = true;
	}
	/**
	 * @Copyright 2012 Parquesoft
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
	 * @Copyright 2012 Parquesoft
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
	 * @Copyright 2012 Parquesoft
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
	 * @Copyright 2012 Parquesoft
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
	 * @Copyright 2012 Parquesoft
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
	 * @Copyright 2012 Parquesoft
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
	 * @Copyright 2012 Parquesoft
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
	 * @Copyright 2012 Parquesoft
	 *
	 * Obtiene los contactos registrados 
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getContacto(){

		settype($rcResult,"array");
		settype($rcTmp,"array");
		settype($sbSql,"string");
		settype($sbTmp,"string");

		extract($this->rcData);

		if($contindentis){
			$rcTmp[] = ' "contindentis"=\''.$contindentis.'\' ';
		}

		$sbSql = 'SELECT * FROM "contacto" ';

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
	
	/**
	 * @Copyright 2012 Parquesoft
	 *
	 * Obtiene los clientes 
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getCliente(){

		settype($rcResult,"array");
		settype($rcTmp,"array");
		settype($sbSql,"string");
		settype($sbTmp,"string");

		extract($this->rcData);

		if($clieidentifs){
			$rcTmp[] = ' "clieidentifs"=\''.$clieidentifs.'\' ';
		}

		$sbSql = 'SELECT * FROM "cliente" ';

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
	
	/**
	 * @Copyright 2012 Parquesoft
	 *
	 * Ingreso de los solicitantes
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function addSolicitante(){

		settype($sbSql,"string");
		extract($this->rcData);

		$sbSql = 'INSERT INTO "solicitante" ("solicodigos","contcodigon","cliecodigos","solifecregn",'.
											'"usuacodigos","soliactivos")'
											.' VALUES(\''.$solicodigos.'\','.$contcodigon.',\''.$cliecodigos.'\','.$solifecregn.','.
											'\''.$usuacodigos.'\',\''.$soliactivos.'\')';

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
	 * @Copyright 2012 Parquesoft
	 *
	 * Ingresa el contacto 
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function addContacto(){
		
		settype($sbSql,"string");
		extract($this->rcData);

		$sbSql = 'INSERT INTO "contacto" ("contcodigon","contindentis","tiidcodigos","contprinoms","contsegnoms",'.
		                                 '"contpriapes","contsegapes","contfecnacis","contedadn","contsexos","contemail","locacodigos","contdirecios",'.
		                                 '"conttelefons","contnumcels","contactivas") '. 
										 ' VALUES('.$contcodigon.' ,\''.$contindentis.'\',\''.$tiidcodigos.'\',\''.
										$contprinoms.'\',\''.$contsegnoms.'\',\''.$contpriapes.'\',\''.
										$contsegapes.'\','.$contfecnacis.','.$contedadn.',\''.$contsexos.'\',\''.$contemail.'\',\''.
										$locacodigos.'\',\''.$contdirecios.'\',\''.$conttelefons.'\',\''.$contnumcels.'\',\''.$contactivas.'\')';

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
	 * @Copyright 2012 Parquesoft
	 *
	 * Ingresa el contacto 
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function addCliente(){
		
		settype($sbSql,"string");
		extract($this->rcData);

		$sbSql = 'INSERT INTO "cliente" ("cliecodigos","clieidentifs","ticlcodigos","clienombres","clierepprnos", "clierepsenos", "cliereppraps", "clierepseaps",
									   "clielocalizs","clietelefons","locacodigos","cliepagwebs","cliemails","esclcodigos","tiidcodigos","clienumfaxs",
									   "clieaparaers","clieactivas")'
									.' VALUES(\''.$cliecodigos.'\',\''.$clieidentifs.'\',\''.$ticlcodigos.'\',\''.$clienombres.'\',\''.
									 $clierepprnos.'\',\''.$clierepsenos.'\',\''.$cliereppraps.'\',\''.$clierepseaps.'\',\''.
									 $clielocalizs.'\',\''.$clietelefons.'\',\''.$locacodigos.'\',\''.$cliepagwebs.'\',\''.$cliemails.'\',\''.
									 $esclcodigos.'\',\''.$tiidcodigos.'\',\''.$clienumfaxs.'\',\''.$clieaparaers.'\',\''.$clieactivas.'\')';

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
	 * @Copyright 2012 Parquesoft
	 *
	 * Obtiene la relacion de solicitantes 
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getSolicitante(){

		settype($rcResult,"array");
		settype($rcTmp,"array");
		settype($sbSql,"string");
		settype($sbTmp,"string");

		extract($this->rcData);

		if($solicodigos){
			$rcTmp[] = ' "solicodigos"=\''.$solicodigos.'\' ';
		}
		
		if($contcodigon){
			$rcTmp[] = ' "contcodigon"='.$contcodigon.' ';
		}
		
		if($cliecodigos){
			$rcTmp[] = ' "cliecodigos"=\''.$cliecodigos.'\' ';
		}
		
		if($cliecodigos_n){
			$rcTmp[] = ' "cliecodigos" IS NULL ';
		}
		
		if($soliactivos){
			$rcTmp[] = ' "soliactivos"=\''.$soliactivos.'\' ';
		}

		$sbSql = 'SELECT * FROM "solicitante" ';

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
	
	/**
	 * @Copyright 2014 Parquesoft
	 *
	 * Obtiene la relacion de solicitantes por medio de la vista 
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getViewSolicitante(){

		settype($rcResult,"array");
		settype($rcTmp,"array");
		settype($sbSql,"string");
		settype($sbTmp,"string");

		extract($this->rcData);

		if($solicodigos){
			$rcTmp[] = ' "solicodigos"=\''.$solicodigos.'\' ';
		}
		
		if($contcodigon){
			$rcTmp[] = ' "contcodigon"='.$contcodigon.' ';
		}
		
		if($cliecodigos){
			$rcTmp[] = ' "cliecodigos"=\''.$cliecodigos.'\' ';
		}
		
		if($solifecregn){
			$rcTmp[] = ' "solifecregn"='.$solifecregn.' ';
		}
		
		if($usuacodigos){
			$rcTmp[] = ' "usuacodigos"=\''.$usuacodigos.'\' ';
		}
		
		if($soliactivos){
			$rcTmp[] = ' "soliactivos"=\''.$soliactivos.'\' ';
		}

		$sbSql = 'SELECT * FROM "view_solicitante" ';

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
} //End of Class solicitante
?>