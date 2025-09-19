<?php
class FeWFProcesoManager {
	var $gateway;

	function FeWFProcesoManager() {
		$this->gateway = Application :: getDataGateway("proceso");
	}

	function addProceso($procnombres, $procdescris, $perscodigos, $procestinis, $procestfins, $procfeccren, $orgacodigos, $proctiempon, $procactivas, $rcConfig) {

		$this->validaDetaconfproc($rcConfig);
		if ($this->blResult) {
			return 17;
		}
		//Obtiene el codigo del proceso
		$objnumerador = Application :: getDomainController('NumeradorManager');
		$proccodigos = $objnumerador->fncgetByIdNumerador("proceso");
		//Crea el proceso
		$this->gateway->addProceso($proccodigos, $procnombres, $procdescris, $perscodigos, $procestinis, $procestfins, $procfeccren, $orgacodigos, $proctiempon, $procactivas);
		//Crea la configuración para el proceso
		$this->gateway->addConfigproces($proccodigos, $procnombres);
		//Asocia los datos del caso al proceso 
		foreach ($rcConfig as $key => $rcValue) {
			if ($rcValue[1])
				$this->gateway->addDetaconfproc($proccodigos, $key, $rcValue[1], $rcValue[0]);
		}
		//Ejecuta los sql
		$this->gateway->execSql();
		if ($this->gateway->consult == false)
			return 100;
		$this->UnsetRequest();
		return 3;
	}

