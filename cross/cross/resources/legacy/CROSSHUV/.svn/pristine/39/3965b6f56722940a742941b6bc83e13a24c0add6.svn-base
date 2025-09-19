<?php
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeGePgsqlIntegralog {

	function FeGePgsqlIntegralog() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
		$this->executeSql = true;
	}
	/**
	 * @Copyright 2010 Parquesoft
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
	 * @Copyright 2010 Parquesoft
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
	 * @Copyright 2010 Parquesoft
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
	 * @Copyright 2010 Parquesoft
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
	 * @Copyright 2010 Parquesoft
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
	 * @Copyright 2010 Parquesoft
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
	 * @Copyright 2010 Parquesoft
	 *
	 * Ingreso de maestro del log
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function addIntegralog(){

		settype($sbSql,"string");
		extract($this->rcData);

		$sbSql = 'INSERT INTO "integralog" ("inlocodigon","inlofchaejin","inloidcrosss","inlousuarios","inloapps","inloerrors","inloestados")'
		.' VALUES('.$inlocodigon.','.$inlofchaejin.',\''.$inloidcrosss.'\',\''.$inlousuarios.'\',\''.$inloapps.'\',\''.$inloerrors.'\',\''.$inloestados.'\')';

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
	 * Ingreso del detalle del log para docunet
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function addIntelogdoc(){

		settype($sbSql,"string");
		extract($this->rcData);

		$sbSql = 'INSERT INTO "intelogdoc" ("inlocodigon","nmbre_srie","nmbre_tpo_crpta","nmbre_crpta","nmbre_tpo_dcto",
		"nmbre_dcto","ext","fncnrio","c_indice1","c_indice2","c_indice3","c_indice4","c_descripcion","d_indice1",
		"d_indice2","d_indice3","d_indice4","d_indice5","d_indice6","d_indice7","d_indice8","d_indice9","d_descripcion","d_id_cross","exto","texto_error")'
		.' VALUES('.$inlocodigon.',\''.$nmbre_srie.'\',\''.$nmbre_tpo_crpta.'\',\''.$nmbre_crpta.'\'
		,\''.$nmbre_tpo_dcto.'\',\''.$nmbre_dcto.'\',\''.$ext.'\',\''.$fncnrio.'\',\''.$c_indice1.'\'
		,\''.$c_indice2.'\',\''.$c_indice3.'\',\''.$c_indice4.'\',\''.$c_descripcion.'\',\''.$d_indice1.'\'
		,\''.$d_indice2.'\',\''.$d_indice3.'\',\''.$d_indice4.'\',\''.$d_indice5.'\',\''.$d_indice6.'\'
		,\''.$d_indice7.'\',\''.$d_indice8.'\',\''.$d_indice9.'\',\''.$d_descripcion.'\',\''.$d_id_cross.'\'
		,\''.$exto.'\',\''.$texto_error.'\')';

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
	 * @Copyright 2010 Parquesoft
	 *
	 * Obtiene los registros del log de integracion
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getIntegration(){

		settype($rcResult,"array");
		settype($rcTmp,"array");
		settype($sbSql,"string");
		settype($sbTmp,"string");

		extract($this->rcData);

		if($inlofchaejin1 && $inlofchaejin2){
			$rcTmp[] = ' "inlofchaejin" BETWEEN '.$inlofchaejin1.' AND '.$inlofchaejin2.' ';
		}

		if($inloestados){
			$rcTmp[] = ' "inloestados"=\''.$inloestados.'\' ';
		}
		
		if($inloapps){
			$rcTmp[] = ' "inloapps"=\''.$inloapps.'\' ';
		}
		
		if($inloidcrosss){
			$rcTmp[] = ' "inloidcrosss"=\''.$inloidcrosss.'\' ';
		}
		
		if($inlousuarios){
			$rcTmp[] = ' "inlousuarios"=\''.$inlousuarios.'\' ';
		}

		if($inlocodigon){
			$rcTmp[] = ' "inlocodigon"='.$inlocodigon.' ';
		}

		$sbSql = 'SELECT "integralog"."inlocodigon","integralog"."inlofchaejin","integralog"."inloidcrosss",'
		                 .'"integralog"."inlofchaejfn","integralog"."inlousuarios","integralog"."inloapps",'
		                 .'"integralog"."inloerrors","integralog"."inloestados" FROM "integralog" ';

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

	/**
	 * @Copyright 2010 Parquesoft
	 *
	 * Obtiene los registros del detalle de docunet
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getDetailIntegrationDoc(){

		settype($rcResult,"array");
		settype($rcTmp,"array");
		settype($sbSql,"string");
		settype($sbTmp,"string");

		extract($this->rcData);

		if($inlocodigon){
			$rcTmp[] = ' "intelogdoc"."inlocodigon"='.$inlocodigon.' ';
		}
		
		if($d_id_cross){
			$rcTmp[] = ' "intelogdoc"."d_id_cross"='.$d_id_cross.' ';
		}
		
		if($nmbre_crpta_inn){
			$rcTmp[] = ' "intelogdoc"."nmbre_crpta" IS NOT NULL ';
		}

		$sbSql = 'SELECT * FROM "intelogdoc" ';

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

	/**
	 * @Copyright 2010 Parquesoft
	 *
	 * actualiza el maestro del log
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function setIntegration(){

		settype($rcTmp,"array");
		settype($sbSql,"string");
		settype($sbTmp,"string");

		extract($this->rcData);

		if($inloerrors){
			$rcTmp[] = ' "inloerrors"=\''.$inloerrors.'\' ';
		}

		if($inlofchaejfn){
			$rcTmp[] = ' "inlofchaejfn"='.$inlofchaejfn.' ';
		}

		if($inloestados){
			$rcTmp[] = ' "inloestados"=\''.$inloestados.'\' ';
		}

		if(is_array($rcTmp) && $rcTmp){
			$sbTmp = implode(" , ",$rcTmp);
		}

		$sbSql = 'UPDATE "integralog" SET  ';
		$sbSql .= $sbTmp;
		$sbSql .= '  WHERE "inlocodigon"='.$inlocodigon;

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
	 * @Copyright 2010 Parquesoft
	 *
	 * actualiza el detalle del log para docunet
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function setDetailIntegrationDoc(){
		settype($rcTmp,"array");
		settype($sbSql,"string");
		settype($sbTmp,"string");

		extract($this->rcData);

		if($texto_error){
			$rcTmp[] = ' "texto_error"=\''.$texto_error.'\' ';
		}
		
		if($nmbre_srie){
			$rcTmp[] = ' "nmbre_srie"=\''.$nmbre_srie.'\' ';
		}
		if($nmbre_tpo_crpta){
			$rcTmp[] = ' "nmbre_tpo_crpta"=\''.$nmbre_tpo_crpta.'\' ';
		}
		if($nmbre_crpta){
			$rcTmp[] = ' "nmbre_crpta"=\''.$nmbre_crpta.'\' ';
		}
		if($nmbre_tpo_dcto){
			$rcTmp[] = ' "nmbre_tpo_dcto"=\''.$nmbre_tpo_dcto.'\' ';
		}
		if($nmbre_dcto){
			$rcTmp[] = ' "nmbre_dcto"=\''.$nmbre_dcto.'\' ';
		}
		if($ext){
			$rcTmp[] = ' "ext"=\''.$ext.'\' ';
		}
		if($fncnrio){
			$rcTmp[] = ' "fncnrio"=\''.$fncnrio.'\' ';
		}
		
		if(isset($exto)){
			$rcTmp[] = ' "exto"=\''.$exto.'\' ';
		}

		if(is_array($rcTmp) && $rcTmp){
			$sbTmp = implode(" , ",$rcTmp);
		}

		$sbSql = 'UPDATE "intelogdoc" SET  ';
		$sbSql .= $sbTmp;
		$sbSql .= '  WHERE "inlocodigon"='.$inlocodigon;

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
	 * @Copyright 2010 Parquesoft
	 *
	 * Ingreso del detalle del log para sipa
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function addIntelogsip(){

		settype($sbSql,"string");
		extract($this->rcData);

		$sbSql = 'INSERT INTO "intelogsip" ("inlocodigon","area","serie","tipo_carpeta","sol_id",
		"sol_nombre","fecha_reg","usuario","localizacion","observaciones","caso","codigo_error","texto_error")'
		.' VALUES('.$inlocodigon.',\''.$area.'\',\''.$serie.'\',\''.$tipo_carpeta.'\'
		,\''.$sol_id.'\',\''.$sol_nombre.'\',\''.$fecha_reg.'\',\''.$usuario.'\',\''.$localizacion.'\'
		,\''.$observaciones.'\',\''.$caso.'\',\''.$codigo_error.'\',\''.$texto_error.'\')';

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
	 * Obtiene los registros del detalle del sistema sipa
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getDetailIntegrationSip(){

		settype($rcResult,"array");
		settype($rcTmp,"array");
		settype($sbSql,"string");
		settype($sbTmp,"string");

		extract($this->rcData);

		if($inlocodigon){
			$rcTmp[] = ' "intelogsip"."inlocodigon"='.$inlocodigon.' ';
		}

		$sbSql = 'SELECT * FROM "intelogsip" ';

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
	
	/**
	 * @Copyright 2010 Parquesoft
	 *
	 * actualiza el detalle del log para el sistema SIPA
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function setDetailIntegrationSip(){
		settype($rcTmp,"array");
		settype($sbSql,"string");
		settype($sbTmp,"string");

		extract($this->rcData);
		
		if($texto_error){
			$rcTmp[] = ' "texto_error"=\''.$texto_error.'\' ';
		}

		if($area){
			$rcTmp[] = ' "area"=\''.$area.'\' ';
		}
		
		if($serie){
			$rcTmp[] = ' "serie"=\''.$serie.'\' ';
		}
		if($tipo_carpeta){
			$rcTmp[] = ' "tipo_carpeta"=\''.$tipo_carpeta.'\' ';
		}
		if($localizacion){
			$rcTmp[] = ' "localizacion"=\''.$localizacion.'\' ';
		}

		if(is_array($rcTmp) && $rcTmp){
			$sbTmp = implode(" , ",$rcTmp);
		}

		$sbSql = 'UPDATE "intelogsip" SET  ';
		$sbSql .= $sbTmp;
		$sbSql .= '  WHERE "inlocodigon"='.$inlocodigon;

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
//==========================================
	/**
	 * @Copyright 2010 Parquesoft
	 *
	 * Datos para el reporte de Casos con soporte en docunet o sipa
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getDataReport(){

		settype($rcResult,"array");
		settype($rcTmp,"array");
		settype($sbSql,"string");
		settype($sbTmp,"string");
		settype($sbStatus,"string");

		extract($this->rcData);

		if($usuacodigos){
			$sbTmp = ' AND "orden"."usuacodigos" = \''.$usuacodigos.'\' ';
		}

		$sbStatus = Application :: getConstant("REG_ACT");

		//cantidad de casos con soporte por tipo
		$sbSql = 'SELECT "ordenempresa"."tiorcodigos", COUNT ("ordenempresa"."tiorcodigos") AS "cant"
		FROM "orden", 
		"ordenempresa",
		(SELECT DISTINCT "integralog"."inloidcrosss" FROM "integralog" WHERE "integralog"."inloapps"=\''.$inloapps.'\' AND "integralog"."inloestados" = \''.$sbStatus.'\') AS "integralog" 
		WHERE "orden"."ordefecregd" BETWEEN '.$ordefecregd1.' AND '.$ordefecregd2.' 
		'.$sbTmp.'
		AND "orden"."ordenumeros" = "integralog"."inloidcrosss" 
		AND "orden"."ordenumeros" = "ordenempresa"."ordenumeros" 
		GROUP BY "ordenempresa"."tiorcodigos" ';

		if(!$this->executeSql){
			$this->_rcSql[] = $sbSql;
			return;
		}
		$this->objdb->fncadoselect($sbSql, FETCH_NUM);
		$rcTmp = $this->objdb->rcresult;

		if(is_array($rcTmp) && $rcTmp){
			$rcResult["data"] = $rcTmp;
		}

		//cantidad total de casos
		$sbSql = 'SELECT COUNT(*)AS "cant" FROM "orden" WHERE "orden"."ordefecregd" BETWEEN '.$ordefecregd1.' AND '.$ordefecregd2.$sbTmp;

		if(!$this->executeSql){
			$this->_rcSql[] = $sbSql;
			return;
		}
		$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		$rcTmp = $this->objdb->rcresult;

		if(is_array($rcTmp) && $rcTmp){
			$rcResult["total"] = $rcTmp[0]["cant"];
		}
		
		//cantidad de casos con soporte
		$sbSql = 'SELECT COUNT (*) AS "cant"
		FROM "orden", 
		"ordenempresa",
		(SELECT DISTINCT "integralog"."inloidcrosss" FROM "integralog" WHERE "integralog"."inloapps"=\''.$inloapps.'\' AND "integralog"."inloestados" = \''.$sbStatus.'\') AS "integralog" 
		WHERE "orden"."ordefecregd" BETWEEN '.$ordefecregd1.' AND '.$ordefecregd2.' 
		'.$sbTmp.'
		AND "orden"."ordenumeros" = "integralog"."inloidcrosss" 
		AND "orden"."ordenumeros" = "ordenempresa"."ordenumeros"';

		if(!$this->executeSql){
			$this->_rcSql[] = $sbSql;
			return;
		}
		$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		$rcTmp = $this->objdb->rcresult;

		if(is_array($rcTmp) && $rcTmp){
			$rcResult["totalCS"] = $rcTmp[0]["cant"];
		}

		$this->rcResult = $rcResult;
	}
} //End of Class integralog
?>