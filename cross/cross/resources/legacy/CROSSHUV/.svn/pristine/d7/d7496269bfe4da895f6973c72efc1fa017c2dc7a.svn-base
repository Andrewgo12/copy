<?php
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");

class FeCrPgsqlReportes {

    function FeCrPgsqlReportes() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
		$this->sbFechDigit = '';
    }
    
    function setStartDate($startDate){
    	$this->startDate = $startDate;
    }
    function setEndDate($endDate){
    	$this->endDate = $endDate;
    }

	//000267AT - FECHA DE DIGITACIÓN
	function setFechasDigitacion($fecha1,$fecha2) {
		if($fecha1 && $fecha2) {
			$this->sbFechDigit = ' AND "orden"."ordefecingd" BETWEEN '.$fecha1.' AND '.$fecha2.' ';
		}
	}

    function setStartHour($startHour){
    	$this->startHour = $startHour;
    }
    function setEndHour($endHour){
    	$this->endHour = $endHour;
    }
	function setUserName($userName){
		if($userName){
			$userName = str_replace ( ".", "_", $userName );
		}
		$this->userName = $userName;
	}
	function setIdSex($idSex){
		$this->idSex = $idSex;
	}
	function setAgeoldSerie($rcAgeold){
		$this->rcAgeold = $rcAgeold;
	}
	function setStartAgeold($startAgeold){
		$this->startAgeold = $startAgeold;
	}
	function setEndAgeold($endAgeold){
		$this->endAgeold = $endAgeold;
	}
	function setOperator($operator){
		$this->operator = $operator;
	}
    function setTypeLocation($typeLocation){
    	$this->typeLocation = $typeLocation;
    }
    function setOrganization($orgacodigos){
    	$this->Organization = $orgacodigos;
    }
    function setTypeCase($tiorcodigos){
    	$this->TypeCase = $tiorcodigos;
    }
    function setLocation($location){
    	$this->location = $location;
    }
	function setLocations($rcLocations){
		$this->rcLocations = $rcLocations;
	}

	function getConsult(){
		return $this->consult;
	}
	function getResult(){
		return $this->rcResult;
	}
   /**
    * Copyright 2006 FullEngine
    * 
    * Crea una tabla temporal para almacenar los casos.
    * convierte las fechas de registro a solo la hora 
    * @author creyes <careyes@parquesoft.com>
    * @date 11-July-2006
    * @location Cali-Colombia
    */
	function setDataCasesByTimetable(){
		$this->dropTmpTable();
		$sql = 'CREATE TABLE "tmp_'.$this->userName.'" AS ' .
								'SELECT ' .
									'"organombres","tiornombres","orden"."ordenumeros", ' .
									'MOD (("ordefecregd"-18000) , 86400) AS "hora" ' .
								'FROM "orden","ordenempresa","tipoorden","organizacion","acta"';
    	$sql .= 'WHERE "ordefecregd" BETWEEN '.$this->startDate.' AND '.$this->endDate;
   		$sql .= ' AND "ordenempresa"."ordenumeros" = "orden"."ordenumeros"';
   		$sql .= ' AND "ordenempresa"."ordenumeros" = "acta"."ordenumeros"';
    	$sql .= ' AND "ordenempresa"."tiorcodigos" = "tipoorden"."tiorcodigos"';
   		$sql .= ' AND "acta"."orgacodigos" = "organizacion"."orgacodigos"';
    	if($this->Organization)
    		$sql .= ' AND "acta"."orgacodigos"=\''.$this->Organization.'\'';
		if($this->TypeCase)
    		$sql .= ' AND "ordenempresa"."tiorcodigos"=\''.$this->TypeCase.'\'';
		$this->rcSql[] = $sql;			
		$this->rcSql[] = 'ALTER TABLE "tmp_'.$this->userName.'" ADD CONSTRAINT "tmp_'.$this->userName.'_pkey" PRIMARY KEY ("ordenumeros")';
		$this->rcSql[] = 'CREATE INDEX tmp_'.$this->userName.'_ind ON "tmp_'.$this->userName.'"  ("hora")';
		
		$this->objdb->fncadoexecutetrans($this->rcSql);
		$this->rcSql = null;
		if (!$this->objdb->objresult)		
			$this->consult = false;
		else
			$this->consult = true;
	}    
   /**
    * Copyright 2006 FullEngine
    * 
    * Consulta la cantidad de casos por hora en una tabla temporal.
    * @author creyes <careyes@parquesoft.com>
    * @date 11-July-2006
    * @location Cali-Colombia
    */
    function getCasesByHour(){
    	$sql = 'SELECT "organombres","tiornombres",count(*) AS "cantidad" '.
    			'FROM "tmp_'.$this->userName.'" '.
    			'WHERE "hora" BETWEEN '.$this->startHour.' AND '.$this->endHour.
    			' GROUP BY 1,2'.
    			' ORDER BY 1,2';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		$this->rcResult = $this->objdb->rcresult;
    }
   /**
    * Copyright 2006 FullEngine
    * 
    * Elimina la tabla temporal
    * @author creyes <careyes@parquesoft.com>
    * @date 11-July-2006
    * @location Cali-Colombia
    */
    function dropTmpTable(){
    	settype($sbTable,"string");
    	settype($sbSql,"string");
    	
    	$sbTable = 'tmp_'.$this->userName;
    	$this->objdb->fncadometacolumns($sbTable);
    	
    	if($this->objdb->rcresult){
    		$sbSql = 'DROP TABLE "'.$sbTable.'"';
    		$this->objdb->fncadoexecute($sbSql);
    	}
    }

   /**
    * Copyright 2006 FullEngine
    * 
    * Consulta la cantidad de casos en rango de fechas.
    * @author creyes <careyes@parquesoft.com>
    * @date 11-July-2006
    * @location Cali-Colombia
    */
    function getCasesByRange(){

    	$sql = 'SELECT "organombres","tiornombres",count(*) AS "cantidad" '.
    			'FROM "orden","ordenempresa","organizacion","tipoorden","acta"';
    	$sql .= ' WHERE "ordefecregd" BETWEEN '.$this->startDate.' AND '.$this->endDate;
    	$sql .= ' AND "ordenempresa"."ordenumeros" = "orden"."ordenumeros"';
    	$sql .= ' AND "ordenempresa"."ordenumeros" = "acta"."ordenumeros"';
    	$sql .= ' AND "ordenempresa"."tiorcodigos" = "tipoorden"."tiorcodigos"';
   		$sql .= ' AND "acta"."orgacodigos" = "organizacion"."orgacodigos"';
    	if($this->Organization)
    		$sql .= ' AND "acta"."orgacodigos"=\''.$this->Organization.'\'';
		if($this->TypeCase)
    		$sql .= ' AND "ordenempresa"."tiorcodigos"=\''.$this->TypeCase.'\'';
		$sql .= $this->sbFechDigit;
    	$sql .= ' GROUP BY 1,2';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		$this->rcResult = $this->objdb->rcresult;
    }

   /**
    * Copyright 2006 FullEngine
    * 
    * Consulta de casos registrados entre fechas.
    * @author creyes <careyes@parquesoft.com>
    * @date 11-July-2006
    * @location Cali-Colombia
    */
    function getCasesBetweenDate(){
    	$sql = 'SELECT  "organombres","tiornombres","orden"."ordenumeros","ordefecregd" '.
    			'FROM "orden","ordenempresa","organizacion","tipoorden","acta"';
    	$sql .= ' WHERE "ordefecregd" BETWEEN '.$this->startDate.' AND '.$this->endDate;
    	$sql .= ' AND "ordenempresa"."ordenumeros" = "orden"."ordenumeros"';
    	$sql .= ' AND "ordenempresa"."ordenumeros" = "acta"."ordenumeros"';
    	$sql .= ' AND "ordenempresa"."tiorcodigos" = "tipoorden"."tiorcodigos"';
   		$sql .= ' AND "acta"."orgacodigos" = "organizacion"."orgacodigos"';
    	if($this->Organization)
    		$sql .= ' AND "acta"."orgacodigos"=\''.$this->Organization.'\'';
		if($this->TypeCase)
    		$sql .= ' AND "ordenempresa"."tiorcodigos"=\''.$this->TypeCase.'\'';
		$sql .= $this->sbFechDigit;
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		$this->rcResult = $this->objdb->rcresult;
    }

   /**
    * Copyright 2006 FullEngine
    * 
    * Consulta la cantidad de casos sin contacto entre rango de fechas.
    * @author creyes <careyes@parquesoft.com>
    * @date 11-July-2006
    * @location Cali-Colombia
    */
    function getCasesWithoutContactByRange(){
    	$sql = 'SELECT count(*) AS "cantidad" ' .
    		   'FROM "orden","ordenempresa" ' .
    		   'WHERE ' .
    		   	'"orden"."ordefecregd" BETWEEN '.$this->startDate.' AND '.$this->endDate.' AND ' .
    		   	'"orden"."ordenumeros"="ordenempresa"."ordenumeros" AND ' .
    		   	'"ordenempresa"."contidentis" IS NULL';
		$sql .= $this->sbFechDigit;
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		$this->rcResult = $this->objdb->rcresult;
    }
    
   /**
    * Copyright 2006 FullEngine
    * 
    * Consulta la cantidad de casos con contacto sin sexo entre rango de fechas.
    * @author creyes <careyes@parquesoft.com>
    * @date 11-July-2006
    * @location Cali-Colombia
    */
    function getCasesWithContactWithoutSexByRange(){
    	$sql = 'SELECT count(*) AS "cantidad" ' .
    		   'FROM "orden","ordenempresa","solicitante",contacto" ' .
    		   'WHERE ' .
    		   	'"orden"."ordefecregd" BETWEEN '.$this->startDate.' AND '.$this->endDate.' AND ' .
    		   	'"orden"."ordenumeros"="ordenempresa"."ordenumeros" AND ' .
    		   	'"ordenempresa"."contidentis"="solicitante"."solicodigos" AND ' .
    			'"solicitante"."contcodigon"="contacto"."contcodigon" AND ' .
    		   	'"contacto"."contsexos" IS NULL';
		$sql .= $this->sbFechDigit;
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		$this->rcResult = $this->objdb->rcresult;
    }

   /**
    * Copyright 2006 FullEngine
    * 
    * Consulta la cantidad de casos con contacto sin edad entre rango de fechas.
    * @author creyes <careyes@parquesoft.com>
    * @date 11-July-2006
    * @location Cali-Colombia
    */
    function getCasesWithContactWithoutAgeoldByRange(){
    	$sql = 'SELECT count(*) AS "cantidad" ' .
    		   'FROM "orden","ordenempresa","solicitante","contacto" ' .
    		   'WHERE ' .
    		   	'"orden"."ordefecregd" BETWEEN '.$this->startDate.' AND '.$this->endDate.' AND ' .
    		   	'"orden"."ordenumeros"="ordenempresa"."ordenumeros" AND ' .
    		   	'"ordenempresa"."contidentis"="solicitante"."solicodigos" AND ' .
    			'"solicitante"."contcodigon"="contacto"."contcodigon" AND ' .
    		   	'"contacto"."contedadn" IS NULL';
		$sql .= $this->sbFechDigit;
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		$this->rcResult = $this->objdb->rcresult;
    }

   /**
    * Copyright 2006 FullEngine
    * 
    * Consulta la cantidad de casos con contacto con sexo entre rango de fechas.
    * @author creyes <careyes@parquesoft.com>
    * @date 11-July-2006
    * @location Cali-Colombia
    */
    function getCasesWithContactWithSexByRange(){
    	$sql = 'SELECT count(*) AS "cantidad" ' .
    		   'FROM "orden","ordenempresa","solicitante","contacto" ' .
    		   'WHERE ' .
    		   	'"orden"."ordefecregd" BETWEEN '.$this->startDate.' AND '.$this->endDate.' AND ' .
    		   	'"orden"."ordenumeros"="ordenempresa"."ordenumeros" AND ' .
    		   	'"ordenempresa"."contidentis"="solicitante"."solicodigos" AND ' .
    			'"solicitante"."contcodigon"="contacto"."contcodigon" AND ' .
    		   	'"contacto"."contsexos"=\''.$this->idSex.'\'';
		$sql .= $this->sbFechDigit;
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		$this->rcResult = $this->objdb->rcresult;
    }
    
   /**
    * Copyright 2006 FullEngine
    * 
    * Consulta la cantidad de casos con contacto con edad especifica entre rango de fechas.
    * @author creyes <careyes@parquesoft.com>
    * @date 11-July-2006
    * @location Cali-Colombia
    */
    function getCasesWithContactWithAgeoldByRange(){
    	
    	$in = ' IN ('.implode(',',$this->rcAgeold).')';
    	$sql = 'SELECT "contacto"."contedadn", count(*) AS "cantidad" ' .
    		   'FROM "orden","ordenempresa","solicitante","contacto" ' .
    		   'WHERE ' .
    		   	'"orden"."ordefecregd" BETWEEN '.$this->startDate.' AND '.$this->endDate.' AND ' .
    		   	'"orden"."ordenumeros"="ordenempresa"."ordenumeros" AND ' .
    		   	'"ordenempresa"."contidentis"="solicitante"."solicodigos" AND ' .
    			'"solicitante"."contcodigon"="contacto"."contcodigon" AND ' .
    		   	'"contacto"."contedadn"'.$in.' ' .$this->sbFechDigit.
    		   'GROUP BY "contacto"."contedadn" ORDER BY 1';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		$this->rcResult = $this->objdb->rcresult;
    }
    
   /**
    * Copyright 2006 FullEngine
    * 
    * Consulta la cantidad de casos con contacto entre edades entre rango de fechas.
    * @author creyes <careyes@parquesoft.com>
    * @date 11-July-2006
    * @location Cali-Colombia
    */
    function getCasesWithContactBetweenAgeoldByRange(){
    	
    	if($this->startAgeold && $this->endAgeold){
    		$where = ' BETWEEN '.$this->startAgeold.' AND '.$this->endAgeold;
    	}elseif(!$this->endAgeold){
    		$where = $this->operator.$this->startAgeold;
    	}
    	
    	$sql = 'SELECT count(*) AS "cantidad" ' .
    		   'FROM "orden","ordenempresa","solicitante","contacto" ' .
    		   'WHERE ' .
    		   	'"orden"."ordefecregd" BETWEEN '.$this->startDate.' AND '.$this->endDate.' AND ' .
    		   	'"orden"."ordenumeros"="ordenempresa"."ordenumeros" AND ' .
    		   	'"ordenempresa"."contidentis"="solicitante"."solicodigos" AND ' .
    			'"solicitante"."contcodigon"="contacto"."contcodigon" AND ' .
    		   	'"contacto"."contedadn"'.$where;
    	$sql .= $this->sbFechDigit;
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		$this->rcResult = $this->objdb->rcresult;
    }
    
   /**
    * Copyright 2006 FullEngine
    * 
    * Consulta la cantidad de casos por tipo de localizacion.
    * @author creyes <careyes@parquesoft.com>
    * @date 11-July-2006
    * @location Cali-Colombia
    */
    function getCasesByLocations(){
    	
    	$in = "'".implode("','",$this->rcLocations)."'";
    	$sql = 'SELECT ' .
    				'count("ordenempresa"."locacodigos") AS "cantidad" ' .
    			'FROM "orden","ordenempresa"' .
    		'WHERE ' .
    		   	'"orden"."ordefecregd" BETWEEN '.$this->startDate.' AND '.$this->endDate.' AND ' .
    		   	'"orden"."ordenumeros"="ordenempresa"."ordenumeros" AND ' .
    		   	'"ordenempresa"."locacodigos"  IN ('.$in.')' ;
		$sql .= $this->sbFechDigit;
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		$this->rcResult = $this->objdb->rcresult;
    }

   /**
    * Copyright 2006 FullEngine
    * 
    * Consulta la cantidad de casos por tipo de caso.
    * @author creyes <careyes@parquesoft.com>
    * @date 11-July-2006
    * @location Cali-Colombia
    */
    function getCasesByType(){
    	$sql = 'SELECT ' .
    				'"ordenempresa"."tiorcodigos",' .
    				'"tipoorden"."tiornombres",' .
    				'count("ordenempresa"."tiorcodigos") AS "cantidad" ' .
    			'FROM "orden","ordenempresa", "tipoorden" ' .
    		'WHERE ' .
    		   	'"orden"."ordefecregd" BETWEEN '.$this->startDate.' AND '.$this->endDate.' AND ' .
    		   	'"orden"."ordenumeros"="ordenempresa"."ordenumeros" AND ' .
    		   	'"ordenempresa"."tiorcodigos"="tipoorden"."tiorcodigos"'.$this->sbFechDigit.
    		   	'GROUP BY "ordenempresa"."tiorcodigos","tipoorden"."tiornombres" ORDER BY "cantidad" ASC';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		$this->rcResult = $this->objdb->rcresult;
	
    }

   /**
    * Copyright 2006 FullEngine
    * 
    * Consulta la cantidad de casos por causa.
    * @author creyes <careyes@parquesoft.com>
    * @date 11-July-2006
    * @location Cali-Colombia
    */
    function getCasesByCause(){
   		   	
    	$sql = 'SELECT ' .
    				'"causa"."causnombres", ' .
    				'count("causa"."causnombres") AS "cantidad" ' .
    			'FROM "orden","ordenempresa","causa" ' .
    			'WHERE ' .
    				'"orden"."ordefecregd" BETWEEN '.$this->startDate.' AND '.$this->endDate.' AND ' .
    				'"orden"."ordenumeros"="ordenempresa"."ordenumeros" AND ' .
    				'"ordenempresa"."tiorcodigos"="causa"."tiorcodigos" AND ' .
    				'"ordenempresa"."evencodigos"="causa"."evencodigos" AND ' .
    				'"ordenempresa"."causcodigos"="causa"."causcodigos"'.$this->sbFechDigit.
    				'GROUP BY "causa"."causnombres" ORDER BY 1 ASC';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		$this->rcResult = $this->objdb->rcresult;
	
    }
    
   /**
    * Copyright 2006 FullEngine
    * 
    * Consulta la cantidad de casos por usuario.
    * @author creyes <careyes@parquesoft.com>
    * @date 11-July-2006
    * @location Cali-Colombia
    */
    function getCasesByUser(){
   		   	
    	$sql = 'SELECT ' .
    				'"orden"."usuacodigos", ' .
    				'count("orden"."usuacodigos") AS "cantidad" ' .
    			'FROM "orden" ' .
    			'WHERE ' .
    				'"orden"."ordefecregd" BETWEEN '.$this->startDate.' AND '.$this->endDate.' '.$this->sbFechDigit.
    				'GROUP BY "orden"."usuacodigos" ORDER BY 1 ASC';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		$this->rcResult = $this->objdb->rcresult;
    }
    
   /**
    * Copyright 2006 FullEngine
    * 
    * Consulta las edades de los contactos ordenedas de mayor a menor
    * solo los que tiene edad.
    * @author creyes <careyes@parquesoft.com>
    * @date 11-July-2006
    * @location Cali-Colombia
    */
    function getAgeoldContact(){
    	$sql = 'SELECT "contedadn" FROM "contacto" WHERE "contedadn" IS NOT NULL ORDER BY 1 ASC';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		$this->rcResult = $this->objdb->rcresult;
    }

    /**
    * Copyright 2006 FullEngine
    * 
    * Consulta las localizaciones por tipo y padre.
    * @author freina <freina@parquesoft.com>
    * @date 28-dec-2006
    * @location Cali-Colombia
    */
    function getLocationByTypeAndFather(){
    	$sql = 'SELECT ' .
    		   		'"locacodigos", ' .
    		   		'"locanombres" ' .
    			'FROM "localizacion" ' .
    		   	'WHERE ' .
    		   		'"locacodpadrs"=\''.$this->location.'\' AND ' .
    		   		'"tilocodigos"=\''.$this->typeLocation.'\' ORDER BY "locacodigos"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		$this->rcResult = $this->objdb->rcresult;
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
    	if($this->TypeCase)
    		$sbTmp = 'AND "ordenempresa"."tiorcodigos" = \''.$this->TypeCase.'\' ';
		$sbTmp .= $this->sbFechDigit;
    	$sql = 'SELECT "tiornombres","locacodigos", COUNT("ordenempresa"."ordenumeros") AS "cantidad" '.
    			'FROM "orden", "ordenempresa","tipoorden" '.
    			'WHERE "orden"."ordefecregd" BETWEEN '.$this->startDate.' AND '.$this->endDate.' '.
    			'AND "orden"."ordenumeros"="ordenempresa"."ordenumeros" ' .
    			'AND "ordenempresa"."tiorcodigos" = "tipoorden"."tiorcodigos" '.
    			$sbTmp.
    			'GROUP BY 1,2 '.
    			'ORDER BY 1,2';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		$this->rcResult = $this->objdb->rcresult;
    }	

    /**
    * Copyright 2008 FullEngine
    * 
    * Consulta las denuncias por locallización
    * @author mrestrepo <mrestrepo@parquesoft.com>
    * @date 14-Mya-2008   11:32AM
    * @location Cali-Colombia
    */
    function getDenunciasPorLocaliza(){
    	if($this->TypeCase)
    		$sbTmp = 'AND "ordenempresa"."tiorcodigos" = \''.$this->TypeCase.'\' ';
		$sbTmp .= $this->sbFechDigit;

    	$sql = 'SELECT "evennombres","causnombres","ordenempresa"."locacodigos","tilocodigos", COUNT("ordenempresa"."ordenumeros") AS "cantidad" '.
    			'FROM "orden", "ordenempresa","evento","causa","tipoorden","localizacion" '.
    			'WHERE "orden"."ordefecregd" BETWEEN '.$this->startDate.' AND '.$this->endDate.' '.
    			'AND "orden"."ordenumeros"="ordenempresa"."ordenumeros" ' .
    			'AND "ordenempresa"."locacodigos" = "localizacion"."locacodigos" '.
    			'AND "ordenempresa"."tiorcodigos" = "tipoorden"."tiorcodigos" '.
    			'AND "ordenempresa"."evencodigos" = "evento"."evencodigos" '.
    			'AND "ordenempresa"."causcodigos" = "causa"."causcodigos" '.
    			'AND "tipoorden"."tiorcodigos" = "evento"."tiorcodigos" '.
    			'AND "tipoorden"."tiorcodigos" = "causa"."tiorcodigos" '.
    			'AND "causa"."evencodigos" = "evento"."evencodigos" '.
    			$sbTmp.
    			'GROUP BY 1,2,3,4 '.
    			'ORDER BY 1,2,3,4';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		$this->rcResult = $this->objdb->rcresult;
    }	

    /**
    * Copyright 2006 FullEngine
    * 
    * Consulta el indicador de satisfacciï¿½n por tipo de caso.
    * @author mrestrepo <mrestrepo@parquesoft.com>
    * @date 11-July-2006
    * @location Cali-Colombia
    */
    function getClientSatisfactionIndicator(){
    	
		$sbTmp .= $this->sbFechDigit;
    	$sql = 'SELECT ' .
    				'"tipoorden"."tiornombres" as "tiornombres", ' .
    				'AVG("respuestausu"."varecodigon") AS "cantidad" ' .
    			'FROM "orden","ordenempresa","respuestausu","tipoorden" '.
    			'WHERE ' .
    				'"orden"."ordefecregd" BETWEEN '.$this->startDate.' AND '.$this->endDate.' AND ' .
    				'"respuestausu"."ordenumeros"="ordenempresa"."ordenumeros" AND ' .
    				'"orden"."ordenumeros"="ordenempresa"."ordenumeros" ' .
    				'AND "tipoorden"."tiorcodigos"="ordenempresa"."tiorcodigos" ' .$sbTmp.
    				' GROUP BY "tipoorden"."tiornombres"'.
    				' ORDER BY 1 ASC';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		$this->rcResult = $this->objdb->rcresult;
    }
    
       /**
    * Copyright 2006 FullEngine
    * 
    * Consulta la cantidad de casos por tarea.
    * @author mrestrepo <mrestrepo@parquesoft.com>
    * @date 31-Ago-2006
    * @location Cali-Colombia
    */
    function getCasesByActa(){
   		   	
    	if($this->Organization)
    		$sbTmp = 'AND "acta"."orgacodigos"=\''.$this->Organization.'\' ';
		
    	$sql = 'SELECT ' .
    				'"tarea"."tarecodigos" as "tarecodigos", ' .
    				'"tarenombres", ' .
    				'count("acta"."ordenumeros") AS "cantidad" ' .
    			'FROM "tarea","acta","activiacta" ' .
    			'WHERE ' .
    				' "tarea"."tarecodigos"="acta"."tarecodigos"'.
    				' AND "activiacta"."actacodigos"="acta"."actacodigos"'.
    				' AND "actafechfinn" BETWEEN '.$this->startDate.' AND '.$this->endDate.' ' .
    				$sbTmp.
    				'GROUP BY "tarea"."tarecodigos","tarenombres" ORDER BY 1 ASC';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		$this->rcResult = $this->objdb->rcresult;
	
    }
    
        /**
    * Copyright 2006 FullEngine
    * 
    * Consulta la cantidad de casos por actividad, agrupado por tarea (para no hacer un query por cada tarea).
    * @author mrestrepo <mrestrepo@parquesoft.com>
    * @date 31-Ago-2006
    * @location Cali-Colombia
    */
    function getCasesByActividad(){
   		if($this->Organization)
    		$sbTmp = 'AND "acta"."orgacodigos"=\''.$this->Organization.'\' ';
		$sbTmp .= $this->sbFechDigit;
    	$sql = 'SELECT "tarecodigos","activiacta"."acticodigos","actinombres",count("acta"."ordenumeros") as "cantidad"'.
				' FROM "acta","actividad","activiacta"'.
				' WHERE "activiacta"."acticodigos"="actividad"."acticodigos"'.
				' AND "activiacta"."actacodigos"="acta"."actacodigos"'.
				' AND "actafechfinn" BETWEEN '.$this->startDate.' AND '.$this->endDate.' '.
				$sbTmp.
				' GROUP BY "tarecodigos","activiacta"."acticodigos","actinombres"'.
				' ORDER BY 3 ASC';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		$this->rcResult = $this->objdb->rcresult;
	
    }

	/**
    * Copyright 2009 FullEngine
    * 
    * Consulta el log de rotaciones
    * @author mrestrepo <mrestrepo@parquesoft.com>
    * @date 12-March-2009
    * @location Cali-Colombia
	* oldorgacodigos, neworgacodigos, neworganombres, oldorgacodpads, neworgacodpads, 
	* ordenestopadres, ordenesneworgs, logrfechorregn, authusernames
    */
    function getLogRotacion(){
    	
    	$sql = 'SELECT ' .
    				'* ' .
    			'FROM "logrotacion" '.
    			'WHERE ' .
    				'"logrfechorregn" BETWEEN '.$this->startDate.' AND '.$this->endDate;
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		$this->rcResult = $this->objdb->rcresult;
    }
}
?>