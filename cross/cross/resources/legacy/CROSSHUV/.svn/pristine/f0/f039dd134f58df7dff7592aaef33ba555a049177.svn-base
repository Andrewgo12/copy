<?php
class FeGeIntegraLogManager{
	function FeGeIntegraLogManager(){
		$this->objGateway = Application::getDataGateway("integralog");
	}

	function setData($rcData){
		$this->rcData = $rcData;
	}

	function getResult(){
		return $this->rcResult;
	}

	/**
	 * @copyright Copyright 2010 &copy; FullEngine
	 *
	 *  Ingresa el log de integracion al presentarse un error con Docunet o SIPA
	 * @author freina <freina@parquesoft.com>
	 * @date 13-Apr-2010 11:55
	 * @location Cali-Colombia
	 */
	function addIntegraLog(){

		settype($objManager,"object");
		settype($objDate,"object");
		settype($objService,"object");
		settype($rcData,"array");
		settype($rcUser,"array");
		settype($rcResult,"array");
		settype($rcSql,"array");
		settype($sbResult,"string");
		settype($sbFlag,"string");
		settype($sbStatus,"string");
		settype($nuInlocodigon,"integer");
		settype($nuDate,"integer");

		$sbFlag = true;
		$rcData = $this->rcData;

		if($rcData && is_array($rcData)){
			extract($rcData);
			$this->objGateway->setExecuteSql(false);

			$objManager = Application :: getDomainController('NumeradorManager');
			$objDate = Application :: loadServices("DateController");
			$objService = Application :: loadServices("Data_type");
			$nuDate = $objDate->fncintdatehour();
			$rcUser = Application :: getUserParam();

			if(isset($inloapps) && $inloapps && isset($inloerrors) && $inloerrors && isset($id_cross) && $id_cross){

				$inloerrors = $objService->formatString($inloerrors);

				$nuInlocodigon = $objManager->fncgetByIdNumerador("integralog");

				//determina el estado del registro
				if(isset($status) && $status==true){
					$sbStatus = Application :: getConstant("REG_ACT");
				}else{
					$sbStatus = Application :: getConstant("FAILED_STATUS");
				}

				$this->objGateway->setData(array("inlocodigon"=>$nuInlocodigon,"inlofchaejin"=>$nuDate,"inlousuarios"=>$rcUser["username"],
												 "inloapps"=>$inloapps,"inloerrors"=>$inloerrors,"inloidcrosss"=>$id_cross,"inloestados"=>$sbStatus));
				$this->objGateway->addIntegralog();

				//determina si el log lo genera docunet o sipa

				switch ($inloapps) {
					case 1:
						//se valida que la informacion necesaria este
						if(isset($exto) && strlen($exto) && isset($texto_error) && $texto_error){
							$this->objGateway->setData(array("inlocodigon"=>$nuInlocodigon,"nmbre_srie"=>$nmbre_srie,
													         "nmbre_tpo_crpta"=>$nmbre_tpo_crpta,"nmbre_crpta"=>$nmbre_crpta,
															 "nmbre_tpo_dcto"=>$nmbre_tpo_dcto,"nmbre_dcto"=>$nmbre_dcto,
															 "ext"=>$ext,"fncnrio"=>$fncnrio,
															 "c_indice1"=>$c_indice1,"c_indice2"=>$c_indice2,
															 "c_indice3"=>$c_indice3,"c_indice4"=>$c_indice4,
															 "c_descripcion"=>$c_descripcion,"d_indice1"=>$d_indice1,
															 "d_indice2"=>$d_indice2,"d_indice3"=>$d_indice3,"d_indice4"=>$d_indice4,
															 "d_indice5"=>$d_indice5,"d_indice6"=>$d_indice6,
															 "d_indice7"=>$d_indice7,"d_indice8"=>$d_indice8,
															 "d_indice9"=>$d_indice9,"d_descripcion"=>$d_descripcion,
															 "d_id_cross"=>$d_id_cross,"exto"=>$exto,"texto_error"=>$texto_error));
							$this->objGateway->addIntelogdoc();
						}else{
							$sbFlag = false;
						}
						break;
					case 2:
						//sipa
						//se valida que la informacion necesaria este
						if(isset($caso) && $caso && isset($codigo_error) && strlen($codigo_error) && isset($texto_error) && $texto_error){
							$this->objGateway->setData(array("inlocodigon"=>$nuInlocodigon,"area"=>$area,
													         "serie"=>$serie,"tipo_carpeta"=>$tipo_carpeta,
													         "sol_id"=>$sol_id,"sol_nombre"=>$sol_nombre,
									   						 "fecha_reg"=>$fecha_reg,"usuario"=>$usuario,
									   						 "localizacion"=>$localizacion,"observaciones"=>$observaciones,
									   						 "caso"=>$caso,"codigo_error"=>$codigo_error,"texto_error"=>$texto_error));
							$this->objGateway->addIntelogsip();
						}else{
							$sbFlag = false;
						}
						break;
				}

				if($sbFlag){

					$rcSql = $this->objGateway->getSql();

					//transaccion
					$this->objGateway->setSql($rcSql);
					$this->objGateway->executeTrans();
					$sbResult = $this->objGateway->getConsult();

					if($sbResult){
						$rcResult["message"] = 3;
						$rcResult["result"] = true;
					}else{
						$rcResult["message"] = 100;
						$rcResult["result"] = false;
					}

				}else{
					$rcResult["message"] = 100;
					$rcResult["result"] = false;
				}
			}else{
				$rcResult["message"] = 100;
				$rcResult["result"] = false;
			}
		}else{
			$rcResult["message"] = 100;
			$rcResult["result"] = false;
		}
			
		$this->rcResult = $rcResult;
	}

