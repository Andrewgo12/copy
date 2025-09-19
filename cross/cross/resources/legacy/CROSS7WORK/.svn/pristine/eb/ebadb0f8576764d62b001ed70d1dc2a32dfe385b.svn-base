<?php
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeGePgsqlArchivoaux {

	function FeGePgsqlArchivoaux() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
		$this->executeSql = true;
	}
	/**
	 * @Copyright 2014 Parquesoft
	 *
	 * Modifica el arreglo de datos
	 * @author freina<freina@fullengine.com>
	 *
	 * @location Cali - Colombia
	 */
	function setData($rcData){
		$this->rcData = $rcData;
	}
	/**
	 * @Copyright 2014 Parquesoft
	 *
	 * Obtiene el resultado de la consulta
	 * @author freina<freina@fullengine.com>
	 *
	 * @location Cali - Colombia
	 */
	function getConsult(){
		return $this->consult;
	}
	/**
	 * @Copyright 2014 Parquesoft
	 *
	 * determina si se ejecuta el sql
	 * @author freina<freina@fullengine.com>
	 *
	 * @location Cali - Colombia
	 */
	function setExecuteSql($blState) {
		$this->executeSql = $blState;
	}
	/**
	 * @Copyright 2014 Parquesoft
	 *
	 * obtiene el sql
	 * @author freina<freina@fullengine.com>
	 *
	 * @location Cali - Colombia
	 */
	function getSql(){
		return $this->_rcSql;
	}
	/**
	 * @Copyright 2014 Parquesoft
	 *
	 * Obtiene el resultado de la consulta (data)
	 * @author freina<freina@fullengine.com>
	 *
	 * @location Cali - Colombia
	 */
	function getResult(){
		return $this->rcResult;
	}

	/**
	 * @Copyright 2014 Parquesoft
	 *
	 * Conjunto de sql a ejecutar
	 * @author freina<freina@fullengine.com>
	 *
	 * @location Cali - Colombia
	 */
	function setSql($rcSql){
		$this->_rcSql = $rcSql;
	}

	/**
	 * @Copyright 2014 Parquesoft
	 *
	 * ejecuta las transaccion
	 * @author freina<freina@fullengine.com>
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
	 * @Copyright 2014 Parquesoft
	 *
	 * Obtiene los registros de la tabla archivoaux
	 * @author freina<freina@fullengine.com>
	 *
	 * @location Cali - Colombia
	 */
	function getArchivoaux(){

		settype($rcResult,"array");
		settype($rcTmp,"array");
		settype($sbSql,"string");
		settype($sbTmp,"string");

		extract($this->rcData);
		
		if($araucodigon){
			$rcTmp[] = ' "araucodigon"='.$araucodigon.' ';
		}
		
		if($araulinean){
			$rcTmp[] = ' "araulinean"='.$araulinean.' ';
		}

		if($archcodigon){
			$rcTmp[] = ' "archcodigon"='.$archcodigon.' ';
		}

		if($araufecregn){
			$rcTmp[] = ' "araufecregn"='.$araufecregn.' ';
		}

		if($usuacodigos){
			$rcTmp[] = ' "usuacodigos"=\''.$usuacodigos.'\' ';
		}
		
		if($araucruds){
			$rcTmp[] = ' "araucruds"=\''.$araucruds.'\' ';
		}

		if($arauestados){
			$rcTmp[] = ' "arauestados"=\''.$arauestados.'\' ';
		}

		$sbSql = 'SELECT * FROM "archivoaux" ';

		if(is_array($rcTmp) && $rcTmp){
			$sbTmp = implode(" AND ",$rcTmp);
			$sbSql .= ' WHERE ';
			$sbSql .= $sbTmp;
		}
		
		if($order_by){
			
			$sbSql .= ' ORDER BY '.$order_by.' ';
		}

		if(!$this->executeSql){
			$this->_rcSql[] = $sbSql;
			return;
		}
		$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		$rcResult = $this->objdb->rcresult;

		$this->rcResult = $rcResult;

	}

	/**
	 * @Copyright 2014 Parquesoft
	 *
	 * actualiza la tabla Archivoaux
	 * @author freina<freina@fullengine.com>
	 *
	 * @location Cali - Colombia
	 */
	function setArchivoaux(){

		settype($rcTmp,"array");
		settype($sbSql,"string");
		settype($sbTmp,"string");

		extract($this->rcData);
		
		if($araulinean){
			$rcTmp[] = ' "araulinean"='.$araulinean.' ';
		}

		if($araufecregn){
			$rcTmp[] = ' "araufecregn"='.$araufecregn.' ';
		}

		if($usuacodigos){
			$rcTmp[] = ' "usuacodigos"=\''.$usuacodigos.'\' ';
		}
		
		if($araucruds){
			$rcTmp[] = ' "araucruds"=\''.$araucruds.'\' ';
		}

		if($arauestados){
			$rcTmp[] = ' "arauestados"=\''.$arauestados.'\' ';
		}

		if(is_array($rcTmp) && $rcTmp){
			$sbTmp = implode(" , ",$rcTmp);
		}

		$sbSql = 'UPDATE "archivoaux" SET  ';
		$sbSql .= $sbTmp;
		$sbSql .= '  WHERE "araucodigon"='.$araucodigon .' ';

		if(!$this->executeSql){
			$this->_rcSql[] = $sbSql;
			return;
		}
		$this->objdb->fncadoexecute($sbSql);
		if (!$this->objdb->objresult){
			$this->consult = false;
		}else{
			$this->consult = true;
		}
	}
	
	/**
	 * @Copyright 2012 Parquesoft
	 *
	 * Ingreso de las solicitudes
	 * @author freina<freina@fullengine.com>
	 *
	 * @location Cali - Colombia
	 */
	function addArchivoaux(){

		settype($sbSql,"string");
		extract($this->rcData);

		$sbSql = 'INSERT INTO "archivoaux" ("araucodigon","araulinean","archcodigon","araufecregn","usuacodigos","araucruds","arauestados")'
		.' VALUES('.$araucodigon.','.$araulinean.','.$archcodigon.','.$araufecregn.',\''.$usuacodigos.'\','.'\''.$araucruds.'\',\''.$arauestados.'\')';

		if(!$this->executeSql){
			$this->_rcSql[] = $sbSql;
			return;
		}
		$this->objdb->fncadoexecute($sbSql);
		if (!$this->objdb->objresult)
		$this->consult = false;
		else
		$this->consult = true;
	}
	
	/**
	 * @Copyright 2014 Parquesoft
	 *
	 * actualiza la tabla Archivos
	 * @author freina<freina@fullengine.com>
	 *
	 * @location Cali - Colombia
	 */
	function setArchivos(){

		settype($rcTmp,"array");
		settype($sbSql,"string");
		settype($sbTmp,"string");

		extract($this->rcData);
		
		if($archidrefes){
			$rcTmp[] = ' "archidrefes"=\''.$archidrefes.'\' ';
		}
		
		if($archreferes){
			$rcTmp[] = ' "archreferes"=\''.$archreferes.'\' ';
		}
		
		if($archnombres){
			$rcTmp[] = ' "archnombres"=\''.$archnombres.'\' ';
		}
		
		if($archmimetys){
			$rcTmp[] = ' "archmimetys"=\''.$archmimetys.'\' ';
		}
		
		if($archtamanon){
			$rcTmp[] = ' "archtamanon"='.$archtamanon.' ';
		}
		
		if($archcontens){
			$rcTmp[] = ' "archcontens"=\''.$archcontens.'\' ';
		}else{
			if($archcontens === null){
				$rcTmp[] = ' "archcontens"=\'\' ';
			}
		}
		
		if($archfechan){
			$rcTmp[] = ' "archfechan"='.$archfechan.' ';
		}
		
		if($archtipdocs){
			$rcTmp[] = ' "archtipdocs"=\''.$archtipdocs.'\' ';
		}
		
		if($archextensis){
			$rcTmp[] = ' "archextensis"=\''.$archextensis.'\' ';
		}
		
		if($archobservas){
			$rcTmp[] = ' "archobservas"=\''.$archobservas.'\' ';
		}
		
		if(is_array($rcTmp) && $rcTmp){
			$sbTmp = implode(" , ",$rcTmp);
		}

		$sbSql = 'UPDATE "archivos" SET  ';
		$sbSql .= $sbTmp;
		$sbSql .= '  WHERE "archcodigon"='.$archcodigon.' ';

		if(!$this->executeSql){
			$this->_rcSql[] = $sbSql;
			return;
		}
		$this->objdb->fncadoexecute($sbSql);
		if (!$this->objdb->objresult){
			$this->consult = false;
		}else{
			$this->consult = true;
		}
	}
	
	/**
	 * @Copyright 2014 Parquesoft
	 *
	 * obtiene los registros de la tabla Archivos
	 * @author freina<freina@fullengine.com>
	 *
	 * @location Cali - Colombia
	 */
	function getArchivos(){

		settype($rcTmp,"array");
		settype($sbSql,"string");
		settype($sbTmp,"string");

		extract($this->rcData);
		
		if($archidrefes){
			$rcTmp[] = ' "archidrefes"=\''.$archidrefes.'\' ';
		}
		
		if($archreferes){
			$rcTmp[] = ' "archreferes"=\''.$archreferes.'\' ';
		}
		
		if($archnombres){
			$rcTmp[] = ' "archnombres"=\''.$archnombres.'\' ';
		}
		
		if($archmimetys){
			$rcTmp[] = ' "archmimetys"=\''.$archmimetys.'\' ';
		}
		
		if($archtamanon){
			$rcTmp[] = ' "archtamanon"='.$archtamanon.' ';
		}
		
		if($archcontens){
			$rcTmp[] = ' "archcontens"=\''.$archcontens.'\' ';
		}
		
		if($archfechan){
			$rcTmp[] = ' "archfechan"='.$archfechan.' ';
		}
		
		if($archtipdocs){
			$rcTmp[] = ' "archtipdocs"=\''.$archtipdocs.'\' ';
		}
		
		if($archextensis){
			$rcTmp[] = ' "archextensis"=\''.$archextensis.'\' ';
		}
		
		if($archobservas){
			$rcTmp[] = ' "archobservas"=\''.$archobservas.'\' ';
		}
		
		if($not_in){
			$sbTmp = "'".implode("','",$not_in)."'";
			$rcTmp[] = ' "archcodigon" NOT IN ('.$sbTmp.') ';
		}
		
		if(is_array($rcTmp) && $rcTmp){
			$sbTmp = implode(" , ",$rcTmp);
		}

		$sbSql = 'SELECT * FROM "archivos" ';
		
		if(is_array($rcTmp) && $rcTmp){
			$sbTmp = implode(" AND ",$rcTmp);
			$sbSql .= ' WHERE ';
			$sbSql .= $sbTmp;
		}

		if(!$this->executeSql){
			$this->_rcSql[] = $sbSql;
			return;
		}
		$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		$rcResult = $this->objdb->rcresult;

		$this->rcResult = $rcResult;
	}
	
} //End of Class archivoaux
?>