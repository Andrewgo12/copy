<?php                  
class FeWFRecorridoManager {
	var $gateway;
	function FeWFRecorridoManager() {
		$this->gateway = Application :: getDataGateway("RecorridoExtended");
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Obtiene lo SQL de las tareas siguientes en un proceso
	*	@param string $isbActacodigos (Codigo del acta)
	*	@return	 array $orcResult  Arreglo con la data de las actas a inactivar
	*	@author freina <freina@parquesoft.com>
	*  @date 22-Jul-2004 13:49
	*   @location Cali-Colombia
	*/
	function DeactivateRoute($isbActacodigos) {

		settype($objGateway, "object");
		settype($orcResult, "array");
		settype($rcActa, "array");
		settype($rcRecorrido, "array");
		settype($rcTmp, "array");
		settype($rcTmpN, "array");
		settype($rcSon, "array");
		settype($rcResult, "array");
		settype($rcConstant, "array");
		settype($sbActacodigos, "string");
		settype($nuCont, "integer");

		if ($isbActacodigos) {

			$rcConstant["opc"] = Application :: getConstant("TAREA_OPC");
			$rcConstant["req"] = Application :: getConstant("TAREA_REQ");
			$objGateway = Application :: getDataGateway("acta");
			$rcActa = $objGateway->getByIdActa($isbActacodigos);
			$rcActa = $rcActa[0];
			if ($rcActa) {

				//Se obtienen los datos del recorrido para la orden
				$rcRecorrido = $this->gateway->GetRecorridoByOrdenumeros($rcActa["ordenumeros"]);
				if ($rcRecorrido) {
					foreach ($rcRecorrido as $nuCont => $rcTmp) {
						$rcTmpN[$rcTmp["recocodigos"]] = $rcTmp;
						$rcSon[$rcTmp["actacodigos"]][] = $rcTmp;
					}
					if ($rcRecorrido) {
						$this->fncseleccion($isbActacodigos, $rcTmpN, $rcSon, $rcResult, $rcConstant);
						//se organiza el arreglo de salida
						foreach ($rcResult as $nuCont => $sbActacodigos) {
							$orcResult[0][$nuCont] = $sbActacodigos;
							$orcResult[1][$nuCont] = $this->gateway->GetSqlDeactivateRegistryRecorrido($sbActacodigos);
						}
					}
				}
			}
		}
		return $orcResult;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*   
	*   Inicia el formateo de la matriz utilizada para pintar el arbol
	*   @param $ircData array   Data total
	* @param Array $ircSon Arreglo con la data asociado  por hijo
	*   @param $ircResult array  Data acumulada
	*   @param $isbPadre string Codigo a analizar
	* 	@param	 array $ircConstant Arreglo con la data de 
	*   @author freina <freina@parquesoft.com>
	*   @date 08-Jul-2005 16:20 
	*   @location Cali-Colombia
	*/
	function fncseleccion($isbPadre, & $ircData, $ircSon, & $ircResult, $ircConstant) {
		settype($rcTmp, "array");
		settype($rcTmpF, "array");
		settype($rcTemp, "array");
		settype($rcNewFather, "array");
		settype($rcSon, "array");
		settype($sbFlag, "string");
		settype($sbSon, "string");
		settype($nuCant, "integer");
		settype($nuCont, "integer");
		settype($nuContF, "integer");
		settype($nuContRow, "integer");
		$nuCant = sizeof($ircData);
		foreach ($ircData as $nuCont => $rcTemp) {
			if ($rcTemp["recoactpads"] == $isbPadre) {
				$rcTmp[$nuContRow][0] = $rcTemp["actacodigos"];
				$rcTmp[$nuContRow][1] = $rcTemp["recocodigos"];
				$nuContRow ++;
			}
		}
		//se realiza el analisis de si se debe desactivar el acta
		foreach ($rcTmp as $nuCont => $rcSon) {
			$sbFlag = false;
			if ($rcSon) {
				//cuantos padres tengo
				$nuCant = sizeof($ircSon[$rcSon[0]]);
				if ($nuCant == 1) {
					if ($ircResult) {
						if (!in_array($rcSon[0], $ircResult)) {
							$ircResult[] = $rcSon[0];
						}
					} else {
						$ircResult[] = $rcSon[0];
					}
					if ($rcNewFather) {
						if (!in_array($rcSon[0], $rcNewFather)) {
							$rcNewFather[] = $rcSon[0];
						}
					} else {
						$rcNewFather[] = $rcSon[0];
					}
					unset ($ircData[$rcSon[1]]);
				} else {
					//analizo los padres
					foreach ($ircSon[$rcSon[0]] as $nuContF => $rcTmpF) {
						if ($rcTmpF["recoobligats"] == $ircConstant["req"]) {
							if ($ircResult) {
								if (!in_array($rcSon[0], $ircResult)) {
									$ircResult[] = $rcSon[0];
								}
							} else {
								$ircResult[] = $rcSon[0];
							}
							if ($rcNewFather) {
								if (!in_array($rcSon[0], $rcNewFather)) {
									$rcNewFather[] = $rcSon[0];
								}
							} else {
								$rcNewFather[] = $rcSon[0];
							}
							unset ($ircData[$rcTmpF["recocodigos"]]);
							$sbFlag = true;
						}
					}
					if (!$sbFlag) {
						foreach ($ircSon[$rcSon[0]] as $nuContF => $rcTmpF) {
							if ($rcTmpF["recoobligats"] == $ircConstant["opc"] && $rcTmpF["recoinstancs"] && $rcTmpF["recoactpads"] == $isbPadre) {
								if ($ircResult) {
									if (!in_array($rcSon[0], $ircResult)) {
										$ircResult[] = $rcSon[0];
									}
								} else {
									$ircResult[] = $rcSon[0];
								}
								if ($rcNewFather) {
									if (!in_array($rcSon[0], $rcNewFather)) {
										$rcNewFather[] = $rcSon[0];
									}
								} else {
									$rcNewFather[] = $rcSon[0];
								}
								unset ($ircData[$rcTmpF["recocodigos"]]);
								break;
							}
						}
					}
				}
			}
		}
		if ($rcNewFather) {
			foreach ($rcNewFather as $nuCont => $sbSon) {
				$this->fncseleccion($sbSon, $ircData, $ircSon, $ircResult, $ircConstant);
			}
		}
		return;
	}
}
?>