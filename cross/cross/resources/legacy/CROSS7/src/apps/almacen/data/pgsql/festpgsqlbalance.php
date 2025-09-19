<?php     
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeStPgsqlBalance {
	var $objdb;
	function FeStPgsqlBalance() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Trae el consolidado de los movimientos de almacen
	* @param string $bodecodigos 
	* @param string $fecha 
	* @param string $isbsentido 
	* @return datatype Name desc
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 20-oct-2004 16:42:46
	* @location Cali-Colombia*/
	function getMovimientos($bodecodigos, $fecha, $isbsentido) {

		$sbsql = 'SELECT "recucodigos",sum("moalcantrecf") AS "suma","comocodigos" FROM "movimialmace"
													WHERE  "bodecodigos"=\''.$bodecodigos.'\' AND "moalsignos"=\''.$isbsentido.'\' AND 
													"moalfechmovd" <= '.$fecha.' 
													GROUP BY "recucodigos","comocodigos"';

		//Ejecuta la consulta a la base
		$this->objdb->fncadoexecute($sbsql);
		//$objResult = $this->objdb->objresult;
		//Contea los registros
		$nucantrow = $this->objdb->fncadorowcont();
		if (!$nucantrow)
			return $nucantrow;
		$rctemp = $this->objdb->objresult->fields;
		$sbrecurso = $rctemp["recucodigos"];
		$nucont = 0;
		while (!$this->objdb->objresult->EOF) {
			$rctemp = $this->objdb->objresult->fields;
			$this->objdb->objresult->MoveNext();
			$rcresult[$rctemp["recucodigos"]]["c".$rctemp["comocodigos"]] += $rctemp["suma"];
			$rcconceptos["c".$rctemp["comocodigos"]] = 0;
			//acumula el total por recurso
			if ($sbrecurso == $rctemp["recucodigos"])
				$nutotal += $rctemp["suma"];
			else {
				$rcresult[$sbrecurso]["Total"] = $nutotal;
				$sbrecurso = $rctemp["recucodigos"];
				$nutotal = $rctemp["suma"];
			}
		}
		//Pone el total al ultimo elemento
		$rcresult[$sbrecurso]["Total"] = $nutotal;
		$orcresult["matriz"] = $rcresult;
		$orcresult["conceptos"] = $rcconceptos;
		return $orcresult;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Trae un vector con todos los recursos
	* @return array
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 21-oct-2004 10:46:15
	* @location Cali-Colombia
	*/
	function getRecursos() {
		$sbsql = 'SELECT "recucodigos","recunombres" FROM "recurso"';
		$this->objdb->fncadoselectcache($sbsql, FETCH_NUM);
		if (!is_array($this->objdb->rcresult))
			return null;
		return $this->objdb->rcresult;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Trae los conceptos de movimiento, Usa cache
	* @return array
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 21-oct-2004 11:15:09
	* @location Cali-Colombia
	*/
	function getConceptos() {
		$sbsql = 'SELECT "comocodigos","comonombres" FROM "concepmovimi" ';
		$this->objdb->fncadoselectcache($sbsql, FETCH_ASSOC);
		if (!is_array($this->objdb->rcresult))
			return null;
		foreach ($this->objdb->rcresult as $rctemp) {
			$rcresult["c".$rctemp["comocodigos"]] = $rctemp["comonombres"];
		}
		return $rcresult;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Obtiene la info de la bodega
	* @param string $bodecodigos
	* @return array
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 21-oct-2004 12:11:46
	* @location Cali-Colombia
	*/
	function getInfo($bodecodigos) {
		$sbsql = 'SELECT 
						"bodega"."bodenombres",
						"bodega"."orgacodigos",
						"organizacion"."organombres" 
					FROM 
						"bodega","organizacion" 
					WHERE  
						"bodega"."bodecodigos"=\''.$bodecodigos.'\' AND
						"bodega"."orgacodigos"="organizacion"."orgacodigos"';
		$this->objdb->fncadoselectcache($sbsql, FETCH_ASSOC);
		if (!is_array($this->objdb->rcresult))
			return null;
		$rcresult["bodega"] = $this->objdb->rcresult[0]["bodenombres"];
		$rcresult["id_responsable"] = $this->objdb->rcresult[0]["orgacodigos"];
		$rcresult["responsable"] = $this->objdb->rcresult[0]["organombres"];
		return $rcresult;
	}
}
?>