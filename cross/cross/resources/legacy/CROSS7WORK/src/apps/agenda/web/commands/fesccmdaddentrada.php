<?php
require_once "Web/WebRequest.class.php";
Class FeScCmdAddEntrada
{
	function execute(){

		settype($objDate,"object");
		settype($objService,"object");
		settype($rcTmp,"array");
		settype($sbUsername,"string");
		settype($sbValue,"string");

		extract($_REQUEST);
		
		if(($entrada__entrfechorun != NULL) && ($entrada__entrfechorun != "")
		&& ($entrada__entrduracion != NULL) && ($entrada__entrduracion != "")
		&& ($entrada__catecodigon != NULL) && ($entrada__catecodigon != "")
		&& ($entrada__entrdescris != NULL) && ($entrada__entrdescris != "")){
				
			//Revisamos el formato de los campos alfanuméricos
			$objServ = Application::loadServices("Data_type");
			$entrada__entrprioridas = $objServ->formatString($entrada__entrprioridas);

			//Usuario al que se le está registrando la cita.
			$rcUser = Application::getUserParam();
			$sbUsername = $rcUser["username"];
			
			//se obtienen las dependencias de sesion
			if(WebSession :: issetProperty("_rcOrgSchedule")){
				$orgacodigos = WebSession :: getProperty("_rcOrgSchedule");
				$orgacodigos = array_keys($orgacodigos);
			}else{
				$orgacodigos = null;
			}
			
			if(isset($perscodigos) && $perscodigos){
				$objService = Application :: loadServices("Human_resources");
				$rcTmp[] = $perscodigos;
				$rcPersonal = $objService->getPersonalbyUsername($rcTmp,false);
				$perscodigos = $rcPersonal[0]["perscodigos"];
				$sbUsername =  $rcPersonal[0]["persusrnams"];
				$orgacodigosOwner = $objService->getOrgacodigosByPersonal($perscodigos);
				$objService->close();
			}else{
				if(!isset($orgacodigos) || !$orgacodigos){
					WebRequest::setProperty('cod_message',$message = 54);
					return "fail";
				}
			}
				

			//Las fechas horas de inicio y fin vienen con formato de fecha, el cual debe cambiarse a timestamp
			$objDate = Application::loadServices("DateController");
			$sbEntrfechorun = $entrada__entrfechorun;
			$sbEntrdurationn = $entrada__entrduracion;
			$entrada__entrfechorun = $objDate->fncdatehourtoint($sbEntrfechorun);
			$entrada__entrduracion = $objDate->fncdatehourtoint($sbEntrdurationn);

			if($entrada__entrfechorun<$objDate->fncintdatehour())
			{
				WebRequest::setProperty('cod_message',$message = 22);
				return "fail";
			}
			if($entrada__entrfechorun>=$entrada__entrduracion)
			{
				WebRequest::setProperty('cod_message',$message = 21);
				return "fail";
			}
			if($entrada__entrduracion<$objDate->fncintdatehour())
			{
				WebRequest::setProperty('cod_message',$message = 23);
				return "fail";
			}
			//Validemos la fecha de fin de la repeticion
			if($fechafinfreq != NULL && $fechafinfreq != "")
			{
				if($frequency=="" || $frequency==NULL)
				{
					WebRequest::setProperty('cod_message',$message = 25);
					return "fail";
				}
				$fechafinfreq = $objDate->fncdatehourtoint($fechafinfreq);
				if($fechafinfreq<$objDate->fncintdatehour())
				{
					WebRequest::setProperty('cod_message',$message = 20);
					return "fail";
				}
			}
			else if($frequency!="" || $frequency!=NULL)
			{
				WebRequest::setProperty('cod_message',$message = 24);
				return "fail";
			}
			$entrada_manager = Application::getDomainController('EntradaManager');
			
			//EJECUTAR REPETICIÓN
			$rcRepet = $this->getDataClon($entrada__entrfechorun,$entrada__entrduracion,$frequency,$fechafinfreq,$objDate);
			$nuEvents = sizeof($rcRepet);
			
			if(!is_array($rcRepet) || !$rcRepet){
				$rcRepet[0] = array($entrada__entrfechorun,$entrada__entrduracion);	
			}
			
			//VALIDACIÓN DE COLISIONES (1.otras sesiones programadas.  2.horario de mediación  3.días inhábiles del mediador
			$blColision = $this->validarColisiones($rcRepet,$orgacodigosOwner,$orgacodigos,$entrada_manager);
			
			if($blColision){
				$message = $blColision;
				WebRequest::setProperty('cod_message',$message);
				return "fail";
			}

			//Obtenemos los consecutivos para las tablas, pues pueden ser varios
			$objNumerador = Application::getDomainController("NumeradorManager");
			$entrada__entrcodigon = $objNumerador->fncgetByIdNumerador("entrada",$nuEvents);
			if($ordenumeros||$actacodigos)
			$entrada__recrcodigon = $objNumerador->fncgetByIdNumerador("refercross",$nuEvents);

			//Cargamos los controllers pues dentro del ciclo puede ser costoso
			$referCrossManager = Application::getDomainController("RefercrossManager");
			for ($nuCont=0;$nuCont<$nuEvents;$nuCont++)
			{
				//Guardamos el evento en la tabla entrada
				$message = $entrada_manager->addEntrada(($entrada__entrcodigon+$nuCont),$sbUsername,$rcRepet[$nuCont][0],$rcRepet[$nuCont][1],$entrada__entrprioridas,$entrada__catecodigon,$entrada__entrdescris);
				if($message==3)
				{
					//Guardarmos en refercross aquellos valores que se asocian con expediente, órdenes y acta
					if($ordenumexps||$ordenumeros||$actacodigos)
					$message = $referCrossManager->addRefercross(($entrada__entrcodigon+$nuCont),($entrada__recrcodigon+$nuCont),$ordenumexps,$ordenumeros,$actacodigos);

					//DEPENDENCIA
					if(is_array($orgacodigos) && $orgacodigos){
						foreach($orgacodigos as $sbValue){
							$entrada_manager->addOrganentrada(($entrada__entrcodigon+$nuCont),$sbValue);	
						}	
					}

					//OWNER
					if(isset($perscodigos) && $perscodigos){
						$entrada_manager->addOrganentrada(($entrada__entrcodigon+$nuCont),$orgacodigosOwner,$perscodigos);	
					}
					
					if($preecodigon)
					{
						$gateway = Application::getDataGateway("sqlExtended");
						$codigoEntrada = ($entrada__entrcodigon+$nuCont);
						$gateway->updatePreentrada($preecodigon,$codigoEntrada);
							
						//REGLA PARA NOTIFICAR AL CIUDADANO DE LA PROGRAMACIÓN DE SU CITA
						$entrada_manager->NotificarCiudadano($codigoEntrada,$preecodigon);
					}
				}
			}
			WebRequest::setProperty('cod_message', $message);
			return "success";
		}
		else
		{
			WebRequest::setProperty('cod_message',$message = 0);
			return "fail";
		}
	}

	//RESULT:  $rcDataClon[] = array(begin_datehour,end_datehour)
	function getDataClon($nuBeginHourDate,$nuEndHourDate,$sbFreq,$nuEndClonDateHour,$objDate)
	{
		settype($rcValFreq,"array");
		settype($rcReturn,"array");
		settype($blCut,"boolean");
			
		$rcReturn[0] = array($nuBeginHourDate,$nuEndHourDate);
			
		$rcValFreq = Application::getConstant("FREQUENCY_ALIAS");
		$nuDuration = $nuEndHourDate-$nuBeginHourDate;
			
		//Cada frequencia supone un factor diferente
		$nuFactor = $this->fnuFactor($sbFreq,$rcValFreq,$nuBeginHourDate,$objDate);
			
		$nuPeriod = $nuBeginHourDate;
		$blCut = false;
		if(strlen($sbFreq))
		{
			while (!$blCut)
			{
				if($nuFactor)
				$nuPeriod = $nuPeriod+($nuFactor*$objDate->nuSecsDay);
				else
				$nuPeriod = $this->fnuNextPeriod($nuPeriod,$objDate,$sbFreq,$rcValFreq);

				if(($nuPeriod+$nuDuration) >= $nuEndClonDateHour)
				$blCut = true;
				else
				$rcReturn[] = array($nuPeriod,($nuPeriod+$nuDuration));
			}
		}
		return $rcReturn;
	}

	function fnuFactor($sbFreq,$rcValFreq,$nuBeginHourDate,$objDate)
	{
		$sbDateHour = $objDate->fncformatofechahora($nuBeginHourDate);
		$rcDate = explode($objDate->dateSeparator,$sbDateHour);
		switch ($sbFreq)
		{
			case $rcValFreq["DF"]:
				return 1;
			case $rcValFreq["WF"]:
				return 7;
			default:
				return 0;
		}
	}

	function fnuNextPeriod($nuBeginHourDate,$objDate,$sbFreq,$rcValFreq)
	{
		$sbDate = $objDate->fncformatofechahora($nuBeginHourDate);
		$rcDate = explode($objDate->dateSeparator,$sbDate);
		switch ($sbFreq)
		{
			case $rcValFreq["MF"]:
				$rcDate[1]++;
				break;
			case $rcValFreq["YF"]:
				$rcDate[0]++;
				break;
		}
		$sbDate = join($objDate->dateSeparator,$rcDate);
		return $objDate->fncdatehourtoint($sbDate);
	}

	function validarColisiones($rcDate,$juez,$defensores,$entrada_manager){
		
		settype($rcActores,"array");
		settype($rcRow,"array");
		settype($sbValue,"string");
		settype($nuCont,"integer");
		
		if(is_array($rcDate) && $rcDate){
			
			$rcActores = array_merge($juez,$defensores);
			
			if(is_array($rcActores) && $rcActores){
				
				foreach($rcDate as $rcRow){
					foreach ($rcActores as $nuCont=>$sbValue){
						$blColision = $entrada_manager->getSesionColision($sbValue,$rcRow[0],$rcRow[1]);
						if($blColision){
							return $blColision;	
						}
					}	
				}	
			}
		}
		return false;
	}
}
?>