	function UnsetRequest() {
		settype($sbKey,"string");
		settype($sbValue,"string");
		foreach ($_REQUEST as $sbKey => $sbValue) {
			if (ereg("__", $sbKey))
			unset ($_REQUEST[$sbKey]);
		}
	}

	/**
	 * @copyright Copyright 2010 &copy; FullEngine
	 *
	 * Obtiene los registros fallidos del log de integracion
	 * @author freina <freina@parquesoft.com>
	 * @date 13-Apr-2010 11:55
	 * @location Cali-Colombia
	 */
	function getIntegration(){

		settype($rcData,"array");
		settype($rcResult,"array");
		settype($rcTmp,"array");
		settype($rcSql,"array");

		$rcData = $this->rcData;

		if($rcData && is_array($rcData)){

			extract($rcData);
			$this->objGateway->setData(array("inlofchaejin1"=>$inlofchaejin1,'inlofchaejin2'=>$inlofchaejin2,
										     "inloapps"=>$inloapps,"inloestados"=>$inloestados,"inloidcrosss"=>$inloidcrosss,
											 "inlousuarios"=>$inlousuarios));
			$this->objGateway->getIntegration();
			$rcTmp = $this->objGateway->getResult();
			$this->objGateway->setExecuteSql(false);
			$this->objGateway->getIntegration();
			$rcSql = $this->objGateway->getSql();
			if(is_array($rcTmp) && $rcTmp){
				$rcResult["result"] = true;
				$rcResult["data"] = $rcTmp;
				if(is_array($rcSql) && $rcSql){
					$rcResult["query"] = $rcSql[0];
				}
			}else{
				$rcResult["message"] = 68;
				$rcResult["result"] = false;
			}
		}else{
			$rcResult["message"] = 100;
			$rcResult["result"] = false;
		}
		$this->rcResult = $rcResult;
	}


