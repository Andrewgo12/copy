<?php

class FeCrReportesManager {

    function FeCrReportesManager() {
    	$this->gateway = Application::getDataGateway("reportes");
    	
    	//Trae los datos del usuario
		$this->user = Application :: getUserParam();
    	$this->gateway->setUserName($this->user["username"]);
    	
    	//Set reports description
    	$this->reportDesc = array(
    		"getCasesByFrecuency" => array("input_methods" => array('setYear($year)','setMonth($month)','setTypeFrecuency($typeFrecuency)'),
    								 		"output_methods" => array('getReport($year)'),
    								 		),
    	);
    }
    
    /**
    * Copyright 2006 FullEngine
    * 
    * Fecha inicial
    * @author freina <freina@parquesoft.com>
    * @param string $sbStartDate Cadena con la fecha de inicio
    * @date 27-Jul-2006
    * @location Cali-Colombia
    */
    function setStartDate($sbStartDate){
    	settype($objService,"object");
    	$objService = Application :: loadServices("DateController");
    	if($sbStartDate){
    		$this->__startDate = $objService->fncdatetoint($sbStartDate);
    	}
    }
    /**
    * Copyright 2006 FullEngine
    * 
    * Fecha final
    * @author freina <freina@parquesoft.com>
    * @param string $sbEndDate Cadena con la fecha de fin
    * @date 27-Jul-2006
    * @location Cali-Colombia
    */
    function setEndDate($sbEndDate){
    	settype($objService,"object");
    	$objService = Application :: loadServices("DateController");
    	if($sbEndDate){
    		$this->__endDate = $objService->fncdatetoint($sbEndDate)+86399;
    	}
    }
    
    /**
    * Copyright 2006 FullEngine
    * Obtiene los indices del arreglo en donde inicia y finaliza un mes.
    * @author freina <freina@parquesoft.com>
    * @date 27-Jul-2006
    * @location Cali-Colombia
    */
    function getMonthMarks(){
    	return $this->monthMarks;
    }

   /**
    * Copyright 2006 FullEngine
    * 
    * Anio
    * @author creyes <careyes@parquesoft.com>
    * @param integer $year anio en cuatro digito Ej: 2006
    * @date 11-July-2006
    * @location Cali-Colombia
    */
    function setYear($year){
    	$this->year = $year;
    }
   /**
    * Copyright 2006 FullEngine
    * 
    * Mes inicial
    * @author creyes <careyes@parquesoft.com>
    * @param integer $month  {mes:1,2,3,4,5,6,7,8,9,10,11,12}
    * @date 11-July-2006
    * @location Cali-Colombia
    */
    function setStartMonth($month){
    	$this->startMonth = $month;
    }
   /**
    * Copyright 2006 FullEngine
    * 
    * Mes final
    * @author creyes <careyes@parquesoft.com>
    * @param integer $month  {mes:1,2,3,4,5,6,7,8,9,10,11,12}
    * @date 11-July-2006
    * @location Cali-Colombia
    */
    function setEndMonth($month){
    	$this->endMonth = $month;
    }
    
    function setTypeLocation($typeLocation){
    	$this->typeLocation = $typeLocation;
    }
    function setLocation($location){
    	$this->location = $location;
    }
    function getDateInterval(){
		return array($this->__startDate,$this->__endDate);
	}

   /**
    * Copyright 2006 FullEngine
    * 
    * Tipo de frecuencia (factoria)
    * @author creyes <careyes@parquesoft.com>
    * @param integer $typeFrecuency  {frecuencia:timetable, daily, dayweek, weekly, monthly}
    * @date 11-July-2006
    * @location Cali-Colombia
    */
    function setTypeFrecuency($typeFrecuency){
    	$this->typeFrecuency = $typeFrecuency;
    }

	function getStartDate(){
		return $this->__startDate;
	}
	function getEndDate(){
		return $this->__endDate;
	}
	function getReport(){
		return $this->report;
	}
	
	function getDataReport(){
		return $this->dataReport;
	}
	
