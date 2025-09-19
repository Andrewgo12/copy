<?php
class FeCrRuleEmailManager {
	var $rcdatos;
	var $gateway;
	var $gatewayae;
	var $gatewayaex;
	var $gatewayac;
	function RuleEmailManager() {
		$this->gateway = Application :: getDataGateway("SqlExtended");
		$this->gatewayaex = Application :: getDataGateway("actaempresaExtended");
		$this->gatewayac = Application :: getDataGateway("activiactaExtended");
		
	}
	function setData($rcData){
		$this->rcdatos = $rcData;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Genera un email cuando a un  cliente cuando una tarea cambia de estado. 
	*   @author freina
	*	@return array or null (Arreglo con los resultados de los metodos )
	*									[result] boolean, Indica si el metodo fue ejecutado exitosamente
	*									[type] cadena, Tipo de resultado sql o execute
	*									[service]Nombre del servicio en donde se encuentra el metodo a ejecutar
	*									[method] Nombre del metodo a ejecutar
	*									[query] Cadena con el sql en caso de que el tipo sea sql
	*   @date 07-Oct-2004 10:46
	*   @location Cali-Colombia
	*/
	function fncInternalCustomerEmail() {

		settype($objTmps, "object");
		settype($objService, "object");
		settype($objServiceDate, "object");
		settype($objGateway, "object");
		settype($orcResult, "array");		
		settype($rcOrden, "array");
		settype($rcUser, "array");
		settype($rcData, "array");
		settype($rcTmp, "array");
		settype($rcTexto, "array");
		settype($rcResult, "array");
		settype($rcInfoCompany, "array");
		settype($rcTmpCo, "array");
		settype($sbSignal, "string");
		settype($sbOrgacodigos, "string");
		settype($sbOrganombres, "string");
		settype($sbContnombre, "string");
		settype($sbcontidentis, "string");
		settype($sbContemail, "string");
		settype($sbOrdeobservs, "string");
		settype($sbDate, "string");

		$rcData = $this->rcdatos;

		//Busca el email corporativo para el from del correo
		$objService = Application :: loadServices('General');
		$rcInfoCompany = $objService->getParam('general', 'empresa');
		$sbOrgaemails = $rcInfoCompany['empremail'];

		if ($rcData) {

			$rcUser = Application :: getUserParam();			

			//se obtiene el nombre del ente organizacional
			if ($rcData["orgacodigos"]) {
				$sbOrgacodigos = $rcData["orgacodigos"];
				$objTmps = Application :: loadServices("Human_resources");
				$rcTmp = $objTmps->getDataEntesOrg($sbOrgacodigos, true);
				if ($rcTmp) {
					$sbOrganombres = $rcTmp["nombre"];
				}
			}

			//se obtiene el contacto
			if ($rcData["contidentis"]) {
				$sbcontidentis = $rcData["contidentis"];
				$objService = Application :: loadServices("Customers");
				$objGateway = $objService->getGateWay("solicitante");
				$objGateway->setData(array("solicodigos"=>$sbcontidentis));
				$objGateway->getSolicitante();
				$rcTmpCo = $objGateway->getResult();
				if(is_array($rcTmpCo) && $rcTmpCo){
					$rcTmpCo = $rcTmpCo[0];
					$objGateway = $objService->getGateWay("contacto");
					$rcContact = $objGateway->getByIdContacto($rcTmpCo["contcodigon"]);
					if(is_array($rcContact) && $rcContact){
						$sbContnombre = $rcContact[0]["contnombre"];
						$sbContemail = $rcContact[0]["contemail"];
					}
				}
				$objService->close();
			}

			//se obtiene el detalle de las actas  
			$sbOrdeobservs = $this->ObtainDetail($rcData["ordenumeros"]);

			//Se obtiene el formato del email
			$sbSignal = $this->fncDetermineFormatEmail($rcData);

			$rcResult["dir_destino"] = $sbContemail;
			$rcResult["formato"] = $sbSignal;
			//servicio de fechas
			$objServiceDate = Application :: loadServices("DateController");
			//fecha de hoy
			$sbDate = $objServiceDate->getLongDate();
			$rcData["ordefecregd"] = $objServiceDate->fncformatofecha($rcData["ordefecregd"]);
			if($rcData["ordefecfinad"]){
				$rcData["ordefecfinad"] = $objServiceDate->fncformatofecha($rcData["ordefecfinad"]);
			}
			$rcTexto = array ("cliente" => $sbContnombre, "caso" => $rcData["ordenumeros"], 
							  "actuaciones" => $sbOrdeobservs, "fecha_reg" => $rcData["ordefecregd"], 
							  "observaciones" => $rcData["ordeobservs"], "ente" => $sbOrganombres, 
							  "sitio" => $rcData["ordesitiejes"],
							  "hoy"=>$sbDate,"fec_fin"=>$rcData["ordefecfinad"]);
			$rcResult["caso"] = $rcData["ordenumeros"];
			$rcResult["responsable"] = $sbOrgacodigos;
			$rcResult["dir_origen"] = $sbOrgaemails;
			$rcResult["usuario"] = $rcUser["username"];
			$rcResult["adjunto"] = "";
		}

		$orcResult["result"] = false;

		$objTmps = Application :: loadServices("General");
		$rcResult["texto"] = $objTmps->getTextEmail($sbSignal,$rcTexto, false);
		$rcResult["asunto"] = $objTmps->getSubjectEmail($sbSignal,$rcTexto);
		if ($rcResult["texto"] && $rcResult["asunto"]) {
			$orcResult["result"] = true;
			$orcResult["type"] = "execute";
			$orcResult["query"] = "";
			$orcResult["parameters"] = $rcResult;
			$orcResult["service"] = "General";
			$orcResult["method"] = "sendEmail";
		}
		return $orcResult;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Obtiene la informacion de los detalles de las actas de un requerimiento
	* @param string $isbordenumeros (Cadena con el codigo del requerimiento)
	* @return string $osbresult (Cadena con el detalle)
	* @author freina <freina@parquesoft.com>
	* @date 15-Dic-2004 12:43
	* @location Cali-Colombia
	*/
	function ObtainDetail($isbordenumeros) {

		settype($objTmps, "object");
		settype($rcTmp, "array");
		settype($rcTmpa, "array");
		settype($rcTmpac, "array");
		settype($rcTmpaa, "array");
		settype($rcTmpd, "array");
		settype($rcTmpdetail, "array");
		settype($osbresult, "string");

		if ($isbordenumeros) {

			//Se busca las actas de un requerimiento
			$objTmps = Application :: loadServices("Workflow");
			$rcTmpa = $objTmps->getByOrdenActiveActas($isbordenumeros);

			if ($rcTmpa) {
				//se obtienen los detalle del acta y sus actividades
				foreach ($rcTmpa as $rcTmp) {
					$rcTmpdetail = $this->gatewayaex->getByActaempresa_fkey($rcTmp["actacodigos"]);
					//se obtienen las actividades
					if ($rcTmpdetail) {
						foreach ($rcTmpdetail as $rcTmpd) {
							$osbresult .= "<br>".$rcTmpd["acemobservas"]."<br>";
							$rcTmpac = $this->gatewayac->ObtainActivitiesDetail($rcTmpd["acemnumeros"]);
							if ($rcTmpac) {
								foreach ($rcTmpac as $rcTmpaa) {
									$osbresult .= "\t - ".$rcTmpaa["actinombres"]."<br>";
								}
							}
						}
					}
				}
			}
		}
		return $osbresult;
	}
	/**
	 * Propiedad intelectual del FullEngine.
	 * 
	 * Busca el formato que se debe utilizar para el texto del email comparando
	 * los datos del requerimiento y los de la base de datos
	 * 
	 * @author freina
	 * @param array $ircdata (Arreglo con la data del requerimiento)
	 * @return string $osbfoemcodigos (Codigo del formato)
	 * @date 01-Dic-2005 11:49
	 * @location Cali-Colombia
	 * */
	function fncDetermineFormatEmail($ircdata) {

		settype($rcTmp, "array");
		settype($rcFormatos, "array");

		if ($ircdata) {
			/*Consulta las configuraciones en la base de datos*/
			$rcTmp = $this->fncObtainConfigurationFormat();
			if ($rcTmp) {
				/*Busca el proceso de acuerdo a los datos del req y la configuracion*/
				$rcFormatos = $this->fncDetermineFormat($ircdata, $rcTmp);
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
	*	@param array $ircData (Arreglo con la data del requerimiento)
	*	@param array $ircConfiguration (Arreglo con la data de configuracion)
	*	@return string $osbFoemcodigos (Codigo del formato o null)
	*   @date 02-Dec-2005 09:32
	*   @location Cali-Colombia
	*/
	function fncDetermineFormat($ircData, $ircConfiguration) {
		settype($rcTmp, "array");
		settype($nuResult, "integer");
		settype($rcFormat, "array");

		foreach ($ircConfiguration as $rcTmp) {
			$nuResult = $this->fncValidateData($ircData, $rcTmp[1]);
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
	*	@param array $ircData (Arreglo con la data del requerimiento)
	*	@param array $ircConfiguration (Arreglo con la data de configuracion)
	*	@return boolean  (true si encaja o false si no)
	*   @date 02-Dec-2005 09:37
	*   @location Cali-Colombia
	*/
	function fncValidateData($ircData, $ircConfiguration) {

		settype($objTmpv, "object");
		settype($rcTmp, "array");
		settype($sbResult, "string");
		$aciertos = null;
		$objTmpv = Application :: loadServices("ValidationData");

		foreach ($ircConfiguration as $rcTmp) {
			$sbResult = $objTmpv->fnccompara($ircData[$rcTmp["cacfprocedes"]], $rcTmp["decfoperados"], $rcTmp["decfvalors"]);
			if ($sbResult === false) {
				return 0;
			}
			$aciertos ++;
		}
		return $aciertos;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Consulta las configuraciones para determinar el formato en la base de datos
	*   @author freina
	*	@return array $orcResult o  null (Arreglo con las configuraciones  o null en caso de que no haya registros)
	*   @date 01-Dec-2004 12:50
	*   @location Cali-Colombia
	*/
	function fncObtainConfigurationFormat() {

		settype($orcResult, "array");
		settype($rcResult, "array");
		settype($rcTmp, "array");
		settype($objtmp, "object");
		settype($objClass, "object");
		settype($nucont, "integer");

		$objtmp = Application :: loadServices('General');
		$objClass = $objtmp->InitiateClass("ConfigforemaManager");
		$rcResult = $objClass->getAllConfigforema();
		$objtmp->close();
		if ($rcResult) {
			/*Hace la consulta de los campos de cada configuracion*/
			foreach ($rcResult as $rcTmp) {
				$rcTmpc = $this->fncSelectFields($rcTmp["cofecodigon"]);
				if ($rcTmpc) {
					$orcResult[$nucont][0] = $rcTmp["foemcodigos"];
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
	*	@param integer $inucofecodigon (Codigo de la configuracion)
	*	@return array $orcResult o  null (Arreglo con los campos a validar
	*   o null en caso de que no haya registros)  
	*		[n][0] = nombre del campo tal cual en la bd
	*		[n][1] = operador logico
	*		[n][2] = valor base
	*   @date 01-Dec-2005 15:19
	*   @location Cali-Colombia
	*/
	function fncSelectFields($inucofecodigon) {

		settype($objtmp, "object");
		settype($objClass, "object");
		settype($orcResult, "array");
		settype($rcResult, "array");
		settype($rcrow, "array");
		settype($rcTmp, "array");
		settype($objtmp, "object");
		settype($nucont, "integer");

		$objtmp = Application :: loadServices('General');
		$objClass = $objtmp->InitiateClass("ConfigforemaManager");
		$rcResult = $objClass->getByCofecodigonLj($inucofecodigon);
		$objtmp->close();
		if ($rcResult) {
			foreach ($rcResult as $nucont => $rcrow) {
				$rcTmp = explode(".", $rcrow["cacfprocedes"]);
				if ($rcTmp[1]) {
					$rcrow["cacfprocedes"] = $rcTmp[1];
				} else {
					$rcrow["cacfprocedes"] = $rcTmp[0];
				}
				$orcResult[$nucont] = $rcrow;
			}
		}
		return $orcResult;
	}
}
?>