	/**
	 * @copyright Copyright 2010 &copy; FullEngine
	 *
	 * Obtiene los registros fallidos del log de integracion
	 * @author freina <freina@parquesoft.com>
	 * @date 13-Apr-2010 11:55
	 * @location Cali-Colombia
	 */
	function sendIntegration(){

		settype($rcData,"array");
		settype($rcResult,"array");
		settype($rcTmp,"array");

		$rcData = $this->rcData;

		if($rcData && is_array($rcData)){

			extract($rcData);
			$this->objGateway->setData(array("inlocodigon"=>$inlocodigon));
			$this->objGateway->getIntegration();
			$rcTmp = $this->objGateway->getResult();
			if(is_array($rcTmp) && $rcTmp){
				$rcTmp = $rcTmp[0];
				//deacuerdo a la informacion obtenida se determina con que aplicacion se debe realizar la integracion
				$this->nuInlocodigon = $inlocodigon;
				switch($rcTmp["inloapps"]){
					case "1":
						$this->_execDocunetIntegration();
						$rcResult = $this->rcResult;
						break;
					case "2":
						$this->_execSipaIntegration();
						$rcResult = $this->rcResult;
						break;
				}
			}else{
				$rcResult["message"] = 100;
				$rcResult["result"] = "error";
			}
		}else{
			$rcResult["message"] = 100;
			$rcResult["result"] = "error";
		}
		$this->rcResult = $rcResult;
	}

