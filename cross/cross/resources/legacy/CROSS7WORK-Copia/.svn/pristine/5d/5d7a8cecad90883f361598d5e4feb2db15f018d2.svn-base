<?php     
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdAddMovimialmace {
	function execute() {
		extract($_REQUEST);
		if (($movimialmace__bodecodigos_in != NULL) && ($movimialmace__bodecodigos_in != "") && ($movimialmace__bodecodigos_out != NULL) && ($movimialmace__bodecodigos_out != "") && ($movimialmace__recucodigos != NULL) && ($movimialmace__recucodigos != "") && ($movimialmace__comocodigos_in != NULL) && ($movimialmace__comocodigos_in != "") && ($movimialmace__comocodigos_out != NULL) && ($movimialmace__comocodigos_out != "") && ($movimialmace__tidocodigos != NULL) && ($movimialmace__tidocodigos != "") && ($movimialmace__moalnumedocs != NULL) && ($movimialmace__moalnumedocs != "")) {
			//Verifica que las bodegas no sean iguales
			if($movimialmace__bodecodigos_in === $movimialmace__bodecodigos_out){
				WebRequest :: setProperty('cleanSession', $cleanSession = "NO");
				WebRequest :: setProperty('cod_message', $message = 10);
				WebRequest :: setProperty('focusObject', $focusObject = "movimialmace__recucodigos");
				return "fail";
			}
			//Verifica que los conceptos de movimiento no sean iguales
			if($movimialmace__comocodigos_in === $movimialmace__comocodigos_out){
				WebRequest :: setProperty('cod_message', $message = 11);
				WebRequest :: setProperty('cleanSession', $cleanSession = "NO");
				WebRequest :: setProperty('focusObject', $focusObject = "movimialmace__recucodigos");
				return "fail";
			}
			//Verifica si el recurso existe
			$gateWay = Application :: getDataGateway("recurso");
			$rcRecurso = $gateWay->getByIdRecurso($movimialmace__recucodigos);
			if (!is_array($rcRecurso)){
				WebRequest :: setProperty('cod_message', $message = 9);
				WebRequest :: setProperty('cleanSession', $cleanSession = "NO");
				WebRequest :: setProperty('focusObject', $focusObject = "movimialmace__recucodigos");
				return "fail";
			}
			//Verifica si es un movimiento con recursos seriados
			$serial_move = false; 
			//Trae el codigo para el tipo de recurso seriado desde las constantes
			$TipRecSer = Application :: getConstant("COD_REC_SER");
			if ($rcRecurso[0]["tirecodigos"] == $TipRecSer){
					$serial_move = true;
				}			
			if ($serial_move == true) {
				//Se debe digitar como minimo el serial inicial
				if ($movimialmace__serial1 == "") {
					WebRequest :: setProperty('cod_message', $message = 18);
					WebRequest :: setProperty('cleanSession', $cleanSession = "NO");
					WebRequest :: setProperty('focusObject', $focusObject = "movimialmace__recucodigos");
					return "fail";
				}
				//Caso 1: Cuando existen los dos seriales, deben ser numericos e indica que se registrará un rango
				if ($movimialmace__serial2 != "") {
					if (is_numeric($movimialmace__serial1) && is_numeric($movimialmace__serial2)) {
						$movimialmace__serial1 = (integer) $movimialmace__serial1;
						$movimialmace__serial2 = (integer) $movimialmace__serial2;
						// Verifica que el serial inicial sea menor que el serial final
						if ($movimialmace__serial1 > $movimialmace__serial2) {
							WebRequest :: setProperty('cod_message', $message = 6);
							WebRequest :: setProperty('cleanSession', $cleanSession = "NO");
							WebRequest :: setProperty('focusObject', $focusObject = "movimialmace__recucodigos");
							return "fail";
						}
						// Verifica que ninguno de los seriales sea negativo
						if (($movimialmace__serial1 < 0 ) || ($movimialmace__serial2 < 0)) {
							WebRequest :: setProperty('cod_message', $message = 20);
							WebRequest :: setProperty('cleanSession', $cleanSession = "NO");
							WebRequest :: setProperty('focusObject', $focusObject = "movimialmace__recucodigos");
							return "fail";
						}
					} else {
						WebRequest :: setProperty('cod_message', $message = 5);
						WebRequest :: setProperty('cleanSession', $cleanSession = "NO");
						WebRequest :: setProperty('focusObject', $focusObject = "movimialmace__recucodigos");
						return "fail";
					}
				}
			} else {
				//Limpia los valores del los seriales por si estan cargados
				unset($movimialmace__serial1);
				unset($movimialmace__serial2);
				unset($movimialmace__suffix);
				unset($movimialmace__prefix);
				if (($movimialmace__moalcantrecf == NULL) || ($movimialmace__moalcantrecf == "") || ($movimialmace__moalcantrecf == "0")) {
					WebRequest :: setProperty('cod_message', $message = 19);
					WebRequest :: setProperty('cleanSession', $cleanSession = "NO");
					WebRequest :: setProperty('focusObject', $focusObject = "movimialmace__recucodigos");
					return "fail";
				}
			}

			//Adicional a los vectores de sesion la informacion de los listados de sesion

			$genericData = WebSession :: getProperty("genericData");
			$genericData = $this->addData($genericData, $movimialmace__bodecodigos_in, $movimialmace__bodecodigos_out, $movimialmace__recucodigos, $movimialmace__comocodigos_in, $movimialmace__comocodigos_out, $movimialmace__moalcantrecf, $movimialmace__tidocodigos, $movimialmace__moalnumedocs, $movimialmace__serial1, $movimialmace__serial2, $movimialmace__prefix, $movimialmace__suffix);
			if ($genericData == false) {
				WebRequest :: setProperty('cod_message', $message = 7);
				WebRequest :: setProperty('cleanSession', $cleanSession = "NO");
				WebRequest :: setProperty('focusObject', $focusObject = "movimialmace__recucodigos");
				return "fail";
			}
			WebSession :: setProperty("genericData", $genericData);
			unset($_REQUEST["movimialmace__recucodigos"]);
			unset($_REQUEST["movimialmace__recucodigos_desc"]);
			unset($_REQUEST["movimialmace__moalcantrecf"]);
			unset($_REQUEST["movimialmace__serial1"]);
			unset($_REQUEST["movimialmace__serial2"]);
			unset($_REQUEST["movimialmace__suffix"]);
			unset($_REQUEST["movimialmace__prefix"]);
			WebRequest :: setProperty('cod_message', $message = 8);
			WebRequest :: setProperty('cleanSession', $cleanSession = "NO");
			WebRequest :: setProperty('focusObject', $focusObject = "movimialmace__recucodigos");
			return "success";
		} else {
			WebRequest :: setProperty('cod_message', $message = 0);
			WebRequest :: setProperty('cleanSession', $cleanSession = "NO");
			WebRequest :: setProperty('focusObject', $focusObject = "movimialmace__recucodigos");
			return "fail";
		}
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	*  Adiciona un registro al vector de sesion del detalle
	* @param array $rcDatos 
	* @return array
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 04-oct-2004 15:57:04
	* @location Cali-Colombia
	*/
	function addData($rcData, $movimialmace__bodecodigos_in, $movimialmace__bodecodigos_out, $movimialmace__recucodigos, $movimialmace__comocodigos_in, $movimialmace__comocodigos_out, $movimialmace__moalcantrecf, $movimialmace__tidocodigos, $movimialmace__moalnumedocs, $movimialmace__serial1, $movimialmace__serial2, $movimialmace__prefix, $movimialmace__suffix) {
		$existe = false;
		if (is_array($rcData)) {
			//Valida si el recurso existe
			foreach ($rcData as $key => $rcReg) {
				if ($rcReg["recucodigos"] == $movimialmace__recucodigos) {
					$existe = true;
					break;
				}
			}
		}
		//Si el recurso existe
		if ($existe == true) {
			$flag = false;
			if ($movimialmace__serial1) {
				if (!$movimialmace__serial2)
					$movimialmace__serial2 = $movimialmace__serial1;
				//Busca el rango
				foreach ($rcData[$key]["series"] as $serkey => $rcRangos) {
					if ($rcRangos["prefix"] == $movimialmace__prefix && $rcRangos["suffix"] == $movimialmace__suffix) {
						//Verifica el rango con los valores numericos
						if (($movimialmace__serial1 < $rcRangos["serial1"]) && ($movimialmace__serial2 < $rcRangos["serial1"]) || ($movimialmace__serial1 > $rcRangos["serial2"]) && ($movimialmace__serial2 > $rcRangos["serial2"])) {
							if ($movimialmace__serial2 == $movimialmace__serial1) {
								$rcData[$key]["moalcantrecf"] += 1;
								$rcSerial = array ("serials" => $movimialmace__prefix.$movimialmace__serial1.$movimialmace__suffix);
							} else {
								$rcData[$key]["moalcantrecf"] += (($movimialmace__serial2 - $movimialmace__serial1) + 1);
								$rcSerial = array ("serials" => $movimialmace__prefix.$movimialmace__serial1.$movimialmace__suffix." - ".$movimialmace__prefix.$movimialmace__serial2.$movimialmace__suffix);
							}
							$rcSerial["serial1"] = $movimialmace__serial1;
							$rcSerial["serial2"] = $movimialmace__serial2;
							$rcSerial["prefix"] = $movimialmace__prefix;
							$rcSerial["suffix"] = $movimialmace__suffix;
							$rcData[$key]["series"][] = $rcSerial;
							return $rcData;
						} else
							return false;
					}
				}
				if ($movimialmace__serial2 == $movimialmace__serial1) {
					$rcSerial = array ("serials" => $movimialmace__prefix.$movimialmace__serial1.$movimialmace__suffix);
				} else {
					$rcSerial = array ("serials" => $movimialmace__prefix.$movimialmace__serial1.$movimialmace__suffix." - ".$movimialmace__prefix.$movimialmace__serial2.$movimialmace__suffix);
				}
				$rcSerial["serial1"] = $movimialmace__serial1;
				$rcSerial["serial2"] = $movimialmace__serial2;
				$rcSerial["prefix"] = $movimialmace__prefix;
				$rcSerial["suffix"] = $movimialmace__suffix;
				$rcData[$key]["moalcantrecf"] += (($rcSerial["serial2"] - $rcSerial["serial1"]) + 1);
				$rcData[$key]["series"][] = $rcSerial;
				return $rcData;
			} else {
				//Si no es seriado
				$rcData[$key]["moalcantrecf"] += $movimialmace__moalcantrecf;
			}
			return $rcData;
		}
		//Recurso
		$gateWay = Application :: getDataGateway("recurso");
		$nombre = $gateWay->getByIdRecurso($movimialmace__recucodigos);
		$genericData["recucodigos"] = $movimialmace__recucodigos;
		$genericData["recunombres"] = $nombre[0]["recunombres"];
		//Cantidad y seriales
		if ($movimialmace__serial1) {
			if ($movimialmace__serial2) {
				if ($movimialmace__serial2 == $movimialmace__serial1) {
					$genericData["moalcantrecf"] += 1;
					$rcSerial = array ("serials" => $movimialmace__prefix.$movimialmace__serial1.$movimialmace__suffix);
				} else {
					$genericData["moalcantrecf"] += (($movimialmace__serial2 - $movimialmace__serial1) + 1);
					$rcSerial = array ("serials" => $movimialmace__prefix.$movimialmace__serial1.$movimialmace__suffix." - ".$movimialmace__prefix.$movimialmace__serial2.$movimialmace__suffix);
				}
			} else {
				$movimialmace__serial2 = $movimialmace__serial1;
				$genericData["moalcantrecf"] += 1;
				$rcSerial = array ("serials" => $movimialmace__prefix.$movimialmace__serial1.$movimialmace__suffix);
			}
			$rcSerial["serial1"] = $movimialmace__serial1;
			$rcSerial["serial2"] = $movimialmace__serial2;
			$rcSerial["prefix"] = $movimialmace__prefix;
			$rcSerial["suffix"] = $movimialmace__suffix;
			$genericData["series"][] = $rcSerial;
		} else {
			$genericData["moalcantrecf"] = $movimialmace__moalcantrecf;
		}
		$rcData[] = $genericData;
		return $rcData;
	}
}
?>	
