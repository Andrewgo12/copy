<?php 
class FeGeDimensionManager {
	function FeGeDimensionManager() 
	{
		//Carga la gateway
		$this->gateWay = Application :: getDataGateway('dimension');
        //prefijo para la tabla temporal
        $this->tmpTable = 'dimension_';
        $this->_flagOp = false;
	}
    
    function setCodidominios ($codidominios){
        $this->codidominios = $codidominios;
    }
    function setCodidomicams ($codidomicams){
        $this->codidomicams = $codidomicams;
    }
    function setCodidomivals ($codidomivals){
        $this->codidomivals = $codidomivals;
    }
    function setVadidominios ($vadidominios){
        $this->vadidominios = $vadidominios;
    }
    function setVadidomivals ($vadidomivals){
        $this->vadidomivals = $vadidomivals;
    }
    function setOperation ($operation){
        $this->operation = $operation;
    }
    function setRcValDimension ($rcValDimension){
        $this->rcValDimension = $rcValDimension;
    }
    function getCodDimension(){
        return $this->codDimension;
    }
    function getValorDimension(){
        return $this->valorDomension;
    }
    function setCodDimension($idDimension){
    	$this->_rcCodDimension[] = $idDimension;
    }
    function setIdProcess($idProcess){
        $this->idProcess = $idProcess;
        $this->tmpTable .= $idProcess;
    }
    function setData($rcData){
    	$this->rcData = $rcData;
    }
    function getData(){
    	return $this->rcData;
    }
    function getError(){
    	return $this->_rcError;
    }
    function getResult(){
        return $this->result;
    }
    function getTmpTable(){
        return $this->tmpTable;
    }
    function getDetalleDimension(){
        return $this->rcDetalleDimension;
    }
    function getRcDimentions(){
        return $this->_rcCodDimension;
    }
    function getReference(){
        return $this->_rcReference;
    }
    function setParams($rcParams){
        $this->rcParams = $rcParams;
    }
    /**
    * Copyright 2006 FullEngine
    * 
    * Define la dimension adicional segï¿½n la configuracion
    * @author creyes
    * @param type name desc
    * @return type name desc
    * @date 20-February-2006 15:28:37
    * @location Cali-Colombia
    */
    function _evalDimension(){
        if(!is_array($this->_rcOptDimensionConfig)){
            return true;
        }
        //Hacer aqui codigos que evalue el caso de los xml (campos: codireglas y codiexclusis)
        if(!is_array($this->_rcOptDimensionConfig))
            return false;
            
        $this->SbXmlInformation = "CONFIGRULE";
        $this->_flagOp = true;
        foreach($this->_rcOptDimensionConfig as $key => $rcConfigDimension){
            if($rcConfigDimension['codireglas']){
                $this->SbIndexField = $key;
   				$this->_xmlTransform();
   				$result = $this->_evalSource();
                if($result == true){
                    $this->_rcCodDimension['adicional'] = $rcConfigDimension['dimecodigon'];
                    $this->_flagOp = false;
                    return true;
                }
            }
        }
        //$this->_rcCodDimension['adicional'] = $this->_rcOptDimensionConfig[0]['dimecodigon'];
        unset($this->_rcOptDimensionConfig);
        $this->_flagOp = false;
        return true;
    }
    /**
    * Copyright 2006 FullEngine
    * 
    * Formatea la consulta del valor de las dimensiones
    * @author creyes
    * @param type name desc
    * @return type name desc
    * @date 20-February-2006 17:36:8
    * @location Cali-Colombia
    */
    function _formatValorDimension(){
        if(!is_array($this->_valorDimension))
            return false;
        foreach($this->_valorDimension as $rcField){
            $this->valorDimension[$rcField['dimenombres']] = $rcField['vadivalors'];
        }
    }
    /**
    * Copyright 2006 FullEngine
    * 
    * Implementa la fabrica de consultas sobre el objeto
    * @author creyes
    * @param type name desc
    * @return type name desc
    * @date 20-February-2006 15:0:11
    * @location Cali-Colombia
    */
    function execute()
    {
        if(!$this->operation || !$this->idProcess)
            return false;
        $operation = "_".$this->operation;
        $this->result = $this->$operation();
        return $this->result;
    }
    /**
    * Copyright 2006 FullEngine
    * 
    * Los valores de una dimension
    * @author creyes
    * @param type name desc
    * @return type name desc
    * @date 20-February-2006 14:35:18
    * @location Cali-Colombia
    */
    function _getValorDimension(){
        if(!$this->codidominios){
            $this->valorDomension = null;
            return false;
        }
        //Encuentra las dimensiones para la situacion
        $this->_findDimensions();
        if(!is_array($this->_rcCodDimension)){
            return false;
        }

        //Carga los campos de la dimension
        $this->_getDetalleDimensionById();

        if(!is_array($this->rcDetalleDimension))
            return false;
        
        //Arma la tabla temporal
        $result = $this->gateWay->doTmpTable($this->tmpTable,$this->rcDetalleDimension);
        if(!$result)
            return false;
        
        //Carga los datos de los campos referenciados
        $this->_getDataReferenceField();

        //Vacea los datos a la tabla temporal
        return $this->gateWay->loadDataIntoTmp($this->rcDetalleDimension,$this->tmpTable,$this->_rcReference,$this->_rcCodDimension,$this->vadidominios,$this->vadidomivals);
    }
    