	function setCleanReport(){
		$this->report = null;
	}
   /**
    * Copyright 2006 FullEngine
    * 
    * Consulta los casos por frecuencia
    * @author creyes <careyes@parquesoft.com>
    * @param integer $nuDate fecha en estero tiemestamp
    * @date 11-July-2006
    * @location Cali-Colombia
    */
    function getCasesByFrecuency(){
    	
    	settype($objDate, "object");
    	$objDate = Application :: loadServices("DateController");
    	
    	if(!$this->year || !$this->startMonth || !$this->endMonth || !$this->typeFrecuency){
    		return false;
    	}
    	
    	if($this->startMonth > $this->endMonth){
    		return false;
    	}
    	
    	//Determina la fecha inicial y final 
    	$this->__startDate = $objDate->_mktime(0, 0, 0, $this->startMonth, 1, $this->year);
    	$this->nuDaysEndMonth = $objDate->_date('t',$objDate->_mktime(0, 0, 0, $this->endMonth, 1, $this->year));
    	$this->__endDate = $objDate->_mktime(23, 59, 59, $this->endMonth, $this->nuDaysEndMonth, $this->year); 
    	
    	//Ejecuta la factoria
    	$function = "__".$this->typeFrecuency;
    	$result = $this->$function();
		if(!$result){
    		return false;
		}
		return true;
    }

   /**
    * Copyright 2006 FullEngine
    * 
    * Consulta los casos por usuario
    * @author creyes <careyes@parquesoft.com>
    * @param integer $nuDate fecha en estero tiemestamp
    * @date 11-July-2006
    * @location Cali-Colombia
    */
    function getCasesByUser(){
    	if(!$this->__startDate || !$this->__endDate){
    		return false;
    	}
    	
    	if($this->__startDate > $this->__endDate){
    		return false;
    	}  

    	//Ajusta las fechas de inicio y fin 
    	$this->gateway->setStartDate($this->__startDate);
    	$this->gateway->setEndDate($this->__endDate);
   		$this->gateway->getCasesByUser();
   		$rcResult = $this->gateway->getResult();
   		
   		if(!is_array($rcResult))
   			return false;
   		
    	foreach($rcResult as $rcTmp){
    		$cant = (integer) $rcTmp['cantidad'];
    		$this->report[] = array($rcTmp['usuacodigos'],$cant);
    	}
    	return true;    	
    }
        
   /**
    * Copyright 2006 FullEngine
    * 
    * Consulta los casos por causa
    * @author creyes <careyes@parquesoft.com>
    * @param integer $nuDate fecha en estero tiemestamp
    * @date 11-July-2006
    * @location Cali-Colombia
    */
    function getCasesByCause(){
    	if(!$this->__startDate || !$this->__endDate){
    		return false;
    	}
    	
    	if($this->__startDate > $this->__endDate){
    		return false;
    	} 

    	//Ajusta las fechas de inicio y fin 
    	$this->gateway->setStartDate($this->__startDate);
    	$this->gateway->setEndDate($this->__endDate);
   		$this->gateway->getCasesByCause();
   		$rcResult = $this->gateway->getResult();
   		
   		if(!is_array($rcResult))
   			return false;
   		
    	foreach($rcResult as $rcTmp){
    		$this->report[] = array($rcTmp['causnombres'],(integer)$rcTmp['cantidad']);
    	}
    	return true;
    }

   /**
    * Copyright 2006 FullEngine
    * 
    * Consulta los casos por tipo de caso 
    * @author creyes <careyes@parquesoft.com>
    * @param integer $nuDate fecha en estero tiemestamp
    * @date 11-July-2006
    * @location Cali-Colombia
    */
    function getCasesByType(){
    	if(!$this->__startDate || !$this->__endDate){
    		return false;
    	}
    	
    	if($this->__startDate > $this->__endDate){
    		return false;
    	}  

    	//Ajusta las fechas de inicio y fin 
    	$this->gateway->setStartDate($this->__startDate);
    	$this->gateway->setEndDate($this->__endDate);
   		$this->gateway->getCasesByType();
   		$rcResult = $this->gateway->getResult();

   		if(!is_array($rcResult))
   			return false;

    	foreach($rcResult as $rcTmp){
    		$this->report[] = array($rcTmp['tiornombres'],(integer)$rcTmp['cantidad']);
    	}
    	return true;
    }


