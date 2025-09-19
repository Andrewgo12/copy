<?php              
class FeCrDataEmailManager {
	var $gateway;
	var $gatewayae;
	var $gatewayaex;
	var $gatewayac;
	function FeCrDataEmailManager() {
		$this->gateway = Application :: getDataGateway("SqlExtended");
		$this->gatewayae = Application :: getDataGateway("actaempresa");
		$this->gatewayaex = Application :: getDataGateway("actaempresaExtended");
		$this->gatewayac = Application :: getDataGateway("activiactaExtended");
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Genera genera la data necesaria para enviar email de acuerdo a parametros entregados por el centro de email 
	*   @author freina
	*	@param string $ircdata (Arreglo con los parametros de busqueda, ests pueden variar de acuerdo a la implementacion)
	*  [ordenumeros] Codigo de la orden
	*  [orgacodigos] Codigo del ente organizacional
	*  [ordefecregdi] Fecha inicio de intervalo
	*  [ordefecregdf] Fecha fin de intervalo
	*	@return array or null (Arreglo con los datos para los email )
	*   @date 14-Oct-2004 11:57
	*   @location Cali-Colombia
	*/
	function getDataEmail($ircdata) {

		settype($objtmps, "object");
		settype($objDate, "object");
		settype($objService, "object");
		settype($objGateway, "object");
		settype($orcresult, "array");
		settype($rcRow, "array");
		settype($rcOrden, "array");
		settype($rcuser, "array");
		settype($rcdata, "array");
		settype($rctmp, "array");
		settype($rctmpo, "array");
		settype($rctmpc, "array");
		settype($rcInfoCompany, "array");
		settype($rcTmpCo, "array");
		settype($rcContact, "array");
		settype($sbsignal, "string");
		settype($sborgacodigos, "string");
		settype($sbOrganombres, "string");
		settype($sborgaemails, "string");
		settype($sbcontnombre, "string");
		settype($sbcontidentis, "string");
		settype($sbcontemail, "string");
		settype($sbordeobservs, "string");
		settype($sbDate, "string");
		settype($nucant, "integer");
		settype($nucont, "integer");

		ProvitionalLog::write_log("Si entro aquí");

		//Busca el email corporativo para el from del correo
		$service = Application :: loadServices('General');
		$rcInfoCompany = $service->getParam('general', 'empresa');
		$sborgaemails = $rcInfoCompany['empremail'];

		$rcdata = $this->gateway->getDataEmail($ircdata);
		if ($rcdata) {

			$rcuser = Application :: getUserParam();
			$objDate = Application :: loadServices("DateController");

			$nucant = sizeof($rcdata);
			for ($nucont = 0; $nucont < $nucant; $nucont ++) {
				
				//fecha de hoy
				$sbDate = $objDate->getLongDate();
				
				$rcRow = $rcdata[$nucont]; 

				//se obtiene el nombre del ente organizacional
				if ($rcRow["orgacodigos"]) {
					if (!$rctmpo[$rcRow["orgacodigos"]]) {
						$sborgacodigos = $rcRow["orgacodigos"];
						$objtmps = Application :: loadServices("Human_resources");
						$rctmp = $objtmps->getDataEntesOrg($sborgacodigos, true);
						if ($rctmp) {
							$rctmp["codigo"] = $sborgacodigos;
							$rctmpo[$rcRow["orgacodigos"]] = $rctmp;
							$sbOrganombres = $rctmp["nombre"];
						} else {
							unset ($sborgacodigos);
							unset ($sbOrganombres);
						}
					} else {
						$sborgacodigos = $rctmpo[$rcRow["orgacodigos"]]["codigo"];
						$sbOrganombres = $rctmpo[$rcRow["orgacodigos"]]["nombre"];
					}
				} else {
					unset ($sborgacodigos);
					unset ($sbOrganombres);
				}

				//se obtiene el contacto
				if ($rcRow["contidentis"]) {
					if (!$rctmpc[$rcRow["contidentis"]]) {
						$sbcontidentis = $rcRow["contidentis"];
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
								$sbcontnombre = $rcContact[0]["contnombre"];
								$sbcontemail = $rcContact[0]["contemail"];
								$rctmpc[$rcRow["contidentis"]] = $rcContact;
							} else {
								unset ($sbcontnombre);
								unset ($sbcontemail);
							}
						}else{
							unset ($sbcontnombre);
							unset ($sbcontemail);
						}
						$objService->close();
						
					} else {
						$sbcontnombre = $rctmpc[$rcRow["contidentis"]][0]["contnombre"];
						$sbcontemail = $rctmpc[$rcRow["contidentis"]][0]["contemail"];
					}
				} else {
					unset ($sbcontnombre);
					unset ($sbcontemail);
				}

				//se obtiene el detalle de las actas  
				$sbordeobservs = $this->ObtainDetail($rcRow["ordenumeros"]);
				
				//Se obtiene el formato del email
				$rcOrden = $this->gateway->getByIdOrden($rcRow["ordenumeros"]);
				if($rcOrden){
					$sbsignal = $this->fncDetermineFormatEmail($rcOrden[0]);
				} 

				if($rcRow["ordefecregd"]){
					$rcRow["ordefecregd"]= $objDate->fncformatofecha($rcRow["ordefecregd"]);
				}
				$orcresult[$nucont]["dir_destino"] = $sbcontemail;
				$orcresult[$nucont]["formato"] = $sbsignal;
				$orcresult[$nucont]["asunto"] = array ("cliente" => $sbcontnombre, 
													  "requerimiento" => $rcRow["ordenumeros"], 
													  "actuaciones" => $sbordeobservs,
													  "fecha_reg"=>$rcRow["ordefecregd"],
													  "observaciones"=>$rcRow["ordeobservs"],
													  "ente"=>$sbOrganombres,
													  "sitio"=>$rcRow["ordesitiejes"],
													  "hoy"=>$sbDate,);
				$orcresult[$nucont]["texto"] = array ("cliente" => $sbcontnombre, 
													  "requerimiento" => $rcRow["ordenumeros"], 
													  "actuaciones" => $sbordeobservs,
													  "fecha_reg"=>$rcRow["ordefecregd"],
													  "observaciones"=>$rcRow["ordeobservs"],
													  "ente"=>$sbOrganombres,
													  "sitio"=>$rcRow["ordesitiejes"],
													  "hoy"=>$sbDate,);
				$orcresult[$nucont]["requerimiento"] = $rcRow["ordenumeros"];
				$orcresult[$nucont]["responsable"] = $sborgacodigos;
				$orcresult[$nucont]["dir_origen"] = $sborgaemails;
				$orcresult[$nucont]["usuario"] = $rcuser["username"];
				$orcresult[$nucont]["adjunto"] = "";
			}
		}

