<?php
class FeGeCentroEmailManager {
	/*
	public $objgateway;
	public $objgatewaye;
	public $objtmp;
	public $objtmpn;
	public $objdate;
	*/
	function FeGeCentroEmailManager() {
		$this->objgateway = Application :: getDataGateway("EmailExtended");
		$this->objgatewaye = Application :: getDataGateway("Email");
		$this->objtmp = Application :: getDomainController('AdministerEmailManager');
		$this->objtmpn = Application :: getDomainController('NumeradorManager');
		$this->objdate = Application :: loadServices("DateController");
	}

	function fncSendEmailSet($ircdata) {

		settype($rcmail, "array");
		settype($rctmp, "array");
		settype($rctmpe, "array");
		settype($osbresult, "string");
		settype($sbresult, "string");
		settype($sbenviado, "string");
		settype($sbnoenv, "string");
		settype($nucant, "integer");
		settype($nucont, "integer");
		settype($nuconte, "integer");
		settype($nufechahora, "integer");

		//se verifica que el arreglo este cargado
		if ($ircdata) {
			// se obtiene la data del email
			$rctmpe = $this->objgateway->getByIdEmailIn($ircdata);
			//si se obtuvieron los registros se procede a enviarlos
			if ($rctmpe) {
				//$sbresult = $this->objtmp->fncValidateConnection();
				$sbresult = true;
				if ($sbresult) {
					$sbenviado = Application :: getConstant("E-MAIL_E");
					$sbnoenv = Application :: getConstant("E-MAIL_NOE");
					$nucant = sizeof($rctmpe);
					for ($nucont = 0; $nucont < $nucant; $nucont ++) {
						$rcmail = $rctmpe[$nucont];
						$sbresult = false;
						if ($rcmail["emaitextos"] && $rcmail["emaiparas"] && $rcmail["emaidesdes"] && $rcmail["emaiasuntos"]) {
							$objsendemail = Application :: getDomainController('SendMailManager');
							$objsendemail->sbhtml = $rcmail["emaitextos"];
							if ($rcmail["emaiadjuntos"]) {
								$rctmp = explode(",", $rcmail["emaiadjuntos"]);
								$objsendemail->rcfile = $rctmp;
							}
							$objsendemail->rchdrs = array ("from" => $rcmail["emaidesdes"], "subject" => $rcmail["emaiasuntos"]);
							$objsendemail->sbrecipient = $rcmail["emaiparas"];
							$sbresult = $objsendemail->ComposeEmail();
							unset ($objsendemail);
						}
						if ($sbresult === true) {

							//fecha hora de envio
							$nufechahora = $this->objdate->fncintdatehour();

							//se modifica el estado del el email
							$this->objgateway->updateEmailEmaiestadosById($rcmail["emaicodigos"], $sbenviado, $nufechahora);
							$sbresult = $this->objgateway->consult;
							$nuconte ++;
						} else {
							$this->objgateway->updateEmailEmaiestadosById($rcmail["emaicodigos"], $sbnoenv);
							$sbresult = $this->objgateway->consult;
						}
					}
					if ($nucant == $nuconte) {
						$osbresult = 3;
					} else {
						$osbresult = 19;
					}
				} else {
					$osbresult = 25;
				}
			}
		} else {
			$osbresult = 18;
		}
		return $osbresult;
	}

	function fncDeleteEmailSet($ircdata) {

		settype($rctmp, "array");
		settype($osbresult, "string");
		settype($sbresult, "string");
		settype($nucant, "integer");
		settype($nucont, "integer");
		//se verifica que el arreglo este cargado
		if ($ircdata) {
			// se obtiene los sql de eliminacion
			$nucant = sizeof($ircdata);
			for ($nucont = 0; $nucont < $nucant; $nucont ++) {
				$rctmp[$nucont] = $this->objgateway->deleteEmailSql($ircdata[$nucont]);
			}
			//se realiza la transaccion
			if ($rctmp) {
				$this->objgateway->EmailTrans($rctmp);
				$sbresult = $this->objgateway->consult;
				if ($sbresult) {
					$osbresult = 3;
				} else {
					$osbresult = 21;
				}
			}
		} else {
			$osbresult = 20;
		}
		return $osbresult;
	}

