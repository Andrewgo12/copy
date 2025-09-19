<?php
include_once ("pkdatabases.php");
class FeCrPgsqlPursuit {
	var $connection;
	var $consult;
	var $objdb;
	function FeCrPgsqlPursuit() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Modifica el atributo nuSenal en el cual se almacena la senal del sql a ejecutar
	*   @author freina
	*	@param integer nuSenal entero con el id de la senal
	*   @date 29-May-2007 19:58
	*   @location Cali-Colombia
	*/
	function setnuSenal($nuSenal) {
		$this->nuSenal = $nuSenal;
	}
	
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Modifica el atributo rcType en el cual se almacena los tipos de casos 
	* 	que no deben presentarse en el consolidado 
	*   @author freina
	*	@param array $rcType Arreglo con los tipos de caso.
	*   @date 29-May-2007 19:58
	*   @location Cali-Colombia
	*/
	function setrcType($rcType){
		$this->rcType=$rcType;
	}
	
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Modifica el atributo nuFechaini en el cual se almacena el entero timestamp
	*   de la fecha de inicio
	*   @author freina
	*	@param integer nuFechaini entero timestamp de la fecha de inicio
	*   @date 29-May-2007 19:58
	*   @location Cali-Colombia
	*/
	function setnuFechaini($nuFechaini) {
		$this->nuFechaini = $nuFechaini;
	}

	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Modifica el atributo nuFechafin en el cual se almacena el entero timestamp
	*   de la fecha de fin de intervalo
	*   @author freina
	*	@param integer nuFechaini entero timestamp de la fecha final
	*   @date 29-May-2007 19:58
	*   @location Cali-Colombia
	*/
	function setnuFechafin($nuFechafin) {
		$this->nuFechafin = $nuFechafin;
	}
	
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Modifica el atributo sbOrgacodigos en el cual se almacena el id del ente
	*   organizacional
	*   @author freina
	*	@param string sbOrgacodigos cadena con el id del ente organizacional
	*   @date 29-May-2007 19:58
	*   @location Cali-Colombia
	*/
	function setsbOrgacodigos($sbOrgacodigos) {
		$this->sbOrgacodigos = $sbOrgacodigos;
	}

	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Modifica el atributo rcParams en el cual se almacena los parametros extra
	* 	necesarios para las consultas
	*   @author freina
	*	@param array rcParams Arreglo con los parametros.
	*   @date 29-May-2007 19:58
	*   @location Cali-Colombia
	*/
	function setrcParams($rcParams) {
		$this->rcParams = $rcParams;
	}
	
