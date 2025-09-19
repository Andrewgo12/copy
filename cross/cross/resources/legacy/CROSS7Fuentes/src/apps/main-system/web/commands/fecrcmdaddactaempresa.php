<?php
/*
 // you can define the commando extending the WebCommand
 require_once "Web/WebCommand.php";
 class DefaultCommand extends WebCommand {
 }
 // really... is not neccesary extend the WebCommand
 */
require_once "Web/WebRequest.class.php";
class FeCrCmdAddActaempresa {
	/**
	 * @copyright Copyright 2004 &copy; FullEngine
	 *
	 *  Adcion de atenciona actas  una tarea
	 * @author creyes <cesar.reyes@parquesoft.com>
	 * @date 17-sep-2004 10:21:00
	 * @location Cali-Colombia
	 */
	function execute() {

		extract($_REQUEST);

		$acemcompromis = $this->frcExplode($acemcompromis);

		settype($objManager, "object");
		settype($objDate, "object");
		settype($objService, "object");
		settype($rcActivities, "array");
		settype($rcTmp, "array");
		settype($rcDimension, "array");
		settype($rcResult, "array");
		settype($_RQUESTTPM, "array");
		settype($rcDimensionErrorMessage, "array");
		settype($sbAuto, "string");
		settype($sbDbNull, "string");
		settype($sbIndex, "string");
		settype($sbValue, "string");
		settype($sbTmp, "string");
		settype($sbPos, "string");
		settype($sbMessage, "string");

		$_RQUESTTPM = $_REQUEST;
		
		//se valida archivo cargado
		$rcResult = $this->validateuploadedFile();
		if($rcResult["result"]){
			WebRequest :: setProperty('cod_message', $rcResult["message"]);
			WebSession :: setProperty("rcRequest", $_RQUESTTPM);
			return "fail";
		}

		if (($actaempresa__esaccodigos != NULL) && ($actaempresa__esaccodigos != "")
		&& ($actaempresa__acemobservas != NULL) && ($actaempresa__acemobservas != "")
		&& ($actaempresa__acemfecaten != NULL) && ($actaempresa__acemfecaten != "")) {
			$actaempresa__actacodigos = $acta;
			//Carga los servicios de manejo de tipos de datos y de formato de fechas
			$objService = Application :: loadServices("Data_type");
			$objDate = Application :: loadServices("DateController");

			//constantes
			$sbDbNull = Application :: getConstant("DB_NULL");

			//Hace la validacion de campos numericos y formateo de campos cadena
			$actaempresa__esaccodigos = $objService->formatString($actaempresa__esaccodigos);
			$actaempresa__acemobservas = $objService->formatString($actaempresa__acemobservas);
			$actaempresa__acemradicas = $objService->formatString($actaempresa__acemradicas);

			//Determina la fecha de registro timestamp (fecha del dia)
			$actaempresa__acemfeccren = $objDate->fncintdatehour();

			//Valida y convierte las fechas
			if (!$objDate->fncvalidatedate($actaempresa__acemfecaten)) {
				WebRequest :: setProperty('cod_message', $message = 7);
				WebSession :: setProperty("rcRequest", $_RQUESTTPM);
				return "fail";
			}

			$actaempresa__acemfecaten = $objDate->fncdatehourtoint($actaempresa__acemfecaten);

			//Extrae la hora de la fecha
			$actaempresa__acemhorainn = $objDate->getHour2DateInSecs($actaempresa__acemfecaten);
			if ($actaempresa__acemhorainn === null) {
				WebRequest :: setProperty('cod_message', $message = 9);
				WebSession :: setProperty("rcRequest", $_RQUESTTPM);
				return "fail";
			}

			//Si existe una de las dos horas, la que no existe sera igualada a la que si existe
			if ($actaempresa__acemhorafin) {
				//Convierte la hora en la cantidad de segundos entre la primera hasta la hora
				$actaempresa__acemhorafin = $objDate->hour2secs($actaempresa__acemhorafin);
				if ($actaempresa__acemhorafin === null){
					$actaempresa__acemhorafin = $sbDbNull;
				}
			}else{
				$actaempresa__acemhorafin = $actaempresa__acemhorainn;
			}


			if (is_numeric($actaempresa__acemhorainn) && is_numeric($actaempresa__acemhorafin)) {
				if ($actaempresa__acemhorainn > $actaempresa__acemhorafin) {
					WebRequest :: setProperty('cod_message', $message = 10);
					WebSession :: setProperty("rcRequest", $_RQUESTTPM);
					return "fail";
				}
			}
			if ($activities) {
				$rcactivities = explode(",", $activities);
			} else {
				$sbAuto = Application :: getConstant("ACT_REQ");
				if ($sbAuto) {
					WebRequest :: setProperty('cod_message', $message = 23);
					WebSession :: setProperty("rcRequest", $_RQUESTTPM);
					return "fail";
				}
			}

			if(isset($actaempresa__acemusumods)) {
				if ($actaempresa__acemusumods == "" || $actaempresa__acemusumods == NULL){
					$actaempresa__acemusumods = $sbDbNull;
				}
			}else{
				$actaempresa__acemusumods = $sbDbNull;
			}
				
			foreach ($_REQUEST as $sbIndex => $sbValue) {
				if ($sbIndex != "orden__ordenumeros") {
					$sbPos = strpos($sbIndex, "__");
					if (!($sbPos === false)) {
						$sbTmp = substr($sbIndex, ($sbPos +2));
						$rcTmp[$sbTmp] = $sbValue;
					}
				}
			}

			//se determinan las dimesiones
			if ($rcTmp["dimension"]) {

				$rcDimension = explode(",", $rcTmp["dimension"]);
				unset ($rcTmp["dimension"]);

				//Se validan los datos de los campos dinamicos
				$rcResult = $this->ValidateDynamicColumns($rcDimension, $rcTmp);

				//se analiza el resultado de la validacion de campos dinamicos
				if ($rcResult["result"]) {
					$rcTmp = $rcResult["data"];
				} else {

					//se regresa el $_REQUEST
					$_REQUEST = $_RQUESTTPM;

					//se analiza el error
					if ($rcResult["error"]) {

						$rcDimensionErrorMessage = Application :: getConstant("DIM_ERR_MSG");

						$sbMessage = $rcDimensionErrorMessage[$rcResult["error"]["type_error"]];

						WebRequest :: setProperty('error_field', $sberror_field = true);
						WebRequest :: setProperty('param', $rcResult["error"]["field"]);
					} else {
						$sbMessage = 0;
					}
					WebRequest :: setProperty('cod_message', $sbMessage);
					WebSession :: setProperty("rcRequest", $_RQUESTTPM);
					return "fail";
				}
			}

			$objManager = Application :: getDomainController('ActaempresaManager');
			$message = $objManager->addActaempresa($actaempresa__actacodigos,
			$actaempresa__acemnumeros, $actaempresa__esaccodigos, 
			$actaempresa__acemfeccren, $actaempresa__acemfecaten, 
			$actaempresa__acemhorainn, $actaempresa__acemhorafin,
			$actaempresa__acemobservas, $actaempresa__acemusumods, 
			$actaempresa__acemradicas,$orgacodigos, 
			$rcactivities,$acemcompromis,$compromiso,$acemnumerosupd,$rcDimension,$rcTmp);

			if ($message[0] == 'FIN') {
				$_REQUEST['ordenempresa__ordenumeros'] = $message[1];
				WebRequest :: setProperty('cod_message', $msg = 3);
				return "solucion";
			} else
			if ($message == 3) {
				WebRequest :: setProperty('cod_message', $message);
				return "success";
			} else {
				WebRequest :: setProperty('cod_message', $message);
				return "fail";
			}
		} else {
			WebRequest :: setProperty('cod_message', $message = 0);
			WebSession :: setProperty("rcRequest", $_RQUESTTPM);
			return "fail";
		}
	}
	
