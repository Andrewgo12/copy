<?php     
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeGePgsqlSqlExtended {
	var $consult;
	var $objdb;
	function FeGePgsqlSqlExtended() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}

	function getAllEmailSql($ircdata) {
		settype($sbwhere, "string");
		settype($sbfrom, "string");

		if ($ircdata["ordenumeros"]) {
			$sbwhere = " \"email\".\"ordenumeros\"='".$ircdata["ordenumeros"]."'";
		}
		if ($ircdata["orgacodigos"]) {
			if($sbwhere){
				$sbwhere .= " AND \"organizacion\".\"orgacodigos\"='".$ircdata["orgacodigos"]."'";
			}else{
				$sbwhere = " \"organizacion\".\"orgacodigos\"='".$ircdata["orgacodigos"]."'";
			}
		}
		if ($ircdata["emaiestados"]) {
			if($sbwhere){
				$sbwhere .= " AND \"email\".\"emaiestados\"='".$ircdata["emaiestados"]."'";
			}else{
				$sbwhere = " \"email\".\"emaiestados\"='".$ircdata["emaiestados"]."'";
			}
		}
		if ($ircdata["foemcodigos"]) {
			if($sbwhere){
				$sbwhere .= " AND \"email\".\"foemcodigos\"='".$ircdata["foemcodigos"]."'";
			}else{
				$sbwhere = " \"email\".\"foemcodigos\"='".$ircdata["foemcodigos"]."'";
			}
		}
		if ($ircdata["ordefecregdi"] && $ircdata["ordefecregdf"]) {
			$sbfrom = ", \"orden\"";
			if($sbwhere){
				$sbwhere .= " AND \"orden\".\"ordenumeros\"=\"email\".\"ordenumeros\" AND \"orden\".\"ordefecregd\" BETWEEN ".$ircdata["ordefecregdi"]." AND ".$ircdata["ordefecregdf"];
			}else{
				$sbwhere = " \"orden\".\"ordenumeros\"=\"email\".\"ordenumeros\" AND \"orden\".\"ordefecregd\" BETWEEN ".$ircdata["ordefecregdi"]." AND ".$ircdata["ordefecregdf"];
			}
		}
		$sbsql = 'SELECT "email"."emaicodigos","email"."ordenumeros",' .
				'"organizacion"."organombres" AS "orgacodigos","email"."emaiparas","email"."emaiasuntos",' .
				'"formatoemail"."foemnombres" as "foemcodigos","email"."emaiestados"'.
				' FROM "email" LEFT JOIN "organizacion" ON ("email"."orgacodigos"="organizacion"."orgacodigos")' .
				' LEFT JOIN "formatoemail" ON ("email"."foemcodigos"="formatoemail"."foemcodigos") '
				.$sbfrom.' WHERE '.$sbwhere;
		
		return $sbsql;
	}

	function getAllComunicacionSql($ircdata) {

		settype($sbtmp, "string");
		settype($sbfrom, "string");

		if ($ircdata["ordenumeros"]) {
			$sbtmp = " AND \"comunicacion\".\"ordenumeros\"='".$ircdata["ordenumeros"]."'";
		}
		if ($ircdata["focacodigos"]) {
			$sbtmp .= " AND \"formatocarta\".\"focacodigos\"='".$ircdata["focacodigos"]."'";
		}
		if ($ircdata["comuestados"]) {
			$sbtmp .= " AND \"comunicacion\".\"comuestados\"='".$ircdata["comuestados"]."'";
		}
		if ($ircdata["ordefecregdi"] && $ircdata["ordefecregdf"]) {
			$sbfrom = ", \"orden\"";
			$sbtmp .= " AND \"orden\".\"ordenumeros\"=\"comunicacion\".\"ordenumeros\" AND \"orden\".\"ordefecregd\" BETWEEN ".$ircdata["ordefecregdi"]." AND ".$ircdata["ordefecregdf"];
		}
		$sbsql = 'SELECT "comunicacion"."comucodigos","comunicacion"."ordenumeros","formatocarta"."focanombres" AS "focacodigos", "comunicacion"."comuasuntos","comunicacion"."comuestados"'.' FROM "comunicacion", "formatocarta" '.$sbfrom.' WHERE "comunicacion"."focacodigos"="formatocarta"."focacodigos" '.$sbtmp;
		return $sbsql;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Hace la consulta para los combobox
	* @param string $sqlId
	* @param array $ircParams Arreglo con parametros para la consulta
	* @return array
	* @author freina <freina@parquesoft.com>
	* @date 25-oct-2004 11:22
	* @location Cali-Colombia
	*/
	function getDataCombo($sqlId,$ircParams=null) {
		
		settype($orcResult,"array");
		settype($rcReg,"array");
		settype($sbSql,"string");
		settype($sbEstado,"string");
		settype($nuKey,"integer");
		
		$sbEstado = Application :: getConstant("REG_ACT");
		switch ($sqlId) {
			case "formatocarta" :
				$sbSql = 'SELECT * FROM "formatocarta" WHERE "focaestados"=\''.$sbEstado.'\'';
				break;
			case "formatoemail" :
				$sbSql = 'SELECT * FROM "formatoemail" WHERE "foemestados"=\''.$sbEstado.'\'';
				break;
			case "tipoarchivo" :
				$sbSql = 'SELECT * FROM "tipoarchivo" WHERE "tiarestados"=\''.$sbEstado.'\'';
				break;
			case "tipolocaliza" :
			
				if(!$ircParams[0]){
					$sbSql = 'SELECT "tipolocaliza"."tilocodigos","tipolocaliza"."tilonombres","tipolocaliza"."tiloestados" FROM "tipolocaliza" ';
					$sbSql .= ' WHERE "tilocodpadrs" IS NULL ORDER BY "tipolocaliza"."tilonombres"';
				}
				else{
					$sbSql = 'SELECT "tipolocaliza"."tilocodigos","tipolocaliza"."tilonombres","tipolocaliza"."tiloestados" FROM "tipolocaliza","localizacion" ';
					$sbSql .= ' WHERE "localizacion"."locacodigos"=\''.$ircParams[0];
					$sbSql .='\'  AND "localizacion"."tilocodigos"="tipolocaliza"."tilocodpadrs" ORDER BY "tipolocaliza"."tilonombres"';
				}
				
                $this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
                foreach($this->objdb->rcresult as $nuKey => $rcReg){
                    $orcResult[$nuKey] = $rcReg;
                    $orcResult[$nuKey]["tilonombres"] = $rcReg["tilonombres"]." (".$rcReg["tiloestados"].")";
                }
                return $orcResult;
           	case "tipolocalizaall" :
			
				$sbSql = 'SELECT "tipolocaliza"."tilocodigos","tipolocaliza"."tilonombres","tipolocaliza"."tilocodpadrs","tipolocaliza"."tiloestados" FROM "tipolocaliza" ORDER BY "tipolocaliza"."tilonombres"';
				
                $this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
                foreach($this->objdb->rcresult as $nuKey => $rcReg){
                    $orcResult[$nuKey] = $rcReg;
                    $orcResult[$nuKey]["tilonombres"] = $rcReg["tilonombres"]." (".$rcReg["tiloestados"].")";
                }
                return $orcResult;
			case "localizacion" :
				if($ircParams[0]===null){
					$sbSql = 'SELECT * FROM "localizacion" ORDER BY "locanombres"';
				}
				else{
					if($ircParams[0]){
						$sbSql = 'SELECT * FROM "localizacion" WHERE "locacodigos"=\''.$ircParams[0].'\' ORDER BY "locanombres"';
						$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
						if($this->objdb->rcresult){
							$rcReg = $this->objdb->rcresult;
							if($rcReg[0]["locacodpadrs"]){
								$sbSql = 'SELECT * FROM "localizacion" WHERE "locacodpadrs"=\''.$rcReg[0]["locacodpadrs"].'\' ';
								$sbSql .='  AND "tilocodigos"=\''.$rcReg[0]["tilocodigos"].'\' ORDER BY "locanombres"';
							}else{
								$sbSql = 'SELECT * FROM "localizacion" WHERE "locacodpadrs" IS NULL ';
								$sbSql .='  AND "tilocodigos"=\''.$rcReg[0]["tilocodigos"].'\' ORDER BY "locanombres"';
							}
						}
					}
				}
				$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
				if($this->objdb->rcresult){
					foreach($this->objdb->rcresult as $nuKey => $rcReg){
                    	$orcResult[$nuKey] = $rcReg;
                    	$orcResult[$nuKey]["locanombres"] = $rcReg["locanombres"]." (".$rcReg["locaestados"].")";
                	}
				}
                return $orcResult;
		}
		$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Contiene y ejecuta SQL
	* @param string $sqlId Identificador del sql
	* @return array $rcParams Vector con los parametros.
	* @author freina <freina@parquesoft.com>
	* @date 05-Nov-2004 13:28
	* @location Cali-Colombia
	*/
	function getAutoReference($sqlId, $rcParams = null) {
		
		settype($objservice,"object");
		settype($objGateway, "object");
		settype($rcTmp,"array");
		settype($orcResult,"array");
		settype($sbestado,"string");
		$sbestado = Application :: getConstant("REG_ACT");
		switch ($sqlId) {
			case "style" :
				//Carga el servicio del profiles
				$profileServices = Application :: loadServices("Profiles");
				return $profileServices->getByStyleByAppl($rcParams[0]);
			case "tipoorden" :
				$objservice = Application :: loadServices("Cross300");
				return $objservice->getDataActiveTipoorden($rcParams["tiorcodigos"][0]);
				break;
			case "evento" :
				$objservice = Application :: loadServices("Cross300");
				return $objservice->getDataActiveEvento($rcParams["tiorcodigos"][0],$rcParams["evencodigos"][0]);
				break;
			case "estadoacta" :
				$objservice = Application :: loadServices("Workflow");
				return $objservice->getDataActiveEstadoacta($rcParams["esaccodigos"][0]);
				break;
			case "causa" :
				$objservice = Application :: loadServices("Cross300");
				return $objservice->getDataActiveCausa($rcParams["tiorcodigos"][0],$rcParams["evencodigos"][0],$rcParams["causcodigos"][0]);
				break;
			case "organizacion" : 
				$objService = Application :: loadServices("General");
				$rcTmp = $objService->getParam("human_resources", "ORG_INACT");
				$objService = Application :: loadServices("Human_resources");
				$objGateway = $objService->getGateWay("organizacionExtended");
				$rcTmp = $objGateway->getOrganizacionActiveByOrgacodigos($rcParams["orgacodigos"][0], $rcTmp);
				$objService->close();
				$orcResult[0][0] = $rcTmp[0]["organombres"];
				return $orcResult;
				break;
			default :
				return null;
		}
		$this->objdb->fncadoselect($sql);
		return $this->objdb->rcresult;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	*  Contiene los SQL de las listas despleglables
	* @param string $sbid Identificador del sql
	* @param string $rcparams arreglo con los parametros de consulta
	* @return string SQL
	* @author freina <freina@parquesoft.com>
	* @date 12-Ene-2005 14:11
	* @location Cali-Colombia
	*/
	function getSqlHelp($isbid,$rcparams=null) {
		
		settype($objservice,"object");
		settype($osbsql,"string");
		switch ($isbid) {
			case "tipoorden" :
				$objservice = Application :: loadServices("Cross300");
				$osbsql = $objservice->getSqlActiveTipoorden();
				break;
			case "evento" :
				$objservice = Application :: loadServices("Cross300");
				$osbsql = $objservice->getSqlActiveEvento($rcparams["tiorcodigos"]);
				break;
			case "estadoacta" :
				$objservice = Application :: loadServices("Workflow");
				$osbsql = $objservice->getSqlActiveEstadoacta();
				break;
			case "causa" :
				$objservice = Application :: loadServices("Cross300");
				$osbsql = $objservice->getSqlActiveCausa($rcparams["tiorcodigos"],$rcparams["evencodigos"]);
				break;
		}
		return $osbsql;
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
    function setFilterSql($sbSql, $rcFilter=null){
    	
    	settype($rcTable,"array");
    	settype($rcTmp,"array");
    	settype($sbPos,"string");
    	settype($sbTable,"string");
    	settype($sbFieldC,"string");
    	settype($sbField,"string");
    	settype($sbValue,"string");
    	settype($sbWere,"string");
    	
        if(!$sbSql){
        	return null;
        }
            
        if(!is_array($rcFilter)|| !$rcFilter){
        	return $sbSql;
        }
        
        foreach($rcFilter as $sbField => $sbValue){
        	
        	//analiza si es tabla.campo
			$sbPos = strpos($sbField, ".");
			if (!($sbPos === false)) {
				$sbTable = substr($sbField,0,($sbPos));
				$sbFieldC = strtoupper(substr($sbField,($sbPos+1)));
				$sbField = preg_replace("#((([a-z]|[0-9])*)\.(([a-z]|[0-9])*))#", '"$2"."$4"', $sbField);
			} else {
				$sbField = '"'.$sbField.'"';
			}
        	
        	//Se obtiene el metamodelo
        	if($sbTable){
        		$this->objdb->fncadometacolumns($sbTable);
        		$rcTable = $this->objdb->rcresult;
        		if(in_array($rcTable[$sbFieldC]->type,$this->objdb->rcType_to_Like)){
        			$this->objdb->setField($sbField);
					$this->objdb->setValue($sbValue);
					$rcTmp[] = $this->objdb->fncadogetlike();
        		}else{
        			$rcTmp[] = "$sbField='$sbValue'";
        		}
        	}else{
        		$rcTmp[] = "$sbField='$sbValue'";
        	}
            
        }
        if(stripos($sbSql,'WHERE')===false)
            $sbWere = " WHERE ".implode(" AND ",$rcTmp);
        else 
        	$sbWere = " AND ".implode(" AND ",$rcTmp);
        if((strpos($sbSql,'"A".')!==false) && (strpos($sbSql,'"B".')!==false))
        	$sbWere = str_replace("localizacion","A",$sbWere);
		return "$sbSql $sbWere";
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
		switch($id){
			case "configarchiv":
				$sql = 'SELECT ' .
							'"configarchiv"."cogacodigos",' .
							'"configarchiv"."coganombres",' .
							'"tipoarchivo"."tiarnombres" AS "tiarcodigos" ' .
						'FROM "configarchiv","tipoarchivo" ' .
						'WHERE ' .
							'"configarchiv"."tiarcodigos"="tipoarchivo"."tiarcodigos"';
			break;
			case "localizacion":
				$sql = 'SELECT ' .
							'"localizacion"."locacodigos",' .
							'"localizacion"."locanombres",' .
							'"tipolocaliza"."tilonombres" AS "tilocodigos",' .
							'"localizacion"."locacodpadrs",' .
							'"localizacion"."locaestados" ' .
						'FROM "localizacion","tipolocaliza" ' .
						'WHERE ' .
							'"localizacion"."tilocodigos"="tipolocaliza"."tilocodigos"';
			break;
			case "auth":
				$sql = 'SELECT ' .
							'"auth"."authusernams",' .
							'"auth"."authrealname",' .
							'"auth"."authrealape1",' .
							'"auth"."authrealape2" ' .
						'FROM "auth"';
			break;
			case "profiles":
				$rcuser = Application :: getUserParam();
				$sql = 'SELECT * FROM "profiles" WHERE  "applcodigos"=\''.$rcuser['app_code'].'\'';
			break;
			default: $sql = null;
		}
		return $sql;
	}
	//-------------------------------------------------------
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Hace la consulta para los arboles
	* @param string $isbSqlId
	* @param array $ircParams Arreglo con parametros de consulta
	* @return array
	* @author freina <freina@parquesoft.com>
	* @date 08-Jul-2005 17:10
	* @location Cali-Colombia
	*/
	function getDataTree($isbSqlId,$ircParams=null) {
		
		settype($objService,"object");
		settype($rcTipo,"array");
		settype($rcTmp,"array");
		settype($rcTipoLoc,"array");
		settype($rcData, "array");
		settype($sbEstate,"string");
		settype($sbTmp,"string");
		settype($sbTmp1, "string");
		settype($sbSql,"string");
		
		$sbEstate = Application :: getConstant("REG_ACT");
		
		switch ($isbSqlId) {
			case "organizacion" :
				$objtmp = Application :: loadServices("General");
                        $rctmp = $objtmp->getParam("human_resources", "ORG_INACT");
                        $sbtmp = "'".implode("','",$rctmp)."'";
                        $sql = 'SELECT "orgacodigos","organombres","orgacgpads","orgatelefo1s","orgaemails" ' .
                                                'FROM "organizacion" ' .
                                                'WHERE "esorcodigos" NOT IN ('.$sbtmp.' ) ' ;
                        return $sql;
			break;
			case "localizacion" :
				$sbSql = 'SELECT "A"."locacodigos","A"."locanombres","A"."tilocodigos","tilonombres","A"."locacodpadrs",';
				$sbSql .= '"B"."locanombres" as "nombrepadre","A"."locaestados"';
				$sbSql .= ' FROM "tipolocaliza","localizacion" "A" LEFT JOIN "localizacion" "B" ON "A"."locacodpadrs"="B"."locacodigos"';
				$sbSql .= ' WHERE "tipolocaliza"."tilocodigos"="A"."tilocodigos"';
				if($ircParams){
					//Carga las constantes de niveles de localizacion
					$rcTipo = Application :: getConstant("LOCALIZACION");
					if($rcTipo){
						$rcTipo = $rcTipo[$ircParams[0]];
						foreach($rcTipo as $rcTmp){
							$rcTipoLoc = array_merge($rcTipoLoc,$rcTmp);		
						}
						if($rcTipoLoc){
							$sbTmp = implode("','",$rcTipoLoc);
							$sbWhere = ' AND "A"."tilocodigos" IN (\''.$sbTmp.'\') AND "A"."locaestados"=\''.$sbEstate.'\'';
						}
					}
					$sbSql .= ' '.$sbWhere;
				}else{
					$sbSql .= ' AND "A"."locaestados"=\''.$sbEstate.'\'';
				}
				return $sbSql;
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
				return $sbSql = 'SELECT "orgacodigos","organombres","orgacgpads","orgatelefo1s","orgaemails" FROM "organizacion","tipoorgani" WHERE "organizacion"."orgaactivas"=\''.$sbEstate.'\' '.$sbTmp1.'AND "organizacion"."tiorcodigos" = "tipoorgani"."tiorcodigos"'.$sbTmp;
				break;
		}
		$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Determina si existen localidades con el tipo de localidad pasado como para
	* metro
	* @param string $isbTilocodigos Cadena con el id del tipo de localidad 
	* @author freina <freina@parquesoft.com>
	* @date 082-Sep-2005 17:48
	* @location Cali-Colombia
	*/
	function determineLocationRelation($isbTilocodigos) {
		settype($sbSql,"string");
		$sbSql = 'SELECT * FROM "localizacion" WHERE "tilocodigos"=\''.$isbTilocodigos.'\'';
		$this->objdb->fncadoexecute($sbSql);
		return $this->objdb->fncadorowcont();
	}
		/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Hace la consulta para los combobox (por RS)
	* @param string $isbSqlId Id del sql
	* @param array $ircParam	 Arreglo con los parametros de la consulta
	* @return array
	* @author freina <freina@parquesoft.com>
	* @date 02-Sep-2005 20:12
	* @location Cali-Colombia
	*/
	function getLoadSelect($isbSqlId, $ircParam) {
		
		settype($objService,"object");
		settype($objParams,"object");
		settype($rcWebUser,"array");
		settype($orcResult,"array");
		settype($rcReg,"array");
		settype($rcTmp,"array");
		settype($sbEstate,"string");
		settype($sbSql,"string");
		settype($nuKey,"integer");
		
		$sbEstate = Application :: getConstant("REG_ACT");
		switch ($isbSqlId) {
			case "tipolocaliza" :
				if(!$ircParam["locacodpadrs"][0]){
					$sbSql = 'SELECT "tipolocaliza"."tilocodigos","tipolocaliza"."tilonombres","tipolocaliza"."tiloestados" FROM "tipolocaliza" ';
					$sbSql .= ' WHERE "tilocodpadrs" IS NULL';
				}
				else{
					$sbSql = 'SELECT "tipolocaliza"."tilocodigos","tipolocaliza"."tilonombres","tipolocaliza"."tiloestados" FROM "tipolocaliza","localizacion" ';
					$sbSql .= ' WHERE "localizacion"."locacodigos"'.$ircParam["locacodpadrs"][1].'\''.$ircParam["locacodpadrs"][0];
					$sbSql .='\'  AND "localizacion"."tilocodigos"="tipolocaliza"."tilocodpadrs"';
				}
				$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
                foreach($this->objdb->rcresult as $nuKey => $rcReg){
                    $orcResult[$nuKey][0] = $rcReg["tilocodigos"];
                    $orcResult[$nuKey][1] = "(".$rcReg["tiloestados"].") ".$rcReg["tilonombres"];
                }
                return $orcResult;
                
            case "userschema" :
            	$objParams = Application::getDomainController("ParamsManager");
            	$rcWebUser = $objParams->getParam("cross300","web_user_conf");
            	$objService = Application::loadServices('Profiles');
            	$ircParam['user'] = $rcWebUser["user"];
            	$ircParam['schecodigon'] = $ircParam['schecodigon'][0];
            	$rcTmp = $objService->getUserSchema($ircParam);
            	if(is_array($rcTmp) && $rcTmp){
            		foreach($rcTmp as $nuKey => $rcReg){
            			$orcResult[$nuKey][0] = $rcReg["authusernams"];
            			$orcResult[$nuKey][1] = $rcReg["authusernams"];
            		}
            	}
            	return $orcResult;
		}
		$this->objdb->fncadoselect($sbSql);
		return $this->objdb->rcresult;
	}
	function getByCofecodigonLj($cofecodigon) {
		$sql = 'SELECT 
			"campconffoem"."cacfprocedes",
			"detaconffoem"."decfoperados",
			"detaconffoem"."decfvalors"'.' FROM  
			"detaconffoem","campconffoem"'.' WHERE 
			"detaconffoem"."cofecodigon"='.$cofecodigon.' AND 
			"detaconffoem"."cacfcodigon"="campconffoem"."cacfcodigon"'.' ORDER BY 
			"detaconffoem"."cacfcodigon"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getAllComunicacion($ircdata) {

		settype($sbtmp, "string");
		settype($sbfrom, "string");

		if ($ircdata["ordenumeros"]) {
			$sbtmp = " AND \"comunicacion\".\"ordenumeros\"='".$ircdata["ordenumeros"]."'";
		}
		if ($ircdata["focacodigos"]) {
			$sbtmp .= " AND \"formatocarta\".\"focacodigos\"='".$ircdata["focacodigos"]."'";
		}
		if ($ircdata["comuestados"]) {
			$sbtmp .= " AND \"comunicacion\".\"comuestados\"='".$ircdata["comuestados"]."'";
		}
		if ($ircdata["ordefecregdi"] && $ircdata["ordefecregdf"]) {
			$sbfrom = ", \"orden\"";
			$sbtmp .= " AND \"orden\".\"ordenumeros\"=\"comunicacion\".\"ordenumeros\" AND \"orden\".\"ordefecregd\" BETWEEN ".$ircdata["ordefecregdi"]." AND ".$ircdata["ordefecregdf"];
		}
		$sbsql = 'SELECT "comunicacion"."comucodigos","comunicacion"."ordenumeros","formatocarta"."focanombres" AS "focacodigos", "comunicacion"."comuasuntos","comunicacion"."comuestados"'.' FROM "comunicacion", "formatocarta" '.$sbfrom.' WHERE "comunicacion"."focacodigos"="formatocarta"."focacodigos" '.$sbtmp;
		$this->objdb->fncadoselect($sbsql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	
	function loadEquivalencias($rcData) {
		
		settype($rcResult,"array");
		settype($sbSql, "string");
		settype($sbStatus, "string");
		$sbStatus = Application :: getConstant("REG_ACT");

		if ($rcData["tiorcodigos"] && $rcData["orgacodigos"]) {
			
			$sbSql = 'SELECT * 
				  FROM "equivalencias" 
				  WHERE "equitablcros" = \'tipoorden\'
				  AND "equicampcros" = \'tiorcodigos\'
				  AND "equivalcros" = \''.$rcData["tiorcodigos"].'\'
				  AND "equiareacros" = \''.$rcData["orgacodigos"].'\'
				  AND "equiestados" = \''.$sbStatus.'\'';
			$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
			$rcResult["serie"]["name"] = $this->objdb->rcresult[0]["equinomdocs"];
			$rcResult["serie"]["value"] = $this->objdb->rcresult[0]["equivaldocs"];
			$rcResult["serie"]["area"] = $this->objdb->rcresult[0]["equiareadocs"];
			$rcResult["serie"]["serie"] = $this->objdb->rcresult[0]["equiseridocs"];
			$rcResult["serie"]["code"] = $this->objdb->rcresult[0]["equicodigon"];
		}
		if ($rcData["evencodigos"] && $rcData["orgacodigos"]) {
			$sbSql = 'SELECT * 
				  FROM "equivalencias" 
				  WHERE "equitablcros" = \'evento\'
				  AND "equicampcros" = \'evencodigos\'
				  AND "equivalcros" = \''.$rcData["evencodigos"].'\'
				  AND "equiareacros" = \''.$rcData["orgacodigos"].'\'
				  AND "equiestados" = \''.$sbStatus.'\'';
			$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
			$rcResult["tipo_carpeta"]["name"] = $this->objdb->rcresult[0]["equinomdocs"];
			$rcResult["tipo_carpeta"]["value"] = $this->objdb->rcresult[0]["equivaldocs"];
			$rcResult["tipo_carpeta"]["area"] = $this->objdb->rcresult[0]["equiareadocs"];
			$rcResult["tipo_carpeta"]["serie"] = $this->objdb->rcresult[0]["equiseridocs"];
			$rcResult["tipo_carpeta"]["code"] = $this->objdb->rcresult[0]["equicodigon"];
		}
		if ($rcData["causcodigos"] && $rcData["orgacodigos"]) {
			$sbSql = 'SELECT * 
				  FROM "equivalencias" 
				  WHERE "equitablcros" = \'causa\'
				  AND "equicampcros" = \'causcodigos\'
				  AND "equivalcros" = \''.$rcData["causcodigos"].'\'
				  AND "equiareacros" = \''.$rcData["orgacodigos"].'\'
				  AND "equiestados" = \''.$sbStatus.'\'';
			$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
			$rcResult["tipo_dcto"]["name"] = $this->objdb->rcresult[0]["equinomdocs"];
			$rcResult["tipo_dcto"]["value"] = $this->objdb->rcresult[0]["equivaldocs"];
			$rcResult["tipo_dcto"]["area"] = $this->objdb->rcresult[0]["equiareadocs"];
			$rcResult["tipo_dcto"]["serie"] = $this->objdb->rcresult[0]["equiseridocs"];
			$rcResult["tipo_dcto"]["code"] = $this->objdb->rcresult[0]["equicodigon"];
		}
		
		return $rcResult;
		
	}
	
	function saveEquivalenciaCaso($rcEquivalencias,$sbOrdenumeros) {
		
		settype($objManager, "object");
		settype($objDate, "object");
		settype($rcSql, "array");
		settype($nuDate, "integer");
		settype($nuEqcacodigon, "integer");
		
		$objManager = Application::getDomainController("NumeradorManager");
		$objDate = Application::loadServices("DateController");
		$nuDate = $objDate->fncintdatehour();
		
		if(array_key_exists("serie",$rcEquivalencias) && $rcEquivalencias["serie"]["code"]) {
			$nuEqcacodigon = $objManager->fncgetByIdNumerador("equivalenciacaso");
			$rcSql[] = 'INSERT INTO "equivalenciacaso" ("eqcacodigon","equicodigon","ordenumeros","equifecharen") VALUES ('.$nuEqcacodigon.','.$rcEquivalencias["serie"]["code"].',\''.$sbOrdenumeros.'\','.$nuDate.')';
		}
		if(array_key_exists("tipo_carpeta",$rcEquivalencias) && $rcEquivalencias["tipo_carpeta"]["code"]) {
			$nuEqcacodigon = $objManager->fncgetByIdNumerador("equivalenciacaso");
			$rcSql[] = 'INSERT INTO "equivalenciacaso" ("eqcacodigon","equicodigon","ordenumeros","equifecharen") VALUES ('.$nuEqcacodigon.','.$rcEquivalencias["tipo_carpeta"]["code"].',\''.$sbOrdenumeros.'\','.$nuDate.')';
		}
		if(array_key_exists("tipo_dcto",$rcEquivalencias) && $rcEquivalencias["tipo_dcto"]["code"]) {
			$nuEqcacodigon = $objManager->fncgetByIdNumerador("equivalenciacaso");
			$rcSql[] = 'INSERT INTO "equivalenciacaso" ("eqcacodigon","equicodigon","ordenumeros","equifecharen") VALUES ('.$nuEqcacodigon.','.$rcEquivalencias["tipo_dcto"]["code"].',\''.$sbOrdenumeros.'\','.$nuDate.')';
		}
		
		if(!is_array($rcSql) || !$rcSql){
			return false;
		}
			
		$this->objdb->fncadoexecutetrans($rcSql);
		if (!$this->objdb->objresult) {
			$this->consult = false;
		} else {
			$this->consult = true;
		}
				
	}
	//End of Class SqlExtended
}
?>