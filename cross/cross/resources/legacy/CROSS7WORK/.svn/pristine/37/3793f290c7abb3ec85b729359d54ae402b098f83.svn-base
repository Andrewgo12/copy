<?php
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeEnPgsqlRespuestausu {

	function FeEnPgsqlRespuestausu() {
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
	 * Ingreso de la respuesta del usuario
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function addRespuestausu(){

		settype($sbSql,"string");
		extract($this->rcData);

		$sbSql = 'INSERT INTO "respuestausu" ("reuscodigon","formcodigon","reusfecingn",
										"usuacodigos","reusdirips","ordenumeros",
										"orgacodigos","contindentis","paciindentis")'
										.' VALUES('.$reuscodigon.','.$formcodigon.','.$reusfecingn.',\''.$usuacodigos.'\',\''.
										$reusdirips.'\',\''.$ordenumeros.'\',\''.$orgacodigos.'\',\''.$contindentis.'\',\''.$paciindentis.'\')';

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
	 * @Copyright 2010 Parquesoft
	 *
	 * Obtiene las respuestas de usuario relacionadas a un formulario
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getByIdFormulario(){
		
		settype($rcResult,"array");
		settype($sbSql,"string");
		extract($this->rcData);
		
		$sbSql = 'SELECT * FROM "respuestausu" WHERE "respuestausu"."formcodigon"='.$formcodigon;
		if($perscodigos)
			$sbSql .= ' AND "perscodigos"=\''.$perscodigos.'\'';
		
		if(!$this->executeSql){
			$this->_rcSql[] = $sbSql;
			return;
		}
		$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		$rcResult = $this->objdb->rcresult;
		
        $this->rcResult = $rcResult;	
		
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
	 * @Copyright 2014 Parquesoft
	 *
	 * Obtiene las respuestas de usuario relacionadas a un formulario
	 * @author freina<freina@fullengine.com>
	 *
	 * @location Cali - Colombia
	 */
	function getRespuestausu(){

		settype($rcResult,"array");
		settype($rcTmp,"array");
		settype($sbSql,"string");
		settype($sbTmp,"string");
		settype($sbOrder,"string");

		extract($this->rcData);

		if($reuscodigon){
			$rcTmp[] = ' "reuscodigon"='.$reuscodigon.' ';
		}

		if($formcodigon){
			$rcTmp[] = ' "formcodigon"='.$formcodigon.' ';
		}

		if($reusfecingn){
			$rcTmp[] = ' "reusfecingn"=\''.$reusfecingn.'\' ';
		}

		if($usuacodigos){
			$rcTmp[] = ' "usuacodigos"=\''.$usuacodigos.'\' ';
		}

		if($reusdirips){
			$rcTmp[] = ' "reusdirips"=\''.$reusdirips.'\' ';
		}

		if($ordenumeros){
			$rcTmp[] = ' "ordenumeros"=\''.$ordenumeros.'\' ';
		}

		if($orgacodigos){
			$rcTmp[] = ' "orgacodigos"=\''.$orgacodigos.'\' ';
		}
		
		if($orgacodigos_in){
			if(is_array($orgacodigos_in) && $orgacodigos_in){
				$sbTmp = implode("','", $orgacodigos_in);
			}
			$rcTmp[] = ' "orgacodigos" IN (\''.$sbTmp.'\') ';
		}

		if($contindentis){
			$rcTmp[] = ' "contindentis"=\''.$contindentis.'\' ';
		}

		if($fechaini && $fechafin){
			$rcTmp[] = ' "reusfecingn" BETWEEN '.$fechaini." AND ".$fechafin.' ';
		}

		$sbSql = 'SELECT * FROM "respuestausu" ';

		if(is_array($rcTmp) && $rcTmp){
			$sbTmp = implode(" AND ",$rcTmp);
			$sbSql .= ' WHERE ';
			$sbSql .= $sbTmp;
		}
		
		if($order_by){
			$rcTmp = explode(",",$order_by);
			$sbOrder = ' ORDER BY ';
			$sbTmp = implode ('","',$rcTmp);
			$sbSql .= $sbOrder.'"'.$sbTmp.'"';
		}

		if(!$this->executeSql){
			$this->_rcSql[] = $sbSql;
			return;
		}
		$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		$rcResult = $this->objdb->rcresult;

		$this->rcResult = $rcResult;

	}
} //End of Class Respuestausu
?>