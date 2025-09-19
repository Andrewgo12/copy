<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeHrPgsqlOrganizacionExtended {
	var $consult;
	var $objdb;
	function FeHrPgsqlOrganizacionExtended() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	
	function getOrganizacionByGrupcodigos($grupcodigos) {
		$sql = 'SELECT * FROM "organizacion" WHERE "grupcodigos"=\''.$grupcodigos.'\'';
		$sql .= ' ORDER BY "organombres"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	
	function getActiveByOrganizacion_fkey2($ircGrupcodigos,$ircesorcodigos) {
		if($ircesorcodigos){
			$sbestado = implode("','",$ircesorcodigos);
			$sbwhere = "AND \"esorcodigos\" NOT IN('".$sbestado."')";
		}
		$grupcodigos = "('".implode("','",$ircGrupcodigos)."')";
		$sql = 'SELECT * FROM "organizacion" WHERE "grupcodigos" IN '.$grupcodigos.' '.$sbwhere;
		$sql .= ' ORDER BY "organombres"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getAllOrganizacion($ircesorcodigos) {
		if($ircesorcodigos){
			$sbestado = implode("','",$ircesorcodigos);
			$sbwhere = " WHERE \"esorcodigos\" NOT IN('".$sbestado."')";
		}
		$sql = 'SELECT * FROM "organizacion"'.$sbwhere;
		$sql .= ' ORDER BY "organombres"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	
	function existOrganizaciongrupo($grupcodigos) {
		$sql = 'SELECT * FROM "organizacion" WHERE "grupcodigos"=\''.$grupcodigos.'\'';
		$sql .= ' ORDER BY "organombres"';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}
    
	/**
    * Copyright 2006 FullEngine
    * 
    * Genera un sql que Actualiza el estado de una organizacion 
    * @author creyes
    * @param string $orgacodigos
    * @return string
    * @date 14-January-2006 13:20:17
    * @location Cali-Colombia
    */
	function updateEstateOrganizacion($orgacodigos, $esorcodigos) {
		$this->rcSql[] = 'UPDATE "organizacion" SET "esorcodigos"=\''.$esorcodigos.'\' WHERE "orgacodigos"=\''.$orgacodigos.'\'';
	}
	/**
    * Copyright 2006 FullEngine
    * 
    * Actualiza los datos de una organizacion 
    * @author creyes
    * @param string $orgacodigos
    * @return string
    * @date 14-January-2006 13:20:17
    * @location Cali-Colombia
    */
	function updateOrganizacion($orgacodigos, $organombres, $tiorcodigos, $orgacgpads, $orgaordenn, $orgafechcred, $esorcodigos, $grupcodigos, $orgatelefo1s, $orgatelefo2s, $locacodigos) {
		$this->rcSql[] = 'UPDATE "organizacion" SET "organombres"=\''.$organombres.'\',"tiorcodigos"=\''.$tiorcodigos.'\',"orgacgpads"=\''.$orgacgpads.'\',"orgaordenn"='.$orgaordenn.' ,"orgafechcred"='.$orgafechcred.' ,"esorcodigos"=\''.$esorcodigos.'\',"grupcodigos"=\''.$grupcodigos.'\',"orgatelefo1s"=\''.$orgatelefo1s.'\',"orgatelefo2s"=\''.$orgatelefo2s.'\',"locacodigos"=\''.$locacodigos.'\' WHERE "orgacodigos"=\''.$orgacodigos.'\'';
	}
	/**
    * Copyright 2006 FullEngine
    * 
    * Ejecuta los sql almacenados en el array $this->rcSql
    * @author creyes
    * @param string $orgacodigos
    * @return string
    * @date 14-January-2006 13:20:17
    * @location Cali-Colombia
    */
    function execSql(){
        if(!is_array($this->rcSql))
            return false;
        $this->objdb->fncadoexecutetrans($this->rcSql);
        unset($this->rcSql);
        return $this->objdb->objresult;
    }
	function getActiveOrganizacionByOrgacgpads($isbOrgacodigos,$isbOrgacgpads,$ircEsorcodigos){
		
		settype($sbSql,"string");
		settype($sbState,"string");
		settype($sbParam,"string");
		
		if($ircEsorcodigos){
			$sbState = implode("','",$ircEsorcodigos);
			$sbParam = " AND \"esorcodigos\" NOT IN('".$sbState."')";
		}
		$sbSql = 'SELECT * FROM "organizacion" WHERE "orgacodigos" <>\''.$isbOrgacodigos.'\' AND "orgacgpads" =\''.$isbOrgacgpads.'\''.$sbParam;
		$sbSql .= ' ORDER BY "organombres"';
		$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	* Obtiene la informacion de un ente si esta activo
	* @author freina <freina@parquesoft.com>
	* @param string $isbOrgacodigos Cadena con el codigo del ente
	* @param array $ircEsorcodigos Arreglo con los estados de ente activo
	* @return	 array  con el resultado
	* @date 08-Jul-2005 10:29
	* @location Cali-Colombia
	*/
	function getOrganizacionActiveByOrgacodigos($isbOrgacodigos,$ircEsorcodigos){
		
		settype($sbSql,"string");
		settype($sbState,"string");
		settype($sbParam,"string");
		
		if($isbOrgacodigos && $ircEsorcodigos){
			$sbState = implode("','",$ircEsorcodigos);
			$sbParam = " AND \"esorcodigos\" NOT IN('".$sbState."')";
		}
		$sbSql = 'SELECT * FROM "organizacion" WHERE "orgacodigos"=\''.$isbOrgacodigos.'\''.$sbParam;
		$sbSql .= ' ORDER BY "organombres"';
		$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
    /**
    * Copyright 2006 FullEngine
    * 
    * Obtiene un listado de entes a partir de un array con los id de los entes,
    * Ejecuta la consulta armando un SELECT .... IN y retornando un array con indices asociativos
    * indice = id del ente; valor = nombre del ente
    * @author creyes
    * @param array $rcEntes
    * @return type name desc
    * @date 27-January-2006 12:36:26
    * @location Cali-Colombia
    */
    function getEntesByIdInArray($rcEntes){
        if(!is_array($rcEntes))
            return null;

		$objtmp = Application :: loadServices("General");
		$rctmp = $objtmp->getParam("human_resources", "ORG_INACT");
		$sbtmp = "'".implode("','",$rctmp)."'";
        
        $sbParam = " IN ('".implode("','",$rcEntes)."')";
		$sbSql = "SELECT * FROM organizacion WHERE orgacodigos $sbParam AND esorcodigos NOT IN ($sbtmp) ORDER BY organombres";
		$this->objdb->fncadosetmodefetch(FETCH_ASSOC);
		$this->objdb->fncadoexecute($sbSql);
		if (!$this->objdb->objresult)
			return null;
		while (!$this->objdb->objresult->EOF) {
			$rcTmp = $this->objdb->fncadofetch();
			$this->objdb->fncadomovenext();
            $rcResult[$rcTmp['orgacodigos']] = $rcTmp['organombres'];
        }
		return $rcResult;
    }
    
    function getAllPersonalLeaders()
	{
		settype($sbSql,"string");
		settype($sbState,"string");

		$sbState = Application :: getConstant("REG_ACT");
		$responsable = Application :: getConstant("GRUP_RESP");
		
		$sbSql = 'SELECT "orgacodigos","perscodigos","tiorcodigos" '.
				'FROM "organizacion","grupo","grupodetalle" '.
				'WHERE "organizacion"."grupcodigos"="grupo"."grupcodigos" '.
				'AND "grupodetalle"."grupcodigon"="grupo"."grupcodigon" '.
				'AND "grupodetalle"."persrespons"=\''.$responsable.'\' '.
				'AND "organizacion"."orgaactivas"=\''.$sbState.'\' '.
				'AND "grupo"."grupactivos"=\''.$sbState.'\' ';
		$sbSql .= ' ORDER BY "organombres"';
		$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		$rctmp = $this->objdb->rcresult;
		if(!is_array($rctmp))
			return false;
		else
			foreach ($rctmp as $rcRow)
				$rcResult[$rcRow["perscodigos"]] = array("orgacodigos"=>$rcRow["orgacodigos"],"tiorcodigos"=>$rcRow["tiorcodigos"]);
		return $rcResult;
	}

	function getOrganumerador($orgacodigos,$nuincremento=0)
  	{
  		if(!$orgacodigos || $nuincremento < 0){
  			return null;
  		}
  		// se inicia la transaccion
  		$this->objdb->fncadobegintrans();

  		//Se bloquea la tabla de numerador
		$this->objdb->fncadolock("organumerador");

  		//Consulta el registro
    	$sql='SELECT * FROM "organumerador" WHERE "orgacodigos"=\''.$orgacodigos.'\'';
    	$this->objdb->fncadoselect($sql,FETCH_ASSOC);
    	if(!$this->objdb->rcresult)
		{
			$sbsql = 'INSERT INTO "organumerador" VALUES (\''.$orgacodigos.'\',2)';
			$this->objdb->fncadoexecute($sbsql);
			if(!$this->objdb->objresult)
			{
				//cierra transaccion
				$this->objdb->fncadorollbacktrans();
				return null;
			}
			$nuindact = 1;
		}
		else
			$nuindact = $this->objdb->rcresult[0]["numeproximon"];

		//Hace el aumento del valor
		if($nuincremento){
			$nuindprox = $nuindact + $nuincremento;
		}
		else{
			$nuindprox = $nuindact + 1;
		}
		//Hace el update del registro
		$sbsql = 'UPDATE "organumerador" SET "numeproximon" = '.$nuindprox.' WHERE "orgacodigos"=\''.$orgacodigos.'\'';
		$this->objdb->fncadoexecute($sbsql);
		if(!$this->objdb->objresult)
		{
			//cierra transaccion
			$this->objdb->fncadorollbacktrans();
			return null;
		}
		//cierra transaccion
		$this->objdb->fncadocommittrans();
		return $nuindact;
  	}

	function getGrupoNombresByGrupcodigos($grupcodigos) {
		$sql='SELECT "grupnombres" FROM "grupo" WHERE "grupcodigos"=\''.$grupcodigos.'\'';
    	$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult[0]["grupnombres"];
	}
} //End of Class Organizacion
?>