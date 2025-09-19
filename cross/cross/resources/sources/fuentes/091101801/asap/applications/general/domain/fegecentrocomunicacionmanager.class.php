<?php                                       
class FeGeCentroComunicacionManager {
	var $objgateway;
	var $objgatewaye;
	var $objtmpe;
	var $objdate;
	var $objtmpf;
	function FeGeCentroComunicacionManager() {
		$this->objgatewaye = Application :: getDataGateway("ComunicacionExtended");
		$this->objgateway = Application :: getDataGateway("Comunicacion");
		$this->objtmpe = Application :: getDomainController("EmpresaManager");
		$this->objtmpf = Application :: getDomainController("FormatocartaManager");
		$this->objdate = Application :: loadServices("DateController");
	}

	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Elimina un conjunto de comunicaciones
	*   @author freina
	*	@param array $ircdata (Arreglo con la Codigos de las comunicaciones)
	*	@return string $osbresult (Cadena con el codigo de resultado)
	*   @date 25-Oct-2004 09:43
	*   @location Cali-Colombia
	*/
	function fncDeleteComunicacionSet($ircdata) {

		settype($rctmp, "array");
		settype($osbresult, "string");
		settype($sbresult, "string");
		settype($sbPath, "string");
		settype($sbDirName, "string");
		settype($sbComucodigos, "string");
		settype($nucant, "integer");
		settype($nucont, "integer");

		//se verifica que el arreglo este cargado
		if ($ircdata) {
			// se obtiene los sql de eliminacion
			$nucant = sizeof($ircdata);
			for ($nucont = 0; $nucont < $nucant; $nucont ++) {
				$rctmp[$nucont] = $this->objgatewaye->deleteComunicacionSql($ircdata[$nucont]);
			}
			//se realiza la transaccion
			if ($rctmp) {
				$this->objgatewaye->ComunicacionTrans($rctmp);
				$sbresult = $this->objgatewaye->consult;
				if ($sbresult) {
					//se eliminan los archivos si existen
					$sbDirName = Application :: getConstant("PDF_DIR");
					foreach($ircdata as $sbComucodigos){
						$sbPath = Application::getTmpDirectory()."/".$sbDirName."/".$sbComucodigos.".pdf";
						if(file_exists($sbPath)){
							$sbresult = unlink($sbPath);
						}
					}
					$osbresult = 3;
				} else {
					$osbresult = 31;
				}
			}
		} else {
			$osbresult = 30;
		}
		return $osbresult;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Genera un conjunto de comunicaciones para los codigos parasados como parametro
	*   @author freina
	*	@param array $ircdata (Arreglo con los codigos de las comunicaciones)
	*	@return string $osbresult (Cadena con el codigo de resultado)
	* @update : 21-Jun-2004 se modifica el metodo para cambiar la forma de
	* descarga del pdf
	*   @date 26-Oct-2004 09:42
	*   @location Cali-Colombia
	*/
	function fncGenerateComunicacionSet($ircdata) {
		
		settype($objManager, "object");
		settype($objService, "object");
		settype($rctmp, "array");
		settype($rctmpc, "array");
		settype($rctmpe, "array");
		settype($osbresult, "string");
		settype($sbresult, "string");
		settype($sbcabecera, "string");
		settype($sbDirName, "string");
		settype($sbPath, "string");
		settype($sblogo, "string");
		settype($sbtexto, "string");
		settype($sbgenerado, "string");
		settype($sbpendiente, "string");
		settype($sbcomucodigos, "string");
		settype($sbsenalpdf, "string");
		settype($sbFilename,"string");
		settype($nucant, "integer");
		settype($nucont, "integer");
		settype($nuconte, "integer");
		settype($nufechahora, "integer");
		
		require_once('html2fpdf.php');
		require_once('html2doc.php');

		//se verifica que el arreglo este cargado
		if ($ircdata) {
			//se obtiene la data de la comunicaciones
			$rctmp = $this->objgatewaye->getByIdComunicacionIn($ircdata);
			if ($rctmp) {
				
				$objService = Application :: loadServices("Data_type");

				$sbgenerado = Application :: getConstant("COM_G");
				$sbpendiente = Application :: getConstant("COM_P");
				$sbsenalpdf = Application :: getConstant("PDF_D");
				$sbDirName = Application :: getConstant("PDF_DIR");

				//se obtiene la informacion de la empresa
				$rctmpe = $this->objtmpe->getByIdEmpresa();
				$sbcabecera = $rctmpe["emprnombres"];
				$sblogo = Application :: getBaseDirectory()."/".Application :: getImagesDirectory()."/".$rctmpe["emprlogos"];
				
				//se valida la existencia de los directorios
				$sbPath = Application::getTmpDirectory();
				$sbresult = $this->_createDir($sbPath);
				
				if(!$sbresult){
					return 100;
				}
				
				$sbPath .= "/".$sbDirName;
				$sbresult = $this->_createDir($sbPath);
				
				if(!$sbresult){
					return 100;
				}
				
				//se generan los pdf
				$nucant = sizeof($rctmp);
				for ($nucont = 0; $nucont < $nucant; $nucont ++) {

					$rctmpc = $rctmp[$nucont];
					$sbtexto = $objService->decode($rctmpc["comutextos"]);
					$sbtexto = utf8_encode($sbtexto);
					
					$sbcomucodigos = $rctmpc["comucodigos"];
					$sbFilename = $sbPath."/".$sbcomucodigos;
					
					//HTML TO DOC
					$objDoc= new HTML_TO_DOC();
					@$objDoc->createDoc($sbtexto,$sbFilename.".doc");
					$sbresult = true;
					if ($sbresult === true) {

						//fecha hora de generacion
						$nufechahora = $this->objdate->fncintdatehour();
						//se modifica el estado de la comunicacion
						$this->objgatewaye->updateComunicacionComuestadosById($rctmpc["comucodigos"], $sbgenerado, $nufechahora);
						$sbresult = $this->objgatewaye->consult;
						$nuconte ++;  
					} else {
						$this->objgatewaye->updateComunicacionComuestadosById($rctmpc["comucodigos"], $sbpendiente);
						$sbresult = $this->objgatewaye->consult;
					}
				}
				if ($nucant == $nuconte) {
					$osbresult = 3;
				} else {
					$osbresult = 32;
				}

			} else {
				$osbresult = 30;
			}
		} else {
			$osbresult = 30;
		}
		
		return $osbresult;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Crea una comunicacion de acuerdo a un numero de requerimiento y a un formato de carta
	*   @author freina
	*	@param string $isbordenumeros (Cadena con el codigo del requerimiento)
	*	@param string $isbfocacodigos (Cadena con el codigo del formato de carta)
	*	@return array $orcresult (Arreglo con la data resultado)
								[result] = Codigo del resultado
								[text] = cadena con la carta
	*   @date 28-Oct-2004 07:16
	*   @location Cali-Colombia
	*/
	function fncCreateComunicacion($isbordenumeros, $isbfocacodigos) {

		settype($objtmps, "object");
		settype($objService, "object");
		settype($orcresult, "array");
		settype($rctmp, "array");
		settype($rctmpe, "array");
		settype($rcuser, "array");
		settype($rctmpf, "array");
		settype($sbtexto, "string");
		settype($sbresult, "string");
		settype($sbpie, "string");

		//se verifica que los datos existan
		if ($isbfocacodigos) {
				
			if($isbordenumeros){
				//se obtiene la data del requerimiento de  acuerdo a el formato
				$objtmps = Application :: loadServices("Cross300");
				$rctmp = $objtmps->fncdataRequirementCommunication($isbordenumeros);
			}
			
			//Obtiene los datos del usuario
			$rcuser = Application :: getUserParam();
			if (!is_array($rcuser)) {
				//Si no existe usuario en sesion 
				$rcuser["lang"] = Application :: getSingleLang();
			}
			//se obtiene la informacion de la empresa
			$rctmpe = $this->objtmpe->getByIdEmpresa();
			$sbpie = $rctmpe["emprnombres"]."\n".$rctmpe["emprtelefos"]."\n".$rctmpe["emprdireccs"];

			$rctmp["hoy"] = $this->objdate->getLongDate($rcuser["lang"]);
			$rctmp["pie"] = $sbpie;

			if ($rctmp) {

				//si la data existe se obtiene el formato de la carta
				$rctmpf = $this->objtmpf->getByIdFormatocarta($isbfocacodigos);

				if ($rctmpf) {
					
					$objService = Application :: loadServices("Data_type");
					
					$rctmpf[0]["focaplantils"] = $objService->decode($rctmpf[0]["focaplantils"]); 

					$sbtexto = $this->fncCreateTextCommunication($rctmp, $rctmpf[0]["focaplantils"]);
					
					if ($sbtexto) {
						
						$sbtexto = $objService->encode($sbtexto); 
						
						$sbresult = 3;
					}
				} else {
					$sbresult = 38;
				}
			} 
		} else {
			$sbresult = 36;
		}
		$orcresult["result"] = $sbresult;
		$orcresult["text"] = $sbtexto;
		return $orcresult;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Crea el texto de la comunicacion
	*   @author freina
	*	@param array $ircdata (Arreglo con la data del requerimiento)
	*	@param string $isbfocaplantils (Cadena con la plantilla de la carta)
	*	@return string $osbresult (Cadena con el texto formateado)
	*   @date 28-Oct-2004 11:58
	*   @location Cali-Colombia
	*/
	function fncCreateTextCommunication($ircdata, $isbfocaplantils) {

		settype($rctags, "array");
		settype($rctmp, "array");
		settype($osbresult, "string");
		settype($sbindex, "string");

		if ($ircdata && $isbfocaplantils) {

			$osbresult = $isbfocaplantils;
			$rctags = Application :: getConstant("COMMUNICATION_TAGS");

			foreach ($rctags as $sbindex => $rctmp) {
				$osbresult = str_replace("[".$rctmp["value"]."]", $ircdata[$rctmp["equivalence"]], $osbresult);
			}
		}
		return $osbresult;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Crea un Sql de una  comunicacion de acuerdo a un numero de requerimiento, sus datos y a un formato de carta
	*   @author freina
	*	@param string $isbordenumeros (Cadena con el codigo del requerimiento)
	*	@param string $isbfocacodigos (Cadena con el codigo del formato de carta)
	*	@param array $ircdata (Arreglo conla data del requerimiento)
	*	@return string $osbresult (Cadena con el Sql)
	*   @date 29-Oct-2004 16:34
	*   @location Cali-Colombia
	*/
	function fncCreateComunicacionSql($isbordenumeros, $isbfocacodigos, $ircdata) {

		settype($objnumerador, "object");
		settype($objServ, "object");
		settype($rctmp, "array");
		settype($rctmpe, "array");
		settype($rcuser, "array");
		settype($rctmpf, "array");
		settype($sbtexto, "string");
		settype($sbpie, "string");
		settype($sbcomucodigos, "string");
		settype($sbdbnull, "string");
		settype($sbcomuestados, "string");
		settype($osbresult, "string");
		settype($sbcomuasuntos, "string");
		settype($nucomufecregn, "integer");

		//se verifica que los datos existan
		if ($isbordenumeros && $isbfocacodigos && $ircdata) {

			//Obtiene los datos del usuario
			$rcuser = Application :: getUserParam();
			if (!is_array($rcuser)) {
				//Si no existe usuario en sesion 
				$rcuser["lang"] = Application :: getSingleLang();
			}

			//se obtiene la informacion de la empresa
			$rctmpe = $this->objtmpe->getByIdEmpresa();
			$sbpie = $rctmpe["emprnombres"]."\n".$rctmpe["emprtelefos"]."\n".$rctmpe["emprdireccs"];

			$ircdata["hoy"] = $this->objdate->getLongDate($rcuser["lang"]);
			$ircdata["pie"] = $sbpie;

			//si la data existe se obtiene el formato de la carta
			$rctmpf = $this->objtmpf->getByIdFormatocarta($isbfocacodigos);

			if ($rctmpf) {
				
				//se obtiene el asunto de la comunicacion
				include(Application :: getLanguageFileDirectory()."/".$rcuser["lang"].".messages.php");
				$sbcomuasuntos = str_replace("#",$isbordenumeros,$rcmessages[39]);

				$sbtexto = $this->fncCreateTextCommunication($ircdata, $rctmpf[0]["focaplantils"]);
				
				//se formatea el string
				$objServ = Application :: loadServices("Data_type");
				$sbtexto = $objServ->formatString($sbtexto);

				$objnumerador = Application :: getDomainController('NumeradorManager');
				$sbcomucodigos = $objnumerador->fncgetByIdNumerador("comunicacion");

				$sbdbnull = Application :: getConstant("DB_NULL");
				$sbcomuestados = Application :: getConstant("COM_P");

				//fecha hora de hoy
				$nucomufecregn = $this->objdate->fncintdatehour();

				$osbresult = $this->objgatewaye->addComunicacionSql($sbcomucodigos, $isbordenumeros, $isbfocacodigos, $sbcomuasuntos, $sbtexto, 
				$sbcomuestados, $rcuser["username"], $rcuser["username"], $nucomufecregn, $sbdbnull);
			}
		}
		return $osbresult;
	}
	
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Crea un directorio, valida primero si existe
	*   @author freina
	*	@param string $sbPath (ruta del directorio)
	*	@return string $sbResult true  si exito, false si error.
	*   @date 08-Dic-2010 11:15
	*   @location Cali-Colombia
	*/
	function _createDir($sbPath){
		
		settype($sbUmask,"string");
		settype($sbResult,"string");
		$sbResult = true;
		if(!is_dir($sbPath)){
			$sbUmask = umask(0);
			$sbResult = mkdir($sbPath, 0775);
			umask($sbUmask);
		}
		return $sbResult;
	}
}
?>