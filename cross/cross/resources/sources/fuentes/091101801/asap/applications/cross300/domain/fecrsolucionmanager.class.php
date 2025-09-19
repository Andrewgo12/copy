<?php

/**
 * @Copyright 2005 Parquesoft
 *
 * Clase manager de la tabla archivos
 * @author Ingravity 0.0.9
 * @location Cali - Colombia
 */
class FeCrSolucionManager{

	/**
	 * @Copyright 2005 Parquesoft
	 *
	 * Metodo constructor tabla: archivos
	 * @author Ingravity 0.0.9
	 * @location Cali - Colombia
	 */
	function FeCrSolucionManager(){
		$this->gatewayOrdenempresa = Application::getDataGateway("Ordenempresa");
		$this->gatewayOrden = Application::getDataGateway("Orden");
		$this->gatewayext = Application::getDataGateway("OrdenExtended");
	}

	/**
	 * @Copyright 2005 Parquesoft
	 *
	 * Metodo adicion de una solucion
	 * @author Ingravity 0.0.9
	 * @location Cali - Colombia
	 */
	function addSolucion($ordenumeros,$resumen){
			
		settype($rcReq, "array");
		settype($rcSql, "array");
		settype($sbResult, "string");
			
		$rcReq = $this->gatewayOrden->getByIdOrden($ordenumeros);
			
		if(is_array($rcReq) && $rcReq){

			//Valida que el requermimiento este finalizado
			if(!$rcReq[0]["ordefecfinad"]){
				return 40;
			}

			//Consulta el req de ordenempresa
			$rcReq = $this->gatewayOrdenempresa->getByIdOrdenempresa($ordenumeros);

			//Valida si el req ya tiene soluci�n
			if($rcReq[0]['oremsolucios']){
				return 41;
			}

			//Actualiza ordenempresa
			$this->gatewayOrdenempresa->updateOrdenempresaSolucios($ordenumeros,$resumen);
			if($this->gatewayOrdenempresa->consult == false){
				return 42;
			}

			//se actualizan los archivos anexos
			$rcSql = $this->addFiles($ordenumeros);

			if(is_array($rcSql) && $rcSql){

				$this->gatewayext->OrdenTrans($rcSql);
				$sbResult = $this->gatewayext->consult;
			}

			$this->UnsetRequest();
			$this->unsetAttachment();
			return 3;
		}else{
			return 39;
		}
	}

	/**
	 * @Copyright 2005 Parquesoft
	 *
	 * Metodo de actualizacion de datos tabla: archivos
	 * @author Ingravity 0.0.9
	 * @location Cali - Colombia
	 */
	function updateSolucion($ordenumeros,$resumen){

		settype($rcReq, "array");
		settype($rcSql, "array");
		settype($sbResult, "string");

		$rcReq = $this->gatewayOrden->getByIdOrden($ordenumeros);

		if(is_array($rcReq) && $rcReq){

			//Valida que el requermimiento este finalizado
			if(!$rcReq[0]["ordefecfinad"]){
				return 40;
			}

			//Consulta el req de ordenempresa
			$rcReq = $this->gatewayOrdenempresa->getByIdOrdenempresa($ordenumeros);

			//Valida si el req no tiene soluci�n
			if(!$rcReq[0]['oremsolucios']){
				return 44;
			}

			//Actualiza ordenempresa
			$this->gatewayOrdenempresa->updateOrdenempresaSolucios($ordenumeros,$resumen);

			if($this->gatewayOrdenempresa->consult == false){
				return 42;
			}

			//se actualizan los archivos anexos
			$rcSql = $this->updateFiles($ordenumeros);

			if(is_array($rcSql) && $rcSql){

				$this->gatewayext->OrdenTrans($rcSql);
				$sbResult = $this->gatewayext->consult;
			}


			$this->UnsetRequest();
			$this->unsetAttachment();
			return 3;
		}else{
			return 39;
		}
	}

