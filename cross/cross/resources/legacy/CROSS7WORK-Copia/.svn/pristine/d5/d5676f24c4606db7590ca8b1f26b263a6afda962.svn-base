<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCrCmdUpdateOrden {
	function execute() {
		
		settype($serviceDate, "object");
		settype($objService, "object");
		settype($objServ, "object");
		settype($rcResult, "array");
		settype($rcDimension, "array");
		settype($rcDimensionErrorMessage, "array");
		settype($rctmp, "array");
		settype($_RQUESTTPM, "array");
		settype($sbindex, "string");
		settype($sbvalue, "string");
		settype($sbtmp, "string");
		settype($sbpos, "string");
		settype($sbdbnull, "string");
		
		$_RQUESTTPM = $_REQUEST;
		extract($_REQUEST);

		if (($orden__ordenumeros == NULL) && ($orden__ordenumeros == "")) {
			WebRequest :: setProperty('cod_message', $message = 29);
			WebRequest :: setProperty('actualiza', $vari = 1);
			WebSession :: setProperty("rcRequest", $_RQUESTTPM);
			return "fail";
		}
		
		//se valida archivo cargado
		$rcResult = $this->validateuploadedFile();
		if($rcResult["result"]){
			WebRequest :: setProperty('cod_message', $rcResult["message"]);
			WebRequest :: setProperty('actualiza', $vari = 1);
			WebSession :: setProperty("rcRequest", $_RQUESTTPM);
			return "fail";
		}
		
		if (($ordenempresa__orgacodigos == "" && $ordenempresa__orgacodigos == null)) {
			WebRequest :: setProperty('cod_message', $message = 35);
			WebRequest :: setProperty('actualiza', $vari = 1);
			WebSession :: setProperty("rcRequest", $_RQUESTTPM);
			return "fail";
		}
		if (($ordenempresa__merecodigos != "" && $ordenempresa__merecodigos != null) 
		&& ($ordenempresa__tiorcodigos != "" && $ordenempresa__tiorcodigos != null) 
		&& ($ordenempresa__evencodigos != "" && $ordenempresa__evencodigos != null)
		&& ($orden__ordeobservs != "" && $orden__ordeobservs != null) 
		&& ($orden__ordefecregd != "" && $orden__ordefecregd != null)) {

			//VALICACIÓN DENUNCIA-DENUNCIANTE
			$objGeneral = Application::loadServices("General");
			$denuncia = $objGeneral->getParam("cross300","TYPES_CASE_DENUNCIA");
			if(is_array($denuncia))
			{
				if(in_array($ordenempresa__tiorcodigos,$denuncia))
					if (!$ordenempresa__contidentis && !$ordenempresa__contidentis_p) 
					{
						WebRequest :: setProperty('cod_message', $message = 64);
						WebSession::setProperty("rcRequest",$_RQUESTTPM); 
						return "fail";
					}
			}
		
			//validacion de tipos de dato
			$objServ = Application :: loadServices("Data_type");
			$sbdbnull = Application :: getConstant("DB_NULL");
			
			//se validan los datos
			switch($_REQUEST['customer_type']){
				case '1':
					if($ordenempresa__contidentis_p){
						$_REQUEST['ordenempresa__contidentis'] = $ordenempresa__contidentis_p;
						$ordenempresa__contidentis = $ordenempresa__contidentis_p;
					}else{
						$_REQUEST['ordenempresa__contidentis'] = $sbdbnull;	
					}
					break;
				case '2':
					if (($ordenempresa__contidentis == "" || $ordenempresa__contidentis == null)) {
						WebRequest :: setProperty('cod_message', $message = 0);
						WebSession :: setProperty("rcRequest", $_RQUESTTPM);
						return "fail";
					}
					break;
				default:
					$_REQUEST['ordenempresa__contidentis'] = $sbdbnull;
			}
			unset($_REQUEST['ordenempresa__contidentis_p']);

			//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
			if ($objServ->formatPrimaryKey($orden__ordenumeros) == false) {
				WebRequest :: setProperty('cod_message', $message = 4);
				WebRequest :: setProperty('actualiza', $vari = 1);
				WebSession :: setProperty("rcRequest", $_RQUESTTPM);
				return "fail";
			}

			//Servicio  de manipulacion de fechas
			$serviceDate = Application :: loadServices("DateController");
			if ($orden__ordefecregd == "") {
				$orden__ordefecregd = "$sbdbnull";
			} else {
				if ($serviceDate->fncvalidatedate($orden__ordefecregd)) {
					$_REQUEST["orden__ordefecregd"] = $serviceDate->fncdatehourtoint($orden__ordefecregd);
				} else {
					WebRequest :: setProperty('cod_message', $message = 7);
					WebRequest :: setProperty('actualiza', $vari = 1);
					WebSession :: setProperty("rcRequest", $_RQUESTTPM);
					return "fail";
				}
			}
			if ($orden__ordefecvend == "" || $orden__ordefecvend == NULL) {
				$orden__ordefecvend = "$sbdbnull";
			} else {
				if ($serviceDate->fncvalidatedate($orden__ordefecvend)) {
					$_REQUEST["orden__ordefecvend"] = $serviceDate->fncdatetoint($orden__ordefecvend);
				} else {
					WebRequest :: setProperty('cod_message', $message = 7);
					WebRequest :: setProperty('actualiza', $vari = 1);
					WebSession :: setProperty("rcRequest", $_RQUESTTPM);
					return "fail";
				}
			}

			if ($objServ->ValidateEmptyField($_REQUEST["orden__ordeobservs"])) {
				WebRequest :: setProperty('cod_message', $message = 0);
				WebSession :: setProperty("rcRequest", $_RQUESTTPM);
				return "fail";
			}
			$_REQUEST["orden__ordeobservs"] = $objServ->formatString($orden__ordeobservs);
			$_REQUEST["ordenempresa__oremradicas"] = $objServ->formatString($ordenempresa__oremradicas);
			$objService = Application :: loadServices('General');
			$_REQUEST['ordenempresa__locacodigos'] = $objService->getParam('cross300', 'COD_LOCALIZ_CALI');

			//se realiza la validacion de existencia de data
			if (!$ordenempresa__causcodigos) {
				$_REQUEST["ordenempresa__causcodigos"] = "$sbdbnull";
			}
			if ($orden__ordesitiejes) {
				$_REQUEST["orden__ordesitiejes"] = $objServ->formatString($orden__ordesitiejes);
			} else {
				$_REQUEST["orden__ordesitiejes"] = "$sbdbnull";
			}
			if (!$ordenempresa__contidentis) {
				$_REQUEST["ordenempresa__contidentis"] = "$sbdbnull";
			}
			if (!$ordenempresa__priocodigos) {
				$_REQUEST["ordenempresa__priocodigos"] = "$sbdbnull";
			}

			foreach ($_REQUEST as $sbindex => $sbvalue) {
				if ($sbindex != "orden__ordenumeros") {
					$sbpos = strpos($sbindex, "__");
					if (!($sbpos === false)) {
						$sbtmp = substr($sbindex, ($sbpos +2));
						$rctmp[$sbtmp] = $sbvalue;
					}
				}
			}

			//se determinan las dimesiones

			if ($rctmp["dimension"]) {
				$rcDimension = explode(",", $rctmp["dimension"]);
				unset ($rctmp["dimension"]);

				//Se validan los datos de los campos dinamicos
				$rcResult = $this->ValidateDynamicColumns($rcDimension, $rctmp);

				//se analiza el resultado de la validacion de campos dinamicos
				if ($rcResult["result"]) {
					$rctmp = $rcResult["data"];
				} else {

					//se regresa el $_REQUEST
					$_REQUEST = $_RQUESTTPM;
					//se analiza el error
					if ($rcResult["error"]) {
						$rcDimensionErrorMessage = Application :: getConstant("DIM_ERR_MSG");

						$message = $rcDimensionErrorMessage[$rcResult["error"]["type_error"]];
						WebRequest :: setProperty('error_field', $sberror_field = true);
						WebRequest :: setProperty('param', $rcResult["error"]["field"]);
					} else {
						$message = 0;
					}
					WebRequest :: setProperty('cod_message', $message);
					WebSession :: setProperty("rcRequest", $_RQUESTTPM);
					return "fail";
				}
			}

			$orden_manager = Application :: getDomainController('OrdenManager');
			$message = $orden_manager->updateOrden($orden__ordenumeros, $rctmp, $rcDimension);
			$_REQUEST["focusposition"] = "";
			if ($message == 3) {
				WebRequest :: setProperty('cod_message', $message);
				return "success";
			} else {
				$_REQUEST = $_RQUESTTPM;
				WebRequest :: setProperty('cod_message', $message);
				WebRequest :: setProperty('actualiza', $vari = 1);
				WebSession :: setProperty("rcRequest", $_RQUESTTPM);
				return "fail";
			}
		} else {
			WebRequest :: setProperty('cod_message', $message = 0);
			WebRequest :: setProperty('actualiza', $vari = 1);
			WebSession :: setProperty("rcRequest", $_RQUESTTPM);
			return "fail";
		}
	}

	/**
	* Copyright 2006 FullEngine
	* 
	* Metodo para validar campos dinamicos
	* @author freina<freina@parquesoft.com>
	* @param array $rcDimension Arreglo con los id de las dimensiones contra las
	*  cuales se debe validar los datos dinamicos
	* @return array $rcResult Areglo con el resultado [result] true o false
	* 												  [type_error] format o rule
	* 												  [field] Campo dinamico errado
	* @date 24-February-2006 14:40:00
	* @location Cali-Colombia
	*/
	function ValidateDynamicColumns($rcDimension, $rcData) {

		settype($objService, "object");
		settype($objManager, "object");
		settype($rcResult, "array");
		settype($rcUser, "array");
		settype($sbResult, "string");
		settype($nuDimecodigon, "integer");

		$rcResult["result"] = false;

		if ($rcDimension && $rcData) {

			//Carga el servicio de human_resources
			$rcUser = Application :: getUserParam();
			$objService = Application :: loadServices('General');
			$objManager = $objService->InitiateClass('DimensionManager');
			foreach ($rcDimension as $nuDimecodigon) {
				$objManager->setCodDimension($nuDimecodigon);
			}
			$objManager->setData($rcData);
			$objManager->setOperation('executeValidations');
			$objManager->setIdProcess($rcUser["username"]);
			$sbResult = $objManager->execute();
			if ($sbResult) {
				$rcResult["data"] = $objManager->getData();
				$rcResult["result"] = true;
			} else {
				$rcResult["error"] = $objManager->getError();
			}
			$objService->close();
		}
		return $rcResult;
	}
	
	/**
	* Copyright 2016 FullEngine
	* 
	* Metodo para validar archivos cargados para ser anexados
	* @author freina<freina@fullengine.com>
	* @return array $rcResult Areglo con el resultado [result] true o false
	* 												  [message] format o rule 	
	* @date 10-Mayo-2016 14:56:00
	* @location Cali-Colombia
	*/
	function validateuploadedFile(){
		
		settype($rcFile, "array");
		settype($rcReturn, "array");
		
		$rcReturn["result"] = false;
		
		$rcFile = WebRequest :: getPostFiles("anexos___anexnombarch");
		
		if(is_array($rcFile) && $rcFile && $rcFile["name"]){
			$rcReturn["result"] = true;
			$rcReturn["message"] = 75;
		}
		
		return $rcReturn;
	}
}
?>	