<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");

class FeCuPgsqlSqlExtended {
	var $consult;
	var $objdb;
	function FeCuPgsqlSqlExtended() {
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
	function getDataCombo($sqlId) {
		switch ($sqlId) {
			case "tipocliente" :
				$recAct = Application :: getConstant("REG_ACT");
				$sql = 'SELECT * FROM "tipocliente" WHERE "ticlactivos"=\''.$recAct.'\'';
				break;
			case "estadoclient" :
				$recAct = Application :: getConstant("REG_ACT");
				$sql = 'SELECT * FROM "estadoclient" WHERE "esclactivos"=\''.$recAct.'\'';
				break;
			case "tipoidentifi" :
				$recAct = Application :: getConstant("REG_ACT");
				$sql = 'SELECT * FROM "tipoidentifi" WHERE "tiidactivas"=\''.$recAct.'\'';
				break;
			case "tipocontrato" :
				$recAct = Application :: getConstant("REG_ACT");
				$sql = 'SELECT * FROM "tipocontrato" WHERE "ticoactivos"=\''.$recAct.'\'';
				break;
			case "tipomoneda" :
				$recAct = Application :: getConstant("REG_ACT");
				$sql = 'SELECT * FROM "tipomoneda" WHERE "timoactivas"=\''.$recAct.'\'';
				break;
			case "formapago" :
				$recAct = Application :: getConstant("REG_ACT");
				$sql = 'SELECT * FROM "formapago" WHERE "fopaactivos"=\''.$recAct.'\'';
				break;
			case "cliente" :
				$recAct = Application :: getConstant("REG_ACT");
				$sql = 'SELECT * FROM "cliente" WHERE "clieactivas"=\''.$recAct.'\' ORDER BY "clienombres"';
				break;
			case "contacto" :
				$recAct = Application :: getConstant("REG_ACT");
				$sql = 'SELECT * FROM "contacto" WHERE "contactivas"=\''.$recAct.'\' ORDER BY "contprinoms","contsegnoms","contpriapes","contsegapes"';
				break;
			case "producto" :
				$recAct = Application :: getConstant("REG_ACT");
				$sql = 'SELECT * FROM "producto" WHERE "prodactivas"=\''.$recAct.'\' ORDER BY "prodnombres"';
				break;
			case "cliente_ref" :
				$sql = 'SELECT "cliecodigos","clienombres" FROM "cliente" ORDER BY "clienombres"';
				break;
			case "sexo" :
				$recAct = Application :: getConstant("REG_ACT");
				$sql = 'SELECT * FROM "sexo" WHERE "sexoactivos"=\''.$recAct.'\' ORDER BY "sexonombres"';
				break;
		}
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Consulta todos los clientes activos y ordenados por el nombre
	* @return array
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 24-nov-2004 12:01:04
	* @location Cali-Colombia
	*/
	function getActiveCustomers() {
		$recAct = Application :: getConstant("REG_ACT");
		$sql = 'SELECT * FROM "cliente" WHERE "clieactivas"=\''.$recAct.'\' ORDER BY "clienombres"';
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
        else $sbWere = " AND ".implode(" AND ",$rcTmp);
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
			case "tipomoneda":
				$sql = 'SELECT ' .
							'"tipomoneda"."timocodigos",' .
							'"tipomoneda"."timonombres",' .
							'"tipomoneda"."timoequivaln",' .
							'"tipomoneda"."timoactivas" ' .
						'FROM "tipomoneda" ';
			break;
			case "cliente":
				$sql = 'SELECT ' .
							'"cliente"."cliecodigos",' .
							'"cliente"."clieidentifs",' .
							'"cliente"."clienombres",' .
							'"tipocliente"."ticlnombres" AS "ticlcodigos",' .
							'"localizacion"."locanombres" AS "locacodigos",' .
							'"estadoclient"."esclnombres" AS "esclcodigos",' .
							'"tipoidentifi"."tiidnombres" AS "tiidcodigos",' .
							'"cliente"."clieactivas" ' .
						'FROM "cliente","tipocliente","localizacion","estadoclient","tipoidentifi" ' .
						'WHERE ' .
							'"cliente"."ticlcodigos"="tipocliente"."ticlcodigos" AND ' .
							'"cliente"."locacodigos"="localizacion"."locacodigos" AND ' .
							'"cliente"."esclcodigos"="estadoclient"."esclcodigos" AND ' .
							'"cliente"."tiidcodigos"="tipoidentifi"."tiidcodigos"';
			break;
			case "contrato":
				$sql = 'SELECT ' .
							'"contrato"."contnics",' .
							'"cliente"."clienombres" AS "clieidentifs",' .
							'"tipocontrato"."ticonombres" AS "ticocodigos",' .
							'"tipomoneda"."timonombres" AS "timocodigos",' .
							'"formapago"."fopanombres" AS "fopacodigos",' .
							'"contrato"."contfchainin",' .
							'"contrato"."contestados" ' .
						'FROM "contrato","cliente","tipocontrato","tipomoneda","formapago" ' .
						'WHERE ' .
							'"contrato"."clieidentifs"="cliente"."clieidentifs" AND ' .
							'"contrato"."ticocodigos"="tipocontrato"."ticocodigos" AND ' .
							'"contrato"."timocodigos"="tipomoneda"."timocodigos" AND ' .
							'"contrato"."fopacodigos"="formapago"."fopacodigos"';
			break;
            case "contacto":
                $sql = 'SELECT '.
                                '"contacto"."contcodigon",'.
                                '"contacto"."contindentis",'.
                                '(COALESCE("contacto"."contprinoms", \'\') || \' \' || COALESCE("contacto"."contsegnoms", \'\') || \' \' || COALESCE("contacto"."contpriapes", \'\') || \' \' || COALESCE("contacto"."contsegapes", \'\'))  AS "contnombre",'.
                                '"contacto"."contsexos",'.
                                '"contacto"."contemail",'.
                                '"localizacion"."locanombres" AS "locacodigos",'.
                                '"contacto"."contdirecios",'.
                                '"contacto"."conttelefons",'.
                                '"contacto"."contobservs",'.
                                '"contacto"."contactivas" '.
                            'FROM '.
                                '"contacto" LEFT JOIN "localizacion" ON ("contacto"."locacodigos"="localizacion"."locacodigos")';
                break;
            case 'contratoproducto':
            	$sql = 'SELECT ' .
            				'"contratoprod"."contnics", ' .
            				'"contratoprod"."prodcodigos", ' .
            				'"producto"."prodnombres", ' .
            				'"contratoprod"."coprcantidan" ' .
            			'FROM "contratoprod","producto" ' .
            			'WHERE ' .
            				'"contratoprod"."prodcodigos"="producto"."prodcodigos"';
            break;
            case "cliente_ref" :
				$recAct = Application :: getConstant("REG_ACT");
				$sql = 'SELECT "cliecodigos","clienombres" FROM "cliente" WHERE "clieactivas"=\''.$recAct.'\' ';
				break;
			case "paciente":
                $sql = 'SELECT '.
                                '"paciente"."paciindentis",'.
                                '(COALESCE("paciente"."paciprinoms", \'\') || \' \' || COALESCE("paciente"."pacisegnoms", \'\') || \' \' || COALESCE("paciente"."pacipriapes", \'\') || \' \' || COALESCE("paciente"."pacisegapes", \'\'))  AS "pacinombres",'.
                                '"paciente"."sexocodigos",'.
                                '"paciente"."paciemail",'.
                                '"localizacion"."locanombres" AS "locacodigos",'.
                                '"paciente"."pacidirecios",'.
                                '"paciente"."pacitelefons",'.
                                '"paciente"."paciobservs",'.
                                '"paciente"."paciactivos" '.
                            'FROM '.
                                '"paciente" LEFT JOIN "localizacion" ON ("paciente"."locacodigos"="localizacion"."locacodigos")';
                break;
			default: $sql = null;
		}	
		return $sql;
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
			case "localizacion" : 
				$objService = Application :: loadServices("General");
				return $objService->getLocation($ircParam["tipo"][0], $ircParam["nivel"][0] ,$ircParam["locacodigos"][0]);
				break;		
		}
		$this->objdb->fncadoselect($sbSql);
		return $this->objdb->rcresult;
	}
    /**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Contiene y ejecuta SQL
	* @param string $sqlId Identificador del sql
	* @return array $rcParams Vector con los parametros.
	* @author freina <freina@parquesoft.com>
	* @date 05-Sep-2005 11:03
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
			case 'cliente':
				echo $sql = 'SELECT "clienombres" FROM "cliente" WHERE "clieidentifs"=\''.$rcParams["clieidentifs"][0].'\'';
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
    * @param string $prodcodigos
    * @param string $contnics
	* Consulta los datos de un producto asociado a un contrato
	* @return array
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 19-may-2005 15:59:04
	* @location Cali-Colombia
	*/
	function getFichaProducto($prodcodigos, $contnics){

        $sql = 'SELECT ' .
        			'"contratoprod"."contnics", ' .
        			'"contrato"."contfchfirmn",' .
        			'"contrato"."clieidentifs",' .
        			'"cliente"."clienombres",' .
        			'"contratoprod"."prodcodigos",' .
        			'"producto"."prodnombres",' .
        			'"producto"."proddescrips",' .
        			'"marca"."marcnombres",' .
        			'"modelo"."modenombres",' .
        			'"contratoprod"."coprcantidan",' .
        			'"contratoprod"."coprvalunidn",' .
        			'"contratoprod"."coprserials",' .
        			'"contratoprod"."copovigencn",' .
        			'"contratoprod"."copodefinis",' .
        			'"contratoprod"."copoclausus",' .
        			'"contratoprod"."coporestris" ' .
        		'FROM ' .
        			'"contratoprod","producto","contrato","cliente","marca","modelo" ' .
        		'WHERE ' .
        			'"contratoprod"."contnics"=\''.$contnics.'\' AND ' .
        			'"contratoprod"."prodcodigos"=\''.$prodcodigos.'\' AND ' .
        			'"contratoprod"."contnics"="contrato"."contnics" AND ' .
        			'"contrato"."clieidentifs"="cliente"."clieidentifs" AND ' .
        			'"contratoprod"."prodcodigos"="producto"."prodcodigos" AND ' .
        			'"producto"."marccodigos"="marca"."marccodigos" AND ' .
        			'"producto"."modecodigos"="modelo"."modecodigos"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
    }
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
    * @param string $prodcodigos
    * @param string $contnics
	* Consulta los datos de una orden asociada a un contrato y producto
	* @return array
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 20-may-2005 15:59:04
	* @location Cali-Colombia
	*/
    function getOrdenByProdCont($prodcodigos,$contnics){
        
        $sql = "SELECT
                    orden.ordenumeros, 
                    tipoorden.tiornombres, 
                    evento.evennombres, 
                    orden.ordefecregd, 
                    orden.ordefecfinad,
                    orden.ordeobservs
                FROM
                    ordenempresa,orden,tipoorden,evento
                WHERE
                    ordenempresa.contnics = '$contnics' AND 
                    ordenempresa.prodcodigos = '$prodcodigos' AND 
                    ordenempresa.ordenumeros = orden.ordenumeros AND
                    ordenempresa.tiorcodigos = tipoorden.tiorcodigos AND 
                    ordenempresa.tiorcodigos = evento.tiorcodigos AND 
                    ordenempresa.evencodigos = evento.evencodigos
                ORDER BY 
                    orden.ordefecregd";
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
    }

	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Consulta los datos de las actas asociada a una orden
    * @param string $ordenumeros
	* @return array
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 20-may-2005 15:59:04
	* @location Cali-Colombia
	*/
    function getActasByOrden($ordenumeros){
        $sql = "SELECT
                    acta.actacodigos, 
                    tarea.tarenombres, 
                    estadoacta.esacnombres, 
                    acta.actafechingn, 
                    acta.usuacodigos
                FROM
                    acta,tarea,estadoacta
                WHERE
                    acta.ordenumeros = '$ordenumeros' AND 
                    acta.tarecodigos = tarea.tarecodigos AND 
                    acta.actaestacts  = estadoacta.esaccodigos
                ORDER BY
                    acta.actafechingn"; 
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
    }
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Consulta las atenciones de las actas
    * @param string $actacodigos
	* @return array
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 20-may-2005 15:59:04
	* @location Cali-Colombia
	*/
    function getAtencionesByActa($actacodigos){
        $sql = "SELECT
                    actaempresa.acemnumeros,
                    estadoacta.esacnombres, 
                    actaempresa.acemfecaten, 
                    grupo.grupnombres, 
                    actaempresa.acemobservas
                FROM
                    actaempresa,estadoacta,grupo
                WHERE
                    actaempresa.actacodigos  = '$actacodigos' AND 
                    actaempresa.esaccodigos  = estadoacta.esaccodigos AND 
                    actaempresa.acemusuars  = grupo.grupcodigon
                ORDER BY
                    actaempresa.acemfeccren";
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
    }
	/**
	* @Copyright 2004 ? FullEngine
	*
	* Consulta las actividades de una actencion 
	* @param string $acemnumeros
	* @return array
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 09-dic-2004 15:32:35
	* @location Cali - Colombia
	*/
	function getActiviactaByAcem($acemnumeros){
		$sql = "SELECT " .
                    "activiacta.acticodigos," .
                    "actividad.actinombres " .
				"FROM " .
                    "activiacta,actividad " .
				"WHERE " .
                    "activiacta.acemcodigos='$acemnumeros' AND " .
                    "activiacta.acticodigos=actividad.acticodigos";	
		$this->objdb->fncadoselect($sql);
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
			case "cliente":
				$recAct = Application :: getConstant("REG_ACT");
				$sql = 'SELECT "clieidentifs","clienombres" FROM "cliente" WHERE "clieidentifs" IS NOT NULL AND "clieactivas"=\''.$recAct.'\'';
			break;
			default: $sql = null;
		}	
		return $sql;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Consulta todos los tipos de identificacion activos
	* @return array
	* @author freina <freina@parquesoft.com>
	* @date 15-Jan-2007 17:23
	* @location Cali-Colombia
	*/
	function getAllTipoidentifi() {
		
		settype($sbState,"string");
		settype($sbSql,"string");
		$sbState = Application :: getConstant("REG_ACT");
		$sbSql = 'SELECT * FROM "tipoidentifi" WHERE  "tiidactivas"=\''.$sbState.'\'';
		$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
}
?>