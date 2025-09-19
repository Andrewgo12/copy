<?php     
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeScPgsqlSqlExtended {
	var $consult;
	var $objdb;
	function FeScPgsqlSqlExtended() 
	{
		$config = &ASAP::getStaticProperty('Application','config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}

	function getSqlHelp($id){
		switch($id){
			case "contacto":
				$recAct = Application :: getConstant("REG_ACT");
				$sql = 'SELECT "contcodigon","contindentis",(COALESCE("contacto"."contprinoms", \'\') || \' \' || COALESCE("contacto"."contsegnoms", \'\') || \' \' || COALESCE("contacto"."contpriapes", \'\') || \' \' || COALESCE("contacto"."contsegapes", \'\'))  AS "contnombre" FROM "contacto" WHERE "contactivas"=\''.$recAct.'\'';
				break;
			case "infractor":
				$recAct = Application :: getConstant("REG_ACT");
				$sql = 'SELECT "infrcodigos","infrnombres" FROM "infractor" WHERE "infractivas"=\''.$recAct.'\'';
				break;
			case "personal":
				$recAct = Application :: getConstant("REG_ACT");
				$sql = 'SELECT "perscodigos","persidentifs", "persnombres", "persapell1s", "persapell2s" FROM "personal" WHERE "persestadoc"=\''.$recAct.'\'';
				break;
		}	
		return $sql;
	}

	function getDataCombo($sqlId,$rcParams=null) {
		settype($objService,"object");
		settype($objGateway,"object");
		settype($rcResult,"array");
		settype($rcUser,"array");
		settype($sbTmp,"string");
		settype($nuSchema,"integer");
		$sbestado = Application :: getConstant("REG_ACT");
		switch ($sqlId) {
			case "tipoidentifi" :
				$recAct = Application :: getConstant("REG_ACT");
				$sql = 'SELECT * FROM "tipoidentifi" WHERE "tiidactivas"=\''.$recAct.'\'';
				break;
			case "agendapriori" :
				$sql = 'SELECT * FROM "agendapriori" WHERE "agpractivas"=\''.$sbestado.'\'';
				break;
			case "contacto_ref" :
				$objService = Application :: loadServices("Customers");
				$objGateway = $objService->getGateWay("contacto"); 
				$sql = 'SELECT "solicodigos" AS "contcodigon",("contindentis" || \' -- \' || COALESCE("contprinoms", \'\') || \' \' || COALESCE("contsegnoms", \'\') || \' \' || COALESCE("contpriapes", \'\') || \' \' || COALESCE("contsegapes", \'\') || \' -- \' || COALESCE("clienombres", \'\')) AS "contnombre"  FROM "solicitante" LEFT JOIN "contacto" ON ("solicitante"."contcodigon"="contacto"."contcodigon") LEFT JOIN "cliente" ON ("solicitante"."cliecodigos"="cliente"."cliecodigos") ORDER BY "contprinoms","contsegnoms","contpriapes","contsegapes"';
				$objGateway->objdb->fncadoselect($sql, FETCH_ASSOC);
				$rcResult = $objGateway->objdb->rcresult;
				$objService->close();
				return $rcResult;
				break;
			case "contacto_ident" :
				$objService = Application :: loadServices("Customers");
				$objGateway = $objService->getGateWay("contacto"); 
				$sql = 'SELECT "solicodigos" AS "contcodigon",("contindentis" || \' -- \' || COALESCE("contprinoms", \'\') || \' \' || COALESCE("contsegnoms", \'\') || \' \' || COALESCE("contpriapes", \'\') || \' \' || COALESCE("contsegapes", \'\') || \' -- \' || COALESCE("clienombres", \'\')) AS "contindentis"  FROM "solicitante" LEFT JOIN "contacto" ON ("solicitante"."contcodigon"="contacto"."contcodigon") LEFT JOIN "cliente" ON ("solicitante"."cliecodigos"="cliente"."cliecodigos") ORDER BY "contindentis"';
				$objGateway->objdb->fncadoselect($sql, FETCH_ASSOC);
				$rcResult = $objGateway->objdb->rcresult;
				$objService->close();
				return $rcResult;
				break;
		}
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getListaEventos($entrfechorun,$entrduracion,$rcOrgacodigos,$catecodigon) 
	{
		$sql = 'SELECT "preecodigon","entrada"."entrcodigon","entrfechorun","entrduracion","entrdescris","catenombres" as "catecodigon","contcodigon","esennombres","orgacodigos"';
		$sql .= ' FROM "entrada" LEFT JOIN "preentrada" ON "entrada"."entrcodigon"="preentrada"."entrcodigon"
				,"categoria","estadoentrada","organentrada" ';
		$sql .= ' WHERE "entrfechorun">='.$entrfechorun;
		$sql .= ' AND "entrada"."catecodigon"="categoria"."catecodigon"';
		$sql .= ' AND "entrada"."entrcodigon"="organentrada"."entrcodigon"';
		$sql .= ' AND "entrada"."entractivas"="estadoentrada"."esencodigos"';
		$sql .= ' AND "entrduracion"<='.$entrduracion;
		
		if($catecodigon){
			$sql .= ' AND "entrada"."catecodigon"='.$catecodigon;
		}
			
		if(is_array($rcOrgacodigos) && $rcOrgacodigos){
			$sql .= ' AND "orgacodigos" IN (\''.implode("','",$rcOrgacodigos).'\') ';	
		}
		
		$sql .= ' ORDER BY "entrfechorun"';
		
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		$rcTmp = $this->objdb->rcresult;
		if(!is_array($rcTmp))
			return false;
		return $rcTmp;
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
			case "contacto" :
				$objService = Application :: loadServices("Customers");
				$rcTmp = $objService->getByIdcontindentis($rcParams["contcodigon"][0]);
				$orcResult[0][0] =$rcTmp[0]["contnombre"];
				return $orcResult;
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
				break;
			default :
				return null;
		}
		$this->objdb->fncadoselect($sql);
		return $this->objdb->rcresult;
	}
	
	function addPreEntrada($preencodigon,$catecodigon,$contcodigon,$ordeobservs,$now)
	{
		$sql='INSERT INTO "preentrada" ("preecodigon","catecodigon","contcodigon","preedescris","preefecregn") VALUES ('.$preencodigon.','.$catecodigon.','.$contcodigon.',\''.$ordeobservs.'\','.$now.')';
	    $this->objdb->fncadoexecute($sql);
	    if(!$this->objdb->objresult)
	    	$this->consult = false;
	    else	
	    	$this->consult = true;
	}
	
	function deletePreentrada($entrcodigon)
	{
		$sql='DELETE FROM "preentrada" WHERE "preecodigon"='.$entrcodigon;
	    $this->objdb->fncadoexecute($sql);
	    if(!$this->objdb->objresult)
	    	return 100;
	    else	
	    	return 3;
	}
	
	function deletePreentradaByEntrada($entrcodigon)
	{
		$sql='DELETE FROM "preentrada" WHERE "entrcodigon"='.$entrcodigon;
	    $this->objdb->fncadoexecute($sql);
	    if(!$this->objdb->objresult)
	    	return 100;
	    else	
	    	return 3;
	}
	
	function updatePreentrada($preecodigon,$entrcodigon)
	{
		$sql='UPDATE "preentrada" SET "entrcodigon"='.$entrcodigon.' WHERE "preecodigon"='.$preecodigon;
	    $this->objdb->fncadoexecute($sql);
	    if(!$this->objdb->objresult)
	    	return 100;
	    else	
	    	return 3;
	}
	
	function getCitasProgramadasById($contcodigon,$preecodigon=false)
	{
		$sql = 'SELECT *';
		$sql .= ' FROM "entrada" LEFT JOIN "preentrada" ON ("preentrada"."entrcodigon"="entrada"."entrcodigon")';
		$sql .= ' LEFT JOIN "organentrada" ON ("organentrada"."entrcodigon"="entrada"."entrcodigon")';
		$sql .= ' WHERE "preentrada"."contcodigon"='.$contcodigon;
		if($preecodigon)
			$sql .= ' AND "preentrada"."preecodigon"='.$preecodigon;
		//$sql .= ' AND "organentrada"."perscodigos"=\'\'';
			
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	
	function getCitasSinProgramarById($contcodigon=false,$preecodigon=false,$catecodigon=false)
	{
		$this->objdb->rcresult = false;
		$sql = 'SELECT *';
		$sql .= ' FROM "preentrada"';
		$sql .= ' WHERE "preentrada"."entrcodigon" IS NULL';
		if($contcodigon)
			$sql .= ' AND "preentrada"."contcodigon"='.$contcodigon.' ';
		if($preecodigon)
			$sql .= ' AND "preentrada"."preecodigon"='.$preecodigon;
		if($catecodigon)
			$sql .= ' AND "preentrada"."catecodigon"='.$catecodigon;
		
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	
	function getEstadosEntrada()
	{
		$sql = 'SELECT * FROM "estadoentrada"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
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
    
    function getByIdPreentrada($preecodigon) {
    	$sql = 'SELECT * FROM "preentrada" WHERE "preecodigon"='.$preecodigon;
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
    }
	/**
	 * @copyright Copyright 2010 &copy; FullEngine
	 *
	 *  Contiene los SQL de las listas despleglables
	 * @param string $id Identificador del sql
	 * @param array $ircParam Arreglo con parametros de consulta
	 * @return string SQL
	 * @author creyes <cesar.reyes@parquesoft.com>
	 * @date 27-Nov-2010 15:27
	 * @location Cali-Colombia
	 */
	function getSqlConsult($id,$ircParam=null){
		settype($sbAct,"string");
		settype($sbSql,"string");
		switch($id){
			case "contacto_ref" :
				$sbAct = Application :: getConstant("REG_ACT");
				$sbSql = 'SELECT "solicitante"."solicodigos" AS "contcodigon",("contacto"."contindentis" || \' -- \' || COALESCE("B"."contnombre", \'\') || \' -- \' || COALESCE("clienombres", \'\')) AS "contnombre"  FROM "solicitante" LEFT JOIN "contacto" ON ("solicitante"."contcodigon"="contacto"."contcodigon") LEFT JOIN "cliente" ON ("solicitante"."cliecodigos"="cliente"."cliecodigos"),
						(SELECT "contcodigon",(COALESCE("contprinoms", \'\') || \' \' || COALESCE("contsegnoms", \'\') || \' \' || COALESCE("contpriapes", \'\') || \' \' || COALESCE("contsegapes", \'\')) AS "contnombre" FROM "contacto") AS "B"
						WHERE "contactivas"=\''.$sbAct.'\' AND "solicitante"."contcodigon"="B"."contcodigon"';
				break;
			case "contacto_ident" :
				$sbAct = Application :: getConstant("REG_ACT");
				$sbSql = 'SELECT "solicodigos" AS "contcodigon",("contindentis" || \' -- \' || COALESCE("contprinoms", \'\') || \' \' || COALESCE("contsegnoms", \'\') || \' \' || COALESCE("contpriapes", \'\') || \' \' || COALESCE("contsegapes", \'\') || \' -- \' || COALESCE("clienombres", \'\')) AS "contindentis"  FROM "solicitante" LEFT JOIN "contacto" ON ("solicitante"."contcodigon"="contacto"."contcodigon") LEFT JOIN "cliente" ON ("solicitante"."cliecodigos"="cliente"."cliecodigos") WHERE "contacto"."contactivas"=\''.$sbAct.'\'';
				break;
			default: $sbSql = null;
		}

		return $sbSql;
	}
} //End of Class SqlExtended
?>