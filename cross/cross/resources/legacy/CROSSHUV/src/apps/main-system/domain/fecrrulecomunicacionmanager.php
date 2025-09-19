<?php
class FeCrRuleComunicacionManager {
	var $rcdatos;
	var $objtmps;
	function RuleComunicacionManager() {
		$this->objtmps = Application :: getDataGateway("SqlExtended");
		$this->gatewayaex = Application :: getDataGateway("actaempresaExtended");
		$this->gatewayac = Application :: getDataGateway("activiactaExtended");
	}
	function setData($rcData) {
		$this->rcdatos = $rcData;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Genera una comunicacion a un  cliente cuando una tarea cambia de estado.
	* 	estos metodos varian de acuerdo a la configuracion de la empresa 
	*   @author freina
	*	@return array or null (Arreglo con los resultados de los metodos )
	*									[result] boolean, Indica si el metodo fue ejecutado exitosamente
	*									[type] cadena, Tipo de resultado sql o execute
	*									[service]Nombre del servicio en donde se encuentra el metodo a ejecutar
	*									[method] Nombre del metodo a ejecutar
	*									[query] Cadena con el sql en caso de que el tipo sea sql
	*   @date 07-Apr-2006 15:41
	*   @location Cali-Colombia
	*/
	function fncInternalCustomerCommunication() {

		settype($objService, "object");
		settype($objGateway, "object");
		settype($rcTmp, "array");
		settype($rcDataCom, "array");
		settype($rcData, "array");
		settype($rcResult, "array");
		settype($rcTmpC, "array");
		settype($rcContact, "array");
		settype($rcCliente, "array");
		settype($sbResult, "string");
		settype($sbOrgacodigos, "string");
		settype($sbOrganombres, "string");
		settype($sbcontidentis, "string");
		settype($sbContnombre, "string");
		settype($sbOrdeobservs, "string");

		$rcResult["resultado"] = false;

		if ($this->rcdatos) {

			//obtiene arma la data de la comunicacion
			$rcData = $this->rcdatos;

			//se obtiene el nombre del ente organizacional
			if ($rcData["orgacodigos"]) {
				$sbOrgacodigos = $rcData["orgacodigos"];
				$objService = Application :: loadServices("Human_resources");
				$rcTmp = $objService->getDataEntesOrg($sbOrgacodigos, true);
				if ($rcTmp) {
					$sbOrganombres = $rcTmp["nombre"];
				}
			}

			//se obtiene el contacto
			if($rcData["contidentis"]){
				$sbcontidentis = $rcData["contidentis"];
				$objService = Application :: loadServices("Customers");
				$objGateway = $objService->getGateWay("solicitante");
				$objGateway->setData(array("solicodigos"=>$sbcontidentis));
				$objGateway->getSolicitante();
				$rcTmpC = $objGateway->getResult();
				if(is_array($rcTmpC) && $rcTmpC){
					$rcTmpC = $rcTmpC[0];
					$objGateway = $objService->getGateWay("contacto");
					$rcContact = $objGateway->getByIdContacto($rcTmpC["contcodigon"]);
					if(is_array($rcContact) && $rcContact){
						$rcContact = $rcContact[0];
						$sbContnombre = "(".$rcContact["contindentis"].") ".
										$rcContact["contnombre"];
					}
					if($rcTmpC["cliecodigos"]){
						$objGateway = $objService->getGateWay("cliente");
						$rcCliente = $objGateway->getByIdCliente($rcTmpC["cliecodigos"]);
						if(is_array($rcCliente) && $rcCliente){
							$rcCliente = $rcCliente[0];
							$sbContnombre .= " -- "."(".$rcCliente["clieidentifs"].") ".$rcCliente["clienombres"];
						}
					}
				}
				$objService->close();
			}

			//se obtiene el detalle de las actas  
			$sbOrdeobservs = $this->ObtainDetail($rcData["ordenumeros"]);
			
			if($sbOrdeobservs){
				$rcDataCom["actuaciones"] = $sbOrdeobservs;
			}
			
			//se arma la matriz resultante
			$rcDataCom["cliente"] = $sbContnombre;
			$rcDataCom["requerimiento"] = $rcData["ordenumeros"];
			if($rcData["ordefecregd"]){
				$objService = Application :: loadServices("DateController");
				$rcDataCom["fecha_reg"]= $objService->fncformatofecha($rcData["ordefecregd"]);
			}
			$rcDataCom["observaciones"]= $rcData["ordeobservs"];
			$rcDataCom["ente"] = $sbOrganombres;
			$rcDataCom["sitio"] = $rcData["ordesitiejes"];

			$sbFocacodigos = $this->fncDetermineFormatCommunication($rcData);

			if ($sbFocacodigos) {
				// se obtiene el sql
				$objtmp = Application :: loadServices("General");
				$sbResult = $objtmp->getSqlCommunication($rcData["ordenumeros"], $sbFocacodigos, $rcDataCom);

				if ($sbResult) {
					$rcResult["result"] = true;
					$rcResult["type"] = "sql";
					$rcResult["query"] = $sbResult;
					$rcResult["parameters"] = "";
					$rcResult["service"] = "";
					$rcResult["method"] = "";
					$rcResult["resultado"] = true;
				}
			}
		}
		return $rcResult;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Busca el formato que se debe utilizar para la comunicacion comparando 
	* 	los datos del requerimiento y los de la base de datos
	*   @author freina
	*	@param array $rcData (Arreglo con la data del requerimiento)
	*	@return string $osbfocacodigos (Codigo del formato)
	*   @date 29-Oct-2004 14:59
	*   @location Cali-Colombia
	*/
	function fncDetermineFormatCommunication($rcData) {

		settype($rcTmp, "array");
		settype($rcFormatos, "array");
		settype($rcKeys, "array");

		if ($rcData) {
			/*Consulta las configuraciones en la base de datos*/
			$rcTmp = $this->fncObtainConfigurationFormat();
			if ($rcTmp) {
				/*Busca el proceso de acuerdo a los datos del caso y la configuracion*/
				$rcFormatos = $this->fncDetermineFormat($rcData, $rcTmp);
			}
		}
		if (!is_array($rcFormatos))
			return null;
		//determina el formato con mayor cantidad de coincidencias
		arsort($rcFormatos); //Orden descendente
		reset($rcFormatos);
		//Extrae la clave del primer elemento
		$rcKeys = array_keys($rcFormatos);
		return $rcKeys[0];
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Determina el formato que utilizara la comunicacion
	*   @author freina
	*	@param array $rcData (Arreglo con la data del requerimiento)
	*	@param array $rcConfiguration (Arreglo con la data de configuracion)
	*	@return string $osbfocacodigos (Codigo del formato o null)
	*   @date 29-Oct-2004 15:50
	*   @location Cali-Colombia
	*/
	function fncDetermineFormat($rcData, $rcConfiguration) {
		settype($rcTmp, "array");
		settype($nuResult, "integer");

		foreach ($rcConfiguration as $rcTmp) {
			$nuResult = $this->fncValidateData($rcData, $rcTmp[1]);
			if ($nuResult)
				$rcFormat[$rcTmp[0]] = $nuResult;
		}
		return $rcFormat;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Valida si la data del requerimiento encaja en alguna de las configuraciones existentes
	*   @author freina
	*	@param array $rcData (Arreglo con la data del requerimiento)
	*	@param array $rcConfiguration (Arreglo con la data de configuracion)
	*	@return boolean  (true si encaja o false si no)
	*   @date 29-Oct-2004 15:53
	*   @location Cali-Colombia
	*/
	function fncValidateData($rcData, $rcConfiguration) {

		settype($objTmpv, "object");
		settype($rcTmp, "array");
		settype($sbResult, "string");
		settype($nuAciertos, "integer");

		$objTmpv = Application :: loadServices("ValidationData");

		foreach ($rcConfiguration as $rcTmp) {
			$sbResult = $objTmpv->fnccompara($rcData[$rcTmp["cacoprocedes"]], $rcTmp["decooperados"], $rcTmp["decovalors"]);
			if ($sbResult === false) {
				return 0;
			}
			$nuAciertos ++;
		}
		return $nuAciertos;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Consulta las configuraciones para determinar el formato en la base de datos
	*   @author freina
	*	@return array $orcresult o  null (Arreglo con las configuraciones  o null en caso de que no haya registros)
	*   @date 29-Oct-2004 11:08
	*   @location Cali-Colombia
	*/
	function fncObtainConfigurationFormat() {

		settype($orcResult, "array");
		settype($rcresult, "array");
		settype($rcTmp, "array");
		settype($objtmp, "object");
		settype($nucont, "integer");

		$objtmp = Application :: getDataGateway("configformat");
		$rcresult = $objtmp->getAllConfigformat();
		if ($rcresult) {
			/*Hace la consulta de los campos de cada configuracion*/
			foreach ($rcresult as $rcTmp) {
				$rcTmpc = $this->fncSelectFields($rcTmp["cofocodigon"]);
				if ($rcTmpc) {
					$orcResult[$nucont][0] = $rcTmp["focacodigos"];
					$orcResult[$nucont][1] = $rcTmpc;
					$nucont ++;
				}
			}
		}
		return $orcResult;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Seleciona los campos en la base de datos
	*   @author freina
	*	@param integer $nuCofocodigon (Codigo de la configuracion)
	*	@return array $orcResult o  null (Arreglo con los campos a validar  o null en caso de que no haya registros)
	*		[n][0] = nombre del campo tal cual en la bd
	*		[n][1] = operador logico
	*		[n][2] = valor base
	*   @date 29-Oct-2004 15:20
	*   @location Cali-Colombia
	*/
	function fncSelectFields($nuCofocodigon) {

		settype($orcResult, "array");
		settype($rcResult, "array");
		settype($rcRow, "array");
		settype($rcTmp, "array");
		settype($objTmp, "object");
		settype($nuCont, "integer");

		$rcResult = $this->objtmps->getByCofocodigonLj($nuCofocodigon);
		if ($rcResult) {
			foreach ($rcResult as $nuCont => $rcRow) {
				$rcTmp = explode(".", $rcRow["cacoprocedes"]);
				if ($rcTmp[1]) {
					$rcRow["cacoprocedes"] = $rcTmp[1];
				} else {
					$rcRow["cacoprocedes"] = $rcTmp[0];
				}
				$orcResult[$nuCont] = $rcRow;
			}
		}
		return $orcResult;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Obtiene la informacion de los detalles de las actas de un caso
	* @param string $sbOrdenumeros (Cadena con el codigo del caso)
	* @return string $sbResult (Cadena con el detalle)
	* @author freina <freina@parquesoft.com>
	* @date 07-Apr-2006 15:12
	* @location Cali-Colombia
	*/
	function ObtainDetail($sbOrdenumeros) {

		settype($objTmps, "object");
		settype($rcTmp, "array");
		settype($rcTmpa, "array");
		settype($rcTmpac, "array");
		settype($rcTmpaa, "array");
		settype($rcTmpd, "array");
		settype($rcTmpdetail, "array");
		settype($sbResult, "string");

		if ($sbOrdenumeros) {

			//Se busca las actas de un requerimiento
			$objTmps = Application :: loadServices("Workflow");
			$rcTmpa = $objTmps->getByOrdenActiveActas($sbOrdenumeros);

			if ($rcTmpa) {
				//se obtienen los detalle del acta y sus actividades
				foreach ($rcTmpa as $rcTmp) {
					$rcTmpdetail = $this->gatewayaex->getByActaempresa_fkey($rcTmp["actacodigos"]);
					//se obtienen las actividades
					if ($rcTmpdetail) {
						foreach ($rcTmpdetail as $rcTmpd) {
							$sbResult .= "\n".$rcTmpd["acemobservas"]."\n";
							$rcTmpac = $this->gatewayac->ObtainActivitiesDetail($rcTmpd["acemnumeros"]);
							if ($rcTmpac) {
								foreach ($rcTmpac as $rcTmpaa) {
									$sbResult .= "\t - ".$rcTmpaa["actinombres"]."\n";
								}
							}
						}
					}
				}
			}
		}
		return $sbResult;
	}
}
?>	