	function fncGenerateEmailSet($ircdata) {

		settype($objservice, "object");
		settype($rctmp, "array");
		settype($rcsql, "array");
		settype($osbresult, "string");
		settype($sbresult, "string");
		settype($nucant, "integer");
		settype($nucont, "integer");

		//se verifica que el arreglo este cargado
		if ($ircdata) {
			//se obtiene la data de los email
			$objservice = Application :: loadServices("Cross300");

			$rctmp = $objservice->getDataEmail($ircdata);

			if ($rctmp) {

				$nucant = sizeof($rctmp);
				for ($nucont = 0; $nucont < $nucant; $nucont ++) {
					$rcsql[$nucont] = $this->objtmp->fncGenerateSQLEmail($rctmp[$nucont]);
				}
				if ($rcsql) {
					$this->objgateway->EmailTrans($rcsql);
					$sbresult = $this->objgateway->consult;
					if ($sbresult) {
						$osbresult = 3;
					} else {
						$osbresult = 24;
					}
				}
			} else {
				$osbresult = 23;
			}
		} else {
			$osbresult = 22;
		}
		return $osbresult;
	}
//	**
//	*   Propiedad intelectual del FullEngine.
//	*
//	*   Envia un email
//	*   @author freina
//	*	@param string  $isbemaiparas (Cadena con el email destino)
//	*	@param string  $isbemaiasuntos (Cadena con el asunto del email)
//	*	@param string  $isbordenumeros (Cadena con el numero de requerimiento)
//	*	@param string  $isbemaitextos (Cadena con el texto del email)
//	*	@param string  $isbfoemcodigos (Cadena con el codigo del formato)
//	*	@param array $ircdata (Arreglo con la data del archivo adjunto)
//	*	@return string $osbresult (Cadena con el codigo de resultado)
//	*   @date 19-Oct-2004 14:36
//	*   @location Cali-Colombia
//	*
	function fncSendEmail($isbemaiparas, $isbemaiasuntos, $isbordenumeros, $isbemaitextos, $isbfoemcodigos, $ircdata) {

		settype($objtmp, "object");
		settype($rctmp, "array");
		settype($rctmpa, "array");
		settype($rcuser, "array");
		settype($osbresult, "string");
		settype($sbemaidesdes, "string");
		settype($sbPath, "string");
		settype($sbTmp, "string");
		settype($sbresult, "string");
		settype($sbenviado, "string");
		settype($sbemaicodigos, "string");
		settype($nufechahora, "integer");
		settype($nuCont, "integer");

		//se valida la existencia del req
		$objtmp = Application :: loadServices("Cross300");
		$sbresult = $objtmp->fncValidateExistenceOrder($isbordenumeros);

		if ($sbresult) {

			//se obtiene el email origen
			$objtmp = Application :: loadServices("Human_resources");
			$rcuser = Application :: getUserParam();
			$rctmp = $objtmp->getDataEmployeeByNick($rcuser["username"]);
			$objsendemail = Application :: getDomainController('SendMailManager');
			if ($rctmp) {
				//$sbresult = $this->objtmp->fncValidateConnection();
				$sbresult = true;
				if ($sbresult) {

					//se empieza a armar el email ha ser enviado
					$sbenviado = Application :: getConstant("E-MAIL_E");

					$objsendemail->sbhtml = $isbemaitextos;
					//Ajusta los archivos adjuntos
					if ($ircdata["path"]) {
						$objsendemail->rcfile = $ircdata["path"];
					}

					if ($rctmp["emailr"]) {
						$sbemaidesdes = $rctmp["emailr"];
					} else {
						if ($rctmp["emailp"]) {
							$sbemaidesdes = $rctmp["emailp"];
						}
					}
					//Consigue el email corporativo para enviar
					$params = Application :: getDomainController("ParamsManager");
					$rcInfoCompany = $params->getParam('general', 'empresa');
					$objsendemail->rchdrs = array ("from" => $rcInfoCompany['empremail'], "subject" => $isbemaiasuntos);

					//fecha hora de registro
					$nufechahora = $this->objdate->fncintdatehour();

					$objsendemail->sbrecipient = $isbemaiparas;

					$sbresult = $objsendemail->ComposeEmail();
					if ($sbresult === true) {
						
						//si hay adjuntos
						if($ircdata["path"] && is_array($ircdata["path"])){
							foreach($ircdata["path"] as $nuCont => $sbPath){
								$ircdata["path"][$nuCont] = addslashes($sbPath);
							}
							$sbTmp = implode(",",$ircdata["path"]);
						}

						//se ingresa el email con estado enviado
						$sbemaicodigos = $this->objtmpn->fncgetByIdNumerador("email");
						$this->objgatewaye->addEmail($sbemaicodigos, $isbordenumeros, $isbfoemcodigos, $rctmp["responsable"], $isbemaiparas, $rcInfoCompany['empremail'], $isbemaiasuntos, $isbemaitextos, $sbenviado, $rcuser["username"], $nufechahora, $nufechahora, $sbTmp);
						$sbresult = $this->objgatewaye->consult;
						$osbresult = 3;
					} else {
						$osbresult = 28;
					}
				} else {
					$osbresult = 25;
				}
			} else {
				$osbresult = 27;
			}
		} else {
			$osbresult = 26;
		}
		return $osbresult;
	}

//	*
//	*   Propiedad intelectual del FullEngine.
//	*
//	*   Genera                         el asunto y texto de un email deacuerdo a
//	* la data del requerimiento y formato elegido
//	*   @author freina<freina@parquesoft.com>
//	* @param string $isbOrdenumeros Cadena con el id del requerimiento
//	* @param string $isbFoemcodigos Cadena con el id del formatodel email
//	* @param array $orcResult Arreglo con el texto, el asunto y el resultado del
//	* proceso
//	*   @date 06-Dec-2005 12:05
//	*   @location Cali-Colombia
//	*
	function fncCreateEmail($isbOrdenumeros, $isbFoemcodigos) {

		settype($objService, "object");
		settype($objManager, "object");
		settype($rcData, "array");
		settype($rcTmp, "array");
		settype($orcResult, "array");
		settype($rcFormato, "array");
		settype($sbresult, "string");

		//se verifica que el arreglo este cargado
		if ($isbOrdenumeros && $isbFoemcodigos) {

			$rcData["ordenumeros"] = $isbOrdenumeros;

			//se obtiene la data de los email
			$objService = Application :: loadServices("Cross300");

			$rcTmp = $objService->getDataEmail($rcData);

			if ($rcTmp) {

				//se obtiene el formato
				$objManager = Application :: getDomainController("FormatoemailManager");
				$rcFormato = $objManager->getByIdFormatoemail($isbFoemcodigos);
				if ($rcFormato) {
					//se obtiene el texto
					$orcResult["texto"] = $this->objtmp->fncgetMessage($rcFormato[0], $rcTmp[0]["texto"]);
					if ($orcResult["texto"]) {
						//se obtiene el asunto
						$orcResult["asunto"] = $this->objtmp->fncgetSubject($rcFormato[0], $rcTmp[0]["asunto"]);
						if ($orcResult["asunto"]) {
							$sbresult = 52;
						} else {
							$sbresult = 51;
						}
					} else {
						$sbresult = 51;
					}
				} else {
					$sbresult = 50;
				}
			} else {
				$osbresult = 23;
			}
		} else {
			$osbresult = 22;
		}
		$orcResult["result"] = $sbresult;
		return $orcResult;
	}
	
//	**
//	*   Propiedad intelectual del FullEngine.
//	*
//	*   Envia los email generados por las reglas
//	*   @author freina
//	*	@param string  $sbEmaidesdes (Cadena con el email origen)
//	*	@param string  $sbEmaiparas (Cadena con el email destino)
//	*	@param string  $sbEmaiasuntos (Cadena con el asunto del email)
//	*	@param string  $sbOrdenumeros (Cadena con el numero de requerimiento)
//	*	@param string  $sbEmaitextos (Cadena con el texto del email)
//	*	@param string  $sbFoemcodigos (Cadena con el codigo del formato)
//	*	@param array $rcData (Arreglo con la data del archivo adjunto)
//	*	@return string $osbresult (Cadena con el codigo de resultado)
//	*   @date 19-Oct-2004 14:36
//	*   @location Cali-Colombia
//	*
	function fncSendRuleEmail($sbEmaidesdes, $sbEmaiparas, $sbEmaiasuntos, $sbOrdenumeros, $sbEmaitextos, $sbFoemcodigos, $rcData) {

		settype($objTmp, "object");
		settype($objService, "object");
		settype($rcTmpa, "array");
		settype($rcUser, "array");
		settype($sbEmaidesdes, "string");
		settype($sbResult, "string");
		settype($sbEnviado, "string");
		settype($sbEmaicodigos, "string");
		settype($nuFechahora, "integer");
		settype($nuResult, "integer");

		//se valida que los campos necesario para el emailesten cargados
		if ($sbEmaidesdes && $sbEmaiparas && $sbEmaiasuntos && $sbOrdenumeros && $sbEmaitextos) {
			
			//se valida la existencia del req
			$objTmp = Application :: loadServices("Cross300");
			$sbResult = $objTmp->fncValidateExistenceOrder($sbOrdenumeros);

			if ($sbResult) {
				
				$objService = Application :: loadServices("Data_type");
				
				//formateo de cadenas
				$sbEmaiasuntos = $objService->formatString($sbEmaiasuntos);
				$sbEmaitextos = $objService->formatString($sbEmaitextos);

				$rcUser = Application :: getUserParam();
				//se ingresa el email a la bd
				
				//fecha hora de registro
				$nuFechahora = $this->objdate->fncintdatehour();
				$sbEnviado = Application :: getConstant("E-MAIL_NOE");
				//se ingresa el email 
				$sbEmaicodigos = $this->objtmpn->fncgetByIdNumerador("email");
				$this->objgatewaye->addEmail($sbEmaicodigos, $sbOrdenumeros, $sbFoemcodigos, 
				$rcData["responsable"], $sbEmaiparas, $sbEmaidesdes, 
				$sbEmaiasuntos, $sbEmaitextos, $sbEnviado, $rcUser["username"], 
				$nuFechahora,0, $rcData["path"]);

				if ($sbResult = $this->objgatewaye->consult) {
					//si se grabo el email
					
					//se envia el email
					$objsendemail = Application :: getDomainController('SendMailManager');

					//$sbResult = $this->objtmp->fncValidateConnection();
					$sbResult = true;
					if ($sbResult) {

						//se empieza a armar el email ha ser enviado
						$objsendemail->sbhtml = $sbEmaitextos;
						//Ajusta los archivos adjuntos
						if ($rcData["path"]) {
							$objsendemail->rcfile = array ($rcData["path"]);
						}

						$objsendemail->rchdrs = array ("from" => $sbEmaidesdes, 
						"subject" => $sbEmaiasuntos);

						$objsendemail->sbrecipient = $sbEmaiparas;
						
						$sbResult = $objsendemail->ComposeEmail();
                
						if ($sbResult === true) {
							
							//se modifica el estado del email
							$sbEnviado = Application :: getConstant("E-MAIL_E");
							$this->objgateway->updateEmailEmaiestadosById($sbEmaicodigos, $sbEnviado, $nuFechahora);
						}
					}
					$nuResult = 3;
				} else {
					$nuResult = 28;
				}
			} else {
				$nuResult = 26;
			}
		} else {
			$nuResult = 28;
		}
		return $nuResult;
	}
}
?>