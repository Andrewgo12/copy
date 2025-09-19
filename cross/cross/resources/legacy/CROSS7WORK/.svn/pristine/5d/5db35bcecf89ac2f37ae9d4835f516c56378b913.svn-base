<?php 
//include ("adodb.inc.php");
/*
	Esta clase fue modificada por que presentaba problemas con las Auth de pear, 
	la modificacion consistio en el cambio del nombre de la clase DB a DB_ADO y dentro de 
	ella todos los llamados a esta misma. 	
*/
include('adodb.inc.php');
//include('adodb-pear.inc.php');

define("FETCH_DEFAULT", 0);
define("FETCH_NUM", 1);
define("FETCH_ASSOC", 2);
define("LENGTH_CLOB", 30000);

/*Gestion de datos contra la base de datos*/
class databases {
	var $objado;
	var $objresource;
	var $rcresult; //Almacena los vectores de las consultas
	var $objresult; //Almacena el resultado de los exec a la base de datos
	var $dbType; //Tipo de la base de datos
	var $sbField;

	function fncadoconn($config) {
        //Obtiene los datos del usuario para el esquema
        $rcUser = Application::getUserParam();
        if(!is_array($rcUser))
            $rcUser['schema'] = 1;
            
        //Si no es el esquema de profiles
        if(array_key_exists("schenombres",$config) && $config["schenombres"])
        {
	        $schenombres = $config["schenombres"];
        }
        else
        {
        	$schema = WebSession::getProperty("schema");
	        if($schema)
	        	$schenombres = $schema;
	        elseif($rcUser['schema'] == 1)
		        $schenombres = 'profiles';
		    else
		    	$schenombres = $rcUser['schema_prefix'].$rcUser['schema'];
        }
        	

		$this->objado = ADONewConnection($config['driver']);
		$this->objado->Connect($config['host'], $config['user'], $config['password'], $config['name']);
		$this->dbType = strtolower($config["type"]);
		$this->dbDriver = strtolower($config["driver"]);
        $this->tableSpace = $schenombres;
        $this->setDbParams();
        
		//caracteristicas propias del driver
		include_once($this->dbDriver.".class.php");
		$this->objDriver = new $this->dbDriver;
		$this->rcType_to_Like = $this->objDriver->getRcLike();
       
        //Activa el debug de ado
        $this->objado->debug = true;
	}
	# execute sql
	function fncadoexecute($isbsql) {
		$isbsql = $this->SqlPrepare($isbsql);
		$this->objresult = $this->objado->Execute($isbsql);
	}
	# retorna la cantidad de registros de una consulta
	function fncadorowcont() {
		return $this->objresult->RecordCount();
	}
	# fechea una consulta
	function fncadofetch() {
		return $this->objresult->fields;
	}
	# mueve el puntero de una consulta al proximo
	function fncadomovenext() {
		$this->objresult->MoveNext();
	}
	#ajusta el modo de fetch 
	function fncadosetmodefetch($numode = FETCH_DEFAULT) {
		$this->objado->SetFetchMode($numode);
	}
	# ejecuta conjunto de sql en una transaccion
	function fncadoexecutetrans($rcsql) {
		
		if (!is_array($rcsql)) {
			$this->objresult = false;
			return;
		}
		/*Inicia la transaccion*/
		$this->objado->BeginTrans();
		foreach ($rcsql as $sbsql) {
			$sbsql = $this->SqlPrepare($sbsql);
			$sbresult = $this->objado->Execute($sbsql);
			if (!$sbresult) {
				/*Devuelve la ejecucion*/
				$this->objado->RollbackTrans();
				$this->objresult = false;
				return;
			}
		}
		/*Cierra la transaccion*/
		$this->objado->CommitTrans();
		$this->objresult = true;
		
		return $this->objresult;
	}
	# Cierra ado
	function fncadoclose() {
		$this->objado->Close();
	}
	# Selecion con limite
	function fncadoselect($isbsql, $nutyfetch = FETCH_DEFAULT, $inunumrows = -1, $inuoffset = -1) {
		settype($rcresult,"array");
		
		$this->objado->SetFetchMode($nutyfetch);
		$objtmp = $this->objado->SelectLimit($isbsql, $inunumrows, $inuoffset);
		$nucont = 0;
		if (!$objtmp)
			$rcresult = null;
		else if ($objtmp->_numOfRows == 0)
			$rcresult = null;
		else
			while (!$objtmp->EOF) {
				$rcresult[$nucont] = $objtmp->fields;
				$objtmp->MoveNext();
				$nucont ++;
			}
		//$objtmp->Close(); # optional
		$this->rcresult = $rcresult;
	}
	
