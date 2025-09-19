<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");

class FeHrPgsqlSqlExtended {
	var $consult;
	var $objdb;
	function FeHrPgsqlSqlExtended() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Hace la consulta para los combobox
	* @param string $sqlId 
	* @return array
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 23-oct-2004 13:10:41
	* @location Cali-Colombia
	*/
	function getDataCombo($sqlId,$rcExtra=null) {
		
		settype($objtmp, "object");
		settype($rctmp, "array");
		settype($sbtmp, "string");
		
		switch ($sqlId) {
			case "organizacion" :
				$objtmp = Application :: loadServices("General");
				$rctmp = $objtmp->getParam("human_resources", "ORG_INACT");
				$sbtmp = "'".implode("','",$rctmp)."'";
				$sql = 'SELECT * FROM "organizacion" WHERE "esorcodigos" NOT IN ('.$sbtmp.' )';
				break;
			case "organizacionE" :
				$objtmp = Application :: loadServices("General");
				$rctmp = $objtmp->getParam("human_resources", "ORG_INACT");
				$sbtmp = "'".implode("','",$rctmp)."'";
				$sql = 'SELECT * FROM "organizacion" WHERE "orgacodigos" <> \''.$rcExtra[0].'\' AND "esorcodigos" NOT IN ('.$sbtmp.' )';
				break;
			case "cargo" :
				$recAct = Application :: getConstant("REG_ACT");
				$sql = 'SELECT * FROM "cargo" WHERE "cargactivas"=\''.$recAct.'\'';
				break;
			case "personal" :
				$sbestado = Application :: getConstant("REG_ACT");
				$sql = 'SELECT * FROM "personal" WHERE "persestadoc"=\''.$sbestado.'\' ORDER BY "persnombres"';
				break;
			case "auth_personal" :
				$sbestado = Application :: getConstant("REG_ACT");
				$sql = 'SELECT * FROM "personal" WHERE "persusrnams" IS NOT NULL AND "persestadoc"=\''.$sbestado.'\' ORDER BY "persusrnams"';
				break;
			case "grupo" :
				$objtmp = Application :: loadServices("General");
				$rctmp = $objtmp->getParam("human_resources", "EST_GRUP_INA");
				$sbtmp = "'".implode("','",$rctmp)."'";
				$sql = 'SELECT * FROM "grupo" WHERE "esgrcodigos" NOT IN ('.$sbtmp.') ORDER BY "grupnombres"';
				break;
			case "tipoorgani" :
				$sbestado = Application :: getConstant("REG_ACT");
				$sql = 'SELECT * FROM "tipoorgani" WHERE "tioractivos"=\''.$sbestado.'\' ORDER BY "tiornombres"';
				break;
			case "estadoorgani" :
				$sbestado = Application :: getConstant("REG_ACT");
				$sql = 'SELECT * FROM "estadoorgani" WHERE "esoractivas"=\''.$sbestado.'\' ORDER BY "esornombres"';
				break;
			case "agentes" :
				$sbestado = Application :: getConstant("REG_ACT");
				$sql = 'SELECT rpad("perscodigos",4,\' \')||\' - \'||"persnombres"||\' \'||"persapell1s" as "authnombres2",* FROM "personal" WHERE "persusrnams" IS NOT NULL AND "persestadoc"=\''.$sbestado.'\' ORDER BY "persusrnams"';
				break;
		}
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Busca todo el personal de un ente organizacional y tambien de sus entes hijos
	* @param string $orgacodigos 
	* @return array
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 29-nov-2004 13:30:52
	* @location Cali-Colombia
	*/
	function getpersonalByOrganizacion($orgacodigos){
		if(!$orgacodigos)
			return null;
		$sbestado = Application :: getConstant("REG_ACT");
		//consulta 
		$sql = 'SELECT 
					"personal"."perscodigos",
					"personal"."persidentifs",
					"personal"."persnombres",
					"personal"."persapell1s",
					"personal"."persapell2s",
					"personal"."persusrnams",
					"personal"."cargcodigos",
					"personal"."persprofecs",
					"personal"."perstelefo1",
					"personal"."perstelefo2",
					"personal"."persdireccis",
					"personal"."persemails",
					"personal"."perscontacts",
					"personal"."perstelcont"
				FROM 
					"organizacion","grupodetalle","personal" 
				WHERE 
					"organizacion"."orgacodigos" IN (SELECT 
													"orgacodigos" 
												FROM 
													"organizacion" 
												WHERE 
													"orgacgpads"=\''.$orgacodigos.'\' OR "orgacodigos"=\''.$orgacodigos.'\') AND 
					"organizacion"."grupcodigos"="grupodetalle"."grupcodigon" AND 
					"grupodetalle"."perscodigos"="personal"."perscodigos" AND
					"personal"."persestadoc"=\''.$sbestado.'\'
					ORDER BY "personal"."persnombres"';	
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Obtine la lista de los entes organizacionales activos
	* @param datatype Name desc
	* @return datatype Name desc
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 25-oct-2004 11:56:00
	* @location Cali-Colombia
	*/
	function getActiveEntesOrg() {
		
		settype($objtmp, "object");
		settype($rctmp, "array");
		settype($sbtmp, "string");
		
		$objtmp = Application :: loadServices("General");
		$rctmp = $objtmp->getParam("human_resources", "ORG_INACT");
		$sbtmp = "'".implode("','",$rctmp)."'";
		$sql = 'SELECT * FROM "organizacion" WHERE "esorcodigos" NOT IN ('.$sbtmp.' ) ORDER BY "orgaordenn"';
		$this->objdb->fncadoselect($sql);
		return $this->objdb->rcresult;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Trae el grupo activo en un ente organizacional
	* @param string $isborgacodigos
	* @return array
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 10-nov-2004 14:39:11
	* @location Cali-Colombia
	*/
	function getActiveGroup($orgacodigos) {
		settype($sbEstado,"string");
		$sbEstado = Application :: getConstant("REG_ACT");
		$objtmp = Application :: loadServices("General");
        $rctmp = $objtmp->getParam("human_resources", "EST_GRUP_INA");
		$sbtmp = "'".implode("','",$rctmp)."'";
		$sql = 'SELECT
							"grupo"."grupcodigon",
							"grupo"."grupcodigos",	 
							"grupo"."grupnombres",	 
							"grupo"."esgrcodigos",	 
							"grupo"."grupfchainin",	 
							"grupo"."grupfchafinn",	 
							"grupo"."grupactivos"	 
						FROM "organizacion","grupo"
						WHERE
							 "organizacion"."orgacodigos"=\''.$orgacodigos.'\' AND
							 "organizacion"."grupcodigos"="grupo"."grupcodigos" AND
							 "grupo"."esgrcodigos" NOT IN ('.$sbtmp.') ' .
							' AND "grupo"."grupactivos"=\''.$sbEstado.'\'';
		$this->objdb->fncadoselect($sql);
		return $this->objdb->rcresult;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Consulta el grupo detalle
	* @param integer $grupcodigon 
	* @return array
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 10-nov-2004 15:45:12
	* @location Cali-Colombia
	*/
	function getGrupodetalle($grupcodigon) {
		$sql = 'SELECT 
					"grupodetalle"."grupcodigon",
					"grupodetalle"."perscodigos",
					"grupodetalle"."persrespons",
					"personal"."perscodigos",
					"personal"."persidentifs",
					"personal"."persnombres",
					"personal"."persapell1s",
					"personal"."persapell2s"
				FROM "grupodetalle","personal"  
				WHERE
					"grupodetalle"."grupcodigon"=\''.$grupcodigon.'\' AND
					"grupodetalle"."perscodigos"="personal"."perscodigos"
				ORDER BY
					"grupodetalle"."persrespons"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function ComunicacionTrans($ircdata) {
		if (!$ircdata) {
			$this->consult = false;
		}
		$this->objdb->fncadoexecutetrans($ircdata);
		if (!$this->objdb->objresult) {
			$this->consult = false;
		} else {
			$this->consult = true;
		}
	}
	
	/**
	Copyright 2004 FullEngine
	 Obtiene los grupos en donde el empleado es el responsable
	@param string perscodigos Codigo del empleado
	@param string persrespons Bandera que indica si el empleado es el responsable 
	@author freina <freina@parquesoft.com>
	@date 13-nov-2004 19:51
	@location Cali - Colombia
	*/
	function getAllGroupsByOrderedEmployee($perscodigos,$persrespons) {
		settype($sbEstado,"string");
		$sbEstado = Application :: getConstant("REG_ACT");
		$objtmp = Application :: loadServices("General");
        $rctmp = $objtmp->getParam("human_resources", "EST_GRUP_INA");
		$sbtmp = "'".implode("','",$rctmp)."'";
    
		$sql = 'SELECT "grupo"."grupcodigos" 
		FROM "grupo","grupodetalle" 
		WHERE "perscodigos"=\''.$perscodigos.'\' 
		AND "persrespons"=\''.$persrespons.'\' 
		AND "grupo"."grupcodigon"="grupodetalle"."grupcodigon" 
		AND "grupo"."esgrcodigos" NOT IN ('.$sbtmp.') ' .
		'AND "grupo"."grupactivos"=\''.$sbEstado.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
    /**
    * Copyright 2005 FullEngine
    *
    * Genera un sql generico 
    * @author creyes
    * @param string $table
    * @return string
    * @date 29-August-2005 14:0:51
    * @location Cali-Colombia
    */
    function getGenericSql($table, $viewfields='*'){
        
        settype($rcTmp,"array");
        settype($rcTables,"array");
        settype($rcFields,"array");
        settype($sbValue,"string");
        settype($sbPos,"string");
        
        if($table){
        	$rcTmp = explode(",",$table);
			foreach ($rcTmp as $sbValue) {
				//analiza si es tabla.campo
				$sbPos = strpos($sbValue, ".");
				if (!($sbPos === false)) {
					$sbValue = preg_replace("#((([a-z]|[0-9])*)\.(([a-z]|[0-9])*))#", '"$2"."$4"', $sbValue);
				} else {
					$sbValue = '"'.$sbValue.'"';
				}
				$rcTables[] = $sbValue; 
			}
			$table = implode(",",$rcTables);
        }else{
        	return null;
        }
            
       
       if ($fields_view !='*'){
			$rcTmp = explode(",",$fields_view);
			foreach ($rcTmp as $sbValue) {
				//analiza si es tabla.campo
				$sbPos = strpos($sbValue, ".");
				if (!($sbPos === false)) {
					$sbValue = preg_replace("#((([a-z]|[0-9])*)\.(([a-z]|[0-9])*))#", '"$2"."$4"', $sbValue);
				} else {
					$sbValue = '"'.$sbValue.'"';
				}
				$rcFields[] = $sbValue; 
			}
			$fields_view = implode(",",$rcFields);
		}
		return $sbsql = "SELECT $viewfields FROM $table";
        
    }
    /**
    * Copyright 2005 FullEngine
    *
    * Inserta los filtros en un sql
    * @author creyes
    * @param string $sql
    * @param array $rcFilter
    * @return string
    * @date 29-August-2005 14:0:51
    * @location Cali-Colombia
    */
    function setFilterSql($sql, $rcFilter=null){
    	
    	settype($sbPos,"string");
    	
        if(!$sql)
            return null;
        if(!is_array($rcFilter) || !$rcFilter)
            return $sql;
            
        foreach($rcFilter as $field => $value){
        	//-----------------------
        	//analiza si es tabla.campo
			$sbPos = strpos($field, ".");
			if (!($sbPos === false)) {
				$field = preg_replace("#((([a-z]|[0-9])*)\.(([a-z]|[0-9])*))#", '"$2"."$4"', $field);
			} else {
				$field = '"'.$field.'"';
			}
        	//---------------------------
            $rcTmp[] = "$field='$value'";
        }
        if(stripos($sql,'WHERE')===false)
            $sbWere = " WHERE ".implode(" AND ",$rcTmp);
        else $sbWere = " AND ".implode(" AND ",$rcTmp);
		return "$sql $sbWere";
    }    
    /**
    * @copyright Copyright 2004 &copy; FullEngine
	*
	*  Contiene los SQL de las listas despleglables
	* @param string $id Identificador del sql
	* @return string SQL
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 01-oct-2004 16:20:03
	* @location Cali-Colombia
	*/
	function getSqlConsult($id){
        settype($sbEstate,"string");
        $sbEstate = Application :: getConstant("REG_ACT");
		switch($id){
				case "organizacion":
					$sql = 'SELECT ' .
								'"organizacion"."orgacodigos",' .
								'"organizacion"."organombres",' .
								'"tipoorgani"."tiornombres" AS "tiorcodigos",' .
								'"estadoorgani"."esornombres" AS "esorcodigos",' .
								'"grupo"."grupnombres" AS "grupcodigos" ' .
							'FROM "organizacion" LEFT JOIN "tipoorgani" ON ("organizacion"."tiorcodigos"="tipoorgani"."tiorcodigos")
												 LEFT JOIN "estadoorgani" ON ("organizacion"."esorcodigos"="estadoorgani"."esorcodigos"),"grupo" ' .
							'WHERE  "organizacion"."grupcodigos"="grupo"."grupcodigos" AND'.
                                     '"grupo"."grupactivos"=\''.$sbEstate.'\'';
				break;
			case "personal":
				$sql = 'SELECT "personal"."perscodigos",' .
								'"personal"."persidentifs",' .
								'"personal"."persnombres",' .
								'"personal"."persapell1s",' .
								'"personal"."persapell2s",' .
								'"personal"."persusrnams",' .
								'"cargo"."cargnombres" AS "cargcodigos" ' .
						'FROM "personal" LEFT JOIN "cargo" ON ("personal"."cargcodigos"="cargo"."cargcodigos")';
				break;
				case "grupo":
					$sql = 'SELECT ' .
							'"grupo"."grupcodigon",' .
							'"grupo"."grupcodigos",' .
							'"grupo"."grupnombres",' .
							'"estadogrupo"."esgrnombres" AS "esgrcodigos",' .
							'"grupo"."grupfchainin" ' .
						'FROM "grupo" LEFT JOIN "estadogrupo" ON ("grupo"."esgrcodigos"="estadogrupo"."esgrcodigos")';
				break;
			default: $sql = null;
		}	
		return $sql;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Contiene y ejecuta SQL
	* @param string $sqlId Identificador del sql
	* @return array $rcParams Vector con los parametros.
	* @author freina <freina@parquesoft.com>
	* @date 06-Sep-2005 17:15
	* @location Cali-Colombia
	*/
	function getAutoReference($sqlId, $rcParams = null) {
		settype($objService,"object");
		settype($rcTmp,"array");
		settype($orcResult,"array");
		settype($sbestado,"string");
		$sbestado = Application :: getConstant("REG_ACT");
		switch ($sqlId) {
			case "localizacion" : 
				$objService = Application :: loadServices("General");
				$rcTmp =  $objService->getByIdLocalizacion($rcParams["locacodigos"][0]);
				$orcResult[0][0] =$rcTmp[0]["locanombres"];
				return $orcResult;
				break;
			case "organizacion" : 
				$objService = Application :: loadServices("General");
				$rcTmp = $objService->getParam("human_resources", "ORG_INACT");
				$objGateway = Application :: getDataGateway("organizacionExtended");
				$rcTmp = $objGateway->getOrganizacionActiveByOrgacodigos($rcParams["orgacodigos"][0], $rcTmp);
				$orcResult[0][0] = $rcTmp[0]["organombres"];
				return $orcResult;
				break;
			case "personal" :
				$sql = 'SELECT "persnombres","persapell1s","persapell2s" FROM "personal" WHERE "perscodigos"=\''.$rcParams["perscodigos"][0].'\''; 
				$this->objdb->fncadoselect($sql);
				if(!is_array($this->objdb->rcresult))
					return null;
				$rcResult[0][0] = $this->objdb->rcresult[0]['persnombres']." ".
											 $this->objdb->rcresult[0]['persapell1s']." ".
											 $this->objdb->rcresult[0]['persapell2s'];
				return $rcResult;
			default :
				return null;
		}
		$this->objdb->fncadoselect($sql);
		return $this->objdb->rcresult;
	}

	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Consulta los nombres de usuario asignados en el personal
	* @return array
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 10-nov-2004 15:45:12
	* @location Cali-Colombia
	*/
	function getuserNameInPersonal() {
		$sql = 'SELECT "persusrnams" FROM "personal" WHERE "persusrnams" IS NOT NULL OR "persusrnams" != \'\' ORDER BY "persusrnams"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Obtiene el responsable del grupo
	* @param integer $nuGrupcodigon 
	* @return array
	* @author freina<freina@parquesoft.com>
	* @date 08-Apr-2006 16:30
	* @location Cali-Colombia
	*/
	function getOrderedByGrupo($nuGrupcodigon) {
		
		settype($sbSql,"string");
		settype($sbState,"string");
		
		$sbState = Application :: getConstant("GRUP_RESP");
		$sbSql = 'SELECT "personal"."perscodigos","personal"."persidentifs",' .
				'"personal"."persnombres","personal"."persapell1s",' .
				'"personal"."persapell2s","personal"."persemails" ' .
				'FROM "grupodetalle","personal" ' .
				'WHERE "grupodetalle"."grupcodigon"=\''.$nuGrupcodigon.'\' AND ' .
				'"grupodetalle"."persrespons"=\''.$sbState.'\' AND ' .
				'"grupodetalle"."perscodigos"="personal"."perscodigos" ';
		$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
    /**
    * @copyright Copyright 2004 &copy; FullEngine
	*
	*  Contiene los SQL de las listas despleglables
	* @param string $id Identificador del sql
	* @return string SQL
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 01-oct-2004 16:20:03
	* @location Cali-Colombia
	*/
	function getSqlHelp($id){
		switch($id){
			case "personal":
				$recAct = Application :: getConstant("REG_ACT");
				$sql = 'SELECT "personal"."perscodigos",' .
								'"personal"."persidentifs",' .
								'"personal"."persnombres",' .
								'"personal"."persapell1s",' .
								'"personal"."persapell2s",' .
								'"personal"."persusrnams",' .
								'"cargo"."cargnombres" AS "cargcodigos" ' .
						'FROM "personal","cargo"' .
						' WHERE ' .
							'"personal"."cargcodigos"="cargo"."cargcodigos"';
				break;
		}	
		return $sql;
	}
  	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Obtiene el responsable del grupo
	* @param integer $nuGrupcodigon 
	* @return array
	* @author freina<freina@parquesoft.com>
	* @date 08-Apr-2006 16:30
	* @location Cali-Colombia
	*/
	function getOrgacodigosByPersonal($isbPerscodigos,$blTipo=true) 
	{
		settype($sbSql,"string");
		$sbState = Application :: getConstant("GRUP_RESP");
		
		$sbSql = 'SELECT "organizacion"."*"'.
				' FROM "grupodetalle","personal","organizacion", "grupo"'.
				' WHERE "grupo"."grupcodigos"="organizacion"."grupcodigos"' .
				' AND "grupodetalle"."grupcodigon"="grupo"."grupcodigon"' .
				' AND "grupodetalle"."perscodigos"="personal"."perscodigos"' .
				//' AND "grupodetalle"."persrespons"=\''.$sbState.'\'' .
				' AND "personal"."perscodigos"=\''.$isbPerscodigos.'\'';
		$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function saveLogRotacion($oldorgacodigos ,$neworgacodigos,$neworganombres,$oldorgacodpads,$neworgacodpads,$ordenestopadres, $ordenesneworgs,$logrfechorregn,$authusernames) {
		
		$sql = 'INSERT INTO "logrotacion" ("oldorgacodigos","neworgacodigos","neworganombres","oldorgacodpads","neworgacodpads","ordenestopadres","ordenesneworgs","logrfechorregn","authusernames")'
		.' VALUES(\''.$oldorgacodigos.'\',\''.$neworgacodigos.'\',\''.$neworganombres.'\',\''.$oldorgacodpads.'\',\''.$neworgacodpads.'\' ,\''.$ordenestopadres.'\',\''.$ordenesneworgs.'\','.$logrfechorregn.',\''.$authusernames.'\')';

		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
		return $this->consult;
	}
}
?>