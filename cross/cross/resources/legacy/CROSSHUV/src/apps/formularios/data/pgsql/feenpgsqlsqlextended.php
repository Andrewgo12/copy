<?php  
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeEnPgsqlSqlExtended {
	var $consult;
	var $objdb;
	function FeEnPgsqlSqlExtended() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}

	function getDefaultEncuesta() 
	{
		settype($sbSql,"string");
		$sbSql = 'SELECT "pregformula"."formcodigon","pregunta"."pregcodigon","pregunta"."pregdescris","tema"."temanombres","pregunta"."morecodigon"';
		$sbSql .= ' FROM "pregunta","formulario","pregformula","tema"';
		$sbSql .= ' WHERE "pregformula"."formcodigon"="formulario"."formcodigon"';
		$sbSql .= ' AND "pregformula"."pregcodigon"="pregunta"."pregcodigon"';
		$sbSql .= ' AND "tema"."temacodigon"="pregunta"."temacodigon"';
		$sbSql .= ' AND "formulario"."formactivos"=\''.Application::getConstant("REG_ACT").'\'';
		$sbSql .= ' ORDER BY "pregformula"."prfoordenn"';
		
		$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	
	function getDefaultName() 
	{
		settype($sbSql,"string");
		$sbSql = 'SELECT "formnombres"';
		$sbSql .= ' FROM "formulario"';
		$sbSql .= ' WHERE "formulario"."formactivos"=\''.Application::getConstant("REG_ACT").'\'';
		
		$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		return $this->objdb->rcresult[0]["formnombres"];
	}

	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Hace la consulta para los combobox
	* @param string $sqlId 
     *@param array $rcParams Arreglo con parametros para la consulta
	* @return array
	* @author freina <freina@parquesoft.com>
	* @date 05-Nov-2004 07:39
	* @location Cali-Colombia
	*/
	function getDataCombo($sqlId,$rcParams=null) {
		settype($objService,"object");
		settype($rcResult,"array");
		settype($rcUser,"array");
		settype($sbTmp,"string");
		settype($nuSchema,"integer");
		$sbestado = Application :: getConstant("REG_ACT");
		switch ($sqlId) {
			case "tipopreg" :
				$sql = "SELECT 'C' as Cerrada,'A' as Abierta";
				break;
			case "formulario" :
				$sql = 'SELECT  "formcodigon","formnombres" FROM "formulario"';
				break;
			case "pregunta" :
				$sql = 'SELECT  "pregcodigon","pregdescris" FROM "pregunta" WHERE "pregactivas"=\''.$sbestado.'\'';
				break;
			case "contacto_ref" :
				$sql = 'SELECT "solicodigos" AS "contcodigon",("contindentis" || \' -- \' || COALESCE("contprinoms", \'\') || \' \' || COALESCE("contsegnoms", \'\') || \' \' || COALESCE("contpriapes", \'\') || \' \' || COALESCE("contsegapes", \'\') || \' -- \' || COALESCE("clienombres", \'\')) AS "contnombre"  FROM "solicitante" LEFT JOIN "contacto" ON ("solicitante"."contcodigon"="contacto"."contcodigon") LEFT JOIN "cliente" ON ("solicitante"."cliecodigos"="cliente"."cliecodigos") ORDER BY "contprinoms","contsegnoms","contpriapes","contsegapes"';
				break;
			case "contacto_ident" :
				$sql = 'SELECT "solicodigos" AS "contcodigon",("contindentis" || \' -- \' || COALESCE("contprinoms", \'\') || \' \' || COALESCE("contsegnoms", \'\') || \' \' || COALESCE("contpriapes", \'\') || \' \' || COALESCE("contsegapes", \'\') || \' -- \' || COALESCE("clienombres", \'\')) AS "contindentis"  FROM "solicitante" LEFT JOIN "contacto" ON ("solicitante"."contcodigon"="contacto"."contcodigon") LEFT JOIN "cliente" ON ("solicitante"."cliecodigos"="cliente"."cliecodigos") ORDER BY "contindentis"';
				break;
			case "paciente_ref" :
				$sql = 'SELECT "paciindentis",("paciindentis" || \' -- \' || COALESCE("paciprinoms", \'\') || \' \' || COALESCE("pacisegnoms", \'\') || \' \' || COALESCE("pacipriapes", \'\') || \' \' || COALESCE("pacisegapes", \'\')) AS "pacinombres"  FROM "paciente" ORDER BY "paciprinoms","pacisegnoms","pacipriapes","pacisegapes"';
				break;
			case "paciente_ident" :
				$sql = 'SELECT "paciindentis" AS "paciindentis_c",("paciindentis" || \' -- \' || COALESCE("paciprinoms", \'\') || \' \' || COALESCE("pacisegnoms", \'\') || \' \' || COALESCE("pacipriapes", \'\') || \' \' || COALESCE("pacisegapes", \'\')) AS "paciindentis"  FROM "paciente" ORDER BY "paciindentis"';
				break;
		}
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getCompoTipoServicio() {

		$sql = 'SELECT * FROM "tiposervicio"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		$rcTmp = $this->objdb->rcresult;
		if(!is_array($rcTmp))
			return false;

		$sbHtml .= "<select name='tisecodigos'>";
		$sbHtml .= "<option value=''>---</option>";
		foreach ($rcTmp as $row) {
			$sbHtml .= "<option value='".$row["tisecodigos"]."'>".$row["tisenombres"]."</option>";
		}
		$sbHtml .= "</select>";
		return $sbHtml;
	}

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
			case "contacto" :
				echo $sql = 'SELECT (COALESCE("contacto"."contprinoms", \'\') || \' \' || COALESCE("contacto"."contsegnoms", \'\') || \' \' || COALESCE("contacto"."contpriapes", \'\') || \' \' || COALESCE("contacto"."contsegapes", \'\'))  AS "contnombre" FROM "contacto" WHERE "contindentis"=\''.$rcParams["contindentis"][0].'\' AND "contactivas"=\''.$sbestado.'\'';
				break;
			case "infractor" :
				$sql = 'SELECT "infrnombres" FROM "infractor" WHERE "infrcodigos"=\''.$rcParams["infrcodigos"][0].'\' AND "infractivas"=\''.$sbestado.'\'';
				break;
			case "organizacion" : 
				$objService = Application :: loadServices("Human_resources");
				return $objService->getOrganizacionActiveByOrgacodigos($rcParams["orgacodigos"][0]);
				break;
			case "localizacion" : 
				$objService = Application :: loadServices("General");
				$rcTmp =  $objService->getByIdLocalizacion($rcParams["locacodigos"][0]);
				$orcResult[0][0] =$rcTmp[0]["locanombres"];
				return $orcResult;
			case "personal" : 
				$objService = Application :: loadServices("Human_resources");
				$rcTmp =  $objService->getPersonal($rcParams["perscodigos"][0]);
				$orcResult[0][0] =$rcTmp[0]["persnombres"]." ".$rcTmp[0]["persapell1s"]." ".$rcTmp[0]["persapell2s"];
				return $orcResult;
			default :
				return null;
		}
		$this->objdb->fncadoselect($sql);
		return $this->objdb->rcresult;
	}
	
	/**
    * Copyright 2009 FullEngine
    *
    * Genera un sql generico 
    * @author freina<freina@parquesoft.com>
    * @param string $table
    * @return string
    * @date 15-Dec-2009 18:20
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
			foreach ($rcTmp as $sbValue) 
			{
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
			foreach ($rcTmp as $sbValue) 
			{
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
    * Copyright 2009 FullEngine
    *
    * Inserta los filtros en un sql
    * @author freina<freina@parquesoft.com>
    * @param string $sql
    * @param array $rcFilter
    * @return string
    * @date 15-Dec-2009 18:20
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
	* @author freina<freina@parquesoft.com>
	* @date 16-Dec-2009 10:58
	* @location Cali-Colombia
	*/
	function getSqlConsult($sbId,$ircParam=null){
        settype($sbEstate,"string");
        settype($sbStatus,"string");
        settype($sbSql,"string");
        $sbEstate = Application :: getConstant("REG_ACT");
		switch($sbId){
				case "tema":
					$sbSql = 'SELECT ' .
								'"tema"."temacodigon",' .
								'"ejetematico"."ejtenombres" AS "ejtecodigon",' .
								'"tema"."temanombres",' .
								'"tema"."temadescrips" ' .
							'FROM "tema","ejetematico" ' .
							'WHERE ' .
								'"tema"."ejtecodigon"="ejetematico"."ejtecodigon"';
				break;
				case "pregunta":
					$sbSql = 'SELECT ' .
								'"pregunta"."pregcodigon",' .
								'"pregunta"."pregdescris",' .
								'"tema"."temanombres" AS "temacodigon",' .
								'"modeloresp"."morenombres" AS "morecodigon" ' .
							'FROM "pregunta" LEFT JOIN "modeloresp" ON ("pregunta"."morecodigon"="modeloresp"."morecodigon"),"tema" ' .
							'WHERE ' .
								'"pregunta"."temacodigon"="tema"."temacodigon"';
				break;
				case "opcionrepues":
					$sbSql = 'SELECT ' .
								'"opcionrepues"."oprecodigon",' .
								'"opcionrepues"."opredescrisp",' .
								'"modeloresp"."morenombres" AS "morecodigon" ' .
							'FROM "opcionrepues" LEFT JOIN "modeloresp" ON ("opcionrepues"."morecodigon"="modeloresp"."morecodigon") ';
				break;
				case "contacto_ref" :
				$sbSql = 'SELECT "solicitante"."solicodigos" AS "contcodigon",("contacto"."contindentis" || \' -- \' || COALESCE("B"."contnombre", \'\') || \' -- \' || COALESCE("clienombres", \'\')) AS "contnombre"  FROM "solicitante" LEFT JOIN "contacto" ON ("solicitante"."contcodigon"="contacto"."contcodigon") LEFT JOIN "cliente" ON ("solicitante"."cliecodigos"="cliente"."cliecodigos"),
						(SELECT "contcodigon",(COALESCE("contprinoms", \'\') || \' \' || COALESCE("contsegnoms", \'\') || \' \' || COALESCE("contpriapes", \'\') || \' \' || COALESCE("contsegapes", \'\')) AS "contnombre" FROM "contacto") AS "B"
						WHERE "contactivas"=\''.$sbEstate.'\' AND "solicitante"."contcodigon"="B"."contcodigon"';
				break;
			case "contacto_ident" :
				$sbSql = 'SELECT "solicodigos" AS "contcodigon",("contindentis" || \' -- \' || COALESCE("contprinoms", \'\') || \' \' || COALESCE("contsegnoms", \'\') || \' \' || COALESCE("contpriapes", \'\') || \' \' || COALESCE("contsegapes", \'\') || \' -- \' || COALESCE("clienombres", \'\')) AS "contindentis"  FROM "solicitante" LEFT JOIN "contacto" ON ("solicitante"."contcodigon"="contacto"."contcodigon") LEFT JOIN "cliente" ON ("solicitante"."cliecodigos"="cliente"."cliecodigos") WHERE "contacto"."contactivas"=\''.$sbEstate.'\'';
				break;
			case "paciente_ref" :
				$sbStatus = Application :: getConstant("REG_ACT");
				$sbSql = 'SELECT "paciente"."paciindentis",(COALESCE("B"."pacinombres", \'\')) AS "pacinombres"  FROM "paciente",
						(SELECT "paciindentis",("paciindentis" || \' -- \' || COALESCE("paciprinoms", \'\') || \' \' || COALESCE("pacisegnoms", \'\') || \' \' || COALESCE("pacipriapes", \'\') || \' \' || COALESCE("pacisegapes", \'\')) AS "pacinombres" FROM "paciente") AS "B"
						WHERE "paciactivos"=\''.$sbStatus.'\' AND "paciente"."paciindentis"="B"."paciindentis"';
				break;
			case "paciente_ident" :
				$sbStatus = Application :: getConstant("REG_ACT");
				$sbSql = 'SELECT "paciindentis" AS "paciindentis_c",("paciindentis" || \' -- \' || COALESCE("paciprinoms", \'\') || \' \' || COALESCE("pacisegnoms", \'\') || \' \' || COALESCE("pacipriapes", \'\') || \' \' || COALESCE("pacisegapes", \'\')) AS "paciindentis"  FROM "paciente" WHERE "paciactivos"=\''.$sbStatus.'\'';
				break;
			default: $sbSql = null;
		}	
		return $sbSql;
	}
	//End of Class SqlExtended
}
?>