	/**
	 * @copyright Copyright 2010 &copy; FullEngine
	 *
	 * ejecuta la integracion con Docunet
	 * @author freina <freina@parquesoft.com>
	 * @date 13-Apr-2010 11:55
	 * @location Cali-Colombia
	 */
	function _execDocunetIntegration(){

		settype($objService,"object");
		settype($objDate,"object");
		settype($objGateway,"object");
		settype($rcResult,"array");
		settype($rcTmp,"array");
		settype($rcTmp_F,"array");
		settype($rcAnswer,"array");
		settype($rcSql,"array");
		settype($rcFiles,"array");
		settype($sbResult,"string");
		settype($sbStatus,"string");
		settype($sbRutaDestino,"string");
		settype($sbContenidoArchivo,"string");
		settype($sbRutaTmp,"string");
		settype($nuDate,"integer");


		if($this->nuInlocodigon){

			$this->objGateway->setData(array("inlocodigon"=>$this->nuInlocodigon));
			$this->objGateway->getDetailIntegrationDoc();
			$rcTmp = $this->objGateway->getResult();

			if(is_array($rcTmp) && $rcTmp && $rcTmp[0]["d_id_cross"] && $rcTmp[0]["nmbre_dcto"]){
				//se ejecuta la sincronizacion
				$rcTmp = $rcTmp[0];
				$rcTmp["ordenumeros"] = $rcTmp["d_id_cross"];
				
				//se determina si la carpeta para el caso ya existe
				if(!$rcTmp["nmbre_crpta"]){
					$this->objGateway->setData(array("d_id_cross"=>$rcTmp["d_id_cross"],"nmbre_crpta_inn"=>true));
					$this->objGateway->getDetailIntegrationDoc();
					$rcTmp_F = $this->objGateway->getResult();
					if(is_array($rcTmp_F) && $rcTmp_F){
						$rcTmp_F = $rcTmp_F[0];
						$rcTmp["nmbre_crpta"] = $rcTmp_F["nmbre_crpta"];
					}
				}

				$objService = Application::loadServices('Docunet');
				$objService->setData($rcTmp);
				$rcAnswer = $objService->IntegrarDocunet();
				$objService->close();

				$rcAnswer["texto"] = $rcAnswer["status"];
				if (!$rcAnswer["code"])
				$rcAnswer["status"] = true;
				else
				$rcAnswer["status"] = false;

				if($rcAnswer["code"]==-1){
					$this->objGateway->setExecuteSql(false);
					$this->objGateway->setData(array("inlocodigon"=>$this->nuInlocodigon,"inloerrors"=>$rcAnswer["texto"]));
					$this->objGateway->setIntegration();
					$this->objGateway->setData(array("inlocodigon"=>$this->nuInlocodigon,"texto_error"=>$rcAnswer["texto"]));
					$this->objGateway->setDetailIntegrationDoc();
					$rcResult["result"] = "fail";
					$rcResult["message"] = 72;
					$rcResult["text_error"] = $rcAnswer["texto"];
				}else{
					//si la integracion fue exitosa devuelve una ruta
					$rcAnswer["texto"] = str_replace("\\","/",$rcAnswer["texto"]);
					$objDate = Application :: loadServices("DateController");
					$nuDate = $objDate->fncintdatehour();
					$sbStatus = Application :: getConstant("REG_ACT");
					$this->objGateway->setExecuteSql(false);
					$this->objGateway->setData(array("inlocodigon"=>$this->nuInlocodigon,"inlofchaejfn"=>$nuDate,"inloestados"=>$sbStatus,"inloerrors"=>$rcAnswer["texto"]));
					$this->objGateway->setIntegration();
					$this->objGateway->setData(array("inlocodigon"=>$this->nuInlocodigon,"exto"=>$rcAnswer["code"],"texto_error"=>$rcAnswer["texto"],"nmbre_crpta"=>$rcAnswer["folder"]));
					$this->objGateway->setDetailIntegrationDoc();
					$rcResult["result"] = "succes";
					$rcResult["fecha_mod"] = $objDate->fncformatofechahora($nuDate);
					$rcResult["text_error"] = $rcAnswer["texto"];
				}

				if($rcAnswer["status"] == true) {

					//compuerta de archivos
					$objGateway =  Application::getDataGateway("archivos");
					$objGateway->setData(array("archreferes"=>$rcTmp["d_id_cross"],"archnombres"=>$rcTmp["nmbre_dcto"]));
					$objGateway->getArchivos();
					$rcFiles = $objGateway->getResult();

					if(is_array($rcFiles) && $rcFiles){
						$rcFiles = $rcFiles[0];
						//GUARDAR EL ARCHIVO EN LA RUTA ENTREGADA POR ORACLE
						$sbRutaDestino = $this->getRutaDestino($rcAnswer["texto"]);
						if($rcAnswer["texto"] && $sbRutaDestino && (strpos($sbRutaDestino,"/")!==false)) {
							//se crea el archivo
							$sbRutaTmp = Application::getTmpDirectory()."/".$rcTmp["ordenumeros"];
							$temp = fopen($sbRutaTmp,"w");
							$sbContenidoArchivo = base64_decode($rcFiles["archcontens"]);
							fputs($temp,$sbContenidoArchivo);
							fclose($temp);
							//se pasa al servidor de documentacion
							copy($sbRutaTmp,$sbRutaDestino);
							chmod($sbRutaDestino,0777);
							unlink($sbRutaTmp);
						}
					}
				}

				//se actualizan los registros
				$rcSql = $this->objGateway->getSql();
				if(is_array($rcSql) && $rcSql){
					//transaccion
					$this->objGateway->setSql($rcSql);
					$this->objGateway->executeTrans();
					$sbResult = $this->objGateway->getConsult();
				}
			}else{
				$rcResult["message"] = 100;
				$rcResult["result"] = "error";
			}
		}else{
			$rcResult["message"] = 100;
			$rcResult["result"] = "error";
		}

		$this->rcResult = $rcResult;
	}
	
	function getRutaDestino($sbRuta) {

		settype($rcTmp,"array");
		settype($sbPath,"string");
		settype($sbDir,"string");
		settype($nuSize,"integer");

		$sbRuta = str_replace("\\","/",$sbRuta);
		$rcTmp = explode("/",$sbRuta);

		if(!is_array($rcTmp)) {
			return false;
		}
		$nuSize = sizeof($rcTmp);
			
		$sbPath = "";
		$nucont = 0;

		foreach ($rcTmp as $sbDir) {
			if($nucont==($nuSize-1))
			break;
			if(strlen($sbDir)) {
				$sbPath .= "/".$sbDir;
				if(!is_dir($sbPath)) {
					mkdir($sbPath,0777);
					chmod($sbPath,0777);
				}
			}
			$nucont++;
		}
		return $sbPath ."/". $sbDir;
	}