	function updateProceso($proccodigos, $procnombres, $procdescris, $perscodigos, $procestinis, $procestfins, $procfeccren, $orgacodigos, $proctiempon, $procactivas, $rcConfig) {

		if ($this->gateway->existProceso($proccodigos) == 1) {
			//Valida que la combinacion del detalle de la configuracion no exista
			$this->validaDetaconfproc($rcConfig, $proccodigos);
			if ($this->blResult) {
				return 17;
			}
			$this->gateway->updateProceso($proccodigos, $procnombres, $procdescris, $perscodigos, $procestinis, $procestfins, $procfeccren, $orgacodigos, $proctiempon, $procactivas);
			$this->gateway->deleteDetaConfproc($proccodigos);
			//Asocia los datos del caso al proceso 
			foreach ($rcConfig as $key => $rcValue) {
				if ($rcValue[1])
					$this->gateway->addDetaconfproc($proccodigos, $key, $rcValue[1], $rcValue[0]);
			}
			//Ejecuta los sql
			$this->gateway->execSql();
			if ($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}

	function deleteProceso($proccodigos) {
		if ($this->gateway->existProceso($proccodigos) == 1) {
			//Valida si el proceso esta en uso en algun caso
			if ($this->gateway->existProcesoOrd($proccodigos)) {
				return 15;
			}
			//Consulta las rutas del proceso
			$rcRutas = $this->gateway->getRutas($proccodigos);
			if(is_array($rcRutas)){
				foreach($rcRutas as $rcTmp)
					$this->gateway->deleteRutaRegla($rcTmp['rutacodigon']);
			}
			$this->gateway->deleteDetaConfproc($proccodigos);
			$this->gateway->deleteConfigproces($proccodigos);
			$this->gateway->deleteRutaByProc($proccodigos);
			$this->gateway->deleteProceso($proccodigos);

			//Ejecuta los sql
			$this->gateway->execSql();
			if ($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function getByIdProceso($proccodigos) {
		$data_proceso = $this->gateway->getByIdProceso($proccodigos);
		return $data_proceso;
	}
	function getDetaconfprocByProceso($proccodigos) {
		$data_proceso = $this->gateway->getDetaconfprocByProceso($proccodigos);
		return $data_proceso;
	}
	function validaDetaconfproc($rcConfig, $proccodigos = null) {
		foreach ($rcConfig as $key => $rcValue) {
			if ($rcValue[1])
				$rcDetaconfproc[$key] = $rcValue[1];
		}
		$this->blResult = $this->gateway->validaDetaconfproc($rcDetaconfproc, $proccodigos);
	}

	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo adicion de datos tabla: ruta
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function addRuta($proccodigos, $tarecodigos, $rutaesactas, $rutatarsigs, $rutainitars, $rutacantien, $rutacantien_h, $reglas) {
		
		settype($objGateway,"object");
		settype($objService,"object");
		settype($objDate,"object");
		settype($objnumerador, "object");
		settype($rcData,"array");
		settype($rcReglas,"array");
		settype($sbDbNull,"string");
		settype($reglcodigos, "string");
		settype($rutacodigon, "integer");
		
		$objDate = Application :: loadServices("DateController");
		$objService = Application :: loadServices("Data_type");
		$objGateway = Application :: getDataGateway("proceso");
		$sbDbNull = Application :: getConstant("DB_NULL");
		
		//se evalua la cantidad de tiempo de la tarea
		if ($rutacantien) {
			//cantidad de dias a segundos
			$rutacantien = $rutacantien * $objDate->nuSecsDay;
		} else {
			$rutacantien = 0;
		}
		if ($rutacantien_h) {
			
			if ($rutacantien_h >= 0 && $rutacantien_h <= 23) {
				$rutacantien += ($rutacantien_h * $objDate->nuSecsHour);
			} else {
				return 6;
			}
		}
		//se evalua el porcentaje de tiempo de la tarea
		if ($rutacantien){
			//se obtiene el tiempo total del proceso
			$rcData = $objGateway->getByIdProceso($proccodigos);
			if(is_array($rcData) && $rcData){
				$rcData = $rcData[0];
				if($rcData["proctiempon"]){
					$rutaporcumn = ($rutacantien * 100) / $rcData["proctiempon"];
					$rutaporcumn = $objService->round_up($rutaporcumn,9);
				}else{
					$rutaporcumn = $sbDbNull;
				}
			}
		}else{
			$rutaporcumn = $sbDbNull;
		}
		
		//Obtiene el codigo de la ruta
		$objnumerador = Application :: getDomainController('NumeradorManager');
		$rutacodigon = $objnumerador->fncgetByIdNumerador("rutas");
		if ($objGateway->existRuta($rutacodigon) == 0) {
			$objGateway->addRuta($rutacodigon, $proccodigos, $tarecodigos, $rutaesactas, $rutatarsigs, $rutainitars, $rutaporcumn, $rutacantien);
			if($reglas != null || $reglas != ''){
				$rcReglas = explode(",",$reglas);
				foreach($rcReglas as $reglcodigos)
					if($reglcodigos != null || $reglcodigos != '')
						$objGateway->addRutaRegla($rutacodigon,$reglcodigos);
			}
			//Ejecuta los sql
			$objGateway->execSql();
			if ($objGateway->consult == false)
				return 100;
			return 3;
		} else {
			return 1;
		}
	}
	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo de eliminacion de datos tabla: ruta
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function deleteRuta($rutacodigon) {
		$gateway = Application :: getDataGateway("proceso");
		if ($gateway->existRuta($rutacodigon) == 1) {
			$gateway->deleteRutaRegla($rutacodigon);
			$gateway->deleteRuta($rutacodigon);
			//Ejecuta los sql
			$gateway->execSql();
			if ($gateway->consult == true){
				return 3;
			} else {
				return 100;
			}
		} else {
			return 2;
		}
	}
	/**
	* @Copyright 2005 Parquesoft
	*
	* Metodo de actualizacion de datos tabla: ruta
	* @author Ingravity 0.0.9
	* @location Cali - Colombia
	*/
	function updateRuta($rutacodigon, $proccodigos, $tarecodigos, $rutaesactas, $rutatarsigs, $rutainitars, $rutacantien, $rutacantien_h, $reglas) {
		
		settype($objGateway, "object");
		settype($objService,"object");
		settype($objDate, "object");
		settype($rcData, "array");
		settype($rcReglas,"array");
		settype($sbDbNull, "string");
		
		$objDate = Application :: loadServices("DateController");
		$objService = Application :: loadServices("Data_type");
		$objGateway = Application :: getDataGateway("proceso");
		$sbDbNull = Application :: getConstant("DB_NULL");
		
		//se evalua la cantidad de tiempo de la tarea
		if ($rutacantien) {
			//cantidad de dias a segundos
			$rutacantien = $rutacantien * $objDate->nuSecsDay;
		} else {
			$rutacantien = 0;
		}
		if ($rutacantien_h) {
			
			if ($rutacantien_h >= 0 && $rutacantien_h <= 23) {
				$rutacantien += ($rutacantien_h * $objDate->nuSecsHour);
			} else {
				return 6;
			}
		}
		//se evalua el porcentaje de tiempo de la tarea
		if ($rutacantien){
			//se obtiene el tiempo total del proceso
			$rcData = $objGateway->getByIdProceso($proccodigos);
			if(is_array($rcData) && $rcData){
				$rcData = $rcData[0];
				if($rcData["proctiempon"]){
					$rutaporcumn = ($rutacantien * 100) / $rcData["proctiempon"];
					$rutaporcumn = $objService->round_up($rutaporcumn,9);
				}else{
					$rutaporcumn = $sbDbNull;
				}
			}
		}else{
			$rutaporcumn = $sbDbNull;
		}
		
		if ($objGateway->existRuta($rutacodigon) == 1) {
			$objGateway->deleteRutaRegla($rutacodigon);
			if($reglas != null || $reglas != ''){
				$rcReglas = explode(",",$reglas);
				foreach($rcReglas as $reglcodigos)
					if($reglcodigos != null || $reglcodigos != '')
						$objGateway->addRutaRegla($rutacodigon,$reglcodigos);
			}
			$objGateway->updateRuta($rutacodigon, $proccodigos, $tarecodigos, $rutaesactas, $rutatarsigs, $rutainitars, $rutaporcumn, $rutacantien);
			//Ejecuta los sql
			$objGateway->execSql();
			if ($objGateway->consult == false)
				return 100;
			return 3;
		} else {
			return 2;
		}
	}

	function UnsetRequest() {
		unset ($_REQUEST["proceso__proccodigos"]);
		unset ($_REQUEST["proceso__procnombres"]);
		unset ($_REQUEST["proceso__procdescris"]);
		unset ($_REQUEST["proceso__perscodigos"]);
		unset ($_REQUEST["proceso__procestinis"]);
		unset ($_REQUEST["proceso__procestfins"]);
		unset ($_REQUEST["proceso__procfeccren"]);
		unset ($_REQUEST["proceso__orgacodigos"]);
		unset ($_REQUEST["proceso__proctiempon"]);
		unset ($_REQUEST["horas"]);
		unset ($_REQUEST["proceso__procactivas"]);
		unset ($_REQUEST["tiorcodigos"]);
		unset ($_REQUEST["evencodigos"]);
		unset ($_REQUEST["causcodigos"]);
	}
}
?>