   /**
    * Copyright 2006 FullEngine
    * 
    * Consulta los casos por tipo de localizacion 
    * @author creyes <careyes@parquesoft.com>
    * @param integer $nuDate fecha en estero tiemestamp
    * @date 11-July-2006
    * @location Cali-Colombia
    */
    function getCasesByTypeLocation(){
    	
    	if(!$this->__startDate || !$this->__endDate || !$this->typeLocation || !$this->location){
    		return false;
    	}
    	
    	if($this->__startDate > $this->__endDate){
    		return false;
    	} 

    	//Ajusta las fechas de inicio y fin 
    	$this->gateway->setStartDate($this->__startDate);
    	$this->gateway->setEndDate($this->__endDate);
		$this->gateway->setTypeLocation($this->typeLocation);
		$this->gateway->setLocation($this->location);
		
		//Consulta las localizaciones
		$this->gateway->getLocationByTypeAndFather();
		$rcLocations = $this->gateway->getResult();
		
		if(!is_array($rcLocations))
			return false;
		
		//carga el sevicio del modulo general
		$generalService = Application::loadServices('General');
		foreach($rcLocations as $rcLocalizacion){
			$rcTmp[] = $rcLocalizacion['locacodigos'];
			$rcLabels[$rcLocalizacion['locacodigos']] = $rcLocalizacion['locanombres'];
			
			//Consulta los hijos de cada localizacion
			$rcLocalSons = $generalService->getLocaltionSons($rcLocalizacion['locacodigos'], false);
			if(is_array($rcLocalSons)){
				foreach($rcLocalSons as $son){
					$rcTmp[] = $son;
				}
			}
			$rcConsult[$rcLocalizacion['locacodigos']] = $rcTmp;
			$rcLocalSons = null;
			$rcTmp = null;
		}
		$generalService->close();
		
		//Consulta los valores de cada localizacion
		foreach($rcConsult as $locacodigos => $rcTmp){
			$this->gateway->setLocations($rcTmp);
			$this->gateway->getCasesByLocations();
   			$rcResult = $this->gateway->getResult();
			$this->report[] = array($rcLabels[$locacodigos],(integer) $rcResult[0]['cantidad']);
			
		}	
    	return true;
    }
    
   /**
    * Copyright 2006 FullEngine
    * 
    * Consulta los casos por edad ninos{EDAD: 0|18}, adulto{EDAD > 18}, ND{EDAD:NULL} 
    * @author creyes <careyes@parquesoft.com>
    * @param integer $nuDate fecha en estero tiemestamp
    * @date 11-July-2006
    * @location Cali-Colombia
    */
    function getCasesByAgeold(){
    	if(!$this->__startDate || !$this->__endDate){
    		return false;
    	}
    	
    	if($this->__startDate > $this->__endDate){
    		return false;
    	} 

    	//Ajusta las fechas de inicio y fin 
    	$this->gateway->setStartDate($this->__startDate);
    	$this->gateway->setEndDate($this->__endDate);
		
		//Consulta los casos sin contacto
		$nd = 0;
    	$this->gateway->getCasesWithoutContactByRange();
    	$rcTmp = $this->gateway->getResult();
    	if(is_array($rcTmp))
   			$nd = (integer) $rcTmp[0]['cantidad'];
    	unset($rcTmp);
    	
    	//Busca los que tienen contacto pero el contacto no tiene edad
    	$this->gateway->getCasesWithContactWithoutAgeoldByRange();
    	$rcTmp = $this->gateway->getResult();
    	if(is_array($rcTmp))
	    	$nd += (integer) $rcTmp[0]['cantidad'];
    	unset($rcTmp);

		//Elabora la tabla de clases
		$statistic = Application::loadServices('Statistic');
		$this->gateway->getAgeoldContact();
		$rcAgesold = $this->gateway->getResult();
		if(is_array($rcAgesold)){
			$nuRegs = sizeof($rcAgesold);
			$statistic->setAmountData($nuRegs);
			if($nuRegs<100)
				$statistic->setAmountData(100);
			$statistic->setLimitInferior($rcAgesold[0]['contedadn']);
			$statistic->setLimitSuperior($rcAgesold[$nuRegs - 1]['contedadn']);
			$statistic->setMethod(2);
			$statistic->makeClasses();
			$rcClasses = $statistic->getClasses(); 
		}
		//Consulta los casos Para las clases
		if(is_array($rcClasses)){
			foreach($rcClasses as $rcClase){
				$this->gateway->setStartAgeold($rcClase[0]);
				$this->gateway->setEndAgeold($rcClase[1]);
				$this->gateway->getCasesWithContactBetweenAgeoldByRange();
				$rcTmp = $this->gateway->getResult();
				if(is_array($rcTmp))
					$this->report[] = array("{$rcClase[0]} - {$rcClase[1]}",(integer)$rcTmp[0]['cantidad']);
				
			}
		}
		include ($this->user["lang"]."/".$this->user["lang"].".generic.php");
		$this->report[] = array($rcAge['ND'],$nd);
		return true;    	
    }

