<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeGePgsqlTablastipole {
	
	function FeGePgsqlTablastipole() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
		$this->executeSql = true;
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
	 * @Copyright 2009 Parquesoft
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
	 * @Copyright 2009 Parquesoft
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
	 * @Copyright 2009 Parquesoft
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
	 * @Copyright 2009 Parquesoft
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
	 * @Copyright 2009 Parquesoft
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
	 * @Copyright 2009 Parquesoft
	 *
	 * Ingreso de ldescripcion en el nuevo lenguaje
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function addTablastipole(){
		
		settype($sbSql,"string");
		extract($this->rcData);
		
		$sbSql = 'INSERT INTO "tablastipole" ("tatlcodigos","tatlnomtabls","tatlnomcacos",
										"tatlnocadess","tatlvalcods","tatlvaldescs","langcodigos","tatlvaldesls")'
		.' VALUES(\''.$tatlcodigos.'\',\''.$tatlnomtabls.'\',\''.$tatlnomcacos.'\',\''.$tatlnocadess.'\',\''.$tatlvalcods.'\',
		\''.$tatlvaldescs.'\',\''.$langcodigos.'\',\''.$tatlvaldesls.'\')';
		
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
	 * @Copyright 2009 Parquesoft
	 *
	 * modificar descripcion de un lenguaje
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function updateTablastipole(){
		
		settype($sbSql,"string");
		extract($this->rcData);
		
		$sbSql = 'UPDATE "tablastipole" SET "tatlvaldesls"=\''.$tatlvaldesls.'\' WHERE "tatlcodigos"=\''.$tatlcodigos.'\'';
		
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
	 * @Copyright 2009 Parquesoft
	 *
	 * eliminar descripcion
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function deleteTablastipole(){
		
		settype($sbSql,"string");
		extract($this->rcData);
		
		$sbSql = 'DELETE FROM "tablastipole" WHERE "tatlcodigos"=\''.$tatlcodigos.'\'';
		
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
	 * @Copyright 2009 Parquesoft
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
	 * @Copyright 2009 Parquesoft
	 *
	 * Obtiene la configuracion de una tabla deacuerdo al lenguaje
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getByTatlnomtabls_Langcodigos(){
		
		settype($rcResult,"array");
		settype($sbSql,"string");
		
		extract($this->rcData);
		
		$sbSql = 'SELECT * 
		FROM "tablastipole" 
		WHERE "tablastipole"."tatlnomtabls"=\''.$entidad.'\' AND "tablastipole"."langcodigos"=\''.$langcodigos.'\' 
		ORDER BY "tablastipole"."tatlcodigos"';
		
		$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		$rcResult = $this->objdb->rcresult;
		
        $this->rcResult = $rcResult;
	}
	
	/**
	 * @Copyright 2012 Parquesoft
	 *
	 * Obtiene los descritores de una tabla de acuerdo a parametros
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getTablastipoleByParams(){
		settype($rcResult,"array");
		settype($sbSql,"string");
		settype($sbTmp,"string");
		
		extract($this->rcData);
		
		if($tatlnomtabls){
			$sbTmp=' "tatlnomtabls"=\''.$tatlnomtabls.'\' ';
		}
		if($tatlnomcacos){
			if($sbTmp){
				$sbTmp .= " AND ";
				$sbTmp .=' "tatlnomcacos"=\''.$tatlnomcacos.'\' ';
			}
		}
		if($tatlnocadess){
			if($sbTmp){
				$sbTmp .= " AND ";
				$sbTmp .=' "tatlnocadess"=\''.$tatlnocadess.'\' ';
			}
		}
		if($tatlvalcods){
			if($sbTmp){
				$sbTmp .= " AND ";
				$sbTmp .=' "tatlvalcods"=\''.$tatlvalcods.'\' ';
			}
		}
		if($langcodigos){
			if($sbTmp){
				$sbTmp .= " AND ";
				$sbTmp .=' "langcodigos"=\''.$langcodigos.'\' ';
			}
		}
		$sbSql = 'SELECT * FROM "tablastipole" ';
		if($sbTmp){
			$sbSql .= " WHERE ".$sbTmp;
		} 
		 
		$sbSql .= ' ORDER BY "tablastipole"."tatlcodigos"';
		
		$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		$rcResult = $this->objdb->rcresult;
		
        $this->rcResult = $rcResult;
	}
	
} //End of Class pregformula
?>