	/**
	 * @copyright Copyright 2010 &copy; FullEngine
	 *
	 * Obtiene los registros detalle de un log
	 * @author freina <freina@parquesoft.com>
	 * @date 21-Apr-2010 10:39
	 * @location Cali-Colombia
	 */
	function getIntelogdoc(){

		settype($rcData,"array");
		settype($rcResult,"array");
		settype($rcTmp,"array");
		settype($rcSql,"array");

		$rcData = $this->rcData;

		if($rcData && is_array($rcData)){

			extract($rcData);
			$this->objGateway->setData(array("inlocodigon"=>$inlocodigon));
			$this->objGateway->getDetailIntegrationDoc();
			$rcTmp = $this->objGateway->getResult();
				
			if(is_array($rcTmp) && $rcTmp){
				$rcResult["result"] = true;
				$rcResult["data"] = $rcTmp;
			}else{
				$rcResult["message"] = 68;
				$rcResult["result"] = false;
			}
		}else{
			$rcResult["message"] = 100;
			$rcResult["result"] = false;
		}
		$this->rcResult = $rcResult;
	}
	
	/**
	 * @copyright Copyright 2010 &copy; FullEngine
	 *
	 * actualiza el detalle de log para Docunet
	 * @author freina <freina@parquesoft.com>
	 * @date 21-Apr-2010 15:53
	 * @location Cali-Colombia
	 */
	function setIntelogdoc(){
		
		settype($rcData,"array");
		settype($rcResult,"array");
		settype($sbResult,"string");

		$rcData = $this->rcData;

		if($rcData && is_array($rcData)){

			extract($rcData);
			$this->objGateway->setData(array("inlocodigon"=>$inlocodigon,"nmbre_srie"=>$nmbre_srie,"nmbre_tpo_crpta"=>$nmbre_tpo_crpta,
											"nmbre_crpta"=>$nmbre_crpta,"nmbre_tpo_dcto"=>$nmbre_tpo_dcto,
											"nmbre_dcto"=>$nmbre_dcto,"ext"=>$ext,"fncnrio"=>$fncnrio,
											"d_id_cross"=>$d_id_cross));
			$this->objGateway->setDetailIntegrationDoc();
			$sbResult = $this->objGateway->getConsult();
			if($sbResult){
				$rcResult["message"] = 3;
				$rcResult["result"] = true;
			}else{
				$rcResult["message"] = 100;
				$rcResult["result"] = false;
			}
		}else{
			$rcResult["message"] = 100;
			$rcResult["result"] = false;
		}
		$this->rcResult = $rcResult;
	}
	
	/**
	 * @copyright Copyright 2010 &copy; FullEngine
	 *
	 * Obtiene los registros detalle de un log
	 * @author freina <freina@parquesoft.com>
	 * @date 28-Apr-2010 18:00
	 * @location Cali-Colombia
	 */
	function getIntelogsip(){

		settype($rcData,"array");
		settype($rcResult,"array");
		settype($rcTmp,"array");
		settype($rcSql,"array");

		$rcData = $this->rcData;

		if($rcData && is_array($rcData)){

			extract($rcData);
			$this->objGateway->setData(array("inlocodigon"=>$inlocodigon));
			$this->objGateway->getDetailIntegrationSip();
			$rcTmp = $this->objGateway->getResult();
				
			if(is_array($rcTmp) && $rcTmp){
				$rcResult["result"] = true;
				$rcResult["data"] = $rcTmp;
			}else{
				$rcResult["message"] = 68;
				$rcResult["result"] = false;
			}
		}else{
			$rcResult["message"] = 100;
			$rcResult["result"] = false;
		}
		$this->rcResult = $rcResult;
	}
	