   /**
    * Copyright 2006 FullEngine
    * 
    * Consulta los casos por genero M, F, ND
    * @author creyes <careyes@parquesoft.com>
    * @param integer $nuDate fecha en estero tiemestamp
    * @date 11-July-2006
    * @location Cali-Colombia
    */
    function getCasesByGenere(){
    	if(!$this->__startDate || !$this->__endDate){
    		return false;
    	}
    	
    	if($this->__startDate > $this->__endDate){
    		return false;
    	}  
    	
    	//Ajusta las fechas de inicio y fin 
    	$this->gateway->setStartDate($this->__startDate);
    	$this->gateway->setEndDate($this->__endDate);
    	
    	//Busca los no definidos
    	$nd = 0;
    	$this->gateway->getCasesWithoutContactByRange();
    	$rcTmp = $this->gateway->getResult();
    	if(is_array($rcTmp))
    		$nd = (integer) $rcTmp[0]['cantidad'];
    	unset($rcTmp);
    	
    	//Busca los que tienen contacto pero el contacto no tiene genero
    	$this->gateway->getCasesWithContactWithoutSexByRange();
    	$rcTmp = $this->gateway->getResult();
    	if(is_array($rcTmp))
	    	$nd += (integer) $rcTmp[0]['cantidad'];
    	unset($rcTmp);
    	
    	//Busca los casos generados por hombres
    	$masc = 0;
    	$this->gateway->setIdSex('M');
    	$this->gateway->getCasesWithContactWithSexByRange();
    	$rcTmp = $this->gateway->getResult();
       	if(is_array($rcTmp))
    		$masc = (integer) $rcTmp[0]['cantidad'];
    	unset($rcTmp);
    
    	//Busca los casos generados por mujeres
    	$feme = 0;
    	$this->gateway->setIdSex('F');
    	$this->gateway->getCasesWithContactWithSexByRange();
    	$rcTmp = $this->gateway->getResult();
       	if(is_array($rcTmp))
	    	$feme = (integer) $rcTmp[0]['cantidad'];
    	unset($rcTmp);
    	
    	include ($this->user["lang"]."/".$this->user["lang"].".generic.php");
    	$this->report[] = array($rcSex['F'],$feme);
    	$this->report[] = array($rcSex['M'],$masc);
    	$this->report[] = array($rcSex['ND'],$nd);
    	return true;
    }
    
    
    
   /**
    * Copyright 2006 FullEngine
    * 
    * Consulta los casos por frecuencia(Horaria) 
    * @author creyes <careyes@parquesoft.com>
    * @date 11-July-2006
    * @location Cali-Colombia
    */
    function __timetable(){
    	$this->gateway->setStartDate($this->__startDate);
    	$this->gateway->setEndDate($this->__endDate);
    	$this->gateway->setDataCasesByTimetable();
    	if(!$this->gateway->getConsult())
    		return $this->gateway->getConsult();
    	
    	//Carga las horas del dia 0 a 23
    	$rcHours = range(0, 23);
    	
    	//Consulta los casos por horas
    	foreach($rcHours as $hour){
    		$startHour = ($hour) ? $hour * 3600 : 0;
    		$endHour = ($hour) ? $startHour + 3599 : 3599;
    		$this->gateway->setStartHour($startHour);
    		$this->gateway->setEndHour($endHour);
    		$this->gateway->getCasesByHour();
    		$rcTmp = $this->gateway->getResult();
    		if(is_array($rcTmp))
    			foreach ($rcTmp as $row)
    				$this->report[] = array($row['organombres'],$row['tiornombres'],"$hour:00",(integer)$row['cantidad']);
    	}
    	
    	//Elimina la tabla temporal
    	$this->gateway->dropTmpTable();
    	return true;
    }

   /**
    * Copyright 2006 FullEngine
    * 
    * Consulta los casos por frecuencia(Diaria) 
    * @author creyes <careyes@parquesoft.com>
    * @date 11-July-2006
    * @location Cali-Colombia
    */
    function __daily(){

    	settype($objDate, "object");
    	$objDate = Application :: loadServices("DateController");

    	//Define los timestamp para cada dia del mes
    	$month = $this->startMonth;
    	while($month <= $this->endMonth){
    		$nudaysMonth = $objDate->_date('t',$objDate->_mktime(0, 0, 0, $month, 1, $this->year));
    		
    		//indices de inicio y fin de mes
    		if($month == $this->startMonth){
    			$this->monthMarks[$month]=0;
    		}else{
    			$this->monthMarks[$month]=sizeof($this->report) - 1;
    		}
	    	for($day=1;$day <= $nudaysMonth;$day++){
	    		$startDay = $objDate->_mktime(0, 0, 0, $month, $day, $this->year);
	    		$endDay = $startDay + 86399;
		    	$this->gateway->setStartDate($startDay);
		    	$this->gateway->setEndDate($endDay);
	    		$this->gateway->getCasesByRange();
	    		$rcTmp = $this->gateway->getResult();
	    		if(is_array($rcTmp))
	    			foreach ($rcTmp as $rcRow) {
	    				$this->report[] = array($rcRow['organombres'],$rcRow['tiornombres'],$day,(integer)$rcRow['cantidad']);
	    			}
	    	}
	    	$month++;
    	}
    	return true;
    }
    
