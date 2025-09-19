<?php  
class FeHrOrganizacionManager {
	
	function FeHrOrganizacionManager() {
		$this->gateway = Application :: getDataGateway("organizacion");
		$this->gatewaye = Application :: getDataGateway("organizacionExtended");
	}
	function addOrganizacion($orgacodigos, $organombres, $tiorcodigos, $orgacgpads, $orgaordenn, $orgafechcred, $esorcodigos, $grupcodigos, $orgatelefo1s, $orgatelefo2s, $locacodigos) {
		if ($this->gateway->existOrganizacion($orgacodigos) == 0) {
			$this->gateway->addOrganizacion($orgacodigos, $organombres, $tiorcodigos, $orgacgpads, $orgaordenn, $orgafechcred, $esorcodigos, $grupcodigos, $orgatelefo1s, $orgatelefo2s, $locacodigos);
			if ($this->gateway->consult == false)
				return 100;
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}
	function updateOrganizacion($orgacodigos, $organombres, $tiorcodigos, $orgacgpads, $orgaordenn, $orgafechcred, $esorcodigos, $grupcodigos, $orgatelefo1s, $orgatelefo2s, $locacodigos) {
		$rcExists = $this->getByIdOrganizacion($orgacodigos);
		if (is_array($rcExists)) {
			if($rcExists[0]["orgacgpads"] != $orgacgpads) {
				return 25;
			}
			$this->gatewaye->updateOrganizacion($orgacodigos, $organombres, $tiorcodigos, $orgacgpads, $orgaordenn, $orgafechcred, $esorcodigos, $grupcodigos, $orgatelefo1s, $orgatelefo2s, $locacodigos);
			$rcOrgaHijos = $this->fncinicio($orgacodigos, false);
            
			//Cambia el estado a todos hijos solo si el padre se inactiva
            $objService = Application :: loadServices("General");
			$rcState = $objService->getParam("human_resources", "ORG_INACT");			
			if(is_array($rcState) && $rcState && in_array($esorcodigos, $rcState)){
				foreach($rcOrgaHijos as $rcTmp){
	            	$this->gatewaye->updateEstateOrganizacion($rcTmp['orgacodigos'], $esorcodigos);	
	            }	
			}
            
            //Ejecuta los sql
            $result = $this->gatewaye->execSql();
            if ($result == false)
				return 2;
            
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function deleteOrganizacion($orgacodigos) {
		if ($this->gateway->existOrganizacion($orgacodigos) == 1) {
            $service = Application::loadServices('Cross300');
            $gateway = $service->getGateWay("SqlExtended");
            $rcReq = $gateway->getReqByOrganizacion($orgacodigos);
            $service->close();
            if(is_array($rcReq))
                return 16;
			$this->gateway->deleteOrganizacion($orgacodigos);
			if ($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
    
	function getByIdOrganizacion($orgacodigos) {
		$data_organizacion = $this->gateway->getByIdOrganizacion($orgacodigos);
		return $data_organizacion;
	}
	function getAllOrganizacion() {
		//$this->gateway->
	}
	function getByOrganizacion_fkey($tiorcodigos) {
		//$this->gateway->
	}
	function getByOrganizacion_fkey1($esorcodigos) {
		//$this->gateway->
	}
	function getByOrganizacion_fkey2($grupcodigos) {
		return $this->gateway->getByOrganizacion_fkey2($grupcodigos);
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Obtiene los entes organizacionales activos de los cuales es responsable un empleado 
	*   @author freina
	*	@param string $isbgrupcodigos (Cadena con el codigo del empleado)
	*	@return array  (Arreglo con los registros o null)
	*   @date 05-Nov-2004 14:54
	*   @location Cali-Colombia
	*/
	function getActiveByOrganizacion_fkey2($isbgrupcodigos) {
		settype($objtmp, "object");
		settype($rctmp, "array");
		$objtmp = Application :: loadServices("General");
		$rctmp = $objtmp->getParam("human_resources", "ORG_INACT");
		
		//Trae todos los grupos de personas en los cuales la persona es responsable
		$gateway = Application :: getDataGateway("GrupoExtended");
		$rcGruposTmp = $gateway->getGruposByPerscodigosResp($isbgrupcodigos);
		if (!is_array($rcGruposTmp))
			return null;
		foreach ($rcGruposTmp as $key => $rcTmpG) {
			$rcGrupos[$key] = $rcTmpG["grupcodigos"];
		}
		return $this->gatewaye->getActiveByOrganizacion_fkey2($rcGrupos, $rctmp);
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*   
	*   Funcion de busqueda recursivo
	*   @param $ircdata array   Data total
	*   @param $ircpadre array  Data acumulada
	*   @param $isbpadre string Codigo a analizar
	*   @param $inuindice integer   Indice consecutivo
	*   @author freina
	*   @date 03-Nov-2004 16:41 
	*   @location Cali-Colombia
	*/
	function fncseleccion($isbpadre, & $ircdata, & $ircpadre, & $inuindice) {
		settype($orcresult, "array");
		settype($nucant, "integer");
		settype($nucont, "integer");
		$nucant = 0;
		$nucant = sizeof($ircdata);
		for ($nucont = 0; $nucont < $nucant; $nucont ++) {
			if ($ircdata[$nucont]["orgacgpads"] == $isbpadre) {
				$this->fncseleccion($ircdata[$nucont]["orgacodigos"], $ircdata, $ircpadre, $inuindice);
				$ircpadre[$inuindice] = $ircdata[$nucont];
				$inuindice ++;
			}
		}
		return;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*   
	*   Obtiene los hijos activosde una organizacion
	*   @param $isborgacodigos
	*   @author freina
	*   @date 06-Nov-2004 08:21 
	*   @location Cali-Colombia
	*/
	function fncinicio($isborgacodigos, $active=true) {

		settype($objtmp, "object");
		settype($orcresult, "array");
		settype($rctmp, "array");
		settype($nuindice, "integer");
		$nuindice = 0;
        
        $rctmp = null;
        if($active){
            $objtmp = Application :: loadServices("General");
            $rctmp = $objtmp->getParam("human_resources", "ORG_INACT");
        }
		$rctmp = $this->gatewaye->getAllOrganizacion($rctmp);
        
		if ($rctmp) {
			$this->fncseleccion($isborgacodigos, $rctmp, $orcresult, $nuindice);
		}

		return $orcresult;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Obtiene   los entes organizacionales activos hijos del ente pasado como
	* parametro
	*   @author freina
	* @param string $isbOrgacodigos Cadena con el codigo del ente a el cual se
	* le buscan los hermanos
	*	@param string $isbOrgacgpads (Cadena con el codigo del ente)
	*	@return array  $orcResult (Arreglo con los registros o null)
	*   @date 29-Jun-2005 13:58
	*   @location Cali-Colombia
	*/
	function getActiveOrganizacionByOrgacgpads($isbOrgacodigos, $isbOrgacgpads) {
		
		settype($objService, "object");
		settype($rcTmp, "array");
		settype($orcResult, "array");
		
		if($isbOrgacgpads){
			$objService = Application :: loadServices("General");
			$rcTmp = $objService->getParam("human_resources", "ORG_INACT");
			$orcResult = $this->gatewaye->getActiveOrganizacionByOrgacgpads($isbOrgacodigos, $isbOrgacgpads, $rcTmp);
		}
		return $orcResult;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	* Obtiene la informacion de un ente si esta activo
	* @author freina <freina@parquesoft.com>
	* @param string $isbOrgacodigos Cadena con el codigo del ente
	* @return	 array  $orcResult (Arreglo con el registro o null)
	* @date 08-Jul-2005 10:18
	* @location Cali-Colombia
	*/
	function getOrganizacionActiveByOrgacodigos($isbOrgacodigos) {
		
		settype($objService, "object");
		settype($rcTmp, "array");
		settype($orcResult, "array");
		
		if($isbOrgacodigos){
			$objService = Application :: loadServices("General");
			$rcTmp = $objService->getParam("human_resources", "ORG_INACT");
			$orcResult = $this->gatewaye->getOrganizacionActiveByOrgacodigos($isbOrgacodigos, $rcTmp);
		}
		return $orcResult;
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
        $orcResult = $this->gatewaye->getEntesByIdInArray($rcEntes);
        return $orcResult;
    }
    
	function UnsetRequest() {
		unset ($_REQUEST["organizacion__orgacodigos"]);
		unset ($_REQUEST["organizacion__organombres"]);
		unset ($_REQUEST["organizacion__tiorcodigos"]);
		unset ($_REQUEST["organizacion__orgacgpads"]);
		unset ($_REQUEST["organizacion__orgaordenn"]);
		unset ($_REQUEST["organizacion__orgafechcred"]);
		unset ($_REQUEST["organizacion__esorcodigos"]);
		unset ($_REQUEST["organizacion__grupcodigos"]);
		unset ($_REQUEST["organizacion__orgatelefo1s"]);
		unset ($_REQUEST["organizacion__orgatelefo2s"]);
		unset ($_REQUEST["organizacion__locacodigos"]);
		unset ($_REQUEST["organizacion_locacodigos_desc"]);
	}

	/**
    * Copyright 2009 FullEngine
    * 
    * MUEVE UN ENTE ORGANIZACIONAL A OTRA DEPENDENCIA FÍSICA (O SEA, ROTACIÓN DE PERSONAL)
    * 
    * @author mrestrepo
    * @param array $orgacodigos, $padre
    * @return type name desc
    * @date 26-Feb-2009 23:36:26
    * @location Cali-Colombia
    */
	
	function moveDependency($sbOrgacodigos,$sbPadre) {
		
		settype($objDate,"object");
		settype($objService, "object");
		settype($objGateway, "object");
		settype($objGatewayS, "object");
		settype($objManager, "object");
		settype($rcDependencia, "array");
		settype($rcPadreNuevo, "array");
		settype($rcCasos,"array");
		settype($rcTmp, "array");
		settype($rcUser, "array");
		settype($rcSql,"array");
		settype($rcTrTa, "array");
		settype($sbAct,"string");
		settype($sbEnteInactivo,"string");
		settype($sbPadreActual,"string");
		settype($sbNuevoEnte,"string");
		settype($sbNombreNuevo,"string");
		settype($sbResult, "string");
		settype($sbTrtacodigos, "string");
		settype($sbActacodigos, "string");
		settype($nuDate,"integer");
		settype($nuCont, "integer");
		
		$objDate = Application::loadServices("DateController");
		$nuDate = $objDate->fncintdatehour();
		$sbAct = Application::getConstant("REG_ACT");
		
		//leer com parametro
		$objService = Application::loadServices('General');
        $sbEnteInactivo = $objService->getParam("human_resources","ORG_INACT_DEFAULT");
		if(!$sbEnteInactivo){
			return  false;
		}
		
		$rcUser = Application :: getUserParam();
		include ($rcUser["lang"]."/".$rcUser["lang"].".messages.php");

		//1. Traer los casos del tipo
		$objService = Application::loadServices("Workflow");
		$objGateway = $objService->getGateWay("actaExtended");
		$rcCasos = $objGateway->getOrdenesByOrgacodigos($sbOrgacodigos);
		$objService->close();

		$rcDependencia = $this->getByIdOrganizacion($sbOrgacodigos);
		//valida que se encuentre la informacion de la dependencia a mover
		if(!is_array($rcDependencia) || !$rcDependencia){
			return  false;
		}
		$rcDependencia = $rcDependencia[0];
		$sbPadreActual = $rcDependencia["orgacgpads"];

		//2 Crear el nuevo ente con el mismo código pero con guión y consecutivo
		//2.1 Hallar el nuevo código
		$sbNuevoEnte = $this->getOrganumerador($sbOrgacodigos);
		if(!$sbNuevoEnte){
			return  false;
		}
		
		//2.2 Modificar el nombre con el nombre de la dependencia padre nueva y entre paréntesis el nombre de empleado
		$rcPadreNuevo = $this->getByIdOrganizacion($sbPadre);
		if(!is_array($rcPadreNuevo) || !$rcPadreNuevo){
			return  false;
		}
		$sbNombreNuevo = $rcPadreNuevo[0]['organombres'].'('.$this->getNombreGrupo($rcDependencia["grupcodigos"]).')';
		if(!$sbNombreNuevo){
			return  false;
		}
		
		//2.3 Ingresar el nuevo registro en organizacion - se pasa a sql.
		$objGateway = Application :: getDataGateway("organizacion");
		$objGateway->setExecuteSql(false);
		$objGateway->addOrganizacion($sbNuevoEnte, $rcDependencia['organombres'], $rcDependencia['tiorcodigos'], $rcDependencia['orgacgpads'], '1', 
									 $nuDate, $sbEnteInactivo, $rcDependencia['grupcodigos'], $rcDependencia['orgatelefo1s'], 
									 $rcDependencia['orgatelefo2s'], $rcDependencia['locacodigos']);
		
		
		//3. Modificar la dependencia con el nuevo nombre
		$objGateway->updateOrganizacion($sbOrgacodigos, $sbNombreNuevo, $rcDependencia['tiorcodigos'], 
													   $sbPadre, '1', $rcDependencia['orgafechcred'], $rcDependencia['esorcodigos'], 
													   $rcDependencia['grupcodigos'], $rcDependencia['orgatelefo1s'], $rcDependencia['orgatelefo2s'], 
													   $rcDependencia['locacodigos']);
		$rcSql = $objGateway->getSql();
		
		$objGateway = Application :: getDataGateway("moverDependencia");
		$objGateway->setExecuteSql(false);
		
		//4. Analizar los casos
		if (is_array($rcCasos) && $rcCasos){
			//4.1 Los casos pendientes pasárselos al padre anterior
			foreach($rcCasos as $nuCont=>$rcTmp) {
				
				//paso de las actas al padre actual
				$objGateway->setData(array("orgacodigos"=>$sbPadreActual,"actacodigos"=>$rcTmp["actacodigos"]));
				$objGateway->setActa();
				
				//se obtiene el sql de la transferencia de tareas
				$objService = Application::loadServices("Cross300");
				$objGatewayS = $objService->getGateWay("transfertarea");
				
				//se valida si el acta ya no tiene una transferencia
				$objManager = $objService->InitiateClass("TransfertareaManager");
				$rcTrTa = $objManager->getTranferByTarecodigos($rcTmp["actacodigos"]);
				$objManager = $objService->InitiateClass('NumeradorManager');
				if(!$rcTrTa){
					$sbTrtacodigos = $objManager->fncgetByIdNumerador("transfertarea");
					$objGatewayS->setExecuteSql(false);
					$objGatewayS->addTransfertarea($sbTrtacodigos,$rcTmp["actacodigos"],$rcTmp["orgacodigos"],$rcTmp["actafechingn"],$nuDate,null);
					$objGatewayS->setExecuteSql(true);
				}
				$sbTrtacodigos = $objManager->fncgetByIdNumerador("transfertarea");
				$objGatewayS->setExecuteSql(false);
				$objGatewayS->addTransfertarea($sbTrtacodigos,$rcTmp["actacodigos"],$sbPadreActual,$nuDate,$nuDate,html_entity_decode($rcmessages["27"]));
				$objService->close();
				$sbActacodigos .= ($sbActacodigos) ? ",".$rcTmp["actacodigos"] : $rcTmp["actacodigos"];
				
				//se obtienen los sql de las transferencias
				
				if(is_array($objGatewayS->getSql()) && $objGatewayS->getSql()){
					$rcSql = array_merge($rcSql,$objGatewayS->getSql());
				}
			}
		}
		
		//4.2 luego se realiza un recorrido por las diferentes tablas que estan relacionadas con la dependencia
		//y se cambia al codigo nuevo
		$objGateway->setData(array("orgacodigos"=>$sbNuevoEnte,"orgacodigos_old"=>$sbOrgacodigos));
		$objGateway->setActa();
		$objGateway->setActaempresa();
		$objGateway->setBodega();
		$objGateway->setEmail();
		$objGateway->setOrdenempresa();
		$objGateway->setOrdenempresa_log();
		$objGateway->setTransfertarea();
		$objGateway->setDetaretape();
		$objGateway->setOrganentrada();
		$objGateway->setRespuestausu();
		
		//5. GUARDAR EL LOG
		$objGateway->setData(array("loroorolcods"=>$sbOrgacodigos ,"loroornecods"=>$sbNuevoEnte,"loroornenoms"=>$sbNombreNuevo,
								   "loroorcopaos"=>$sbPadreActual,"loroorcopans"=>$sbPadre,"loroordpads"=>$sbActacodigos, "loroordnews"=>NULL,
								   "lorofechregn"=>$nuDate,"usuacodigos"=>$rcUser["username"]));
		$objGateway->saveLogRotacion();
		
		//por ultimo se realiza el grabado en la bd
		
		if(is_array($objGateway->getSql()) && $objGateway->getSql()){
			$rcSql = array_merge($rcSql,$objGateway->getSql());
		}
		
		if(is_array($rcSql) && $rcSql){
			$objGateway->setSql($rcSql);
			$objGateway->executeTrans();
			$sbResult = $objGateway->getConsult();
		}		
			
		return $sbResult;
	}
	
	function getOrganumerador($sbOrgacodigos) {
		settype($sbConsec,"string");
		settype($sbResult,"string");
		$sbConsec = $this->gatewaye->getOrganumerador($sbOrgacodigos);
		if($sbConsec){
			$sbResult = $sbOrgacodigos.'-'.$sbConsec;
		}
		return $sbResult;
	}

	function getNombreGrupo($sbGrupcodigos) {
		return $this->gatewaye->getGrupoNombresByGrupcodigos($sbGrupcodigos);
	}
}
?>