	/**
	 * @Copyright 2005 Parquesoft
	 *
	 * Metodo de eliminacion de datos tabla: archivos
	 * @author Ingravity 0.0.9
	 * @location Cali - Colombia
	 */
	function deleteSolucion($ordenumeros){

		settype($objGateway, "object");
		settype($objManager, "object");
		settype($rcReq, "array");
		settype($rcTipos, "array");
		settype($rcSql, "array");
		settype($sbResult, "string");
		
		$sbResult = true;


		$rcReq = $this->gatewayOrden->getByIdOrden($ordenumeros);

		if(is_array($rcReq) && $rcReq){

			//Valida que el requermimiento este finalizado
			if(!$rcReq[0]["ordefecfinad"]){
				return 40;
			}

			//Consulta el req de ordenempresa
			$rcReq = $this->gatewayOrdenempresa->getByIdOrdenempresa($ordenumeros);

			//Valida si el req no tiene soluci�n
			if(!$rcReq[0]['oremsolucios']){
				return 44;
			}

			//Actualiza ordenempresa
			$this->gatewayOrdenempresa->updateOrdenempresaSolucios($ordenumeros,null);

			if($this->gatewayOrdenempresa->consult == false){
				return 42;
			}

			//actualiza el archvo
			$objService = Application::loadServices('General');
			$rcTipos = $objService->getConstant('TIPO_FILE');
			//se eliminan lo archivos anteriores si los hay
			$objService = Application::loadServices('General');
			$objGateway = $objService->loadGateway('Archivos');
			$rcSql= $objGateway->deleteSqlArchivos($rcTipos["solucion"],$ordenumeros,null);
			$objService->close();
				
			if(is_array($rcSql) && $rcSql){

				$this->gatewayext->OrdenTrans($rcSql);
				$sbResult = $this->gatewayext->consult;
			}

			if($sbResult == false){
				$this->gatewayOrdenempresa->updateOrdenempresaSolucios($ordenumeros,$rcReq[0]['oremsolucios']);
				return 100;
			}
			$this->UnsetRequest();
			$this->unsetAttachment();
			return 3;
		}else{
			return 39;
		}
	}
	/**
	 * @Copyright 2005 Parquesoft
	 *
	 * Metodo para limpiar los datos de la sesion de la tabla: archivos
	 * @author Ingravity 0.0.9
	 * @location Cali - Colombia
	 */
	function UnsetRequest(){
		unset($_REQUEST["ordenempresa__ordenumeros"]);
		unset($_REQUEST["solucion__ordenumeros"]);
		unset($_REQUEST["solucion__resumen"]);
	}

	/**
	 * Copyright 2007 FullEngine
	 *
	 * limpia lo archivos anexos
	 * @author freina<freina@parquesoft.com>
	 * @return boolean true
	 * @date 02-Jun-2007 10:59
	 * @location Cali-Colombia
	 */
	function unsetAttachment(){

		settype($rcFileName,"array");
		settype($rcTmp,"array");
		settype($nuCont,"integer");

		if ((WebSession :: issetProperty("_rcSolucionFileList"))) {
			//se obtienen los archivos ya guardados
			$rcFileName = WebSession :: getProperty("_rcSolucionFileList");
			foreach ($rcFileName as $nuCont => $rcTmp) {
				if(!$rcTmp["id"]){
					WebSession :: unsetProperty($rcTmp["index"]);
				}
			}
			WebSession :: unsetProperty("_rcSolucionFileList");
		}
	}