   /**
    * Copyright 2006 FullEngine
    * 
    * Consulta los casos por frecuencia(Dia de la semana) 
    * @author creyes <careyes@parquesoft.com>
    * @date 11-July-2006
    * @location Cali-Colombia
    */
    function __dayweek(){
    	
    	settype($objDate, "object");
    	$objDate = Application :: loadServices("DateController");
    	
    	$this->gateway->setStartDate($this->__startDate);
    	$this->gateway->setEndDate($this->__endDate);
    	
    	$this->gateway->getCasesBetweenDate();
    	$rcCases = $this->gateway->getResult();
    	if(!is_array($rcCases))
    		return false;
    		
    	$rcDayWeek = array ();
		$rcDayWeek = array_pad ($rcDayWeek, 7, 0);

    	foreach($rcCases as $rcTmp){
    		$weekNumberDay = (integer) $objDate->_date("w", $rcTmp['ordefecregd']);
    		$rcTemp["cantidad"]++;
    		$rcTemp["organombres"] = $rcTmp["organombres"];
    		$rcTemp["tiornombres"] = $rcTmp["tiornombres"];
    		$rcDayWeek[$weekNumberDay] = $rcTemp;
    	}
    	
    	include ($this->user["lang"]."/".$this->user["lang"].".generic.php");
    	foreach($rcDayWeek as $key => $row){
    		$this->report[] = array($row["organombres"],$row["tiornombres"],$rcWeekDays[$key],(integer)$row["cantidad"]);
    	}
    	return true;
    }
    
   /**
    * Copyright 2006 FullEngine
    * 
    * Consulta los casos por frecuencia(semanal) 
    * @author creyes <careyes@parquesoft.com>
    * @date 11-July-2006
    * @location Cali-Colombia
    */
    function __weekly(){
    	
    	//Obtiene las semanas del mes
    	$dateServices = Application::loadServices('DateController');

    	$rcWeeks = array();
    	$month = $this->startMonth;
    	while($month <= $this->endMonth){
    		$rcWeeksTmp = $dateServices->getWeeksByMounth($month, $this->year);
    		$rcWeeks = array_merge($rcWeeks,$rcWeeksTmp);
			$month++;    		
    	}
    	//Define los timestamp para cada dia del mes
    	foreach($rcWeeks as $rcRange){
    		$startDay = $rcRange[0];
    		$endDay = $rcRange[1] + 86399;
	    	$this->gateway->setStartDate($startDay);
	    	$this->gateway->setEndDate($endDay);
    		$this->gateway->getCasesByRange();
    		$rcTmp = $this->gateway->getResult();
    		$strRep = $dateServices->fncformatofecha($rcRange[0]).' - '.$dateServices->fncformatofecha($rcRange[1]);
    		if(is_array($rcTmp))
	    			foreach ($rcTmp as $rcRow)
	    				$this->report[] = array($rcRow['organombres'],$rcRow['tiornombres'],$strRep,(integer)$rcRow['cantidad']);
    	}
    	return true;
    }
    
   /**
    * Copyright 2006 FullEngine
    * 
    * Consulta los casos por frecuencia(semanal) 
    * @author creyes <careyes@parquesoft.com>
    * @date 11-July-2006
    * @location Cali-Colombia
    */
    function __monthly(){
    	
    	settype($objDate, "object");
    	$objDate = Application :: loadServices("DateController");
    	
    	include ($this->user["lang"]."/".$this->user["lang"].".generic.php");
    	$month = $this->startMonth;
    	while($month <= $this->endMonth){
			$nudaysMonth = $objDate->_date('t',$objDate->_mktime(0, 0, 0, $month, 1, $this->year));
    		$startDay = $objDate->_mktime(0, 0, 0, $month, 1, $this->year);
    		$endDay = $objDate->_mktime(23, 59, 59, $month, $nudaysMonth, $this->year); 
	    	$this->gateway->setStartDate($startDay);
	    	$this->gateway->setEndDate($endDay);
    		$this->gateway->getCasesByRange();
    		$rcTmp = $this->gateway->getResult();
    		if(is_array($rcTmp))
	    			foreach ($rcTmp as $rcRow)
	    				$this->report[] = array($rcRow['organombres'],$rcRow['tiornombres'],$rcMonths[$month],(integer)$rcRow['cantidad']);
			$month++;    		
    	}
    }
    
