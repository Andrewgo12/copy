<?php  

class FeCrRepoTiemposEjecManager {
	var $gateway;
	function FeCrRepoTiemposEjecManager() {
		$this->gateway = Application :: getDataGateway("SqlExtended");
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Trae el reporte de tiempos de ejecucion de ordenes
	* @param string $oprdenumeros
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 28-oct-2004 11:38:18
	* @location Cali-Colombia
	*/
	function getRepoTiemposEjec($ordenumeros) {
		settype($objService, "object");
		settype($rcTime, "array");
		settype($sbEstate, "string");
		settype($nuHoy, "string");

		//Trae los datos de la orden.
		$rcOrden = $this->gateway->getOrden($ordenumeros);
		if (!is_array($rcOrden))
			return null;
		//Carga el servicio de fechas
		$dateService = Application :: loadServices("DateController");
		//Calcula la fecha de finalizaci�n
		$rcOrden[0]["finalizacion"] = $rcOrden[0]["ordefecvend"];
		//Trae las actas de la orden.
		$rcActas = $this->gateway->getActas($ordenumeros);

		if (is_array($rcActas)) {

			$sbEstate = Application :: getConstant("REG_ACT");
			$size = sizeof($rcActas);
			//Ultima actualizaci�n
			$rcOrden[0]["actualizada"] = $rcActas[$size -1]["actafechingn"];
			//Calcula la duraci�n
			//Si la fecha de finalizaci�n existe
			if ($rcOrden[0]["ordefecfinad"]) {
                if($rcOrden[0]["finalizacion"] >= $rcOrden[0]["ordefecfinad"]){
                    $objService = Application :: loadServices("General");
                    $rcTime = $objService->getDiasHabiles($rcOrden[0]["ordefecregd"], $rcOrden[0]["ordefecfinad"] , true, null, false);
                    $rcOrden[0]["duracion"] = sizeof($rcTime);
                    $rcTime = $objService->getDiasHabiles($rcOrden[0]["finalizacion"], $rcOrden[0]["ordefecfinad"],null,null);
                    $rcOrden[0]["vencimiento"] = sizeof($rcTime);
                } else { //Si ya esta vencida
                    $objService = Application :: loadServices("General");
                    $rcTime = $objService->getDiasHabiles($rcOrden[0]["ordefecregd"], $rcOrden[0]["ordefecfinad"] , true, null, false);
                    $rcOrden[0]["duracion"] = sizeof($rcTime) * -1;
                    $rcTime = $objService->getDiasHabiles($rcOrden[0]["finalizacion"], $rcOrden[0]["ordefecfinad"],true,null);
                    $rcOrden[0]["vencimiento"] = sizeof($rcTime) * -1;
                }
			} else {
                $regHours = $dateService->getHour2DateInSecs($rcOrden[0]["ordefecregd"]);
                $dateHourRegIni = $rcOrden[0]["ordefecregd"] - $regHours; //00:00 fecha de registro
                $dateHourRegFin = $dateHourRegIni + 86399; //23:59 fecha de registro
				$hoy = $dateService->fncintdatehour();
                $leftOpen = true; //Indica si incluir el dia de incio
                $flag = true;
                if($hoy >= $dateHourRegIni && $hoy <= $dateHourRegFin){
                    $nuHoy = $dateHourRegIni + 86400;
                    $nuHoyRef = $dateHourRegIni;
                    //$leftOpen = false;
                    $flag = true;
                }else if($dateHourRegIni > $hoy){
                    $nuHoyRef = $nuHoy =$dateHourRegIni;
                    $flag = false;
                }else{
                    $nuHoyRef = $nuHoy = $hoy;
                    $flag = false;
                }

				$objService = Application :: loadServices("General");
				$rcTime = $objService->getDiasHabiles($rcOrden[0]["ordefecregd"], $nuHoyRef, $leftOpen, null,false);
                $rcOrden[0]["duracion"] = sizeof($rcTime);

                if($rcOrden[0]["finalizacion"] < $hoy)
                    $leftOpen = false;
                if($flag)
                    $leftOpen = true;

				$rcTime = $objService->getDiasHabiles($nuHoy,$rcOrden[0]["finalizacion"], $leftOpen, null);
				$rcOrden[0]["vencimiento"] = sizeof($rcTime);
				//Si esta vencida
				if($hoy > $rcOrden[0]["finalizacion"]){
            		$rcOrden[0]["vencimiento"] *= -1;
            	}
			}
			$leftOpen = true;
			//Trae las atenciones por cada acta
			foreach ($rcActas as $key => $rcTmp) {
				//se elimina para evitar impactar el reporte.
				unset($rcTmp["actaestacts"]);
				$rcAtenciones = $this->gateway->getAtenciones($rcTmp["actacodigos"]);
				if (is_array($rcAtenciones)) {
					//Si el acta esta activa se calcula contra el dia de hoy
					if ($rcTmp["actaactivas"] == $sbEstate) {
						//Duracion (fecha del dia - fecha de registro del acta)
						$hoy = $dateService->fncintdatehour();
                        $objService = Application :: loadServices("General");
                        $rcTime = $objService->getDiasHabiles($rcTmp["actafechingn"], $hoy, $leftOpen, null);
//						$rcTmp["duracion"] = $hoy - $rcTmp["actafechingn"];
						$rcTmp["duracion"] = sizeof($rcTime);
					} else { //Si esta finalizada la calcula contra la ultima atenci�n 
						$last = sizeof($rcAtenciones) - 1;
                        $objService = Application :: loadServices("General");
                        $rcTime = $objService->getDiasHabiles($rcTmp["actafechingn"], $rcAtenciones[$last]["acemfecaten"], $leftOpen, null);
						$rcTmp["duracion"] = sizeof($rcTime);
						//Duracion ((fecha de ultima atencion + hora de finalizacion de ultima atencion) - fecha de registro del acta)
//						$rcTmp["duracion"] = ($rcAtenciones[$last]["acemfecaten"] + $rcAtenciones[$last]["acemhorafin"]) - $rcTmp["actafechingn"];
						if ($rcTmp["duracion"] < 0)
							$rcTmp["duracion"] = 0;
					}
					//Recorre las atenciones para calcular la duracion de cada una
					foreach ($rcAtenciones as $k => $rcTmpAtenc) {
						$rcTmpAtenc["duracion"] = $rcTmpAtenc["acemhorafin"] - $rcTmpAtenc["acemhorainn"];
						$rcAtencFormat[$k] = $rcTmpAtenc;
					}
					//Adiciona las atenciones al vector del acta
					$rcTmp["atenciones"] = $rcAtencFormat;
					$rcActaFormat[$key] = $rcTmp;
				} else { //No tiene atenciones
					//Duracion (fecha del dia - fecha de registro del acta)
					$hoy = $dateService->fncintdatehour();
                    $objService = Application :: loadServices("General");
                    $rcTime = $objService->getDiasHabiles($rcTmp["actafechingn"],$hoy, $leftOpen, null);
					$rcTmp["duracion"] = sizeof($rcTime);
					//$rcTmp["duracion"] = $hoy - $rcTmp["actafechingn"];
					//Adiciona las atenciones al vector del acta
					$rcTmp["atenciones"] = null;
					$rcActaFormat[$key] = $rcTmp;
				}
				unset ($rcAtencFormat);
				unset ($rcTmp);
			}
			//Adiciona al vector de la orden las actas
			$rcOrden[0]["actas"] = $rcActaFormat;
		}
		return $rcOrden;
	}
	function UnsetRequest() {
		unset ($_REQUEST["repotiemposeject__ordenumeros"]);
	}
}
?>