	/**
    * Copyright 2010 FullEngine
    * 
    * Metodo para validar campos dinamicos
    * @author freina<freina@parquesoft.com>
    * @param array $rcDimension Arreglo con los id de las dimensiones contra las
    *  cuales se debe validar los datos dinamicos
    * @return array $rcResult Areglo con el resultado [result] true o false
    * 												  [type_error] format o rule
    * 												  [field] Campo dinamico errado 	
    * @date 24-Oct-2010 16:57:00
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
	
	function frcExplode($acemcompromis)
	{
		if(strpos($acemcompromis,"_FILA_")!==false)
		{
			$rcTmp = explode("_FILA_",$acemcompromis);
			foreach ($rcTmp as $value)
			{
				$rcTmp2 = explode("_COL_",$value);
				$rcReturn[$rcTmp2[0]] = $rcTmp2[1];
			}
		}
		elseif(strpos($acemcompromis,"_COL_")!==false)
		{
			$rcTmp2 = explode("_COL_",$acemcompromis);
			$rcReturn[$rcTmp2[0]] = $rcTmp2[1];
		}
		if(isset($rcReturn))
		return $rcReturn;
		else
		return false;
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
		
		$rcFile = WebRequest :: getPostFiles("anexo");
		
		if(is_array($rcFile) && $rcFile && $rcFile["name"]){
			$rcReturn["result"] = true;
			$rcReturn["message"] = 75;
		}
		
		return $rcReturn;
	}
}
?>