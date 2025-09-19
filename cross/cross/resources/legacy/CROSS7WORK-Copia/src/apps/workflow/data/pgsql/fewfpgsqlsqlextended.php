<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeWFPgsqlSqlExtended {
	var $consult;
	var $objdb;
	function FeWFPgsqlSqlExtended() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	function getByCoprcodigonLj($coprcodigon) {
		$sql = 'SELECT 
		    					"campconfproc"."cacoprocedes",
		    					"detaconfproc"."decooperados",
		    					"detaconfproc"."decovalors"'.' FROM  
		    					"detaconfproc","campconfproc"'.' WHERE 
		    					"detaconfproc"."coprcodigon"='.$coprcodigon.' AND 
		    					"detaconfproc"."cacocodigon"="campconfproc"."cacocodigon"'.' ORDER BY 
		    					"detaconfproc"."cacocodigon"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Hace la consulta para los combobox
	* @param string $sqlId 
	* @return array
	* @author freina <freina@parquesoft.com>
	* @date 08-Nov-2004 10:37
	* @location Cali-Colombia
	*/
	function getDataCombo($sqlId) {
		$sbestado = Application :: getConstant("REG_ACT");
		switch ($sqlId) {
			case "tarea" :
				$sql = 'SELECT * FROM "tarea" WHERE "tareactivas"=\''.$sbestado.'\'';
				break;
			case "actividad" :
				$sql = 'SELECT * FROM "actividad" WHERE "actiactivas"=\''.$sbestado.'\'';
				break;
			case "proceso" :
				$sql = 'SELECT * FROM "proceso" WHERE "procactivas"=\''.$sbestado.'\'';
				break;
			case "estadoproces" :
				$sql = 'SELECT * FROM "estadoproces" WHERE "espractivas"=\''.$sbestado.'\'';
				break;
			case "estadoacta" :
				$sql = 'SELECT * FROM "estadoacta" WHERE "esacactivas"=\''.$sbestado.'\'';
				break;
			case "evento" :
				$sql = 'SELECT * FROM "evento" WHERE "evenactivos"=\''.$sbestado.'\'';
				break;
			case "causa" :
				$sql = 'SELECT * FROM "causa" WHERE "causactivas"=\''.$sbestado.'\'';
				break;
			case "tipoorden" :
				$sql = 'SELECT * FROM "tipoorden" WHERE "tioractivos"=\''.$sbestado.'\' ORDER BY "tiornombres"';
				break;				
		}
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
		switch($id){
			case "tarea":
				$sql = 'SELECT ' .
						'"tarea"."tarecodigos",' .
						'"tarea"."tarenombres",' .
						'"organizacion"."organombres" AS "orgacodigos",' .
						'"tarea"."tareactivas" ' .
					'FROM "tarea" LEFT JOIN "organizacion" ON ("tarea"."orgacodigos"="organizacion"."orgacodigos")';
			break;
			case "activitarea":
				$sql = 'SELECT ' .
							'"activitarea"."tarecodigos",' .
							'"tarea"."tarenombres",' .
							'"activitarea"."acticodigos",' .
							'"actividad"."actinombres",' .
							'"activitarea"."actavalorn",' .
							'"activitarea"."actaobligats",' .
							'"activitarea"."actaporcetan",' .
							'"activitarea"."actaactivas" ' .
						'FROM "activitarea","actividad","tarea" ' .
						'WHERE ' .
							'"activitarea"."tarecodigos"="tarea"."tarecodigos" AND ' .
							'"activitarea"."acticodigos"="actividad"."acticodigos"';
			break;
			case "proceso":
				$sql = 'SELECT ' .
							'"proceso"."proccodigos",' .
							'"proceso"."procnombres",' .
							'"organizacion"."organombres" AS "orgacodigos",' .
							'"proceso"."procactivas" ' .
						'FROM "proceso" LEFT JOIN "organizacion" ON ("proceso"."orgacodigos"="organizacion"."orgacodigos")';
			break;
			case "estadotarea":
				$sql = 'SELECT '.
                            '"estadotarea"."tarecodigos", '.
                            '"tarea"."tarenombres", '.
                            '"estadotarea"."esaccodigos", '.
                            '"estadoacta"."esacnombres" '.
                        'FROM "estadotarea","estadoacta","tarea" '.
                        'WHERE '.
                            '"estadotarea"."tarecodigos" = "tarea"."tarecodigos" AND '.
                            '"estadotarea"."esaccodigos" = "estadoacta"."esaccodigos"';
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
	* @date 05-Nov-2004 13:28
	* @location Cali-Colombia
	*/
	function getAutoReference($sqlId, $rcParams = null) {
		settype($objService,"object");
		settype($rcTmp,"array");
		settype($orcResult,"array");
		settype($sbestado,"string");
		$sbestado = Application :: getConstant("REG_ACT");
		switch ($sqlId) {
			case "evento_causa" :
				$sql = 'SELECT * FROM "causa" WHERE "evencodigos"=\''.$rcParams[0].'\' AND "causactivas"=\''.$sbestado.'\' ORDER BY "causnombres"';
				break;
			case "tipoorden_evento" :
				$sql = 'SELECT * FROM "evento" WHERE "tiorcodigos"=\''.$rcParams[0].'\' AND "evenactivos"=\''.$sbestado.'\' ORDER BY "evennombres"';
				break;
			case "tipoorden_evento_causa" :
				$sql = 'SELECT * FROM "causa" WHERE "tiorcodigos"=\''.$rcParams[0].'\' AND "evencodigos"=\''.$rcParams[1].'\' AND "causactivas"=\''.$sbestado.'\' ORDER BY "causnombres"';
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
	* Hace la consulta para los combobox (por RS)
	* @param string $isbSqlId Id del sql
	* @param array $ircParam	 Arreglo con los parametros de la consulta
	* @return array
	* @author freina <freina@parquesoft.com>
	* @date 05-Jul-2005 15:29
	* @location Cali-Colombia
	*/
	function getLoadSelect($isbSqlId, $ircParam) {
		settype($objService,"object");
		settype($sbEstate,"string");
		settype($sbSql,"string");
		$sbEstate = Application :: getConstant("REG_ACT");
		switch ($isbSqlId) {
			case "tipoorden_evento" :
				$sbSql = 'SELECT "evencodigos","evennombres" FROM "evento" WHERE "tiorcodigos"'.
				$ircParam["tiorcodigos"][1].'\''.$ircParam["tiorcodigos"][0].
				'\'  AND "evenactivos"=\''.$sbEstate.'\'';
				break;
			case "tipoorden_evento_causa" :
				$sbSql = 'SELECT "causcodigos","causnombres" FROM "causa" WHERE "tiorcodigos"'.
				$ircParam["tiorcodigos"][1].'\''.$ircParam["tiorcodigos"][0].
				'\' AND "evencodigos"'.$ircParam["evencodigos"][1].'\''.$ircParam["evencodigos"][0].
				'\'  AND "causactivas"=\''.$sbEstate.'\'';
				break;
			case "localizacion" : 
				$objService = Application :: loadServices("General");
				return $objService->getLocation($ircParam["tipo"][0], $ircParam["nivel"][0] ,$ircParam["locacodigos"][0]);
				break;		
			case "estadotarea" :
				$sbSql = 	'SELECT ' .
						'"estadotarea"."esaccodigos",	' .
						'"estadoacta"."esacnombres" ' .
					'FROM "estadotarea","estadoacta" ' .
					'WHERE	' .
						'"estadotarea"."tarecodigos" = \''.$ircParam["tarecodigos"][0].'\' AND ' .
						'"estadotarea"."esaccodigos"="estadoacta"."esaccodigos" ' .
					'ORDER BY "estadoacta"."esacnombres"';
				break;
		}
		$this->objdb->fncadoselect($sbSql);
		return $this->objdb->rcresult;
	}
	
}//End of Class SqlExtended

?>