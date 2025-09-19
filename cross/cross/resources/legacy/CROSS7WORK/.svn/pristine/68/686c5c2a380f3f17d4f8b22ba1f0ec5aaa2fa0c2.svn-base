<?php
class FeCrDataComunicacionManager {
	var $gateway;
	var $gatewayae;
	var $gatewayaex;
	var $gatewayac;

	function FeCrDataComunicacionManager() {
		$this->gateway = Application :: getDataGateway("SqlExtended");
		$this->gatewayae = Application :: getDataGateway("actaempresa");
		$this->gatewayaex = Application :: getDataGateway("actaempresaExtended");
		$this->gatewayac = Application :: getDataGateway("activiactaExtended");
	}
	/**
	 *   Propiedad intelectual del FullEngine.
	 *
	 *   Genera genera la data necesaria para crear el texto de una comunicacion
	 *   @author freina
	 *	@param string $isbordenumeros (Cadena con el codigo del requerimiento)
	 *	@return array or null (Arreglo con los datos para la comunicacion )
	 *   @date 28-Oct-2004 08:18
	 *   @location Cali-Colombia
	 */
	function getDataComunicacion($isbordenumeros) {

		settype($objGateway,"object");
		settype($objService, "object");
		settype($objtmps, "object");
		settype($rcResult, "array");
		settype($rcdata, "array");
		settype($rctmp, "array");
		settype($rcTmpC, "array");
		settype($rcContact, "array");
		settype($rcCliente, "array");
		settype($rcExtra,"array");
		settype($sborgacodigos, "string");
		settype($sbcliecodigos, "string");

		$rcdata = $this->gateway->getDataComunicacion($isbordenumeros);
		if ($rcdata){
			$rcdata = $rcdata[0];
				
			//se obtiene el nombre del ente organizacional
			if($rcdata["orgacodigos"]){
				$sborgacodigos = $rcdata["orgacodigos"];
				$objtmps = Application :: loadServices("Human_resources");
				$rctmp = $objtmps->getDataEntesOrg($sborgacodigos,true);
				$sborgacodigos = $rctmp["nombre"];
			}
				
			//se obtiene el contacto
			if($rcdata["contidentis"]){
				$objService = Application :: loadServices("Customers");
				$objGateway = $objService->getGateWay("solicitante");
				$objGateway->setData(array("solicodigos"=>$rcdata["contidentis"]));
				$objGateway->getSolicitante();
				$rcTmpC = $objGateway->getResult();
				if(is_array($rcTmpC) && $rcTmpC){
					$rcTmpC = $rcTmpC[0];
					$objGateway = $objService->getGateWay("contacto");
					$rcContact = $objGateway->getByIdContacto($rcTmpC["contcodigon"]);
					if(is_array($rcContact) && $rcContact){
						$rcContact = $rcContact[0];
						$sbcliecodigos = "(".$rcContact["contindentis"].") ".
										$rcContact["contnombre"];
					}
					if($rcTmpC["cliecodigos"]){
						$objGateway = $objService->getGateWay("cliente");
						$rcCliente = $objGateway->getByIdCliente($rcTmpC["cliecodigos"]);
						if(is_array($rcCliente) && $rcCliente){
							$rcCliente = $rcCliente[0];
							$sbcliecodigos .= " -- "."(".$rcCliente["clieidentifs"].") ".$rcCliente["clienombres"];
						}
					}
				}
				$objService->close();
			}
			
			//se obtiene el detalle de las actas
			$rcResult["actuaciones"] = $this->ObtainDetail($rcdata["ordenumeros"]);
				
			//se arma la matriz resultante
			$rcResult["caso"] = $rcdata["ordenumeros"];
			$rcResult["radicacion"] = $rcdata["oremradicas"];
			$rcResult["cliente"] = $sbcliecodigos;
			if($rcdata["ordefecregd"]){
				$objtmps = Application :: loadServices("DateController");
				$rcResult["fecha_reg"]= $objtmps->fncformatofecha($rcdata["ordefecregd"]);
			}
			$rcResult["observaciones"]= $rcdata["ordeobservs"];
			$rcResult["ente"] = $sborgacodigos;
			$rcResult["sitio"] = $rcdata["ordesitiejes"];
		}

		//se obtiene el label del medio de recepcion
		$objGateway = Application :: getDataGateway("mediorecepcion");
		$rcTmp = $objGateway->getByIdMediorecepcion($rcdata["merecodigos"]);
		if($rcTmp && is_array($rcTmp)){
			$rcResult["recepcion"] = $rcTmp[0]["merenombres"];
		}

		//se obtiene el nombre del infracto
		$objGateway = Application :: getDataGateway("infractor");
		$rcTmp = $objGateway->getByIdInfractor($rcdata["infrcodigos"]);
		if($rcTmp && is_array($rcTmp)){
			$rcResult["denunciado"] = $rcTmp[0]["infrnombres"];
		}
		
		//carga en el request la informacion adicional
		$rcExtra = $this->getDataExtra($rcdata["ordenumeros"] , $rcdata["proccodigos"], $rcdata);
		
		if(is_array($rcExtra) && $rcExtra){
			$rcResult = array_merge($rcResult,$rcExtra);
		}
		return $rcResult;
	}
	/**
	 * @copyright Copyright 2004 &copy; FullEngine
	 *
	 * Obtiene la informacion de los detalles de las actas de un requerimiento
	 * @param string $isbordenumeros (Cadena con el codigo del requerimiento)
	 * @return string $osbresult (Cadena con el detalle)
	 * @author freina <freina@parquesoft.com>
	 * @date 14-Dic-2004 16:21
	 * @location Cali-Colombia
	 */
	function ObtainDetail($isbordenumeros) {

		settype($objtmps, "object");
		settype($rctmp, "array");
		settype($rctmpa, "array");
		settype($rctmpac, "array");
		settype($rctmpaa, "array");
		settype($rctmpd, "array");
		settype($rctmpdetail, "array");
		settype($osbresult, "string");

		if ($isbordenumeros) {
				
			//Se busca las actas de un requerimiento
			$objtmps = Application :: loadServices("Workflow");
			$rctmpa = $objtmps->getByOrdenActiveActas($isbordenumeros);
				
			if ($rctmpa) {
				//se obtienen los detalle del acta y sus actividades
				foreach ($rctmpa as $rctmp) {
					$rctmpdetail = $this->gatewayaex->getByActaempresa_fkey($rctmp["actacodigos"]);
					//se obtienen las actividades
					if ($rctmpdetail) {
						foreach ($rctmpdetail as $rctmpd) {
							$osbresult .= "\n".$rctmpd["acemobservas"]."\n";
							$rctmpac = $this->gatewayac->ObtainActivitiesDetail($rctmpd["acemnumeros"]);
							if($rctmpac){
								foreach($rctmpac as $rctmpaa){
									$osbresult .= "\t - ".$rctmpaa["actinombres"]."\n";
								}
							}
						}
					}
				}
			}
		}
		return $osbresult;
	}
	//----------------------------------
	/**
	* @copyright Copyright 2010 FullEngine
	*
	* Obtiene la informacion dinamica de los casos
	* @param string $sbOrdenumeros Cadena con el numero caso
	* @param string $sbProccodigos Cadena con el numero del proceso
	* @param $rcParams Array Arreglo con la data de la orden
	* @return boolean true ok, false error
	* @author freina <freina@parquesoft.com>
	* @date 27-Oct-2010 21:18
	* @location Cali-Colombia
	*/
	function getDataExtra($sbOrdenumeros , $sbProccodigos, $rcParams){

		settype($objService,"object");
		settype($objGateway,"object");
		settype($objManager,"object");
		settype($objDate, "object");
		settype($rcField,"array");
		settype($rcUser,"array");
		settype($rcDim,"array");
		settype($rcResult,"array");
		settype($sbResult,"string");
		settype($sbTable,"string");

		if($sbOrdenumeros && $sbProccodigos && is_array($rcParams) && $rcParams){

			//Para cargar el lenguaje
			$rcUser = Application :: getUserParam();

			$objService = Application::loadServices('General');
			$objManager = $objService->InitiateClass('DimensionManager');
			$objManager->setCodidominios ('proceso');
			$objManager->setCodidomicams ('proccodigos');
			$objManager->setCodidomivals ($sbProccodigos);
			$objManager->setIdProcess($rcUser["username"]);
			$objManager->setVadidominios ('ordenumeros');
			$objManager->setVadidomivals ($sbOrdenumeros);
			$objManager->setParams($rcParams);
			$objManager->setOperation ('getValorDimension');
			$objManager->execute();
			$sbResult = $objManager->getResult();
			$sbTable = $objManager->getTmpTable();
			$rcDim = $objManager->getDetalleDimension();
			$objService->close();

			//Consulta los datos adicionales
			if($sbResult){
				//Determina los campos fecha
				if(is_array($rcDim) && $rcDim){
					foreach($rcDim as $rcField){
						if($rcField['dediformatos'] == 'date'){
							if($rcField['dediformatos'] == 'date'){
								$rcDateFields[] = $rcField['dedinombres'];	
							}
						}
					}
				}
				$objGateway = Application :: getDataGateway("OrdenempresaExtended");
				$rcResult = $objGateway->getDataFichaAdicional($sbTable, $sbOrdenumeros, $rcDateFields);
			}
		}

		return $rcResult;
	}
}
?>