	# Selecion con limite y cache
	function fncadoselectcache($isbsql, $nutyfetch = FETCH_DEFAULT, $inunumrows = -1, $inuoffset = -1) {
		GLOBAL $ADODB_CACHE_DIR;
		//Obtiene la vida del cache
		$cache_life = Application :: getCacheLife();
		if(!$cache_life){
			//Si no esta definido se acomoda a un dia
			$cache_life = 86400;
		}
		//Obtiene el directorio de cache
		$cache_dir = Application :: getDirCache();
		$this->objado->SetFetchMode($nutyfetch); //Tipo de Fetch
		if(!$cache_dir){
			$objtmp = $this->objado->SelectLimit($isbsql, $inunumrows, $inuoffset);
		}else{
			$this->objado->cacheSecs = $cache_life; //Vijencia del cache 
			$ADODB_CACHE_DIR = $cache_dir;
			$objtmp = $this->objado->CacheSelectLimit($isbsql, $inunumrows, $inuoffset);
		}
		$nucont = 0;
		if (!$objtmp)
			$this->rcresult = null;
		else
			while (!$objtmp->EOF) {
				$rcresult[$nucont] = $objtmp->fields;
				$objtmp->MoveNext();
				$nucont ++;
			}
		//$objtmp->Close(); # optional
		$this->rcresult = $rcresult;
	}
	# Tablas de la base de datos
	function fncadometatables() {
		$this->rcresult = $this->objado->MetaTables('TABLES');
	}
	# Tablas los campos de una tabla
	function fncadometacolumns($isbtable) {
		$this->rcresult = $this->objado->MetaColumns($isbtable);
	}
	# llave primaria de una tabla
	function fncadometaprimarykeys($isbtable) {
		$this->rcresult = $this->objado->MetaPrimaryKeys($isbtable);
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*	
	*	Ejecuta los querys pasados como parametro en una transaccion
	*	@author creyes
	*	@param array $rcsql
	*	@param string $isbtablock
	*	@return boolean
	*	@date 17-Jun-2004 11:59 
	*	@location Cali-Colombia
	*/
	function fncadolocktbl($ircsql, $isbtablock = false) {

		settype($sblock, "string");
		if (!is_array($ircsql)) {
			$this->objresult = false;
			return;
		}
		//Si el nombre de la tabla existe Adiciona el bloqueo			
		if ($isbtablock !== false) {
			$sblock = $this->fncadolock($isbtablock,true);
			array_unshift($ircsql, $sblock);
		}
		$this->fncadoexecutetrans($ircsql);
		return;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*	
	*	Ejecuta un CachePageExecute
	*	@author creyes
	*	@param array $rcsql
	*	@param string $isbtablock
	*	@return boolean
	*	@date 17-Jun-2004 11:59 
	*	@location Cali-Colombia
	*/
	function fncadoPageExecute($sbsql, $curr_page = 1, $num_rows = 20,$cache=true) {
		if (!$sbsql)
			return null;
		//Obtiene la vida del cache
		$cache_life = Application :: getCacheLife();
		if(!$cache_life){
			//Si no esta definido se acomoda a un dia
			$cache_life = 86400;
		}
		//Obtiene el directorio de cache
		$cache_dir = Application :: getDirCache();
		GLOBAL $ADODB_CACHE_DIR;
		$ADODB_CACHE_DIR = $cache_dir;
		$this->objado->SetFetchMode(FETCH_ASSOC);
		if($cache == true)
			return $this->objado->CachePageExecute($cache_life, $sbsql, $num_rows, $curr_page);
		return $this->objado->PageExecute($sbsql, $num_rows, $curr_page);
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*	
	*	Abre una transaccion en la base de datos
	*	@author creyes
	*	@date 17-Jun-2004 11:59 
	*	@location Cali-Colombia
	*/
	function fncadobegintrans() {
		$this->objado->BeginTrans();
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*	
	*	Revierte una transaccion en la base de datos
	*	@author creyes
	*	@date 17-Jun-2004 11:59 
	*	@location Cali-Colombia
	*/
	function fncadorollbacktrans() {
		$this->objado->RollbackTrans();
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*	
	*	Cierra una transaccion en la base de datos
	*	@author creyes
	*	@date 17-Jun-2004 11:59 
	*	@location Cali-Colombia
	*/
	function fncadocommittrans() {
		$this->objado->CommitTrans();
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*	
	*	Bloquea una tabla para postgres,
	*	@author creyes
	*	@date 17-Jun-2004 11:59 
	*	@location Cali-Colombia
	*/
	function fncadolock($isbtablock,$return=false) {
		switch($this->dbDriver){
			case "pgsql":
				if($return != false){
					$sbsql = "LOCK TABLE \"".$isbtablock."\" IN ACCESS EXCLUSIVE MODE";
					return $sbsql; 
				}
				$sbsql = "LOCK TABLE \"".$isbtablock."\" IN ACCESS EXCLUSIVE MODE";
				$this->objado->Execute($sbsql);
				break;
			case "oci8":
				if($return != false){
					$sbsql = "LOCK TABLE \"".$isbtablock."\" IN SHARE ROW EXCLUSIVE MODE";
					return $sbsql; 
				}
				$sbsql = "LOCK TABLE \"".$isbtablock."\" IN SHARE ROW EXCLUSIVE MODE";
				$this->objado->Execute($sbsql);
				break;	
			default :
				break;
		}
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*	
	*	Ejecuta un conjunto de sql en un array devolviendo un vector con los indices que no producioron error
	*	@author creyes
	*   @param array $rcsql Vector con los sql
	*	@date 10-ago-2004 15:53:59
	*	@location Cali-Colombia
	*/
	function fncadoexecutercsql($rcsql) {
		if (!is_array($rcsql)) {
			$this->sbresult = false;
			return;
		}
		$nuCont = 0; 
		foreach ($rcsql as $key => $sbsql) {
			$sbsql = $this->SqlPrepare($sbsql);
			$sbresult = $this->objado->Execute($sbsql);
			if ($sbresult) {
				$rcReturn[$nuCont] = $key;
				$nuCont ++;
			}
		}
		$this->objresult = true;
		$this->rcresult = $rcReturn;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*	
	*	Prepara el SQl cambiando 'null' por NULL
	*	por el null estandar de base de datos, solo para sentencias DDL
	*	@author freina<freina@parquesoft.com>
	*   @param string $isbSql Cadena con el sql
	*	@date 25-Nov-2005 10:05
	*	@location Cali-Colombia
	*/
	function SqlPrepare($isbSql){
		settype($sbDbNull,"string");
		$sbDbNull = Application :: getConstant("DB_NULL");
		switch($this->dbDriver){
			case "pgsql":
				if ( !preg_match( "#(SELECT)#i", $isbSql) ) {	
					$isbSql = preg_replace("#((,'')|(,'NULL'))#", ','.$sbDbNull, $isbSql);
					$isbSql = preg_replace("#((,,,)|(,,,))#", ','.$sbDbNull.','.$sbDbNull.',', $isbSql);
					$isbSql = preg_replace("#((,,)|(,,))#", ','.$sbDbNull.',', $isbSql);
					$isbSql = preg_replace("#((,\))|(,\)))#", ','.$sbDbNull.')', $isbSql);
					$isbSql = preg_replace("#((='')|(='NULL'))#", '='.$sbDbNull.' ', $isbSql);
					$isbSql = preg_replace("#((= *,))#", '='.$sbDbNull.', ', $isbSql);
					$isbSql = preg_replace("#((= +(WHERE)))#i", '='.$sbDbNull." \\3", $isbSql);
				}
				break;
			case "oci8":
				if ( !preg_match( "#(SELECT)#i", $isbSql) ) {	
					$isbSql = preg_replace("#((,'')|(,'NULL'))#", ','.$sbDbNull, $isbSql);
					$isbSql = preg_replace("#((,,,)|(,,,))#", ','.$sbDbNull.','.$sbDbNull.',', $isbSql);
					$isbSql = preg_replace("#((,,)|(,,))#", ','.$sbDbNull.',', $isbSql);
					$isbSql = preg_replace("#((,\))|(,\)))#", ','.$sbDbNull.')', $isbSql);
					$isbSql = preg_replace("#((='')|(='NULL'))#", '='.$sbDbNull.' ', $isbSql);
					$isbSql = preg_replace("#((= *,))#", '='.$sbDbNull.', ', $isbSql);
					$isbSql = preg_replace("#((= +(WHERE)))#i", '='.$sbDbNull." \\3", $isbSql);
				}
			default :
				break;
		}
		return $isbSql;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*	
	*	Bloquea una tabla para postgres,
	*	@author creyes
	*	@date 17-Jun-2004 11:59 
	*	@location Cali-Colombia
	*/
	function setDbParams() {
		switch($this->dbDriver){
			case "pgsql":
				$sbsql = "SET search_path = ".$this->tableSpace.", pg_catalog";
				$this->objado->Execute($sbsql);
				break;
			case "oci8":
				$sbsql = 'ALTER SESSION SET NLS_NUMERIC_CHARACTERS=". "';
				$this->objado->Execute($sbsql);
				$sbsql = "ALTER SESSION SET CURRENT_SCHEMA=".$this->tableSpace;
				$this->objado->Execute($sbsql);
				break;
			default :
				break;
		}
	}
	
	/**
	*   Propiedad intelectual del FullEngine.
	*	
	*	Actualiza un columna CLOB
	*	@author freina<freina@parquesoft.com>
	*   @param string $sbTable Cadena con el nombre de la tabla
	* 	@param string $sbcolumnPK Cadena con el nombre del campo pk
	*   @param string $sbcolumn Cadena con el nombre de la columna en la que se
	* 	almacena el BLOB
	*   @param string $sbValue Cadena con el valor
	*   @param string $sbId Cadena con el id del registro a actualizar
	* 	@param boolean $sbExecute Determina si la accion se ejecuta o no
	*	@date 02-Jun-2007 11:40
	*	@location Cali-Colombia
	*/
function fncadoUpdateClob($sbTable, $sbcolumnPK, $sbcolumn, $sbValue, $sbId, $sbExecute=true){

		switch($this->dbDriver){
			case "pgsql":
				//si se usa un campo text para almacenar el Clob
				settype($sbSql,"string");
				$sbSql = 'UPDATE '.$sbTable.' ' .
			 			 'SET '.$sbcolumn.'=\''.$sbValue.'\' ' .
			 			 'WHERE '.$sbcolumnPK.'=\''.$sbId.'\'';
				if($sbExecute){
					$this->objresult = $this->objado->Execute($sbSql);
				}else{
					$this->sbresult = $sbSql;
				}
				break;
			case "oci8":
				//si se usa un campo text para almacenar el Clob
					
				settype($sbSql,"string");
				settype($sbVar,"string");
				settype($sbWrite,"string");
				settype($sbTmp,"string");
				settype($sbVarName,"string");
				settype($sbFlag,"string");
				settype($nuCont,"integer");
				settype($nuCant,"integer");
				settype($nuBeg,"integer");
				settype($nuLength,"integer");
				settype($nuUnit,"integer");
				settype($nuAmount, "integer");
				settype($nuPosition, "integer");

				if($sbValue){
					
					$nuUnit = LENGTH_CLOB;
					$nuPosition = 1;
					$nuBeg = 0;
					$nuLength = 0;
					$nuCont = 0;
					$nuCant = strlen($sbValue);
					$sbFlag = true;
					
					do{
						if(($nuCant-$nuBeg)<$nuUnit){
							$nuLength = ($nuCant - $nuBeg) - 1;
							$sbFlag = false;
						}else{
							$nuLength = $nuUnit;	
						}
						
						$sbTmp = substr($sbValue, $nuBeg, $nuLength);
						$nuAmount = strlen($sbTmp);
						$nuCont ++;
						$sbVarName = 'myClobVar'.($nuCont).' ';	
						$sbVar .= $sbVarName.' VARCHAR2('.$nuUnit.') := \''.$sbTmp.'\'; ';
						$sbWrite .= 'DBMS_LOB.WRITE (clob_pointer,'.$nuAmount.','.$nuPosition.','.$sbVarName.'); ';
						$nuBeg += $nuLength;
						$nuPosition += $nuAmount; 
						
					}while($sbFlag);
					
				}
					
				$sbSql = 'DECLARE ';
				$sbSql .= ' clob_pointer CLOB; ';
				$sbSql .= $sbVar;	
				$sbSql .= 'BEGIN ';
				$sbSql .= 'SELECT '.$sbcolumn.' INTO clob_pointer FROM '.$sbTable.' WHERE '.$sbcolumnPK.' = \''.$sbId.'\' FOR UPDATE;
     					   DBMS_LOB.OPEN (clob_pointer,DBMS_LOB.LOB_READWRITE); ';
				$sbSql .= $sbWrite; 
				$sbSql .=' DBMS_LOB.CLOSE (clob_pointer); ';
				$sbSql .= 'END; ';
				
				if($sbExecute){
					$this->objresult = $this->objado->UpdateClob($sbTable,$sbcolumn, $sbValue ,$sbcolumnPK.'='.$sbId);
				}else{
					$this->sbresult = $sbSql;
				}
			default :
				break;
		}
		return true;
	}
	/**
	 * Should prepare the sql statement and return the stmt resource.
	 * For databases that do not support this, we return the $sql. To ensure
	 * compatibility with databases that do not support prepare:
	 *
	 *   $stmt = $db->Prepare("insert into table (id, name) values (?,?)");
	 *   $db->Execute($stmt,array(1,'Jill')) or die('insert failed');
	 *   $db->Execute($stmt,array(2,'Joe')) or die('insert failed');
	 *
	 * @param sql	SQL to send to database
	 *
	 * @return return FALSE, or the prepared statement, or the original sql if
	 * 			if the database does not support prepare.
	 *
	 */
	function fncadoprepare($sbSql) {
		$sbSql = $this->SqlPrepare($sbSql);
		return $this->objado->Prepare($sbSql);
	}
	/** 
	Usage in oracle
		$stmt = $db->Prepare('select * from table where id =:myid and group=:group');
		$db->Parameter($stmt,$id,'myid');
		$db->Parameter($stmt,$group,'group',64);
		$db->Execute();
		
		@param $stmt Statement returned by Prepare() or PrepareSP().
		@param $var PHP variable to bind to
		@param $name Name of stored procedure variable name to bind to.
		@param [$isOutput] Indicates direction of parameter 0/false=IN  1=OUT  2= IN/OUT. This is ignored in oci8.
		@param [$maxLen] Holds an maximum length of the variable.
		@param [$type] The data type of $var. Legal values depend on driver.

	*/
	function fncadoparameter(&$stmt,&$var,$name,$isOutput=false,$maxLen=4000,$type=false) {
		$this->objado->Parameter($stmt,$var,$name,$isOutput,$maxLen,$type);
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*	
	*	Obtiene el error del Sql ejecutado
	*	@author freina<freina@fullengine.com>
	*	@date 01-Aug-2010 10:18 
	*	@location Cali-Colombia
	*/
	function fncadogeterror(){
		return $this->objado->ErrorMsg();
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*	
	*	Actualiza el campo sobre el cual se realizara el like
	*	@author freina<freina@fullengine.com>
	*	@date 24-Dec-2010 09:56 
	*	@location Cali-Colombia
	*/
	function setField($sbField){
		$this->sbField = $sbField;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*	
	*	Actualiza el parametro de busqueda del like
	*	@author freina<freina@fullengine.com>
	*	@date 24-Dec-2010 09:56 
	*	@location Cali-Colombia
	*/
	function setValue($sbValue){
		$this->sbValue = $sbValue;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*	
	*	Obtiene la sentencia LIKE case insensitive apropiada deacuerdo al driver
	*	@author freina<freina@fullengine.com>
	*	@date 24-Dec-2010 10:01 
	*	@location Cali-Colombia
	*/
	function fncadogetlike(){
		
		settype($sbResult, "string");
		settype($sbPos, "string");
		settype($sbField,"string");
		settype($sbValue,"string");
		
		$sbField = $this->sbField; 
		$sbValue = $this->sbValue;
		if($sbField && $sbValue){
			//se valida si el campo esta entre comillas
			$sbPos = strpos($sbField, '"');
			if($sbPos === false){
				//si no lo esta entonces ...
				$sbPos = strpos($sbField, ".");
				if (!($sbPos === false)) {
					$sbField = preg_replace("#((([a-z]|[0-9])*)\.(([a-z]|[0-9])*))#", '"$2"."$4"', $sbField);
				} else {
					$sbField = '"'.$sbField.'"';
				}
			}
			$sbResult = $this->objDriver->getLike($sbField,$sbValue);	
		}
		return $sbResult;
	}    
}
?>