    /**
    * Copyright 2006 FullEngine
    * 
    * Consulta los casos por tipo de prioridad
    * @author mrestrepo <mrestrepo@parquesoft.com>
    * @param integer $nuDate fecha en estero tiemestamp
    * @date 27-July-2006   05:45AM
    * @location Cali-Colombia
    */
    function getClientSatisfactionIndicator(){
    	if(!$this->__startDate || !$this->__endDate){
    		return false;
    	}
    	
    	if($this->startMonth > $this->endMonth){
    		return false;
    	}
    	
    	//Ajusta las fechas de inicio y fin 
    	$this->gateway->setStartDate($this->__startDate);
    	$this->gateway->setEndDate($this->__endDate);
   		$this->gateway->getClientSatisfactionIndicator();
   		$rcResult = $this->gateway->getResult();

   		if(!is_array($rcResult))
   			return false;
   			
    	foreach($rcResult as $rcTmp){
    		$this->report[] = array($rcTmp['tiornombres'],$rcTmp['cantidad']*1);
    	}
    	return true;
    }
    
    /**
    * Copyright 2008 FullEngine
    * 
    * Consulta los casos por municipiio
    * @author mrestrepo <mrestrepo@parquesoft.com>
    * @date 14-Mya-2008   10:45AM
    * @location Cali-Colombia
    */
    function getCasesByMunicipio(){
    	if(!$this->__startDate || !$this->__endDate){
    		return false;
    	}
    	
    	if($this->startMonth > $this->endMonth){
    		return false;
    	}
    	
    	//Ajusta las fechas de inicio y fin 
    	$this->gateway->setStartDate($this->__startDate);
    	$this->gateway->setEndDate($this->__endDate);
   		$this->gateway->getCasesByMunicipio();
   		$rcResult = $this->gateway->getResult();
    	
   		if(!is_array($rcResult))
   			return false;
   			
   		//CARGUEMOS UN ÁRBOL BIEN CRAZY A VER SI RESOLVEMOS LO DE LAS VEREDAS QUE SE LLAMAN IGUAL
   		//Por medio del servicio General
   		$objGeneral = Application::loadServices("General");
   		$objLocaliza = $objGeneral->InitiateClass("LocalizacionManager");
   		
   		//Sólo necesitamos de municipios para abajo
   		$rcTemp = $objGeneral->getConstant("LOCALIZACION");
   		$tipoMunicipio = $rcTemp["geografia"][0][0];
   		
   		//Hagámolo en el manager de localización para poder meterle "inteligencia" (recursión)
   		$rcLocaliza = $objLocaliza->getTreeLocalization($tipoMunicipio);
   		
   		//Cerremos el servicio
   		$objGeneral->close();
   		
   		foreach ($rcLocaliza as $locacodigos=>$row)
    		foreach($rcResult as $rcTmp)
    			if($locacodigos == $rcTmp['locacodigos'])
    				$this->report[] = array($rcTmp['tiornombres'],$row["locanombres"],$row["tilonombres"],$rcTmp['cantidad']*1);
    	return true;
    }
    
    /**
    * Copyright 2008 FullEngine
    * 
    * Consulta las denuncias por localización
    * @author mrestrepo <mrestrepo@parquesoft.com>
    * @date 14-Mya-2008   11:31AM
    * @location Cali-Colombia
    */
    function getDenunciasPorLocaliza(){
    	if(!$this->__startDate || !$this->__endDate){
    		return false;
    	}
    	
    	if($this->startMonth > $this->endMonth){
    		return false;
    	}
    	
    	//Ajusta las fechas de inicio y fin 
    	$this->gateway->setStartDate($this->__startDate);
    	$this->gateway->setEndDate($this->__endDate);
   		$this->gateway->getDenunciasPorLocaliza();
   		$rcResult = $this->gateway->getResult();
   		
   		if(!is_array($rcResult))
   			return false;
   			
   		//CARGUEMOS UN ÁRBOL BIEN CRAZY A VER SI RESOLVEMOS LO DE LAS VEREDAS QUE SE LLAMAN IGUAL
   		//Por medio del servicio General
   		$objGeneral = Application::loadServices("General");
   		$objLocaliza = $objGeneral->InitiateClass("LocalizacionManager");
   		
   		//Sólo necesitamos de municipios para abajo
   		$rcTemp = $objGeneral->getConstant("LOCALIZACION");
   		$tipoMunicipio = $rcTemp["geografia"][2][0];
   		
   		//Hagámolo en el manager de localización para poder meterle "inteligencia" (recursión)
   		$rcLocaliza = $objLocaliza->getTreeLocalization($tipoMunicipio);
   		
   		//Cerremos el servicio
   		$objGeneral->close();
   		
    	foreach($rcResult as $rcTmp){
    		$this->report[] = array($rcTmp['evennombres'],$rcTmp['causnombres'],$rcLocaliza[$rcTmp["locacodigos"]]["locanombres"],$rcTmp['cantidad']*1);
    	}
    	return true;
    }
    
