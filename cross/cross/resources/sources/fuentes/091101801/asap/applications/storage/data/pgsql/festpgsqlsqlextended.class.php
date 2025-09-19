<?php
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeStPgsqlSqlExtended {
	var $consult;
	var $objdb;
    function FeStPgsqlSqlExtended() {
    	$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
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
			case "recurso":
				$recAct = Application :: getConstant("REG_ACT");
				$sql = 'SELECT 
								"recurso"."recucodigos",
								"recurso"."recunombres",
								"tiporecurso"."tirenombres" as "tirecodigos" 
							FROM 
								"recurso","tiporecurso" 
							WHERE 
								"recurso"."recuactivas"=\''.$recAct.'\' AND 
								"recurso"."tirecodigos"="tiporecurso"."tirecodigos"';
				break;
			case "concepmovimi_in":
				$recAct = Application :: getConstant("REG_ACT");
				$sql = 'SELECT * FROM "concepmovimi" WHERE "comoactivas"=\''.$recAct.'\' AND "comosentidos"=\'+\'';
				break;
			case "concepmovimi_out":
				$recAct = Application :: getConstant("REG_ACT");
				$sql = 'SELECT * FROM "concepmovimi" WHERE "comoactivas"=\''.$recAct.'\' AND "comosentidos"=\'-\'';
				break;
			case "bodega":
				$recAct = Application :: getConstant("REG_ACT");
				$sql = 'SELECT 
									"bodega"."bodecodigos",
									"bodega"."bodenombres",
									"tipobodega"."tibonombres" AS "tibocodigos",
									"bodega"."bodedescrips" 
							FROM 
								"bodega","tipobodega" 
							WHERE 
								"bodega"."bodeestados"=\''.$recAct.'\' AND 
								"bodega"."tibocodigos"="tipobodega"."tibocodigos"';
				break;
			case "tipodocument":
				$recAct = Application :: getConstant("REG_ACT");
				$sql = 'SELECT * FROM "tipodocument" WHERE "tidoactivas"=\''.$recAct.'\'';
				break;
			case "recursoserie":
				//obtiene los recursos seriados
				$recSerial = Application :: getConstant("COD_REC_SER");
				$recAct = Application :: getConstant("REG_ACT");
				$sql = 'SELECT 
								"recurso"."recucodigos",
								"recurso"."recunombres",
								"tiporecurso"."tirenombres" as "tirecodigos" 
							FROM 
								"recurso","tiporecurso" 
							WHERE 
								"recurso"."recuactivas"=\''.$recAct.'\' AND 
								"recurso"."tirecodigos"=\''.$recSerial.'\' AND
								"recurso"."tirecodigos"="tiporecurso"."tirecodigos"';
				break;
		}	
		return $sql;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Contiene y ejecuta los SQL de los campos autoreferenciados
	* @param string $sqlId Identificador del sql
	* @return array $rcParams Vector con los parametros.
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 09-oct-2004 11:24:33
	* @location Cali-Colombia
	*/
	function getAutoReference($sqlId,$rcParams=null){
		switch($sqlId){
			case "concepmovimi_out":
				$recAct = Application :: getConstant("REG_ACT");
				$sql = 'SELECT 
							"comonombres" 
						FROM 
							"concepmovimi"
						WHERE 
							"comoactivas"=\''.$recAct.'\' AND 
							"comosentidos"=\'-\' AND 
							"comocodigos"=\''.$rcParams["comocodigos"][0].'\'';
				break;
			case "concepmovimi_in":
				$recAct = Application :: getConstant("REG_ACT");
				$sql = 'SELECT 	
							"comonombres" 
						FROM 
							"concepmovimi"
						WHERE 
							"comoactivas"=\''.$recAct.'\' AND
							"comosentidos"=\'+\' AND 
							"comocodigos"=\''.$rcParams["comocodigos"][0].'\'';
				break;
			case "bodega":
				if($rcParams["bodecodigos"][0] == $rcParams["bodecodigos1"][0])
					return null;
				$recAct = Application :: getConstant("REG_ACT");
				$sql = 'SELECT "bodenombres" FROM "bodega" WHERE "bodeestados"=\''.$recAct.'\' AND "bodecodigos"=\''.$rcParams["bodecodigos"][0].'\'';
				break;
			case "tipodocument":
				$recAct = Application :: getConstant("REG_ACT");
				$sql = 'SELECT "tidonombres" FROM "tipodocument" WHERE "tidoactivas"=\''.$recAct.'\' AND "tidocodigos"=\''.$rcParams["tidocodigos"][0].'\'';
				break;
			case "recurso":
				$recAct = Application :: getConstant("REG_ACT");
				$sql = 'SELECT "recunombres" FROM "recurso"	WHERE "recuactivas"=\''.$recAct.'\' AND "recucodigos"=\''.$rcParams["recucodigos"][0].'\'';
				break;
			case "recursoserie":
				$recSerial = Application :: getConstant("COD_REC_SER");
				$recAct = Application :: getConstant("REG_ACT");
				$sql = 'SELECT "recunombres" FROM "recurso"	WHERE "recuactivas"=\''.$recAct.'\' AND "recucodigos"=\''.$rcParams["recucodigos"][0].'\' AND "tirecodigos"=\''.$recSerial.'\'';
				break;
			case "moalnumedocs":
				$sql = 'SELECT * FROM "movimialmace" WHERE "moalnumedocs"=\''.$rcParams["moalnumedocs"][0].'\'';
				break;
			default:
				return null;
		}
		$this->objdb->fncadoselect($sql, FETCH_NUM);
		return $this->objdb->rcresult;
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
	function getDataCombo($sqlId){
		switch($sqlId){
			case "recurso":
				$recAct = Application :: getConstant("REG_ACT");
				$sql = 'SELECT * FROM "recurso" WHERE "recuactivas"=\''.$recAct.'\'';
				break;
			case "proveedor":
				$recAct = Application :: getConstant("REG_ACT");
				$sql = 'SELECT * FROM "proveedor" WHERE "provactivas"=\''.$recAct.'\'';
				break;
			case "gruporecurso":
				$recAct = Application :: getConstant("REG_ACT");
				$sql = 'SELECT * FROM "gruporecurso" WHERE "grreactivas"=\''.$recAct.'\'';
				break;
			case "unidadmedida":
				$recAct = Application :: getConstant("REG_ACT");
				$sql = 'SELECT * FROM "unidadmedida" WHERE "unmeactivas"=\''.$recAct.'\'';
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
}
?>