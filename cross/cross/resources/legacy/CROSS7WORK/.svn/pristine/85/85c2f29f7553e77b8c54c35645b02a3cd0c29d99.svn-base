<?php
//Paquete de conexion a bases de datos
include_once("pkdatabases.php");
class FeGePgsqlDimension{
	
	function FeGePgsqlDimension(){
		
		$this->config = &ASAP::getStaticProperty('Application','config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($this->config['database']);
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
	 * Copyright 2006 FullEngine
	 *
	 * Obtiene configuraciones
	 * @author creyes
	 * @param type name desc
	 * @return type name desc
	 * @date 20-February-2006 14:32:24
	 * @location Cali-Colombia
	 */

	function getConfigDimension($codidominios,$codidomicams=null,$codidomivals=null){
		if($codidomicams)
			$codidomicams = ' AND "codidomicams"=\''.$codidomicams.'\' ';
		else
			$codidomicams = ' AND ("codidomicams" IS NULL OR "codidomicams" = \'\') ';

		if($codidomivals)
			$codidomivals = ' AND "codidomivals"=\''.$codidomivals.'\' ';
		else
			$codidomivals = ' AND ("codidomivals" IS NULL OR "codidomivals" = \'\') ';

		$sql = 'SELECT * '.
                'FROM "configdimension" '.
                'WHERE "codidominios"=\''.$codidominios.'\' '.$codidomicams.$codidomivals;
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		$rcResult = $this->objdb->rcresult;
		return $rcResult;
	}
	/**
	 * Copyright 2006 FullEngine
	 *
	 * Obtiene los valores de una dimension
	 * @author creyes
	 * @param type name desc
	 * @return type name desc
	 * @date 20-February-2006 16:36:22
	 * @location Cali-Colombia
	 */

	function getValorDimension($rcCodDimension,$vadidominios=null,$vadidomivals=null){
		if(!is_array($rcCodDimension))
		return null;

		$param = "('".implode("','",$rcCodDimension)."')";
		if($vadidominios)
		$vadidominios = ' AND "valordimension"."vadidominios" = \''.$vadidominios.'\'';
		if($vadidomivals)
		$vadidomivals = ' AND "valordimension"."vadidomivals" = \''.$vadidomivals.'\' ';

		$sql = 'SELECT '.
            '"detalledimens"."dedinombres", '.
		//'"detalledimens"."dediorigens", '.
            '"valordimension"."vadicodigon", '. 
            '"valordimension"."vadidominios", '. 
            '"valordimension"."vadidomivals", '.
            '"valordimension"."vadivalors" '. 
        'FROM '.
            '"detalledimens","valordimension" '.
        'WHERE '.
            '"detalledimens"."dimecodigon" IN '.$param.' AND '.
            '"detalledimens"."dimecodigon" = "valordimension"."dimecodigon" AND '.
            '"detalledimens"."dedinombres" = "valordimension"."dedinombres" '.$vadidominios.$vadidomivals.
        ' ORDER BY '.
            '"detalledimens"."dimecodigon" ASC, '.
            '"detalledimens"."dediordenn" ASC ';

		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	/**
	 * Copyright 2006 FullEngine
	 *
	 * Obtiene los valores del detalle de una dimension por su Id
	 * @author freina<freina@parquesoft.com>
	 * @param Integer $sbDimecodigon codigo de la dimension
	 * @return array $rcResult Arreglo con los datos de la dimencion
	 * @date 22-February-2006 12:52
	 * @location Cali-Colombia
	 */

	function getDetalleDimensionByDimecodigon($sbDimecodigon){
		 
		$sbSql = 'SELECT * FROM "detalledimens"
        		WHERE "detalledimens"."dimecodigon" ='.$sbDimecodigon.' 
        		ORDER BY '.
	            '"detalledimens"."dimecodigon" ASC, '.
	            '"detalledimens"."dediordenn" ASC ';

		$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	/**
	 * Copyright 2006 FullEngine
	 *
	 * Arma una tabla temporal
	 * @author creyes
	 * @param type name desc
	 * @return type name desc
	 * @date 22-February-2006 16:35:19
	 * @location Cali-Colombia
	 */

	function doTmpTable($tmpTable,$rcDetalleDimension){
		//Arma la tabla temporal
		$function = "setDataType_".$this->config["database"]["driver"];
		foreach($rcDetalleDimension as $rcField){
			$rcLine[] =  '"'.$rcField['dedinombres'].'" '.$this->$function($rcField['deditipodats'], $rcField['deditamtips']);
			$this->FieldList[] = $rcField['dedinombres'];
			if($rcField['dediorigens']) {
				$rcLine[] =  '"'.$rcField['dedinombres'].'_desc" '.$this->$function('string', 100);
				$this->FieldList[] = $rcField['dedinombres'].'_desc';
			}
		}

		$dropTable = 'DROP TABLE "'.$tmpTable.'"';
		$createTable = 'CREATE TABLE "'.$tmpTable.'"('.implode(",",$rcLine).')';
		$this->objdb->fncadoexecute($dropTable);
		$this->objdb->fncadoexecute($createTable);
		if($this->objdb->objresult == false)
		return false;
		return true;
	}
	/**
	 * Copyright 2006 FullEngine
	 *
	 * Retorna el tipo de datos segun postgres
	 * @author creyes
	 * @param type name desc
	 * @return type name desc
	 * @date 22-February-2006 16:41:28
	 * @location Cali-Colombia
	 */
	function setDataType_pgsql($type, $size=null){
		$type = strtolower($type);
		switch($type){
			case 'string':
				$stringType = "varchar($size)";
				break;
			case 'integer':
				$stringType = "integer";
				break;
			case 'double':
				$stringType = "double precision";
				break;
			case 'text':
				$stringType = "text";
				break;
		}
		return $stringType;
	}
	/**
	 * Copyright 2006 FullEngine
	 *
	 * Retorna el tipo de datos segun oracle
	 * @author creyes
	 * @param type name desc
	 * @return type name desc
	 * @date 22-February-2006 16:41:28
	 * @location Cali-Colombia
	 */
	function setDataType_oci8($type, $size=null){
		$type = strtolower($type);
		switch($type){
			case 'string':
				if($size == 1)
				$stringType = "char(1)";
				else
				$stringType = "varchar2($size)";
				break;
			case 'integer':
				$stringType = "number";
				break;
			case 'double':
				$stringType = "float(10)";
				break;
			case 'text':
				$stringType = "varchar2(4000 BYTE)";
				break;
		}
		return $stringType;
	}
	/**
	 * Copyright 2006 FullEngine
	 *
	 * Ejecuta una consulta dinamica
	 * @author creyes
	 * @param type name desc
	 * @return type name desc
	 * @date 24-February-2006 12:8:23
	 * @location Cali-Colombia
	 */
	function getConsult($table, $value_field, $label_field){
		if(!$table || !$value_field || !$label_field)
		return null;
		$sql = 'SELECT "'.$value_field.'","'.$label_field.'" FROM "'.$table.'" ORDER BY "'.$label_field.'"';
		$this->objdb->fncadoselect($sql, FETCH_NUM);
		return $this->objdb->rcresult;
	}
	/**
	 * Copyright 2006 FullEngine
	 *
	 * Ejecuta una consulta dinamica
	 * @author creyes
	 * @param type name desc
	 * @return type name desc
	 * @date 24-February-2006 12:8:23
	 * @location Cali-Colombia
	 */
	function getConsultSqlid($sqlid, $value_field, $label_field){
		
		settype($objService,"object");
		settype($rcData,"array");
		settype($sbTmp,"string");
		settype($sbTmp1,"string");
		settype($sbSql,"string");
		settype($sbStatus,"string");
		
		$sbStatus = Application :: getConstant("REG_ACT");
		
		if(!$sqlid || !$value_field || !$label_field)
		return null;
		switch($sqlid){
			case 'barrios':
				$sbSql = 'SELECT a.locacodigos AS locacodigos,c.locanombres||\' - \'||a.locanombres AS locanombres
							FROM localizacion a,localizacion b,localizacion c
							WHERE a.tilocodigos=\'7\' 
							AND a.locacodpadrs=b.locacodigos
							AND b.locacodpadrs=c.locacodigos
							ORDER BY 2';
				break;
			case 'ciudades':
				$sbSql = 'SELECT a.locacodigos AS locacodigos,b.locanombres||\' - \'||a.locanombres AS locanombres
							FROM localizacion a,localizacion b
							WHERE a.tilocodigos=\'3\' 
							AND a.locacodpadrs=b.locacodigos
							ORDER BY 2';
				break;
				case 'dep_fisica':
				$objService = Application::loadServices('General');
            	$rcData = $objService->getParam("human_resources","TIP_DEP_FISICA");
            	if(is_array($rcData) && $rcData){
            		$sbTmp = " AND \"tipoorgani\".\"tiorcodigos\" IN ('".implode("','",$rcData)."') ";
            	}
            	unset($rcData);
				$objService = Application::loadServices('General');
            	$rcData = $objService->getParam("human_resources","ORG_INACT");
            	if(is_array($rcData) && $rcData){
            		$sbTmp1 = " AND \"organizacion\".\"esorcodigos\" NOT IN ('".implode("','",$rcData)."') ";
            	}
				$sbSql = 'SELECT "organizacion".* FROM "organizacion","tipoorgani" WHERE "organizacion"."orgaactivas"=\''.$sbStatus.'\' '.$sbTmp1.'AND "organizacion"."tiorcodigos" = "tipoorgani"."tiorcodigos"'.$sbTmp;
				break;
			case 'segurisocial':
				$sbSql = 'SELECT * FROM "segurisocial" WHERE "sesoactivos"=\''.$sbStatus.'\'';
				break;
			case 'condiusuario':
				$sbSql = 'SELECT * FROM "condiusuario" WHERE "cousactivos"=\''.$sbStatus.'\'';
				break;
			case 'tipoexamen':
				$sbSql = 'SELECT * FROM "tipoexamen" WHERE "tiexactivos"=\''.$sbStatus.'\'';
				break;
			case 'ipsservicio':
				$sbSql = 'SELECT * FROM "ipsservicio" WHERE "ipseactivos"=\''.$sbStatus.'\'';
				break;
			default:
				$sbSql = "";
		}
		$this->objdb->fncadoselect($sbSql);
		return $this->objdb->rcresult;
	}
	/**
	 * Copyright 2006 FullEngine
	 *
	 * Vacea los datos a la tabl temporal
	 * @author creyes
	 * @param type name desc
	 * @return type name desc
	 * @date 24-February-2006 14:22:13
	 * Modified
	 * define si vadidomivals es un arreglo con varios numeros de caso
	 * @date 07-Jun-2010 20:15:00
	 * @author freina<freina@parquesoft.com>
	 * @location Cali-Colombia
	 */
function loadDataIntoTmp($rcDetalleDimension,$tmpTable,$rcReference,$rcCodDimension,$vadidominios=null,$vadidomvals=null){
		
		settype($sbTmp,"string");
		
		$this->_tmpTable = $tmpTable;
		$this->_rcDetalleDimension = $rcDetalleDimension;
		$this->_rcReference = $rcReference;
		$sbInDimensiones = "'".implode("','",$rcCodDimension)."'";
		if($vadidominios){
			$sbDominio = ' AND "valordimension"."vadidominios"=\''.$vadidominios.'\' AND ';
			
			if(is_array($vadidomvals)){
				$sbTmp = "'".implode("','",$vadidomvals)."'";
				$sbDominio .= ' "valordimension"."vadidomivals" IN ('.$sbTmp.') ';
			}else{
				$sbDominio .= '"valordimension"."vadidomivals"=\''.$vadidomvals.'\'';	
			}
		}

		$this->_sql = 'SELECT
                "detalledimens"."dedinombres", 
                "valordimension"."vadidominios", 
                "valordimension"."vadidomivals", 
                "valordimension"."vadivalors" 
            FROM 
                "detalledimens","valordimension"
            WHERE 
                "detalledimens"."dimecodigon" IN ('.$sbInDimensiones.') AND 
                "detalledimens"."dimecodigon" = "valordimension"."dimecodigon" AND 
                "detalledimens"."dedinombres" = "valordimension"."dedinombres" 
                '.$sbDominio.' ORDER BY "detalledimens"."dimecodigon" ASC, "valordimension"."vadidomivals",'.
            '"detalledimens"."dediordenn" ASC ';

		//Se optiene el primer registro para el pl
		$this->objdb->fncadosetmodefetch(FETCH_ASSOC);
		$this->objdb->fncadoexecute($this->_sql);
		if(!$this->objdb->objresult)
		return false;

		$nuRegs = $this->objdb->fncadorowcont();

		//No existen registros
		if(!$nuRegs)
		return true;
		$rcFirst = $this->objdb->fncadofetch();
		$this->_inicialPl = $rcFirst["vadidomivals"];

		//Extrae el ultimo elemnto del detalle
		$nuRegs = sizeof($rcDetalleDimension);
		$rcTmp = $rcDetalleDimension[$nuRegs - 1];
		$this->_lastField = $rcTmp['dedinombres'];
		$method = "_getFunction_".$this->config["database"]["driver"];
		$functionPl = $this->$method();

		//Crea la funcion
		$this->objdb->fncadoexecute($this->_source);
		if(!$this->objdb->objresult)
		return false;

		//Ejecuta la funcion de acuerdo al driver
		switch($this->config["database"]["driver"]){
			case "pgsql":
				$execFunc = "SELECT * FROM \"".$this->_tmpTable."\"()";
				break;
			case "oci8":
				$execFunc = "DECLARE x boolean; BEGIN x:=\"function_".$this->_tmpTable."\"(); END; ";
				break;
			default :
				break;
		}
		
		$this->objdb->fncadoexecute($execFunc);
		if(!$this->objdb->objresult)
		return false;
		return true;
	}
	/**
	 * Copyright 2006 FullEngine
	 *
	 *  Genera un pl para postgres
	 * @author creyes
	 * @param type name desc
	 * @return type name desc
	 * @date 24-February-2006 15:3:5
	 * @location Cali-Colombia
	 */
	function _getFunction_pgsql(){
    
        $this->_sql = str_replace("'","\'",$this->_sql);
        $this->_source = "
            CREATE OR REPLACE FUNCTION \"".$this->_tmpTable."\"() RETURNS bool AS
            \$BODY\$
            DECLARE 
                mviews RECORD;
                ini_index varchar;
                consulta varchar;
                insertar varchar;
            BEGIN 
                consulta := '".$this->_sql."';
            
                ini_index := '".$this->_inicialPl."';
                insertar := 'INSERT INTO \"".$this->_tmpTable."\" VALUES(';
                FOR mviews IN EXECUTE consulta LOOP
                    mviews.vadivalors := REPLACE(mviews.vadivalors,'\\\\','\\\\\\\\');
                    mviews.vadivalors := REPLACE(mviews.vadivalors,'\'','\\\\\\'');
                    IF mviews.vadidomivals = ini_index THEN
                        -- Por si es el ultimo campo
                        IF mviews.dedinombres = '".$this->_lastField."' THEN
                            insertar := insertar || '\'' || mviews.vadivalors || '\'';
                        ELSE
                             insertar := insertar || '\'' || mviews.vadivalors || '\',';
                        END IF;\n";
        
        //Calcula los campos referenciados
        $rcDetalleDimens = $this->ordenarDetDimens();
        foreach($rcDetalleDimens as $rcField){
            $rcReference = $this->_rcReference[$rcField['dedinombres']];
            if(is_array($rcReference)){
                $rcPl[] = "IF mviews.dedinombres = '".$rcField['dedinombres']."' THEN";
                foreach($rcReference as $rcReg){
                    $rcPl[] = "IF mviews.vadivalors = '".$rcReg[0]."' THEN";
                    if($this->_lastField == $rcField['dedinombres'])
                        $rcPl[] = "    insertar := insertar || ',\'".$rcReg[1]."\'';";
                    else
                        $rcPl[] = "    insertar := insertar || '\'".$rcReg[1]."\',';";
                    $rcPl[] = "END IF;";
                }
                $rcPl[] = "END IF;\n";
            }
        }
        if(is_array($rcPl))
            $this->_source .= implode("\n",$rcPl);
        $this->_source .= "ELSE
                        ini_index = mviews.vadidomivals;
                        insertar := insertar || ')';
                        EXECUTE insertar;
                        insertar := 'INSERT INTO \"".$this->_tmpTable."\" VALUES(' || '\'' || mviews.vadivalors || '\',';
                    END IF;
                END LOOP;
                insertar := insertar || ')';
                EXECUTE insertar;
                RETURN true;
            END; 
            \$BODY\$
            LANGUAGE 'plpgsql' VOLATILE";
        
    }
	/**
	 * Copyright 2006 FullEngine
	 *
	 * crea el insert de para los valores de la dimension
	 * @author freina <freina@parquesoft.com>
	 * @param integer $nuDimecodigon entero con el codigo de la dimension
	 * @param string $sbDedinombres Cadena con el nombre del campo dinamico
	 * @param integer $nuVadicodigon Entero con codigo del registro
	 * @param string $sbVadidominios Cadena con los campo dominio del registro
	 * @param string $sbVadidomivals Cadena con el valor que se almacena en el
	 * campo dominio
	 * @param string $sbVadivalors Cadena con el valor a almacenar en la columna
	 * dinamica
	 * @return true or false de acuerdo si los datos de entrada esta vacia o no
	 * @date 27-February-2006 16:23:00
	 * @location Cali-Colombia
	 */
	function addValordimension($nuDimecodigon, $sbDedinombres, $nuVadicodigon,
	$sbVadidominios, $sbVadidomivals, $sbVadivalors) {

		if(($nuDimecodigon && $sbDedinombres && $nuVadicodigon &&
		$sbVadidominios && $sbVadidomivals)){
			$this->_rcSql[] = 'INSERT INTO "valordimension" ("dimecodigon",' .
    			'"dedinombres","vadicodigon","vadidominios","vadidomivals",' .
    			'"vadivalors") VALUES('.$nuDimecodigon.',' .
    			'\''.$sbDedinombres.'\','.$nuVadicodigon.',' .
    			'\''.$sbVadidominios.'\' ,\''.$sbVadidomivals.'\' , \''.$sbVadivalors.'\')'; 
			return true;
		}
		return false;
	}
	/**
	 * Copyright 2006 FullEngine
	 *
	 * crea el insert de para los valores de la dimension
	 * @author freina <freina@parquesoft.com>
	 * @param string $sbVadidominios Cadena con los campo dominio del registro
	 * @param string $sbVadidomivals Cadena con el valor que se almacena en el
	 * campo dominio
	 * @return true or false de acuerdo si los datos de entrada esta vacia o no
	 * @date 27-February-2006 16:23:00
	 * @location Cali-Colombia
	 */
	function deleteValordimension($sbVadidominios, $sbVadidomivals) {


		if(($sbVadidominios && $sbVadidomivals)){
			 
			$this->_rcSql[] = 'DELETE FROM "valordimension" '.
    			'WHERE "vadidominios"=\''.$sbVadidominios.'\' ' .
    			'AND "vadidomivals"=\''.$sbVadidomivals.'\'';
			return true;
		}
		return false;
	}
	/**
	 * Copyright 2006 FullEngine
	 *
	 * Ejecuta las sentencias Sql
	 * @author freina <freina@parquesoft.com>
	 * @return true or false si la transaccion es ok o fallo
	 * @date 27-February-2006 16:23:00
	 * @location Cali-Colombia
	 */
	function executeTransaction() {
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

	function ordenarDetDimens() {
		settype($rcResult,"array");

		foreach ($this->_rcDetalleDimension as $detDimens)
		foreach ($this->FieldList as $field)
		if($detDimens["dedinombres"] == $field)
		$rcResult[] = $detDimens;
		return $rcResult;

	}
	
	//-----------------------------------
	/**
	 * @Copyright 2010 Parquesoft
	 *
	 * Ingresa una registro en la tabla dimension
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function addDimension() {

		settype($sbSql,"string");
		
		extract($this->rcData);
		
		$sbSql='INSERT INTO "dimension" ("dimecodigon","dimedescrips","dimefechcren","dimeusuarios","dimefechupdn")'
		.' VALUES('.$dimecodigon.' ,\''.$dimedescrips.'\','.$dimefechcren.',\''.$dimeusuarios.'\','.$dimefechupdn.')';
		
		//retorna el sql
		if(!$this->executeSql){
			$this->_rcSql[] = $sbSql;
			return;
		}
		
		$this->objdb->fncadoexecute($sbSql);
		if(!$this->objdb->objresult){
			$this->consult = false;	
		}else{
			$this->consult = true;	
		}
	}
	/**
	 * @Copyright 2010 Parquesoft
	 *
	 * Ingresa una registro en la tabla configdimension
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function addConfigdimension() {

		settype($sbSql,"string");
		
		extract($this->rcData);
		
		$sbSql='INSERT INTO "configdimension" ("codicodigon","codidominios","codidomicams","codidomivals","codireglas","codiexclusis","dimecodigon")'
		.' VALUES('.$codicodigon.' ,\''.$codidominios.'\',\''.$codidomicams.'\',\''.$codidomivals.'\',\''.$codireglas.'\',\''.$codiexclusis.'\','.$dimecodigon.')';
		
		//retorna el sql
		if(!$this->executeSql){
			$this->_rcSql[] = $sbSql;
			return;
		}
		
		$this->objdb->fncadoexecute($sbSql);
		if(!$this->objdb->objresult){
			$this->consult = false;	
		}else{
			$this->consult = true;	
		}
	}
	/**
	 * @Copyright 2010 Parquesoft
	 *
	 * Ingresa una registro en la tabla detalledimens
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function addDetalledimens() {

		settype($sbSql,"string");
		
		extract($this->rcData);
		
		$sbSql='INSERT INTO "detalledimens" ("dimecodigon","dedinombres","deditipodats",
							"deditamtips","dediformatos","dediorigens","deditipobjes",
							"dedivalidas","dedinotnulls","dededidefaults","dediordenn","dedijseventos")'
		.' VALUES('.$dimecodigon.' ,\''.$dedinombres.'\',\''.$deditipodats.'\','.$deditamtips.',\''.$dediformatos.'\',
				\''.$dediorigens.'\',\''.$deditipobjes.'\',\''.$dedivalidas.'\',\''.$dedinotnulls.'\',\''.$dededidefaults.'\',
				'.$dediordenn.',\''.$dedijseventos.'\')';
		
		//retorna el sql
		if(!$this->executeSql){
			$this->_rcSql[] = $sbSql;
			return;
		}
		
		$this->objdb->fncadoexecute($sbSql);
		if(!$this->objdb->objresult){
			$this->consult = false;	
		}else{
			$this->consult = true;	
		}
		return $this->consult;
	}
	
	function deleteDetalledimens($dimecodigon,$dedinombres) {

		settype($sbSql,"string");
		
		$sbSql='DELETE FROM "detalledimens" WHERE "dimecodigon"='.$dimecodigon.' AND "dedinombres"=\''.$dedinombres.'\'';
		$this->objdb->fncadoexecute($sbSql);
		if(!$this->objdb->objresult){
			$this->consult = false;	
		}else{
			$this->consult = true;	
		}
		return $this->consult;
	}
	
	function getDimensiones() {
		$sql = 'SELECT * FROM "dimension"';
		$this->objdb->fncadoselect($sql);
		return $this->objdb->rcresult;
	}
	
	function getDetalles($dimecodigon) {
		$sql = 'SELECT * FROM "detalledimens"';
		if($dimecodigon)
			$sql .= ' WHERE "dimecodigon"='.$dimecodigon;
		$sql .= ' ORDER BY "dediordenn"';
			
		$this->objdb->fncadoselect($sql);
		return $this->objdb->rcresult;
	}
	/**
	 * Copyright 2011 FullEngine
	 *
	 *  Genera un pl para oracle
	 * @author freina <freina@fullengine.com>
	 * @param type name desc
	 * @return type name desc
	 * @date 02-Aug-2011 16:53
	 * @location Cali-Colombia
	 */
	function _getFunction_oci8(){
    
        $this->_source = "
            CREATE OR REPLACE FUNCTION \"function_".$this->_tmpTable."\" RETURN boolean AS
                ini_index VARCHAR2(250);
                CURSOR consulta IS ".$this->_sql.";
                mviews consulta%ROWTYPE;
                insertar VARCHAR2(500);
            BEGIN
                ini_index := '".$this->_inicialPl."';
                insertar := 'INSERT INTO \"".$this->_tmpTable."\" VALUES(';
                FOR mviews IN consulta LOOP
                	 mviews.\"vadivalors\" := REPLACE(mviews.\"vadivalors\", '''', ''''''); 
                    IF mviews.\"vadidomivals\" = ini_index THEN
                        IF mviews.\"dedinombres\" = '".$this->_lastField."' THEN
                            insertar := insertar || '''' || mviews.\"vadivalors\" || '''';
                        ELSE
                             insertar := insertar || '''' || mviews.\"vadivalors\" || ''', ';
                        END IF;
                        ";
        
        //Calcula los campos referenciados
        $rcDetalleDimens = $this->ordenarDetDimens();
        foreach($rcDetalleDimens as $rcField){
            $rcReference = $this->_rcReference[$rcField['dedinombres']];
            if(is_array($rcReference)){
                $rcPl[] = "IF mviews.\"dedinombres\" = '".$rcField['dedinombres']."' THEN";
                foreach($rcReference as $rcReg){
                    $rcPl[] = "IF mviews.\"vadivalors\" = '".$rcReg[0]."' THEN";
                    if($this->_lastField == $rcField['dedinombres'])
                        $rcPl[] = "    insertar := insertar || ',''".$rcReg[1]."''';";
                    else
                        $rcPl[] = "    insertar := insertar || '''".$rcReg[1]."'',';";
                    $rcPl[] = "END IF;";
                }
                $rcPl[] = "END IF;";
            }
        }
        if(is_array($rcPl))
            $this->_source .= implode("\n",$rcPl);
        $this->_source .= "ELSE
                        ini_index := mviews.\"vadidomivals\";
                        insertar := insertar || ')';
                        EXECUTE IMMEDIATE insertar;
                        insertar := 'INSERT INTO \"".$this->_tmpTable."\" VALUES(' || '''' || mviews.\"vadivalors\" || ''', ';
                    END IF;
                END LOOP;
                insertar := insertar || ')';
                EXECUTE IMMEDIATE insertar;
                RETURN true;
            END; "; 
    }
}
?>