		return $orcresult;
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
							if ($rctmpac) {
								foreach ($rctmpac as $rctmpaa) {
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

		settype($rctmp, "array");
		settype($osbfoemcodigos, "string");
		
		if ($ircdata) {
			/*Consulta las configuraciones en la base de datos*/
			$rctmp = $this->fncObtainConfigurationFormat();
			if ($rctmp) {
				/*Busca el proceso de acuerdo a los datos del req y la configuracion*/
				$osbfoemcodigos = $this->fncDetermineFormat($ircdata, $rctmp);
			}
		}
		return $osbfoemcodigos;
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
		settype($sbResult, "string");
		settype($osbFoemcodigos, "string");
		
		foreach ($ircConfiguration as $rcTmp) {
			$sbResult = $this->fncValidateData($ircData, $rcTmp[1]); 
			if ($sbResult === true)
				$osbFoemcodigos = $rcTmp[0];
		}
		return $osbFoemcodigos;
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
		
		$objTmpv = Application :: loadServices("ValidationData");
		
		foreach ($ircConfiguration as $rcTmp) {
			$sbResult = $objTmpv->fnccompara($ircData[$rcTmp["cacfprocedes"]], $rcTmp["decfoperados"], $rcTmp["decfvalors"]);
			if ($sbResult === false) {
				return false;
			}
		}
		return true;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Consulta las configuraciones para determinar el formato en la base de datos
	*   @author freina
	*	@return array $orcresult o  null (Arreglo con las configuraciones  o null en caso de que no haya registros)
	*   @date 01-Dec-2004 12:50
	*   @location Cali-Colombia
	*/
	function fncObtainConfigurationFormat() {
		
		settype($orcresult, "array");
		settype($rcresult, "array");
		settype($rctmp, "array");
		settype($objtmp, "object");
		settype($objClass, "object");
		settype($nucont, "integer");
		
		$objtmp = Application :: loadServices('General');
		$objClass = $objtmp->InitiateClass("ConfigforemaManager");
		$rcresult = $objClass->getAllConfigforema();
		$objtmp->close();
		if ($rcresult) {
			/*Hace la consulta de los campos de cada configuracion*/
			foreach ($rcresult as $rctmp) {
				$rctmpc = $this->fncSelectFields($rctmp["cofecodigon"]);
				if ($rctmpc) {
					$orcresult[$nucont][0] = $rctmp["foemcodigos"];
					$orcresult[$nucont][1] = $rctmpc;
					$nucont ++;
				}
			}
		}
		return $orcresult;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Seleciona los campos en la base de datos
	*   @author freina
	*	@param integer $inucofecodigon (Codigo de la configuracion)
	*	@return array $orcresult o  null (Arreglo con los campos a validar
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
		settype($orcresult, "array");
		settype($rcresult, "array");
		settype($rcrow, "array");
		settype($rctmp, "array");
		settype($objtmp, "object");
		settype($nucont, "integer");
		
		$objtmp = Application :: loadServices('General');
		$objClass = $objtmp->InitiateClass("ConfigforemaManager");
		$rcresult = $objClass->getByCofecodigonLj($inucofecodigon);
		$objtmp->close();
		if ($rcresult) {
			foreach ($rcresult as $nucont => $rcrow) {
				$rctmp = explode(".", $rcrow["cacfprocedes"]);
				if ($rctmp[1]) {
					$rcrow["cacfprocedes"] = $rctmp[1];
				} else {
					$rcrow["cacfprocedes"] = $rctmp[0];
				}
				$orcresult[$nucont] = $rcrow;
			}
		}
		return $orcresult;
	}
}
?>