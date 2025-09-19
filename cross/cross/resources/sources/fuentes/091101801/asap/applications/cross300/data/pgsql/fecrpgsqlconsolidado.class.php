<?php

include_once ("pkdatabases.php");

class FeCrPgsqlConsolidado {
	var $connection;
	var $consult;
	var $objdb;
	var $rcEqui;
	
	function FeCrPgsqlConsolidado() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
		
		$this->create_table_acta();
		
		$objService = Application::loadServices('Human_resources');
        $this->rcEqui = $objService->getPhysicaldependencies();
        
	}
	
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Modifica el atributo rcType en el cual se almacena los tipos de casos 
	* 	que no deben presentarse en el consolidado 
	*   @author freina
	*	@param array $rcType Arreglo con los tipos de caso.
	*   @date 03-Aug-2006 11:31
	*   @location Cali-Colombia
	*/
	function setType($rcType){
		$this->rcType=$rcType;
	}

	//000267AT - FECHA DE DIGITACIÓN
	function setFechasDigitacion($fecha1,$fecha2) {
		$this->ordefecdiginin = $fecha1;
		$this->ordefecdigfinn = $fecha2;
	}
	
	function create_table_acta(){
		
		settype($objGeneral, "object");
		settype($objGateway, "object");
		settype($objService,"object");
		settype($sbTareaCC, "string");
		
		$objGeneral = Application::loadServices("General");
		$sbTareaCC = $objGeneral->getParam("cross300","TAREA_CC");
		if($sbTareaCC){
			$sbTareaCC = ' AND "acta"."tarecodigos" <> \''.$sbTareaCC.'\' ';	
		}
		
		//tabla temporal para el ultima acta activa
		$objService = Application::loadServices('Workflow');
		$objGateway = $objService->getGateWay("actatmp");
		$objGateway->setData(array("where"=>$sbTareaCC));
		$objGateway->create();
		$this->sbId = $objGateway->getName();
		$objService->close();
		
		return true;
	}
	
	function fncConsultar($nuSenal, $sbfechaini, $sbfechafin, $orgacodigos, $rcParametros) {
		
		settype($objGeneral, "object");
		settype($objService,"object");
		settype($objGateway, "object");
		settype($sbTmp,"string");
		settype($sbTable, "string");
		settype($sbId, "string");
		settype($sbStatus, "string");
		
		$sbActive = Application::getConstant("REG_ACT");
		$sbStatus = Application::getConstant("REG_INACT");
		
		$orgacodigos = (string) $orgacodigos;
		
		//tabla temporal
		$sbTable =' "'.$this->sbId.'" AS "acta" ';
		
		if ($nuSenal == 1) {
			if ($orgacodigos) {
				//Extrae las dependencias hijas
                $rcDep[] = $orgacodigos;
                if(is_array($this->rcEqui)){
                    foreach($this->rcEqui as $key => $value){
                        if($value == $orgacodigos)
                            $rcDep[] = (string) $key;
                    }
                }
                $stOrgacodigos = '"acta"."orgacodigos" IN (\''.implode("','",$rcDep).'\')';
				$sbWhere = ' WHERE '.$stOrgacodigos.' AND "orden"."ordefecregd" BETWEEN '.$sbfechaini.' AND '.$sbfechafin;
			} else {
				$sbWhere = " WHERE \"orden\".\"ordefecregd\" BETWEEN ".$sbfechaini." AND ".$sbfechafin;
			}
			$objGeneral = Application::loadServices("General");
			$seguimiento = $objGeneral->getParam("cross300","TAREA_SEGUIMIENTO");
			if($seguimiento<>'')
				$sbWhere .= " AND \"acta\".\"tarecodigos\" <> '".$seguimiento."'";
		}
		if ($nuSenal == 3) {
			
			//COMENTAR AQUÍ PUES AHORA LOS SEGUIMIENTOS SON UNA TAREA, NO UN SIMPLE NÚMERO DE SEGUIMIENTO
			/*
			if(is_array($this->rcType) && $this->rcType){
				$sbTmp = " AND \"ordenempresa\".\"tiorcodigos\" NOT IN ('".implode("','",$this->rcType)."')";
			}
			*/
			
			if ($orgacodigos) {
				//Extrae las dependencias hijas
                $rcDep[] = $orgacodigos;
                if(is_array($this->rcEqui)){
                    foreach($this->rcEqui as $key => $value){
                        if($value == $orgacodigos)
                            $rcDep[] = (string) $key;
                    }
                }
                $stOrgacodigos = "\"acta\".\"orgacodigos\" IN ('".implode("','",$rcDep)."')";
				$sbWhere = " WHERE ".$stOrgacodigos."
						                  AND \"orden\".\"ordefecregd\" BETWEEN ".$sbfechaini." AND ".$sbfechafin." 
										  AND \"orden\".\"ordenumeros\"=\"ordenempresa\".\"ordenumeros\"" .
										  $sbTmp.
										  " AND \"orden\".\"ordenumeros\"=\"acta\".\"ordenumeros\"
						                  AND \"acta\".\"actaestacts\"=\"estadoacta\".\"esaccodigos\" ";
			} 
			else {
				
				$sbWhere = " WHERE \"orden\".\"ordefecregd\" BETWEEN ".$sbfechaini." AND ".$sbfechafin."
										  AND \"orden\".\"ordenumeros\"=\"ordenempresa\".\"ordenumeros\"" .
										  $sbTmp.		
										  " AND \"orden\".\"ordenumeros\"=\"acta\".\"ordenumeros\"
						                  AND \"acta\".\"actaestacts\"=\"estadoacta\".\"esaccodigos\" ";
			}
			$objGeneral = Application::loadServices("General");
			$seguimiento = $objGeneral->getParam("cross300","TAREA_SEGUIMIENTO");
			if($seguimiento<>'')
				$sbWhere .= " AND \"acta\".\"tarecodigos\" <> '".$seguimiento."'";
		}
		if ($nuSenal == 6) {
			//Para la consulta 1 se realiza sobre el evento = Denuncia
			$objGeneral = Application::loadServices("General");
			$rcDenuncias = $objGeneral->getParam("cross300","DENUNCIA_TC");
			if(is_array($rcDenuncias) && $rcDenuncias){
				$sbWherecausa = " WHERE \"tiorcodigos\" in (".implode(",",$rcDenuncias).")";	
			}
		}

		$nuTamano = sizeof($rcParametros["campo"]);
		if ($nuSenal == 5) {
			if ($nuTamano > 0) {
				$sbWhere = " WHERE \"".$rcParametros["campo"][0]."\" = '".$rcParametros["valor"][0]."'";
				for ($nuCont = 1; $nuCont < $nuTamano; $nuCont ++) {
					$sbWhere .= " AND \"".$rcParametros["campo"][$nuCont]."\" = '".$rcParametros["valor"][$nuCont]."'";
				}
			}
		}

		//000267AT - FECHA DE DIGITACIÓN
		if($this->ordefecdiginin && $this->ordefecdigfinn) {
			$sbWhere .= ' AND "orden"."ordefecingd" BETWEEN '.$this->ordefecdiginin.' AND '.$this->ordefecdigfinn.' ';
		}

		switch ($nuSenal) {
			case 1 :
				
				//COMENTAR AQUÍ PUES AHORA LOS SEGUIMIENTOS SON UNA TAREA, NO UN SIMPLE NÚMERO DE SEGUIMIENTO
				/*if(is_array($this->rcType) && $this->rcType){
					$sbTmp = " AND \"ordenempresa\".\"tiorcodigos\" NOT IN ('".implode("','",$this->rcType)."')";
				}
				*/
				
				$sbSql = 'SELECT DISTINCT "orden"."ordenumeros",'.
				'"orden"."ordefecingd",'.'"orden"."ordefecregd",'.
				'"orden"."ordefecvend",'.'"orden"."ordefecfinad",'.
				'"ordenempresa"."tiorcodigos",'.'"tipoorden"."tiornombres",'.
				'"ordenempresa"."evencodigos",'.'"evento"."evennombres",'.
				'"ordenempresa"."merecodigos",'.'"ordenempresa"."causcodigos" '.
				' FROM "orden","ordenempresa","tipoorden","evento", '.$sbTable.
				$sbWhere.
				' AND "orden"."ordenumeros"="ordenempresa"."ordenumeros" '.
				' AND "orden"."ordenumeros"="acta"."ordenumeros" '.
				$sbTmp.
				' AND "ordenempresa"."tiorcodigos"="tipoorden"."tiorcodigos" '.
				' AND "ordenempresa"."tiorcodigos"="evento"."tiorcodigos" '.
				' AND "ordenempresa"."evencodigos"="evento"."evencodigos" '.
				' ORDER BY 6';
				break;
			case 2 :
				
				//COMENTAR AQUÍ PUES AHORA LOS SEGUIMIENTOS SON UNA TAREA, NO UN SIMPLE NÚMERO DE SEGUIMIENTO
				/*if(is_array($this->rcType) && $this->rcType){
					$sbTmp = " WHERE \"tipoorden\".\"tiorcodigos\" NOT IN ('".implode("','",$this->rcType)."') ";
				}
				*/
				
				$sbSql = 'SELECT * FROM "tipoorden" '.$sbTmp.' ORDER BY "tiorcodigos"';
				break;
			case 3 :
				$sbSql = 'SELECT DISTINCT "orden"."ordenumeros","acta"."actaestacts","estadoacta"."esacnombres"
						                      	  FROM "orden","ordenempresa","estadoacta",'.$sbTable 
						                      		.$sbWhere.'
						                      	  ORDER BY "acta"."actaestacts"';
				break;
			case 4 :
				$sbSql = 'SELECT * FROM "estadoacta" ORDER BY "esacnombres"';
				break;
			case 5 :
				$sbSql = 'SELECT * FROM "causa" '.$sbWhere;
				break;
			case 6 :
				$sbSql = 'SELECT "tiorcodigos","evencodigos","evennombres" FROM "evento" '.$sbWherecausa.' ORDER BY "tiorcodigos"';
				break;
			case 7 :
				$sbSql = 'SELECT * FROM "causa" ORDER BY "tiorcodigos","evencodigos","causcodigos"';
				break;
			case 9 :
				$sbSql = 'SELECT * FROM "mediorecepcion" ORDER BY "merenombres"';
				break;
			case 10 :
				$sbSql = 'SELECT * FROM "organizacion" ORDER BY "organombres"';
				break;
		}
		$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		
		//borrado tabla temporal para el ultima acta activa
		$objService = Application::loadServices('Workflow');
		$objGateway = $objService->getGateWay("actatmp");
		$objGateway->drop();
		$objService->close();
		
		return $this->objdb->rcresult;
	}
}
?>