       /**
    * Copyright 2006 FullEngine
    * 
    * Consulta los casos por tarea
    * @author mrestrepo <mrestrepo@parquesoft.com>
    * @date 31-Ago-2006
    * @location Cali-Colombia
    */
    function getCasesByActa(){
    	if(!$this->__startDate || !$this->__endDate){
    		return false;
    	}
    	
    	if($this->__startDate > $this->__endDate){
    		return false;
    	} 

    	//Ajusta las fechas de inicio y fin 
    	$this->gateway->setStartDate($this->__startDate);
    	$this->gateway->setEndDate($this->__endDate);
   		$this->gateway->getCasesByActa();
   		$rcResult = $this->gateway->getResult();
   		if(!is_array($rcResult))
   			return false;

    	foreach($rcResult as $rcTmp){
    		$cant = (integer) $rcTmp['cantidad'];
    		$this->report[] = array($rcTmp['tarenombres'],$cant);
    		$this->dataReport[$rcTmp['tarecodigos']] = $rcTmp['tarenombres'];
    	}
    	return true;
    }
    
        /**
    * Copyright 2006 FullEngine
    * 
    * Consulta los casos por actividad, agrupado por tarea (para no hacer un query por cada tarea).
    * @author mrestrepo <mrestrepo@parquesoft.com>
    * @date 31-Ago-2006
    * @location Cali-Colombia
    */
    function getCasesByActividad(){
    	if(!$this->__startDate || !$this->__endDate){
    		return false;
    	}
    	
    	if($this->__startDate > $this->__endDate){
    		return false;
    	} 

    	//Ajusta las fechas de inicio y fin 
    	$this->gateway->setStartDate($this->__startDate);
    	$this->gateway->setEndDate($this->__endDate);
   		$this->gateway->getCasesByActividad();
   		$rcResult = $this->gateway->getResult();
   		if(!is_array($rcResult))
   			return false;

   		$this->setCleanReport();
    	foreach($rcResult as $rcTmp){
    		$cant = (integer) $rcTmp['cantidad'];
    		$this->report[$rcTmp['tarecodigos']][] = array($rcTmp['actinombres'],$cant);
    	}
    	return true;
    }

	/**
    * Copyright 2009 FullEngine
    * 
    * Consulta el log de rotaciones
    * @author mrestrepo <mrestrepo@parquesoft.com>
    * @param integer $nuDate fecha en estero tiemestamp
    * @date 12-March-2009   11:16AM
    * @location Cali-Colombia
	* oldorgacodigos, neworgacodigos, neworganombres, oldorgacodpads, neworgacodpads, 
	* ordenestopadres, ordenesneworgs, logrfechorregn, authusernames
    */
    function getLogRotacion(){

    	if(!$this->__startDate || !$this->__endDate){
    		return false;
    	}
    	if($this->startMonth > $this->endMonth){
    		return false;
    	}

    	$objDate = Application :: loadServices("DateController");
    	
    	//Ajusta las fechas de inicio y fin 
    	$this->gateway->setStartDate($this->__startDate);
    	$this->gateway->setEndDate($this->__endDate);
   		$this->gateway->getLogRotacion();
   		$rcResult = $this->gateway->getResult();

   		if(!is_array($rcResult))
   			return false;
   			
		$HR = Application::loadServices("Human_resources");
		$rcEntes = $HR->getAllOrganizacionById();
		$HR->close();

    	foreach($rcResult as $rcTmp){
			$rcTmp["logrfechorregn"] = $objDate->fncformatofechahora($rcTmp["logrfechorregn"]);
			$rcTmp["ordenestopadres"] = str_replace(",","<br>",$rcTmp["ordenestopadres"]);
			$rcTmp["ordenesneworgs"] = str_replace(",","<br>",$rcTmp["ordenesneworgs"]);
			$rcTmp["oldorgacodpads"] = $rcTmp["oldorgacodpads"]." - ".$rcEntes[$rcTmp["oldorgacodpads"]]["organombres"]; 
			$rcTmp["neworgacodpads"] = $rcTmp["neworgacodpads"]." - ".$rcEntes[$rcTmp["neworgacodpads"]]["organombres"]; 
    		$this->report[] = $rcTmp;
    	}
    	return true;
    }
    