	/**
	 * @copyright Copyright 2010 &copy; FullEngine
	 *
	 * actualiza el detalle de log para el sistema SIPA
	 * @author freina <freina@parquesoft.com>
	 * @date 29-Apr-2010 16:00
	 * @location Cali-Colombia
	 */
	function setIntelogsip(){
		
		settype($rcData,"array");
		settype($rcResult,"array");
		settype($sbResult,"string");

		$rcData = $this->rcData;

		if($rcData && is_array($rcData)){

			extract($rcData);
			$this->objGateway->setData(array("inlocodigon"=>$inlocodigon,"caso"=>$caso,"area"=>$area,
															"serie"=>$serie,"tipo_carpeta"=>$tipo_carpeta,
															"localizacion"=>$localizacion));
			$this->objGateway->setDetailIntegrationSip();
			$sbResult = $this->objGateway->getConsult();
			if($sbResult){
				$rcResult["message"] = 3;
				$rcResult["result"] = true;
			}else{
				$rcResult["message"] = 100;
				$rcResult["result"] = false;
			}
		}else{
			$rcResult["message"] = 100;
			$rcResult["result"] = false;
		}
		$this->rcResult = $rcResult;
	}
	
	//--------------------------------
	/**
	 * @copyright Copyright 2010 &copy; FullEngine
	 *
	 * ejecuta la integracion con el sistema SIPA
	 * @author freina <freina@parquesoft.com>
	 * @date 01-May-2010 11:24
	 * @location Cali-Colombia
	 */
	function _execSipaIntegration(){

		settype($objService,"object");
		settype($objDate,"object");
		settype($rcResult,"array");
		settype($rcTmp,"array");
		settype($rcAnswer,"array");
		settype($rcSql,"array");
		settype($sbResult,"string");
		settype($sbStatus,"string");
		settype($nuDate,"integer");


		if($this->nuInlocodigon){

			$this->objGateway->setData(array("inlocodigon"=>$this->nuInlocodigon));
			$this->objGateway->getDetailIntegrationSip();
			$rcTmp = $this->objGateway->getResult();

			if(is_array($rcTmp) && $rcTmp && $rcTmp[0]["caso"]){
				//se ejecuta la sincronizacion
				$rcTmp = $rcTmp[0];

				$objService = Application::loadServices('Sipa');
				$objService->setData($rcTmp);
				$rcAnswer = $objService->IntegrarSipa();
				
				if (!$rcAnswer["code"]){
					$rcAnswer["status"] = true;
				}else{
					$rcAnswer["status"] = false;	
				}

				if($rcAnswer["code"]==-1){
					$this->objGateway->setExecuteSql(false);
					$this->objGateway->setData(array("inlocodigon"=>$this->nuInlocodigon,"inloerrors"=>$rcAnswer["texto"]));
					$this->objGateway->setIntegration();
					$this->objGateway->setData(array("inlocodigon"=>$this->nuInlocodigon,"texto_error"=>$rcAnswer["texto"]));
					$this->objGateway->setDetailIntegrationSip();
					$rcResult["result"] = "fail";
					$rcResult["message"] = 72;
					$rcResult["text_error"] = $rcAnswer["texto"];
				}else{
					$objDate = Application :: loadServices("DateController");
					$nuDate = $objDate->fncintdatehour();
					$sbStatus = Application :: getConstant("REG_ACT");
					$this->objGateway->setExecuteSql(false);
					$this->objGateway->setData(array("inlocodigon"=>$this->nuInlocodigon,"inlofchaejfn"=>$nuDate,"inloestados"=>$sbStatus));
					$this->objGateway->setIntegration();
					$rcResult["result"] = "succes";
					$rcResult["fecha_mod"] = $objDate->fncformatofechahora($nuDate);
				}

				//se actualizan los registros
				$rcSql = $this->objGateway->getSql();
				if(is_array($rcSql) && $rcSql){
					//transaccion
					$this->objGateway->setSql($rcSql);
					$this->objGateway->executeTrans();
					$sbResult = $this->objGateway->getConsult();
				}
			}else{
				$rcResult["message"] = 100;
				$rcResult["result"] = "error";
			}
		}else{
			$rcResult["message"] = 100;
			$rcResult["result"] = "error";
		}

		$this->rcResult = $rcResult;
	}
}
?>