<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeCrPgsqlDetailPursuit {
	var $consult;
	var $objdb;
	var $rcTask;
	var $blAgrupar;

	function FeCrPgsqlDetailPursuit() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Modifica el atributo rcTask en el cual se almacena los tipos de casos 
	* 	que no deben presentarse en el consolidado 
	*   @author freina
	*	@param array $rcTask Arreglo con los tipos de caso.
	*   @date 03-Aug-2006 17:58
	*   @location Cali-Colombia
	*/
	function setTask($rcTask){
		$this->rcTask = $rcTask;
	}
	
	/**
    * Copyright 2006 FullEngine
    * 
    * Consulta los tipos de requerimiento y retorna un arreglo con indices aosciativos, 
    * @author freina<freina@parquesoft.com>
    * @return array $rcResult array con indices aosciativos
    * con el indice como el codigo del tipo y el nombre como el valor
    * @date 16-Aug-2005 13:29
    * @location Cali-Colombia
    */
    function getAllTipoorden(){
    	
    	settype($rcResult,"array");
    	settype($rcTmp,"array");
    	settype($sbSql,"string");
    	
        $sbSql = "SELECT * FROM tipoorden  ORDER BY tiornombres";
		$this->objdb->fncadosetmodefetch(FETCH_ASSOC);
		$this->objdb->fncadoexecute($sbSql);
		if (!$this->objdb->objresult)
			return null;
		while (!$this->objdb->objresult->EOF) {
			$rcTmp = $this->objdb->fncadofetch();
			$this->objdb->fncadomovenext();
			$rcResult[$rcTmp["tiorcodigos"]] = $rcTmp["tiornombres"];
		}
        return $rcResult;
    }
    
        /**
    * Copyright 2005 FullEngine
    * 
    * Consulta la cantidad de requeriminetos por dependencia
    * @author creyes
    * @param int $fechini fecha inicial
    * @param int $fechfin fecha final
    * @return array
    * @date 9-August-2005 16:4:42
    * @location Cali-Colombia
    */
    function getReqByDepByTipoDesagregadoPorDep($fechini,$fechfin,$orgacodigos){
    	
    	settype($objService,"object");
    	settype($sbTmp,"string");
    	
    	if($this->blAgrupar==true) {
        	$objService = Application::loadServices('Human_resources');
    		$rcEqui = $objService->getPhysicaldependencies();
    	}
        if(!is_array($rcEqui))
            $rcEqui = array();
           
        //SÓLO PARA CVC Y SUS DEPENDENCIAS BASE (DAR - BRUTS)
    	$rcEqui = $this->orderDependenciasBase($rcEqui);
    	$rcEqui = $rcEqui[$orgacodigos];
		
		//Consulta los entes organizacionales
        $sql = 'SELECT orgacodigos,organombres FROM organizacion';
		$this->objdb->fncadosetmodefetch(FETCH_ASSOC);
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			return null;
		while (!$this->objdb->objresult->EOF) {
			$rcTmp = $this->objdb->fncadofetch();
			$this->objdb->fncadomovenext();
			$rcOrganizacion[$rcTmp['orgacodigos']] = $rcTmp['organombres'];
		}
		
		
		
        $sbSql = "SELECT ordenempresa.orgacodigos,organizacion.organombres," .
        		"tipoorden.tiorcodigos,tipoorden.tiornombres,count(tipoorden.tiorcodigos) AS cantidad" .
        		" FROM orden, ordenempresa, organizacion, tipoorden,acta,actaempresa,compromiso,acemcompromi" .
        		" WHERE orden.ordefecregd BETWEEN ".$fechini." AND ".$fechfin.
				" AND orden.ordenumeros=ordenempresa.ordenumeros ".
				" AND acta.ordenumeros=ordenempresa.ordenumeros ".
				'AND "acta"."actacodigos"="actaempresa"."actacodigos" '.
				'AND "acemcompromi"."acemcodigos"="actaempresa"."acemnumeros" '.
				'AND "acemcompromi"."compcodigos"="compromiso"."compcodigos" '.
        		$sbSubSql .
        		" AND orden.ordenumeros = ordenempresa.ordenumeros " . 
        		" AND ordenempresa.orgacodigos=organizacion.orgacodigos " .
        		" AND ordenempresa.tiorcodigos = tipoorden.tiorcodigos " .
        		" GROUP BY 1, 2, 3, 4" .
        		" ORDER BY 2, 3";
                
		$this->objdb->fncadosetmodefetch(FETCH_ASSOC);
		$this->objdb->fncadoexecute($sbSql);
		if (!$this->objdb->objresult)
			return null;
		while (!$this->objdb->objresult->EOF) {
			$rcTmp = $this->objdb->fncadofetch();
			$this->objdb->fncadomovenext();
			$rcTmp["orgacodigos"] = (string) $rcTmp["orgacodigos"];
			if(in_array($rcTmp["orgacodigos"],$rcEqui)) {
	            $rcArray = $rcReturn[$rcTmp['orgacodigos']]; 
	            if(!$rcArray[$rcTmp['tiorcodigos']]){
	            	$rcArray[$rcTmp['tiorcodigos']] = array('nombre' => $rcTmp['tiornombres'],'cantidad' => $rcTmp['cantidad']);
	            }else{
	            	$rcArray[$rcTmp['tiorcodigos']]['cantidad'] += $rcTmp['cantidad'];
	            }
	            $rcArray['total'] += $rcTmp['cantidad'];
	            $rcArray['organombres'] = $rcOrganizacion[$rcTmp['orgacodigos']];
	            $todas += $rcTmp['cantidad'];
	            $rcTotalByDep[$rcTmp['tiorcodigos']] += $rcTmp['cantidad']; 
	            $rcReturn[$rcTmp['orgacodigos']] = $rcArray;
			}
		}
		if(!is_array($rcReturn))
            return null;
            
        //Calcula los porcentajes
        foreach($rcReturn as $orgacodigos => $rcTmp){
            $total = $rcTmp['total'];
            $organombre = $rcTmp['organombres'];
            unset($rcTmp['total']);
            unset($rcTmp['organombres']);
            unset($rcSalidaTipos);
            foreach($rcTmp as $tipo => $rcTipos){
            	
                //% del tipo en la dependencia
                $rcTipos['tipxdep'] = ($rcTipos['cantidad'] * 100) / $total;
                $rcTipos['tipxdep'] = number_format($rcTipos['tipxdep'],2,',',".");
                
                //% del tipo en la corporacion ocurridas en la dependencia
                $rcTipos['topxcorpxdep'] = ($rcTipos['cantidad'] * 100) / $rcTotalByDep[$tipo];
                $rcTipos['topxcorpxdep'] = number_format($rcTipos['topxcorpxdep'],2,',',".");
                $rcSalidaTipos[$tipo] = $rcTipos; 
            }
            // Rearma el vector de los tipos
            $rcSalidaTipos['total'] = $total; 
            $rcSalidaTipos['organombres'] = $organombre;
            
            //% de la dependencia con respecto a toda la corpaoracion
            $rcSalidaTipos['depxcorp'] = ($total * 100) / $todas;
            $rcSalidaTipos['depxcorp'] = number_format($rcSalidaTipos['depxcorp'],2,',',".");
            $rcSalidaOrganiza[$orgacodigos] = $rcSalidaTipos;
            
        }
        unset($rcTmp);
        
        //% total de los tipo con respectos al total de la corporacion
        foreach($rcTotalByDep as $tipo => $valor){
            $rcTmp[$tipo]['valor'] = $valor;
            $rcTmp[$tipo]['procentaje'] = number_format((($valor * 100) / $todas),2,',',".");
        }
        $rcSalidaOrganiza['totalxdep'] = $rcTmp;
        $rcSalidaOrganiza['todas'] = $todas;
        unset($rcReturn);
        return $rcSalidaOrganiza;
    }
    /**
    * Copyright 2005 FullEngine
    * 
    * Consulta la cantidad de requeriminetos por dependencia
    * @author creyes
    * @param int $fechini fecha inicial
    * @param int $fechfin fecha final
    * @return array
    * @date 9-August-2005 16:4:42
    * @location Cali-Colombia
    */
    function getReqByDepByTipo($fechini,$fechfin){
    	
    	settype($objService,"object");
    	settype($sbTmp,"string");
    	settype($sbSql,"string");
    	settype($sbSubSql,"string");
    	
    	if($this->blAgrupar==true) {
	        $objService = Application::loadServices('Human_resources');
	    	$rcEqui = $objService->getPhysicaldependencies();
    	}
        if(!is_array($rcEqui))
            $rcEqui = array();
		
		//Consulta los entes organizacionales
        $sql = 'SELECT orgacodigos,organombres FROM organizacion';
		$this->objdb->fncadosetmodefetch(FETCH_ASSOC);
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			return null;
		while (!$this->objdb->objresult->EOF) {
			$rcTmp = $this->objdb->fncadofetch();
			$this->objdb->fncadomovenext();
			$rcOrganizacion[$rcTmp['orgacodigos']] = $rcTmp['organombres'];
		}
		
        $sbSql = "SELECT ordenempresa.orgacodigos,organizacion.organombres," .
        		"tipoorden.tiorcodigos,tipoorden.tiornombres,count(tipoorden.tiorcodigos) AS cantidad" .
        		" FROM orden, ordenempresa, organizacion, tipoorden,acta,actaempresa,compromiso,acemcompromi" .
        		" WHERE orden.ordefecregd BETWEEN ".$fechini." AND ".$fechfin.
				" AND orden.ordenumeros=ordenempresa.ordenumeros ".
        		$sbSubSql .
        		" AND acta.ordenumeros=ordenempresa.ordenumeros ".
				'AND "acta"."actacodigos"="actaempresa"."actacodigos" '.
				'AND "acemcompromi"."acemcodigos"="actaempresa"."acemnumeros" '.
				'AND "acemcompromi"."compcodigos"="compromiso"."compcodigos" '.
        		" AND orden.ordenumeros = ordenempresa.ordenumeros " . 
        		" AND ordenempresa.orgacodigos=organizacion.orgacodigos " .
        		" AND ordenempresa.tiorcodigos = tipoorden.tiorcodigos " .
        		" GROUP BY 1, 2, 3, 4" .
        		" ORDER BY 2, 3";
                
		$this->objdb->fncadosetmodefetch(FETCH_ASSOC);
		$this->objdb->fncadoexecute($sbSql);
		if (!$this->objdb->objresult)
			return null;
		while (!$this->objdb->objresult->EOF) {
			$rcTmp = $this->objdb->fncadofetch();
			$this->objdb->fncadomovenext();
			
            //Ejecuta la equivalencia
            $newDep = $rcEqui[$rcTmp['orgacodigos']];
            if($newDep)
                $rcTmp['orgacodigos'] = $newDep;
            
            $rcArray = $rcReturn[$rcTmp['orgacodigos']]; 
            if(!$rcArray[$rcTmp['tiorcodigos']]){
            	$rcArray[$rcTmp['tiorcodigos']] = array('nombre' => $rcTmp['tiornombres'],'cantidad' => $rcTmp['cantidad']);
            }else{
            	$rcArray[$rcTmp['tiorcodigos']]['cantidad'] += $rcTmp['cantidad'];
            }
            $rcArray['total'] += $rcTmp['cantidad'];
            $rcArray['organombres'] = $rcOrganizacion[$rcTmp['orgacodigos']];
            $todas += $rcTmp['cantidad'];
            $rcTotalByDep[$rcTmp['tiorcodigos']] += $rcTmp['cantidad']; 
            $rcReturn[$rcTmp['orgacodigos']] = $rcArray;
		}
        if(!is_array($rcReturn))
            return null;
            
        //Calcula los porcentajes
        foreach($rcReturn as $orgacodigos => $rcTmp){
            $total = $rcTmp['total'];
            $organombre = $rcTmp['organombres'];
            unset($rcTmp['total']);
            unset($rcTmp['organombres']);
            unset($rcSalidaTipos);
            foreach($rcTmp as $tipo => $rcTipos)
            {
                //% del tipo en la dependencia
                $rcTipos['tipxdep'] = ($rcTipos['cantidad'] * 100) / $total;
                $rcTipos['tipxdep'] = number_format($rcTipos['tipxdep'],2,',',".");
                
                //% del tipo en la corporacion ocurridas en la dependencia
                $rcTipos['topxcorpxdep'] = ($rcTipos['cantidad'] * 100) / $rcTotalByDep[$tipo];
                $rcTipos['topxcorpxdep'] = number_format($rcTipos['topxcorpxdep'],2,',',".");
                
                //print_r($rcTipos);
                $rcSalidaTipos[$tipo] = $rcTipos; 
            }
            // Rearma el vector de los tipos
            $rcSalidaTipos['total'] = $total; 
            $rcSalidaTipos['organombres'] = $organombre;
            
            //% de la dependencia con respecto a toda la corpaoracion
            $rcSalidaTipos['depxcorp'] = ($total * 100) / $todas;
            $rcSalidaTipos['depxcorp'] = number_format($rcSalidaTipos['depxcorp'],2,',',".");
            $rcSalidaOrganiza[$orgacodigos] = $rcSalidaTipos;
            
        }
        unset($rcTmp);
        
        //% total de los tipo con respectos al total de la corporacion
        foreach($rcTotalByDep as $tipo => $valor){
            $rcTmp[$tipo]['valor'] = $valor;
            $rcTmp[$tipo]['procentaje'] = number_format((($valor * 100) / $todas),2,',',".");
        }
        $rcSalidaOrganiza['totalxdep'] = $rcTmp;
        $rcSalidaOrganiza['todas'] = $todas;
        unset($rcReturn);
        return $rcSalidaOrganiza;
    }
	/**
    * Copyright 2005 FullEngine
    *
    * Consulta el reporte de requerimientos por todos los estados
    * @author creyes
    * @param type name desc
    * @return type name desc
    * @date 12-August-2005 14:24:10
    * @location Cali-Colombia
    */
    function getReqByEstado($fechini, $fechfin){
    	
    	settype($objService,"object");
    	settype($sbTmp,"string");
    	
        $objService = Application::loadServices('Human_resources');
    	$rcEqui = $objService->getPhysicaldependencies();
        if(!is_array($rcEqui))
            $rcEqui = array();

		//Consulta los entes organizacionales
        $sql = 'SELECT orgacodigos,organombres FROM organizacion';
		$this->objdb->fncadosetmodefetch(FETCH_ASSOC);
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			return null;
		while (!$this->objdb->objresult->EOF) {
			$rcTmp = $this->objdb->fncadofetch();
			$this->objdb->fncadomovenext();
			$rcOrganizacion[$rcTmp['orgacodigos']] = $rcTmp['organombres'];
		}
		
		$servceDate = Application :: loadServices("DateController");
        $hoy = (int) $servceDate->fncintdate();
        $sql = "SELECT 
                    organizacion.orgacodigos, 
                    organizacion.organombres, 
                    estadoacta.esaccodigos, 
                    estadoacta.esacnombres, 
                    orden.ordefecvend, 
                    orden.ordefecfinad, 
                    ((86399 + orden.ordefecvend) - orden.ordefecfinad) AS vencimiento 
                FROM orden, ordenempresa, acta, organizacion, estadoacta 
                WHERE orden.ordefecregd BETWEEN $fechini AND $fechfin " .
                    " AND orden.ordenumeros  = ordenempresa.ordenumeros " . 
                    $sbSubSql .
                    " AND ordenempresa.orgacodigos  = organizacion.orgacodigos " .
                    " AND ordenempresa.ordenumeros  = acta.ordenumeros " .
                    " AND acta.actaestacts  = estadoacta.esaccodigos " .
                    " ORDER BY organizacion.organombres asc, estadoacta.esacnombres asc ";
		$this->objdb->fncadosetmodefetch(FETCH_ASSOC);
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			return null;
		while (!$this->objdb->objresult->EOF) {
			$rcTmp = $this->objdb->fncadofetch();
			$this->objdb->fncadomovenext();
			
            //Ejecuta la equivalencia
            $newDep = $rcEqui[$rcTmp['orgacodigos']];
            if($newDep)
                $rcTmp['orgacodigos'] = $newDep;
            
            //Verifica si es finalizado y calcula el tiempo
            if(!$rcTmp['ordefecfinad']){
                $rcTmp['vencimiento'] = $rcTmp['ordefecvend'] - $hoy;
            }
            $rcArray = $rcReturn[$rcTmp['orgacodigos']];
            $rcArray['organombres'] = $rcOrganizacion[$rcTmp['orgacodigos']];//$rcTmp['organombres'];
            $rcEstado = $rcArray[$rcTmp['esaccodigos']];
            if($rcTmp['vencimiento'] >= 0){
                $rcEstado['in'] += 1;
                $rcTotalDiscEst[$rcTmp['esaccodigos']]['in'] += 1;
            }
            else{
                $rcEstado['out'] += 1;
                $rcTotalDiscEst[$rcTmp['esaccodigos']]['out'] += 1;
            }
            $rcArray['totalDep'] += 1;
            $rcArray[$rcTmp['esaccodigos']] = $rcEstado;
            $rcReturn[$rcTmp['orgacodigos']] = $rcArray;
            $rcTotalEstado[$rcTmp['esaccodigos']] += 1;
            $total += 1; 
		}
        if(!is_array($rcReturn))
            return null;
            
        //Calcula los porcentajes por dependencia
        foreach($rcReturn as $orgacodigos => $rcTmp){
            $organombres = $rcTmp['organombres'];
            $totalDep = $rcTmp['totalDep'];
            unset($rcTmp['organombres'], $rcTmp['totalDep']);
            foreach($rcTmp as $estado => $rcValues){
                foreach($rcValues as $key => $value){
                    $rcValuesTmp[$key]['value'] = $value;
                    if($totalDep){
                    	$rcValuesTmp[$key]['up'] = number_format((($value * 100) / $totalDep),2,',','.');
                    }else{
                    	$rcValuesTmp[$key]['up'] = 0;
                    }
                    if($rcTotalDiscEst[$estado][$key]){
                    	$rcValuesTmp[$key]['down'] = number_format((($value * 100) / $rcTotalDiscEst[$estado][$key]),2,',','.');
                    }else{
                    	$rcValuesTmp[$key]['down'] = 0;
                    }
                }
                $rcTmp[$estado] = $rcValuesTmp;
                unset($rcValuesTmp);
            }
            $rcTmp['organombres'] = $organombres;
            $rcTmp['totalDep'] = $totalDep;
            
            //Calcula la participacion de la dependencia
            $rcTmp['porctotalDep'] = number_format((($totalDep * 100) / $total),2,',','.');
            $rcReturn[$orgacodigos] = $rcTmp;
        }
        unset($rcValuesTmp, $rcValues);
        //calcula los porcentajes por estado
        foreach($rcTotalEstado as $estado => $valor){
            $rcValues[$estado]['valor'] = $valor;
            $rcValues[$estado]['porcentaje'] = number_format((($valor * 100) / $total),2,',','.');
            $valin = $rcTotalDiscEst[$estado]['in'];
            $valout = $rcTotalDiscEst[$estado]['out'];
            $rcTotalDisc[$estado]['in'] = array('total' => $valin, 'porcentaje' => number_format((($valin * 100) / $total),2,',','.'));
            $rcTotalDisc[$estado]['out'] = array('total' => $valout, 'porcentaje' => number_format((($valout * 100) / $total),2,',','.'));
        }
        unset($rcTotalEstado);
        $rcReturn['totalestado'] = $rcValues;
        $rcReturn['totalestadodisc'] = $rcTotalDisc;
        $rcReturn['total'] = $total;
        return $rcReturn;
    }
    
    /**
    * Copyright 2005 FullEngine
    * 
    * Consulta todos los eventos de un tipo de orden de retornando un array 
    * con indices aosciativos con el indice como el codigo del tipo concatenado 
    * con el codigo del evento y el nombre del evento como el valor
    * @author creyes
    * @return array name array con indices aosciativos
    * con el indice como el codigo del tipo y el nombre como el valor
    * @date 9-August-2005 14:16:38
    * @location Cali-Colombia
    */
    function getEventoByTipoorden($tiorcodigos){
        $sbSql = "SELECT 
                            evento.evencodigos, 
                            evento.evennombres, 
                            causa.causcodigos, 
                            causa.causnombres 
                        FROM 
                            evento left join causa on (evento.tiorcodigos=causa.tiorcodigos AND 
                                                       evento.evencodigos=causa.evencodigos) 
                        WHERE evento.tiorcodigos='$tiorcodigos'";
		$this->objdb->fncadosetmodefetch(FETCH_ASSOC);
		$this->objdb->fncadoexecute($sbSql);
		if (!$this->objdb->objresult)
			return null;
		while (!$this->objdb->objresult->EOF) {
			$rcTmp = $this->objdb->fncadofetch();
			$this->objdb->fncadomovenext();
            $rcArray = $rcReturn[$tiorcodigos.$rcTmp["evencodigos"]];
            $rcArray['nombre'] = $rcTmp["evennombres"];
            if($rcTmp["causcodigos"]){
                $rcCausas = $rcArray['causas'];
                $rcCausas[$tiorcodigos.$rcTmp["evencodigos"].$rcTmp["causcodigos"]] = $rcTmp["causnombres"];
                $rcArray['causas'] = $rcCausas;
            }
            $rcReturn[$tiorcodigos.$rcTmp["evencodigos"]] = $rcArray;
		}
        return $rcReturn;
    }
    /**
    * Copyright 2005 FullEngine
    * 
    * Consulta la cantidad de requerimientos en las dependecia por evento
    * en determinado tipo de requerimiento y rango de fechas
    * @author creyes
    * @param string $tiorcodigos desc
    * @param string $fechini desc
    * @param string $fechfin desc
    * @return array
    * @date 10-August-2005 16:34:3
    * @location Cali-Colombia
    */
    function getReqByEvento($tiorcodigos,$fechini,$fechfin){
        $objService = Application::loadServices('Human_resources');
    	$rcEqui = $objService->getPhysicaldependencies();
        if(!is_array($rcEqui))
            $rcEqui = array();
            
		//Consulta los entes organizacionales
        $sql = 'SELECT orgacodigos,organombres FROM organizacion';
		$this->objdb->fncadosetmodefetch(FETCH_ASSOC);
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			return null;
		while (!$this->objdb->objresult->EOF) {
			$rcTmp = $this->objdb->fncadofetch();
			$this->objdb->fncadomovenext();
			$rcOrganizacion[$rcTmp['orgacodigos']] = $rcTmp['organombres'];
		}
            
        $sbSql = "SELECT 
                    organizacion.orgacodigos, 
                    organizacion.organombres,
                    evento.evencodigos,
                    evento.evennombres, 
                    count(ordenempresa.evencodigos) AS cantidad
                FROM orden,ordenempresa,organizacion,evento,acta,actaempresa,compromiso,acemcompromi  
                WHERE 
                    orden.ordefecregd BETWEEN $fechini AND $fechfin AND 
                    orden.ordenumeros = ordenempresa.ordenumeros AND 
                    acta.ordenumeros = ordenempresa.ordenumeros AND 
                    ordenempresa.tiorcodigos = '$tiorcodigos' " .
                    "AND ordenempresa.orgacodigos = organizacion.orgacodigos " .
                    " AND ordenempresa.tiorcodigos  = evento.tiorcodigos " .
                    'AND "acta"."actacodigos"="actaempresa"."actacodigos" '.
					'AND "acemcompromi"."acemcodigos"="actaempresa"."acemnumeros" '.
					'AND "acemcompromi"."compcodigos"="compromiso"."compcodigos" '.
					" AND ordenempresa.evencodigos  = evento.evencodigos 
                GROUP BY 1, 2, 3, 4
                ORDER  BY organizacion.organombres asc ";
		$this->objdb->fncadosetmodefetch(FETCH_ASSOC);
		$this->objdb->fncadoexecute($sbSql);
		if (!$this->objdb->objresult)
			return null;
		while (!$this->objdb->objresult->EOF) {
			$rcTmp = $this->objdb->fncadofetch();
			$this->objdb->fncadomovenext();
			
            //Ejecuta la equivalencia
            $newDep = $rcEqui[$rcTmp['orgacodigos']];
            if($newDep)
                $rcTmp['orgacodigos'] = $newDep;
            
            $rcArray = $rcReturn[$rcTmp['orgacodigos']];
            
            //Acumula la cantidad por evento y su nombre
            if(!$rcArray[$tiorcodigos.$rcTmp['evencodigos']]){
            	$rcArray[$tiorcodigos.$rcTmp['evencodigos']] = array('nombre' => $rcTmp['evennombres'],'cantidad' => $rcTmp['cantidad']);
            }else{
            	$rcArray[$tiorcodigos.$rcTmp['evencodigos']]['cantidad'] += $rcTmp['cantidad'];
            }
            //Cantidad atendida por dependencia
			$rcArray['totalxdep'] += $rcTmp['cantidad'];
			
            //Cantidad de requerimientos por evento
            $rcReqByEven[$tiorcodigos.$rcTmp['evencodigos']] += $rcTmp['cantidad'];
            
            //Cantidad atendida por la corporacion
            $total += $rcTmp['cantidad'];
            $rcArray['organombres'] = $rcOrganizacion[$rcTmp['orgacodigos']]; //$rcTmp['organombres'];
            $rcReturn[$rcTmp['orgacodigos']] = $rcArray;
		}
        if(!is_array($rcReturn))
            return null;
            
        //Calcula los porcentajes
        foreach($rcReturn as $orgacodigos => $rcData){
            $totalDep = $rcData['totalxdep'];
            $organombres = $rcData['organombres'];
            unset($rcData['totalxdep'], $rcData['organombres']);
            foreach($rcData as $evencodigos => $rcEventos){
                $rcEventos['porcentaje'] = ($rcEventos['cantidad'] * 100) / $rcReqByEven[$evencodigos];
                $rcEventos['porcentaje'] = number_format($rcEventos['porcentaje'],2,',','.');
                $rcData[$evencodigos] = $rcEventos;
            }
            $rcData['porcxdep'] = number_format((($totalDep * 100) / $total),2,',','.');
            $rcData['totalxdep'] = $totalDep;
            $rcData['organombres'] = $organombres;
            $rcReturn[$orgacodigos] = $rcData;
            
        }
        unset($rcTmp);
        
        //Calcula lo prcentajes por evento con respecto a toda la coporacion
        foreach($rcReqByEven as $evento => $valor){
            $rcTmp[$evento]['valor'] = $valor;
            $rcTmp[$evento]['porcentaje'] = number_format((($valor * 100) / $total),2,',','.');
        }
        unset($rcReqByEven);
        $rcReturn = array('consulta'=>$rcReturn,'todas' => $total, 'totalxeven' => $rcTmp);
        return $rcReturn;
    }
    
    /**
    * Copyright 2005 FullEngine
    *
    * Consulta la cantidad de requerimientos en las dependencia
    * discriminandolos por causa
    * @author creyes
    * @param string $tiorcodigos desc
    * @param string $fechini desc
    * @param string $fechfin desc
    * @return array
    * @date 11-August-2005 9:25:55
    * @location Cali-Colombia
    */
    function getReqByCausa($tiorcodigos,$fechini,$fechfin){
        $objService = Application::loadServices('Human_resources');
    	$rcEqui = $objService->getPhysicaldependencies();
        if(!is_array($rcEqui))
            $rcEqui = array();
        $sbSql = "SELECT 
                        organizacion.orgacodigos, 
                        organizacion.organombres, 
                        evento.evencodigos, 
                        evento.evennombres, 
                        causa.causcodigos, 
                        causa.causnombres, 
                        count(ordenempresa.causcodigos) AS cantidad 
                    FROM orden,ordenempresa,organizacion,evento,causa,acta,actaempresa,compromiso,acemcompromi  
                    WHERE 
                        orden.ordefecregd BETWEEN $fechini AND $fechfin AND 
                        orden.ordenumeros = ordenempresa.ordenumeros AND 
                        acta.ordenumeros = ordenempresa.ordenumeros AND 
                        ordenempresa.tiorcodigos = '$tiorcodigos' " .
                        "AND ordenempresa.orgacodigos = organizacion.orgacodigos AND 
                        ordenempresa.tiorcodigos = evento.tiorcodigos AND 
                        ordenempresa.evencodigos = evento.evencodigos AND 
                        ordenempresa.tiorcodigos = causa.tiorcodigos AND 
                        ordenempresa.evencodigos = causa.evencodigos AND 
                        ordenempresa.causcodigos  = causa.causcodigos ".
                        'AND "acta"."actacodigos"="actaempresa"."actacodigos" '.
						'AND "acemcompromi"."acemcodigos"="actaempresa"."acemnumeros" '.
						'AND "acemcompromi"."compcodigos"="compromiso"."compcodigos" '.
                    'GROUP BY 1, 2, 3, 4, 5, 6 
                    ORDER BY organizacion.organombres asc, evento.evennombres asc';
		$this->objdb->fncadosetmodefetch(FETCH_ASSOC);
		$this->objdb->fncadoexecute($sbSql);
		if (!$this->objdb->objresult)
			return null;
		while (!$this->objdb->objresult->EOF) {
			$rcTmp = $this->objdb->fncadofetch();
			$this->objdb->fncadomovenext();
			
            //Ejecuta la equivalencia
            $newDep = $rcEqui[$rcTmp['orgacodigos']];
            if($newDep)
                $rcTmp['orgacodigos'] = $newDep;
            
            $rcArray = $rcReturn[$rcTmp['orgacodigos']];
            $rcCausas = $rcArray[$tiorcodigos.$rcTmp['evencodigos']];
            $rcCausas[$tiorcodigos.$rcTmp['evencodigos'].$rcTmp['causcodigos']]['nombre'] = $rcTmp['causnombres'];
            $rcCausas[$tiorcodigos.$rcTmp['evencodigos'].$rcTmp['causcodigos']]['cantidad'] += $rcTmp['cantidad'];
            $rcTotalCausa[$tiorcodigos.$rcTmp['evencodigos'].$rcTmp['causcodigos']] += $rcTmp['cantidad'];
            $rcArray[$tiorcodigos.$rcTmp['evencodigos']] = $rcCausas;
			$rcReturn[$rcTmp['orgacodigos']] = $rcArray;
		}
        //Calcula los porcentajes por causa
        return array('causas' => $rcReturn, 'totales' => $rcTotalCausa);
    }
    
    function orderDependenciasBase($rcEqui) {
    	settype($rcReturn,"array");
    	foreach ($rcEqui as $key=>$value){
    		$key = (string) $key;
    		$rcReturn[$value][] = $key;
    	}
    	return $rcReturn;
    }
} //End of Class Detallado
?>