    /**
    * Copyright 2006 FullEngine
    * 
    * Obtiene los codigos de las dimensiones 
    * que se deben aplaicar a la situacion, 
    * tanto la generica como la adicional
    * @author creyes
    * @param type name desc
    * @return type name desc
    * @date 22-February-2006 15:48:45
    * @location Cali-Colombia
    */
    function _findDimensions(){
        //Obtiene el registro para la configuracion generica
        $rcTmpGeneric = $this->gateWay->getConfigDimension($this->codidominios);
        if(is_array($rcTmpGeneric)){
            $this->_rcCodDimension['generic'] = $rcTmpGeneric[0]['dimecodigon'];
            unset($rcTmpGeneric);
        }
        //Obtiene el(las) configuraciones de la(s) posibles dimensiones
        $this->_rcOptDimensionConfig = $this->gateWay->getConfigDimension($this->codidominios,$this->codidomicams,$this->codidomivals);
        $this->_evalDimension();
    }
    
    /**
    * Copyright 2006 FullEngine
    * 
    * Obtiene los detalles de la(s) dimension(es)  
    * dadas por los parámetros de entorno
    * @author mrestrepo
    * @return array con los detalles o metadatos
    * @date 01-March-2006 13:01:41
    * @location Cali-Colombia
    */
    function _getDetallesDimension()
    {
        if(!$this->codidominios)
        {
            $this->valorDomension = null;
            return false;
        }
        //Encuentra las dimensiones para la situacion
        $this->_findDimensions();
        
        if(!is_array($this->_rcCodDimension))
            return false;
        
        //Carga los campos de la dimension
        $this->_getDetalleDimensionById();

        if(!is_array($this->rcDetalleDimension))
            return false;
        return true;
    }
    /**
    * Copyright 2006 FullEngine
    * 
    * Obtiene la estructura de las dimensiones
    * @author freina<freina@parquesoft.com>
    * @return array $ de
    * @date 20-February-2006 14:35:18
    * @location Cali-Colombia
    */
    function _getDetalleDimensionById(){
    	
    	settype($rcTmp,"array");
    	settype($sbValue,"string");
    	
        if(is_array($this->_rcCodDimension) && $this->_rcCodDimension){
            $this->rcDetalleDimension = array();
        	foreach($this->_rcCodDimension as $sbValue){
        		if($sbValue){
        			$rcTmp = $this->gateWay->getDetalleDimensionByDimecodigon($sbValue);
        			if($rcTmp){
        				$this->rcDetalleDimension = array_merge($this->rcDetalleDimension,$rcTmp);
        			}
        		}
        	}
        	if($this->rcDetalleDimension){
        		return true;
        	}
        }
        $this->rcDetalleDimension=null;
        return false;
    }
    /**
    * Copyright 2006 FullEngine
    * 
    * Ejecuta las validaciones de cada campo de la dimension
    * @author freina<freina@parquesoft.com>
    * @return true o false si el metodo se ejecuto correctamente
    * @date 20-February-2006 14:35:18
    * @location Cali-Colombia
    */
    function _executeValidations(){
    	
    	settype($rcTmp,"array");
    	settype($sbResult,"string");
    	settype($sbIndex,"string");
    	if($this->rcData && is_array($this->rcData)){
    		$sbResult = $this->_getDetalleDimensionById();
    		
    		if($sbResult){
    			$this->SbXmlInformation = "VALIDATEFORMAT";
    			//se inicia el procedimiento de aplicar los formatos
    			foreach($this->rcDetalleDimension as $sbIndex => $rcTmp){
    				
    				$this->SbIndexField = $sbIndex;
    				//se valida nulidad de los campos
    				$sbResult = $this->_validateNotNull();
    				if($sbResult){
    					//se crea la cadena que interpreta el xml de formato
    					$this->_xmlTransform();
    					$sbResult = $this->_evalSource();
    					if(!$sbResult){
    						$this->rcData=null;
    						return false;
    					}
    				}else{
    					return false;
    				}	
    			}
    			return true;	
    		}else{
    			return false;
    		}
    	}
    	return true;
    }
    /**
    * Copyright 2006 FullEngine
    * 
    * Valida nulidad de las columnas dinamicas
    * @author freina<freina@parquesoft.com>
    * @return true o false si el metodo se ejecuto correctamente
    * @date 04-March-2006 12:50:00
    * @location Cali-Colombia
    */
    function _validateNotNull(){
    	if($this->rcDetalleDimension[$this->SbIndexField]["dedinotnulls"]=="1"){
    		if($this->rcData[$this->rcDetalleDimension[$this->SbIndexField]["dedinombres"]]==null
    		|| $this->rcData[$this->rcDetalleDimension[$this->SbIndexField]["dedinombres"]]==""){
    			$this->_rcError["type_error"]="null";
				$this->_rcError["field"]=$this->rcDetalleDimension[$this->SbIndexField]["dedinombres"];
				return false;
    		}
    	}
    	return true;
    }
    /**
    * Copyright 2006 FullEngine
    * 
    * Transforma los xml a codigo
    * @author freina<freina@parquesoft.com>
    * @return true o false si el metodo se ejecuto correctamente
    * @date 22-February-2006 18:05:00
    * @location Cali-Colombia
    */
    function _xmlTransform(){
    	
    	settype($objXslDoc,"object");
		settype($objXmlDoc,"object");
		settype($objxh,"object");
		settype($rcConstat,"array");
		settype($sbpathXsl,"string");
		settype($sbXml,"string");
    	
    	$rcConstat = Application :: getConstant("XML_INFORMATION");
    	if($rcConstat[$this->SbXmlInformation]){
            //Valida que exista la cadena xml
            if($this->_flagOp)
                $sbXml = $this->_rcOptDimensionConfig[$this->SbIndexField][$rcConstat[$this->SbXmlInformation]["field"]];
            else
                $sbXml = $this->rcDetalleDimension[$this->SbIndexField][$rcConstat[$this->SbXmlInformation]["field"]];
                
            if($sbXml){
            	
            	$sbpathXsl = Application :: getBaseDirectory()."/xslt/".$rcConstat[$this->SbXmlInformation]["xsl"];
            	
            	$objXslDoc = new DOMDocument();
				$objXslDoc->load($sbpathXsl);
			
				$objXmlDoc = new DOMDocument();
				$objXmlDoc->loadXML($sbXml);
			
				$objxh = new XSLTProcessor();
				$objxh->importStylesheet($objXslDoc);
				$this->sbCode = $objxh->transformToXML($objXmlDoc);
            }
        }
    }
    /**
    * Copyright 2006 FullEngine
    * 
    * ejecuta los codigos creados por la plantilla XSL
    * @author freina<freina@parquesoft.com>
    * @return true o false si el metodo se ejecuto correctamente
    * @date 23-February-2006 10:13:00
    * @location Cali-Colombia
    */
    function _evalSource(){
    	
    	settype($sbResult,"string");
    	
    	$sbResult=true;
    	
    	//Valida si existe codigo a evaluar.
    	if($this->sbCode){
    		//se ejecuta el codigo generado.
    		eval($this->sbCode);
    		unset($this->sbCode);
    	}
    	return $sbResult;
    }
    /**
    * Copyright 2006 FullEngine
    * 
    * valida el formato de los datos
    * @author freina<freina@parquesoft.com>
    * @return true o false si el formato es correcto
    * @date 23-February-2006 10:45:00
    * @location Cali-Colombia
    */
    function _validateFormat($sbObject,$sbMethod,$sbvalue){
    	
    	settype($objService,"object");
    	settype($objService,"object");
    	
    	if($sbObject && $sbMethod && $sbvalue){
    		$objService = Application :: loadServices($sbObject);
    		return $objService->$sbMethod($sbvalue);
    		
    	}
    }
    /**
    * Copyright 2006 FullEngine
    * 
    * aplica la regla de transformacion
    * @author freina<freina@parquesoft.com>
    * @return true o false si el formato es correcto
    * @date 23-February-2006 13:39:00
    * @location Cali-Colombia
    */
    function _transformData($sbObject,$sbMethod,$sbvalue){
    	
    	settype($objService,"object");
    	settype($objService,"object");
    	
    	if($sbObject && $sbMethod && $sbvalue){
    		$objService = Application :: loadServices($sbObject);
    		return $objService->$sbMethod($sbvalue);
    		
    	}
    }
    /**
    * Copyright 2006 FullEngine
    * 
    * Carga datos para los campos con from desde la base de datos
    * @author creyes
    * @param type name desc
    * @return type name desc
    * @date 24-February-2006 12:5:32
    * @location Cali-Colombia
    */
    function _getFromDb($table, $value_field, $label_field){
        return $this->gateWay->getConsult($table, $value_field, $label_field);
    }
    /**
    * Copyright 2006 FullEngine
    * 
    * Carga datos para los campos con from desde la base de datos
    * @author creyes
    * @param type name desc
    * @return type name desc
    * @date 24-February-2006 12:5:32
    * @location Cali-Colombia
    */
    function _getFromSqlId($sqlid, $value_field, $label_field){
        return $this->gateWay->getConsultSqlid($sqlid, $value_field, $label_field);
    }
    