	/**
	 * @Copyright 2009 Parquesoft
	 *
	 * Modifica el arreglo de datos
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function setData($rcData){
		$this->rcData = $rcData;
	}
    
    /**
    * Copyright 2009 FullEngine
    * 
    * Consulta las llaves generadas
    * @author freina<freina@parquesoft.com>
    * @date 27-Mar-2009
    * @location Cali-Colombia
    */
    
    function getLlave(){
    	
    	settype($objGateway,"object");
    	settype($objDate,"object");
    	settype($rcTmp,"array");
    	settype($rcCont,"array");
    	settype($rcData,"array");
    	settype($rcResult,"array");
    	settype($rcSol,"array");
    	settype($rcRow,"array");
    	settype($sbIndex,"string");
    	settype($sbIndex2,"string");
    	settype($sbName,"string");
    	settype($nuCont,"integer");
    	settype($nuDate,"integer");
    	extract($this->rcData);
    	
    	if(!$fechaini || !$fechafin){
    		return false;
    	}
		
    	$objGateway = Application::getDataGateway("llave");
    	
    	//Ajusta las fechas de inicio y fin
    	$rcData["fechaini"] = $fechaini; 
    	$rcData["fechafin"] = $fechafin;
    	if($llavusuauts){
    		$rcData["llavusuauts"] = $llavusuauts;	
    	}
    	if($llavususols){
    		$rcData["llavususols"] = $llavususols;	
    	}
    	
    	$objGateway->setData($rcData);
   		$objGateway->getReporteLlave();
   		$rcResult = $objGateway->getResult();
		
   		if(!is_array($rcResult) || !$rcResult){
   			return false;
   		}
   		
   		$objDate = Application :: loadServices("DateController");
    	$nuDate = $objDate->fncintdatehour();
   		
   		//se realiza el analisis de la información. 
   		//de esta forma agrupo por autorizadores
		unset($rcData);
    	foreach($rcResult as $rcTmp){ 
    		$nuCont = 0;
    		if($rcCont[$rcTmp["perscodigos1"]]){
    			$nuCont = $rcCont[$rcTmp["perscodigos1"]];
    		}
    		$rcData[$rcTmp["perscodigos1"]][0] = $rcTmp["llavusuauts"];
    		$rcData[$rcTmp["perscodigos1"]][1][$nuCont] = $rcTmp;
    		$nuCont ++;
    		$rcCont[$rcTmp["perscodigos1"]] = $nuCont;
    	}
    	
    	//ahora evaluo uno a uno a los solicitantes
    	if(is_array($rcData) && $rcData){
    		
    		unset($rcResult);
			foreach($rcData as $sbIndex=>$rcTmp){
				$sbName = $rcTmp[0];
				unset($rcSol);
				foreach($rcTmp[1] as $rcRow){
					
		    		//analisis
		    		//se valida si la llave fue usada
		    		if($rcRow["llavfecusod"]){
		    			$rcSol[$rcRow["perscodigos2"]]["used"]++;
		    		}else{
		    			//se evalua si la ha perdido
		    			if($rcRow["llavfecvend"]<$nuDate){
		    				$rcSol[$rcRow["perscodigos2"]]["lost"]++;
		    			}
		    		}
		    		$rcSol[$rcRow["perscodigos2"]]["name"] = $rcRow["llavususols"];
		    		$rcSol[$rcRow["perscodigos2"]]["total"]++;
				}
				//se acumula la data
				$rcResult[$sbIndex][0] = $sbName;
				$rcResult[$sbIndex][1] = $rcSol;
			}
			
			unset($rcData);
			$nuCont = 0;
			foreach($rcResult as $sbIndex=>$rcTmp){
				foreach($rcTmp[1] as $sbIndex2=>$rcRow){
					
					if(!$rcRow["total"]){
						$rcRow["total"]=0;
					}
					if(!$rcRow["used"]){
						$rcRow["used"]=0;
					}
					if(!$rcRow["lost"]){
						$rcRow["lost"]=0;
					}
					
					$rcData[$nuCont] = array("cod_aut"=>$sbIndex,
											 "name_1"=>$rcTmp[0],
											 "cod_sol"=>$sbIndex2,
											 "name_2"=>$rcRow["name"],
											 "total"=>$rcRow["total"],
											 "used"=>$rcRow["used"],
											 "lost"=>$rcRow["lost"]);
					$nuCont++;
				}
			}
    	}
    	unset($rcTmp);
    	$rcTmp[0] = $rcResult;
    	$rcTmp[1] = $rcData;
    	$this->report = $rcTmp;
    	return true;
    }
}
?>