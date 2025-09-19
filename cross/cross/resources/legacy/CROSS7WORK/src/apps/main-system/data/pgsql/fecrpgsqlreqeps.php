<?php
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeCrPgsqlReqeps {

	function FeCrPgsqlReqeps() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
		$this->executeSql = true;
	}
	/**
	 * @Copyright 2012 Parquesoft
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
	 * @Copyright 2012 Parquesoft
	 *
	 * Obtiene el resultado de la consulta
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getConsult(){
		return $this->consult;
	}
	/**
	 * @Copyright 2012 Parquesoft
	 *
	 * determina si se ejecuta el sql
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function setExecuteSql($blState) {
		$this->executeSql = $blState;
	}
	/**
	 * @Copyright 2012 Parquesoft
	 *
	 * obtiene el sql
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getSql(){
		return $this->_rcSql;
	}
	/**
	 * @Copyright 2012 Parquesoft
	 *
	 * Obtiene el resultado de la consulta (data)
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getResult(){
		return $this->rcResult;
	}

	/**
	 * @Copyright 2012 Parquesoft
	 *
	 * Conjunto de sql a ejecutar
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function setSql($rcSql){
		$this->_rcSql = $rcSql;
	}

	/**
	 * @Copyright 2012 Parquesoft
	 *
	 * ejecuta las transaccion
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function executeTrans() {
		if (!$this->_rcSql) {
			$this->consult = false;
		}
		$this->objdb->fncadoexecutetrans($this->_rcSql);
		if (!$this->objdb->objresult) {
			$this->consult = false;
		} else {
			$this->consult = true;
		}
	}

	/**
	 * Copyright 2005 FullEngine
	 *
	 * Consulta reporte de casos por empresa Nivel 1: Hasta tipos de caso
	 * @author creyes
	 * @param integer $ordefecregd
	 * @param integer $ordefecregd2
	 * @param string $ipsecodigos
	 * @param string $tiorcodigos
	 * @date 02-Junio-2006 16:02
	 * @location Cali-Colombia
	 */
	function getReqByEpsLevel1($ordefecregd,$ordefecregd2,$ipsecodigos,$tiorcodigos){
		if($ordefecregd && $ordefecregd2)
		$dateWhere = '"orden"."ordefecregd" BETWEEN '.$ordefecregd.' AND '.$ordefecregd2.' AND ';
		if($ipsecodigos)
		$epsWhere = '"ordenempresa"."ipsecodigos"=\''.$ipsecodigos.'\' AND ';
		if($tiorcodigos)
		$tipoordenWhere = '"ordenempresa"."tiorcodigos"=\''.$tiorcodigos.'\' AND ';
   
		$sql = 'SELECT ' .
        			'"ipsservicio"."ipsecodigos",' .
        			'"ipsservicio"."ipsenombres",' .
        			'"tipoorden"."tiorcodigos",' .
        			'"tipoorden"."tiornombres",' .
        			'COUNT ("tipoorden"."tiorcodigos") AS "cantidad" ' .
        		'FROM "orden","ordenempresa","ipsservicio","tipoorden" ' .
        		'WHERE ' .
        			'"orden"."ordenumeros"="ordenempresa"."ordenumeros" AND ' .
		$dateWhere.
		$epsWhere.
        			'"ordenempresa"."ipsecodigos"="ipsservicio"."ipsecodigos" AND ' .
		$tipoordenWhere.
        			'"ordenempresa"."tiorcodigos"="tipoorden"."tiorcodigos" ' .
        		'GROUP BY 1,2,3,4 ' .
        		'ORDER BY 2,4';

		$this->objdb->fncadosetmodefetch(FETCH_ASSOC);
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
		return null;
		while (!$this->objdb->objresult->EOF) {
			$rcTmp = $this->objdb->fncadofetch();
			$this->objdb->fncadomovenext();
			$rcReturn[$rcTmp['ipsecodigos']]['ipsenombres'] = $rcTmp['ipsenombres'];
			$rcReturn[$rcTmp['ipsecodigos']]['totaleps'] += $rcTmp['cantidad'];
			$rcReturn[$rcTmp['ipsecodigos']]['tipoorden'][$rcTmp['tiorcodigos']]['cantidad'] += $rcTmp['cantidad'];
			$rcReturn[$rcTmp['ipsecodigos']]['tipoorden'][$rcTmp['tiorcodigos']]['tiornombres'] = $rcTmp['tiornombres'];
		}
		return $rcReturn;
	}

	/**
	 * Copyright 2005 FullEngine
	 *
	 * Consulta reporte de casos por empresa Nivel 2: Hasta clasificaciones
	 * @author creyes
	 * @param integer $ordefecregd
	 * @param integer $ordefecregd2
	 * @param string $ipsecodigos
	 * @param string $tiorcodigos
	 * @date 02-Junio-2006 16:02
	 * @location Cali-Colombia
	 */
	function getReqByEpsLevel2($ordefecregd,$ordefecregd2,$ipsecodigos,$tiorcodigos){
		if($ordefecregd && $ordefecregd2)
		$dateWhere = '"orden"."ordefecregd" BETWEEN '.$ordefecregd.' AND '.$ordefecregd2.' AND ';
		if($ipsecodigos)
		$epsWhere = '"ordenempresa"."ipsecodigos"=\''.$ipsecodigos.'\' AND ';
		if($tiorcodigos)
		$tipoordenWhere = '"ordenempresa"."tiorcodigos"=\''.$tiorcodigos.'\' AND ';
   
		$sql = 'SELECT ' .
        			'"ipsservicio"."ipsecodigos",' .
        			'"ipsservicio"."ipsenombres",' .
        			'"tipoorden"."tiorcodigos",' .
        			'"tipoorden"."tiornombres",' .
        			'"evento"."evencodigos",'.
        			'"evento"."evennombres",'.
        			'COUNT ("tipoorden"."tiorcodigos") AS "canttipoorden",' .
        			'COUNT ("evento"."evencodigos") AS "cantevento" ' .
        		'FROM "orden","ordenempresa","ipsservicio","tipoorden","evento" ' .
        		'WHERE ' .
        			'"orden"."ordenumeros"="ordenempresa"."ordenumeros" AND ' .
		$dateWhere.
		$epsWhere.
        			'"ordenempresa"."ipsecodigos"="ipsservicio"."ipsecodigos" AND ' .
		$tipoordenWhere.
        			'"ordenempresa"."tiorcodigos"="tipoorden"."tiorcodigos" AND ' .
        			'"ordenempresa"."evencodigos"="evento"."evencodigos" ' .
        		'GROUP BY 1,2,3,4,5,6 ' .
        		'ORDER BY 2,4,6';

		$this->objdb->fncadosetmodefetch(FETCH_ASSOC);
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
		return null;
		while (!$this->objdb->objresult->EOF) {
			$rcTmp = $this->objdb->fncadofetch();
			$this->objdb->fncadomovenext();
			$rcReturn[$rcTmp['ipsecodigos']]['ipsenombres'] = $rcTmp['ipsenombres'];
			$rcReturn[$rcTmp['ipsecodigos']]['totaleps'] += $rcTmp['cantevento'];
			$rcReturn[$rcTmp['ipsecodigos']]['tipoorden'][$rcTmp['tiorcodigos']]['cantidad'] += $rcTmp['canttipoorden'];
			$rcReturn[$rcTmp['ipsecodigos']]['tipoorden'][$rcTmp['tiorcodigos']]['tiornombres'] = $rcTmp['tiornombres'];
			$rcReturn[$rcTmp['ipsecodigos']]['tipoorden'][$rcTmp['tiorcodigos']]['evento'][$rcTmp['evencodigos']]['cantidad'] += $rcTmp['canttipoorden'];
			$rcReturn[$rcTmp['ipsecodigos']]['tipoorden'][$rcTmp['tiorcodigos']]['evento'][$rcTmp['evencodigos']]['evennombres'] = $rcTmp['evennombres'];
				
		}
		return $rcReturn;
	}

	/**
	 * Copyright 2005 FullEngine
	 *
	 * Consulta reporte de casos por empresa Nivel 3: Hasta subclasificaciones
	 * @author creyes
	 * @param integer $ordefecregd
	 * @param integer $ordefecregd2
	 * @param string $ipsecodigos
	 * @param string $tiorcodigos
	 * @date 02-Junio-2006 16:02
	 * @location Cali-Colombia
	 */
	function getReqByEpsLevel3($ordefecregd,$ordefecregd2,$ipsecodigos,$tiorcodigos){
		if($ordefecregd && $ordefecregd2)
		$dateWhere = '"orden"."ordefecregd" BETWEEN '.$ordefecregd.' AND '.$ordefecregd2.' AND ';
		if($ipsecodigos)
		$epsWhere = '"ordenempresa"."ipsecodigos"=\''.$ipsecodigos.'\' AND ';
		if($tiorcodigos)
		$tipoordenWhere = '"ordenempresa"."tiorcodigos"=\''.$tiorcodigos.'\' AND ';

		$rcCausas = $this->getAllCausasIndex();
		$sql = 'SELECT ' .
        			'"ipsservicio"."ipsecodigos",' .
        			'"ipsservicio"."ipsenombres",' .
        			'"tipoorden"."tiorcodigos",' .
        			'"tipoorden"."tiornombres",' .
        			'"evento"."evencodigos",'.
        			'"evento"."evennombres",' .
        			'"ordenempresa"."causcodigos",'.
        			'COUNT ("tipoorden"."tiorcodigos") AS "canttipoorden",' .
        			'COUNT ("evento"."evencodigos") AS "cantevento", ' .
					'COUNT ("ordenempresa"."causcodigos") AS "cantcausa"' .
        		'FROM "orden","ordenempresa","ipsservicio","tipoorden","evento" ' .
        		'WHERE ' .
        			'"orden"."ordenumeros"="ordenempresa"."ordenumeros" AND ' .
		$dateWhere.
		$epsWhere.
        			'"ordenempresa"."ipsecodigos"="ipsservicio"."ipsecodigos" AND ' .
		$tipoordenWhere.
        			'"ordenempresa"."tiorcodigos"="tipoorden"."tiorcodigos" AND ' .
        			'"ordenempresa"."evencodigos"="evento"."evencodigos" ' .
        		'GROUP BY 1,2,3,4,5,6,7 ' .
        		'ORDER BY 2,4,6';

		$this->objdb->fncadosetmodefetch(FETCH_ASSOC);
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
		return null;
		while (!$this->objdb->objresult->EOF) {
			$rcTmp = $this->objdb->fncadofetch();
			$this->objdb->fncadomovenext();
			$rcReturn[$rcTmp['ipsecodigos']]['ipsenombres'] = $rcTmp['ipsenombres'];
			$rcReturn[$rcTmp['ipsecodigos']]['totaleps'] += $rcTmp['cantevento'];
			$rcReturn[$rcTmp['ipsecodigos']]['tipoorden'][$rcTmp['tiorcodigos']]['cantidad'] += $rcTmp['canttipoorden'];
			$rcReturn[$rcTmp['ipsecodigos']]['tipoorden'][$rcTmp['tiorcodigos']]['tiornombres'] = $rcTmp['tiornombres'];
			$rcReturn[$rcTmp['ipsecodigos']]['tipoorden'][$rcTmp['tiorcodigos']]['evento'][$rcTmp['evencodigos']]['cantidad'] += $rcTmp['canttipoorden'];
			$rcReturn[$rcTmp['ipsecodigos']]['tipoorden'][$rcTmp['tiorcodigos']]['evento'][$rcTmp['evencodigos']]['evennombres'] = $rcTmp['evennombres'];
			if($rcTmp['causcodigos']){
				$rcReturn[$rcTmp['ipsecodigos']]['tipoorden'][$rcTmp['tiorcodigos']]['evento'][$rcTmp['evencodigos']]['causa'][$rcTmp['causcodigos']]['cantidad'] += $rcTmp["cantcausa"];
				$rcReturn[$rcTmp['ipsecodigos']]['tipoorden'][$rcTmp['tiorcodigos']]['evento'][$rcTmp['evencodigos']]['causa'][$rcTmp['causcodigos']]['causnombres'] = $rcCausas[$rcTmp['causcodigos']];
			}
		}
		return $rcReturn;
	}
	/**
	 * Copyright 2006 FullEngine
	 *
	 * Consulta las causas en un vector con indices asociativos
	 * @author creyes
	 * @date 02-Junio-2006 16:02
	 * @location Cali-Colombia
	 */
	function getAllCausasIndex(){
		//Consulta las causas.
		$sql = 'SELECT "tiorcodigos","evencodigos","causcodigos","causnombres" FROM causa';
		$this->objdb->fncadosetmodefetch(FETCH_ASSOC);
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
		return null;
		while (!$this->objdb->objresult->EOF) {
			$rcTmp = $this->objdb->fncadofetch();
			$this->objdb->fncadomovenext();
			$rcResult[$rcTmp['causcodigos']] = $rcTmp['causnombres'];
		}
		return $rcResult;
	}
}
?>