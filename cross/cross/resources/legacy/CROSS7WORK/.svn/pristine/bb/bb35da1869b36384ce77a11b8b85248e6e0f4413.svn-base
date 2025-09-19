<?php
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeCuPgsqlPaciente {

	function FeCuPgsqlPaciente() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
		$this->executeSql = true;
	}
	
	/**
	 * @Copyright 2015 Fullengine
	 *
	 * Modifica el arreglo de datos
	 * @author freina<freina@Fullengine.com>
	 *
	 * @location Cali - Colombia
	 */
	function setData($rcData){
		$this->rcData = $rcData;
	}
	
	/**
	 * @Copyright 2015 Fullengine
	 *
	 * Obtiene el resultado de la consulta
	 * @author freina<freina@Fullengine.com>
	 *
	 * @location Cali - Colombia
	 */
	function getConsult(){
		return $this->consult;
	}
	/**
	 * @Copyright 2015 Fullengine
	 *
	 * determina si se ejecuta el sql
	 * @author freina<freina@Fullengine.com>
	 *
	 * @location Cali - Colombia
	 */
	function setExecuteSql($blState) {
		$this->executeSql = $blState;
	}
	/**
	 * @Copyright 2015 Fullengine
	 *
	 * obtiene el sql
	 * @author freina<freina@Fullengine.com>
	 *
	 * @location Cali - Colombia
	 */
	function getSql(){
		return $this->_rcSql;
	}
	/**
	 * @Copyright 2015 Fullengine
	 *
	 * Obtiene el resultado de la consulta (data)
	 * @author freina<freina@Fullengine.com>
	 *
	 * @location Cali - Colombia
	 */
	function getResult(){
		return $this->rcResult;
	}
	/**
	 * @Copyright 2015 Fullengine
	 *
	 * Conjunto de sql a ejecutar
	 * @author freina<freina@Fullengine.com>
	 *
	 * @location Cali - Colombia
	 */
	function setSql($rcSql){
		$this->_rcSql = $rcSql;
	}
	/**
	 * @Copyright 2015 Fullengine
	 *
	 * ejecuta las transaccion
	 * @author freina<freina@Fullengine.com>
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
	 * @Copyright 2015 Fullengine
	 *
	 * Obtiene los pacientes 
	 * @author freina<freina@Fullengine.com>
	 *
	 * @location Cali - Colombia
	 */
	function getPaciente(){

		settype($rcResult,"array");
		settype($rcTmp,"array");
		settype($sbSql,"string");
		settype($sbTmp,"string");

		extract($this->rcData);

		if($paciindentis){
			$rcTmp[] = ' "paciindentis"=\''.$paciindentis.'\' ';
		}
		if($tiidcodigos){
				$rcTmp[] = ' "tiidcodigos"=\''.$tiidcodigos.'\' ';
			}
		if($paciprinoms){
				$rcTmp[] = ' "paciprinoms"=\''.$paciprinoms.'\' ';
			}
		if($pacisegnoms){
				$rcTmp[] = ' "pacisegnoms"=\''.$pacisegnoms.'\' ';
			}
		if($pacipriapes){
				$rcTmp[] = ' "pacipriapes"=\''.$pacipriapes.'\' ';
			}
		if($pacisegapes){
				$rcTmp[] = ' "pacisegapes"=\''.$pacisegapes.'\' ';
			}
		if($pacifecnacis){
				$rcTmp[] = ' "pacifecnacis"='.$pacifecnacis.' ';
			}
		if($sexocodigos){
				$rcTmp[] = ' "sexocodigos"=\''.$sexocodigos.'\' ';
			}
		if($paciemail){
				$rcTmp[] = ' "paciemail"=\''.$paciemail.'\' ';
			}
		if($locacodigos){
				$rcTmp[] = ' "locacodigos"=\''.$locacodigos.'\' ';
			}
		if($pacidirecios){
				$rcTmp[] = ' "pacidirecios"=\''.$pacidirecios.'\' ';
			}
		if($pacitelefons){
				$rcTmp[] = ' "pacitelefons"=\''.$pacitelefons.'\' ';
			}
		if($pacinumcels){
				$rcTmp[] = ' "pacinumcels"=\''.$pacinumcels.'\' ';
			}
		if($pacihisclis){
				$rcTmp[] = ' "pacihisclis"=\''.$pacihisclis.'\' ';
			}
		if($paciobservs){
				$rcTmp[] = ' "paciobservs"=\''.$paciobservs.'\' ';
			}
		if($paciactivos){
				$rcTmp[] = ' "paciactivos"=\''.$paciactivos.'\' ';
			}

		$sbSql = 'SELECT * FROM "paciente" ';

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

	function existPaciente($paciindentis) {
		$sql = 'SELECT * FROM "paciente" WHERE "paciindentis"=\''.$paciindentis.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}

	function existPacienteByIdentis($paciindentis) {
		$sql = 'SELECT * FROM "paciente" WHERE "paciindentis"=\''.$paciindentis.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}

	function addPaciente($paciindentis, $tiidcodigos, $paciprinoms, $pacisegnoms, $pacipriapes, $pacisegapes, 
	$pacifecnacis, $sexocodigos, $paciemail, $locacodigos, $pacidirecios, $pacitelefons, $pacihisclis, $paciobservs,$pacinumcels) {
		$sql = 'INSERT INTO "paciente" ("paciindentis","tiidcodigos",' .
				'"paciprinoms","pacisegnoms","pacipriapes","pacisegapes","pacifecnacis","sexocodigos",' .
				'"paciemail","locacodigos","pacidirecios","pacitelefons","pacihisclis","paciobservs","pacinumcels")'.
				' VALUES(\''.$paciindentis.'\',\''.$tiidcodigos.'\',\''.$paciprinoms.'\',\''.$pacisegnoms.'\',\''.$pacipriapes.'\',\''.
				$pacisegapes.'\','.$pacifecnacis.',\''.$sexocodigos.'\',\''.$paciemail.'\',\''.$locacodigos.'\',\''.
				$pacidirecios.'\',\''.$pacitelefons.'\',\''.$pacihisclis.'\',\''.$paciobservs.'\',\''.$pacinumcels.'\')';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function updatePaciente($paciindentis, $tiidcodigos, 
	$paciprinoms, $pacisegnoms, $pacipriapes, $pacisegapes, 
	$pacifecnacis, $sexocodigos, $paciemail, $locacodigos, 
	$pacidirecios, $pacitelefons, $pacihisclis, $paciobservs, $paciactivos,$pacinumcels) {
		$sql = 'UPDATE "paciente" SET "tiidcodigos"=\''.$tiidcodigos.'\',"paciprinoms"=\''.$paciprinoms.'\',"pacisegnoms"=\''.$pacisegnoms.
		'\',"pacipriapes"=\''.$pacipriapes.'\',"pacisegapes"=\''.$pacisegapes.'\',"pacifecnacis"='.$pacifecnacis.
		', "sexocodigos"=\''.$sexocodigos.'\',"paciemail"=\''.
		$paciemail.'\',"locacodigos"=\''.$locacodigos.'\',"pacidirecios"=\''.
		$pacidirecios.'\',"pacitelefons"=\''.$pacitelefons.'\',"pacihisclis"=\''.
		$pacihisclis.'\',"paciobservs"=\''.$paciobservs.'\',"paciactivos"=\''.$paciactivos.'\',"pacinumcels"=\''.$pacinumcels.'\' 
		WHERE "paciindentis"=\''.$paciindentis.'\' ';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function deletePaciente($paciindentis) {
		$sql = 'DELETE FROM "paciente" WHERE "paciindentis"=\''.$paciindentis.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function getByIdPaciente($paciindentis) {
		$sql = 'SELECT "paciente".*, (COALESCE("paciente"."paciprinoms", \'\') || \' \' || COALESCE("paciente"."pacisegnoms", \'\') || \' \' || COALESCE("paciente"."pacipriapes", \'\') || \' \' || COALESCE("paciente"."pacisegapes", \'\'))  AS "pacinombres" FROM "paciente" WHERE "paciindentis"=\''.$paciindentis.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getAllPaciente() {
		$sql = 'SELECT "paciente".*, (COALESCE("paciente"."paciprinoms", \'\') || \' \' || COALESCE("paciente"."pacisegnoms", \'\') || \' \' || COALESCE("paciente"."pacipriapes", \'\') || \' \' || COALESCE("paciente"."pacisegapes", \'\'))  AS "pacinombres" FROM "paciente"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getPaciindentis($paciindentis) {
		$sql = 'SELECT "paciindentis" FROM "paciente" WHERE "paciindentis"=\''.$paciindentis.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getPacinombres($paciindentis) {
		$sql = 'SELECT (COALESCE("paciente"."paciprinoms", \'\') || \' \' || COALESCE("paciente"."pacisegnoms", \'\') || \' \' || COALESCE("paciente"."pacipriapes", \'\') || \' \' || COALESCE("paciente"."pacisegapes", \'\'))  AS "pacinombres" FROM "paciente" WHERE "paciindentis"=\''.$paciindentis.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getPaciemail($paciindentis) {
		$sql = 'SELECT "paciemail" FROM "paciente" WHERE "paciindentis"=\''.$paciindentis.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getLocacodigos($paciindentis) {
		$sql = 'SELECT "locacodigos" FROM "paciente" WHERE "paciindentis"=\''.$paciindentis.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getPacidirecios($paciindentis) {
		$sql = 'SELECT "pacidirecios" FROM "paciente" WHERE "paciindentis"=\''.$paciindentis.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getPacitelefons($paciindentis) {
		$sql = 'SELECT "pacitelefons" FROM "paciente" WHERE "paciindentis"=\''.$paciindentis.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getPaciobservs($paciindentis) {
		$sql = 'SELECT "paciobservs" FROM "paciente" WHERE "paciindentis"=\''.$paciindentis.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getByIdpaciindentis($paciindentis) {
		$sql = 'SELECT "paciente".*, (COALESCE("paciente"."paciprinoms", \'\') || \' \' || COALESCE("paciente"."pacisegnoms", \'\') || \' \' || COALESCE("paciente"."pacipriapes", \'\') || \' \' || COALESCE("paciente"."pacisegapes", \'\'))  AS "pacinombres" FROM "paciente" WHERE "paciindentis"=\''.$paciindentis.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Determina si el paciente existe y esta activo, por medio de su identificacion
	* @param string $sbPaciindentis Identificacion del paciente
	* @return integer 0 no existe 1 existe
	* @author freina<freina@Fullengine.com>
	* @date 25-Oct-2006 16:01
	* @location Cali-Colombia
	*/
	function existActivePacienteByIdentis($sbPaciindentis) {
		settype($sbSql, "string");
		settype($sbState, "string");
		$sbState = Application :: getConstant("REG_ACT");
		$sbSql = 'SELECT * FROM "paciente" WHERE "paciindentis"=\''.$sbPaciindentis.'\''.' AND "paciactivos"=\''.$sbState.'\'';
		
		$this->objdb->fncadoexecute($sbSql);
		return $this->objdb->fncadorowcont();
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Determina si el paciente existe y esta activo, por medio de codigo interno
	* @param integer $nuPacicodigon codigo del paciente
	* @return integer 0 no existe 1 existe
	* @author freina<freina@Fullengine.com>
	* @date 27-Nov-2010 09:28
	* @location Cali-Colombia
	*/
	function existActivePacienteById($sbPaciindentis) {
		settype($sbSql, "string");
		settype($sbState, "string");
		$sbState = Application :: getConstant("REG_ACT");
		$sbSql = 'SELECT * FROM "paciente" WHERE "paciindentis"=\''.$sbPaciindentis.'\' AND "paciactivos"=\''.$sbState.'\'';
		
		$this->objdb->fncadoexecute($sbSql);
		return $this->objdb->fncadorowcont();
	}
	
	/**
	* @copyright Copyright 2012 &copy; FullEngine
	*
	* Obtiene el registro del paciente con el numero de histora clinica
	* @param string $sbPacihisclis numero de historia clinica
	* @return array
	* @author freina<freina@Fullengine.com>
	* @date 13-Jul-2012 10:04
	* @location Cali-Colombia
	*/
	function getPacienteByPacihisclis($sbPacihisclis) {
		
		settype($sbSql, "string");
		
		$sbSql = 'SELECT "paciente".*, (COALESCE("paciente"."paciprinoms", \'\') || \' \' || COALESCE("paciente"."pacisegnoms", \'\') || \' \' || COALESCE("paciente"."pacipriapes", \'\') || \' \' || COALESCE("paciente"."pacisegapes", \'\'))  AS "pacinombres" FROM "paciente" WHERE "pacihisclis"=\''.$sbPacihisclis.'\'';
		$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Paciente
?>