	function fncConsultar() {
		
		settype($sbTmp,"string");
		settype($sbSubSql,"string");
		
		switch ($this->nuSenal) {
			case 1 :
			
				$sbTmp = " \"orden\".\"ordefecregd\" BETWEEN ".$this->nuFechaini." AND ".$this->nuFechafin;
				$sbTmp .= " AND \"orden\".\"ordenumeros\"=\"ordenempresa\".\"ordenumeros\" ";

				if($this->sbOrgacodigos){
					$sbTmp .= " AND \"ordenempresa\".\"orgacodigos\"='".$this->sbOrgacodigos."' ";
				}

				$sbSql = 'SELECT '.'"orden"."ordenumeros",'.
				'"orden"."ordefecingd",'.'"orden"."ordefecregd",'.
				'"orden"."ordefecvend",'.'"orden"."ordefecfinad",'.
				'"ordenempresa"."tiorcodigos",'.'"tipoorden"."tiornombres",'.
				'"ordenempresa"."evencodigos",'.'"evento"."evennombres",'.
				'"ordenempresa"."merecodigos",'.'"ordenempresa"."causcodigos" '.
				'FROM "orden","ordenempresa","tipoorden","evento","acta","actaempresa","compromiso","acemcompromi" ' .
				'WHERE '.$sbTmp.
				' AND "orden"."ordenumeros"="ordenempresa"."ordenumeros" '.
				' AND "orden"."ordenumeros"="acta"."ordenumeros" '.
				'AND "ordenempresa"."tiorcodigos"="tipoorden"."tiorcodigos" '.
				'AND "acta"."actacodigos"="actaempresa"."actacodigos" '.
				'AND "acemcompromi"."acemcodigos"="actaempresa"."acemnumeros" '.
				'AND "acemcompromi"."compcodigos"="compromiso"."compcodigos" '.
				'AND "ordenempresa"."evencodigos"="evento"."evencodigos" ';
				break;
			case 2 :
				$sbSql = 'SELECT * FROM "tipoorden" '.$sbTmp.' ORDER BY "tiorcodigos"';
				break;
			case 3 :
				$sbTmp = " \"orden\".\"ordefecregd\" BETWEEN ".$this->nuFechaini." AND ".$this->nuFechafin;
				$sbTmp .= " AND \"orden\".\"ordenumeros\"=\"ordenempresa\".\"ordenumeros\" ";

				if($this->sbOrgacodigos){
					$sbTmp .= " AND \"ordenempresa\".\"orgacodigos\"='".$this->sbOrgacodigos."' ";
				}

				$sbSql = 'SELECT '.'"orden"."ordenumeros",'.
				'"orden"."ordefecingd",'.'"orden"."ordefecregd",'.
				'"orden"."ordefecvend",'.'"orden"."ordefecfinad",'.
				'"ordenempresa"."tiorcodigos",'.'"tipoorden"."tiornombres",'.
				'"ordenempresa"."evencodigos",'.'"evento"."evennombres",'.
				'"ordenempresa"."merecodigos",'.'"ordenempresa"."causcodigos" ,"accoactivas"'.
				'FROM "orden","ordenempresa","tipoorden","evento","acta","actaempresa","compromiso","acemcompromi" ' .
				'WHERE '.$sbTmp.
				' AND "ordenempresa"."tiorcodigos"="tipoorden"."tiorcodigos" '.
				'AND "acta"."ordenumeros"="ordenempresa"."ordenumeros" '.
				'AND "acta"."actacodigos"="actaempresa"."actacodigos" '.
				'AND "acemcompromi"."acemcodigos"="actaempresa"."acemnumeros" '.
				'AND "acemcompromi"."compcodigos"="compromiso"."compcodigos" '.
				' AND "ordenempresa"."evencodigos"="evento"."evencodigos" ';
				break;
			case 4 :
				$sbSql = 'SELECT * FROM "tipoorden" '.$sbTmp.' ORDER BY "tiorcodigos"';
				break;
			case 5 :
				$sbSql = 'SELECT * FROM "mediorecepcion" ORDER BY "merenombres"';
				break;
			case 6 :
				//Para la consulta 1 se realiza sobre el evento = Denuncia
				$objGeneral = Application::loadServices("General");
				$rcDenuncias = $objGeneral->getParam("cross300","DENUNCIA_TC");
				$sbWherecausa = " WHERE \"tiorcodigos\" in (".implode(",",$rcDenuncias).")";
				
				$sbSql = 'SELECT "tiorcodigos","evencodigos","evennombres" FROM "evento" '.$sbWherecausa.' ORDER BY "tiorcodigos"';
				break;
			case 7 :
				$sbSql = 'SELECT * FROM "causa" ORDER BY "tiorcodigos","evencodigos","causcodigos"';
				break;
			case 8 :   //CASOS POR TIPO DE CASO Y TIPO DE COMPROMISO
				$sbTmp = " \"orden\".\"ordefecregd\" BETWEEN ".$this->nuFechaini." AND ".$this->nuFechafin;
				$sbTmp .= " AND \"orden\".\"ordenumeros\"=\"ordenempresa\".\"ordenumeros\" ";
				if($this->sbOrgacodigos){
					$sbTmp .= " AND \"ordenempresa\".\"orgacodigos\"='".$this->sbOrgacodigos."' ";
				}
				$sbSql = 'SELECT "tipoorden"."tiornombres","compromiso"."compdescris",'.
				'COUNT("orden"."ordenumeros") AS "cuantos" '.
				'FROM "orden","ordenempresa","tipoorden","compromiso","acta","actaempresa","acemcompromi" ' .
				'WHERE '.$sbTmp.
				'AND "orden"."ordenumeros"="ordenempresa"."ordenumeros" '.
				'AND "acta"."ordenumeros"="ordenempresa"."ordenumeros" '.
				'AND "ordenempresa"."tiorcodigos"="tipoorden"."tiorcodigos" '.
				'AND "acta"."actacodigos"="actaempresa"."actacodigos" '.
				'AND "acemcompromi"."acemcodigos"="actaempresa"."acemnumeros" '.
				'AND "acemcompromi"."compcodigos"="compromiso"."compcodigos" '.
				'GROUP BY 1,2 '.
				'ORDER BY 1,2 ';
				break;
		}

		$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
}
?>