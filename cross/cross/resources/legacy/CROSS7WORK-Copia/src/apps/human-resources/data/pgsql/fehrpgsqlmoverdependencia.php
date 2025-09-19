<?php
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeHrPgsqlMoverDependencia {

	function FeHrPgsqlMoverDependencia() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
		$this->executeSql = true;
	}
	/**
	 * @Copyright 2013 Fullengine
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
	 * @Copyright 2013 Fullengine
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
	 * @Copyright 2013 Fullengine
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
	 * @Copyright 2013 Fullengine
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
	 * @Copyright 2013 Fullengine
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
	 * @Copyright 2013 Fullengine
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
	 * @Copyright 2013 Fullengine
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
	 * @Copyright 2013 Fullengine
	 *
	 * actualiza la tabla acta
	 * @author freina<freina@fullengine.com>
	 *
	 * @location Cali - Colombia
	 */
	function setActa(){

		settype($rcTmp,"array");
		settype($sbSql,"string");
		settype($sbTmp,"string");

		extract($this->rcData);

		if($orgacodigos){
			$rcTmp[] = ' "orgacodigos"=\''.$orgacodigos.'\' ';
		}


		if(is_array($rcTmp) && $rcTmp){
			$sbTmp = implode(" , ",$rcTmp);
		}

		$sbSql = 'UPDATE "acta" SET  ';
		$sbSql .= $sbTmp;

		if($orgacodigos_old){
			$sbSql .= '  WHERE "orgacodigos"=\''.$orgacodigos_old.'\'';
		}else{
			$sbSql .= '  WHERE "actacodigos"=\''.$actacodigos.'\'';
		}


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
	 * @Copyright 2013 Fullengine
	 *
	 * actualiza la tabla actaempresa
	 * @author freina<freina@fullengine.com>
	 *
	 * @location Cali - Colombia
	 */
	function setActaempresa(){

		settype($rcTmp,"array");
		settype($sbSql,"string");
		settype($sbTmp,"string");

		extract($this->rcData);

		if($orgacodigos){
			$rcTmp[] = ' "orgacodigos"=\''.$orgacodigos.'\' ';
		}


		if(is_array($rcTmp) && $rcTmp){
			$sbTmp = implode(" , ",$rcTmp);
		}

		$sbSql = 'UPDATE "actaempresa" SET  ';
		$sbSql .= $sbTmp;
		$sbSql .= '  WHERE "orgacodigos"=\''.$orgacodigos_old.'\'';

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
	 * @Copyright 2013 Fullengine
	 *
	 * actualiza la tabla bodega
	 * @author freina<freina@fullengine.com>
	 *
	 * @location Cali - Colombia
	 */
	function setBodega(){

		settype($rcTmp,"array");
		settype($sbSql,"string");
		settype($sbTmp,"string");

		extract($this->rcData);

		if($orgacodigos){
			$rcTmp[] = ' "orgacodigos"=\''.$orgacodigos.'\' ';
		}


		if(is_array($rcTmp) && $rcTmp){
			$sbTmp = implode(" , ",$rcTmp);
		}

		$sbSql = 'UPDATE "bodega" SET  ';
		$sbSql .= $sbTmp;
		$sbSql .= '  WHERE "orgacodigos"=\''.$orgacodigos_old.'\'';

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
	 * @Copyright 2013 Fullengine
	 *
	 * actualiza la tabla email
	 * @author freina<freina@fullengine.com>
	 *
	 * @location Cali - Colombia
	 */
	function setEmail(){

		settype($rcTmp,"array");
		settype($sbSql,"string");
		settype($sbTmp,"string");

		extract($this->rcData);

		if($orgacodigos){
			$rcTmp[] = ' "orgacodigos"=\''.$orgacodigos.'\' ';
		}


		if(is_array($rcTmp) && $rcTmp){
			$sbTmp = implode(" , ",$rcTmp);
		}

		$sbSql = 'UPDATE "email" SET  ';
		$sbSql .= $sbTmp;
		$sbSql .= '  WHERE "orgacodigos"=\''.$orgacodigos_old.'\'';

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
	 * @Copyright 2013 Fullengine
	 *
	 * actualiza la tabla ordenempresa
	 * @author freina<freina@fullengine.com>
	 *
	 * @location Cali - Colombia
	 */
	function setOrdenempresa(){

		settype($rcTmp,"array");
		settype($sbSql,"string");
		settype($sbTmp,"string");

		extract($this->rcData);

		if($orgacodigos){
			$rcTmp[] = ' "orgacodigos"=\''.$orgacodigos.'\' ';
		}


		if(is_array($rcTmp) && $rcTmp){
			$sbTmp = implode(" , ",$rcTmp);
		}

		$sbSql = 'UPDATE "ordenempresa" SET  ';
		$sbSql .= $sbTmp;
		$sbSql .= '  WHERE "orgacodigos"=\''.$orgacodigos_old.'\'';

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
	 * @Copyright 2013 Fullengine
	 *
	 * actualiza la tabla ordenempresa_log
	 * @author freina<freina@fullengine.com>
	 *
	 * @location Cali - Colombia
	 */
	function setOrdenempresa_log(){

		settype($rcTmp,"array");
		settype($sbSql,"string");
		settype($sbTmp,"string");

		extract($this->rcData);

		if($orgacodigos){
			$rcTmp[] = ' "orgacodigos"=\''.$orgacodigos.'\' ';
		}


		if(is_array($rcTmp) && $rcTmp){
			$sbTmp = implode(" , ",$rcTmp);
		}

		$sbSql = 'UPDATE "ordenempresa_log" SET  ';
		$sbSql .= $sbTmp;
		$sbSql .= '  WHERE "orgacodigos"=\''.$orgacodigos_old.'\'';

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
	 * @Copyright 2013 Fullengine
	 *
	 * actualiza la tabla transfertarea
	 * @author freina<freina@fullengine.com>
	 *
	 * @location Cali - Colombia
	 */
	function setTransfertarea(){

		settype($rcTmp,"array");
		settype($sbSql,"string");
		settype($sbTmp,"string");

		extract($this->rcData);

		if($orgacodigos){
			$rcTmp[] = ' "orgacodigos"=\''.$orgacodigos.'\' ';
		}


		if(is_array($rcTmp) && $rcTmp){
			$sbTmp = implode(" , ",$rcTmp);
		}

		$sbSql = 'UPDATE "transfertarea" SET  ';
		$sbSql .= $sbTmp;
		$sbSql .= '  WHERE "orgacodigos"=\''.$orgacodigos_old.'\'';

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
	 * @Copyright 2013 Fullengine
	 *
	 * actualiza la tabla detaretape
	 * @author freina<freina@fullengine.com>
	 *
	 * @location Cali - Colombia
	 */
	function setDetaretape(){

		settype($rcTmp,"array");
		settype($sbSql,"string");
		settype($sbTmp,"string");

		extract($this->rcData);

		if($orgacodigos){
			$rcTmp[] = ' "orgacodigos"=\''.$orgacodigos.'\' ';
		}


		if(is_array($rcTmp) && $rcTmp){
			$sbTmp = implode(" , ",$rcTmp);
		}

		$sbSql = 'UPDATE "detaretape" SET  ';
		$sbSql .= $sbTmp;
		$sbSql .= '  WHERE "orgacodigos"=\''.$orgacodigos_old.'\'';

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
	 * @Copyright 2013 Fullengine
	 *
	 * actualiza la tabla organentrada
	 * @author freina<freina@fullengine.com>
	 *
	 * @location Cali - Colombia
	 */
	function setOrganentrada(){

		settype($rcTmp,"array");
		settype($sbSql,"string");
		settype($sbTmp,"string");

		extract($this->rcData);

		if($orgacodigos){
			$rcTmp[] = ' "orgacodigos"=\''.$orgacodigos.'\' ';
		}


		if(is_array($rcTmp) && $rcTmp){
			$sbTmp = implode(" , ",$rcTmp);
		}

		$sbSql = 'UPDATE "organentrada" SET  ';
		$sbSql .= $sbTmp;
		$sbSql .= '  WHERE "orgacodigos"=\''.$orgacodigos_old.'\'';

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
	 * @Copyright 2013 Fullengine
	 *
	 * actualiza la tabla respuestausu
	 * @author freina<freina@fullengine.com>
	 *
	 * @location Cali - Colombia
	 */
	function setRespuestausu(){

		settype($rcTmp,"array");
		settype($sbSql,"string");
		settype($sbTmp,"string");

		extract($this->rcData);

		if($orgacodigos){
			$rcTmp[] = ' "orgacodigos"=\''.$orgacodigos.'\' ';
		}


		if(is_array($rcTmp) && $rcTmp){
			$sbTmp = implode(" , ",$rcTmp);
		}

		$sbSql = 'UPDATE "respuestausu" SET  ';
		$sbSql .= $sbTmp;
		$sbSql .= '  WHERE "orgacodigos"=\''.$orgacodigos_old.'\'';

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

	function saveLogRotacion() {
		
		settype($sbSql, "string");
		
		extract($this->rcData);

		$sbSql = 'INSERT INTO "logrotacion" ("loroorolcods","loroornecods","loroornenoms","loroorcopaos","loroorcopans","loroordpads","loroordnews","lorofechregn","usuacodigos")'
		.' VALUES(\''.$loroorolcods.'\',\''.$loroornecods.'\',\''.$loroornenoms.'\',\''.$loroorcopaos.'\',\''.$loroorcopans.'\' ,\''.$loroordpads.'\',\''.$loroordnews.'\','.$lorofechregn.',\''.$usuacodigos.'\')';

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

} //End of Class  mover dependencia
?>