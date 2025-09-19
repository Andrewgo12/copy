<?php
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeGePgsqlEquivalencia {

	function FeGePgsqlEquivalencia() {
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

	function existEquivalencias() {

		settype($sbSql,"string");
		settype($nuCant,"integer");

		extract($this->rcData);
		$sbSql = 'SELECT * FROM "equivalencias" WHERE "equicodigon"=\''.$equicodigon.'\'';
		$this->objdb->fncadoexecute($sbSql);
		$nuCant = $this->objdb->fncadorowcont();
		if($nuCant>0){
			$this->consult = true;
		}else{
			$this->consult = false;
		}
	}
	function addEquivalencias() {

		settype($sbSql,"string");
		extract($this->rcData);

		$sbSql = 'INSERT INTO "equivalencias" ("equicodigon","equitablcros","equicampcros","equivalcros","equinomcros",
		"equiareacros","equitabldocs","equicampdocs","equivaldocs","equinomdocs","equiareadocs","equiseridocs","equifechacrn","equiestados")'
		.' VALUES('.$equicodigon.',\''.$equitablcros.'\',\''.$equicampcros.'\',\''.$equivalcros.'\',
		\''.$equinomcros.'\',\''.$equiareacros.'\',\''.$equitabldocs.'\',\''.$equicampdocs.'\',\''.$equivaldocs.'\',\''.$equinomdocs.'\',\''.
		$equiareadocs.'\',\''.$equiseridocs.'\','.$equifechacrn.',\''.$equiestados.'\')';

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
	 * Obtiene los registros de la tabla equivalencias
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getEquivalencias(){

		settype($rcResult,"array");
		settype($rcTmp,"array");
		settype($sbSql,"string");
		settype($sbTmp,"string");

		extract($this->rcData);

		if($equicodigon){
			$rcTmp[] = ' "equivalencias"."equicodigon"='.$equicodigon.' ';
		}

		if($equitablcros){
			$rcTmp[] = ' "equivalencias"."equitablcros"=\''.$equitablcros.'\' ';
		}
		if($equicampcros){
			$rcTmp[] = ' "equivalencias"."equicampcros"=\''.$equicampcros.'\' ';
		}
		if($equivalcros){
			$rcTmp[] = ' "equivalencias"."equivalcros"=\''.$equivalcros.'\' ';
		}
		if($equinomcros){
			$rcTmp[] = ' "equivalencias"."equinomcros"=\''.$equinomcros.'\' ';
		}
		if($equiareacros){
			$rcTmp[] = ' "equivalencias"."equiareacros"=\''.$equiareacros.'\' ';
		}
		if($equitabldocs){
			$rcTmp[] = ' "equivalencias"."equitabldocs"=\''.$equitabldocs.'\' ';
		}
		if($equicampdocs){
			$rcTmp[] = ' "equivalencias"."equicampdocs"=\''.$equicampdocs.'\' ';
		}
		if($equivaldocs){
			$rcTmp[] = ' "equivalencias"."equivaldocs"=\''.$equivaldocs.'\' ';
		}
		if($equinomdocs){
			$rcTmp[] = ' "equivalencias"."equinomdocs"=\''.$equinomdocs.'\' ';
		}
		if($equiareadocs){
			$rcTmp[] = ' "equivalencias"."equiareadocs"=\''.$equiareadocs.'\' ';
		}
		if($equiseridocs){
			$rcTmp[] = ' "equivalencias"."equiseridocs"=\''.$equiseridocs.'\' ';
		}
		if($equifechacrn){
			$rcTmp[] = ' "equivalencias"."equifechacrn"='.$equifechacrn.' ';
		}
		if($equiestados){
			$rcTmp[] = ' "equivalencias"."equiestados"=\''.$equiestados.'\' ';
		}

		$sbSql = 'SELECT * FROM "equivalencias" ';

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
	 * Obtiene los registros de la tabla equivalencia caso
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getEquivalenciacaso(){

		settype($rcResult,"array");
		settype($rcTmp,"array");
		settype($sbSql,"string");
		settype($sbTmp,"string");

		extract($this->rcData);

		if($eqcacodigon){
			$rcTmp[] = ' "equivalenciacaso"."eqcacodigon"='.$eqcacodigon.' ';
		}

		if($equicodigon){
			$rcTmp[] = ' "equivalenciacaso"."equicodigon"=\''.$equicodigon.'\' ';
		}
		if($ordenumeros){
			$rcTmp[] = ' "equivalenciacaso"."ordenumeros"=\''.$ordenumeros.'\' ';
		}
		if($equifecharen){
			$rcTmp[] = ' "equivalenciacaso"."equifecharen"=\''.$equifecharen.'\' ';
		}

		$sbSql = 'SELECT * FROM "equivalenciacaso" ';

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
	 * actualiza la tabla de equivalencias
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function updateEquivalencias() {

		settype($rcTmp,"array");
		settype($sbSql,"string");
		settype($sbTmp,"string");

		extract($this->rcData);

		if($equitablcros){
			$rcTmp[] = ' "equitablcros"=\''.$equitablcros.'\' ';
		}

		if($equicampcros){
			$rcTmp[] = ' "equicampcros"=\''.$equicampcros.'\' ';
		}
		if($equivalcros){
			$rcTmp[] = ' "equivalcros"=\''.$equivalcros.'\' ';
		}
		if($equinomcros){
			$rcTmp[] = ' "equinomcros"=\''.$equinomcros.'\' ';
		}
		if($equiareacros){
			$rcTmp[] = ' "equiareacros"=\''.$equiareacros.'\' ';
		}
		if($equitabldocs){
			$rcTmp[] = ' "equitabldocs"=\''.$equitabldocs.'\' ';
		}
		if($equicampdocs){
			$rcTmp[] = ' "equicampdocs"=\''.$equicampdocs.'\' ';
		}
		if($equivaldocs){
			$rcTmp[] = ' "equivaldocs"=\''.$equivaldocs.'\' ';
		}
		if($equinomdocs){
			$rcTmp[] = ' "equinomdocs"=\''.$equinomdocs.'\' ';
		}
		if($equiareadocs){
			$rcTmp[] = ' "equiareadocs"=\''.$equiareadocs.'\' ';
		}
		if($equiseridocs){
			$rcTmp[] = ' "equiseridocs"=\''.$equiseridocs.'\' ';
		}
		if($equifechacrn){
			$rcTmp[] = ' "equifechacrn"='.$equifechacrn.' ';
		}
		if($equiestados){
			$rcTmp[] = ' "equiestados"=\''.$equiestados.'\' ';
		}
		if(is_array($rcTmp) && $rcTmp){
			$sbTmp = implode(" , ",$rcTmp);
		}

		$sbSql = 'UPDATE "equivalencias" SET  ';
		$sbSql .= $sbTmp;
		$sbSql .= '  WHERE "equicodigon"='.$equicodigon;

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
	function deleteEquivalencias() {

		settype($sbSql,"string");

		extract($this->rcData);

		$sbSql = 'DELETE FROM "equivalencias" WHERE "equicodigon"=\''.$equicodigon.'\'';

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
	function getByIdEquivalencias($equicodigon) {
		$sql = 'SELECT * FROM "equivalencias" WHERE "equicodigon"=\''.$equicodigon.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getAllEquivalencias() {
		$sql = 'SELECT * FROM "equivalencias"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getByEquivalencias_fkey($equivalcros) {
		$sql = 'SELECT * FROM "equivalencias" WHERE "equivalcros"=\''.$equivalcros.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getequicodigon($equicodigon) {
		$sql = 'SELECT "equicodigon" FROM "equivalencias" WHERE "equicodigon"=\''.$equicodigon.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getequitablcros($equicodigon) {
		$sql = 'SELECT "equitablcros" FROM "equivalencias" WHERE "equicodigon"=\''.$equicodigon.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getequicampcros($equicodigon) {
		$sql = 'SELECT "equicampcros" FROM "equivalencias" WHERE "equicodigon"=\''.$equicodigon.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getequivalcros($equicodigon) {
		$sql = 'SELECT "equivalcros" FROM "equivalencias" WHERE "equicodigon"=\''.$equicodigon.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getequinomcros($equicodigon) {
		$sql = 'SELECT "equinomcros" FROM "equivalencias" WHERE "equicodigon"=\''.$equicodigon.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getequitabldocs($equicodigon) {
		$sql = 'SELECT "equitabldocs" FROM "equivalencias" WHERE "equicodigon"=\''.$equicodigon.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getequicampdocs($equicodigon) {
		$sql = 'SELECT "equicampdocs" FROM "equivalencias" WHERE "equicodigon"=\''.$equicodigon.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getequivaldocs($equicodigon) {
		$sql = 'SELECT "equivaldocs" FROM "equivalencias" WHERE "equicodigon"=\''.$equicodigon.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getequinomdocs($equicodigon) {
		$sql = 'SELECT "equinomdocs" FROM "equivalencias" WHERE "equicodigon"=\''.$equicodigon.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getequifechacrn($equicodigon) {
		$sql = 'SELECT "equifechacrn" FROM "equivalencias" WHERE "equicodigon"=\''.$equicodigon.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getequiestados($equicodigon) {
		$sql = 'SELECT "equiestados" FROM "equivalencias" WHERE "equicodigon"=\''.$equicodigon.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Equivalencia
?>