	/**
	 * @copyright Copyright 2007 FullEngine
	 *
	 * Ingresa los archivos anexos
	 * @param string $sbOrdenumeros Cadena con el numero del caso
	 * @return boolean true o false
	 * @author freina <freina@parquesoft.com>
	 * @date 02-Jun-2007 10:59
	 * @location Cali-Colombia
	 */
	function addFiles($sbOrdenumeros) {

		settype($objService, "object");
		settype($objGateway, "object");
		settype($rcTipos, "array");
		settype($rcTmp, "array");
		settype($rcFileName, "array");
		settype($rcSql, "array");
		settype($rcResult, "array");
		settype($sbTipo, "string");
		settype($nuArchcodigon, "integer");
		settype($nuCant, "integer");
		settype($nuCont, "integer");


		if($sbOrdenumeros){

			//se obtienen los archivos ya guardados
			$rcFileName = WebSession :: getProperty("_rcSolucionFileList");

			if($rcFileName && is_array($rcFileName)){

				$nuCant = sizeof($rcFileName);

				//graba el archivo
				$objNumerador = Application :: getDomainController('NumeradorManager');
				$nuArchcodigon = $objNumerador->fncgetByIdNumerador("archivos",$nuCant);
				$objService = Application::loadServices('General');
				$rcTipos = $objService->getConstant('TIPO_FILE');
				$objService = Application::loadServices('General');
				$objGateway = $objService->loadGateway('Archivos');				
				$sbTipo = $rcTipos["solucion"];
				foreach($rcFileName as $nuCont=>$rcTmp){
					$rcSql = $objGateway->addSqlArchivos($nuArchcodigon,
					$sbTipo,$sbOrdenumeros,$rcTmp["name"],$rcTmp["type"],
					$rcTmp["size"],WebSession :: getProperty($rcTmp["index"]),$rcTmp["ext"]);
					$nuArchcodigon ++;

					if(is_array($rcResult) && $rcResult){
						if(is_array($rcSql) && $rcSql){
							$rcResult = array_merge($rcResult,$rcSql);
						}
					}else{
						$rcResult = $rcSql;
					}
				}
				$objService->close();
			}
		}
		return $rcResult;
	}

	/**
	 * @copyright Copyright 2007 FullEngine
	 *
	 * Actualiza los archivos anexos
	 * @param string $sbOrdenumeros Cadena con el numero del caso
	 * @return boolean true o false
	 * @author freina <freina@parquesoft.com>
	 * @date 02-Jun-2007 10:59
	 * @location Cali-Colombia
	 */
	function updateFiles($sbOrdenumeros) {

		settype($objService, "object");
		settype($objGateway, "object");
		settype($rcTipos, "array");
		settype($rcTmp, "array");
		settype($rcFileName, "array");
		settype($rcFileN, "array");
		settype($rcFileO, "array");
		settype($rcFileDB, "array");
		settype($rcSql, "array");
		settype($rcResult, "array");
		settype($sbTipo, "string");
		settype($nuArchcodigon, "integer");
		settype($nuCant, "integer");
		settype($nuCont, "integer");


		if($sbOrdenumeros){

			//se obtienen los archivos ya guardados
			$rcFileName = WebSession :: getProperty("_rcSolucionFileList");

			if($rcFileName && is_array($rcFileName)){

				//se separan los archivos nuevos y los viejos
				foreach($rcFileName as $rcTmp){
					if($rcTmp["id"]){
						$rcFileO[]=$rcTmp["id"];
					}else{
						$rcFileF[]=$rcTmp;
					}
				}
			}


			$objService = Application::loadServices('General');
			$rcTipos = $objService->getConstant('TIPO_FILE');
			$sbTipo = $rcTipos["solucion"];

			//se eliminan lo archivos anteriores si los hay
			$objService = Application::loadServices('General');
			$objGateway = $objService->loadGateway('Archivos');
			$rcFileDB = $objGateway->getByRefArchivos($sbTipo,$sbOrdenumeros);

			if($rcFileDB){
				$rcResult= $objGateway->deleteSqlArchivos($sbTipo,$sbOrdenumeros,$rcFileO);
			}

			$objService->close();

			if($rcFileF){
				$nuCant = sizeof($rcFileF);
				$objNumerador = Application :: getDomainController('NumeradorManager');
				$nuArchcodigon = $objNumerador->fncgetByIdNumerador("archivos",$nuCant);
				$objService = Application::loadServices('General');
				$objGateway = $objService->loadGateway('Archivos');

				//graba el archivo
				//se almacenan los nuevos
				foreach($rcFileF as $nuCont=>$rcTmp){
					$rcSql = $objGateway->addSqlArchivos($nuArchcodigon,
					$sbTipo,$sbOrdenumeros,$rcTmp["name"],$rcTmp["type"],
					$rcTmp["size"],WebSession :: getProperty($rcTmp["index"]),$rcTmp["ext"]);

					$nuArchcodigon ++;

					if(is_array($rcResult) && $rcResult){
						if(is_array($rcSql) && $rcSql){
							$rcResult = array_merge($rcResult,$rcSql);
						}
					}else{
						$rcResult = $rcSql;
					}
				}
				$objService->close();
			}

		}
		return $rcResult;
	}
}
?>