    /**
    * Copyright 2006 FullEngine
    * 
    * Carga datos para los campos con from desde la base de datos
    * @author creyes
    * @param type name desc
    * @return type name desc
    * @date 24-February-2006 12:5:32
    * @location Cali-Colombia
    */
    function _getFromParam($module, $variable){
   		$params = Application :: getDomainController("ParamsManager");
		return $params->getParam($module,$variable);
    }
    /**
    * Copyright 2006 FullEngine
    * 
    * Carga los datos de los campos referenciados 
    * @author creyes
    * @param type name desc
    * @return type name desc
    * @date 24-February-2006 12:28:49
    * @location Cali-Colombia
    */
    function _getDataReferenceField(){
        $this->SbXmlInformation = "FROMFORMAT";

        foreach($this->rcDetalleDimension as $index => $rcField){
            if($rcField['dediorigens']){
                $this->SbIndexField = $index;
   				$this->_xmlTransform();
   				$sbResult = $this->_evalSource();
                $this->_rcReference[$rcField['dedinombres']] = $this->_rcFrom;
            }
        }
    }
    /**
    * Copyright 2006 FullEngine
    * 
    * Crea las sentencias Insert para los valores de las dimensiones
    * @author freina<freina@parquesoft.com>
    * @return true o false si el metodo se ejecuto correctamente
    * @date 27-February-2006 15:59:00
    * @location Cali-Colombia
    */
    function _createInsertDimensionValuesSentences(){
    	
    	settype($objNumerator,"object");
    	settype($rcTmp,"array");
    	settype($sbResult,"string");
    	settype($sbIndex,"string");
    	settype($nuCant,"integer");
    	settype($nuVadicodigon,"integer");
    	settype($nuAdicional,"integer");
    	
    	if($this->rcData && is_array($this->rcData)){
    		$sbResult = $this->_getDetalleDimensionById();
    		
    		if($sbResult){
    			
    			$nuCant = sizeof($this->rcDetalleDimension);
    			$objNumerator  = Application :: getDomainController('NumeradorManager');
    			$nuVadicodigon = $objNumerator->fncgetByIdNumerador("valordimension",$nuCant);
    			
    			//se inicia el procedimiento de obtener los sql
    			foreach($this->rcDetalleDimension as $sbIndex => $rcTmp){
    				
    				$sbVadivalors = $this->rcData[$rcTmp["dedinombres"]];
    				if(is_array($sbVadivalors)) {
    					$nuAdicional = $objNumerator->fncgetByIdNumerador("valordimension",(sizeof($sbVadivalors)-1));
    					foreach ($sbVadivalors as $value) {
    						$sbResult = $this->gateWay->addValordimension($rcTmp["dimecodigon"],
    														$rcTmp["dedinombres"], $nuAdicional, 
    														$this->vadidominios, $this->vadidomivals, 
    														$value);
    						$nuAdicional++;
    					}
    				}
    				else {
	    				$sbResult = $this->gateWay->addValordimension($rcTmp["dimecodigon"],
	    				$rcTmp["dedinombres"], $nuVadicodigon, 
	    				$this->vadidominios, $this->vadidomivals, $sbVadivalors);
	    				
	    				//consecutio mas mas
	    				$nuVadicodigon ++;
	    				if(!$sbResult){
	    					return false;
	    				}
    				}
    			}
    			return true;	
    		}
    	}
    	return false;
    }
    /**
    * Copyright 2006 FullEngine
    * 
    * Crea la sentencia de Delete para los valores de las dimensiones
    * @author freina<freina@parquesoft.com>
    * @return true o false si el metodo se ejecuto correctamente
    * @date 27-February-2006 17:59:00
    * @location Cali-Colombia
    */
    function _createDeleteDimensionValuesSentence(){
    	
    	return $this->gateWay->deleteValordimension($this->vadidominios, 
    	$this->vadidomivals);
    	 
    }
    /**
    * Copyright 2006 FullEngine
    * 
    * Inserta los valores de las dimensiones
    * @author freina<freina@parquesoft.com>
    * @return true o false si el metodo se ejecuto correctamente
    * @date 27-February-2006 15:59:00
    * @location Cali-Colombia
    */
    function _insertDimensionValues(){
    	
    	settype($sbResult,"string");
    	
    	$sbResult = $this->_createInsertDimensionValuesSentences();
    	if($sbResult){
    		//ejecuta el insert
    		$this->gateWay->executeTransaction();
    		return $this->gateWay->consult;
    	}
    	return false;
    }
    /**
    * Copyright 2006 FullEngine
    * 
    * Actualiza los valores de las dimensiones
    * @author freina<freina@parquesoft.com>
    * @return true o false si el metodo se ejecuto correctamente
    * @date 27-February-2006 17:07:00
    * @location Cali-Colombia
    */
    function _updateDimensionValues(){
    	
    	settype($sbResult,"string");
    	
    	$sbResult = $this->_createDeleteDimensionValuesSentence();
    	if($sbResult){
    		
    		$sbResult = $this->_createInsertDimensionValuesSentences();
    		if($sbResult){
    			//ejecuta el insert
    			$this->gateWay->executeTransaction();
    			return $this->gateWay->consult;
    		}
    	}
    	return false;
    }
    /**
    * Copyright 2006 FullEngine
    * 
    * Obtiene los campos dinamicos que no deben ser nulos
    * @author freina<freina@parquesoft.com>
    * @return array $rcResult Arreglo con los nombre de los campos
    * @date 19-Jul-2006 15:33:00
    * @location Cali-Colombia
    */
    function _getNotNullFields(){
    	
    	settype($rcResult,"array");
    	settype($rcTmp,"array");
    	settype($sbResult,"string");
    	settype($sbIndex,"string");
    	
    	$sbResult = $this->_getDetalleDimensionById();
    	
    	if($sbResult){
    		foreach($this->rcDetalleDimension as $sbIndex => $rcTmp){
    			if($this->rcDetalleDimension[$sbIndex]["dedinotnulls"]=="1"){
    				$rcResult[]=$this->rcDetalleDimension[$sbIndex]["dedinombres"];
    			}
    		}
    	}
    	return $rcResult;
    }
    
    function getDimensiones() {
    	return $this->gateWay->getDimensiones();
    }
    
    function getDetalles($dimecodigon) {
    	return $this->gateWay->getDetalles($dimecodigon);
    }
    
    function addDetalles($row) {
    	$this->gateWay->setData($row);
    	return $this->gateWay->addDetalledimens();
    }
    
    function deleteDetalledimens($dimecodigon,$dedinombres) {
    	return $this->gateWay->deleteDetalledimens($dimecodigon,$dedinombres);
    }
}
?>