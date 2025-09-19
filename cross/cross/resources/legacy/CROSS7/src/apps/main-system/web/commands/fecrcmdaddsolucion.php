<?php
require_once "Web/WebRequest.class.php";
/**
 * @Copyright 2005 Parquesoft
 *
 * Comando de adicionar datos a la tabla archivos
 * @author Ingravity 0.0.9
 * @location Cali - Colombia
 */
Class FeCrCmdAddSolucion {

	function execute() {
		
		settype($objManager, "object");
		settype($objService, "object");
		settype($rcResult, "array");
		settype($nuMessage, "integer");

		extract($_REQUEST);

		//se valida archivo cargado
		$rcResult = $this->validateuploadedFile();
		if($rcResult["result"]){
			WebRequest :: setProperty('cod_message', $rcResult["message"]);
			return "fail";
		}

		if (($ordenempresa__ordenumeros != NULL) && ($ordenempresa__ordenumeros != "")
		&& ($solucion__resumen != NULL) && ($solucion__resumen != "")) {
			
			$objService = Application :: loadServices("Data_type");
			
			/*Hace la validacion de formato (Caracteres no permitidos) de la llave primaria*/
			if ($objService->formatPrimaryKey($ordenempresa__ordenumeros) == false) {
				WebRequest :: setProperty('cod_message', $nuMessage = 4);
				return "fail";
			}

			$solucion__resumen = $objService->formatString($solucion__resumen);

			$objManager = Application :: getDomainController('SolucionManager');
			$nuMessage = $objManager->addSolucion($ordenempresa__ordenumeros,
			$solucion__resumen);
			WebRequest :: setProperty('cod_message', $nuMessage);
			return "success";
		} else {
			WebRequest :: setProperty('cod_message', $nuMessage = 0);
			return "fail";
		}
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
			$rcReturn["message"] = 76;
		}

		return $rcReturn;
	}

}
?>