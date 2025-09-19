<?php
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeWFPgsqlActatmp {

	function FeWFPgsqlActatmp() { 

		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
		$this->executeSql = true;
	}
	/**
	 * @Copyright ActaTmp Parquesoft
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
	 * @Copyright ActaTmp Parquesoft
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
	 * @Copyright ActaTmp Parquesoft
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
	 * @Copyright ActaTmp Parquesoft
	 *
	 * obtiene los sql
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getSql(){
		return $this->_rcSql;
	}
	
	/**
	 * @Copyright ActaTmp Parquesoft
	 *
	 * actualiza los sql
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function setSql($rcSql){
		$this->_rcSql = $rcSql;
	}
	/**
	 * @Copyright ActaTmp Parquesoft
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
	 * @Copyright ActaTmp Parquesoft
	 *
	 * Obtiene el nombre de la tabla
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getName(){
		return $this->sbTable;
	}

	/**
	 * @Copyright ActaTmp Parquesoft
	 *
	 * Actualiza el nombre de la tabla
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function setName($sbName){
		$this->sbTable = $sbName;
	}

	/**
	 * @Copyright ActaTmp Parquesoft
	 *
	 * crea la tabla temporal
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function create(){

		settype($objManager, "object");
		settype($objDate, "object");
		settype($rcUser, "array");
		settype($sbFunction, "string");
		settype($sbStatus, "string");
		settype($nuDate, "integer");
		
		$rcUser = Application :: getUserParam();

		$objManager = Application :: getDomainController('NumeradorManager');
		$this->nuId = $objManager->fncgetByIdNumerador("actatmp"); //Id de la tabla a crear
		$this->sbTable =  "acta_". (string) $this->nuId;
		
		$objDate = Application :: loadServices("DateController");
		$nuDate = $objDate->fncintdate();
		
		$sbStatus = Application :: getConstant("REG_ACT"); 

		$sbFunction = "_create_".$this->objdb->dbDriver;
		$this->$sbFunction();
		$this->_load();
		
		//se crea el registro de la tabla
		$this->rcData = array("actmcodigos"=>$this->nuId,"actmnombres"=>$this->sbTable,
							  "actmfechregn"=>$nuDate,"usuacodigos"=>$rcUser["username"],"actmactivas"=>$sbStatus);
		
		$this->executeSql = false;
		$this->addActatmp();
		
		$this->_executeTrans();
	}

	/**
	 * @Copyright ActaTmp Parquesoft
	 *
	 * crea la tabla temporal para postgresql
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function _create_pgsql(){
		
		settype($rcSql, "array");
		settype($sbSql, "string");

		$sbSql = 'CREATE TABLE "'.$this->sbTable.'" (';
    	$sbSql .= '"actacodigos" varchar(30) NOT NULL,';
    	$sbSql .= '"ordenumeros" varchar(30),';
    	$sbSql .= '"tarecodigos" varchar(30),';
    	$sbSql .= '"actaestacts" varchar(30),';
    	$sbSql .= '"actaestants" varchar(30),';
    	$sbSql .= '"actafechingn" integer,';
    	$sbSql .= '"usuacodigos" varchar(30),';
    	$sbSql .= '"orgacodigos" varchar(30),';
    	$sbSql .= '"actaactivas" varchar(30),';
    	$sbSql .= '"actafechfinn" integer DEFAULT NULL,';
    	$sbSql .= '"actafechinin" integer,';
    	$sbSql .= '"actafechvenn" integer';
		$sbSql .= ')';
		$rcSql[0] = $sbSql;
		
		$sbSql = 'ALTER TABLE ONLY "'.$this->sbTable.'" ADD CONSTRAINT '.$this->sbTable.'_pkey PRIMARY KEY ("actacodigos")';
		$rcSql[1] = $sbSql;
		
		$this->_rcSql = $rcSql;

	}

	/**
	 * @Copyright ActaTmp Parquesoft
	 *
	 * crea la tabla temporal para oracle
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function _create_oci8(){
		
		settype($rcSql, "array");
		settype($sbSql, "string");

		$sbSql = 'CREATE TABLE "'.$this->sbTable.'" (';
    	$sbSql .= '"actacodigos" varchar2(30) NOT NULL,';
    	$sbSql .= '"ordenumeros" varchar2(30),';
    	$sbSql .= '"tarecodigos" varchar2(30),';
    	$sbSql .= '"actaestacts" varchar2(30),';
    	$sbSql .= '"actaestants" varchar2(30),';
    	$sbSql .= '"actafechingn" number,';
    	$sbSql .= '"usuacodigos" varchar2(30),';
    	$sbSql .= '"orgacodigos" varchar2(30),';
    	$sbSql .= '"actaactivas" varchar2(30),';
    	$sbSql .= '"actafechfinn" number DEFAULT NULL,';
    	$sbSql .= '"actafechinin" number,';
    	$sbSql .= '"actafechvenn" number';
		$sbSql .= ')';
		
		$rcSql[0] = $sbSql;
		$sbSql = 'ALTER TABLE "'.$this->sbTable.'" ADD CONSTRAINT '.$this->sbTable.'_pkey PRIMARY KEY ("actacodigos")';
		
		$rcSql[1] = $sbSql;
		$this->_rcSql = $rcSql;
		
	}

	/**
	 * @Copyright ActaTmp Parquesoft
	 *
	 * llenado de la tabla
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function _load(){
		
		settype($sbFunction, "string");

		$sbFunction = "_load_".$this->objdb->dbDriver;
		$this->$sbFunction();
	}
	
	/**
	 * @Copyright ActaTmp Parquesoft
	 *
	 * sql de ingreso de registros para la tabla temporal en postgresql
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function _load_pgsql(){
		
		settype($rcSql, "array");
		settype($sbSql, "string");
		settype($sbStatus, "string");
		
		if(is_array($this->rcData) && $this->rcData){
			extract($this->rcData);	
		}
		
		$sbStatus = Application :: getConstant("REG_INACT");
		
		$sbSql = 'INSERT INTO "'.$this->sbTable.'" (SELECT "acta".* FROM "acta" WHERE  ("ordenumeros","actacodigos") IN '
		.' (SELECT "orden"."ordenumeros",CAST(MAX(CAST("acta"."actacodigos" AS integer)) AS varchar) AS "actacodigos" '
		.'FROM "orden","acta" WHERE "orden"."ordenumeros"="acta"."ordenumeros" '.$where.' AND "acta"."actaactivas" <> \''.$sbStatus.'\' '
		.' GROUP BY "orden"."ordenumeros"))';
		
		$this->_rcSql[] = $sbSql;
	}
	
	/**
	 * @Copyright ActaTmp Parquesoft
	 *
	 * sql de ingreso de registros para la tabla temporal en oracle
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function _load_oci8(){
		
		settype($rcSql, "array");
		settype($sbSql, "string");
		settype($sbStatus, "string");
		
		if(is_array($this->rcData) && $this->rcData){
			extract($this->rcData);	
		}
		
		$sbStatus = Application :: getConstant("REG_INACT");
		
		$sbSql = 'INSERT INTO "'.$this->sbTable.'" ("actacodigos","ordenumeros","tarecodigos","actaestacts",'
		.'"actaestants","actafechingn","usuacodigos","orgacodigos","actaactivas","actafechfinn","actafechinin","actafechvenn") '
		.' (SELECT "acta".* FROM "acta" WHERE  ("ordenumeros","actacodigos") IN '
		.' (SELECT "orden"."ordenumeros",CAST(MAX(CAST("acta"."actacodigos" AS number)) AS varchar2(30)) AS "actacodigos" '
		.'FROM "orden","acta" WHERE "orden"."ordenumeros"="acta"."ordenumeros" '.$where.' AND "acta"."actaactivas" <> \''.$sbStatus.'\' '
		.' GROUP BY "orden"."ordenumeros"))';		
		
		$this->_rcSql[] = $sbSql;
	}

	/**
	 * @Copyright ActaTmp Parquesoft
	 *
	 * eimina la tabla
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function drop(){
		
		settype($objDate, "object");
		settype($rcTmp, "array");
		settype($rcRow, "array");
		settype($sbStatus, "string");
		settype($sbStatusI, "string");
		settype($nuDate, "integer");
		
		$objDate = Application :: loadServices("DateController");
		$nuDate = $objDate->fncintdate();
		$sbStatus = Application :: getConstant("REG_ACT"); 
		$sbStatusI = Application :: getConstant("REG_INACT");

		$sbFunction = "_drop_".$this->objdb->dbDriver;
		
		if($this->sbTable){
			$this->$sbFunction();
			$this->executeSql = false;
			$this->rcData = array ("actmcodigos"=>substr($this->sbTable, (strpos($this->sbTable, "_")+1)),"actmactivas"=>$sbStatusI);
			$this->setActatmp();    //Actualiza el registro a inactivo en actatmp
		}else{
			//se valida si hay tablas temporales por eliminar
			$this->rcData = array ("actmfechregn_menor"=>$nuDate,"actmactivas"=>$sbStatus);
			$this->getActatmp();
			$rcTmp = $this->rcResult;
			if(is_array($rcTmp)&& $rcTmp){
				
				$this->executeSql = false;
				
				foreach ($rcTmp as $rcRow){
					$this->sbTable = $rcRow["actmnombres"];
					$this->$sbFunction();
					$this->rcData = array ("actmcodigos"=>$rcRow["actmcodigos"],"actmactivas"=>$sbStatusI);
					$this->setActatmp();    //Actualiza el registro a inactivo en actatmp
				}
			}
		}
		
		$this->_executeTrans();

	}

	/**
	 * @Copyright ActaTmp Parquesoft
	 *
	 * eimina la tabla postgresql
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function _drop_pgsql(){
		
		settype($rcSql, "array");
		settype($sbSql, "string");

		//Se valida que no exista la tabla en el católogo . cazapata
		$sbSqlValida = "SELECT COUNT (relname) as a FROM pg_class WHERE relname = '".$this->sbTable."'";
		$this->objdb->fncadoselect($sbSqlValida, FETCH_ASSOC);
		$rcResult = $this->objdb->rcresult[0][a];

		if($rcResult=="1"){
			$sbSql = 'DROP TABLE "'.$this->sbTable.'"';				
			$this->_rcSql[] = $sbSql;
		}
	}

	/**
	 * @Copyright ActaTmp Parquesoft
	 *
	 * borrado de la tabla temporal para oracle
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function _drop_oci8(){
		settype($rcSql, "array");
		settype($sbSql, "string");

		$sbSql = 'DROP TABLE "'.$this->sbTable.'"';				
		$this->_rcSql[] = $sbSql;
	}

	function _executeTrans() {
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
	 * @Copyright 2014 Fullengine
	 *
	 * Ingreso del registro para actatmp
	 * @author freina<freina@fullengine.com>
	 *
	 * @location Cali - Colombia
	 */
	function addActatmp(){

		settype($sbSql,"string");
		extract($this->rcData);

		$sbSql = 'INSERT INTO "actatmp" ("actmcodigos","actmnombres","actmfechregn","usuacodigos","actmactivas")'
		.' VALUES(\''.$actmcodigos.'\',\''.$actmnombres.'\','.$actmfechregn.',\''.$usuacodigos.'\',\''.$actmactivas.'\')';

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
	 * @Copyright 2014 Fullengine
	 *
	 * Obtiene los registros de la tabla actatmp
	 * @author freina<freina@fullengine.com>
	 *
	 * @location Cali - Colombia
	 */
	function getActatmp(){

		settype($rcResult,"array");
		settype($rcTmp,"array");
		settype($sbSql,"string");
		settype($sbTmp,"string");

		extract($this->rcData);

		if($actmcodigos){
			$rcTmp[] = ' "actmcodigos"=\''.$actmcodigos.'\' ';
		}
		
		if($actmnombres){
			$rcTmp[] = ' "actmnombres"=\''.$actmnombres.'\' ';
		}
		
		if($actmfechregn){
			$rcTmp[] = ' "actmfechregn"='.$actmfechregn.' ';
		}
		
		if($usuacodigos){
			$rcTmp[] = ' "usuacodigos"=\''.$usuacodigos.'\' ';
		}
		
		if($actmactivas){
			$rcTmp[] = ' "actmactivas"=\''.$actmactivas.'\' ';
		}

		if($actmfechregn_menor){
			$rcTmp[] = ' "actmfechregn" < '.$actmfechregn_menor.' ';
		}

		$sbSql = 'SELECT * FROM "actatmp" ';

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
	 * @Copyright 2014 Fullengine
	 *
	 * actualiza la tabla actatmp
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function setActatmp(){

		settype($rcTmp,"array");
		settype($sbSql,"string");
		settype($sbTmp,"string");

		extract($this->rcData);
		
		if($actmnombres){
			$rcTmp[] = ' "actmnombres"=\''.$actmnombres.'\' ';
		}
		
		if($actmfechregn){
			$rcTmp[] = ' "actmfechregn"=\''.$actmfechregn.'\' ';
		}
		
		if($usuacodigos){
			$rcTmp[] = ' "usuacodigos"=\''.$usuacodigos.'\' ';
		}
		
		if($actmactivas){
			$rcTmp[] = ' "actmactivas"=\''.$actmactivas.'\' ';
		}

		if(is_array($rcTmp) && $rcTmp){
			$sbTmp = implode(" , ",$rcTmp);
		}

		$sbSql = 'UPDATE "actatmp" SET  ';
		$sbSql .= $sbTmp;
		$sbSql .= '  WHERE "actmcodigos"=\''.$actmcodigos.'\'';

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
} //End of Class ActaTmp
?>