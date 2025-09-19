<?php    
require_once "Data/Serializer.class.php";
class FeGeDiasInhabilesManager {

	function FeGeDiasInhabilesManager() {
		return true;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Escribe en un archivo serializado la configuraciï¿½n de dias inhabiles
	* @param array $rcFechas lista de dias en entero timestamp
	* @return integer signal
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 03-nov-2004 10:32:18
	* @location Cali-Colombia
	*/
	function setDiasInhabiles($rcFechas) 
	{
		$file_name = Application :: getBaseDirectory().'/config/DiasInhabiles.data';
		$result = & Serializer :: save($rcFechas, $file_name);
		
		if (PEAR :: isError($result))
		{
			return 100;
		}
		return 3;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Obtiene la lista de dias inhabiles
	* @return array
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 03-nov-2004 10:39:19
	* @location Cali-Colombia
	*/
	function getDiasInhabiles() {
		$file_name = Application :: getBaseDirectory().'/config/DiasInhabiles.data';
		if (file_exists($file_name)){
            $rcUser = Application :: getUserParam();
            $this->sbSchema = $rcUser["schema"];
            $rcDiasInha = Serializer :: load($file_name);
            return $rcDiasInha[$this->sbSchema];
		}else
			return null;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Evelua y modifica una fecha con respecto al horario y a los dias inhabiles
	* @param integer $date fecha en entero timestamp
	* @return integer fecha en entero timestamp
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 04-nov-2004 16:11:01
	* @location Cali-Colombia
	*/
	function getDateStart($date) {
		if (!$date)
			return null;
		$date = (int) $date;
		//Carga el servicio de manejo de fachas
		$dateController = Application :: loadServices("DateController");
		
		//Carga el domain de los parametros
		$params = Application :: getDomainController("ParamsManager");
		
		//obtiene los dias inhabiles
		$rcDiasInhabiles = $this->getDiasInhabiles();
		
		//Obtiene los horarios en cantidad y solo toma la hora final
		$rcTmpHora = $params->getParam("general", "horario_atencion");
		if (is_array($rcTmpHora)&& $rcTmpHora 
		&& $rcTmpHora["hora_fin"]!="" && $rcTmpHora["hora_fin"]!=null
		&& $rcTmpHora["hora_ini"]!="" && $rcTmpHora["hora_ini"]!=null){
			//Convierte la hora final a segundos
			$horaFin = $dateController->hour2secs($rcTmpHora["hora_fin"]);
			$horaIni = $dateController->hour2secs($rcTmpHora["hora_ini"]);
		}
		//extrae la hora de la fecha
		$hora = $dateController->getHour2DateInSecs($date);
        $date = $date - $hora;
        
		//Verifica la validez del horario
		if ($horaFin) {
			//Si la hora es mayor a la de fin de horario se aumenta un dia
			if ($hora > $horaFin) {
				$date = $date + 86400;
                $hora = $horaIni;
			}
			else if($hora<$horaIni)
			{
				$hora = $horaIni;
			}
		}
        
		if (is_array($rcDiasInhabiles)) {
			foreach ($rcDiasInhabiles as $key => $value) {
				$rcDiasI[$key] = (int) $value;
			}
            if(is_array($rcDiasI)){
                sort($rcDiasI);
                foreach ($rcDiasI as $diaInhabil) {
                    $diaInhabilIni = (int) $diaInhabil;
                    $diaInhabilFin = $diaInhabilIni + 86399;
                    if ($date >= $diaInhabilIni && $date <= $diaInhabilFin){
                        $date += 86400;
                        $hora = $horaIni;
                    }
                }
            }
		}
        $date += $hora;
		return $date;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Suma, evelua y adelanta una fecha con respecto a los dias inahbiles 
	* @param integer $date fecha en entero timestamp
	* @param integer $time cantidad de tiempo a sumar en segundos
	* @return datatype Name desc
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 04-nov-2004 16:12:44
	* @location Cali-Colombia
	*/
	function getDateEnd($date, $time) {
		if (!$date)
			return null;

        if(!is_numeric($time))
            $time = 0;

		$contador = 0;
		$duracion = floor($time / 86400);
		$horas = (int) floor(fmod($time, 86400));

		$rcDiasInhabiles = $this->getDiasInhabiles();
		//verifica los dias inhabiles
		while ($contador <= $duracion) {
			$result = $this->dateIsInhabil($rcDiasInhabiles, $date);
			if ($result == true)
				$date += 86400;
			else {
				if ($contador != $duracion)
					$date += 86400;
				$contador ++;
			}
		}

		//Suma las horas del tiempo de duraciï¿½n del proceso a la fecha de finalizacion
		$date += $horas;
		//Valida si la nueva hora esta por encima de la del horario de trabajo
		$dateController = Application :: loadServices("DateController");
		$horaFinaliza = $dateController->getHour2DateInSecs($date);
		$params = Application :: getDomainController("ParamsManager");
		$rcTmpHora = $params->getParam("general", "horario_atencion");

		if (is_array($rcTmpHora) && $rcTmpHora 
		&& $rcTmpHora["hora_fin"]!="" && $rcTmpHora["hora_fin"]!=null
		&& $rcTmpHora["hora_ini"]!="" && $rcTmpHora["hora_ini"]!=null) {
			//Convierte la hora final a segundos
			$horaFin = $dateController->hour2secs($rcTmpHora["hora_fin"]);
			$horaIni = $dateController->hour2secs($rcTmpHora["hora_ini"]);
			//Si esta por encima 
			if ($horaFinaliza > $horaFin) {
                $diferecia = $horaFinaliza - $horaFin;
				//Cambia la fecha para la primera hira del siguiente dia
				$date = ($date - $horaFinaliza) + $horaIni + 86400 + $diferecia;
				// se debe validar nuevamente los dias inhibiles
				$flagStop = false;
				while ($flagStop == false) {
					$result = $this->dateIsInhabil($rcDiasInhabiles, $date);
					if ($result == true)
						$date += 86400;
					else
						$flagStop = true;
				}
			}
		}
		return $date;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Dice si un dï¿½a es inhabil
	* @param array $rcDiasInhabiles vector unidimencional con los dï¿½as inhï¿½biles en timestamp
	* @param integer $date fecha en entero timestamp
	* @return datatype Name desc
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 04-nov-2004 16:12:44
	* @location Cali-Colombia
	*/
	function dateIsInhabil($rcDiasInhabiles, $date) {
		if (!is_array($rcDiasInhabiles))
			return false;
		foreach ($rcDiasInhabiles as $diaInhabilIni) {
			$diaInhabilIni = (int) $diaInhabilIni;
			$diaInhabilFin = $diaInhabilIni +86399;
			if ($date >= $diaInhabilIni && $date <= $diaInhabilFin)
				return true;
		}
		return false;
	}

	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Determina los dï¿½as habiles entre 2 fechas, incluyendo solo la fecha final
	* @param integer $date1 fecha en entero timestamp
	* @param integer $date2 fecha en entero timestamp
	* @param bool $leftOpen indica si se debe incluir la fecha inicial (por defecto es cerrado) 
	* @param bool $rightOpen indica si no e debe incluir la fecha final (por defecto es cerrado)
	* @return array $rcDays cantidad de dias 
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 04-nov-2004 16:12:44
	* @location Cali-Colombia
	*/
	function getDiasHabiles($date1, $date2, $leftOpen=false, $rightOpen=false) {
		settype($rcDias,"array");

		if (!$date1 || !$date2)
			return null;

		//carga los dï¿½as inhabiles
		$rcDiasInhabiles = $this->getDiasInhabiles();
		//extrae las horas de las fechas
		$dateController = Application :: loadServices("DateController");
		$date1 = $date1 - $dateController->getHour2DateInSecs($date1);
		$date2 = $date2 - $dateController->getHour2DateInSecs($date2);
        if($date1 == $date2){
            if(!$leftOpen && !$rightOpen)
                return array($date2);
            return array();
        }
		//Calcula la cantidad de dï¿½as calendario
		$cantSecs = $date2 - $date1;
		$cantDias = (integer) $cantSecs / 86400;

		//Ordena los parametros de mayor a menor
		if ($date1 > $date2) {
            if($leftOpen)
                $date2 += 86400;
            if($rightOpen)
                $date1 -= 86400;
			while ($date1 > $date2) {
				if (!$this->dateIsInhabil($rcDiasInhabiles, $date1))
					$rcDias[] = $date1;
				$date1 -= 86400;
			}
		} else {
            if($leftOpen)
                $date1 += 86400;
            if($rightOpen)
                $date2 -= 86400;
			while ($date1 <= $date2) {
				if (!$this->dateIsInhabil($rcDiasInhabiles, $date1))
					$rcDias[] = $date1;
				$date1 += 86400;
			}
		}
		return $rcDias;
	}
	
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Determina la fecha de inicio y fin de la tarea
	* @param integer $nuDate fecha en generacion del acta
	* @param integer $nuDateReg Fecha de registro del caso
	* @param integer $nuDateVen Fecha  de  vecimiento del caso
	* @param integer $nuPercent Porcentaje de tiempo para la tarea 
	* @param integer $nuTotalTime Tiempo total del proceso
	* @return bool $sbSignal Determina si se debe recalcular el tiempo del proceso o no 
	* @author freina<freina@parquesoft.com>
	* @date 01-Nov-2010 20:47
	* @location Cali-Colombia
	*/
	function getTaskTime($nuDate,$nuDateReg, $nuDateVen,$nuPercent,$nuTotalTime,$sbSignal){ 
		
		settype($objService,"object");
		settype($objDate,"object");
		settype($rcResult,"array");
		settype($rcHour,"array");
		settype($rcDays,"array");
		settype($sbFlagL,"string");
		settype($sbFlagR,"string");
		settype($nuDateEnd,"integer");
		settype($nuHourIni,"integer");
		settype($nuHourFin,"integer");
		settype($nuHourHIni,"integer");
		settype($nuHourHFin,"integer");
		settype($nuSaldoHI,"integer");
		settype($nuSaldoHF,"integer");
		settype($nuDays,"integer");
		settype($nuTime,"float");
		settype($nuTimeU,"float");
		settype($nuHour,"float");
		settype($nuCantHourT,"integer");
		settype($nuPorDays,"float");
		settype($nuPorHours,"float");
		
		$sbFlagL = true;
		$sbFlagR = true;
		$nuPercent = (float) $nuPercent;
		$nuDate = $this->getDateStart($nuDate);
		$objDate = Application :: loadServices("DateController");
		
		if($nuDate && $nuPercent && $nuTotalTime && $nuDateReg && $nuDateVen){
			
			//se obtienen los horarios de atencion
			$objService = Application::loadServices("General");
			$rcHour = $objService->getParam("general",'horario_atencion');
			if($rcHour && is_array($rcHour)){
				if($rcHour["hora_fin"]){
					$nuHourHFin = $objDate->hour2secs($rcHour["hora_fin"]);
				}
				if($rcHour["hora_ini"]){
					$nuHourHIni = $objDate->hour2secs($rcHour["hora_ini"]);
				}
				//cantidad de horas del turno.
				$nuCantHourT = $nuHourHFin - $nuHourHIni;
			}
			
			if(!$nuCantHourT){
				$nuHourHFin = $objDate->nuSecsDay - 1;
				$nuHourHIni = 0;
				$nuCantHourT = $objDate->nuSecsDay;
			}
			
			if($sbSignal){
				
				//se valida que la fecha este en el lapso adecuado
				if(($nuDate >= $nuDateReg) && ($nuDate <= $nuDateVen)){
						
					//tiempo restante
					//se obtienen las horas de las fechas de inicio y de fin.
					$nuHourIni = $objDate->getHour2DateInSecs($nuDateReg);
					$nuHourFin = $objDate->getHour2DateInSecs($nuDate);
					
					//si la hora de la fecha inicial es igual a la hora de inicio del horario de atencion
					if($nuHourFin >= $nuHourIni){
						$nuSaldoHI = $nuHourFin - $nuHourIni;
						$sbFlagR = false;
					}else{
						$nuSaldoHI = $nuHourHFin - $nuHourIni;
						$nuSaldoHF = $nuHourFin - $nuHourHIni;
					}
					
					$rcDays = $this->getDiasHabiles($nuDateReg, $nuDate, $sbFlagL, $sbFlagR);
					
					//cuantos dias han pasado
					if($rcDays && is_array($rcDays)){
						$nuDays = sizeof($rcDays);
					}
					
					//se procede a calcular la catidad de segundos transcurridos desde la fecha de reg a hoy
					$nuTimeU = ($nuDays * $objDate->nuSecsDay);
					$nuTimeU = $nuTimeU + $nuSaldoHI + $nuSaldoHF;
					$nuTotalTime = $nuTotalTime - $nuTimeU;
					
					//conociendo el tiempo restante se aplica el porcentaje
					
					//primero se determina cuantos dias hay 
					$nuDays = floor ($nuTotalTime/$objDate->nuSecsDay);
					//y cuantas horas hay.
					$nuHour = (int) floor((fmod($nuTotalTime, $objDate->nuSecsDay)));
					$nuHour = $nuHour / $objDate->nuSecsHour;
					
					//ahora tomo el procentaje de los dias y el de la horas
					$nuPorDays = ($nuDays * $nuPercent)/ 100;
					//si hay dias completos se multiplican por 24 horas , la fraccion por el numero de horas del turno
					$nuTime = (floor($nuPorDays) * $objDate->nuSecsDay) + (($nuPorDays - floor($nuPorDays)) * $nuCantHourT);
					$nuPorHours = (($nuHour * $nuPercent)/ 100);
					$nuTime +=  ($nuPorHours * $objDate->nuSecsHour);
	
					if($nuTime<$objDate->nuSecsDay){
						$nuTime += $nuHourFin;
						if($nuTime > $nuHourHFin){
							$nuTime =  $nuHourHIni + $objDate->nuSecsDay - ($nuTime - $nuHourHFin);
							$nuDate -= $nuHourFin;
						}
					}
					$nuDateEnd = $this->getDateEnd($nuDate, $nuTime);
					if($nuDateVen<$nuDateEnd){
						$nuDateEnd = $nuDateVen;
					}
					$rcResult["begin"] = $nuDate; 
					$rcResult["end"] = $nuDateEnd;
					
				}else{
					$rcResult["begin"] = $nuDate; 
					$rcResult["end"] = $nuDate;
				} 
			}else{
				//se determina el procentaje de tiempo para la tarea y se obtiene la fecha de vencimiento
				
				//primero se determina cuantos dias hay 
				$nuDays = floor ($nuTotalTime/$objDate->nuSecsDay);
				//y cuantas horas hay.
				$nuHour = (int) floor((fmod($nuTotalTime, $objDate->nuSecsDay)));
				$nuHour = $nuHour / $objDate->nuSecsHour;
				
				//ahora tomo el procentaje de los dias y el de la horas
				$nuPorDays = ($nuDays * $nuPercent)/ 100;
				//si hay dias completos se multiplican por 24 horas , la fraccion por el numero de horas del turno
				$nuTime = (floor($nuPorDays) * $objDate->nuSecsDay) + (($nuPorDays - floor($nuPorDays)) * $nuCantHourT);
				$nuPorHours = (($nuHour * $nuPercent)/ 100);
				$nuTime +=  ($nuPorHours * $objDate->nuSecsHour);
				
				if($nuTime<$objDate->nuSecsDay){
					$nuTime += $nuHourFin;
					if($nuTime > $nuHourHFin){
						$nuTime =  $nuHourHIni + $objDate->nuSecsDay - ($nuTime - $nuHourHFin);
						$nuDate -= $nuHourFin;
					}
				}
				$nuDateEnd = $this->getDateEnd($nuDate, $nuTime);
				if($nuDateVen<$nuDateEnd){
					$nuDateEnd = $nuDateVen;
				}
				$rcResult["begin"] = $nuDate; 
				$rcResult["end"] = $nuDateEnd;
			}	
		}else{
			$rcResult["begin"] = $nuDate; 
			$rcResult["end"] = $nuDate;
		}
		
		return $rcResult;
	}
	
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Determina el porcentaje de avance entre dos fechas
	* @param integer $nuDateIni fecha de inicio
	* @param integer $nuDateFin Fecha de fin
	* @return array $rcResult [advance] porcentaje de tiempo de avance 
	* @author freina<freina@parquesoft.com>
	* @date 01-Nov-2010 20:47
	* @location Cali-Colombia
	*/
	function get_Time_Progress($nuDateIni,$nuDateFin){
		
		settype($objDate,"object");
		settype($objService,"object");
		settype($rcDays,"array");
		settype($rcHour,"array");
		settype($rcResult,"array");
		settype($sbFlagL,"string");
		settype($sbFlagR,"string");
		settype($nuHourHIni,"integer");
		settype($nuHourHFin,"integer");
		settype($nuCantHourT,"integer");
		settype($nuHourIni,"integer");
		settype($nuHourFin,"integer");
		settype($nuSaldoHI,"integer");
		settype($nuSaldoHF,"integer");
		settype($nuDays,"integer");
		settype($nuTimeU,"float");
		settype($nuDiasTotalTime,"integer");
		settype($nuTotalTimeR,"integer");
		settype($nuTotalTime,"integer");
		settype($nuHoy,"integer");
		settype($nuHoyT,"integer");
		settype($nuProgress,"integer");
		settype($nuDiff,"integer");
		
		
		if($nuDateIni && $nuDateFin){
			
			$nuDateIni = (int) $nuDateIni;
			$nuDateFin = (int) $nuDateFin;     
			//Carga el servicio de control de fechas 
			$objDate = Application :: loadServices("DateController");
	        $nuHoy = (int) $objDate->fncintdatehour();
	        
	        //$sbLeftOpen = true; //Indica si incluir el dia de incio
	        $sbFlagL = true;
			$sbFlagR = true;
	        
			//se obtienen los horarios de atencion
			$objService = Application::loadServices("General");
			$rcHour = $objService->getParam("general",'horario_atencion');
			if($rcHour && is_array($rcHour)){
				if($rcHour["hora_fin"]){
					$nuHourHFin = $objDate->hour2secs($rcHour["hora_fin"]);
				}
				if($rcHour["hora_ini"]){
					$nuHourHIni = $objDate->hour2secs($rcHour["hora_ini"]);
				}
				//cantidad de horas del turno.
				$nuCantHourT = $nuHourHFin - $nuHourHIni;
			}
			
			if(!$nuCantHourT){
				$nuHourHFin = $objDate->nuSecsDay - 1;
				$nuHourHIni = 0;
			}
			
	        //calculo de la cantidad de tiempo total.
			//se obtienen las horas de las fechas de inicio y de fin.
			$nuHourIni = $objDate->getHour2DateInSecs($nuDateIni);
			$nuHourFin = $objDate->getHour2DateInSecs($nuDateFin);
			
			if($nuHourFin <= $nuHourIni){
				$nuSaldoHI = $nuHourHFin - $nuHourIni;
				$nuSaldoHF = $nuHourFin - $nuHourHIni;
			}else{
				$nuSaldoHI = $nuHourFin - $nuHourIni;
				$sbFlagR = false;
			}
			
			$rcDays = $this->getDiasHabiles($nuDateIni, $nuDateFin, $sbFlagL, $sbFlagR);
			//cuantos dias han pasado
			if($rcDays && is_array($rcDays)){
				$nuDays = sizeof($rcDays);
			}
			
			//se procede a calcular la catidad de segundos transcurridos desde la fecha de reg a hoy
			$nuTimeU = ($nuDays * $objDate->nuSecsDay);
			$nuTotalTime = $nuTimeU + $nuSaldoHI + $nuSaldoHF;
			
			//calculo del tiempo restante
			if($nuDateIni >= $nuHoy){
                $nuHoyT = $nuDateIni;
            }else{
            	$nuHoyT = $nuHoy;
            }
            //se valida que el dia sea habil para contar.
            $nuHoyT = $this->getDateStart($nuHoyT);
            $nuHoyHours = $objDate->getHour2DateInSecs($nuHoyT);
            
            $sbFlagL = true;
			$sbFlagR = true;
			$nuSaldoHI = 0;
			$nuSaldoHF = 0;
			$nuTimeU = 0;
			$nuDays = 0;
			
			//si la hora de la fecha inicial es igual a la hora de inicio del horario de atencion
			//se valida si hoy es el diade ingreso del caso
			if(($nuDateFin - $nuHourFin)>($nuHoyT-$nuHoyHours)){
				if($nuHourFin >= $nuHoyHours){
					$nuSaldoHI = $nuHourFin - $nuHoyHours;
					$sbFlagR = false;
				}else{
					$nuSaldoHI = $nuHourHFin - $nuHoyHours;
					$nuSaldoHF = $nuHourFin - $nuHourHIni;
				}
			}else{
				if(($nuDateFin - $nuHourFin)<($nuHoyT-$nuHoyHours)){
					
					if($nuHourFin >= $nuHoyHours){
						$nuSaldoHI = $nuHourHFin - $nuHourFin;
						$nuSaldoHF = $nuHoyHours - $nuHourHIni;
					}else{
						$nuSaldoHF = $nuHoyHours - $nuHourFin;
						$sbFlagR = false;
						$sbFlagL = false;
					}
				}else{
					//si la fecha de fin y de hoy son iguales
					if($nuHourFin >= $nuHoyHours){
						$nuSaldoHI = $nuHourFin - $nuHoyHours;
					}else{
						$nuSaldoHI = $nuHoyHours - $nuHourFin;
					}
				}
			}
			
			$rcDays = $this->getDiasHabiles($nuHoyT, $nuDateFin, $sbFlagL, $sbFlagR);
			
			//cuantos dias han pasado
			if($rcDays && is_array($rcDays)){
				$nuDays = sizeof($rcDays);
			}
			
			//se procede a calcular la catidad de segundos transcurridos desde la fecha de reg a hoy
			$nuTimeU = ($nuDays * $objDate->nuSecsDay);
			$nuTotalTimeR = $nuTimeU + $nuSaldoHI + $nuSaldoHF;
			
			//consideraciones para el calculo del avance
			if($nuHoyT==$nuDateFin){
				$nuTotalTimeR = 0;
			}else{
				if($nuDateFin<$nuHoyT){
					$nuTotalTimeR *=-1;
				}
			}
			
			if($nuTotalTimeR>0){
				$nuProgress = 100 - (($nuTotalTimeR * 100)/$nuTotalTime);
			}else{
				$nuProgress = 101;
			}
			
			$nuDiff = $nuTotalTimeR - fmod($nuTotalTimeR,$objDate->nuSecsDay);
			$nuDiff = $nuDiff/$objDate->nuSecsDay;
			
			$rcResult["avance"] = number_format(($nuProgress),1,".","");
			$rcResult["restantes"]  = $nuDiff;
		}
		return $rcResult;
	}
}
?>